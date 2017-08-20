<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gbanks".
 *
 * @property integer $id
 * @property integer $countryId
 * @property string $name
 *
 * @property AccountAdmin[] $accountsAdmin
 * @property AccountClient[] $accountsClients
 * @property Country $country
 */
class Bank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gbanks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['countryId', 'name'], 'required'],
            [['countryId'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['countryId'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['countryId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'countryName' => 'Country',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountsAdmin()
    {
        return $this->hasMany(AccountAdmin::className(), ['bankId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAccountsClients()
    {
        return $this->hasMany(AccountClient::className(), ['bankId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'countryId']);
    }
    
    /* Getter for country name */
    public function getCountryName() {
        return $this->country->name;
    }
}
