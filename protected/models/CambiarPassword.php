<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class CambiarPassword extends CFormModel{
    public $password;
    public $nuevo_password;
    public $repetir_nuevopassword;
    
    public function rules(){
        return array(
            array(
                'password,nuevo_password,repetir_nuevopassword',
                'required',
                'message'=>'El campo es requerido',
            ),
            array(
                'password,nuevo_password,repetir_nuevopassword',
                'match',
                'pattern'=>'/^[a-z0-9]+$/i',
                'message'=>'Error, sólo letras y números',
            ),
            array(
                'repetir_nuevopassword',
                'compare',
                'compareAttribute'=>'nuevo_password',
                'message'=>'El password no coincide',
            ),
        );
    }
    
}