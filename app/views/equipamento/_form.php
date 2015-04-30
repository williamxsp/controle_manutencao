<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\typeahead\TypeaheadBasic;
use app\models\Marca;
use app\models\Setor;
use app\models\Procedencia;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Equipamento */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipamento-form">



    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'marcaDescricao')->widget(TypeaheadBasic::className(), [
        'model' => $model,
        'attribute' => 'marcaDescricao',
        'data' =>  Marca::getAllAsArray(),
        'options' => ['placeholder' => 'Digite a marca', 'value' => $model->isNewRecord ? '' : $model->marca->descricao],
            'pluginOptions' => ['highlight'=>true],
    ]); ?>

    <?= $form->field($model, 'setorDescricao')->widget(TypeaheadBasic::className(), [
        'model' => $model,
        'attribute' => 'setorDescricao',
        'data' =>  Setor::getAllAsArray(),
        'options' => ['placeholder' => 'Digite o setor', 'value' => $model->isNewRecord ? '' : $model->setor->descricao],
        'pluginOptions' => ['highlight'=>true],
    ]); ?>


    <?= $form->field($model, 'procedenciaDescricao')->widget(TypeaheadBasic::className(), [
        'model' => $model,
        'attribute' => 'procedenciaDescricao',
        'data' =>  Procedencia::getAllAsArray(),
        'options' => ['placeholder' => 'Digite a procedência', 'value' => $model->isNewRecord ? '' : $model->procedencia->descricao],
        'pluginOptions' => ['highlight'=>true],

    ])?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => 60]) ?>

    <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>

    <?=
     DatePicker::widget([
         'model' => $model,
        'attribute' => 'data_aquisicao',
         'form' => $form,
        'options' => ['placeholder' => 'Selecione a data', 'value' => $model->isNewRecord ? '' : Yii::$app->formatter->asDate($model->data_aquisicao)],
        'pluginOptions' => [
            'format' => 'dd/mm/yyyy',
            'todayHighlight' => true,
            'autoclose' => true
        ]
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
