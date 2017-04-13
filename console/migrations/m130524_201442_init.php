<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gsystem_users}}', [
            'id'                   => $this->primaryKey(),
            'username'             => $this->string()->notNull()->unique(),
            'role'                 => $this->string()->notNull(),
            'auth_key'             => $this->string(32)->notNull(),
            'password_hash'        => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email'                => $this->string()->notNull()->unique(),

            'status'     => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->insert('{{%gsystem_users}}', [
            'username'      => 'Admin',
            'role'          => 'admin',
            'auth_key'      => '8yodFzc4J0-0efBA6uJaymkejpVS6qlg',
            'password_hash' => '$2y$13$anHn/UT2OXHjJp9Yt99ct.RjfMCPsHLvPPK.DjaTEc0dcp0yRPu4K',
            'email'         => 'jdsosa@gmail.com',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%gsystem_users}}');
    }
}
