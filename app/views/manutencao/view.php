<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Manutencao */

$this->title = $model->equipamento->nome;
$this->params['breadcrumbs'][] = ['label' => 'ManutençÕes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manutencao-view">

    <div>
        <h1 class="col-md-9"><?= Html::encode($this->title) ?> </h1>
        <div class="col-md-3 pull-right text-right">
            <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Remover', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Tem certeza que deseja remover essa manutenção?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>

    </div>

    <p>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'equipamento_id',
            'usuario_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

<h3>Serviços Executados</h3>
    <?= \yii\grid\GridView::widget([
        'dataProvider' => $servicoDataProvider,
        'columns' => [

            'id',
            [
                'attribute' => 'data',
                'label' => 'Data',
                'value' =>function($servico){return Yii::$app->formatter->asDate($servico->data);}
            ],
            [
                'attribute' => 'custo',
                'label' => 'Custo',
                'value' =>function($servico){return Yii::$app->formatter->asCurrency($servico->custo);}
            ],
            [
                'attribute' => 'tempo',
                'label' => 'Tempo',
                'value' =>function($servico){return Yii::$app->formatter->asTime(date_create_from_format('h', $servico->tempo));}
            ],
            'peca',
        ],
    ]); ?>

</div>
