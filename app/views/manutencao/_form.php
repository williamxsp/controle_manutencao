<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Equipamento;
use kartik\typeahead\TypeaheadBasic;
use \app\models\Servico;
use kartik\date\DatePicker;
use kartik\money\MaskMoney;

/* @var $this yii\web\View */
/* @var $model app\models\Manutencao */
/* @var $form yii\widgets\ActiveForm */

?>
<script>

    var _index = <?= count($servicos);?>;

    function selectedItem(event, item) {

        var id = parseInt(item.value);
        document.getElementById('manutencao-equipamento_id').value = id;
    }

    function removerServico(id)
    {
        if(document.querySelectorAll('.servico').length > 1)
        document.querySelector("[data-servico-id='" + id + "']").remove();
    }

    function novoServico() {
        var s = document.querySelector('.servico').cloneNode(true);
        s.querySelector('[name*="data"]').setAttribute('name', 'Servico['+ _index + '][data]');

        var custo =s.querySelector('[name*="custo"');
        jQuery(custo).maskMoney(maskMoney_626a8545);

        custo.setAttribute('name', 'Servico['+ _index + '][custo]');
        s.querySelector('[name*="inicio"').setAttribute('name', 'Servico['+ _index + '][inicio]');
        s.querySelector('[name*="termino"').setAttribute('name', 'Servico['+ _index + '][termino]');
        s.querySelector('[name*="tempo"').setAttribute('name', 'Servico['+ _index + '][tempo]');
        s.querySelector('[name*="peca"').setAttribute('name', 'Servico['+ _index + '][peca]');

        var ss = document.querySelector('#servicos');
        ss.appendChild(s);

        _index++;
    }


</script>


<div class="manutencao-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php


    if($model->isNewRecord)
    {

       echo $form->field($model, 'equipamento_id')->hiddenInput();
        echo TypeaheadBasic::widget([
            'model' => $model,
            'attribute' => 'equipamentoDescricao',
            'data' => Equipamento::getAllAsArray(),
            'options' => ['placeholder' => 'Digite o NI ou nome do equipamento', 'value' => $model->isNewRecord ?  '' : $model->id . ' - ' . $model->equipamento->descricao],
            'pluginOptions' => ['highlight' => true],
            'pluginEvents' => [
                'typeahead:selected' => 'selectedItem'
            ]
        ]);
    }
    else
    {
        echo $form->field($model, 'equipamento_id', ['options' => ['readonly' => true]]);
    }


    ?>

    <h1>Serviços</h1>

    <div id="servicos">

        <?php foreach($servicos as $key=>$servico): ?>
        <div class="row servico" data-servico-id="<?= $key ?>">

            <div class="servico-form">


                <div class="col-md-2 col-xs-2">
                    <?=
                    DatePicker::widget([
                        'model' => $servico,
                        'attribute' => 'data',
                        'type' => DatePicker::TYPE_INPUT,
                        'options' => [
                            'placeholder' => 'Data',
                            'value' => $model->isNewRecord ?  Yii::$app->formatter->asDate(date('d-m-Y')) : Yii::$app->formatter->asDate($servico->data),
                            'name' => "Servico[$key][data]",
                            'id' => "servico_" . $key . "_data",
                            'data-id' => 'data'
                        ],
                        'pluginOptions' => [
                            'format' => 'dd/mm/yyyy',
                            'todayHighlight' => true,
                            'autoclose'=> true
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-md-2 col-xs-2">
                    <?= $form->field($servico, 'custo')->widget(MaskMoney::classname(), [
                        'pluginOptions' => [
                            'prefix' => 'R$ ',
                            'suffix' => '',
                            'allowNegative' => false,

                        ],
                        'options' =>
                        [
                            'name' => "Servico[$key][custo]",
                            'id' => "servico_" . $key . "_custo"
                        ]
                    ])->label(false);
                    ?>

                </div>
                <div class="col-md-2 col-xs-2">
                    <?=
                    DatePicker::widget([
                        'model' => $servico,
                        'attribute' => 'inicio',
                        'type' => DatePicker::TYPE_INPUT,
                        'options' => [
                            'placeholder' => 'Início',
                            'value' => $model->isNewRecord ? Yii::$app->formatter->asDate(date('d-m-Y')) : Yii::$app->formatter->asDate($servico->inicio),
                            'name' => "Servico[$key][inicio]",
                            'id' => "servico_" . $key . "_inicio"
                        ],
                        'pluginOptions' => [
                            'format' => 'dd/mm/yyyy',
                            'todayHighlight' => true,
                            'autoclose'=> true
                        ]
                    ]);
                    ?>
                </div>
                <div class="col-md-2 col-xs-2">
                    <?=
                    DatePicker::widget([
                        'model' => $servico,
                        'attribute' => 'termino',
                        'type' => DatePicker::TYPE_INPUT,
                        'options' => [
                            'placeholder' => 'Término',
                            'value' => $model->isNewRecord ? Yii::$app->formatter->asDate(date('d-m-Y')) : Yii::$app->formatter->asDate($servico->termino),
                            'name' => "Servico[$key][termino]",
                            'id' => "servico_" . $key . "_termino"
                        ],
                        'pluginOptions' => [
                            'format' => 'dd/mm/yyyy',
                            'todayHighlight' => true,
                            'autoclose'=> true
                        ]
                    ]);
                    ?>
                </div>

                <div class="col-md-2 col-xs-2">
                    <?= $form->field($servico, 'tempo')->textInput(['placeholder' => 'Tempo', 'type'=> 'number', 'class' => 'tempo form-control', 'name' => "Servico[$key][tempo]"])->label(false) ?>
                </div>
                <div class="col-md-2 col-xs-2">
                    <?= Html::button('Remover', ['class' => 'btn btn-danger pull-right', 'onclick' => "js:removerServico($key)"]) ?>
                </div>

                <div class="col-md-12 col-xs-12">
                    <?= $form->field($servico, 'peca')->textInput(['placeholder' => 'Peça', 'class' => 'peca form-control', 'name' => "Servico[$key][peca]"])->label(false) ?>
                </div>



            </div>
        </div>
        <?php endforeach; ?>

    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="form-group">
                <?= Html::button('Novo Serviço', ['class' => 'btn btn-primary pull-right', 'onclick' => 'js:novoServico()']) ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Finalizar Manutenção' : 'Atualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php $form->end(); ?>

</div>




