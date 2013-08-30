<?php

/**
 * This is the model class for table "{{galleries_dynamic}}".
 *
 * The followings are the available columns in table '{{galleries_dynamic}}':
 * @property integer $id
 * @property integer $dynamic_id
 * @property integer $resource_id
 * @property string $updated_at
 * @property string $created_at
 *
 * The followings are the available model relations:
 * @property Resources $resource
 * @property Dynamics $dynamic
 */
class GalleriesDynamic extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{galleries_dynamic}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dynamic_id, resource_id, created_at', 'required'),
			array('dynamic_id, resource_id', 'numerical', 'integerOnly'=>true),
			array('updated_at, created_at', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, dynamic_id, resource_id, updated_at, created_at', 'safe', 'on'=>'search'),
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
			'resource' => array(self::BELONGS_TO, 'Resources', 'resource_id'),
			'dynamic' => array(self::BELONGS_TO, 'Dynamics', 'dynamic_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'dynamic_id' => Yii::t('galleries','Dinámica'),
			'resource_id' => Yii::t('galleries','Recurso'),
			'updated_at' => Yii::t('galleries','Actualizado el'),
			'created_at' => Yii::t('galleries','Creado el'),
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
		$criteria->compare('dynamic_id',$this->dynamic_id);
		$criteria->compare('resource_id',$this->resource_id);
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
	 * @return GalleriesDynamic the static model class
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

		return parent::beforeValidate();
	}
}
