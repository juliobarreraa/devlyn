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
class AdminLanguageTest extends WebTestCase {
	/**
	 * Nos aseguramos de que devuelva minimo dos archivos de idioma, es-MX y en-US.
	 */
	public function testIndex() {
		$model = Language::model()->findAll(array('limit' => '4'));

		$this->assertEquals((count($model) > 1), true);
	}

	public function testRead() {
		$this->open('admin/language/view/id/1');
		$this->assertTextPresent('Identificarse');

		$this->assertElementPresent('name=LoginForm[username]');
		$this->type('name=LoginForm[username]', 'staff');
		$this->type('name=LoginForm[password]', '123456');

		$this->clickAndWait('css=#login-form button[type=submit]');

		$this->assertTextPresent('Members');

		$this->assertTrue(!$this->isTextPresent('Identificarse'));

		$this->clickAndWait('link=Members');

		$this->assertTextPresent('Acepto Los <a Href="{{link}}" Target=" Blank"> Términos Y Condiciones</a>');

		$this->type('css=label.control-label:first-child + div.controls input', 'Acepto');

		$this->clickAndWait('//div[@class="form-actions"]//button[@type="submit"]');

		$this->assertTextPresent('Guardado con éxito');
	}
}