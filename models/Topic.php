<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "topic".
 *
 * @property integer $id
 * @property integer $subject_id
 * @property string $topic_name
 * @property integer $number_of_question_to_be_ask
 * @property integer $is_active
 * @property string $created_at
 * @property string $modified_by
 *
 * @property Question[] $questions
 * @property Subject $subject
 */
class Topic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'topic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_id', 'topic_name', 'is_active'], 'required'],
            [[ 'number_of_question_to_be_ask', 'is_active'], 'integer'],
            [['created_at', 'modified_by','subject_id'], 'safe'],
            [['topic_name'], 'string', 'max' => 255],
            ['topic_name', 'unique','message'=>'Topic Name already exists!'],

            //Topic Name validation
            ['topic_name', 'match' ,
                'pattern'=> '/^[A-Za-z0-9_ ]+$/u',
                'message'=> 'Topic Name can contain only [a-zA-Z0-9_ ].'],
            [['number_of_question_to_be_ask'], 'integer', 'max' => 1000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject_id' => 'Subject Name',
            'topic_name' => 'Topic Name',
            'number_of_question_to_be_ask' => 'Number Of Questions To Be Asked',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['topic_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }
}
