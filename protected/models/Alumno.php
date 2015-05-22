<?php

/**
 * This is the model class for table "alumno".
 *
 * The followings are the available columns in table 'alumno':
 * @property string $id_alumno
 * @property string $id_curso
 *
 * The followings are the available model relations:
 * @property Curso $idCurso
 * @property Usuario $idAlumno
 * @property Calificacion[] $calificacions
 */
class Alumno extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        
	public function tableName()
	{
		return 'alumno';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_alumno, id_curso', 'required'),
			array('id_alumno', 'length', 'max'=>10),
			array('id_curso', 'length', 'max'=>3),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_alumno, id_curso', 'safe', 'on'=>'search'),
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
			'idCurso' => array(self::BELONGS_TO, 'Curso', 'id_curso'),
			'idAlumno' => array(self::BELONGS_TO, 'Usuario', 'id_alumno'),
			'calificacions' => array(self::HAS_MANY, 'Calificacion', 'id_alumno'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_alumno' => 'Id Alumno',
			'id_curso' => 'Id Curso',
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

		$criteria->compare('id_alumno',$this->id_alumno,true);
		$criteria->compare('id_curso',$this->id_curso,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Alumno the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
