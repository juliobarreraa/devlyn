<?php

/**
 * This is the model class for table "{{forums}}".
 *
 * The followings are the available columns in table '{{forums}}':
 * @property integer $id
 * @property integer $last_poster_id
 * @property string $name
 * @property string $description
 * @property string $position
 * @property string $password
 * @property integer $last_topic_id
 * @property integer $show_rules
 * @property integer $parent_id
 * @property string $rules_title
 * @property string $rules_text
 * @property integer $enabled
 * @property string $updated_at
 * @property string $created_at
 *
 * The followings are the available model relations:
 * @property Forums $parent
 * @property Forums[] $forums
 * @property Members $lastPoster
 * @property Topics $lastTopic
 * @property Topics[] $topics
 */
class Forums extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Forums the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{forums}}';
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
			array('last_poster_id, last_topic_id, show_rules, parent_id, enabled', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>128),
			array('position', 'length', 'max'=>4),
			array('password', 'length', 'max'=>32),
			array('rules_title', 'length', 'max'=>255),
			array('updated_at, created_at', 'length', 'max'=>10),
			array('description, rules_text', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, last_poster_id, name, description, position, password, last_topic_id, show_rules, parent_id, rules_title, rules_text, enabled, updated_at, created_at', 'safe', 'on'=>'search'),
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
			'parent' => array(self::BELONGS_TO, 'Forums', 'parent_id'),
			'forums' => array(self::HAS_MANY, 'Forums', 'parent_id'),
			'lastPoster' => array(self::BELONGS_TO, 'Members', 'last_poster_id'),
			'lastTopic' => array(self::BELONGS_TO, 'Topics', 'last_topic_id'),
			'topics' => array(self::HAS_MANY, 'Topics', 'forum_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'last_poster_id' => 'Last Poster',
			'name' => 'Name',
			'description' => 'Description',
			'position' => 'Position',
			'password' => 'Password',
			'last_topic_id' => 'Last Topic',
			'show_rules' => 'Show Rules',
			'parent_id' => 'Parent',
			'rules_title' => 'Rules Title',
			'rules_text' => 'Rules Text',
			'enabled' => 'Enabled',
			'updated_at' => 'Updated At',
			'created_at' => 'Created At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('last_poster_id',$this->last_poster_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('last_topic_id',$this->last_topic_id);
		$criteria->compare('show_rules',$this->show_rules);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('rules_title',$this->rules_title,true);
		$criteria->compare('rules_text',$this->rules_text,true);
		$criteria->compare('enabled',$this->enabled);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * This method is invoked before validation starts.
	 * The default implementation calls {@link onBeforeValidate} to raise an event.
	 * You may override this method to do preliminary checks before validation.
	 * Make sure the parent implementation is invoked so that the event can be raised.
	 * @return boolean whether validation should be executed. Defaults to true.
	 * If false is returned, the validation will stop and the model is considered invalid.
	 */
	protected function beforeValidate() {
		if($this->isNewRecord) {
			$this->created_at = time();
		}
		else {
			$this->updated_at = time();
		}

		return parent::beforeValidate();
	}

	/**
	 * Crea un nuevo usuario a partir de un arreglo de datos
	 * @param  $row Colección de datos a insertar en un nuevo registro.
	 * @return boolean Si fue correcto arroja true, false en caso contrario.
	 */
	public static function create(array $row) {
		if(!Helpers::array_multi_key_exists('id|last_poster_id|name|description|position|password|last_id|show_rules|parent_id|rules_title|rules_text|status', $row)) return false;

		$forum = new self;
		$forum->setAttributes(
			array(
				 'id' => $row['id']
				//,'last_poster_id' => $row['last_poster_id']
				,'name' => $row['name']
				,'description' => $row['description']
				,'position' => $row['position']
				,'password' => $row['password']
				//,'last_topic_id' => $row['last_id']
				,'show_rules' => $row['show_rules']
				//,'parent_id' => $row['parent_id']
				,'rules_title' => $row['rules_title']
				,'rules_text' => $row['rules_text']
				,'enabled' => $row['status']
			)
		);

		$transaction = null;

		try {
			$transaction = $forum->dbConnection->beginTransaction(); 

			$return = $forum->save();

			$transaction->commit(); 

			if(!$return) return false;

		} catch (Exception $e) {
			if($transaction) $transaction->rollBack();
		}

		return true;
	}
}