<?php

/**
 * This is the model class for table "curso".
 *
 * The followings are the available columns in table 'curso':
 * @property string $id_curso
 * @property string $nombre_curso
 * @property string $id_grado
 *
 * The followings are the available model relations:
 * @property Actividad[] $actividads
 * @property Alumno[] $alumnos
 * @property Grado $idGrado
 * @property Evaluacion[] $evaluacions
 */
class Curso extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'curso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_curso, nombre_curso, id_grado', 'required'),
			array('id_curso', 'length', 'max'=>3),
			array('nombre_curso', 'length', 'max'=>45),
			array('id_grado', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_curso, nombre_curso, id_grado', 'safe', 'on'=>'search'),
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
			'actividads' => array(self::HAS_MANY, 'Actividad', 'id_curso'),
			'alumnos' => array(self::HAS_MANY, 'Alumno', 'id_curso'),
			'idGrado' => array(self::BELONGS_TO, 'Grado', 'id_grado'),
			'evaluacions' => array(self::HAS_MANY, 'Evaluacion', 'id_curso'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_curso' => 'Id Curso',
			'nombre_curso' => 'Nombre Curso',
			'id_grado' => 'Id Grado',
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

		$criteria->compare('id_curso',$this->id_curso,true);
		$criteria->compare('nombre_curso',$this->nombre_curso,true);
		$criteria->compare('id_grado',$this->id_grado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Curso the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
