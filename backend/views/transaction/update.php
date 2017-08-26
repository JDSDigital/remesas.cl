<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\Country;

$this->title = 'Geknology';
?>
<div class="site-index panel">
    <div class="page-header panel-heading mb0">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h3><?= Html::encode('Modificar Transaccion') ?></h3>
                </div>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="body-content">
        <div class="row panel panel-flat">
            <div class="col-md-5 ml20">
                <?php $form = ActiveForm::begin(['id' => 'form-transaction']); ?>
                <?= $form->field($model, 'name')->label("Nombre")->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'countryId')->dropDownList(
                        ArrayHelper::map(Country::find()->orderBy('name')->all(), 'id', 'name'), ['class' => 'form-control']
                ) ?>
                <div class="form-group">
                    <?= Html::submitButton('Actualizar', ['class' => 'btn btn-primary', 'name' => 'form-transaction-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
