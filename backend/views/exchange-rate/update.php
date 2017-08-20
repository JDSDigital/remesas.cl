<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\Currency;

$this->title = 'Geknology';
?>
<div class="site-index panel">
    <div class="page-header panel-heading mb0">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h3><?= Html::encode('Modificar Tasa de Cambio') ?></h3>
                </div>
            </div>
            <div class="col-md-6">
                <p class="text-right mt20">
                    <?= Html::a('Agregar Tasa de Cambio', ['create'], ['class' => 'btn']) ?>
                </p>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="body-content">
        <div class="row panel panel-flat">
            <div class="col-md-5 ml20">
                    <?php $form = ActiveForm::begin(['id' => 'form-exchange-rate']); ?>
                    <?= $form->field($model, 'description')->label("Descripcion")->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'currencyIdFrom')->label("De")->dropDownList(
                        ArrayHelper::map(Currency::find()->orderBy('name')->all(), 'id', 'name'), ['class' => 'form-control']
                    ) ?>
                    <?= $form->field($model, 'currencyIdTo')->label("A")->dropDownList(
                        ArrayHelper::map(Currency::find()->orderBy('name')->all(), 'id', 'name'), ['class' => 'form-control']
                    ) ?>
                    <?= $form->field($model, 'value')->label("Tasa") ?>
                    <div class="form-group">
                        <?= Html::submitButton('Crear Tasa de Cambio', ['class' => 'btn btn-primary', 'name' => 'form-exchange-rate-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
