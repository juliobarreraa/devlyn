<?php

/**
 * This is the model class for table "{{resources}}".
 *
 * The followings are the available columns in table '{{resources}}':
 * @property integer $id
 * @property string $name
 * @property string $updated_at
 * @property string $created_at
 *
 * The followings are the available model relations:
 * @property GalleriesDynamic[] $galleriesDynamics
 */
class Resources extends CActiveRecord
{
	private $max_file_size;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{resources}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, created_at', 'required'),
			array('name', 'length', 'max'=>100),
			array('name', 'file', 'safe' => true, 'types' => 'jpg, jpeg, bmp, gif, png, swf, doc, docx', 'maxSize' => $this->max_file_size),
			array('updated_at, created_at', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, updated_at, created_at', 'safe', 'on'=>'search'),
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
			'galleriesDynamics' => array(self::HAS_MANY, 'GalleriesDynamic', 'resource_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('resources','ID'),
			'name' => Yii::t('resources','Nombre'),
			'updated_at' => Yii::t('resources','Actualizado el'),
			'created_at' => Yii::t('resources','Creado el'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Resources the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
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
		if( $this->isNewRecord )
		{
			$this->created_at = time();
		}
		else
		{
			$this->created_at = strtotime($this->created_at);
		}


		$this->name = CUploadedFile::getInstance($this, "name");

		$name_encoded = md5($this->name->name . time()) . '.' . $this->name->extensionName;
		
		$this->name->saveAs(Yii::getPathOfAlias('webroot.uploads.resources') . DIRECTORY_SEPARATOR . $name_encoded);
		$this->name = $name_encoded;

		return parent::beforeValidate();
	}

	/**
	 * This method is invoked after validation ends.
	 * The default implementation calls {@link onAfterValidate} to raise an event.
	 * You may override this method to do postprocessing after validation.
	 * Make sure the parent implementation is invoked so that the event can be raised.
	 */
	protected function afterValidate()
	{
		return parent::afterValidate();
	}

}
