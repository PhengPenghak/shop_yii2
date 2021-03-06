<?php

namespace backend\models;

use backend\models\Product;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ProductSearch represents the model behind the search form of `backend\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public $globalSearch, $from_date, $to_date;

    public function rules()
    {
        return [
            [['id', 'category_id', 'created_by'], 'integer'],
            [['status', 'name', 'globalSearch', 'created_date', 'price', 'image_url', 'description'], 'safe'],
            [['globalSearch', 'from_date', 'to_date'], 'safe'],
            [['rate'], 'number'],
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

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
            'category_id' => $this->category_id,
            'rate' => $this->rate,
            'created_date' => $this->created_date,
            'created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['between', 'DATE(created_date)', $this->from_date, $this->to_date])
            ->andFilterWhere([
                'OR',

                ['like', 'status', $this->globalSearch],
                ['like', 'price', $this->globalSearch],
                ['like', 'created_date', $this->globalSearch],

            ]);

        $query->FilterWhere(['like', 'code', $this->globalSearch])
            ->FilterWhere(['like', 'product.name', $this->globalSearch]);

        return $dataProvider;
    }
}
