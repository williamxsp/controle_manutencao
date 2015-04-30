<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "manutencao".
 *
 * @property integer $id
 * @property integer $equipamento_id
 * @property integer $usuario_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Equipamento $equipamento
 * @property Servico[] $servicos
 * @property Usuario $usuario
 */
class Manutencao extends \yii\db\ActiveRecord
{

    public $equipamentoDescricao;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'manutencao';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['equipamento_id', 'usuario_id'], 'required'],
            [['equipamento_id', 'usuario_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'equipamento_id' => 'Equipamento ID',
            'usuario_id' => 'Usuario ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipamento()
    {
        return $this->hasOne(Equipamento::className(), ['id' => 'equipamento_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id' => 'usuario_id']);
    }
    public function getServicos()
    {
        return $this->hasMany(Servico::className(), ['manutencao_id' => 'id']);
    }

    public function beforeValidate()
    {
        $this->usuario_id = Yii::$app->user->id;
        return true;
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_at = new Expression('UTC_TIMESTAMP()');
            $this->updated_at = $this->created_at;
        } else {
            $this->updated_at = new Expression('UTC_TIMESTAMP()');
        }

        return parent::beforeSave($insert);
    }


}
