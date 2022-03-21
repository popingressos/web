  1 ﻿/*
  2 Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
  3 For licensing, see LICENSE.html or http://ckeditor.com/license
  4 */
  5 
  6 /**
  7  * @fileOverview The "wysiwygarea" plugin. It registers the "wysiwyg" editing
  8  *		mode, which handles the main editing area space.
  9  */
 10 
 11 (function()
 12 {
 13 	// Matching an empty paragraph at the end of document.
 14 	var emptyParagraphRegexp = /(^|<body\b[^>]*>)\s*<(p|div|address|h\d|center|pre)[^>]*>\s*(?:<br[^>]*>| |\u00A0| )?\s*(:?<\/\2>)?\s*(?=$|<\/body>)/gi;
 15 
 16 	var notWhitespaceEval = CKEDITOR.dom.walker.whitespaces( true ),
 17 	  notBogus = CKEDITOR.dom.walker.bogus( true ),
 18 	  notEmpty = function( node ) { return notWhitespaceEval( node ) && notBogus( node ); };
 19 
 20 	// Elements that could blink the cursor anchoring beside it, like hr, page-break. (#6554)
 21 	function nonEditable( element )
 22 	{
 23 		return element.isBlockBoundary() && CKEDITOR.dtd.$empty[ element.getName() ];
 24 	}
 25 
 26 
 27 	function onInsert( insertFunc )
 28 	{
 29 		return function( evt )
 30 		{
 31 			if ( this.mode == 'wysiwyg' )
 32 			{
 33 				this.focus();
 34 
 35 				// Since the insertion might happen from within dialog or menu
 36 				// where the editor selection might be locked at the moment,
 37 				// update the locked selection.
 38 				var selection = this.getSelection(),
 39 				selIsLocked = selection.isLocked;
 40 
 41 				selIsLocked && selection.unlock();
 42 
 43 				this.fire( 'saveSnapshot' );
 44 
 45 				insertFunc.call( this, evt.data );
 46 
 47 				selIsLocked && this.getSelection().lock();
 48 
 49 				var that = this;
 50 				// Save snaps after the whole execution completed.
 51 				// This's a workaround for make DOM modification's happened after
 52 				// 'insertElement' to be included either, e.g. Form-based dialogs' 'commitContents'
 53 				// call.
 54 				setTimeout( function()
 55 				   {
 56 						 try { that.fire( 'saveSnapshot' ); }
 57 						 // IEs < 9 may requires a further delay to save snapshot, after pasting. (#9132)
 58 						 catch ( e ) { setTimeout( function(){ that.fire( 'saveSnapshot' ); }, 200 ); }
 59 					 }, 0 );
 60 			}
 61 		};
 62 	}
 63 
 64 	function doInsertHtml( data )
 65 	{
 66 		if ( this.dataProcessor )
 67 			data = this.dataProcessor.toHtml( data );
 68 
 69 		if ( !data )
 70 			return;
 71 
 72 		// HTML insertion only considers the first range.
 73 		var selection = this.getSelection(),
 74 			range = selection.getRanges()[ 0 ];
 75 
 76 		if ( range.checkReadOnly() )
 77 			return;
 78 
 79 		// Opera: force block splitting when pasted content contains block. (#7801)
 80 		if ( CKEDITOR.env.opera )
 81 		{
 82 			var path = new CKEDITOR.dom.elementPath( range.startContainer );
 83 			if ( path.block )
 84 			{
 85 				var nodes = CKEDITOR.htmlParser.fragment.fromHtml( data, false ).children;
 86 				for ( var i = 0, count = nodes.length; i < count; i++ )
 87 				{
 88 					if ( nodes[ i ]._.isBlockLike )
 89 					{
 90 						range.splitBlock( this.enterMode == CKEDITOR.ENTER_DIV ? 'div' : 'p' );
 91 						range.insertNode( range.document.createText( '' ) );
 92 						range.select();
 93 						break;
 94 					}
 95 				}
 96 			}
 97 		}
 98 
 99 		if ( CKEDITOR.env.ie )
100 		{
101 			var $sel = selection.getNative();
102 
103 			// Delete control selections to avoid IE bugs on pasteHTML.
104 			if ( $sel.type == 'Control' )
105 				$sel.clear();
106 			else if ( selection.getType() == CKEDITOR.SELECTION_TEXT )
107 			{
108 				// Due to IE bugs on handling contenteditable=false blocks
109 				// (#6005), we need to make some checks and eventually
110 				// delete the selection first.
111 
112 				range = selection.getRanges()[ 0 ];
113 				var endContainer = range && range.endContainer;
114 
115 				if ( endContainer &&
116 						endContainer.type == CKEDITOR.NODE_ELEMENT &&
117 						endContainer.getAttribute( 'contenteditable' ) == 'false' &&
118 						range.checkBoundaryOfElement( endContainer, CKEDITOR.END ) )
119 				{
120 					range.setEndAfter( range.endContainer );
121 					range.deleteContents();
122 				}
123 			}
124 
125 			$sel.createRange().pasteHTML( data );
126 		}
127 		else
128 			this.document.$.execCommand( 'inserthtml', false, data );
129 
130 		// Webkit does not scroll to the cursor position after pasting (#5558)
131 		if ( CKEDITOR.env.webkit )
132 		{
133 			selection = this.getSelection();
134 			selection.scrollIntoView();
135 		}
136 	}
137 
138 	function doInsertText( text )
139 	{
140 		var selection = this.getSelection(),
141 			mode = selection.getStartElement().hasAscendant( 'pre', true ) ?
142 				   CKEDITOR.ENTER_BR : this.config.enterMode,
143 			isEnterBrMode = mode == CKEDITOR.ENTER_BR;
144 
145 		var html = CKEDITOR.tools.htmlEncode( text.replace( /\r\n|\r/g, '\n' ) );
146 
147 		// Convert leading and trailing whitespaces into  
148 		html = html.replace( /^[ \t]+|[ \t]+$/g, function( match, offset, s )
149 			{
150 				if ( match.length == 1 )	// one space, preserve it
151 					return ' ';
152 				else if ( !offset )		// beginning of block
153 					return CKEDITOR.tools.repeat( ' ', match.length - 1 ) + ' ';
154 				else				// end of block
155 					return ' ' + CKEDITOR.tools.repeat( ' ', match.length - 1 );
156 			} );
157 
158 		// Convert subsequent whitespaces into  
159 		html = html.replace( /[ \t]{2,}/g, function ( match )
160 		   {
161 			   return CKEDITOR.tools.repeat( ' ', match.length - 1 ) + ' ';
162 		   } );
163 
164 		var paragraphTag = mode == CKEDITOR.ENTER_P ? 'p' : 'div';
165 
166 		// Two line-breaks create one paragraph.
167 		if ( !isEnterBrMode )
168 		{
169 			html = html.replace( /(\n{2})([\s\S]*?)(?:$|\1)/g,
170 				function( match, group1, text )
171 				{
172 					return '<'+paragraphTag + '>' + text + '</' + paragraphTag + '>';
173 				});
174 		}
175 
176 		// One <br> per line-break.
177 		html = html.replace( /\n/g, '<br>' );
178 
179 		// Compensate padding <br> for non-IE.
180 		if ( !( isEnterBrMode || CKEDITOR.env.ie ) )
181 		{
182 			html = html.replace( new RegExp( '<br>(?=</' + paragraphTag + '>)' ), function( match )
183 			{
184 				return CKEDITOR.tools.repeat( match, 2 );
185 			} );
186 		}
187 
188 		// Inline styles have to be inherited in Firefox.
189 		if ( CKEDITOR.env.gecko || CKEDITOR.env.webkit )
190 		{
191 			var path = new CKEDITOR.dom.elementPath( selection.getStartElement() ),
192 				context = [];
193 
194 			for ( var i = 0; i < path.elements.length; i++ )
195 			{
196 				var tag = path.elements[ i ].getName();
197 				if ( tag in CKEDITOR.dtd.$inline )
198 					context.unshift( path.elements[ i ].getOuterHtml().match( /^<.*?>/) );
199 				else if ( tag in CKEDITOR.dtd.$block )
200 					break;
201 			}
202 
203 			// Reproduce the context  by preceding the pasted HTML with opening inline tags.
204 			html = context.join( '' ) + html;
205 		}
206 
207 		doInsertHtml.call( this, html );
208 	}
209 
210 	function doInsertElement( element )
211 	{
212 		var selection = this.getSelection(),
213 				ranges = selection.getRanges(),
214 				elementName = element.getName(),
215 				isBlock = CKEDITOR.dtd.$block[ elementName ];
216 
217 		var selIsLocked = selection.isLocked;
218 
219 		if ( selIsLocked )
220 			selection.unlock();
221 
222 		var range, clone, lastElement, bookmark;
223 
224 		for ( var i = ranges.length - 1 ; i >= 0 ; i-- )
225 		{
226 			range = ranges[ i ];
227 
228 				if ( !range.checkReadOnly() )
229 				{
230 					// Remove the original contents, merge splitted nodes.
231 					range.deleteContents( 1 );
232 
233 					clone = !i && element || element.clone( 1 );
234 
235 					// If we're inserting a block at dtd-violated position, split
236 					// the parent blocks until we reach blockLimit.
237 					var current, dtd;
238 					if ( isBlock )
239 					{
240 						while ( ( current = range.getCommonAncestor( 0, 1 ) )
241 								&& ( dtd = CKEDITOR.dtd[ current.getName() ] )
242 								&& !( dtd && dtd [ elementName ] ) )
243 						{
244 							// Split up inline elements.
245 							if ( current.getName() in CKEDITOR.dtd.span )
246 								range.splitElement( current );
247 							// If we're in an empty block which indicate a new paragraph,
248 							// simply replace it with the inserting block.(#3664)
249 							else if ( range.checkStartOfBlock()
250 									&& range.checkEndOfBlock() )
251 							{
252 								range.setStartBefore( current );
253 								range.collapse( true );
254 								current.remove();
255 							}
256 							else
257 								range.splitBlock();
258 						}
259 					}
260 
261 					// Insert the new node.
262 					range.insertNode( clone );
263 
264 					// Save the last element reference so we can make the
265 					// selection later.
266 					if ( !lastElement )
267 						lastElement = clone;
268 				}
269 			}
270 
271 			if ( lastElement )
272 			{
273 				range.moveToPosition( lastElement, CKEDITOR.POSITION_AFTER_END );
274 
275 				// If we're inserting a block element immediately followed by
276 				// another block element, the selection must be optimized. (#3100,#5436,#8950)
277 				if ( isBlock )
278 				{
279 					var next = lastElement.getNext( notEmpty ),
280 						nextName = next && next.type == CKEDITOR.NODE_ELEMENT && next.getName();
281 
282 					// If the next one is a text block, move cursor to the start of it's content.
283 					if ( nextName && CKEDITOR.dtd.$block[ nextName ] )
284 					{
285 						if ( CKEDITOR.dtd[ nextName ][ '#' ] )
286 							range.moveToElementEditStart( next );
287 						// Otherwise move cursor to the before end of the last element.
288 						else
289 							range.moveToElementEditEnd( lastElement );
290 					}
291 					// Open a new line if the block is inserted at the end of parent.
292 					else if ( !next )
293 					{
294 						next = range.fixBlock( true, this.config.enterMode == CKEDITOR.ENTER_DIV ? 'div' : 'p' );
295 						range.moveToElementEditStart( next );
296 					}
297 				}
298 			}
299 
300 			selection.selectRanges( [ range ] );
301 
302 		if ( selIsLocked )
303 			this.getSelection().lock();
304 	}
305 
306 	// DOM modification here should not bother dirty flag.(#4385)
307 	function restoreDirty( editor )
308 	{
309 		if ( !editor.checkDirty() )
310 			setTimeout( function(){ editor.resetDirty(); }, 0 );
311 	}
312 
313 	var isNotWhitespace = CKEDITOR.dom.walker.whitespaces( true ),
314 		isNotBookmark = CKEDITOR.dom.walker.bookmark( false, true );
315 
316 	function isNotEmpty( node )
317 	{
318 		return isNotWhitespace( node ) && isNotBookmark( node );
319 	}
320 
321 	function isNbsp( node )
322 	{
323 		return node.type == CKEDITOR.NODE_TEXT
324 			   && CKEDITOR.tools.trim( node.getText() ).match( /^(?: |\xa0)$/ );
325 	}
326 
327 	function restoreSelection( selection )
328 	{
329 		if ( selection.isLocked )
330 		{
331 			selection.unlock();
332 			setTimeout( function() { selection.lock(); }, 0 );
333 		}
334 	}
335 
336 	function isBlankParagraph( block )
337 	{
338 		return block.getOuterHtml().match( emptyParagraphRegexp );
339 	}
340 
341 	isNotWhitespace = CKEDITOR.dom.walker.whitespaces( true );
342 
343 	// Gecko need a key event to 'wake up' the editing
344 	// ability when document is empty.(#3864)
345 	function activateEditing( editor )
346 	{
347 		var win = editor.window,
348 			doc = editor.document,
349 			body = editor.document.getBody(),
350 			bodyFirstChild = body.getFirst(),
351 			bodyChildsNum = body.getChildren().count();
352 
353 		if ( !bodyChildsNum
354 			|| bodyChildsNum == 1
355 				&& bodyFirstChild.type == CKEDITOR.NODE_ELEMENT
356 				&& bodyFirstChild.hasAttribute( '_moz_editor_bogus_node' ) )
357 		{
358 			restoreDirty( editor );
359 
360 			// Memorize scroll position to restore it later (#4472).
361 			var hostDocument = editor.element.getDocument();
362 			var hostDocumentElement = hostDocument.getDocumentElement();
363 			var scrollTop = hostDocumentElement.$.scrollTop;
364 			var scrollLeft = hostDocumentElement.$.scrollLeft;
365 
366 			// Simulating keyboard character input by dispatching a keydown of white-space text.
367 			var keyEventSimulate = doc.$.createEvent( "KeyEvents" );
368 			keyEventSimulate.initKeyEvent( 'keypress', true, true, win.$, false,
369 				false, false, false, 0, 32 );
370 			doc.$.dispatchEvent( keyEventSimulate );
371 
372 			if ( scrollTop != hostDocumentElement.$.scrollTop || scrollLeft != hostDocumentElement.$.scrollLeft )
373 				hostDocument.getWindow().$.scrollTo( scrollLeft, scrollTop );
374 
375 			// Restore the original document status by placing the cursor before a bogus br created (#5021).
376 			bodyChildsNum && body.getFirst().remove();
377 			doc.getBody().appendBogus();
378 			var nativeRange = new CKEDITOR.dom.range( doc );
379 			nativeRange.setStartAt( body , CKEDITOR.POSITION_AFTER_START );
380 			nativeRange.select();
381 		}
382 	}
383 
384 	/**
385 	 *  Auto-fixing block-less content by wrapping paragraph (#3190), prevent
386 	 *  non-exitable-block by padding extra br.(#3189)
387 	 */
388 	function onSelectionChangeFixBody( evt )
389 	{
390 		var editor = evt.editor,
391 			path = evt.data.path,
392 			blockLimit = path.blockLimit,
393 			selection = evt.data.selection,
394 			range = selection.getRanges()[0],
395 			body = editor.document.getBody(),
396 			enterMode = editor.config.enterMode;
397 
398 		if ( CKEDITOR.env.gecko )
399 		{
400 			// Ensure bogus br could help to move cursor (out of styles) to the end of block. (#7041)
401 			var pathBlock = path.block || path.blockLimit,
402 				lastNode = pathBlock && pathBlock.getLast( isNotEmpty );
403 
404 			// Check some specialities of the current path block:
405 			// 1. It is really displayed as block; (#7221)
406 			// 2. It doesn't end with one inner block; (#7467)
407 			// 3. It doesn't have bogus br yet.
408 			if ( pathBlock
409 					&& pathBlock.isBlockBoundary()
410 					&& !( lastNode && lastNode.type == CKEDITOR.NODE_ELEMENT && lastNode.isBlockBoundary() )
411 					&& !pathBlock.is( 'pre' )
412 					&& !pathBlock.getBogus() )
413 			{
414 				pathBlock.appendBogus();
415 			}
416 		}
417 
418 		// When we're in block enter mode, a new paragraph will be established
419 		// to encapsulate inline contents right under body. (#3657)
420 		if ( editor.config.autoParagraph !== false
421 				&& enterMode != CKEDITOR.ENTER_BR
422 				&& range.collapsed
423 				&& blockLimit.getName() == 'body'
424 				&& !path.block )
425 		{
426 			var fixedBlock = range.fixBlock( true,
427 					editor.config.enterMode == CKEDITOR.ENTER_DIV ? 'div' : 'p'  );
428 
429 			// For IE, we should remove any filler node which was introduced before.
430 			if ( CKEDITOR.env.ie )
431 			{
432 				var first = fixedBlock.getFirst( isNotEmpty );
433 				first && isNbsp( first ) && first.remove();
434 			}
435 
436 			// If the fixed block is actually blank and is already followed by an exitable blank
437 			// block, we should revert the fix and move into the existed one. (#3684)
438 			if ( isBlankParagraph( fixedBlock ) )
439 			{
440 				var element = fixedBlock.getNext( isNotWhitespace );
441 				if ( element &&
442 					 element.type == CKEDITOR.NODE_ELEMENT &&
443 					 !nonEditable( element ) )
444 				{
445 					range.moveToElementEditStart( element );
446 					fixedBlock.remove();
447 				}
448 				else
449 				{
450 					element = fixedBlock.getPrevious( isNotWhitespace );
451 					if ( element &&
452 						 element.type == CKEDITOR.NODE_ELEMENT &&
453 						 !nonEditable( element ) )
454 					{
455 						range.moveToElementEditEnd( element );
456 						fixedBlock.remove();
457 					}
458 				}
459 			}
460 
461 			range.select();
462 			// Cancel this selection change in favor of the next (correct).  (#6811)
463 			evt.cancel();
464 		}
465 
466 		// Browsers are incapable of moving cursor out of certain block elements (e.g. table, div, pre)
467 		// at the end of document, makes it unable to continue adding content, we have to make this
468 		// easier by opening an new empty paragraph.
469 		var testRange = new CKEDITOR.dom.range( editor.document );
470 		testRange.moveToElementEditEnd( editor.document.getBody() );
471 		var testPath = new CKEDITOR.dom.elementPath( testRange.startContainer );
472 		if ( !testPath.blockLimit.is( 'body') )
473 		{
474 			var paddingBlock;
475 			if ( enterMode != CKEDITOR.ENTER_BR )
476 				paddingBlock = body.append( editor.document.createElement( enterMode == CKEDITOR.ENTER_P ? 'p' : 'div' ) );
477 			else
478 				paddingBlock = body;
479 
480 			if ( !CKEDITOR.env.ie )
481 				paddingBlock.appendBogus();
482 		}
483 	}
484 
485 	CKEDITOR.plugins.add( 'wysiwygarea',
486 	{
487 		requires : [ 'editingblock' ],
488 
489 		init : function( editor )
490 		{
491 			var fixForBody = ( editor.config.enterMode != CKEDITOR.ENTER_BR && editor.config.autoParagraph !== false )
492 				? editor.config.enterMode == CKEDITOR.ENTER_DIV ? 'div' : 'p' : false;
493 
494 			var frameLabel = editor.lang.editorTitle.replace( '%1', editor.name ),
495 				frameDesc = editor.lang.editorHelp;
496 
497 			if ( CKEDITOR.env.ie )
498 				frameLabel += ', ' + frameDesc;
499 
500 			var win = CKEDITOR.document.getWindow();
501 			var contentDomReadyHandler;
502 			editor.on( 'editingBlockReady', function()
503 				{
504 					var mainElement,
505 						iframe,
506 						isLoadingData,
507 						isPendingFocus,
508 						frameLoaded,
509 						fireMode,
510 						onResize;
511 
512 
513 					// Support for custom document.domain in IE.
514 					var isCustomDomain = CKEDITOR.env.isCustomDomain();
515 
516 					// Creates the iframe that holds the editable document.
517 					var createIFrame = function( data )
518 					{
519 						if ( iframe )
520 							iframe.remove();
521 
522 						var src =
523 							'document.open();' +
524 
525 							// The document domain must be set any time we
526 							// call document.open().
527 							( isCustomDomain ? ( 'document.domain="' + document.domain + '";' ) : '' ) +
528 
529 							'document.close();';
530 
531 						// With IE, the custom domain has to be taken care at first,
532 						// for other browers, the 'src' attribute should be left empty to
533 						// trigger iframe's 'load' event.
534   						src =
535 							CKEDITOR.env.air ?
536 								'javascript:void(0)' :
537 							CKEDITOR.env.ie ?
538 								'javascript:void(function(){' + encodeURIComponent( src ) + '}())'
539 							:
540 								'';
541 
542 						var labelId = CKEDITOR.tools.getNextId();
543 						iframe = CKEDITOR.dom.element.createFromHtml( '<iframe' +
544   							' style="width:100%;height:100%"' +
545   							' frameBorder="0"' +
546   							' aria-describedby="' + labelId + '"' +
547 							' title="' + frameLabel + '"' +
548   							' src="' + src + '"' +
549 							' tabIndex="' + ( CKEDITOR.env.webkit? -1 : editor.tabIndex ) + '"' +
550   							' allowTransparency="true"' +
551   							'></iframe>' );
552 
553 						// Running inside of Firefox chrome the load event doesn't bubble like in a normal page (#5689)
554 						if ( document.location.protocol == 'chrome:' )
555 							CKEDITOR.event.useCapture = true;
556 
557 						// With FF, it's better to load the data on iframe.load. (#3894,#4058)
558 						iframe.on( 'load', function( ev )
559 							{
560 								frameLoaded = 1;
561 								ev.removeListener();
562 
563 								var doc = iframe.getFrameDocument();
564 								doc.write( data );
565 
566 								CKEDITOR.env.air && contentDomReady( doc.getWindow().$ );
567 							});
568 
569 						// Reset adjustment back to default (#5689)
570 						if ( document.location.protocol == 'chrome:' )
571 							CKEDITOR.event.useCapture = false;
572 
573 						mainElement.append( CKEDITOR.dom.element.createFromHtml(
574 							'<span id="' + labelId + '" class="cke_voice_label">' + frameDesc + '</span>'));
575 
576 						mainElement.append( iframe );
577 
578 						// Webkit: iframe size doesn't auto fit well. (#7360)
579 						if ( CKEDITOR.env.webkit )
580 						{
581 							onResize = function()
582 							{
583 								// Hide the iframe to get real size of the holder. (#8941)
584 								mainElement.setStyle( 'width', '100%' );
585 								iframe.hide();
586 
587 								iframe.setSize( 'width', mainElement.getSize( 'width' ) );
588 								mainElement.removeStyle( 'width' );
589 								iframe.show();
590 							};
591 
592 							win.on( 'resize', onResize );
593 						}
594 					};
595 
596 					// The script that launches the bootstrap logic on 'domReady', so the document
597 					// is fully editable even before the editing iframe is fully loaded (#4455).
598 					contentDomReadyHandler = CKEDITOR.tools.addFunction( contentDomReady );
599 					var activationScript =
600 						'<script id="cke_actscrpt" type="text/javascript" data-cke-temp="1">' +
601 							( isCustomDomain ? ( 'document.domain="' + document.domain + '";' ) : '' ) +
602 							'window.parent.CKEDITOR.tools.callFunction( ' + contentDomReadyHandler + ', window );' +
603 						'</script>';
604 
605 					// Editing area bootstrap code.
606 					function contentDomReady( domWindow )
607 					{
608 						if ( !frameLoaded )
609 							return;
610 						frameLoaded = 0;
611 
612 						editor.fire( 'ariaWidget', iframe );
613 
614 						var domDocument = domWindow.document,
615 							body = domDocument.body;
616 
617 						// Remove this script from the DOM.
618 						var script = domDocument.getElementById( "cke_actscrpt" );
619 						script && script.parentNode.removeChild( script );
620 
621 						body.spellcheck = !editor.config.disableNativeSpellChecker;
622 
623 						var editable = !editor.readOnly;
624 
625 						if ( CKEDITOR.env.ie )
626 						{
627 							// Don't display the focus border.
628 							body.hideFocus = true;
629 
630 							// Disable and re-enable the body to avoid IE from
631 							// taking the editing focus at startup. (#141 / #523)
632 							body.disabled = true;
633 							body.contentEditable = editable;
634 							body.removeAttribute( 'disabled' );
635 						}
636 						else
637 						{
638 							// Avoid opening design mode in a frame window thread,
639 							// which will cause host page scrolling.(#4397)
640 							setTimeout( function()
641 							{
642 								// Prefer 'contentEditable' instead of 'designMode'. (#3593)
643 								if ( CKEDITOR.env.gecko && CKEDITOR.env.version >= 10900
644 										|| CKEDITOR.env.opera )
645 									domDocument.$.body.contentEditable = editable;
646 								else if ( CKEDITOR.env.webkit )
647 									domDocument.$.body.parentNode.contentEditable = editable;
648 								else
649 									domDocument.$.designMode = editable? 'off' : 'on';
650 							}, 0 );
651 						}
652 
653 						editable && CKEDITOR.env.gecko && CKEDITOR.tools.setTimeout( activateEditing, 0, null, editor );
654 
655 						domWindow	= editor.window	= new CKEDITOR.dom.window( domWindow );
656 						domDocument	= editor.document	= new CKEDITOR.dom.document( domDocument );
657 
658 						editable && domDocument.on( 'dblclick', function( evt )
659 						{
660 							var element = evt.data.getTarget(),
661 								data = { element : element, dialog : '' };
662 							editor.fire( 'doubleclick', data );
663 							data.dialog && editor.openDialog( data.dialog );
664 						});
665 
666 						// Prevent automatic submission in IE #6336
667 						CKEDITOR.env.ie && domDocument.on( 'click', function( evt )
668 						{
669 							var element = evt.data.getTarget();
670 							if ( element.is( 'input' ) )
671 							{
672 								var type = element.getAttribute( 'type' );
673 								if ( type == 'submit' || type == 'reset' )
674 									evt.data.preventDefault();
675 							}
676 						});
677 
678 						// Gecko/Webkit need some help when selecting control type elements. (#3448)
679 						if ( !( CKEDITOR.env.ie || CKEDITOR.env.opera ) )
680 						{
681 							domDocument.on( 'mousedown', function( ev )
682 							{
683 								var control = ev.data.getTarget();
684 								if ( control.is( 'img', 'hr', 'input', 'textarea', 'select' ) )
685 									editor.getSelection().selectElement( control );
686 							} );
687 						}
688 
689 						if ( CKEDITOR.env.gecko )
690 						{
691 							domDocument.on( 'mouseup', function( ev )
692 							{
693 								if ( ev.data.$.button == 2 )
694 								{
695 									var target = ev.data.getTarget();
696 
697 									// Prevent right click from selecting an empty block even
698 									// when selection is anchored inside it. (#5845)
699 									if ( !target.getOuterHtml().replace( emptyParagraphRegexp, '' ) )
700 									{
701 										var range = new CKEDITOR.dom.range( domDocument );
702 										range.moveToElementEditStart( target );
703 										range.select( true );
704 									}
705 								}
706 							} );
707 						}
708 
709 						// Prevent the browser opening links in read-only blocks. (#6032)
710 						domDocument.on( 'click', function( ev )
711 							{
712 								ev = ev.data;
713 								if ( ev.getTarget().is( 'a' ) && ev.$.button != 2 )
714 									ev.preventDefault();
715 							});
716 
717 						// Webkit: avoid from editing form control elements content.
718 						if ( CKEDITOR.env.webkit )
719 						{
720 							// Mark that cursor will right blinking (#7113).
721 							domDocument.on( 'mousedown', function() { wasFocused = 1; } );
722 							// Prevent from tick checkbox/radiobox/select
723 							domDocument.on( 'click', function( ev )
724 							{
725 								if ( ev.data.getTarget().is( 'input', 'select' ) )
726 									ev.data.preventDefault();
727 							} );
728 
729 							// Prevent from editig textfield/textarea value.
730 							domDocument.on( 'mouseup', function( ev )
731 							{
732 								if ( ev.data.getTarget().is( 'input', 'textarea' ) )
733 									ev.data.preventDefault();
734 							} );
735 						}
736 
737 						var focusTarget = CKEDITOR.env.ie ? iframe : domWindow;
738 						focusTarget.on( 'blur', function()
739 							{
740 								editor.focusManager.blur();
741 							});
742 
743 						var wasFocused;
744 
745 						focusTarget.on( 'focus', function()
746 							{
747 								var doc = editor.document;
748 
749 								if ( CKEDITOR.env.gecko || CKEDITOR.env.opera )
750 									doc.getBody().focus();
751 								// Webkit needs focus for the first time on the HTML element. (#6153)
752 								else if ( CKEDITOR.env.webkit )
753 								{
754 									if ( !wasFocused )
755 									{
756 										editor.document.getDocumentElement().focus();
757 										wasFocused = 1;
758 									}
759 								}
760 
761 								editor.focusManager.focus();
762 							});
763 
764 						var keystrokeHandler = editor.keystrokeHandler;
765 						// Prevent backspace from navigating off the page.
766 						keystrokeHandler.blockedKeystrokes[ 8 ] = !editable;
767 						keystrokeHandler.attach( domDocument );
768 
769 						domDocument.getDocumentElement().addClass( domDocument.$.compatMode );
770 						// Override keystroke behaviors.
771 						editor.on( 'key', function( evt )
772 						{
773 							if ( editor.mode != 'wysiwyg' )
774 								return;
775 
776 							var keyCode = evt.data.keyCode;
777 
778 							// Backspace OR Delete.
779 							if ( keyCode in { 8 : 1, 46 : 1 } )
780 							{
781 								var sel = editor.getSelection(),
782 									selected = sel.getSelectedElement(),
783 									range = sel.getRanges()[ 0 ],
784 									path = new CKEDITOR.dom.elementPath( range.startContainer ),
785 									block,
786 									parent,
787 									next,
788 									rtl = keyCode == 8;
789 
790 								// Override keystrokes which should have deletion behavior
791 								//  on fully selected element . (#4047) (#7645)
792 								if ( selected )
793 								{
794 									// Make undo snapshot.
795 									editor.fire( 'saveSnapshot' );
796 
797 									// Delete any element that 'hasLayout' (e.g. hr,table) in IE8 will
798 									// break up the selection, safely manage it here. (#4795)
799 									range.moveToPosition( selected, CKEDITOR.POSITION_BEFORE_START );
800 									// Remove the control manually.
801 									selected.remove();
802 									range.select();
803 
804 									editor.fire( 'saveSnapshot' );
805 
806 									evt.cancel();
807 								}
808 								else if ( range.collapsed )
809 								{
810 									// Handle the following special cases: (#6217)
811 									// 1. Del/Backspace key before/after table;
812 									// 2. Backspace Key after start of table.
813 									if ( ( block = path.block ) &&
814 										 range[ rtl ? 'checkStartOfBlock' : 'checkEndOfBlock' ]() &&
815 										 ( next = block[ rtl ? 'getPrevious' : 'getNext' ]( notWhitespaceEval ) ) &&
816 										 next.is( 'table' ) )
817 									{
818 										editor.fire( 'saveSnapshot' );
819 
820 										// Remove the current empty block.
821 										if ( range[ rtl ? 'checkEndOfBlock' : 'checkStartOfBlock' ]() )
822 											block.remove();
823 
824 										// Move cursor to the beginning/end of table cell.
825 										range[ 'moveToElementEdit' + ( rtl ? 'End' : 'Start' ) ]( next );
826 										range.select();
827 
828 										editor.fire( 'saveSnapshot' );
829 
830 										evt.cancel();
831 									}
832 									else if ( path.blockLimit.is( 'td' ) &&
833 											  ( parent = path.blockLimit.getAscendant( 'table' ) ) &&
834 											  range.checkBoundaryOfElement( parent, rtl ? CKEDITOR.START : CKEDITOR.END ) &&
835 											  ( next = parent[ rtl ? 'getPrevious' : 'getNext' ]( notWhitespaceEval ) ) )
836 									{
837 										editor.fire( 'saveSnapshot' );
838 
839 										// Move cursor to the end of previous block.
840 										range[ 'moveToElementEdit' + ( rtl ? 'End' : 'Start' ) ]( next );
841 
842 										// Remove any previous empty block.
843 										if ( range.checkStartOfBlock() && range.checkEndOfBlock() )
844 											next.remove();
845 										else
846 											range.select();
847 
848 										editor.fire( 'saveSnapshot' );
849 
850 										evt.cancel();
851 									}
852 
853 								}
854 							}
855 
856 							// PageUp OR PageDown
857 							if ( keyCode == 33 || keyCode == 34 )
858 							{
859 								if ( CKEDITOR.env.gecko )
860 								{
861 									var body = domDocument.getBody();
862 
863 									// Page up/down cause editor selection to leak
864 									// outside of editable thus we try to intercept
865 									// the behavior, while it affects only happen
866 									// when editor contents are not overflowed. (#7955)
867 									if ( domWindow.$.innerHeight > body.$.offsetHeight )
868 									{
869 										range = new CKEDITOR.dom.range( domDocument );
870 										range[ keyCode == 33 ? 'moveToElementEditStart' : 'moveToElementEditEnd']( body );
871 										range.select();
872 										evt.cancel();
873 									}
874 								}
875 
876 							}
877 						} );
878 
879 						// PageUp/PageDown scrolling is broken in document
880 						// with standard doctype, manually fix it. (#4736)
881 						if ( CKEDITOR.env.ie && domDocument.$.compatMode == 'CSS1Compat' )
882 						{
883 							var pageUpDownKeys = { 33 : 1, 34 : 1 };
884 							domDocument.on( 'keydown', function( evt )
885 							{
886 								if ( evt.data.getKeystroke() in pageUpDownKeys )
887 								{
888 									setTimeout( function ()
889 									{
890 										editor.getSelection().scrollIntoView();
891 									}, 0 );
892 								}
893 							} );
894 						}
895 
896 						// Prevent IE from leaving new paragraph after deleting all contents in body. (#6966)
897 						if ( CKEDITOR.env.ie && editor.config.enterMode != CKEDITOR.ENTER_P )
898 						{
899 							domDocument.on( 'selectionchange', function()
900 							{
901 								var body = domDocument.getBody(),
902 									sel = editor.getSelection(),
903 									range = sel && sel.getRanges()[ 0 ];
904 
905 								if ( range && body.getHtml().match( /^<p> <\/p>$/i )
906 									&& range.startContainer.equals( body ) )
907 								{
908 									// Avoid the ambiguity from a real user cursor position.
909 									setTimeout( function ()
910 									{
911 										range = editor.getSelection().getRanges()[ 0 ];
912 										if ( !range.startContainer.equals ( 'body' ) )
913 										{
914 											body.getFirst().remove( 1 );
915 											range.moveToElementEditEnd( body );
916 											range.select( 1 );
917 										}
918 									}, 0 );
919 								}
920 							});
921 						}
922 
923 						// Adds the document body as a context menu target.
924 						if ( editor.contextMenu )
925 							editor.contextMenu.addTarget( domDocument, editor.config.browserContextMenuOnCtrl !== false );
926 
927 						setTimeout( function()
928 							{
929 								editor.fire( 'contentDom' );
930 
931 								if ( fireMode )
932 								{
933 									editor.mode = 'wysiwyg';
934 									editor.fire( 'mode', { previousMode : editor._.previousMode } );
935 									fireMode = false;
936 								}
937 
938 								isLoadingData = false;
939 
940 								if ( isPendingFocus )
941 								{
942 									editor.focus();
943 									isPendingFocus = false;
944 								}
945 								setTimeout( function()
946 								{
947 									editor.fire( 'dataReady' );
948 								}, 0 );
949 
950 								// Enable dragging of position:absolute elements in IE.
951 								try { editor.document.$.execCommand ( '2D-position', false, true); } catch(e) {}
952 
953 								// IE, Opera and Safari may not support it and throw errors.
954 								try { editor.document.$.execCommand( 'enableInlineTableEditing', false, !editor.config.disableNativeTableHandles ); } catch(e) {}
955 								if ( editor.config.disableObjectResizing )
956 								{
957 									try
958 									{
959 										editor.document.$.execCommand( 'enableObjectResizing', false, false );
960 									}
961 									catch(e)
962 									{
963 										// For browsers in which the above method failed, we can cancel the resizing on the fly (#4208)
964 										editor.document.getBody().on( CKEDITOR.env.ie ? 'resizestart' : 'resize', function( evt )
965 										{
966 											evt.data.preventDefault();
967 										});
968 									}
969 								}
970 
971 								/*
972 								 * IE BUG: IE might have rendered the iframe with invisible contents.
973 								 * (#3623). Push some inconsequential CSS style changes to force IE to
974 								 * refresh it.
975 								 *
976 								 * Also, for some unknown reasons, short timeouts (e.g. 100ms) do not
977 								 * fix the problem. :(
978 								 */
979 								if ( CKEDITOR.env.ie )
980 								{
981 									setTimeout( function()
982 										{
983 											if ( editor.document )
984 											{
985 												var $body = editor.document.$.body;
986 												$body.runtimeStyle.marginBottom = '0px';
987 												$body.runtimeStyle.marginBottom = '';
988 											}
989 										}, 1000 );
990 								}
991 							},
992 							0 );
993 					}
994 
995 					editor.addMode( 'wysiwyg',
996 						{
997 							load : function( holderElement, data, isSnapshot )
998 							{
999 								mainElement = holderElement;
1000 
1001 								if ( CKEDITOR.env.ie && CKEDITOR.env.quirks )
1002 									holderElement.setStyle( 'position', 'relative' );
1003 
1004 								// The editor data "may be dirty" after this
1005 								// point.
1006 								editor.mayBeDirty = true;
1007 
1008 								fireMode = true;
1009 
1010 								if ( isSnapshot )
1011 									this.loadSnapshotData( data );
1012 								else
1013 									this.loadData( data );
1014 							},
1015 
1016 							loadData : function( data )
1017 							{
1018 								isLoadingData = true;
1019 								editor._.dataStore = { id : 1 };
1020 
1021 								var config = editor.config,
1022 									fullPage = config.fullPage,
1023 									docType = config.docType;
1024 
1025 								// Build the additional stuff to be included into <head>.
1026 								var headExtra =
1027 									'<style type="text/css" data-cke-temp="1">' +
1028 										editor._.styles.join( '\n' ) +
1029 									'</style>';
1030 
1031 								!fullPage && ( headExtra =
1032 									CKEDITOR.tools.buildStyleHtml( editor.config.contentsCss ) +
1033 									headExtra );
1034 
1035 								var baseTag = config.baseHref ? '<base href="' + config.baseHref + '" data-cke-temp="1" />' : '';
1036 
1037 								if ( fullPage )
1038 								{
1039 									// Search and sweep out the doctype declaration.
1040 									data = data.replace( /<!DOCTYPE[^>]*>/i, function( match )
1041 										{
1042 											editor.docType = docType = match;
1043 											return '';
1044 										}).replace( /<\?xml\s[^\?]*\?>/i, function( match )
1045 										{
1046 											editor.xmlDeclaration = match;
1047 											return '';
1048 										});
1049 								}
1050 
1051 								// Get the HTML version of the data.
1052 								if ( editor.dataProcessor )
1053 									data = editor.dataProcessor.toHtml( data, fixForBody );
1054 
1055 								if ( fullPage )
1056 								{
1057 									// Check if the <body> tag is available.
1058 									if ( !(/<body[\s|>]/).test( data ) )
1059 										data = '<body>' + data;
1060 
1061 									// Check if the <html> tag is available.
1062 									if ( !(/<html[\s|>]/).test( data ) )
1063 										data = '<html>' + data + '</html>';
1064 
1065 									// Check if the <head> tag is available.
1066 									if ( !(/<head[\s|>]/).test( data ) )
1067 										data = data.replace( /<html[^>]*>/, '$&<head><title></title></head>' ) ;
1068 									else if ( !(/<title[\s|>]/).test( data ) )
1069 										data = data.replace( /<head[^>]*>/, '$&<title></title>' ) ;
1070 
1071 									// The base must be the first tag in the HEAD, e.g. to get relative
1072 									// links on styles.
1073 									baseTag && ( data = data.replace( /<head>/, '$&' + baseTag ) );
1074 
1075 									// Inject the extra stuff into <head>.
1076 									// Attention: do not change it before testing it well. (V2)
1077 									// This is tricky... if the head ends with <meta ... content type>,
1078 									// Firefox will break. But, it works if we place our extra stuff as
1079 									// the last elements in the HEAD.
1080 									data = data.replace( /<\/head\s*>/, headExtra + '$&' );
1081 
1082 									// Add the DOCTYPE back to it.
1083 									data = docType + data;
1084 								}
1085 								else
1086 								{
1087 									data =
1088 										config.docType +
1089 										'<html dir="' + config.contentsLangDirection + '"' +
1090 											' lang="' + ( config.contentsLanguage || editor.langCode ) + '">' +
1091 										'<head>' +
1092 											'<title>' + frameLabel + '</title>' +
1093 											baseTag +
1094 											headExtra +
1095 										'</head>' +
1096 										'<body' + ( config.bodyId ? ' id="' + config.bodyId + '"' : '' ) +
1097 												  ( config.bodyClass ? ' class="' + config.bodyClass + '"' : '' ) +
1098 												  '>' +
1099 											data +
1100 										'</html>';
1101 								}
1102 
1103 								// Distinguish bogus to normal BR at the end of document for Mozilla. (#5293).
1104 								if ( CKEDITOR.env.gecko )
1105 									data = data.replace( /<br \/>(?=\s*<\/(:?html|body)>)/, '$&<br type="_moz" />' );
1106 
1107 								data += activationScript;
1108 
1109 
1110 								// The iframe is recreated on each call of setData, so we need to clear DOM objects
1111 								this.onDispose();
1112 								createIFrame( data );
1113 							},
1114 
1115 							getData : function()
1116 							{
1117 								var config = editor.config,
1118 									fullPage = config.fullPage,
1119 									docType = fullPage && editor.docType,
1120 									xmlDeclaration = fullPage && editor.xmlDeclaration,
1121 									doc = iframe.getFrameDocument();
1122 
1123 								var data = fullPage
1124 									? doc.getDocumentElement().getOuterHtml()
1125 									: doc.getBody().getHtml();
1126 
1127 								// BR at the end of document is bogus node for Mozilla. (#5293).
1128 								if ( CKEDITOR.env.gecko )
1129 									data = data.replace( /<br>(?=\s*(:?$|<\/body>))/, '' );
1130 
1131 								if ( editor.dataProcessor )
1132 									data = editor.dataProcessor.toDataFormat( data, fixForBody );
1133 
1134 								// Reset empty if the document contains only one empty paragraph.
1135 								if ( config.ignoreEmptyParagraph )
1136 									data = data.replace( emptyParagraphRegexp, function( match, lookback ) { return lookback; } );
1137 
1138 								if ( xmlDeclaration )
1139 									data = xmlDeclaration + '\n' + data;
1140 								if ( docType )
1141 									data = docType + '\n' + data;
1142 
1143 								return data;
1144 							},
1145 
1146 							getSnapshotData : function()
1147 							{
1148 								return iframe.getFrameDocument().getBody().getHtml();
1149 							},
1150 
1151 							loadSnapshotData : function( data )
1152 							{
1153 								iframe.getFrameDocument().getBody().setHtml( data );
1154 							},
1155 
1156 							onDispose : function()
1157 							{
1158 								if ( !editor.document )
1159 									return;
1160 
1161 								editor.document.getDocumentElement().clearCustomData();
1162 								editor.document.getBody().clearCustomData();
1163 
1164 								editor.window.clearCustomData();
1165 								editor.document.clearCustomData();
1166 
1167 								iframe.clearCustomData();
1168 
1169 								/*
1170 								* IE BUG: When destroying editor DOM with the selection remains inside
1171 								* editing area would break IE7/8's selection system, we have to put the editing
1172 								* iframe offline first. (#3812 and #5441)
1173 								*/
1174 								iframe.remove();
1175 							},
1176 
1177 							unload : function( holderElement )
1178 							{
1179 								this.onDispose();
1180 
1181 								if ( onResize )
1182 									win.removeListener( 'resize', onResize );
1183 
1184 								editor.window = editor.document = iframe = mainElement = isPendingFocus = null;
1185 
1186 								editor.fire( 'contentDomUnload' );
1187 							},
1188 
1189 							focus : function()
1190 							{
1191 								var win = editor.window;
1192 
1193 								if ( isLoadingData )
1194 									isPendingFocus = true;
1195 								else if ( win )
1196 								{
1197 									var sel = editor.getSelection(),
1198 										ieSel = sel && sel.getNative();
1199 
1200 									// IE considers control-type element as separate
1201 									// focus host when selected, avoid destroying the
1202 									// selection in such case. (#5812) (#8949)
1203 									if ( ieSel && ieSel.type == 'Control' )
1204 										return;
1205 
1206 									// AIR needs a while to focus when moving from a link.
1207 									CKEDITOR.env.air ? setTimeout( function () { win.focus(); }, 0 ) : win.focus();
1208 									editor.selectionChange();
1209 								}
1210 							}
1211 						});
1212 
1213 					editor.on( 'insertHtml', onInsert( doInsertHtml ) , null, null, 20 );
1214 					editor.on( 'insertElement', onInsert( doInsertElement ), null, null, 20 );
1215 					editor.on( 'insertText', onInsert( doInsertText ), null, null, 20 );
1216 					// Auto fixing on some document structure weakness to enhance usabilities. (#3190 and #3189)
1217 					editor.on( 'selectionChange', function( evt )
1218 					{
1219 						if ( editor.readOnly )
1220 							return;
1221 
1222 						var sel = editor.getSelection();
1223 						// Do it only when selection is not locked. (#8222)
1224 						if ( sel && !sel.isLocked )
1225 						{
1226 							var isDirty = editor.checkDirty();
1227 							editor.fire( 'saveSnapshot', { contentOnly : 1 } );
1228 							onSelectionChangeFixBody.call( this, evt );
1229 							editor.fire( 'updateSnapshot' );
1230 							!isDirty && editor.resetDirty();
1231 						}
1232 
1233 					}, null, null, 1 );
1234 				});
1235 
1236 			editor.on( 'contentDom', function()
1237 				{
1238 					var title = editor.document.getElementsByTag( 'title' ).getItem( 0 );
1239 					title.data( 'cke-title', editor.document.$.title );
1240 
1241 					// [IE] JAWS will not recognize the aria label we used on the iframe
1242 					// unless the frame window title string is used as the voice label,
1243 					// backup the original one and restore it on output.
1244 					CKEDITOR.env.ie && ( editor.document.$.title = frameLabel );
1245 				});
1246 
1247 			editor.on( 'readOnly', function()
1248 				{
1249 					if ( editor.mode == 'wysiwyg' )
1250 					{
1251 						// Symply reload the wysiwyg area. It'll take care of read-only.
1252 						var wysiwyg = editor.getMode();
1253 						wysiwyg.loadData( wysiwyg.getData() );
1254 					}
1255 				});
1256 
1257 			// IE>=8 stricts mode doesn't have 'contentEditable' in effect
1258 			// on element unless it has layout. (#5562)
1259 			if ( CKEDITOR.document.$.documentMode >= 8 )
1260 			{
1261 				editor.addCss( 'html.CSS1Compat [contenteditable=false]{ min-height:0 !important;}' );
1262 
1263 				var selectors = [];
1264 				for ( var tag in CKEDITOR.dtd.$removeEmpty )
1265 					selectors.push( 'html.CSS1Compat ' + tag + '[contenteditable=false]' );
1266 				editor.addCss( selectors.join( ',' ) + '{ display:inline-block;}' );
1267 			}
1268 			// Set the HTML style to 100% to have the text cursor in affect (#6341)
1269 			else if ( CKEDITOR.env.gecko )
1270 			{
1271 				editor.addCss( 'html { height: 100% !important; }' );
1272 				editor.addCss( 'img:-moz-broken { -moz-force-broken-image-icon : 1;	min-width : 24px; min-height : 24px; }' );
1273 			}
1274 
1275 			/* #3658: [IE6] Editor document has horizontal scrollbar on long lines
1276 			To prevent this misbehavior, we show the scrollbar always */
1277 			/* #6341: The text cursor must be set on the editor area. */
1278 			/* #6632: Avoid having "text" shape of cursor in IE7 scrollbars.*/
1279 			editor.addCss( 'html {	_overflow-y: scroll; cursor: text;	*cursor:auto;}' );
1280 			// Use correct cursor for these elements
1281 			editor.addCss( 'img, input, textarea { cursor: default;}' );
1282 
1283 			// Disable form elements editing mode provided by some browers. (#5746)
1284 			editor.on( 'insertElement', function ( evt )
1285 			{
1286 				var element = evt.data;
1287 				if ( element.type == CKEDITOR.NODE_ELEMENT
1288 						&& ( element.is( 'input' ) || element.is( 'textarea' ) ) )
1289 				{
1290 					// We should flag that the element was locked by our code so
1291 					// it'll be editable by the editor functions (#6046).
1292 					var readonly = element.getAttribute( 'contenteditable' ) == 'false';
1293 					if ( !readonly )
1294 					{
1295 						element.data( 'cke-editable', element.hasAttribute( 'contenteditable' ) ? 'true' : '1' );
1296 						element.setAttribute( 'contenteditable', false );
1297 					}
1298 				}
1299 			});
1300 
1301 		}
1302 	});
1303 
1304 	// Fixing Firefox 'Back-Forward Cache' break design mode. (#4514)
1305 	if ( CKEDITOR.env.gecko )
1306 	{
1307 		(function()
1308 		{
1309 			var body = document.body;
1310 
1311 			if ( !body )
1312 				window.addEventListener( 'load', arguments.callee, false );
1313 			else
1314 			{
1315 				var currentHandler = body.getAttribute( 'onpageshow' );
1316 				body.setAttribute( 'onpageshow', ( currentHandler ? currentHandler + ';' : '') +
1317 							'event.persisted && (function(){' +
1318 								'var allInstances = CKEDITOR.instances, editor, doc;' +
1319 								'for ( var i in allInstances )' +
1320 								'{' +
1321 								'	editor = allInstances[ i ];' +
1322 								'	doc = editor.document;' +
1323 								'	if ( doc )' +
1324 								'	{' +
1325 								'		doc.$.designMode = "off";' +
1326 								'		doc.$.designMode = "on";' +
1327 								'	}' +
1328 								'}' +
1329 						'})();' );
1330 			}
1331 		} )();
1332 
1333 	}
1334 })();
1335 
1336 /**
1337  * Disables the ability of resize objects (image and tables) in the editing
1338  * area.
1339  * @type Boolean
1340  * @default false
1341  * @example
1342  * config.disableObjectResizing = true;
1343  */
1344 CKEDITOR.config.disableObjectResizing = false;
1345 
1346 /**
1347  * Disables the "table tools" offered natively by the browser (currently
1348  * Firefox only) to make quick table editing operations, like adding or
1349  * deleting rows and columns.
1350  * @type Boolean
1351  * @default true
1352  * @example
1353  * config.disableNativeTableHandles = false;
1354  */
1355 CKEDITOR.config.disableNativeTableHandles = true;
1356 
1357 /**
1358  * Disables the built-in words spell checker if browser provides one.<br /><br />
1359  *
1360  * <strong>Note:</strong> Although word suggestions provided by browsers (natively) will not appear in CKEditor's default context menu,
1361  * users can always reach the native context menu by holding the <em>Ctrl</em> key when right-clicking if {@link CKEDITOR.config.browserContextMenuOnCtrl}
1362  * is enabled or you're simply not using the context menu plugin.
1363  *
1364  * @type Boolean
1365  * @default true
1366  * @example
1367  * config.disableNativeSpellChecker = false;
1368  */
1369 CKEDITOR.config.disableNativeSpellChecker = true;
1370 
1371 /**
1372  * Whether the editor must output an empty value ("") if it's contents is made
1373  * by an empty paragraph only.
1374  * @type Boolean
1375  * @default true
1376  * @example
1377  * config.ignoreEmptyParagraph = false;
1378  */
1379 CKEDITOR.config.ignoreEmptyParagraph = true;
1380 
1381 /**
1382  * Fired when data is loaded and ready for retrieval in an editor instance.
1383  * @name CKEDITOR.editor#dataReady
1384  * @event
1385  */
1386 
1387 /**
1388  * Whether automatically create wrapping blocks around inline contents inside document body,
1389  * this helps to ensure the integrality of the block enter mode.
1390  * <strong>Note:</strong> Changing the default value might introduce unpredictable usability issues.
1391  * @name CKEDITOR.config.autoParagraph
1392  * @since 3.6
1393  * @type Boolean
1394  * @default true
1395  * @example
1396  * config.autoParagraph = false;
1397  */
1398 
1399 /**
1400  * Fired when some elements are added to the document
1401  * @name CKEDITOR.editor#ariaWidget
1402  * @event
1403  * @param {Object} element The element being added
1404  */
1405 
