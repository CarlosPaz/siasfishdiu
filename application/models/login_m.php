<?php

if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

class Login_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function login($array) {
        //$array['password']  = sha1(md5($array['password']));
        $arrParam = array( $array['usuario'], $array['clave']);
        $consulta = $this->db->query_sp("USER_VALID", $arrParam);
        if (count($consulta) == 1) {
            $array = array();
            $array['id_usuario']        = $consulta[0]["id_usuario"];
            $array['usuario']           = $consulta[0]["usuario"];
            $array['fecha_vigencia']    = $consulta[0]["fecha_vigencia"];
            $array['id_perfil']         = $consulta[0]["id_perfil"];
            $array['perfil']            = $consulta[0]["perfil"];
        }
        $arrResultado = array( 'valido'     => count($consulta), 'infoUsuario'  => $array );
        return $arrResultado;
    }
}