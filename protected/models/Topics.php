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

/**
 * This is the model class for table "{{topics}}".
 *
 * The followings are the available columns in table '{{topics}}':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $state
 * @property integer $first_post_id
 * @property string $views
 * @property integer $forum_id
 * @property integer $enabled
 * @property string $updated_at
 * @property string $created_at
 *
 * The followings are the available model relations:
 * @property Forums[] $forums
 * @property Posts[] $posts
 * @property Forums $forum
 * @property Posts $firstPost
 */
class Topics extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Topics the static model class
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
		return '{{topics}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, first_post_id, forum_id, created_at', 'required'),
			array('first_post_id, forum_id, enabled', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>250),
			array('description', 'length', 'max'=>70),
			array('state', 'length', 'max'=>8),
			array('views, updated_at, created_at', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, description, state, first_post_id, views, forum_id, enabled, updated_at, created_at', 'safe', 'on'=>'search'),
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
			'forums' => array(self::HAS_MANY, 'Forums', 'last_topic_id'),
			'posts' => array(self::HAS_MANY, 'Posts', 'topic_id'),
			'forum' => array(self::BELONGS_TO, 'Forums', 'forum_id'),
			'firstPost' => array(self::BELONGS_TO, 'Posts', 'first_post_id'),
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
			'description' => 'Description',
			'state' => 'State',
			'first_post_id' => 'First Post',
			'views' => 'Views',
			'forum_id' => 'Forum',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('first_post_id',$this->first_post_id);
		$criteria->compare('views',$this->views,true);
		$criteria->compare('forum_id',$this->forum_id);
		$criteria->compare('enabled',$this->enabled);
		$criteria->compare('updated_at',$this->updated_at,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * Crea un nuevo topic a partir de un arreglo de datos
	 * @param  array $row Colección de datos a insertar en un nuevo registro.
	 * @return boolean Si fue correcto arroja true, false en caso contrario.
	 */
	public static function create(array $row){
		if(!Helpers::array_multi_key_exists('tid|title|description|state|topic_firstpost|views|forum_id|approved|start_date|last_post',$row)) return false;

		$topic = new self;

		$topic->setAttributes(array(
			'id' => $row['tid'],
			'title' => $row['title'],
			'description' => $row['description'],
			'state' => $row['state'],
			'first_post_id' => $row['topic_firstpost'],
			'views' => $row['views'],
			'forum_id' => $row['forum_id'],
			'enabled' => $row['approved'],
			'created_at' => $row['start_date'],
			'updated_at' => $row['last_post'],
		));

		$transaction = null;

		try {
			$transaction = $topic->dbConnection->beginTransaction();

			$return = $topic->save();

			$transaction->commit(); 

			if(!$return) return false;
			
		} catch (Exception $e) {
			if($transaction) $transaction->rollBack();
		}

		return true;
	}
}