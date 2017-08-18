<?php

use yii\db\Migration;

class m170818_153159_accounts_admin_table extends Migration
{
    $tableOptions = null;
    if ($this->db->driverName === 'mysql') {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
    }

    $this->createTable('{{%gaccounts_admin}}', [
        'id'            => $this->primaryKey(),
        'bankId'        => $this->integer()->notNull()->comment("Bank of the account."),
        'number'        => $this->string()->notNull()->comment("Number of the bank account"),
        'type'          => $this->string()->notNull()->comment("Type of account"),
        'description'   => $this->string()->notNull()->comment("Description of the account"),
        'name'          => $this->string()->notNull()->comment("Owner of the account\s name."),
        'lastname'      => $this->string()->notNull()->comment("Owner of the account\s lastname."),
        'rut'           => $this->string()->notNull()->comment("Owner\'s personal id"),
        'email'         => $this->string()->notNull()->comment("Owner\'s email"),
        'minAmount'     => $this->integer()->notNull()->comment("Minimal amount for the transactions with this account."),
        'maxAmount'     => $this->integer()->notNull()->comment("Maximum amount for the transactions with this account."),
        'currencyId'    => $this->integer()->notNull()->comment("Currency of the account."),
        'status'        => $this->boolean()->notNull()->defaultValue(true)->comment("Account\'s status. Indicates if the account is available for transactions.")
    ], $tableOptions);
    
    // Bank
    $this->addForeignKey(
        'fk-gaccounts_admin-bankId',
        'gaccounts_admin',
        'bankId',
        'gbanks',
        'id'
    );
    
    // Currency
    $this->addForeignKey(
        'fk-gaccounts_admin-currencyId',
        'gaccounts_admin',
        'currencyId',
        'gcurrencies',
        'id'
    );
}
