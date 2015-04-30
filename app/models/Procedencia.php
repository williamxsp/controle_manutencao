<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "procedencia".
 *
 * @property integer $id
 * @property string $descricao
 *
 * @property Equipamento[] $equipamentos
 */
class Procedencia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'procedencia';
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
            'descricao' => 'Procedência',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipamentos()
    {
        return $this->hasMany(Equipamento::className(), ['procedencia_id' => 'id']);
    }

    public static function getAllAsArray()
    {
        $procedencias =Procedencia::find()->all();
        if($procedencias)
        {
            return \yii\helpers\ArrayHelper::map($procedencias, 'id', 'descricao');
        }
        else{
            return ['' => ''];
        }
    }
}
