<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "servico_peca".
 *
 * @property integer $id_servico
 * @property integer $id_peca
 * @property string $comprada_fabricada
 */
class ServicoPeca extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'servico_peca';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_servico', 'id_peca', 'comprada_fabricada'], 'required'],
            [['id_servico', 'id_peca'], 'integer'],
            [['comprada_fabricada'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_servico' => 'Id Servico',
            'id_peca' => 'Id Peca',
            'comprada_fabricada' => 'Comprada Fabricada',
        ];
    }
}
