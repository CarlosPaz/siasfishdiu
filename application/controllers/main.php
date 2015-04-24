<?php

if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

class Main extends CI_Controller {
    var $_arr_Sesion;
    public function __construct() {
        
         parent::__construct();
         
         $this->_arr_Sesion = $this->session->userdata('ses_usuario');

         $this->load->helper('form');
         $this->load->library('form_validation');
         $this->load->model('main_m');
    }
    
    public function index() {
        $arrSesion = $this->_arr_Sesion;
        // $arrSesion['controller'] = 'Inicio';
        //$arrSesion['mGroup'] = 'm_inicio';
        // $arrSesion['mOption'] = '';
        $this->load->view('includes/header');
        $arrUserbar = array(
            // 'id_usuario' => $arrSesion["id_usuario"],
            'usuario' => $arrSesion["usuario"]
        );
        $this->load->view('includes/userbar', $arrUserbar);
        // $this->load->view('includes/menu', $arrSesion);        
        $this->load->view('includes/menu');        
        $arrView = array(
            'id_usuario' => $arrSesion["id_usuario"],
            'usuario' => $arrSesion["usuario"]
        );
        
        $this->load->view('frontend/main/main_v', $arrView);
        $this->load->view('includes/footer');
    }
    
    public function logout() {

        cerrar_sesion();
    }

}
