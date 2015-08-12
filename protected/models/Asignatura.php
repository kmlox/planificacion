<?php

/**
 * This is the model class for table "asignatura".
 *
 * The followings are the available columns in table 'asignatura':
 * @property string $id_asignatura
 * @property string $nombre_asignatura
 * @property string $id_grado
 *
 * The followings are the available model relations:
 * @property AE[] $aEs
 * @property CMO[] $cMOs
 * @property OA[] $oAs
 * @property OFV[] $oFVs
 * @property Grado $idGrado
 * @property Evaluacion[] $evaluacions
 * @property Planificacion[] $planificacions
 * @property Profesor[] $profesors
 */
class Asignatura extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'asignatura';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_asignatura, nombre_asignatura, id_grado', 'required'),
			array('id_asignatura', 'length', 'max'=>4),
			array('nombre_asignatura', 'length', 'max'=>45),
			array('id_grado', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_asignatura, nombre_asignatura, id_grado', 'safe', 'on'=>'search'),
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
			'aEs' => array(self::HAS_MANY, 'AE', 'id_asignatura'),
			'cMOs' => array(self::HAS_MANY, 'CMO', 'id_asignatura'),
			'oAs' => array(self::HAS_MANY, 'OA', 'id_asignatura'),
			'oFVs' => array(self::HAS_MANY, 'OFV', 'id_asignatura'),
			'relGrado' => array(self::BELONGS_TO, 'Grado', 'id_grado'),
			'evaluacions' => array(self::HAS_MANY, 'Evaluacion', 'id_asignatura'),
			'planificacions' => array(self::HAS_MANY, 'Planificacion', 'id_asignatura'),
			'profesors' => array(self::MANY_MANY, 'Profesor', 'profesor_tiene_asignatura(id_asignatura, id_profesor)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_asignatura' => 'Id Asignatura',
			'nombre_asignatura' => 'Nombre Asignatura',
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

		$criteria->compare('id_asignatura',$this->id_asignatura,true);
		$criteria->compare('nombre_asignatura',$this->nombre_asignatura,true);
		$criteria->compare('id_grado',$this->id_grado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Asignatura the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
