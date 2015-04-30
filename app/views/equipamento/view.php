<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Equipamento */

$this->title = $model->getNomeNI();
$this->params['breadcrumbs'][] = ['label' => 'Equipamentos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipamento-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'marca.descricao',
            'setor.descricao',
            'procedencia.descricao',
            'nome',
            'descricao:ntext',
            [
                'attribute' => 'data_aquisicao',
                'value' => $model->data_aquisicao
            ],
            [
                'attribute' => 'created_at',
                'value' => Yii::$app->formatter->asDate($model->created_at)
            ],
            [
                'attribute' => 'updated_at',
                'value' => Yii::$app->formatter->asDate($model->updated_at)
            ],
        ],
    ]) ?>

</div>
