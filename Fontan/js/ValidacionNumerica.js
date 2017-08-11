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
	num = $.trim(num);
	if(!isNaN(num)){
		num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
		num = num.split('').reverse().join('').replace(/^[\.]/,'');
		input.value = num;
	}
	else{ 
		input.value = input.value.replace(/[^\d\.]*/g,'');
	}
}

function currency(value, decimals, separators) {
  decimals = decimals >= 0 ? parseInt(decimals, 0) : 2;
  separators = separators || ['.', "'", ','];
  var number = (parseFloat(value) || 0).toFixed(decimals);
  if (number.length <= (4 + decimals))
      return number.replace('.', separators[separators.length - 1]);
  var parts = number.split(/[-.]/);
  value = parts[parts.length > 1 ? parts.length - 2 : 0];
  var result = value.substr(value.length - 3, 3) + (parts.length > 1 ?
      separators[separators.length - 1] + parts[parts.length - 1] : '');
  var start = value.length - 6;
  var idx = 0;
  while (start > -3) {
      result = (start > 0 ? value.substr(start, 3) : value.substr(0, 3 + start))
          + separators[idx] + result;
      idx = (++idx) % 2;
      start -= 3;
  }
  return (parts.length == 3 ? '-' : '') + result;
}