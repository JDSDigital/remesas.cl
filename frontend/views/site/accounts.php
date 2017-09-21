<?php

/* @var $this yii\web\View */

$this->title = 'Cuentas disponibles';
echo '<pre>';
print_r($accounts);
echo '</pre>';
exit;
?>
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
                <h2>Cuentas disponibles</h2>
                <?php 
                    if (isset($accounts)){
                        foreach ($accounts as $account){
                            echo "<p>".$account['country']."</p>"
                                ."<p>".$account['bank']."</p>"
                                ."<p>".$account['number']."</p>"
                                ."<p>".$account['type']."</p>"
                                ."<p>".$account['name']." ".$account['lastname']."</p>"       
                                ."<p>".$account['rut']."</p>"
                                ."<p>".$account['email']."</p>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>
