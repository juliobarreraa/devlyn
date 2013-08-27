<?php

/**
 * This is the model class for table "{{settingsApp}}".
 *
 * The followings are the available columns in table '{{settingsApp}}':
 * @property integer $id
 * @property integer $member_id
 * @property string $name
 * @property integer $updated_at
 * @property integer $created_at
 *
 * The followings are the available model relations:
 * @property Members $member
 * @property SettingsGroupApp[] $settingsGroupApps
 */
class SettingsApp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{settingsApp}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('member_id, name, created_at', 'required'),
			array('member_id, updated_at, created_at', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, member_id, name, updated_at, created_at', 'safe', 'on'=>'search'),
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
			'member' => array(self::BELONGS_TO, 'Members', 'member_id'),
			'settingsGroupApps' => array(self::HAS_MANY, 'SettingsGroupApp', 'setting_app_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'member_id' => 'Member',
			'name' => 'Name',
			'updated_at' => 'Updated At',
			'created_at' => 'Created At',
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
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('updated_at',$this->updated_at);
		$criteria->compare('created_at',$this->created_at);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SettingsApp the static model class
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
			$this->updated_at = time();
			$this->created_at = strtotime($this->created_at);
		}

		return parent::beforeValidate();
	}

}
