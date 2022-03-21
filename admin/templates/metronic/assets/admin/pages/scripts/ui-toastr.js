var UIToastr = function () {

    return {
        //main function to initiate the module
        init: function () {

            var i = -1,
                toastCount = 0,
                $toastlast;

            $('#showtoast').click(function () {

				var shortCutFunction = "info";
				var msg = "AA";
				var title = "TITULO";

                var toastIndex = toastCount++;

				toastr.options = {
					closeButton: true,
					debug: false,
					positionClass: 'toast-top-center',
					onclick: null
				};
	
				toastr.options.showDuration = "1000";
				toastr.options.hideDuration = "1000";
				toastr.options.timeOut = "5000";
				toastr.options.extendedTimeOut = "1000";
				toastr.options.showEasing = "swing";
				toastr.options.hideEasing = "linear";
				toastr.options.showMethod = "fadeIn";
				toastr.options.hideMethod = "fadeOut";
	

                var $toast = toastr[shortCutFunction](msg, title); // Wire up an event handler to a button in the toast, if it exists
            });

        }

    };

}();