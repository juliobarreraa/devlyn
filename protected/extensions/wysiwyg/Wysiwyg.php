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
class Wysiwyg extends CWidget
{
	/**
	 * Titulo del wysiwyg, si no tiene un titulo no se desplegara el mismo.
	 * @var string
	 */
	public $title;

	/**
	 * Textarea donde se redactara el contenido del wysiwyg
	 * @var CForm
	 */
	public $textarea;

	/**
	 * Inicializa las variables y recursos necesarios para mostrar el widget
	 */
    function init()
    {
        ob_start();
    }

    /**
     * Renderiza la vista del widget
     * @return string
     */
	function run()
	{
		ob_get_clean();
		$this->render('index', array('title' => $this->title, 'textarea' => $this->textarea));
	}
}
 ?>