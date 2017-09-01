<?php

use yii\db\Migration;

/**
 * Handles the creation of table `gaccounts_admin`.
 */
class m170819_144232_create_gaccounts_admin_table extends Migration
{
    public function up()
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
            'name'          => $this->string()->notNull()->comment("Name."),
            'lastname'      => $this->string()->notNull()->comment("Lastname."),
            'rut'           => $this->string()->notNull()->comment("Personal id"),
            'email'         => $this->string()->notNull()->comment("Email"),
            'minAmount'     => $this->double(2)->notNull()->comment("Minimal amount for the transactions with this account."),
            'maxAmount'     => $this->double(2)->notNull()->comment("Maximum amount for the transactions with this account."),
            'currencyId'    => $this->integer()->notNull()->comment("Currency of the account."),
            'status'        => $this->boolean()->notNull()->defaultValue(false)->comment("Status. Indicates if the account is available for transactions.")
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

    public function down(){
        $this->dropTable('{{%gaccounts_admin}}');
    }
}
