<?php

use yii\db\Migration;

/**
 * Handles the creation of table `gtransactions`.
 */
class m170819_144624_create_gtransactions_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gtransactions}}', [
            'id'                      => $this->primaryKey(),
            'clientId'                => $this->integer()->notNull()->comment("Client who asks for the transaction"),
            'accountClientId'         => $this->integer()->notNull()->comment("Account involved in the transaction."),
            'accountAdminIdTo'        => $this->integer()->null()->comment("Admin Bank Account the client transfered the money to."),
            'accountAdminIdFrom'      => $this->integer()->null()->comment("Admin Bank Account the admin transfered the money back to the client."),
            'amountFrom'              => $this->double(2)->notNull()->comment("Transfered amount of money to be converted"),
            'amountTo'                => $this->double(2)->null()->comment("Amount of money after being converted and transfered to the client."),
            'currencyIdFrom'          => $this->integer()->notNull()->comment("Currency Id From"),
            'currencyIdTo'            => $this->integer()->notNull()->comment("Currency Id To"),
            'exchangeId'              => $this->integer()->notNull()->comment("Exchange rate used for the transaction"),
            'userId'                  => $this->integer()->null()->comment("Admin user who completes and approves the transaction"),
            'userNameTransaction'     => $this->string()->null()->comment("Name of the person that made the transfer"),
            'clientBankTransaction'   => $this->integer()->null()->comment("Bank transaction Id"),
            'adminBankTransaction'    => $this->integer()->null()->comment("Bank transaction Id"),
            'observation'             => $this->string()->null()->comment("Administrator observation."),
            'sellRateValue'           => $this->double(2)->notNull()->comment("Sell rate value used for the transaction."),
            'buyRateValue'            => $this->double(2)->notNull()->comment("Buy rate value used for the transaction."),
            'usedValue'               => $this->double(2)->notNull()->comment("Rate value used for the transaction."),
            'winnings'                => $this->double(2)->null()->comment("Winnings for this transaction."),
            'status'                  => $this->integer()->notNull()->comment("Status of the transaction: pending, done, cancelled."),
            'uploadFile'              => $this->string()->null()->comment("Receipt file name"),
            'transactionDate'         => $this->date()->notNull()->comment("Date when the transaction was made."),
            'transactionResponseDate' => $this->date()->null()->comment("Date when the transaction was responded."),

            'created_at' => $this->integer()->null()->comment("Creation date of the transaction."),
            'updated_at' => $this->integer()->null()->comment("Update date of the transaction."),
        ], $tableOptions);

        // Client
        $this->addForeignKey('fk-gtransactions-clientId', 'gtransactions', 'clientId', 'gclients', 'id');

        // Client's bank account
        $this->addForeignKey('fk-gtransactions-accountClientId', 'gtransactions', 'accountClientId', 'gaccounts_clients', 'id');

        // Admin's bank account
        $this->addForeignKey('fk-gtransactions-accountAdminIdTo', 'gtransactions', 'accountAdminIdTo', 'gaccounts_admin', 'id');

        // User who completes and approves the transaction
        $this->addForeignKey('fk-gtransactions-userId', 'gtransactions', 'userId', 'gsystem_users', 'id');

        // Currency From
        $this->addForeignKey('fk-gcurrencies-currencyIdFrom', 'gtransactions', 'currencyIdFrom', 'gcurrencies', 'id');

        // Currency To
        $this->addForeignKey('fk-gcurrencies-currencyIdTo', 'gtransactions', 'currencyIdTo', 'gcurrencies', 'id');

        // Exchange rate used
        $this->addForeignKey('fk-gtransactions-exchangeId', 'gtransactions', 'exchangeId', 'gexchange_rates', 'id');

        // Admin's bank account
        $this->addForeignKey('fk-gtransactions-accountAdminIdFrom', 'gtransactions', 'accountAdminIdFrom', 'gaccounts_admin', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%gtransactions}}');
    }
}
