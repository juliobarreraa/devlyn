<?php
namespace globalcms\components\utils;

/**
 * $Source$
 * $File$
 * @version $Id$
 * @license http://www.codebit.org/licence
 * @copyright Copyright (c) 2013, Julio Barrera & Jefferson Arrubla
 * @author   $Author$
 * @since   # $Date$
*/
interface iFiles {
	/**
	 * Devuelve la ruta actual donde se localiza el archivo en base al enlace global que se le pasa a la clase
	 * Ejemplo si el archivo se localiza en la raíz del sitio /language/admin/messages, y la URL que se pasa como base es
	 * http://www.url.com/, la URL retornada será:
	 * http://www.url.com/language/admin/messages
	 * @return string URL con la cual podremos acceder al archivo
	 */
	public function getDirFileAsLink();

	/**
	 * Permite la lectura del fichero, siempre deberemos asegurarnos que este sea un archivo
	 * en otro caso deberemos retornar false, ya que no permitiremos la lectura de un directorio.
	 * @param  string $rootFile Dirección del archivo a leer
	 * @return string           Contenido leido.
	 */
	public function readContent($rootFile);

	/**
	 * Lee el contenido del archivo y devuelve su contenido en una variable.
	 * @param  string $rootFile Dirección del archivo
	 * @return array           Colección de datos contenidas en el archivo
	 */
	public function readContentAsArray($rootFile);

	/**
	 * Verifica si el archivo $file es un directorio o un archivo.
	 * @return boolean Si es un directorio retorna true en otro caso false;
	 */
	function isFile();

	/**
	 * Almacena el contenido del buffer en el archivo especificado.
	 * @throws FileNotFound If El archivo no existe
	 * @throws PermissionDennied If No se tiene configurados los permisos correctamente
	 * @throws UnknkowError If Se desconoce el origen del error.
	 * @param  string $file    Ruta del archivo donde se guardara el contenido
	 * @param  string $content Contenido que será guardado en el fichero
	 * @param  array $position Posición a partir de la cual se vacia el contenido del archivo strlen($content) bytes el segundo parámetro
	 * indicará el tamaño de caracteres que sustituira, si no se especifica sustituira hasta el fin del archivo.
	 * @param  regexp Si se indica la expresión regular, entonces se buscará las coincidencias las cuales será sustituidas con $content
	 * @param  boolean $partial Indica si el guardado sustituye el contenido del fichero o busca la posición exacta donde almacenar el mismo.
	 * @return void
	 */
	public function bufferToSave($file, $content, regexp $regexp = null, $position = null, $partial = false);

	/**
	 * Lee el contenido de un directorio
	 * @param  string $root      Ruta del directorio
	 * @param  boolean $recursive Si se omite este parámetro entonces se toma el que se haya configurado en la propiedad recursive
	 * @return Directory[]            Devuelve la colección de directorios que estan almacenados en $root, la colección contiene propiedades para acceder a un vinculo
	 * dispuesto en base a la propiedad baseURL.
	 */
	public function readTreeDirectory($root, $recursive);

	/**
	 * Verifica si el archivo o directorio existe
	 * @param  string  $file Ruta del directorio o archivo donde se hará la búsqueda
	 * @return boolean       True si existe, false en caso contrario;
	 */
	public function isDirFileExists($file);

	/**
	 * Verifica si el archivo o directorio tiene los permisos adecuados, si $perms se especifica, entonces
	 * se verifica en base a estos permisos.
	 * @throws UnkownPerms If $perms contiene una mala configuración
	 * @param  string  $file Ruta del archivo o directorio
	 * @param  string $perms formato de permiso que se desea verificar.
	 * @return boolean       True si todo fue correcto, false en caso contrario
	 */
	public function isPermissionWork($file, $perms = '0777');
}