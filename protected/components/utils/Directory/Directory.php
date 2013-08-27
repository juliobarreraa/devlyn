<?php 
namespace globalcms\components\utils\Directory;

/**
 * $Source$
 * $File$
 * @version $Id$
 * @license http://www.codebit.org/licence
 * @copyright Copyright (c) 2013, Julio Barrera & Jefferson Arrubla
 * @author   $Author$
 * @since   # $Date$
*/
class Directory implements iDirectory
{
	/**
	 * Nombre del directorio
	 * @var string
	 */
	private $name;

	/**
	 * URL de acceso al directorio
	 * @var string
	 */
	private $link;

	/**
	 * Tamaño del directorio
	 * @var float
	 */
	private $bytes;

	public function __get($name) {
		$property = \Helpers::getPropertyName($name);

		if(method_exists($this, $property)) {
			return $this->$property();
		}
	}

	/**
	 * Nombre del directorio
	 * @param string $name
	 */
	public function setName($name) {

	}

	/**
	 * Enlace de acceso al directorio
	 * @param string $link
	 */
	public function setLink($link) {}

	/**
	 * Tamaño del directorio
	 * @param float $bytes
	 */
	public function setBytes($bytes) {}

	/**
	 * Devuelve el nombre del directorio
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Devuelve el enlace de acceso al directorio
	 * @return string
	 */
	public function getLink() {}

	/**
	 * Devuelve el tamaño del directorio
	 * @return float
	 */
	public function getBytes() {}


	/**
	 * Configura la colección de parámetros coincidentes con las propiedades de la clase Directory
	 * @throws UnknowAttributr If Si no existe el atributo
	 * @param array $attributes
	 */
	public function setAttributes(array $attributes) {
		//Configuramos las propiedades que el usuario envio
		foreach ($attributes as $key => $value) {
			if(property_exists($this, $key))
				$this->$key = $value;
		}
	}

	/**
	 * Retorna la colección de atributos, configurados anteriormente.
	 * @return array
	 */
	public function getAttributes() {}
}