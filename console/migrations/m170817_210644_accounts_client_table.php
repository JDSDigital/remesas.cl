<?php

use yii\db\Migration;

class m170817_210644_accounts_client_table extends Migration
{
    public function up(){
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gaccounts_clients}}', [
            'id'             => $this->primaryKey(),
            'clienId'        => $this->integer()->notNull()->comment("Client who owns the bank account."),
            'bankId'         => $this->integer()->notNull()->comment("Bank of the account."),
            'number'         => $this->string()->notNull()->comment("Number of the bank account"),
            'type'           => $this->string()->notNull()->comment("Type of account"),
            'currencyId'    => $this->integer()->notNull()->comment("Currency of the account.")
        ], $tableOptions);
        
        // Client
        $this->addForeignKey(
            'fk-gaccounts_clients-clientId',
            'gaccounts_clients',
            'clientId',
            'gclients',
            'id'
        );
        
        // Bank
        $this->addForeignKey(
            'fk-gaccounts_clients-bankId',
            'gaccounts_clients',
            'bankId',
            'gbanks',
            'id'
        );
        
        // Currency
        $this->addForeignKey(
            'fk-gaccounts_clients-currencyId',
            'gaccounts_clients',
            'currencyId',
            'gcurrencies',
            'id'
        );
    }

    public function down(){
        $this->dropTable('{{%gaccounts_clients}}');
    }
}
