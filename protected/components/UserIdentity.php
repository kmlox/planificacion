<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $id;
       
        public function authenticate()
        {
            $record=Usuario::model()->findByAttributes(array('id_usuario'=>$this->username));
            if($record===null)
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            else if($record->password!==sha1($this->password))
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            else
            {
                $this->id=$record->id_usuario;
                //necesariamente tiene que llamarse roles para que funcione RBAC
                $this->setState('roles', $record->rol);
                $this->setState('nombre', $record->nombre_usuario);
                
                $this->errorCode=self::ERROR_NONE;
            }
            return !$this->errorCode;
        }

        public function getId(){
            return $this->id;
        }
}