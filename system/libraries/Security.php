<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * Developer    :   
 * Create Date  :   2013.01.22
 * Description  :   Genera una arreglo para poblar los objetos select
 * 
  */
class Security {

    var $_arr_session;

    public function __construct() {
        log_message('debug', "Security Class Initialized");

        // Seteando el objeto super
        $this->CI = & get_instance();

        // cargando valores de sesion
        $this->_arr_session = $this->session->userdata('ses_usuario');

        // Cargando configuracion de basedatos
        $this->CI->load->database();

        log_message('debug', "Security successfully run");
    }

    public function sec_access($app, $class, $function) {

        $arrCombo = array();
        $arrField = array();
        $query = $this->CI->db->query($sQuery);

        if ($query->num_rows() > 0) {

            if ($query->num_fields() == 2) {

                $i = 0;
                foreach ($query->list_fields() as $field) {
                    $arrField[$i] = $field;
                    $i++;
                }

                $arrCombo[''] = '';
                foreach ($query->result_array() as $r) {
                    $arrCombo[$r[$arrField[0]]] = $r[$arrField[1]];
                }
            }
        }

        return $arrCombo;
    }

    public function sec_menu($sData) {

        $arrCombo = array();
        $arrField = array();
        $query = $this->CI->db->query($sQuery, $sData);

        if ($query->num_rows() > 0) {

            if ($query->num_fields() == 2) {

                $i = 0;
                foreach ($query->list_fields() as $field) {
                    $arrField[$i] = $field;
                    $i++;
                }

                $arrCombo[''] = '';
                foreach ($query->result_array() as $r) {
                    $arrCombo[$r[$arrField[0]]] = $r[$arrField[1]];
                }
            }
        }

        mysqli_next_result($this->CI->db->conn_id);

        return $arrCombo;
    }

}

// ------------------------------------------------------------------------

