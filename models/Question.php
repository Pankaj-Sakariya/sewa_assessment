<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property integer $id
 * @property integer $topic_id
 * @property string $question_name
 * @property integer $weightage_for_question
 * @property integer $number_of_answer
 * @property integer $correct_answer
 * @property integer $is_active
 * @property string $created_at
 * @property string $modified_by
 *
 * @property Answer[] $answers
 * @property Answer $correctAnswer
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
            [['topic_id', 'question_name', 'weightage_for_question', 'is_active'], 'required'],
            [[ 'weightage_for_question'], 'integer'],
            
            //Topic Name validation
            ['weightage_for_question', 'match' ,
                'pattern'=> '/^[0-9]+$/u',
                'message'=> 'This field can contain only [0-9].'],
            //[['question_name'], 'string'],
            [['topic_id', 'question_name', 'weightage_for_question', 'is_active','created_at', 'modified_by'], 'safe']
           
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'topic_id' => 'Topic Name',
            'question_name' => 'Question Name',
            'weightage_for_question' => 'Weightage For Question',
           // 'number_of_answer' => 'Number Of Answer',
            'correct_answer' => 'Correct Answer',
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
    public function getCorrectAnswer()
    {
        return $this->hasOne(Answer::className(), ['id' => 'correct_answer']);
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
//    display_array($path_info);
//    exit;
        $this->image->saveAs('uploads/question/' . $id . '.' . $path_info['extension']);

        //$this->beneficiary_photograph->saveAs('uploads/beneficiary/' . $id . '.'.$path_info['extension']);
        return true;

    }
}
