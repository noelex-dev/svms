<?php

namespace common\models\searches;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\StudentInformation;

/**
 * StudentInformationSearch represents the model behind the search form of `common\models\StudentInformation`.
 */
class StudentInformationSearch extends StudentInformation
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'four_p_status', 'created_at', 'updated_at'], 'integer'],
            [['language', 'early_disease', 'serious_accident', 'hobby', 'special_talent', 'easy_subject', 'hard_subject'], 'safe'],
            [['height', 'weight'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
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
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = StudentInformation::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'height' => $this->height,
            'weight' => $this->weight,
            'four_p_status' => $this->four_p_status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'language', $this->language])
            ->andFilterWhere(['like', 'early_disease', $this->early_disease])
            ->andFilterWhere(['like', 'serious_accident', $this->serious_accident])
            ->andFilterWhere(['like', 'hobby', $this->hobby])
            ->andFilterWhere(['like', 'special_talent', $this->special_talent])
            ->andFilterWhere(['like', 'easy_subject', $this->easy_subject])
            ->andFilterWhere(['like', 'hard_subject', $this->hard_subject]);

        return $dataProvider;
    }
}
