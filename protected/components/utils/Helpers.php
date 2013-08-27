<?php 
/**
 * $File$
 *
 * @author $Author$
 * @link http://www.codebit.org/
 * @copyright Copyright &copy; 2013-2015 Codebit
 * @license http://www.codebit.org/license/
 */

/**
 * $Source$
 * $File$
 * $Revision$
 * @version $Id$
 * @license http://www.codebit.org/licence
 * @copyright Copyright (c) 2013, Julio Barrera & Jefferson Arrubla
 * @author   $Author$
 * @since   # $Date$
*/
class Helpers
{
	/**
	 * Genera una contraseña aleatoria.
	 * @param  string $password Si es nulo se genera una nueva en caso contrario se toma la innicial
	 * @return string Contraseña generada
	 */
	static function generatePassword($password = null)
	{
		if( !$password )
		{
			$password = base_convert( mt_rand() . intval(microtime(true) * 100), 19, 36 );
		}

		return $password;
	}

	/**
	 * Genera un salto y una semilla para la creación de la contraseña
	 * @param  string $password Si es null se genera una nueva
	 * @return string[]           Se devuelve el salto y la semilla
	 */
	static function generateSecurityPassword($password = null)
	{
		self::generatePassword($password);
		//Generamos pass_salt
		$pass_salt =  base_convert( mt_rand() . intval(microtime(true) * 100), 19, 36 );

		$pass_hash = self::password_encrypt( $password, $pass_salt );

		/**
		 * Retornamos los elementos generado de forma dinámica en base a una contraseña
		 */
		return array( $pass_salt, $pass_hash );
	}

	/**
	 * Nos genera la hash final con la que será comparada la contraseña cuando el usuario intente identificarse
	 * @param  string $password  Contraseña a partir de cual se genera la hash
	 * @param  string $pass_salt Salto
	 * @return string            Generado hash
	 */
	static function password_encrypt( $password, $pass_salt ) {
		return md5( md5( $pass_salt ) . md5( $password ) );
	}

	/**
	 * Verifica si existe la colección de claves pasadas en $key_needed en $arr
	 * @param  string $keys_needed Colección de claves que serán buscadas, el formato es clave1|clave2|claveN
	 * @param  array  $arr        El arreglo donde se realizará la búsqueda
	 * @return boolean             Si en el arreglo no se encontrará una de las claves buscadas devolverá false, en caso contrario true.
	 */
	static function array_multi_key_exists($keys_needed, array $arr) {
		$keys = explode('|', $keys_needed);

		foreach($keys as $key)
			if(!array_key_exists($key, $arr))
				return false;

		return true;
	}

	/**
	 * Obtiene el nombre de la clase omitiendo el namespace, si este estuviera presente
	 * @param  string $class Nombre de la clase
	 * @return string
	 */
	static function get_class_name($class) {
    	$class = explode('\\', $class);
    	return end($class);
	}

	/**
	 * Devuelve la propiedad formateada para getters
	 * @param  string $name Nombre de la propiedad que quiere consultar
	 * @return string
	 */
	static function getPropertyName($name) {
		return 'get' . ucfirst($name);
	}


	/**
	 * Devuelve una cadena formateada según el tipo de dato.
	 * @param  object $data Dato que será formateado
	 * @return
	 */
	static function toString($data) {
		if(is_string($data)) {
			$data = ucfirst($data);
			$data = explode('.', $data);
		}

		return $data[0];
	}

	/**
	 * Genera un clave aleatoria
	 * @param  integer  $num_bytes
	 * @param  boolean $raw
	 * @return string
	 */
   public static function strongRand($num_bytes, $raw = false) {                        
      $rand = openssl_random_pseudo_bytes($num_bytes);                                  
      if (!$raw) {                                                                      
         $rand = base64_encode($rand);                                                  
      }
      return $rand;
   }

   /**
    * Encripta una cadena
    * @param  string $data
    * @param  string $password
    * @param  string $type
    * @return string
    */
   public static function encrypt($data, $password = "default", $type = "aes128") {     
      $iv = self::strongRand(12);                                                     
      $encrypted = openssl_encrypt($data, $type, $password, false, $iv);                
      return $iv . $encrypted;                                                          
   }      

   /**
    * Desencriptar
    * @param  string $data
    * @param  string $password
    * @param  string $type
    * @return string
    */
   public static function decrypt($data, $password = "default", $type = "aes128") {     
      $iv = substr($data, 0, 16);
      $data = substr($data, 16);                                                        
      $decrypted = openssl_decrypt($data, $type, $password, false, $iv);                
      return $decrypted;
   }
}