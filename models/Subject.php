<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subject".
 *
 * @property integer $id
 * @property string $subject_name
 * @property integer $is_active
 * @property string $created_at
 * @property string $modified_by
 *
 * @property ExamBasicInformation[] $examBasicInformations
 * @property Topic[] $topics
 */
class Subject extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subject';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_name', 'is_active'], 'required'],
            [['is_active'], 'integer'],
            [['created_at', 'modified_by'], 'safe'],
            [['subject_name'], 'string', 'max' => 255],

            //Subject Name validation
            ['subject_name', 'match' ,
                'pattern'=> '/^[A-Za-z0-9_ ]+$/u',
                'message'=> 'Subject Name can contain only [a-zA-Z0-9_].'],

            ['subject_name', 'unique','message'=>'Subject Name already exists!']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'subject_name' => 'Subject Name',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamBasicInformations()
    {
        return $this->hasMany(ExamBasicInformation::className(), ['subject_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTopics()
    {
        return $this->hasMany(Topic::className(), ['subject_id' => 'id']);
    }
}
