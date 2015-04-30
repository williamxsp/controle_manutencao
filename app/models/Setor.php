<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "setor".
 *
 * @property integer $id
 * @property string $descricao
 *
 * @property Equipamento[] $equipamentos
 */
class Setor extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'setor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Setor',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipamentos()
    {
        return $this->hasMany(Equipamento::className(), ['setor_id' => 'id']);
    }

    public static function getAllAsArray()
    {
        $setores = Setor::find()->all();
        if($setores)
        {
            return \yii\helpers\ArrayHelper::map($setores, 'id', 'descricao');
        }
        else{
            return ['' => ''];
        }
    }
}
