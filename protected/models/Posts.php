<?php

/**
 * This is the model class for table "{{posts}}".
 *
 * The followings are the available columns in table '{{posts}}':
 * @property integer $id
 * @property string $title
 * @property integer $author_id
 * @property integer $topic_id
 * @property string $content
 * @property integer $author_edit_id
 * @property string $updated_at
 * @property string $created_at
 *
 * The followings are the available model relations:
 * @property Topics $topic
 * @property Members $author
 * @property Members $authorEdit
 * @property Topics[] $topics
 */
class Posts extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Posts the static model class
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
		return '{{posts}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('topic_id, content, author_edit_id, created_at', 'required'),
			array('author_id, topic_id, author_edit_id', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('updated_at, created_at', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, author_id, topic_id, content, author_edit_id, updated_at, created_at', 'safe', 'on'=>'search'),
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
			'topic' => array(self::BELONGS_TO, 'Topics', 'topic_id'),
			'author' => array(self::BELONGS_TO, 'Members', 'author_id'),
			'authorEdit' => array(self::BELONGS_TO, 'Members', 'author_edit_id'),
			'topics' => array(self::HAS_MANY, 'Topics', 'first_post_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'author_id' => 'Author',
			'topic_id' => 'Topic',
			'content' => 'Content',
			'author_edit_id' => 'Author Edit',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('author_id',$this->author_id);
		$criteria->compare('topic_id',$this->topic_id);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('author_edit_id',$this->author_edit_id);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}