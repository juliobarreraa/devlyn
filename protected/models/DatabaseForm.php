<?php 
/**
 * @license http://www.codebit.org/licence
 * @copyright Copyright (c) 2013, Julio Barrera & Jefferson Arrubla
 */
/**
 * Formulario de detalle de conexión con la base de datos.
 * 
 * $Source$
 * $File$
 * @version $Id$
 * @author   $Author$
 * @since   # $Date$
*/
class DatabaseForm extends CFormModel
{
	public $name;
	public $email;
	public $subject;
	public $body;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, email, subject, body', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'verifyCode'=>'Verification Code',
		);
	}

	/**
	 * Despliega el formulario
	 * @return CForm[]
	 */
	public function getForm() {
		return new CForm(array(
			'showErrorSummary'=>true,
			'elements'=>array(
				'username'=>array(
					'hint'=>'6-12 characters; letters, numbers, and underscore'
				),
				'password'=>array(
					'type'=>'password',
					'hint'=>'8-12 characters; letters, numbers, and underscore; mixed case and at least 1 digit',
				),
				'password_repeat'=>array(
					'type'=>'password',
					'hint'=>'Re-type your password',
				),
				'email'=>array(
					'hint'=>'Your e-mail address'
				)
			),
			'buttons'=>array(
				'submit'=>array(
					'type'=>'submit',
					'label'=>'Next'
				),
				'save_draft'=>array(
					'type'=>'submit',
					'label'=>'Save'
				)
			)
		), $this);
	}
}
 ?>