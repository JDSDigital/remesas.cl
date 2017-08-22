<?php

use yii\db\Migration;

/**
 * Handles the creation of table `gclients`.
 */
class m170819_144027_create_gclients_table extends Migration
{
    public function up(){
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gclients}}', [
            'id'                    => $this->primaryKey(),
            'name'                  => $this->string()->notNull()->comment("Name"),
            'lastName'              => $this->string()->notNull()->comment("Lastname"),
            'rut'                   => $this->string()->notNull()->comment("Personal id"),
            'phone'                 => $this->string()->notNull()->comment("Phone number"),
            'mobile'                => $this->string()->notNull()->comment("Mobile number"),
            'email'                 => $this->string()->notNull()->unique()->comment("Email"),
            'username'              => $this->string()->notNull()->unique()->comment("Webpage login"),
            'role'                  => $this->string()->notNull()->comment("User level"),
            'auth_key'              => $this->string(32)->notNull(),
            'password_hash'         => $this->string()->notNull()->comment("Webpage password"),
            'password_reset_token'  => $this->string()->unique(),
            'status'                => $this->smallInteger()->notNull()->defaultValue(0)->comment("Status. It depends on the activation after the client registers on the webpage."),
            'blocked'               => $this->smallInteger()->notNull()->defaultValue(0)->comment("It indicates if the client has been blocked by the webmaster for various reasons."),

            'created_at'            => $this->integer()->null()->comment("Creation date."),
            'updated_at'            => $this->integer()->null()->comment("Update date"),
        ], $tableOptions);
    }

    public function down(){
        $this->dropTable('{{%gclients}}');
    }
}
