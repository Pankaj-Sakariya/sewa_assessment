<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Topic;

/**
 * TopicSearch represents the model behind the search form about `app\models\Topic`.
 */
class TopicSearch extends Topic
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',  'number_of_question_to_be_ask', 'is_active'], 'integer'],
            [['topic_name', 'created_at', 'modified_by','subject_id',], 'safe'],
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
        $query = Topic::find();

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
            //'subject_id' => $this->subject_id,
            'number_of_question_to_be_ask' => $this->number_of_question_to_be_ask,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'modified_by' => $this->modified_by,
        ]);
        $query->andFilterWhere(['like', 'subject_id', $this->subject_id]);
        $query->andFilterWhere(['like', 'topic_name', $this->topic_name]);

        return $dataProvider;
    }
}
