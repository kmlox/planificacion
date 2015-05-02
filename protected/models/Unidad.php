<?php

/**
 * This is the model class for table "unidad".
 *
 * The followings are the available columns in table 'unidad':
 * @property integer $id_unidad
 * @property string $nombre_unidad
 *
 * The followings are the available model relations:
 * @property AE[] $aEs
 * @property CMO[] $cMOs
 * @property OA[] $oAs
 * @property OFV[] $oFVs
 */
class Unidad extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'unidad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre_unidad', 'required'),
			array('nombre_unidad', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_unidad, nombre_unidad', 'safe', 'on'=>'search'),
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
			'aEs' => array(self::MANY_MANY, 'AE', 'unidad_tiene_AE(id_unidad, id_AE)'),
			'cMOs' => array(self::MANY_MANY, 'CMO', 'unidad_tiene_CMO(id_unidad, id_CMO)'),
			'oAs' => array(self::MANY_MANY, 'OA', 'unidad_tiene_OA(id_unidad, id_OA)'),
			'oFVs' => array(self::MANY_MANY, 'OFV', 'unidad_tiene_OFV(id_unidad, id_OFV)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_unidad' => 'Id Unidad',
			'nombre_unidad' => 'Nombre Unidad',
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

		$criteria->compare('id_unidad',$this->id_unidad);
		$criteria->compare('nombre_unidad',$this->nombre_unidad,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Unidad the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
