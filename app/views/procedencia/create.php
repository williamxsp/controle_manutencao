<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Procedencia */

$this->title = 'Create Procedencia';
$this->params['breadcrumbs'][] = ['label' => 'Procedencias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="procedencia-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
