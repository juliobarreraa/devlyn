<?php

/**
 * This is the model class for table "{{dynamics}}".
 *
 * The followings are the available columns in table '{{dynamics}}':
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $instructions_content
 * @property string $answer
 * @property string $enabled_at
 * @property string $updated_at
 * @property string $created_at
 *
 * The followings are the available model relations:
 * @property ArticlesDynamic[] $articlesDynamics
 * @property GalleriesDynamic[] $galleriesDynamics
 */
class Dynamics extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{dynamics}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, instructions_content, answer, created_at', 'required'),
			array('title', 'length', 'max'=>255),
			array('updated_at, created_at', 'length', 'max'=>10),
			array('enabled_at', 'date', 'format' => 'dd/MM/yyyy HH:mm:ss'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, content, instructions_content, answer, enabled_at, updated_at, created_at', 'safe', 'on'=>'search'),
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
			'articlesDynamics' => array(self::HAS_MANY, 'ArticlesDynamic', 'dynamic_id'),
			'galleriesDynamics' => array(self::HAS_MANY, 'GalleriesDynamic', 'dynamic_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => Yii::t("dynamics", "Nombre"),
			'content' => Yii::t('dynamics', 'Contenido'),
			'instructions_content' => Yii::t('dynamics', 'Instrucciones'),
			'answer' => Yii::t('dynamics', 'Respuesta'),
			'enabled_at' => Yii::t('dynamics', 'Habilitar a'),
			'updated_at' => 'Updated At',
			'created_at' => 'Created At'
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('instructions_content',$this->instructions_content,true);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('enabled_at',$this->enabled_at,true);
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
	 * @return Dynamics the static model class
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
		if($this->isNewRecord) {
			$this->created_at = time();
		} else {
			$this->updated_at = time();
		}

		if ($this->enabled_at == '') {
			$this->enabled_at = 0;
		}

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
		//Cambiamos el formato para almacenarlo en base de datos
		$this->enabled_at = preg_replace("/\//", "-", $this->enabled_at);

		$this->enabled_at = strtotime($this->enabled_at);

		return parent::afterValidate();
	}

	/**
	 * Devuelve la dinámica de un día en partícular, por defecto la de hoy
	 * @param  string $date
	 * @return Dynamics
	 */
	public function getDynamic($date = "now") {
		$criteria = new CDbCriteria;
		$dynamic = null;

		switch ($date) {
			case 'now':
				$criteria->addBetweenCondition("enabled_at", strtotime(date("Y-m-d 00:00:00")), strtotime(date("Y-m-d 23:59:59")));
				$dynamic = self::model()->find($criteria);
				break;
			
			default:
				# code...
				break;
		}

		return $dynamic;
	}

}
