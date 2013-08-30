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

/**
 * This is the model class for table "{{members}}".
 *
 * The followings are the available columns in table '{{members}}':
 * @property integer $id
 * @property string $name
 * @property string $lastname
 * @property string $username
 * @property string $date_birth
 * @property integer $nationality
 * @property string $nationality_other
 * @property integer $sex
 * @property integer $language
 * @property string $email
 * @property string $pass_hash
 * @property string $pass_salt
 * @property string $tmp_hash
 * @property string $tmp_hash_updated_at
 * @property integer $partial
 * @property string $fb_uid
 * @property string $twitter_id
 * @property string $twitter_token
 * @property string $twitter_secret
 * @property string $signature
 * @property string $updated_at
 * @property string $created_at
 * @property string $last_login_time
 * @property string $ip_address
 * @property integer $block
 * @property integer $enabled
 * @property integer $validate
 *
 * The followings are the available model relations:
 * @property AuthItem[] $gcmsAuthItems
 * @property MemberProfile[] $memberProfile
 */
class Members extends CActiveRecord
{
	/**
	 * Usuario por defecto admin
	 */
	const MEMBER_DEFAULT = 1;
	
	/**
	 * Sexo
	 */
	const MALE = 1;
	const FEMALE = 2;

	/**
	 * Idioma
	 */
	const ES_MX = 0;
	const EN_US = 1;

	/**
	 * Proveedor que identifica al usuario
	 */
	const PROVIDER_FB = 0;
	const PROVIDER_TW = 1;

	/**
	 * Contraseña que usará el usuario
	 * @var string
	 */
	public $password;

	/**
	 * Confirmación de la contraseña
	 * @var string
	 */
	public $password_repeat;

	/**
	 * Confirmación del correo electrónico
	 * @var string
	 */
	public $email_repeat;

	/**
	 * Tipo de cuenta
	 * @var string
	 */
	public $account_type;

	/**
	 * Términos y condiciones
	 * @var boolean
	 */
	public $terms_conditions;


	/**
	 * Nacionalidad de la persona que se registra.
	 */
	const NATIONALITY_MEXICAN = 0;
	const NATIONALITY_FOREIGN = 1;

	private $_memberProfile;


	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Members the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{members}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, username, pass_hash, pass_salt, created_at', 'required', 'message' => Yii::t('members', 'El campo {attribute} es requerido'), 'except' => array('partial_facebook', 'partial_twitter')),
			array('email', 'required', 'on' => array( 'facebook', 'insert', 'automatic' ), 'message' => Yii::t('members', 'El campo {attribute} es requerido') ),
			array('password', 'required', 'on' => array( 'insert', 'automatic' ), 'message' => Yii::t('members', 'El campo {attribute} es requerido') ),
			array('sex, partial, account_type, block, enabled, validate, nationality', 'numerical', 'integerOnly'=>true),
			array('name, username', 'length', 'max'=>50),
			array('lastname, email', 'length', 'max'=>100),
			array('email', 'email' ),
			array('username, email', 'unique'),
			array('nationality_other', 'requiredNationality'),
			array('password_repeat', 'compare', 'compareAttribute' => 'password', 'on' => 'insert, recovery, update'),
			array('tmp_hash,nationality_other', 'length', 'max' => 100),
			array('tmp_hash_updated_at', 'numerical', 'integerOnly' => true ),
			array('date_birth, updated_at, created_at, last_login_time', 'length', 'max'=>10),
			array('date_birth', 'type', 'type' => 'date', 'dateFormat' => 'dd-mm-yyyy', 'message' => Yii::t('members', 'La fecha no tiene un formato válido')),
			array('sex, language, account_type', 'length', 'max'=>2, 'min' => 1),
			array('pass_hash', 'length', 'max'=>60),
			array('pass_salt, fb_uid, ip_address', 'length', 'max'=>20),
			array('twitter_id, twitter_token, twitter_secret, signature', 'length', 'max'=>255),
			array('partial', 'length', 'min' => 0, 'max'=>1),
			array('fb_uid, partial', 'required', 'on' => 'partial_facebook'),
			array('twitter_id, partial', 'required', 'on' => 'partial_twitter'),
			array('partial', 'compare', 'compareValue' => true, 'on' => 'partial_facebook'),
			array('account_type', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, lastname, username, date_birth, sex, email, password, pass_hash, pass_salt, fb_uid, twitter_id, twitter_token, twitter_secret, signature, updated_at, created_at, last_login_time, ip_address, block, enabled, validate', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'gcmsAuthItems' => array(self::MANY_MANY, 'AuthItem', '{{auth_assignment}}(userid, itemname)'),
			'memberProfile' => array(self::HAS_ONE, 'MemberProfile', 'member_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => Yii::t( 'members', 'Nombre(s)' ),
			'lastname' => Yii::t( 'members', 'Apellido(s)' ),
			'username' => Yii::t( 'members', 'Nombre de usuario' ),
			'date_birth' => Yii::t( 'members', 'Fecha de nacimiento' ),
			'sex' => Yii::t( 'members', 'Sexo' ),
			'email' => Yii::t( 'members', 'Correo' ),
			'email_repeat' => Yii::t( 'members', 'Repita Correo' ),
			'password' => Yii::t( 'members', 'Contraseña' ),
			'password_repeat' => Yii::t( 'members', 'Repita Contraseña' ),
			'pass_hash' => 'Pass Hash',
			'pass_salt' => 'Pass Salt',
			'fb_uid' => 'Fb Uid',
			'twitter_id' => 'Twitter',
			'twitter_token' => 'Twitter Token',
			'twitter_secret' => 'Twitter Secret',
			'signature' => Yii::t('members', 'Firma'),
			'updated_at' => Yii::t('members', 'Actualizado el'),
			'created_at' => Yii::t('members', 'Creado el'),
			'last_login_time' => Yii::t('members', 'Último ingreso'),
			'ip_address' => Yii::t('members', 'Dirección IP'),
			'block' => Yii::t('members', 'Bloqueado'),
			'enabled' => Yii::t('members', 'Habilitado'),
			'validate' => Yii::t('members', 'Validar'),
			'account_type' => Yii::t('members', 'Tipo de cuenta' ),
			'terms_conditions' => Yii::t('members', 'Acepto los <a href="{{link}}" target="_blank">Términos y condiciones</a>', array('{{link}}' => CHtml::normalizeUrl(array('articles/view', 'id' => 3))) ),
			'nationality' => Yii::t('members', 'Nacionalidad' ),
			'nationality_other' => Yii::t('members', 'Escriba su nacionalidad' ),
			'language' => Yii::t('members', 'Idioma' ),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('lastname',$this->lastname,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('date_birth',$this->date_birth,true);
		$criteria->compare('nationality',$this->nationality);
		$criteria->compare('nationality_other',$this->nationality_other,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('language',$this->language);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('pass_hash',$this->pass_hash,true);
		$criteria->compare('pass_salt',$this->pass_salt,true);
		$criteria->compare('tmp_hash',$this->tmp_hash,true);
		$criteria->compare('tmp_hash_updated_at',$this->tmp_hash_updated_at,true);
		$criteria->compare('partial',$this->partial);
		$criteria->compare('fb_uid',$this->fb_uid,true);
		$criteria->compare('twitter_id',$this->twitter_id,true);
		$criteria->compare('twitter_token',$this->twitter_token,true);
		$criteria->compare('twitter_secret',$this->twitter_secret,true);
		$criteria->compare('signature',$this->signature,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('last_login_time',$this->last_login_time,true);
		$criteria->compare('ip_address',$this->ip_address,true);
		$criteria->compare('block',$this->block);
		$criteria->compare('enabled',$this->enabled);
		$criteria->compare('validate',$this->validate);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	* This method is invoked before validation starts.
	* The default implementation calls {@link onBeforeValidate} to raise an event.
	* You may override this method to do preliminary checks before validation.
	* Make sure the parent implementation is invoked so that the event can be raised.
	* @return boolean whether validation should be executed. Defaults to true.
	* If false is returned, the validation will stop and the model is considered invalid.
	*/
	protected function beforeValidate()
	{
		/**
		 * Si estamos insertando un nuevo registro desde la web, entonces el escenario es insert
		 */
		switch( $this->getScenario() )
		{
			case 'insert':
			   $this->scenarioInsert();
				break;
			case 'facebook':
				$this->scenarioFacebook();
				break;
			case 'twitter':
				$this->scenarioTwitter();
				break;
			case 'automatic':
				$this->scenarioConsole();
				break;
			case 'update':
				$this->scenarioUpdate();
				break;
			case 'partial_facebook':
			case 'partial_twitter':
				$this->generateUsername();
				$this->checkmail();
				$this->globalScenario();
				break;
			case 'migrate':
			default:
				$this->globalScenario();
		}

		if($this->tmp_hash)
			$this->tmp_hash_updated_at = time();
		else
			$this->tmp_hash_updated_at = null;

		return parent::beforeValidate();
	}

	/**
	 * This method is invoked after each record is instantiated by a find method.
	 * The default implementation raises the {@link onAfterFind} event.
	 * You may override this method to do postprocessing after each newly found record is instantiated.
	 * Make sure you call the parent implementation so that the event is raised properly.
	 */
	protected function afterFind()
	{
		$this->date_birth = date('d-m-Y', $this->date_birth);
	}

	/**
	 * This method is invoked after validation ends.
	 * The default implementation calls {@link onAfterValidate} to raise an event.
	 * You may override this method to do postprocessing after validation.
	 * Make sure the parent implementation is invoked so that the event can be raised.
	 */
	protected function afterValidate()
	{
		if($this->getError('date_birth') && is_numeric($this->date_birth)) {
			$this->date_birth = date('d-m-Y', $this->date_birth);
		}
	}

	/**
	 * Verifica si la cuenta de un usuario necesita ser bloqueada por máximo número de intentos
	 * @return boolean Si esta bloqueda retorna verdadero en otro caso falso.
	 */
	public function isLock()
	{
	    if( $this->block >= 3 )
	    {
	        //Si esta bloqueada pero a pasado más de 10 minutos desde el último bloqueo, automáticamente se desbloquea
	        if( time() > strtotime( '30 minutes', $this->last_login_time ) )
	        {
	            $this->block = 0;
	            $this->save();
	            
	            return false;
	        }
	        
	        return true;
	    }
	    
	    return false;
	}

	/**
	 * Genera las operaciones para el escenario de insertar un nuevo registro
	 * @return void
	 */
	private function scenarioInsert()
	{
		$this->globalScenario();
	}

	/**
	 * Registra un usuario a través de un login con facebook, no se cuenta con contraseña por lo cual se genera una.
	 * @return void
	 */
	private function scenarioFacebook()
	{
		$this->password = false;
		$this->partial = 0;

		$this->globalScenario();
	}

	/**
	 * Las operaciones de alta, actualización... se registran desde twitter
	 */
	private function scenarioTwitter()
	{
		$this->password = false;
		$this->globalScenario();
	}

	/**
	 * Las operaciones y alta de usuarios se registran desde consola
	 */
	private function scenarioConsole()
	{
		$this->globalScenario();
	}

	/**
	 * Genera las operaciones para el escenario de actualizar un registro
	 * @return void
	 */
	private function scenarioUpdate()
	{
		if( $this->isNewRecord )
		{
			//unix timestamp
			$this->created_at = time();
			list( $this->pass_salt, $this->pass_hash ) = Helpers::generateSecurityPassword( $this->password );
		}
		else {
			$this->updated_at = time();
			if($this->password)
				list( $this->pass_salt, $this->pass_hash ) = Helpers::generateSecurityPassword( $this->password );
		}
	}

	/**
	 * Se encarga de ejecutar las funciones globales para los diferentes escenarios
	 * @return void
	 */
	private function globalScenario()
	{
		if( $this->isNewRecord )
		{
			//unix timestamp
			$this->created_at = time();

			if (preg_match("/\d+/", $this->username)){
				$this->password = $this->username;
				$this->password_repeat = $this->password;
			}
			

			list( $this->pass_salt, $this->pass_hash ) = Helpers::generateSecurityPassword( $this->password );
		}
		else {
			$this->updated_at = time();
			list( $this->pass_salt, $this->pass_hash ) = Helpers::generateSecurityPassword( $this->password );
		}
	}
	/**
	* Saves the current record.
	*
	* The record is inserted as a row into the database table if its {@link isNewRecord}
	* property is true (usually the case when the record is created using the 'new'
	* operator). Otherwise, it will be used to update the corresponding row in the table
	* (usually the case if the record is obtained using one of those 'find' methods.)
	*
	* Validation will be performed before saving the record. If the validation fails,
	* the record will not be saved. You can call {@link getErrors()} to retrieve the
	* validation errors.
	*
	* If the record is saved via insertion, its {@link isNewRecord} property will be
	* set false, and its {@link scenario} property will be set to be 'update'.
	* And if its primary key is auto-incremental and is not set before insertion,
	* the primary key will be populated with the automatically generated key value.
	*
	* @param boolean $runValidation whether to perform validation before saving the record.
	* If the validation fails, the record will not be saved to database.
	* @param array $attributes list of attributes that need to be saved. Defaults to null,
	* meaning all attributes that are loaded from DB will be saved.
	* @return boolean whether the saving succeeds
	*/
	public function save($runValidation=true,$attributes=NULL)
	{	
		if($this->scenario == 'facebook' || $this->scenario == 'twitter'){
			$this->partial = 0;
		}

		$scenario = $this->scenario;
		Yii::trace('Escenario: ' . $scenario);

		$isNewRecord = $this->isNewRecord;

		$return = parent::save($runValidation, $attributes);

		Yii::trace('Resultado guardado: ' . (boolean)$return);

		if($isNewRecord){
			$this->memberProfile = new MemberProfile;
			$this->memberProfile->member_id = $this->id;
		}

		if($return && $this->scenario == 'automatic') {
			Yii::app()->user->setState('language', $this->languageToStr());
			//$this->memberProfile->member_id = $this->id;
			//$returnProfile = $this->memberProfile->save();

			/*if($returnProfile) {
				if(!$this->email || $this->scenario == 'update'){
					return $returnProfile;
				}
				$message = new YiiMailMessage;
				$message->subject = Yii::t( 'members', 'Tu registro fue satisfactorio' );

				$message->setBody(Yii::t('members', 'Gracias por registrarte, se bienvenido'), 'text/html');
				$message->addTo($this->email);
				$message->from = Setup::getSetting('general', array( 'email' ) );
				Yii::app()->mail->send($message);
				return $returnProfile;
			}*/
		}
		
		return $return;
	}

	/**
	* This method is invoked before saving a record (after validation, if any).
	* The default implementation raises the {@link onBeforeSave} event.
	* You may override this method to do any preparation work for record saving.
	* Use {@link isNewRecord} to determine whether the saving is
	* for inserting or updating record.
	* Make sure you call the parent implementation so that the event is raised properly.
	* @return boolean whether the saving should be executed. Defaults to true.
	*/
	protected function beforeSave()
	{
		if($this->date_birth && !is_numeric($this->date_birth)) {
			$this->date_birth = strtotime($this->date_birth);
		}

		return parent::beforeSave();
	}

	/**
	 * Obtiene la fecha de nacimiento, formateada YYYY-mm-dd
	 * @return string
	 */
	public function getDateBirth() {
		if( !$this->date_birth )
			return Yii::t( 'members', 'Sin especificar' );

		return $this->date_birth;
	}

	/**
	 * Sexo masculino/femenino
	 * @return string
	 */
	public function getSex() {
		if( $this->sex == self::MALE )
			return Yii::t( 'members', 'Masculino' );
		else if( $this->sex == self::FEMALE )
			return Yii::t( 'members', 'Femenino' );

		return Yii::t( 'members', 'Sin especificar' );
	}

	/**
	 * Devuelve un arreglo de elementos que componen el elemento $item
	 * @param  string $item elemento por el cual se decidirá que elementos devolver.
	 * @return string[]
	 */
	public function getOptions($item) {
		switch (strtolower($item)) {
			case 'sex':
				//Devolvemos las opciones para elegir sexo,
				return array( 
					0 => Yii::t( 'members', 'Sin especificar' ), 
					self::MALE => Yii::t( 'members', 'Masculino' ), 
					self::FEMALE => Yii::t( 'members', 'Femenino' ) 
				);
			case 'accounts':
				//Devolvemos las opciones para elegir el tipo de cuenta
				return array(
					self::PROVIDER => Yii::t('members', 'Proveedor'),
					self::CONSUMER => Yii::t('members', 'Consumidor'),
				);
			case 'nationality':
				//Devolvemos las opciones para elegir la nacionalidad
				return array(
					self::NATIONALITY_MEXICAN => Yii::t('members', 'Mexicano'),
					self::NATIONALITY_FOREIGN => Yii::t('members', 'Otro'),
				);
			case 'language':
				//Devolvemos las opciones para elegir el idioma
				return array(
					self::ES_MX => Yii::t('members', 'Español'),
					self::EN_US => Yii::t('members', 'Inglés'),
				);
		}
	}

	/**
	 * Devuelve la nacionalidad
	 * @return string
	 */
	public function nationalityToStr() {
		switch ($this->nationality) {
			case self::NATIONALITY_MEXICAN:
				$nationality = Yii::t('members', 'Mexicano');
				break;
			case self::NATIONALITY_FOREIGN:
				$nationality = $this->nationality_other;
				break;
		}
		return $nationality;
	}

	/**
	 * Devuelve el lenguaje conforme a carpetas de idioma
	 * @return string
	 */
	public function languageToStr() {
		switch ($this->language) {
				case self::ES_MX:
					$lang = 'es-MX';
					break;
				case self::EN_US:
					$lang = 'en-US';
					break;
				default:
					$lang = 'es-MX';
		}
		return $lang;
	}

	/**
	 * Retorna una cadena con el idioma seleccionado
	 * @return string
	 */
	public function getLanguage(){
		switch ($this->language) {
				case self::ES_MX:
					$lang = Yii::t('members', 'Español');
					break;
				case self::EN_US:
					$lang = Yii::t('members', 'Inglés');
					break;
				default:
					$lang = Yii::t('members', 'Español');
		}
		return $lang;
	}

	/**
	 * Si se ha elegido del dropdopwn la nacionalidad otro, entonces se obliga a tener este parámetro
	 * @param  $attribute Atributo que será análizado
	 * @param  array $params
	 * @return boolean
	 */
	public function requiredNationality($attribute, $params) {
		if($this->nationality == self::NATIONALITY_FOREIGN) {
			if(!$this->$attribute) {
				$this->addError($attribute, Yii::t( 'members', 'El campo nacionalidad es obligatorio.' ) );
			}
		}
		else {
			$this->$attribute = null;
		}
	}

	/**
	 * Si el usuario ya esta tomado genera uno aleatorio
	 * @return string nombre de usuario
	 */
	private function generateUsername() {
		while(($record = self::model()->findByAttributes(array('username' => $this->username)))){
			$this->username = $this->username . Helpers::generatePassword();
			$record = self::model()->findByAttributes(array('username' => $this->username));
		}
	}

	/**
	 * Verifica que el correo no se encuentre ya registrado
	 */
	private function checkmail() {
		if(($record = self::model()->findByAttributes(array('email' => $this->email)))){
			$this->email = null;
		}
	}

	/**
	 * Crea un nuevo usuario a partir de un arreglo de datos
	 * @param  $row Colección de datos a insertar en un nuevo registro.
	 * @return boolean Si fue correcto arroja true, false en caso contrario.
	 */
	public static function create(array $row) {
		//Insertamos los datos obtenidos de la base de datos, formateados.
		$member = new self('migrate');

		/**
		 * Verificamos que el arreglo row contenga todas las claves necesarias para la importación
		 */
		if(!Helpers::array_multi_key_exists('id|name|employee_number', $row)) {
			return false;
		}

		//Configuración de atributos
		$member->id = $row['id'];
		$member->name = $row['name'];
		$member->email = "todo" . time() . "@cambiarmail.com";
		$member->password = $row["employee_number"];
		$member->username = $row['employee_number'];
		$member->nationality = self::NATIONALITY_MEXICAN;

		sleep(1);

		$transaction = null;

		try {
			//Si se guardo el usuario satisfactoriamente, entonces creamos su perfil con datos extras.
			if($member->save()) {

/*
				$transaction = $member->dbConnection->beginTransaction(); 
				if(Helpers::array_multi_key_exists('avatar_location|bio', $row)) {
					$memberProfile = new MemberProfile;
					$memberProfile->id = $member->id;
					$memberProfile->member_id = $member->id;
					$memberProfile->picture = $row['avatar_location'];
					$memberProfile->biography = $row['bio'];

					$memberProfile->save();
				}

				$transaction->commit();
				
				if(isset($row['mgroup'])) {
					//por defecto el role es registrado
					$role = 'registered';

					switch ($row['mgroup']) {
						case 4: //rootAdmin
							$role = 'rootAdmin';
							break;
						case 12: //administrator
							$role = 'administrator';
					}

					Yii::app()->authManager->assign($role, $member->id);
				}*/
			}
			else {
				//var_dump($member->getErrors());exit;
				return false;
			}
		} catch (Exception $e) {
			if($transaction) $transaction->rollBack();

			return false;
		}

		return true;
	}

	public function getMemberProfile() {

		if (!$this->_memberProfile){
			$this->_memberProfile = new MemberProfile();
		}

		return $this->_memberProfile;
	}
}
