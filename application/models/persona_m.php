<?php

if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

class Persona_m extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
       
    function get_persona_list($arrParam) {
        try {
            $arrResultado =  $this->db->query_sp('PERSONA_GET',$arrParam);
            return $arrResultado;
        } catch (Exception $e) {
            throw new Exception('Error Inesperado');
        }
    }
    
    function get_rol_persona() {
        $data = array(null); 
        $query = "ROL_PERSONA_GET";
        $arrCombo = $this->db->query_sp($query, $data);
        $arrResultado = json_encode($arrCombo);
        return $arrResultado;
    }
    
    function get_tipo_persona() {
        $data = array(null); 
        $query = "TIPO_PERSONA_GET";
        $arrCombo = $this->db->query_sp($query, $data);
        $arrResultado = json_encode($arrCombo);
        return $arrResultado;
    }
    
    function agregar_persona($arrParam) {
        try {
            $arrResultado = $this->db->query_sp('PERSONA_INSERT',$arrParam);
            return $arrResultado;
        } catch (Exception $e) {
            throw new Exception('Error Inesperado', 0, $e);
            return FALSE;
        }
    }
    
    function upd_persona($arrParam) {

        try {
            $arrResultado = $this->db->query_sp('UPDATE_PERSONA',$arrParam);
            return $arrResultado;
        } catch (Exception $e) {
            throw new Exception('Error Inesperado', 0, $e);
            return FALSE;
        }
    }
    
    function actualizar_persona($arrParam) {

        try {
            $arrResultado = $this->db->query_sp('PERSONA_UPDATE',$arrParam);
            return $arrResultado;
        } catch (Exception $e) {
            throw new Exception('Error Inesperado', 0, $e);
            return FALSE;
        }
    }
}