<?php

/* @var $this yii\web\View */

use common\models\AccountAdmin;
use yii\helpers\Html;

$account = new AccountAdmin();
$accounts = $account->getActiveAccounts();
$this->title = 'Paso 3: Transferir a las siguientes cuentas';
?>
<div class="site-index container pt30">
    <div class="row">
        <div class="col-lg-12">
            <h1><?= Html::encode($this->title) ?></h1>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>País</th>
                            <th>Banco</th>
                            <th>Número de cuenta</th>
                            <th>Tipo de cuenta</th>
                            <th>Nombre</th>
                            <th>Cédula / RUT</th>
                            <th>Correo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (isset($accounts)){
                                foreach ($accounts as $account){
                                    echo "<tr><td>".$account->country->name."</td>"
                                        ."<td>".$account->bank->name."</td>"
                                        ."<td>".$account->number."</td>"
                                        ."<td>".ucfirst($account->type)."</td>"
                                        ."<td>".$account->name." ".$account->lastname."</td>"
                                        ."<td>".$account->rut."</td>"
                                        ."<td>".$account->email."</td></tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <?= Html::a('Continuar', ['//transaction/index'], ['id' => 'btn-continue', 'class' => 'btn btn-lg btn-success mb30'])?>
        </div>
    </div>
</div>
