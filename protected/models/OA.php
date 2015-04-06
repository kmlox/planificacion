<?php

/**
 * This is the model class for table "OA".
 *
 * The followings are the available columns in table 'OA':
 * @property string $id_OA
 * @property string $descripcion_OA
 * @property string $id_asignatura
 *
 * The followings are the available model relations:
 * @property Asignatura $idAsignatura
 * @property Indicador[] $indicadors
 * @property Unidad[] $unidads
 */
class OA extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'OA';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_OA, descripcion_OA, id_asignatura', 'required'),
			array('id_OA', 'length', 'max'=>8),
			array('id_asignatura', 'length', 'max'=>4),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_OA, descripcion_OA, id_asignatura', 'safe', 'on'=>'search'),
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
			'indicadors' => array(self::HAS_MANY, 'Indicador', 'id_oa'),
			'unidads' => array(self::MANY_MANY, 'Unidad', 'unidad_tiene_OA(id_OA, id_unidad)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_OA' => 'Id Oa',
			'descripcion_OA' => 'Descripcion Oa',
			'id_asignatura' => 'Id Asignatura',
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

		$criteria->compare('id_OA',$this->id_OA,true);
		$criteria->compare('descripcion_OA',$this->descripcion_OA,true);
		$criteria->compare('id_asignatura',$this->id_asignatura,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OA the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
