<?php 

namespace globalcms\components\utils;

/**
 * $File$
 *
 * @author $Author$
 * @link http://www.codebit.org/
 * @copyright Copyright &copy; 2013-2015 Codebit
 * @license http://www.codebit.org/license/
 */

/**
 * Funciones para el manejo de archivos y directorios del sistema.
 * 
 * $Source$
 * $File$
 * @package system.utils
 * @version $Id$
 * @license http://www.codebit.org/licence
 * @copyright Copyright (c) 2013, Julio Barrera & Jefferson Arrubla
 * @author   $Author$
 * @since   # $Date$
*/
class Files implements iFiles
{
	/**
	 * @constant(const)
	 */
	const PERMISSION_EXPECTED = '0777';

	/**
	 * Dirección del directorio o archivo con el que se interactuará sea para su análisis o manejo.
	 * @var string
	 */
	private $root_dir = null;

	/**
	 * Acceso via web
	 * @var string
	 */
	private $webaccess = null;

	/**
	 * Manejo recursivo de los directorios.
	 * @var boolean
	 */
	private $recursive = true;

	/**
	 * Si es true entonces es un archivo, si es false es un directorio
	 * @var boolean
	 */
	private $isFile = false;

	/**
	 * Construye el objeto pasandole la url de acceso via web, si existiera.
	 * @param string $webaccess_url Acceso via web al recurso
	 */
	function __construct($webaccess_url = null) {
		$this->webaccess = $webaccess_url;
	}

	/**
	 * Configura parámetros de acceso continuo
	 * @param string $name  Nombre del parámetro a configurar
	 * @param string $value Valor
	 */
	public function __set($name, $value) {
		switch ($name) {
			case 'recursive':
				$this->recursive = (boolean)$value;
				break;
			
			case 'rootDir':
				/** @todo: Verificar que el directorio o archivo exista */
				$this->rootDir = $value;
				break;
			default:
				# code...
				break;
		}
	}

	/**
	 * Devuelve la ruta actual donde se localiza el archivo en base al enlace global que se le pasa a la clase
	 * Ejemplo si el archivo se localiza en la raíz del sitio /language/admin/messages, y la URL que se pasa como base es
	 * http://www.url.com/, la URL retornada será:
	 * http://www.url.com/language/admin/messages
	 * @return string URL con la cual podremos acceder al archivo
	 */
	public function getDirFileAsLink() {}

	/**
	 * Permite la lectura del fichero, siempre deberemos asegurarnos que este sea un archivo
	 * en otro caso deberemos retornar false, ya que no permitiremos la lectura de un directorio.
	 * @param  string $rootFile Dirección del archivo a leer
	 * @return string           Contenido leido.
	 */
	public function readContent($rootFile) {}

	/**
	 * Lee el contenido del archivo y devuelve su contenido en una variable.
	 * @param  string $rootFile Dirección del archivo
	 * @return array           Colección de datos contenidas en el archivo
	 */
	public function readContentAsArray($rootFile) {
		//Comprobamos la existencia del archivo
		$this->isDirFileExists($rootFile);

		return (array)include_once($rootFile);
	}

	/**
	 * Verifica si el archivo $file es un directorio o un archivo.
	 * @return boolean Si es un directorio retorna true en otro caso false;
	 */
	function isFile() {}

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
	 * @return boolean Si todo fue correcto true, false en caso contrario
	 */
	public function bufferToSave($file, $content, regexp $regexp = null, $position = null, $partial = false) {
		//Verificamos si el archivo cuenta con el permiso correcto para reescribirlo
		if (!($this->isPermissionWork($file, self::PERMISSION_EXPECTED, true))) return false;

		//Modo de apertura del fichero
		if($partial) $mode = 'w';
		else $mode = 'a';

		$fp=fopen($file, $mode);

		fwrite($fp, $content);

		//Cerramos el fichero
		fclose($fp);

		return true;
	}

	/**
	 * Verifica si el archivo o directorio existe
	 * @param  string  $file Ruta del directorio o archivo donde se hará la búsqueda
	 * @return boolean       True si existe, false en caso contrario;
	 */
	public function isDirFileExists($file) {
		if(!file_exists($file)) return false;
		return true;
	}

	/**
	 * Verifica si el archivo o directorio tiene los permisos adecuados, si $perms se especifica, entonces
	 * se verifica en base a estos permisos.
	 * @throws UnkownPerms If $perms contiene una mala configuración
	 * @param  string  $file Ruta del archivo o directorio
	 * @param  string $perms formato de permiso que se desea verificar.
	 * @param  string $applyPerms Si es verdadero entonces se intentará aplicar el permiso a $perms
	 * @return boolean       True si todo fue correcto, false en caso contrario
	 */
	public function isPermissionWork($file, $perms = '0777', $applyPerms = false) {
		if(!$this->isDirFileExists($file)) throw new Exception(Yii::t('El archivo {{filename}} no existe', array('{{filename}}' => $file)), 1);

		$perms_real = substr(sprintf('%o', fileperms($file)), -4);

		if($perms_real != $perms) {
			//Intenamos aplicar el permiso
			if($applyPerms && !$this->chmodApply($file, $perms)) return false;
		}

		return true;
	}

	/**
	 * Lee el contenido de un directorio
	 * @throws NotIsDirectory If Si no es un directorio
	 * @param  string $root      Ruta del directorio
	 * @param  boolean $recursive Si se omite este parámetro entonces se toma el que se haya configurado en la propiedad recursive
	 * @return Directory[]            Devuelve la colección de directorios que estan almacenados en $root, la colección contiene propiedades para acceder a un vinculo
	 * dispuesto en base a la propiedad baseURL.
	 */
	public function readTreeDirectory($root, $recursive = null) {
		if(!$recursive) $recursive = $this->recursive;

		//Si no es un directorio generamos una excepción.
		if(!is_dir($root)){ throw new Exceptions\NotIsDirectoryException(\Yii::t('adminModule.errors', '{{dir}} no es un directorio.', array('{{dir}}' => $root))); }

		$gdir = opendir($root);

		if(!$gdir) return null;

		\Yii::trace('Leemos la estructura del directorio');

		$directories = array();

		while(($dir = readdir($gdir))) {
			if($dir == '.' || $dir == '..')
				continue;

			$directory = new Directory\Directory;

			$directory->setAttributes(array(
				 'name' => $dir
				,'link' => $this->webaccess
			));

			array_push($directories, $directory);
		}

		return $directories;
	}

	/**
	 * Intenta cambiar los permisos de un archivo
	 * @param  string $file  Archivo al que se le cambiarán los permisos
	 * @param  string $perms Permisos en formato octal
	 * @return boolean        Si fue satisfactorio el cambio true, entonces false
	 */
	public function chmodApply($file, $perms) {
		if(!preg_match('/^\d{3,4}$/', $perms)) return false;

		if(!($result = (boolean)@chmod($file, $perms))) return false;

		return true;
	}
}