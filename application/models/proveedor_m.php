<?php

if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

class Proveedor_m extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
       
    function get_proveedor_list($arrParam) {
        try {
            $arrResultado =  $this->db->query_sp('PROVEEDOR_GET',$arrParam);
            return $arrResultado;
        } catch (Exception $e) {
            throw new Exception('Error Inesperado');
        }
    }
    
    function agregar_proveedor($arrParam) {
        try {
            $arrResultado = $this->db->query_sp('PROVEEDOR_INSERT',$arrParam);
            return $arrResultado;
        } catch (Exception $e) {
            throw new Exception('Error Inesperado', 0, $e);
            return FALSE;
        }
    }

    function actualizar_proveedor($arrParam) {

        try {
            $arrResultado = $this->db->query_sp('PROVEEDOR_UPDATE',$arrParam);
            return $arrResultado;
        } catch (Exception $e) {
            throw new Exception('Error Inesperado', 0, $e);
            return FALSE;
        }
    }
}

