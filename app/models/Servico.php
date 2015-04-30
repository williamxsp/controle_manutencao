<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "servico".
 *
 * @property integer $id
 * @property string $data
 * @property string $custo
 * @property string $inicio
 * @property string $termino
 * @property integer $tempo
 * @property integer $manutencao_id
 * @property string $peca
 *
 * @property Manutencao $manutencao
 */
class Servico extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servico';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data', 'inicio', 'termino'], 'safe'],
            [['custo', 'inicio', 'termino', 'tempo', 'manutencao_id', 'peca'], 'required'],
            [['custo'], 'number'],
            [['tempo', 'manutencao_id'], 'integer'],
            [['peca'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Data',
            'custo' => 'Custo',
            'inicio' => 'Inicio',
            'termino' => 'Termino',
            'tempo' => 'Tempo',
            'manutencao_id' => 'Manutencao',
            'peca' => 'Peca',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManutencao()
    {
        return $this->hasOne(Manutencao::className(), ['id' => 'manutencao_id']);
    }
}
