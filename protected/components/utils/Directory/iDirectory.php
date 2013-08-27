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
interface iDirectory {
	/**
	 * Nombre del directorio
	 * @param string $name
	 */
	public function setName($name);

	/**
	 * Enlace de acceso al directorio
	 * @param string $link
	 */
	public function setLink($link);

	/**
	 * Tamaño del directorio
	 * @param float $bytes
	 */
	public function setBytes($bytes);

	/**
	 * Devuelve el nombre del directorio
	 * @return string
	 */
	public function getName();

	/**
	 * Devuelve el enlace de acceso al directorio
	 * @return string
	 */
	public function getLink();

	/**
	 * Devuelve el tamaño del directorio
	 * @return float
	 */
	public function getBytes();

	/**
	 * Configura la colección de parámetros coincidentes con las propiedades de la clase Directory
	 * @throws UnknowAttributr If Si no existe el atributo
	 * @param array $attributes
	 */
	public function setAttributes(array $attributes);

	/**
	 * Retorna la colección de atributos, configurados anteriormente.
	 * @return array
	 */
	public function getAttributes();
}