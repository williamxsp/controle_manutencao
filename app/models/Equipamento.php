<?php

namespace app\models;

use Yii;
use yii\db\Expression;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "equipamento".
 *
 * @property integer $id
 * @property integer $marca_id
 * @property integer $setor_id
 * @property integer $procedencia_id
 * @property string $nome
 * @property string $descricao
 * @property string $data_aquisicao
 * @property string $created_at
 * @property string $updated_at
 *
 * @property EquipamentoServico $id0
 * @property Marca $marca
 * @property Procedencia $procedencia
 * @property Setor $setor
 * @property Manutencao[] $manutencaos
 */
class Equipamento extends \yii\db\ActiveRecord
{

    private $marcaDescricao;
    private $setorDescricao;
    private $procedenciaDescricao;

    /**
     * @return mixed
     */
    public function getMarcaDescricao()
    {
        return $this->marcaDescricao;
    }

    /**
     * @param mixed $marcaDescricao
     */
    public function setMarcaDescricao($marcaDescricao)
    {
        $this->marcaDescricao = $marcaDescricao;
    }

    /**
     * @return mixed
     */
    public function getSetorDescricao()
    {
        return $this->setorDescricao;
    }

    /**
     * @param mixed $setorDescricao
     */
    public function setSetorDescricao($setorDescricao)
    {
        $this->setorDescricao = $setorDescricao;
    }

    /**
     * @return mixed
     */
    public function getProcedenciaDescricao()
    {
        return $this->procedenciaDescricao;
    }

    /**
     * @param mixed $procedenciaDescricao
     */
    public function setProcedenciaDescricao($procedenciaDescricao)
    {
        $this->procedenciaDescricao = $procedenciaDescricao;
    }



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'equipamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'marca_id', 'setor_id', 'procedencia_id'], 'integer'],
            [['id', 'marcaDescricao', 'setorDescricao', 'procedenciaDescricao', 'nome', 'data_aquisicao'], 'required'],
            [['descricao'], 'string'],
            [['data_aquisicao'], 'date', 'format' => 'd/m/Y'],
            [['data_aquisicao', 'created_at', 'updated_at','marcaDescricao','setorDescricao','procedenciaDescricao'], 'safe'],
            [['nome'], 'string', 'max' => 60],
            [['id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'NI',
            'marca_id' => 'Marca',
            'setor_id' => 'Setor',
            'procedencia_id' => 'Procedência',
            'nome' => 'Nome',
            'descricao' => 'Descricao',
            'data_aquisicao' => 'Data de Aquisicao',
            'created_at' => 'Criado em ',
            'updated_at' => 'Última atualização',
            'marcaDescricao' => 'Marca',
            'setorDescricao' => 'Setor',
            'procedenciaDescricao' => 'Procedência'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(EquipamentoServico::className(), ['equipamento_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarca()
    {
        return $this->hasOne(Marca::className(), ['id' => 'marca_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProcedencia()
    {
        return $this->hasOne(Procedencia::className(), ['id' => 'procedencia_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSetor()
    {
        return $this->hasOne(Setor::className(), ['id' => 'setor_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getManutencaos()
    {
        return $this->hasMany(Manutencao::className(), ['equipamento_id' => 'id']);
    }

    public static function getAllAsArray()
    {
        $equipamentos = Equipamento::find()->all();
        if($equipamentos)
        {
            return \yii\helpers\ArrayHelper::map($equipamentos, 'id', 'nomeNI');
        }
        else{
            throw new NotFoundHttpException('Não há nenhum equipamento cadastrado =(');
        }

    }

    public function getNomeNI()
    {
        return $this->id . ' - ' . $this->nome;
    }


    public function beforeValidate()
    {



        if ($marca = Marca::find()->where('descricao = :descricao', ['descricao' => $this->marcaDescricao])->one()) {
            $this->marca_id = $marca->id;
        } else {

            $novaMarca = new Marca();
            $novaMarca->descricao = $this->marcaDescricao;
            $novaMarca->save();
            $this->marca_id = $novaMarca->id;
        }

        if ($setor = Setor::find()->where('descricao = :descricao', ['descricao' => $this->setorDescricao])->one()) {
            $this->setor_id = $setor->id;
        } else {
            $novoSetor = new Setor();
            $novoSetor->descricao = $this->setorDescricao;
            $novoSetor->save();
            $this->setor_id = $novoSetor->id;
        }

        if ($procedencia = Procedencia::find()->where('descricao = :descricao', ['descricao' => $this->procedenciaDescricao])->one()) {
            $this->procedencia_id = $procedencia->id;
        } else {
            $novaProcedencia = new Procedencia();
            $novaProcedencia->descricao = $this->procedenciaDescricao;
            $novaProcedencia->save();
            $this->procedencia_id = $novaProcedencia->id;
        }

        return true;

    }

    public function afterFind()
    {
        $this->data_aquisicao = Yii::$app->formatter->asDate($this->data_aquisicao, 'short');
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

        $date = date_parse_from_format('d/m/Y', $this->data_aquisicao);

        if ($date) {
            $date = $date['year'] . '-' . $date['month'] . '-' . ($date['day']);

        } else {

            $date = time();
        }


        $this->data_aquisicao = $date;


        return parent::beforeSave($insert);
    }
}
