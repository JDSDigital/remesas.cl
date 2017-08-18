<?php

use yii\db\Migration;

class m170818_151521_currency_table extends Migration
{
    public function up(){
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gcurrencies}}', [
            'id'             => $this->primaryKey(),
            'name'           => $this->string()->notNull()->comment("Name of the currency"),
            'symbol'         => $this->string()->notNull()->comment("Symbol of the currency")
        ], $tableOptions);
    }

    public function down(){
        $this->dropTable('{{%gcurrencies}}');
    }
}
