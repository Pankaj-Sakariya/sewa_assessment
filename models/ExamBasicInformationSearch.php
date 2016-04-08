<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ExamBasicInformation;

/**
 * ExamBasicInformationSearch represents the model behind the search form about `app\models\ExamBasicInformation`.
 */
class ExamBasicInformationSearch extends ExamBasicInformation
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'subject_id', 'no_of_question_for_exam', 'is_active'], 'integer'],
            [['time_for_exam', 'exam_secret_code', 'created_at', 'modified_by'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ExamBasicInformation::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'subject_id' => $this->subject_id,
            'no_of_question_for_exam' => $this->no_of_question_for_exam,
            'time_for_exam' => $this->time_for_exam,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'modified_by' => $this->modified_by,
        ]);

        $query->andFilterWhere(['like', 'exam_secret_code', $this->exam_secret_code]);

        return $dataProvider;
    }
}
