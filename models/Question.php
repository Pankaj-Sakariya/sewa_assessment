<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property integer $topic_id
 * @property string $question_name
 * @property string $image
 * @property integer $weightage_for_question
 * @property integer $number_of_answer
 * @property integer $is_active
 * @property string $created_at
 * @property string $modified_by
 *
 * @property Answer[] $answers
 * @property Topic $topic
 */
class Question extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['topic_id', 'question_name', 'image', 'weightage_for_question', 'number_of_answer', 'is_active', 'created_at'], 'required'],
            [['topic_id', 'weightage_for_question', 'number_of_answer', 'is_active'], 'integer'],
            [['question_name'], 'string'],
            [['topic_id', 'question_name','weightage_for_question','number_of_answer','is_active','created_at', 'modified_by'], 'safe'],
            [['image'], 'file'],
            [['topic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Topic::className(), 'targetAttribute' => ['topic_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'topic_id' => 'Topic ID',
            'question_name' => 'Question Name',
            'image' => 'Image',
            'weightage_for_question' => 'Weightage For Question',
            'number_of_answer' => 'Number Of Answer',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAnswers()
    {
        return $this->hasMany(Answer::className(), ['question_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopic()
    {
        return $this->hasOne(Topic::className(), ['id' => 'topic_id']);
    }
    
    public function upload($id)
    {
        $path_info = pathinfo($this->image->name);

//        echo $path_info['extension']; // "bill"
//        exit;
        
        $this->image->saveAs('uploads/question/' . $id . '.'.$path_info['extension']);
        return true;
    }
}
