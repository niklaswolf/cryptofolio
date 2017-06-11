<?php

use yii\db\Migration;

class m170606_190755_createTables extends Migration
{
    public function up()
    {
    	
		$this->createTable("currencies", [
			'currency_id' => $this->primaryKey()->unsigned(),
			'name' => $this->string()->notNull(),
			'symbol' => $this->string(10)->notNull(),
			'url' => $this->string()->defaultValue(null),
			'api_identificator' => $this->string()->notNull()
		]);
		
		$this->createTable("transactions", [
			'transaction_id' => $this->primaryKey()->unsigned(),
			'from_currency_id' => $this->integer()->unsigned()->notNull(),
			'amount_from' => $this->float(8)->notNull(),
			'to_currency_id' => $this->integer()->unsigned()->notNull(),
			'amount_to' => $this->float(8)->notNull(),
			'exchange_btc' => $this->float(8)->notNull(),
			'exchange_btc_eur' => $this->float(2)->notNull(),
			'value_eur' => $this->float(2)->notNull(),
			'timestamp' => $this->timestamp()->defaultExpression("CURRENT_TIMESTAMP")->notNull(),		
		]);
		
		$this->addForeignKey("fk_transactions_currencies_from", "transactions", "from_currency_id", "currencies", "currency_id");
		$this->addForeignKey("fk_transactions_currencies_to", "transactions", "to_currency_id", "currencies", "currency_id");
    }

    public function down()
    {    	
    	$this->dropForeignKey("fk_transactions_currencies_from", "transactions");
    	$this->dropForeignKey("fk_transactions_currencies_to", "transactions");
        $this->dropTable("currencies");
        $this->dropTable("transactions");
    }
}
