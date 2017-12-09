<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

//$this->title = 'Quienes Somos';
//$this->params['breadcrumbs'][] = $this->title;
?>
<section id="faq" class="color0">
    <div class="title">
        <h1><?= Html::encode("Preguntas Frecuentes") ?></h1>
    </div>
    <!-- section content -->
    <section class="pt30 pb30">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel-group" id="accordion">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        <i class="icon-star-filled"></i>¿Tienen oficina?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in" >
                                <div class="panel-body">
                                    <p>Por los momentos no todas las transacciones se hacen de manera virtual a través de nuestra página web o whatsapp +569 67169874</p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                        <i class="icon-star-filled"></i>¿Cuánto es el minimo que puedo transferir?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseTwo" class="panel-collapse collapse" >
                                <div class="panel-body">
                                    <p>El monto mínimo por cuenta es de 20.000 pesos</p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                        <i class="icon-star-filled"></i>¿Si cancelo hoy cuando recibo mi dinero?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseThree" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>Manejamos la política de no retención del dinero, esto significa que el pago se realizara el mismo día que se reciban los pesos por orden de cliente, salvo el caso de otros bancos que no sean (Banesco o mercantil) la transacción se realiza el mismo día, pero se hace efectivo al día siguiente.</p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                        <i class="icon-star-filled"></i>¿Cuáles son los bancos con los que trabajan en Venezuela?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFour" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>Banesco y mercantil por los momentos.</p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                        <i class="icon-star-filled"></i>¿Cuáles son los bancos en chile?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseFive" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>Manejamos una cuenta banco Falabella.</p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                                        <i class="icon-star-filled"></i>¿Si realizo una transferencia de otro banco que no sea Falabella cuando la reciben?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSix" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>Se recibe el mismo día sin importar el banco las transferencias se hacen efectivas en minutos.</p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven">
                                        <i class="icon-star-filled"></i>¿Aceptan efectivo?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseSeven" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>No todas las transacciones son electrónicas, deposito o transferencia tanto de pesos como de bolívares no aceptamos efectivo de ningún tipo.</p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEight">
                                        <i class="icon-star-filled"></i>¿Trabajan con dólares?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseEight" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>Por los momentos la empresa solo trabaja con bolívares y pesos chilenos.</p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseNine">
                                        <i class="icon-star-filled"></i>¿Si la tasa sufre algunos cambios en el día eso me afecta?
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseNine" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>No la tasa se congela al momento de recibir la transferencia.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
