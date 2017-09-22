<?php

/* @var $this yii\web\View */

$this->title = 'Cuentas disponibles';
?>
<div class="site-index container">
    <div class="row">
        <div class="col-lg-12">
            <h2>Cuentas disponibles</h2>
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
                                    echo "<tr><td>".$account['country']."</td>"
                                        ."<td>".$account['bank']."</td>"
                                        ."<td>".$account['number']."</td>"
                                        ."<td>".ucfirst($account['type'])."</td>"
                                        ."<td>".$account['name']." ".$account['lastname']."</td>"
                                        ."<td>".$account['rut']."</td>"
                                        ."<td>".$account['email']."</td></tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
