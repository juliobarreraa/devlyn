<?php 
	/**
	* Clase que permite cargar archivos del tipo swf,jpeg,png, gif
	*/
	class Upload extends CFormModel
	{
		public $file;

		public function rules()
		{
			return array(
				array('file', 'file', 'types'=>'swf, jpeg, png, gif'),
			);
		}
	}
 ?>