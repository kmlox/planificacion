<?php

/**
 * This is the model class for table "grado".
 *
 * The followings are the available columns in table 'grado':
 * @property string $id_grado
 * @property string $nombre_grado
 * @property integer $id_nivel
 *
 * The followings are the available model relations:
 * @property Curso[] $cursos
 * @property Nivel $idNivel
 * @property Asignatura[] $asignaturas
 */
class Grado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'grado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_grado, nombre_grado, id_nivel', 'required'),
			array('id_nivel', 'numerical', 'integerOnly'=>true),
			array('id_grado', 'length', 'max'=>2),
			array('nombre_grado', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_grado, nombre_grado, id_nivel', 'safe', 'on'=>'search'),
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
			'cursos' => array(self::HAS_MANY, 'Curso', 'id_grado'),
			'idNivel' => array(self::BELONGS_TO, 'Nivel', 'id_nivel'),
			'asignaturas' => array(self::MANY_MANY, 'Asignatura', 'grado_tiene_asignatura(id_grado, id_asignatura)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_grado' => 'Id Grado',
			'nombre_grado' => 'Nombre Grado',
			'id_nivel' => 'Id Nivel',
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

		$criteria->compare('id_grado',$this->id_grado,true);
		$criteria->compare('nombre_grado',$this->nombre_grado,true);
		$criteria->compare('id_nivel',$this->id_nivel);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Grado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
