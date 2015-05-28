<?php


class Avance extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'avance';
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
			array('id_planificacion, fecha, logrado', 'required'),
			array('id_planificacion, logrado', 'numerical', 'integerOnly'=>true),
			array('comentario', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_avance, id_planificacion, fecha, logrado, comentario', 'safe', 'on'=>'search'),
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
			'id_avance' => 'Id Avance',
			'id_planificacion' => 'Id Planificacion',
			'fecha' => 'Fecha',
			'logrado' => 'Logrado',
			'comentario' => 'Comentario',
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

		$criteria->compare('id_avance',$this->id_avance);
		$criteria->compare('id_planificacion',$this->id_planificacion);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('logrado',$this->logrado);
		$criteria->compare('comentario',$this->comentario,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Avance the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
