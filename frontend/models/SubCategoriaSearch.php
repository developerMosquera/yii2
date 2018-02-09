<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SubCategoria;

/**
 * SubCategoriaSearch represents the model behind the search form of `app\models\SubCategoria`.
 */
class SubCategoriaSearch extends SubCategoria
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idSubCategoria', 'idCategoria', 'estadoSubCategoria'], 'integer'],
            [['SubCategoria'], 'safe'],
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
        $query = SubCategoria::find();

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
            'idSubCategoria' => $this->idSubCategoria,
            'idCategoria' => $this->idCategoria,
            'estadoSubCategoria' => $this->estadoSubCategoria,
        ]);

        $query->andFilterWhere(['like', 'SubCategoria', $this->SubCategoria]);

        return $dataProvider;
    }
}
