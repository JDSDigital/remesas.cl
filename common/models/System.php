<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class System extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%gsystem_config}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['domain', 'company', 'title', 'name', 'email'], 'required'],
            [
                [
                    'domain',
                    'company',
                    'rif',
                    'title',
                    'name',
                    'phone',
                    'phoneAlt',
                    'mobile',
                    'mobileAlt',
                    'address',
                    'logo',
                    'icon',
                    'facebook',
                    'twitter',
                    'youtube',
                    'skype',
                    'linkedin',
                    'pinterest',
                    'googlePlus',
                    'instagram',
                    'vimeo',
                    'smtpUser',
                    'smtpPass',
                    'smtpHost',
                    'smtpPort',
                    'smtpEncryption',
                ],
                'string',
            ],
            [['email'], 'email'],
        ];
    }
}