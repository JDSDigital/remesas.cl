<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Check Availability form
 */
class CheckForm extends Model
{
    public $rate;
    public $amount;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rate','amount'], 'integer'],
            [['rate','amount'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'rate' => 'Tipo de cambio',
            'amount' => 'Cantidad',
        ];
    }

    public function getRates()
    {
        return ExchangeRate::find()->where(['status' => 1])->all();
    }
}
