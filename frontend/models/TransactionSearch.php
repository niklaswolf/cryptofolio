<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Transactions;

/**
 * TransactionSearch represents the model behind the search form about `common\models\Transactions`.
 */
class TransactionSearch extends Transactions
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['transaction_id', 'from_currency_id', 'to_currency_id'], 'integer'],
            [['amount_from', 'amount_to','exchange_btc', 'exchange_btc_eur', 'value_eur'], 'number'],
            [['timestamp'], 'safe'],
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
        $query = Transactions::find()->orderBy("timestamp DESC");

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
            'transaction_id' => $this->transaction_id,
            'from_currency_id' => $this->from_currency_id,
        	'amount_from' => $this->amount_from,
            'to_currency_id' => $this->to_currency_id,
            'amount_to' => $this->amount_to,
            'exchange_btc' => $this->exchange_btc,
            'exchange_btc_eur' => $this->exchange_btc_eur,
            'value_eur' => $this->value_eur,
            'timestamp' => $this->timestamp,
        ]);

        return $dataProvider;
    }
}
