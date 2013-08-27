<?php

/**
 * This is the model class for table "{{settingsCacheStore_group}}".
 *
 * The followings are the available columns in table '{{settingsCacheStore_group}}':
 * @property integer $settingGroup_id
 * @property integer $member_id
 * @property string $cs_key
 * @property string $cs_value
 * @property integer $cs_array
 * @property integer $cs_updated
 *
 * The followings are the available model relations:
 * @property Members $member
 * @property SettingsGroupApp $settingGroup
 */
class SettingsCacheStoreGroup extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{settingsCacheStore_group}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('settingGroup_id, member_id, cs_key', 'required'),
			array('settingGroup_id, member_id, cs_array, cs_updated', 'numerical', 'integerOnly'=>true),
			array('cs_key', 'length', 'max'=>255),
			array('cs_value', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('settingGroup_id, member_id, cs_key, cs_value, cs_array, cs_updated', 'safe', 'on'=>'search'),
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
			'settingGroup' => array(self::BELONGS_TO, 'SettingsGroupApp', 'settingGroup_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'settingGroup_id' => 'Setting Group',
			'member_id' => 'Member',
			'cs_key' => 'Cs Key',
			'cs_value' => 'Cs Value',
			'cs_array' => 'Cs Array',
			'cs_updated' => 'Cs Updated',
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

		$criteria->compare('settingGroup_id',$this->settingGroup_id);
		$criteria->compare('member_id',$this->member_id);
		$criteria->compare('cs_key',$this->cs_key,true);
		$criteria->compare('cs_value',$this->cs_value,true);
		$criteria->compare('cs_array',$this->cs_array);
		$criteria->compare('cs_updated',$this->cs_updated);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return SettingsCacheStoreGroup the static model class
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
