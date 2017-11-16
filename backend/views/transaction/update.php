<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use common\models\AccountAdmin;
use common\models\Country;
$this->title = 'Geknology';
?>
<div class="site-index">
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
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-flat pl20 pr20">
                <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
                <?= Html::label("Monto a convertir") ?>
                <?= Html::label(Yii::$app->formatter->asCurrency($model->amountFrom, $model->currencyFrom->symbol)) ?>
                <?= Html::label("De") ?>
                <?= Html::label($model->currencyFrom->name) ?>
                <?= Html::label("A") ?>
                <?= Html::label($model->currencyTo->name) ?>
                 <?= $form->field($model, 'status')->label("Estado")->dropDownList([
                        '0' => 'Pendiente',
                        '1' => 'Anulada',
                        '2' => 'Realizada'
                    ], ['class' => 'form-control']) ?>
                <div class="hideField">
                <?php 
                    if (Yii::$app->user->identity->role == 'admin' || Yii::$app->user->identity->role == 'root'){
                        echo $form->field($model, 'usedValue')->label("Tasa")->textInput((Yii::$app->user->identity->role != 'root') ? ['disabled' => 'true'] : []);
                        echo $form->field($model, 'amountTo')->label("Monto convertido")->textInput((Yii::$app->user->identity->role != 'root') ? ['disabled' => 'true'] : []);
                    }
                    else {
                        echo $form->field($model, 'amountTo')->label("Monto transferido")->textInput((Yii::$app->user->identity->role != 'root') ? ['disabled' => 'true'] : []);
                    }     
                ?>
                
                <?= $form->field($model, 'transactionResponseDate')->label("Fecha de la transaccion")->widget(DatePicker::classname(), [
                         'language' => 'es',
                         'dateFormat' => 'dd-MM-yyyy',
                         'clientOptions' => [
                            'maxDate' => '0'
                         ]
                ])?>
                <?php 
                    if (Yii::$app->user->identity->role == 'admin' || Yii::$app->user->identity->role == 'root'){
                        echo $form->field($model, 'winnings')->label("Ganancia por esta transaccion"); 
                    }
                ?>
                </div>
                <?= $form->field($model, 'observation')->label("Observacion") ?>
                
                <div class="panel panel-default hideField">
                    <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Transferencias</h4></div>
                    <div class="panel-body">
                         <?php DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                            'widgetBody' => '.container-items', // required: css class selector
                            'widgetItem' => '.item', // required: css class
                            'limit' => 4, // the maximum times, an element can be cloned (default 999)
                            'min' => 1, // 0 or 1 (default 1)
                            'insertButton' => '.add-item', // css class
                            'deleteButton' => '.remove-item', // css class
                            'model' => $modelsParts[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'accountAdminIdFrom',
                                'adminBankTransaction',
                                'amountTo'
                            ],
                        ]); ?>
            
                        <div class="container-items"><!-- widgetContainer -->
                        <?php foreach ($modelsParts as $i => $modelPart): ?>
                            <div class="item panel panel-default"><!-- widgetBody -->
                                <div class="panel-heading">
                                    <h3 class="panel-title pull-left">Transferencia</h3>
                                    <div class="pull-right">
                                        <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                        <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <?php
                                        // necessary for update action.
                                        if (! $modelPart->isNewRecord) {
                                            echo Html::activeHiddenInput($modelPart, "[{$i}]id");
                                        }
                                    ?>
                                    <div class="row">
                                        <?= $form->field($modelPart, "[{$i}]accountAdminIdFrom")->label("Cuenta desde donde transfirió el dinero")->dropDownList(
                                            ArrayHelper::map(AccountAdmin::find()->where('status = 1 and currencyId = '.$model->currencyIdTo)->orderBy('description')->all(), 'id', 'description'), ['class' => 'form-control']
                                        ) ?>
                                    </div>
                                    <div class="row">
                                        <?= $form->field($modelPart, "[{$i}]adminBankTransaction")->label("Numero de Deposito o Transferencia") ?>
                                    </div>
                                    <div class="row">
                                        <?= $form->field($modelPart, "[{$i}]amountTo")->label("Monto")->textInput(); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <?= Html::submitButton('Actualizar', ['class' => 'btn btn-primary', 'name' => 'form-transaction-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<?php $this->registerJs('hideFields();') ?>