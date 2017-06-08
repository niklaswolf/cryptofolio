<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transactions".
 *
 * @property integer $transaction_id
 * @property integer $from_currency_id
 * @property integer $to_currency_id
 * @property double $amount
 * @property double $exchange_btc
 * @property double $exchange_btc_eur
 * @property double $value_eur
 * @property string $timestamp
 *
 * @property Currencies $fromCurrency
 * @property Currencies $toCurrency
 */
class Transactions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transactions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_currency_id', 'to_currency_id', 'amount', 'exchange_btc', 'exchange_btc_eur', 'value_eur'], 'required'],
            [['from_currency_id', 'to_currency_id'], 'integer'],
            [['amount', 'exchange_btc', 'exchange_btc_eur', 'value_eur'], 'number'],
            [['timestamp'], 'safe'],
            [['from_currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['from_currency_id' => 'currency_id']],
            [['to_currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currencies::className(), 'targetAttribute' => ['to_currency_id' => 'currency_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'transaction_id' => Yii::t('app', 'Transaction ID'),
            'from_currency_id' => Yii::t('app', 'From Currency ID'),
            'to_currency_id' => Yii::t('app', 'To Currency ID'),
            'amount' => Yii::t('app', 'Amount'),
            'exchange_btc' => Yii::t('app', 'Exchange Btc'),
            'exchange_btc_eur' => Yii::t('app', 'Exchange Btc Eur'),
            'value_eur' => Yii::t('app', 'Value Eur'),
            'timestamp' => Yii::t('app', 'Timestamp'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromCurrency()
    {
        return $this->hasOne(Currencies::className(), ['currency_id' => 'from_currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToCurrency()
    {
        return $this->hasOne(Currencies::className(), ['currency_id' => 'to_currency_id']);
    }
}
