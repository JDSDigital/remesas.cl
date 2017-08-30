<?php

use yii\db\Migration;

/**
 * Handles the creation of table `gcurrencies`.
 */
class m170819_143748_create_gcurrencies_table extends Migration
{
    public function up(){
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gcurrencies}}', [
            'id'             => $this->primaryKey(),
            'name'           => $this->string()->notNull()->comment("Name of the currency"),
            'symbol'         => $this->string()->notNull()->comment("Symbol of the currency")
        ], $tableOptions);
        
        $this->insert('{{%gcurrencies}}', [
            'id'            => 1,
            'name'          => 'Peso Chileno',
            'symbol'        => 'CLP'
        ]);
        
        $this->insert('{{%gcurrencies}}', [
            'id'            => 2,
            'name'          => 'Bolívar',
            'symbol'        => 'VEF'
        ]);
    }

    public function down(){
        $this->dropTable('{{%gcurrencies}}');
    }
}
