<?php

/**
 * This is the model class for table "evaluacion".
 *
 * The followings are the available columns in table 'evaluacion':
 * @property integer $id_evaluacion
 * @property string $id_profesor
 * @property string $id_asignatura
 * @property string $id_curso
 * @property string $nombre_evaluacion
 * @property string $fecha
 * @property string $contenido
 * @property string $nombre_documento
 * @property string $url_documento
 *
 * The followings are the available model relations:
 * @property Calificacion[] $calificacions
 * @property Asignatura $idAsignatura
 * @property Curso $idCurso
 * @property Profesor $idProfesor
 * @property Planificacion[] $planificacions
 */
class Evaluacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'evaluacion';
	}
        
        protected function afterFind()
        {
            // convierte fecha español
            $this->fecha = DateTime::createFromFormat('Y-m-d', $this->fecha)->format('d-m-Y');
            parent::afterFind();
        }
        
        protected function beforeSave()
        {
            // convierte fecha formato mysql
            $this->fecha = DateTime::createFromFormat('d-m-Y', $this->fecha)->format('Y-m-d');
            
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
			array('id_profesor, id_asignatura, id_curso, nombre_evaluacion, fecha, contenido', 'required'),
			array('id_profesor', 'length', 'max'=>10),
			array('id_asignatura', 'length', 'max'=>4),
			array('id_curso', 'length', 'max'=>3),
			array('nombre_evaluacion', 'length', 'max'=>45),
			array('nombre_documento', 'length', 'max'=>100),
			array('url_documento', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_evaluacion, id_profesor, id_asignatura, id_curso, nombre_evaluacion, fecha, contenido, nombre_documento, url_documento', 'safe', 'on'=>'search'),
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
			'calificacions' => array(self::HAS_MANY, 'Calificacion', 'id_evaluacion'),
			'relAsignatura' => array(self::BELONGS_TO, 'Asignatura', 'id_asignatura'),
			'relCurso' => array(self::BELONGS_TO, 'Curso', 'id_curso'),
			'idProfesor' => array(self::BELONGS_TO, 'Profesor', 'id_profesor'),
			'planificacions' => array(self::MANY_MANY, 'Planificacion', 'planificacion_tiene_evaluacion(id_evaluacion, id_planificacion)'),
                        'relUsuario'=> array(self::BELONGS_TO, 'Usuario', 'id_profesor'),
                );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_evaluacion' => 'Id Evaluacion',
			'id_profesor' => 'Id Profesor',
			'id_asignatura' => 'Id Asignatura',
			'id_curso' => 'Id Curso',
			'nombre_evaluacion' => 'Nombre Evaluacion',
			'fecha' => 'Fecha',
			'contenido' => 'Contenido',
			'nombre_documento' => 'Nombre Documento',
			'url_documento' => 'Url Documento',
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

		$criteria->compare('id_evaluacion',$this->id_evaluacion);
		//$criteria->compare('id_profesor',$this->id_profesor,true);
		$criteria->compare('id_asignatura',$this->id_asignatura,true);
		$criteria->compare('id_curso',$this->id_curso,true);
		$criteria->compare('nombre_evaluacion',$this->nombre_evaluacion,true);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('contenido',$this->contenido,true);
		$criteria->compare('nombre_documento',$this->nombre_documento,true);
		$criteria->compare('url_documento',$this->url_documento,true);
                
                $criteria->with =array('relUsuario');
                
                $criteria->addSearchCondition('LOWER(relUsuario.nombre_usuario)',strtolower($this->id_profesor));
                

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Evaluacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
