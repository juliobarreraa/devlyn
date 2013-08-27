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
class NodejsTest extends WebTestCase
{
	function testChat()
	{
		//Abrimos sala de chat
		$this->open('admin/default/index');
		//Si se encuentra el texto de identificarse
		$this->assertTextPresent('Identificarse');

		/**
		 * Nos identificamos con datos de prueba
		 */
		$this->assertElementPresent('name=LoginForm[username]');
		$this->type('name=LoginForm[username]', 'staff');
		$this->type('name=LoginForm[password]', '123456');

		//Damos click
		$this->clickAndWait('css=#login-form button[type=submit]');

		//Si hubo error al identificarnos
		$this->assertTrue(!$this->isTextPresent('Identificarse'));

		//Si existe el texto de Conversación
		$this->assertTrue($this->isTextPresent('Conversación - Global'));

		//Estamos en la ventana de chat ahora deberemos enviar un mensaje, ese mensaje deberemos localizarlo en la ventana de chat
		$this->type('css=#send-chat-msg input[name="message"]', 'Mensaje phpunit');
		//Damos click al boton de enviar
		$this->clickAndWait('css=#send-chat-msg button[type="submit"]');

		//Verificamos que el mensaje se haya enviado con éxito
		$this->waitForTextPresent('Mensaje phpunit');
	}
}