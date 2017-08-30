<?php

use yii\db\Migration;

/**
 * Handles the creation of table `gexchange_rates`.
 */
class m170819_144448_create_gexchange_rates_table extends Migration
{
    public function up(){
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gexchange_rates}}', [
            'id'             => $this->primaryKey(),
            'currencyIdFrom' => $this->integer()->notNull()->comment("From currency."),
            'currencyIdTo'   => $this->integer()->notNull()->comment("To currency."),
            'sellValue'      => $this->double(2)->notNull()->comment("Value you have to multiply the From currency for in order to get the To currency."),
            'buyValue'       => $this->double(2)->notNull()->comment("Value you have to divide the To currency for in order to get the From currency."),
            'description'    => $this->string()->null()->comment("Description of the exchange"),
            'status'         => $this->boolean()->notNull()->defaultValue(true)->comment("Status. Indicates if the exchange is available for transactions."),
            
            'created_at'     => $this->integer()->null()->comment("Creation date of the exchange rate."),
            'updated_at'     => $this->integer()->null()->comment("Update date of the exchange rate.")
        ], $tableOptions);
        
        // From Currency
        $this->addForeignKey(
            'fk-gexchange_rates-currencyIdFrom',
            'gexchange_rates',
            'currencyIdFrom',
            'gcurrencies',
            'id'
        );
        
        // To Currency
        $this->addForeignKey(
            'fk-gexchange_rates-currencyIdTo',
            'gexchange_rates',
            'currencyIdTo',
            'gcurrencies',
            'id'
        );
    }

    public function down(){
        $this->dropTable('{{%gexchange_rates}}');
    }
}
