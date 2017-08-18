<?php

use yii\db\Migration;

class m170818_150021_banks_table extends Migration
{
    $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%gbanks}}', [
            'id'             => $this->primaryKey(),
            'countryId'      => $this->integer()->notNull()->comment("Country of the bank."),
            'name'           => $this->string()->notNull()->comment("Name of the bank")
        ], $tableOptions);
        
        // Country
        $this->addForeignKey(
            'fk-gbanks-countryId',
            'gbanks',
            'countryId',
            'gcountries',
            'id'
        );
    }

    public function down(){
        $this->dropTable('{{%gbanks}}');
    }
}
