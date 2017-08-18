<?php

use yii\db\Migration;

class m170817_205720_clients_table extends Migration
{
    public function up(){
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gclients}}', [
            'id'             => $this->primaryKey(),
            'name'           => $this->string()->notNull()->comment("Client\'s name"),
            'lastName'       => $this->string()->notNull()->comment("Client\'s lastname"),
            'rut'            => $this->string()->notNull()->comment("Client\'s personal id"),
            'phone'          => $this->string()->notNull()->comment("Client\'s phone number"),
            'mobile'         => $this->string()->notNull()->comment("Client\'s mobile number"),
            'email'          => $this->string()->notNull()->comment("Client\'s email"),
            'login'          => $this->string()->notNull()->comment("Client\'s webpage login"),
            'password'       => $this->string()->notNull()->comment("Client\'s webpage password"),
            'status'         => $this->boolean()->notNull()->defaultValue(false)->comment("Client\'s status. It depends on the activation after the client registers on the webpage."),
            'blocked'        => $this->boolean()->notNull()->defaultValue(false)->comment("It indicates if the client has been blocked by the webmaster for various reasons."),

            'created_at'     => $this->integer()->null()->comment("Client\'s creation date."),
            'updated_at'     => $this->integer()->null()->comment("Client\'s update date"),
        ], $tableOptions);
    }

    public function down(){
        $this->dropTable('{{%gclients}}');
    }
}
