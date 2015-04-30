<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "equipamento_servico".
 *
 * @property integer $equipamento_id
 * @property integer $servico_id
 *
 * @property Equipamento $equipamento
 */
class EquipamentoServico extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipamento_servico';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['equipamento_id', 'servico_id'], 'required'],
            [['equipamento_id', 'servico_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'equipamento_id' => 'Equipamento ID',
            'servico_id' => 'Servico ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipamento()
    {
        return $this->hasOne(Equipamento::className(), ['id' => 'equipamento_id']);
    }
}
