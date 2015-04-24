<?php

if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

class Unidad_medida_m extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    function get_unidad_medida_list($arrParam) {
        try {
            $arrResultado =  $this->db->query_sp('UNIDAD_MEDIDA_GET',$arrParam);
            return $arrResultado;
        } catch (Exception $e) {
            throw new Exception('Error Inesperado');
        }
    }
    
    function agregar_unidad_medida($arrParam) {
        try {
            $arrResultado = $this->db->query_sp('UNIDAD_MEDIDA_INSERT',$arrParam);
            return $arrResultado;
        } catch (Exception $e) {
            throw new Exception('Error Inesperado', 0, $e);
            return FALSE;
        }
    }

    function actualizar_unidad_medida($arrParam) {

        try {
            $arrResultado = $this->db->query_sp('UNIDAD_MEDIDA_UPDATE',$arrParam);
            return $arrResultado;
        } catch (Exception $e) {
            throw new Exception('Error Inesperado', 0, $e);
            return FALSE;
        }
    }  
}


