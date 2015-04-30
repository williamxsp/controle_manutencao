<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "manutencao_servico".
 *
 * @property integer $manutencao_id
 * @property integer $servico_id
 *
 * @property Manutencao $manutencao
 */
class ManutencaoServico extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manutencao_servico';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['manutencao_id', 'servico_id'], 'required'],
            [['manutencao_id', 'servico_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'manutencao_id' => 'Manutencao ID',
            'servico_id' => 'Servico ID',
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
