<?php

/**
 * This is the model class for table "planificacion".
 *
 * The followings are the available columns in table 'planificacion':
 * @property integer $id_planificacion
 * @property string $id_profesor
 * @property string $id_asignatura
 * @property string $id_grado
 * @property string $id_curso
 * @property string $fecha_creacion
 * @property string $fecha_modificacion
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
 * @property Avance[] $avances
 * @property Evaluacion $idEvaluacion
 * @property Asignatura $idAsignatura
 * @property Curso $idCurso
 * @property Profesor $idProfesor
 * @property Grado $idGrado
 * @property AE[] $aEs
 * @property CMO[] $cMOs
 * @property OFV[] $oFVs
 * @property Indicador[] $indicadors
 * @property MaterialApoyo[] $materialApoyos
 * @property Revision[] $revisions
 */
class Planificacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'planificacion';
	}
        
          //Se habilita extension CAdvancedArBehavior para relación m:m
        public function behaviors(){
          return array( 'CAdvancedArBehavior' => array(
            'class' => 'application.extensions.CAdvancedArBehavior'));
        }
        
        //arreglo con indicadores seleccionados en form
        public $IndicadoresIds = array();
        
        //se agregan id de indicadores seleccionados en el arreglo IndicadoresIds
        public function afterFind()
        {
            if (!empty($this->indicadores))
            {
                foreach ($this->indicadores as $n => $indicador)
                    $this->IndicadoresIds[] = $indicador->id_indicador;
            }
            
            // convierte fecha español
            $this->fecha_creacion = DateTime::createFromFormat('Y-m-d H:i:s', $this->fecha_creacion)->format('d-m-Y H:i:s');
            $this->fecha_modificacion = DateTime::createFromFormat('Y-m-d H:i:s', $this->fecha_modificacion)->format('d-m-Y H:i:s');
            $this->fecha_inicio = DateTime::createFromFormat('Y-m-d', $this->fecha_inicio)->format('d-m-Y');
            $this->fecha_termino = DateTime::createFromFormat('Y-m-d', $this->fecha_termino)->format('d-m-Y');


            parent::afterFind();
        }
        
        protected function beforeSave()
        {
            // convierte fecha español
            $this->fecha_creacion = DateTime::createFromFormat('d-m-Y H:i:s', $this->fecha_creacion)->format('Y-m-d H:i:s');
            $this->fecha_modificacion = DateTime::createFromFormat('d-m-Y H:i:s', $this->fecha_modificacion)->format('Y-m-d H:i:s');
            $this->fecha_inicio = DateTime::createFromFormat('d-m-Y', $this->fecha_inicio)->format('Y-m-d');
            $this->fecha_termino = DateTime::createFromFormat('d-m-Y', $this->fecha_termino)->format('Y-m-d');

        return parent::beforeSave();
        }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_profesor, id_asignatura, id_grado, id_curso, fecha_creacion, fecha_modificacion, tipo, fecha_inicio, fecha_termino', 'required'),
			array('id_evaluacion', 'numerical', 'integerOnly'=>true),
			array('id_profesor, tipo, estado', 'length', 'max'=>10),
			array('id_asignatura', 'length', 'max'=>4),
			array('id_grado', 'length', 'max'=>2),
			array('id_curso', 'length', 'max'=>3),
			array('habilidades, actitudes, actividades, recursos, conocimientos_previos, conocimientos', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_planificacion, id_profesor, id_asignatura, id_grado, id_curso, fecha_creacion, fecha_modificacion, tipo, estado, fecha_inicio, fecha_termino, habilidades, actitudes, actividades, recursos, conocimientos_previos, conocimientos, id_evaluacion', 'safe', 'on'=>'search'),
		
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
			'avances' => array(self::HAS_MANY, 'Avance', 'id_planificacion'),
			'idEvaluacion' => array(self::BELONGS_TO, 'Evaluacion', 'id_evaluacion'),
			'relAsignatura' => array(self::BELONGS_TO, 'Asignatura', 'id_asignatura'),
			'relCurso' => array(self::BELONGS_TO, 'Curso', 'id_curso'),
			'idProfesor' => array(self::BELONGS_TO, 'Profesor', 'id_profesor'),
			'relGrado' => array(self::BELONGS_TO, 'Grado', 'id_grado'),
			'aEs' => array(self::MANY_MANY, 'AE', 'planificacion_tiene_AE(id_planificacion, id_AE)'),
			'cMOs' => array(self::MANY_MANY, 'CMO', 'planificacion_tiene_CMO(id_planificacion, id_CMO)'),
			'oFVs' => array(self::MANY_MANY, 'OFV', 'planificacion_tiene_OFV(id_planificacion, id_OFV)'),
			'indicadors' => array(self::MANY_MANY, 'Indicador', 'planificacion_tiene_indicador(id_planificacion, id_indicador)'),
			'materialApoyos' => array(self::MANY_MANY, 'MaterialApoyo', 'planificacion_tiene_material_apoyo(id_planificacion, id_material_apoyo)'),
			'revisions' => array(self::HAS_MANY, 'Revision', 'id_planificacion'),
                        'relUsuario'=> array(self::BELONGS_TO, 'Usuario', 'id_profesor'),
                );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_planificacion' => 'Id Planificacion',
			'id_profesor' => 'Id Profesor',
			'id_asignatura' => 'Id Asignatura',
			'id_grado' => 'Id Grado',
			'id_curso' => 'Id Curso',
			'fecha_creacion' => 'Fecha Creacion',
			'fecha_modificacion' => 'Fecha Modificacion',
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

		$criteria->compare('id_planificacion',$this->id_planificacion);
		//$criteria->compare('id_profesor',$this->id_profesor,true);
		//$criteria->compare('id_asignatura',$this->id_asignatura,true);
		//$criteria->compare('id_grado',$this->id_grado,true);
		//$criteria->compare('id_curso',$this->id_curso,true);
		$criteria->compare('fecha_creacion',$this->fecha_creacion,true);
		$criteria->compare('fecha_modificacion',$this->fecha_modificacion,true);
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
                
                $criteria->with =array('relUsuario','relAsignatura','relGrado','relCurso');
                
                $criteria->addSearchCondition('LOWER(relUsuario.nombre_usuario)',strtolower($this->id_profesor));
                $criteria->addSearchCondition('LOWER(relAsignatura.nombre_asignatura)',strtolower($this->id_asignatura));
                $criteria->addSearchCondition('LOWER(relGrado.nombre_grado)',strtolower($this->id_grado));
                $criteria->addSearchCondition('LOWER(relCurso.nombre_curso)',strtolower($this->id_curso));
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Planificacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
