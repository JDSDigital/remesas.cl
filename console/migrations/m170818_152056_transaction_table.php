<?php

use yii\db\Migration;

class m170818_152056_transaction_table extends Migration
{
    public function up(){
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gtransactions}}', [
            'id'                    => $this->primaryKey(),
            'clienId'               => $this->integer()->notNull()->comment("Client who asks for the transaction"),
            'accountClientId'       => $this->integer()->notNull()->comment("Client\'s account involved in the transaction."),
            'accountAdminId'        => $this->integer()->null()->comment("Admin\'s account involved in the transaction."),
            'amountFrom'            => $this->double(2)->notNull()->comment("Transfered amount of money to be converted"),
            'amountTo'              => $this->double(2)->null()->comment("Amount of money after being converted and transfered to the client."),
            'exchangeId'            => $this->integer()->null()->comment("Exchange rate used for the transaction"),
            'userId'                => $this->integer()->null()->comment("Admin user who completes and approves the transaction"),
            'clientBankTransaction' => $this->integer()->null()->comment("Client\'s bank transaction Id"),
            'adminBankTransaction'  => $this->integer()->null()->comment("Admin\'s bank transaction Id"),
            'observation'           => $this->string()->null()->comment("Administrator's observation."),
            'status'                => $this->integer()->notNull()->comment("Status of the transaction: pending, done, cancelled."),
            
            'created_at'            => $this->integer()->null()->comment("Creation date of the transaction."),
            'updated_at'            => $this->integer()->null()->comment("Update date of the transaction.")
        ], $tableOptions);
        
        // Client
        $this->addForeignKey(
            'fk-gtransactions-clientId',
            'gtransactions',
            'clientId',
            'gclients',
            'id'
        );
        
        // Client's bank account
        $this->addForeignKey(
            'fk-gtransactions-accountClientId',
            'gtransactions',
            'accountClientId',
            'gaccounts_clients',
            'id'
        );
        
        // Admin's bank account
        $this->addForeignKey(
            'fk-gtransactions-accountAdminId',
            'gtransactions',
            'accountAdminId',
            'gaccounts_admin',
            'id'
        );
        
        // Exchange rate used
        $this->addForeignKey(
            'fk-gtransactions-exchangeId',
            'gtransactions',
            'exchangeId',
            'gexchange_rates',
            'id'
        );
        
        // User who completes and approves the transaction
        $this->addForeignKey(
            'fk-gtransactions-userId',
            'gtransactions',
            'userId',
            'gsystem_users',
            'id'
        );
    }

    public function down(){
        $this->dropTable('{{%gtransactions}}');
    }
}
