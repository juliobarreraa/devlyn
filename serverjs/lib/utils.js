var UTILS_REMOVE_ITEMS = 1;

// Queue class adapted from Tim Caswell's pattern library
// http://github.com/creationix/pattern/blob/master/lib/pattern/queue.js
var utils = utils || {};


/**
 * Devuelve el tamaño de un objeto
 * @param  {object} obj El objeto para el cual se determinará su tamaño
 * @return {integer}     Tamaño del objeto
 */
utils.getLength = function (obj) {
	var count = 0;

	for(x in obj) count++;
	return count;
};

/**
 * Elimina un elemento de un objeto
 * @param  {Object} obj            Objeto del cual será eliminado el elemento.
 * @param  {string} item           Elemento que será eliminado
 * @param  {integer} lengthToRemove elementos a eliminar, por defecto será uno
 * @return {Object}                Colección sin el dato eliminado
 */
utils.remove = function (obj, item, lengthToRemove) {
	if(typeof lengthToRemove == 'undefined') lengthToRemove = UTILS_REMOVE_ITEMS;
	var index = this.search(obj, item);
	//Devolvemos el objeto sin el elemento eliminado
    return obj.splice(index, lengthToRemove);
};

/**
 * Realiza una busqueda en un objeto y devuelve el indice donde se encuentra el mismo.
 * @param  {Object} obj  Objeto donde se realiza la búsqueda
 * @param  {string} item Coincidencia a encontrar
 * @return {integer}      Indice de coincidencia
 */
utils.search = function (obj, item) {
	for (var x in obj) {
		if(obj[x] == item)
			return x;
	}

    return null;
};

/**
 * Verifica que number sea un número
 * @param  {integer} number
 * @return {boolean} Si no es un número devuelve false, si es un número true
 */	
utils.isNumber = function(number) {
  return !isNaN(parseFloat(number)) && isFinite(number);
}


/**
 * Devuelve la cadena formateada sin caracteres especiales
 * @param  {string} str Cadena que será formateada
 * @return {string}
 */
utils.htmlEncode = function(str){
	var i = str.length,
  	aRet = [];

  	while (i--) {
  		var iC = str[i].charCodeAt();
  		if (iC < 65 || iC > 127 || (iC>90 && iC<97)) {
  			aRet[i] = '&#'+iC+';';
  		} else {
  			aRet[i] = str[i];
  		}
  	}
  	return aRet.join('').replace(/[\r\n]/g, '');
}

/**
 * Devuelve la cadena sin espacios iniciales
 * @param  {string} str
 * @return {string}
 */
utils.trim = function(str)
{
	return str.replace(/^\s+/g,'').replace(/\s+$/g,'')
}

/**
 * Devuelve la fecha formateada
 * @return {string}
 */
utils.getDate = function() {
	//Fecha actual
	var today = new Date();
	//Obtiene el día
	var dd = today.getDate();
	//Obtiene el mes y suma 1 para obtener un mes real
	var mm = today.getMonth()+1; //January is 0!
	//Obtiene el año en cuatro digitos
	var yyyy = today.getFullYear();

	if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = dd+'/'+mm+'/'+yyyy;

	return today;
}

module.exports = utils;
