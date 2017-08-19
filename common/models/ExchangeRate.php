<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "gexchange_rates".
 *
 * @property integer $id
 * @property integer $currencyIdFrom
 * @property integer $currencyIdTo
 * @property double $value
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Currency $currencyFrom
 * @property Currency $currencyTo
 * @property Transaction[] $transactions
 */
class ExchangeRate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gexchange_rates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['currencyIdFrom', 'currencyIdTo', 'value'], 'required'],
            [['currencyIdFrom', 'currencyIdTo', 'created_at', 'updated_at'], 'integer'],
            [['value'], 'number'],
            [['description'], 'string', 'max' => 255],
            [['currencyIdFrom'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currencyIdFrom' => 'id']],
            [['currencyIdTo'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currencyIdTo' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'currencyIdFrom' => 'Currency Id From',
            'currencyIdTo' => 'Currency Id To',
            'value' => 'Value',
            'description' => 'Description',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyFrom()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currencyIdFrom']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrencyTo()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currencyIdTo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['exchangeId' => 'id']);
    }
}
