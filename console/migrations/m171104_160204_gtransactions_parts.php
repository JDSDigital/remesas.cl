<?php

use yii\db\Migration;

class m171104_160204_gtransactions_parts extends Migration
{
    public function up(){
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%gtransactions_parts}}', [
            'id'                        => $this->primaryKey(),
            'transactionId'             => $this->integer()->notNull()->comment("Id of the pending transaction related to the refund process."),
            'accountAdminIdFrom'        => $this->integer()->notNull()->comment("Admin Bank Account the admin transfered the money back to the client."),
            'adminBankTransaction'      => $this->integer()->notNull()->comment("Bank transaction Id"),
            'transactionResponseDate'   => $this->date()->notNull()->comment("Date when the transaction was responded."),
            'amountTo'                  => $this->double(2)->notNull()->comment("Amount of money after being converted and transfered to the client."),
            'uploadFile'                => $this->string()->null()->comment("Receipt file name"),
        ], $tableOptions);
        
        // Transaction
        $this->addForeignKey(
            'fk-gtransactions_parts-transactionId',
            'gtransactions_parts',
            'transactionId',
            'gtransactions',
            'id'
        );
        
        // Admin's bank account
        $this->addForeignKey(
            'fk-gtransactions_parts-accountAdminIdFrom',
            'gtransactions_parts',
            'accountAdminIdFrom',
            'gaccounts_admin',
            'id'
        );
    }

    public function down(){
        $this->dropForeignKey('fk-gtransactions_parts-transactionId', '{{%gtransactions_parts}}');
        $this->dropForeignKey('fk-gtransactions_parts-accountAdminIdFrom', '{{%gtransactions_parts}}');
        $this->dropTable('{{%gtransactions_parts}}');
    }
}
