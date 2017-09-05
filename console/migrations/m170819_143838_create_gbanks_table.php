<?php

use yii\db\Migration;

/**
 * Handles the creation of table `gbanks`.
 */
class m170819_143838_create_gbanks_table extends Migration
{
    public function up(){
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
        
        // Venezuela Banks
        $this->insert('{{%gbanks}}', ['id' => 1, 'countryId' => 2, 'name' => '100% Banco']);
        $this->insert('{{%gbanks}}', ['id' => 2, 'countryId' => 2, 'name' => 'Banco de Venezuela']); 
        $this->insert('{{%gbanks}}', ['id' => 3, 'countryId' => 2, 'name' => 'Banco del Caribe C.A.']); 
        $this->insert('{{%gbanks}}', ['id' => 4, 'countryId' => 2, 'name' => 'Banco del Tesoro']); 
        $this->insert('{{%gbanks}}', ['id' => 5, 'countryId' => 2, 'name' => 'Banco Exterior C.A.']); 
        $this->insert('{{%gbanks}}', ['id' => 6, 'countryId' => 2, 'name' => 'Banco Mercantil C.A.']);
        $this->insert('{{%gbanks}}', ['id' => 7, 'countryId' => 2, 'name' => 'Banco Nacional de Crédito']);
        $this->insert('{{%gbanks}}', ['id' => 8, 'countryId' => 2, 'name' => 'Banco Occidental de Descuento']);
        $this->insert('{{%gbanks}}', ['id' => 9, 'countryId' => 2, 'name' => 'Banco Plaza']);
        $this->insert('{{%gbanks}}', ['id' => 10, 'countryId' => 2, 'name' => 'Banco Provincial BBVA']);
        $this->insert('{{%gbanks}}', ['id' => 11, 'countryId' => 2, 'name' => 'Banco Venezolano de Crédito S.A.']);
        $this->insert('{{%gbanks}}', ['id' => 12, 'countryId' => 2, 'name' => 'Bancoro']);
        $this->insert('{{%gbanks}}', ['id' => 13, 'countryId' => 2, 'name' => 'Bancrecer S.A. Banco de Desarrollo']);
        $this->insert('{{%gbanks}}', ['id' => 14, 'countryId' => 2, 'name' => 'Banesco']);
        $this->insert('{{%gbanks}}', ['id' => 15, 'countryId' => 2, 'name' => 'Bangente']);
        $this->insert('{{%gbanks}}', ['id' => 16, 'countryId' => 2, 'name' => 'Banorte']);
        $this->insert('{{%gbanks}}', ['id' => 17, 'countryId' => 2, 'name' => 'Banplus Banco Comercial C.A']);
        $this->insert('{{%gbanks}}', ['id' => 18, 'countryId' => 2, 'name' => 'Banvalor']);
        $this->insert('{{%gbanks}}', ['id' => 19, 'countryId' => 2, 'name' => 'Central banco Universal']);
        $this->insert('{{%gbanks}}', ['id' => 20, 'countryId' => 2, 'name' => 'CitiBank']);
        $this->insert('{{%gbanks}}', ['id' => 21, 'countryId' => 2, 'name' => 'Del Sur Banco Universal']);
        $this->insert('{{%gbanks}}', ['id' => 22, 'countryId' => 2, 'name' => 'BFC Banco Fondo Común']);
        $this->insert('{{%gbanks}}', ['id' => 23, 'countryId' => 2, 'name' => 'Mi Banco Banco de Desarrollo, C.A.']);
        $this->insert('{{%gbanks}}', ['id' => 24, 'countryId' => 2, 'name' => 'Sofitasa']);
        $this->insert('{{%gbanks}}', ['id' => 25, 'countryId' => 2, 'name' => 'Banco Bicentenario']);
        
        // Chile Banks
        // Venezuela Banks
        $this->insert('{{%gbanks}}', ['id' => 26, 'countryId' => 1, 'name' => 'BancoEstado']);
        $this->insert('{{%gbanks}}', ['id' => 27, 'countryId' => 1, 'name' => 'Banco de Chile']); 
        $this->insert('{{%gbanks}}', ['id' => 28, 'countryId' => 1, 'name' => 'Banco Santander Chile']); 
        $this->insert('{{%gbanks}}', ['id' => 29, 'countryId' => 1, 'name' => 'BBVA Chile']); 
        $this->insert('{{%gbanks}}', ['id' => 30, 'countryId' => 1, 'name' => 'BCI Banco de Crédito e Inversiones']); 
        $this->insert('{{%gbanks}}', ['id' => 31, 'countryId' => 1, 'name' => 'Banco Falabella']);
        $this->insert('{{%gbanks}}', ['id' => 32, 'countryId' => 1, 'name' => 'Banco BICE']);
        $this->insert('{{%gbanks}}', ['id' => 33, 'countryId' => 1, 'name' => 'Banco Edwards']);
        $this->insert('{{%gbanks}}', ['id' => 34, 'countryId' => 1, 'name' => 'Scotiabank Chile']);

    }

    public function down(){
        $this->dropTable('{{%gbanks}}');
    }
}
