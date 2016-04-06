<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Question;

/**
 * QuestionSearch represents the model behind the search form about `app\models\Question`.
 */
class QuestionSearch extends Question
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'topic_id', 'weightage_for_question', 'number_of_answer', 'correct_answer', 'is_active'], 'integer'],
            [['question_name', 'created_at', 'modified_by'], 'safe'],
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
        $query = Question::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'topic_id' => $this->topic_id,
            'weightage_for_question' => $this->weightage_for_question,
            'number_of_answer' => $this->number_of_answer,
            'correct_answer' => $this->correct_answer,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'modified_by' => $this->modified_by,
        ]);

        $query->andFilterWhere(['like', 'question_name', $this->question_name]);

        return $dataProvider;
    }
}
