<?php

use yii\db\Migration;

class m170818_145911_countries_table extends Migration
{
    public function up(){
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gcountries}}', [
            'id'             => $this->primaryKey(),
            'name'           => $this->string()->notNull()->comment("Name of the country")
        ], $tableOptions);
    }

    public function down(){
        $this->dropTable('{{%gcountries}}');
    }
}
