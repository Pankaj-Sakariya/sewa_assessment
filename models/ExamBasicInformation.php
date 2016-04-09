<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "exam_basic_information".
 *
 * @property integer $id
 * @property integer $subject_id
 * @property integer $no_of_question_for_exam
 * @property string $time_for_exam
 * @property string $exam_secret_code
 * @property integer $is_active
 * @property string $created_at
 * @property string $modified_by
 *
 * @property Subject $subject
 */
class ExamBasicInformation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam_basic_information';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['subject_id', 'no_of_question_for_exam', 'time_for_exam', 'exam_secret_code', 'is_active'], 'required'],
            [['subject_id', 'no_of_question_for_exam', 'is_active'], 'integer'],
            [['time_for_exam', 'created_at', 'modified_by','time_for_exam'], 'safe'],
            [['exam_secret_code'], 'string', 'max' => 255],
            //[['exam_secret_code','subject_id'], 'unique'],
           // [['subject_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subject::className(), 'targetAttribute' => ['subject_id' => 'id']],
           [['subject_id'],'unique','message'=>'Subject Name has already been taken.'],
            [['exam_secret_code'],'unique','message'=>'Subject code has already been taken.'],
//            ['subject_id', function ($attribute, $params) {
//               $fetch = Subject::find()->where($this->subject_id)->all();
////               display_array($fetch);
////               exit;
//                if (!$fetch($this->$attribute)) {
//                    $this->addError($attribute, 'The token must contain letters or digits.');
//                }
//            }],
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
            'no_of_question_for_exam' => 'No Of Question For Exam',
            'time_for_exam' => 'Time For Exam',
            'exam_secret_code' => 'Exam Secret Code',
            'is_active' => 'Is Active',
            'created_at' => 'Created At',
            'modified_by' => 'Modified By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubject()
    {
        return $this->hasOne(Subject::className(), ['id' => 'subject_id']);
    }
}
