<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "currencies".
 *
 * @property integer $currency_id
 * @property string $name
 * @property string $symbol
 * @property string $url
 *
 * @property Transactions[] $transactionsOutgoing
 * @property Transactions[] $transactionsIncoming
 */
class Currencies extends \yii\db\ActiveRecord
{
	public $current;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'currencies';
    }
    
    public function afterFind(){
    	$this->current = $this->getAmount();
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
     * get the current amount of this currency
     * @return number
     */
    public function getAmount(){
    	$incoming = 0;
    	$outgoing = 0;
    	foreach ($this->transactionsIncoming as $t){
    		$incoming += $t->amount_to;
    	}
    	foreach ($this->transactionsOutgoing as $t){
    		$outgoing += $t->amount_from;
    	}
    	
    	return $incoming -$outgoing;
    }
    
    
    public function getTransactions(){
    	return Transactions::find()->where(['or',['from_currency_id' => $this->currency_id],[
    				'to_currency_id' => $this->currency_id
    			]
    	])->all();
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionsOutgoing()
    {
        return $this->hasMany(Transactions::className(), ['from_currency_id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionsIncoming()
    {
        return $this->hasMany(Transactions::className(), ['to_currency_id' => 'currency_id']);
    }
}
