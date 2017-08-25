<?php

/* @var $this yii\web\View */

$this->title = 'Cuentas disponibles';
?>
<div class="site-index">
    <div class="body-content">
    
        
        <div class="row">
            <div class="col-lg-12">
                <h2>Cuentas disponibles</h2>
                <?php 
                    if (isset($accounts)){
                        print_r($accounts);
                        /*foreach ($accounts as $account){
                            echo "<p>"
                                 .""       
                            
                            "</p>"
                        }*/
                    }
                ?>
            </div>
            
        </div>
        
    </div>
</div>
