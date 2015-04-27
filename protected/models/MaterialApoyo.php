<?php

/**
 * This is the model class for table "material_apoyo".
 *
 * The followings are the available columns in table 'material_apoyo':
 * @property integer $id_material_apoyo
 * @property integer $id_planificacion
 * @property string $url
 *
 * The followings are the available model relations:
 * @property Planificacion $idPlanificacion
 */
class MaterialApoyo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'material_apoyo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_planificacion, url', 'required'),
			array('id_planificacion', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_material_apoyo, id_planificacion, url', 'safe', 'on'=>'search'),
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
			'idPlanificacion' => array(self::BELONGS_TO, 'Planificacion', 'id_planificacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_material_apoyo' => 'Id Material Apoyo',
			'id_planificacion' => 'Id Planificacion',
			'url' => 'Url',
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

		$criteria->compare('id_material_apoyo',$this->id_material_apoyo);
		$criteria->compare('id_planificacion',$this->id_planificacion);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MaterialApoyo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
