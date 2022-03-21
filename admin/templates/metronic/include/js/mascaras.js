function sem_acento(e,args) {           	
	if (document.all){ 
		var evt=event.keyCode; 
	} else {
		var evt = e.charCode;
	}
	var valid_chars = '0123456789abcdefghijlmnopqrstuvxzwykABCDEFGHIJLMNOPQRSTUVXZWYK-_/@.'+args;      // criando a lista de teclas permitidas
	var chr= String.fromCharCode(evt);      // pegando a tecla digitada
	if (valid_chars.indexOf(chr)>-1 ){return true;} // se a tecla estiver na lista de permissão permite-a
	// para permitir teclas como <BACKSPACE> adicionamos uma permissão para 
	// códigos de tecla menores que 09 por exemplo (geralmente uso menores que 20)
	if (valid_chars.indexOf(chr)>-1 || evt < 9){return true;} 
	if (valid_chars.indexOf(chr)>30 || evt <35){return false;} //permite a tecla espaço
	return false;   // do contrário nega
}

function mascara_manual2(VALOR,MASCARA) {
	//var kcode = (window.event) ? evt.keyCode : evt.which;

	/*
	if(navigator.appName == "Netscape") {
		kcode = event.charCode; //or e.which; (standard method)
	} else {
		kcode = event.keyCode;
	}*/

	var evt = window.event;
	kcode = evt.keyCode;
	if (kcode == 8) return;
	
	if(MASCARA=="CPF") {
		if (VALOR.value.length == 3) { VALOR.value = VALOR.value + '.'; }
		if (VALOR.value.length == 7) { VALOR.value = VALOR.value + '.'; }
		if (VALOR.value.length == 11) { VALOR.value = VALOR.value + '-'; }
	} else {
		if(MASCARA=="DATA") {
			if (VALOR.value.length == 2) { VALOR.value = VALOR.value + '/'; }
			if (VALOR.value.length == 5) { VALOR.value = VALOR.value + '/'; }
		} else {
			if(MASCARA=="CEL") {
				if (VALOR.value.length == 1) { VALOR.value =  '(' + VALOR.value; }
				if (VALOR.value.length == 3) { VALOR.value = VALOR.value + ') '; }
				if (VALOR.value.length == 10) { VALOR.value = VALOR.value + '.'; }
			} else {
				if(MASCARA=="RES") {
					if (VALOR.value.length == 1) { VALOR.value =  '(' + VALOR.value; }
					if (VALOR.value.length == 3) { VALOR.value = VALOR.value + ') '; }
					if (VALOR.value.length == 9) { VALOR.value = VALOR.value + '.'; }
				} else {
					if(MASCARA=="CEP") {
						if (VALOR.value.length == 5) { VALOR.value = VALOR.value + '-'; }
					} else {
					}
				}
			}
		}
	}
}

function mascara(o,f){

	v_obj=o

	v_fun=f

	setTimeout("execmascara()",1)

}



function execmascara(){

	v_obj.value=v_fun(v_obj.value)

}



function leech(v){

	v=v.replace(/o/gi,"0")

	v=v.replace(/i/gi,"1")

	v=v.replace(/z/gi,"2")

	v=v.replace(/e/gi,"3")

	v=v.replace(/a/gi,"4")

	v=v.replace(/s/gi,"5")

	v=v.replace(/t/gi,"7")

	return v

}



function soNumeros(v){

	return v.replace(/\D/g,"")

}



function telefone(v){

	v=v.replace(/\D/g,"") //Remove tudo o que não é dígito

	v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos

	v=v.replace(/(\d{4})(\d)/,"$1 - $2") //Coloca hífen entre o quarto e o quinto dígitos

	return v

}



function cpf(v){

	v=v.replace(/\D/g,"") //Remove tudo o que não é dígito

	v=v.replace(/(\d{3})(\d)/,"$1.$2") //Coloca um ponto entre o terceiro e o quarto dígitos

	v=v.replace(/(\d{3})(\d)/,"$1.$2") //Coloca um ponto entre o terceiro e o quarto dígitos

	//de novo (para o segundo bloco de números)

	v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos

	return v

}



function cep(v){

	v=v.replace(/\D/g,"") //Remove tudo o que não é dígito

	v=v.replace(/(\d{2})(\d)/,"$1.$2") //Coloca um ponto entre o terceiro e o quarto dígitos

	v=v.replace(/(\d{3})(\d{1,3})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos

	return v

}



function cnpj(v){

	v=v.replace(/\D/g,"") //Remove tudo o que não é dígito

	v=v.replace(/^(\d{2})(\d)/,"$1.$2") //Coloca ponto entre o segundo e o terceiro dígitos

	v=v.replace(/^(\d{2}).(\d{3})(\d)/,"$1.$2.$3") //Coloca ponto entre o quinto e o sexto dígitos

	v=v.replace(/.(\d{3})(\d)/,".$1/$2") //Coloca uma barra entre o oitavo e o nono dígitos

	v=v.replace(/(\d{4})(\d)/,"$1-$2") //Coloca um hífen depois do bloco de quatro dígitos

	return v

}



function romanos(v){

	v=v.toUpperCase() //Maiúsculas

	v=v.replace(/[^IVXLCDM]/g,"") //Remove tudo o que não for I, V, X, L, C, D ou M

	//Essa é complicada! Copiei daqui: http://www.diveintopython.org/refactoring/refactoring.html23

	while(v.replace(/^M{0,4}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/,"")!="")

	v=v.replace(/.$/,"")

	return v

}



function site(v){

	//Esse sem comentarios para que você entenda sozinho :wink:

	v=v.replace(/^http:\/\/?/,"")

	dominio=v

	caminho=""

	if(v.indexOf("/")>-1)

	dominio=v.split("/")[0]

	caminho=v.replace(/[^\/]*/,"")

	dominio=dominio.replace(/[^\w.+-:@]/g,"")

	caminho=caminho.replace(/[^\w\d+-@:\?&=%().]/g,"")

	caminho=caminho.replace(/([\?&])=/,"$1")

	if(caminho!="")dominio=dominio.replace(/.+$/,"")

	v="http://"+dominio+caminho

	return v

}



function data(v){

	v=v.replace(/\D/g,"") //Remove tudo o que não é dígito

	v=v.replace(/^(\d{2})(\d)/,"$1/$2") //Coloca ponto entre o segundo e o terceiro dígitos

	v=v.replace(/.(\d{2})(\d)/,".$1/$2") //Coloca uma barra entre o oitavo e o nono dígitos

	v=v.replace(/(\d{2})(\d)/,"$1/$2") //Coloca um hífen depois do bloco de quatro dígitos

	return v

}



function moeda(v){ 

	v=v.replace(/\D/g,"") // permite digitar apenas numero 

	v=v.replace(/(\d{1})(\d{17})$/,"$1.$2") // coloca ponto antes dos ultimos digitos 

	v=v.replace(/(\d{1})(\d{13})$/,"$1.$2") // coloca ponto antes dos ultimos 13 digitos 

	v=v.replace(/(\d{1})(\d{10})$/,"$1.$2") // coloca ponto antes dos ultimos 10 digitos 

	v=v.replace(/(\d{1})(\d{7})$/,"$1.$2") // coloca ponto antes dos ultimos 7 digitos 

	v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2") // coloca virgula antes dos ultimos 4 digitos 

	v="R$ "+v

	return v;

}

function moedaSemCifrao(v){ 

	v=v.replace(/\D/g,"") // permite digitar apenas numero 

	v=v.replace(/(\d{1})(\d{17})$/,"$1.$2") // coloca ponto antes dos ultimos digitos 

	v=v.replace(/(\d{1})(\d{13})$/,"$1.$2") // coloca ponto antes dos ultimos 13 digitos 

	v=v.replace(/(\d{1})(\d{10})$/,"$1.$2") // coloca ponto antes dos ultimos 10 digitos 

	v=v.replace(/(\d{1})(\d{7})$/,"$1.$2") // coloca ponto antes dos ultimos 7 digitos 

	v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2") // coloca virgula antes dos ultimos 4 digitos 

	v=""+v

	return v;

}

function medidasKg(v){ 

	v=v.replace(/\D/g,"") // permite digitar apenas numero 

	v=v.replace(/(\d{1})(\d{1,1})$/,"$1.$2") // coloca virgula antes dos ultimos 4 digitos 

	v=""+v

	return v;

}

function medidas(v){ 

	v=v.replace(/\D/g,"") // permite digitar apenas numero 

	v=v.replace(/(\d{1})(\d{1,1})$/,"$1.$2") // coloca virgula antes dos ultimos 4 digitos 

	v=""+v

	return v;

}


function moedasemcifrao(v){ 

	v=v.replace(/\D/g,"") // permite digitar apenas numero 

	v=v.replace(/(\d{1})(\d{17})$/,"$1.$2") // coloca ponto antes dos ultimos digitos 

	v=v.replace(/(\d{1})(\d{13})$/,"$1.$2") // coloca ponto antes dos ultimos 13 digitos 

	v=v.replace(/(\d{1})(\d{10})$/,"$1.$2") // coloca ponto antes dos ultimos 10 digitos 

	v=v.replace(/(\d{1})(\d{7})$/,"$1.$2") // coloca ponto antes dos ultimos 7 digitos 

	v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2") // coloca virgula antes dos ultimos 4 digitos 

	v=""+v

	return v;

}

function calcula_porcentagem(v) {
	v=v.replace(/\D/g,""); // permite digitar apenas numero 

	v=v.replace(/(\d{1})(\d{17})$/,"$1.$2"); // coloca ponto antes dos ultimos digitos 

	v=v.replace(/(\d{1})(\d{13})$/,"$1.$2"); // coloca ponto antes dos ultimos 13 digitos 

	v=v.replace(/(\d{1})(\d{10})$/,"$1.$2"); // coloca ponto antes dos ultimos 10 digitos 

	v=v.replace(/(\d{1})(\d{7})$/,"$1.$2"); // coloca ponto antes dos ultimos 7 digitos 

	v=v.replace(/(\d{1})(\d{1,2})$/,"$1,$2"); // coloca virgula antes dos ultimos 4 digitos 

	v="R$ "+v;

	var valor_original = $("#ticket_valor").val();
	for (i = 0; i < 10; i++) {
		valor_original = valor_original.replace(".", "");
	}
	
	console.log(valor_original);
	
	var porcentagem = parseInt($("#taxa_com_ccr").val()) / 100;

	var valor_calculado = parseInt(porcentagem) * parseInt(valor_original);
	
	var valor_final = valor_original;

	valor_final=valor_final.replace(/\D/g,""); // permite digitar apenas numero 

	valor_final=valor_final.replace(/(\d{1})(\d{17})$/,"$1.$2"); // coloca ponto antes dos ultimos digitos 

	valor_final=valor_final.replace(/(\d{1})(\d{13})$/,"$1.$2"); // coloca ponto antes dos ultimos 13 digitos 

	valor_final=valor_final.replace(/(\d{1})(\d{10})$/,"$1.$2"); // coloca ponto antes dos ultimos 10 digitos 

	valor_final=valor_final.replace(/(\d{1})(\d{7})$/,"$1.$2"); // coloca ponto antes dos ultimos 7 digitos 

	valor_final=valor_final.replace(/(\d{1})(\d{1,2})$/,"$1,$2"); // coloca virgula antes dos ultimos 4 digitos 

	valor_final="R$ "+valor_final;

	$("#ticket_valor_taxa_com_ccr").val(valor_final);

	return v;

}

function hora(v){

	v=v.replace(/\D/g,"") //Remove tudo o que não é dígito

	v=v.replace(/(\d{2})(\d)/,"$1:$2") //Coloca um ponto entre o terceiro e o quarto dígitos

	return v

}

