<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "currencies".
 *
 * @property integer $currency_id
 * @property string $name
 * @property string $symbol
 * @property string $url
 *
 * @property Transactions[] $transactions
 * @property Transactions[] $transactions0
 */
class Currencies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currencies';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'symbol'], 'required'],
            [['name', 'url'], 'string', 'max' => 255],
            [['symbol'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'currency_id' => Yii::t('app', 'Currency ID'),
            'name' => Yii::t('app', 'Name'),
            'symbol' => Yii::t('app', 'Symbol'),
            'url' => Yii::t('app', 'Url'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transactions::className(), ['from_currency_id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions0()
    {
        return $this->hasMany(Transactions::className(), ['to_currency_id' => 'currency_id']);
    }
}
