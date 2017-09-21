<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use common\models\Country;

$this->title = 'Geknology';
?>
<div class="site-index">
    <div class="page-header panel-heading mb0">
        <div class="row">
            <div class="col-md-6">
                <div class="page-title">
                    <h3><?= Html::encode('Agregar Banco') ?></h3>
                </div>
            </div>
            <div class="col-md-6">
                <p class="text-right mt20">
                    <?= Html::a('<i class="fa fa-lg fa-plus-circle position-left"></i> Agregar Banco', ['create'], ['class' => 'btn btn-primary']) ?>
                </p>
            </div>
        </div>
    </div>
    <!-- /page header -->
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-flat pl20 pr20">
                <?php $form = ActiveForm::begin(['id' => 'form-bank']); ?>
                    <?= $form->field($model, 'name')->label("Nombre")->textInput(['autofocus' => true]) ?>
                    <?= $form->field($model, 'countryId')->label("Pais")->dropDownList(
                        ArrayHelper::map(Country::find()->orderBy('name')->all(), 'id', 'name'), ['class' => 'form-control']
                    ) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Crear Banco', ['class' => 'btn btn-primary', 'name' => 'form-bank-button']) ?>
                    </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
