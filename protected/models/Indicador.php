<?php

/**
 * This is the model class for table "indicador".
 *
 * The followings are the available columns in table 'indicador':
 * @property integer $id_indicador
 * @property string $descripcion_indicador
 * @property string $id_oa
 * @property string $id_profesor
 *
 * The followings are the available model relations:
 * @property Profesor $idProfesor
 * @property OA $idOa
 * @property Planificacion[] $planificacions
 */
class Indicador extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'indicador';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('descripcion_indicador, id_oa', 'required'),
			array('id_oa', 'length', 'max'=>8),
			array('id_profesor', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_indicador, descripcion_indicador, id_oa, id_profesor', 'safe', 'on'=>'search'),
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
			'idProfesor' => array(self::BELONGS_TO, 'Profesor', 'id_profesor'),
			'relOa' => array(self::BELONGS_TO, 'OA', 'id_oa'),
			'planificacions' => array(self::MANY_MANY, 'Planificacion', 'planificacion_tiene_indicador(id_indicador, id_planificacion)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_indicador' => 'Id Indicador',
			'descripcion_indicador' => 'Descripcion Indicador',
			'id_oa' => 'Id Oa',
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

		$criteria->compare('id_indicador',$this->id_indicador);
		$criteria->compare('descripcion_indicador',$this->descripcion_indicador,true);
		$criteria->compare('id_oa',$this->id_oa,true);
		$criteria->compare('id_profesor',$this->id_profesor,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Indicador the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
