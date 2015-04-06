<?php

/**
 * This is the model class for table "actividad".
 *
 * The followings are the available columns in table 'actividad':
 * @property integer $id_actividad
 * @property string $id_profesor
 * @property string $id_asignatura
 * @property string $id_curso
 * @property string $tipo
 * @property string $estado
 * @property string $fecha_inicio
 * @property string $fecha_termino
 * @property string $habilidades
 * @property string $actitudes
 * @property string $actividades
 * @property string $recursos
 * @property string $conocimientos_previos
 * @property string $conocimientos
 * @property integer $id_evaluacion
 *
 * The followings are the available model relations:
 * @property Asignatura $idAsignatura
 * @property Curso $idCurso
 * @property Profesor $idProfesor
 * @property Evaluacion $idEvaluacion
 * @property AE[] $aEs
 * @property CMO[] $cMOs
 * @property OFV[] $oFVs
 * @property Indicador[] $indicadors
 * @property MaterialApoyo[] $materialApoyos
 * @property Avance[] $avances
 * @property Revision[] $revisions
 */
class Actividad extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'actividad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_profesor, id_asignatura, id_curso, tipo, fecha_inicio, fecha_termino', 'required'),
			array('id_evaluacion', 'numerical', 'integerOnly'=>true),
			array('id_profesor, tipo, estado', 'length', 'max'=>10),
			array('id_asignatura', 'length', 'max'=>4),
			array('id_curso', 'length', 'max'=>3),
			array('habilidades, actitudes, actividades, recursos, conocimientos_previos, conocimientos', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_actividad, id_profesor, id_asignatura, id_curso, tipo, estado, fecha_inicio, fecha_termino, habilidades, actitudes, actividades, recursos, conocimientos_previos, conocimientos, id_evaluacion', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idAsignatura' => array(self::BELONGS_TO, 'Asignatura', 'id_asignatura'),
			'idCurso' => array(self::BELONGS_TO, 'Curso', 'id_curso'),
			'idProfesor' => array(self::BELONGS_TO, 'Profesor', 'id_profesor'),
			'idEvaluacion' => array(self::BELONGS_TO, 'Evaluacion', 'id_evaluacion'),
			'aEs' => array(self::MANY_MANY, 'AE', 'actividad_tiene_AE(id_actividad, id_AE)'),
			'cMOs' => array(self::MANY_MANY, 'CMO', 'actividad_tiene_CMO(id_actividad, id_CMO)'),
			'oFVs' => array(self::MANY_MANY, 'OFV', 'actividad_tiene_OFV(id_actividad, id_OFV)'),
			'indicadors' => array(self::MANY_MANY, 'Indicador', 'actividad_tiene_indicador(id_actividad, id_indicador)'),
			'materialApoyos' => array(self::MANY_MANY, 'MaterialApoyo', 'actividad_tiene_material_apoyo(id_actividad, id_material_apoyo)'),
			'avances' => array(self::HAS_MANY, 'Avance', 'id_actividad'),
			'revisions' => array(self::HAS_MANY, 'Revision', 'id_actividad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_actividad' => 'Id Actividad',
			'id_profesor' => 'Id Profesor',
			'id_asignatura' => 'Id Asignatura',
			'id_curso' => 'Id Curso',
			'tipo' => 'Tipo',
			'estado' => 'Estado',
			'fecha_inicio' => 'Fecha Inicio',
			'fecha_termino' => 'Fecha Termino',
			'habilidades' => 'Habilidades',
			'actitudes' => 'Actitudes',
			'actividades' => 'Actividades',
			'recursos' => 'Recursos',
			'conocimientos_previos' => 'Conocimientos Previos',
			'conocimientos' => 'Conocimientos',
			'id_evaluacion' => 'Id Evaluacion',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_actividad',$this->id_actividad);
		$criteria->compare('id_profesor',$this->id_profesor,true);
		$criteria->compare('id_asignatura',$this->id_asignatura,true);
		$criteria->compare('id_curso',$this->id_curso,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('fecha_inicio',$this->fecha_inicio,true);
		$criteria->compare('fecha_termino',$this->fecha_termino,true);
		$criteria->compare('habilidades',$this->habilidades,true);
		$criteria->compare('actitudes',$this->actitudes,true);
		$criteria->compare('actividades',$this->actividades,true);
		$criteria->compare('recursos',$this->recursos,true);
		$criteria->compare('conocimientos_previos',$this->conocimientos_previos,true);
		$criteria->compare('conocimientos',$this->conocimientos,true);
		$criteria->compare('id_evaluacion',$this->id_evaluacion);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Actividad the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
