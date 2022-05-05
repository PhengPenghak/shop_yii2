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
    public $globalSearch;
    public $start_date;
    public $end_date;
    public function rules()
    {
        return [
            [['id', 'category_id', 'created_by'], 'integer'],
            [['status', 'name', 'globalSearch', 'created_date', 'price', 'image_url', 'description'], 'safe'],
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

        $query->andFilterWhere(['like', 'name', $this->name])

            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'image_url', $this->image_url])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'Created_date', $this->created_date]);

        $query->FilterWhere(['like', 'code', $this->globalSearch])
            ->FilterWhere(['like', 'product.name', $this->globalSearch]);

        return $dataProvider;
    }
}
