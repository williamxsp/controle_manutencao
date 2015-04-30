<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Servico */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="servico-form">

    <?php $form = ActiveForm::begin(['layout' => 'inline']); ?>

    <?= $form->field($model, 'data')->textInput() ?>

    <?= $form->field($model, 'custo')->textInput(['maxlength' => 6]) ?>

    <?= $form->field($model, 'inicio')->textInput() ?>

    <?= $form->field($model, 'termino')->textInput() ?>

    <?= $form->field($model, 'tempo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
