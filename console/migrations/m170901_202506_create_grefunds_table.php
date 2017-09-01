<?php

use yii\db\Migration;

/**
 * Handles the creation of table `grefunds`.
 */
class m170901_202506_create_grefunds_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up(){
        
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        
        $this->createTable('{{%grefunds}}', [
            'id'              => $this->primaryKey(),
            'clientId'        => $this->integer()->notNull()->comment("Client who asks for the refund"),
            'transactionId'   => $this->integer()->notNull()->comment("Id of the pending transaction related to the refund process."),
            'motivation'      => $this->string()->notNull()->comment("Motivation for asking for a refund."),
            'userId'          => $this->integer()->null()->comment("Admin user who completes the refund process."),
            'status'          => $this->integer()->notNull()->comment("Status of the refund process: pending, done, dismissed"),
            'responseDate'    => $this->date()->null()->comment("Date when the refund was responded."),
            'observation'     => $this->string()->null()->comment("Administrator observation."),
            
            'created_at'      => $this->integer()->null()->comment("Creation date."),
            'updated_at'      => $this->integer()->null()->comment("Update date"),
        ], $tableOptions);
        
        // Client
        $this->addForeignKey(
            'fk-grefunds-clientId',
            'grefunds',
            'clientId',
            'gclients',
            'id'
        );
        
        // Transaction
        $this->addForeignKey(
            'fk-grefunds-transactionId',
            'grefunds',
            'transactionId',
            'gtransactions',
            'id'
        );
        
        // User who completes and approves the transaction
        $this->addForeignKey(
            'fk-grefunds-userId',
            'grefunds',
            'userId',
            'gsystem_users',
            'id'
        );
    }

    /**
     * @inheritdoc
     */
    public function down(){
        $this->dropTable('{{%grefunds}}');
    }
}
