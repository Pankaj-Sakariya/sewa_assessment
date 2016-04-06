<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "answer".
 *
 * @property integer $id
 * @property integer $question_id
 * @property string $answer_name
 * @property integer $is_active
 * @property string $created_at
 * @property string $modified_by
 *
 * @property Question $question
 * @property Question[] $questions
 */
class Answer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_id', 'answer_name', 'is_active'], 'required'],
            [['question_id', 'is_active'], 'integer'],
            [['created_at', 'modified_by'], 'safe'],
            [['answer_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'Question ID',
            'answer_name' => 'Answer Name',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestions()
    {
        return $this->hasMany(Question::className(), ['correct_answer' => 'id']);
    }
}
