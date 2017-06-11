<?php
namespace frontend\components\widgets;

use yii\base\Widget;
use common\models\Currencies;

class CurrencyWidget extends Widget {
	
	/**
	 * 
	 * @var Currencies
	 */
	public $currency;
	
	public function init(){
		
	}
	
	public function run (){
		return $this->render('_currency', [
			'currency' => $this->currency,
		]);
	}
}