<?php

use yii\db\Migration;

class m170414_204335_system_config extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gsystem_config}}', [
            'id'             => $this->primaryKey(),
            'domain'         => $this->string()->notNull(),
            'company'        => $this->string()->notNull(),
            'rut'            => $this->string()->notNull(),
            'title'          => $this->string()->notNull(),
            'name'           => $this->string()->notNull(),
            'phone'          => $this->string()->null(),
            'phoneAlt'       => $this->string()->null(),
            'mobile'         => $this->string()->null(),
            'mobileAlt'      => $this->string()->null(),
            'address'        => $this->string()->null(),
            'logo'           => $this->string()->null(),
            'icon'           => $this->string()->null(),
            'email'          => $this->string()->notNull(),
            'facebook'       => $this->string()->null(),
            'twitter'        => $this->string()->null(),
            'youtube'        => $this->string()->null(),
            'skype'          => $this->string()->null(),
            'linkedin'       => $this->string()->null(),
            'pinterest'      => $this->string()->null(),
            'googlePlus'     => $this->string()->null(),
            'instagram'      => $this->string()->null(),
            'vimeo'          => $this->string()->null(),
            'smtpUser'       => $this->string()->null(),
            'smtpPass'       => $this->string()->null(),
            'smtpHost'       => $this->string()->null(),
            'smtpPort'       => $this->string()->null(),
            'smtpEncryption' => $this->string()->null(),

            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('{{%gsystem_config}}', [
            'domain'         => 'geknology.com',
            'company'        => 'Geknology',
            'rut'            => 'J-12345678-9',
            'title'          => 'Mi Web',
            'name'           => 'Daniel Sosa',
            'phone'          => '+582121234567',
            'mobile'         => '+584241234567',
            'email'          => 'jdsdigital@gmail.com',
            'smtpUser'       => 'jdsdigital@gmail.com',
            'smtpPass'       => '123456',
            'smtpHost'       => 'mail.google.com',
            'smtpPort'       => '465',
            'smtpEncryption' => 'ssl',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%gsystem_config}}');
    }
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
