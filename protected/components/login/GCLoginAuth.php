<?php 
/**
  * $Source$
  * $File$
  * @version $Id$
  * @license http://www.codebit.org/licence
  * @copyright Copyright (c) 2013, Julio Barrera & Jefferson Arrubla
  * @author   $Author$
  * @since   # $Date$
 */

 namespace globalcms\components\login;

 class GCLoginAuth extends \CUserIdentity implements LoginAuth {
	/**
	 * Identificador del usuario
	 * @var [type]
	 */
	private $_id;

    /**
     * Si el usuario se identifico a través de facebook o twitter, login automático
     * @var boolean
     */
    public $accessTokenOAuth = false;

    /**
     * Si el tipo es diferente a false, y es twitter o facebook, se válida en base a ello.
     * @var boolean
     */
    public $scenario = false;

	/**
	 * A los 3 intentos se bloquea la cuenta
	 */
	const ERROR_ACCOUNT_BLOCK = 4;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		if( $this->accessTokenOAuth )
		{
			switch ($this->scenario) {
				case 'facebook':
					$member = \Members::model()->findByAttributes( array( 'fb_uid' => $this->accessTokenOAuth ) );
					break;
				case 'twitter':
					$member = \Members::model()->findByAttributes( array( 'twitter_id' => $this->accessTokenOAuth ) );
					break;
				case 'autologin':
					$member = \Members::model()->findByPk($this->_id);
					break;
			}
		}
		else {
			//Verificamos que el usuario exista
			$member = \Members::model()->findByAttributes( array( 'username' => $this->username ) );
		}

		if( $member === null )
		{
			//El usuario no existe
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		}
		elseif( $member->isLock() )
		{
			//La cuenta esta bloqueada
			$this->errorCode = self::ERROR_ACCOUNT_BLOCK;
		}
        else
        {
			if( !$this->accessTokenOAuth && ( $member->pass_hash !== \Helpers::password_encrypt( $this->password, $member->pass_salt ) ) )
			{
				//Si las contraseñas no coinciden, no es una sesión válida.
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
			}
            else
            {
            	$this->_id = $member->id;

            	$lastLogin = $member->last_login_time;

            	if( null === $member->last_login_time )
            	{
            		$lastLogin = time();
            	}

            	$this->setState( 'lastLoginTime',  $lastLogin );
            	$this->setState( 'name',  $member->username );
            	$this->setState( 'language',  $member->languageToStr() );

				$this->setState('keyPrefix', \Yii::app()->user->getStateKeyPrefix());
				$this->setState('userid', $this->_id);

                $this->errorCode = self::ERROR_NONE;
            }
            return !$this->errorCode;
        }
	}

	/**
	 * Obtiene el identificador del usuario identificado
	 * @return integer
	 */
	public function getId()
	{
	    return $this->_id;
	}

	/**
	 * Configura el identificador único del usuario
	 * @param int $id Identificador del usuario
	 */
	public function setId($id) {
		$this->_id = $id;
	}
 } ?>