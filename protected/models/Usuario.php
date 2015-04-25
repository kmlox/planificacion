<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property string $id_usuario
 * @property string $nombre_usuario
 * @property string $password
 * @property string $rol
 *
 * The followings are the available model relations:
 * @property Administrador $administrador
 * @property Alumno $alumno
 * @property Directivo $directivo
 * @property Profesor $profesor
 */
class Usuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_usuario, nombre_usuario, password, rol', 'required'),
			array('id_usuario', 'length', 'max'=>10),
			array('nombre_usuario', 'length', 'max'=>100),
			array('password, rol', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_usuario, nombre_usuario, password, rol', 'safe', 'on'=>'search'),
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
			'administrador' => array(self::HAS_ONE, 'Administrador', 'id_administrador'),
			'alumno' => array(self::HAS_ONE, 'Alumno', 'id_alumno'),
			'directivo' => array(self::HAS_ONE, 'Directivo', 'id_directivo'),
			'profesor' => array(self::HAS_ONE, 'Profesor', 'id_profesor'),
                        'relUsuario'=> array(self::HAS_ONE, 'Planificacion', 'id_profesor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_usuario' => 'Id Usuario',
			'nombre_usuario' => 'Nombre Usuario',
			'password' => 'Password',
			'rol' => 'Rol',
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

		$criteria->compare('id_usuario',$this->id_usuario,true);
		$criteria->compare('nombre_usuario',$this->nombre_usuario,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('rol',$this->rol,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getNombre($id_usuario){
            return CHtml::listData(Usuario::model()->findbyPk($id_usuario),'id_usuario','nombre_usuario');
        }
}
