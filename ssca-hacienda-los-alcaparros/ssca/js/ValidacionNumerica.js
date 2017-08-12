function soloNumeros(e){
	//var key = window.Event ? e.which : e.keyCode
	//return (key >= 48 && key <= 57)
	var keynum = window.event ? window.event.keyCode : e.which;
	if ((keynum == 8) || (keynum == 46))
	return true;
	 
	return /\d/.test(String.fromCharCode(keynum));
}
//Código para colocar
//los indicadores de miles mientras se escribe
//script por tunait!
function format(input)
{
	var num = input.value.replace(/\./g,'');
	if(!isNaN(num)){
		num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
		num = num.split('').reverse().join('').replace(/^[\.]/,'');
		input.value = num;
	}
	else{ 
		input.value = input.value.replace(/[^\d\.]*/g,'');
	}
}