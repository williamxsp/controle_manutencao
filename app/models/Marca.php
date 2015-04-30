<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "marca".
 *
 * @property integer $id
 * @property string $descricao
 *
 * @property Equipamento[] $equipamentos
 */
class Marca extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'marca';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descricao'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descricao' => 'Marca',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipamentos()
    {
        return $this->hasMany(Equipamento::className(), ['marca_id' => 'id']);
    }

    public static function getAllAsArray()
    {
        $marcas =Marca::find()->all();
        if($marcas)
        {
            return \yii\helpers\ArrayHelper::map($marcas, 'id', 'descricao');
        }
        else{
           return ['' => ''];
        }


    }
}
