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

function mascara_manual(VALOR,MASCARA) {
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

function formatar_samsung(mascara, documento){
  var i = documento.value.length;
  var saida = mascara.substring(0,1);
  var texto = mascara.substring(i)
  
  if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
  }
  
}

function mascara_site(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara_mascara()",1)
}

function execmascara_mascara(){
    v_obj.value=v_fun(v_obj.value)
}

function leech_mascara(v){
    v=v.replace(/o/gi,"0")
    v=v.replace(/i/gi,"1")
    v=v.replace(/z/gi,"2")
    v=v.replace(/e/gi,"3")
    v=v.replace(/a/gi,"4")
    v=v.replace(/s/gi,"5")
    v=v.replace(/t/gi,"7")
    return v
}

function soNumeros_mascara(v){
    return v.replace(/\D/g,"")
}

function telefone_mascara(v){
    v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
    v=v.replace(/^(\d\d)(\d)/g,"($1) $2") //Coloca parênteses em volta dos dois primeiros dígitos
    v=v.replace(/(\d{5})(\d)/,"$1-$2")    //Coloca hífen entre o quarto e o quinto dígitos
    return v
}

function data_mascara(v){
    v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{2})(\d)/,"$1/$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{2})(\d)/,"$1/$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    return v
}

function cep_mascara(v){
    v=v.replace(/D/g,"")                //Remove tudo o que não é dígito
    v=v.replace(/^(\d{5})(\d)/,"$1-$2") //Esse é tão fácil que não merece explicações
    return v
}

function cpf_mascara(v){
    v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                             //de novo (para o segundo bloco de números)
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
    return v
}