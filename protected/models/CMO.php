<?php

/**
 * This is the model class for table "CMO".
 *
 * The followings are the available columns in table 'CMO':
 * @property integer $id_CMO
 * @property string $descripcion_CMO
 * @property string $id_asignatura
 * @property string $id_profesor
 *
 * The followings are the available model relations:
 * @property Asignatura $idAsignatura
 * @property Profesor $idProfesor
 * @property Planificacion[] $planificacions
 * @property Unidad[] $unidads
 */
class CMO extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'CMO';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descripcion_CMO, id_asignatura', 'required'),
			array('id_asignatura', 'length', 'max'=>4),
			array('id_profesor', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_CMO, descripcion_CMO, id_asignatura, id_profesor', 'safe', 'on'=>'search'),
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
			'relAsignatura' => array(self::BELONGS_TO, 'Asignatura', 'id_asignatura'),
			'idProfesor' => array(self::BELONGS_TO, 'Profesor', 'id_profesor'),
			'planificacions' => array(self::MANY_MANY, 'Planificacion', 'planificacion_tiene_CMO(id_CMO, id_planificacion)'),
			'unidads' => array(self::MANY_MANY, 'Unidad', 'unidad_tiene_CMO(id_CMO, id_unidad)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_CMO' => 'Id Cmo',
			'descripcion_CMO' => 'Descripcion Cmo',
			'id_asignatura' => 'Id Asignatura',
			'id_profesor' => 'Id Profesor',
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

		$criteria->compare('id_CMO',$this->id_CMO);
		$criteria->compare('descripcion_CMO',$this->descripcion_CMO,true);
		$criteria->compare('id_asignatura',$this->id_asignatura,true);
		$criteria->compare('id_profesor',$this->id_profesor,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CMO the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
