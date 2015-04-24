<?php

if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');


class Persona extends CI_Controller {
    var $_arr_Sesion;
    public function __construct() {
        
         parent::__construct();
         
         $this->_arr_Sesion = $this->session->userdata('ses_usuario');
         $this->lang->load('generales');
         $this->load->helper('form');
         $this->load->library('form_validation');
         $this->load->model('persona_m');
    }
    
    public function index() {
        // if ($this->seguridad->sec_class(__METHOD__)) return;
        // cargamos parametros de sesión y configuración
        $arrSesion = $this->session->userdata('ses_usuario');
        // cargamos  la interfaz
        $this->load->view('includes/header');
        $arrUserbar = array(
            'usuario' => $arrSesion["usuario"]
        );
        $this->load->view('includes/userbar', $arrUserbar);
        $this->load->view('includes/menu', $arrSesion);
        $this->load->view('backend/persona/persona_list_v', $arrSesion);
        $this->load->view('includes/footer');
    }
    
    public function get_persona_list(){
        // if ($this->seguridad->sec_class(__METHOD__)) return;
        // $arrSesion = $this->_arr_Sesion;
        $data = array(
            'id_persona' => null,
            'opcion'  => 2
        );
        $result = $this->persona_m->get_persona_list($data);	
        header("Content-type: application/json");
	echo Json_encode($result);
    }
    
    public function nueva_persona() {
        // if ($this->seguridad->sec_class(__METHOD__)) return;
        $arrSesion['arrRol'] = $this->persona_m->get_rol_persona();
        $arrSesion['arrTipo'] = $this->persona_m->get_tipo_persona();
        $this->load->view('backend/persona/persona_new_v', $arrSesion);
    }
    
    public function editar_persona() {
        // if ($this->seguridad->sec_class(__METHOD__)) return;
        $data = array(
            'id_persona' => $this->input->post('id'),
            'opcion'  => 1
        );
        $result = $this->persona_m->get_persona_list($data);
        if (count($result) == 0) {
            echo 'No se encontraron datos!';
        } else {
            $arrSesion = array(
                'txt_id'                    => $result[0]['id_persona'],
                'cb_rol_persona'            => $result[0]['rol_persona'],
                'cb_tipo_persona'           => $result[0]['tipo_persona'],
                'txt_nombre_completo'       => $result[0]['nombre_completo'],
                'txt_documento_identidad'   => $result[0]['documento_identidad'],
                'txt_telefono'              => $result[0]['telefono']
            );
            $arrSesion['arrRol'] = $this->persona_m->get_rol_persona();
            $arrSesion['arrTipo'] = $this->persona_m->get_tipo_persona();
            $this->load->view('backend/persona/persona_edit_v', $arrSesion);
        }
    }
    
    public function agregar_persona() {
        // if ($this->seguridad->sec_class(__METHOD__)) return;
        // Datos de validación
        $config = array(
            array(
                'field' => 'cb_rol_persona',
                'label' => 'rol',
                'rules' => 'required|trim'
            ),
            array(
                'field' => 'cb_tipo_persona',
                'label' => 'tipo',
                'rules' => 'required|trim'
            ),
            array(
                'field' => 'txt_nombre_completo',
                'label' => 'nombre',
                'rules' => 'required|trim|min_length[3]'
            ),
            array(
                'field' => 'txt_documento_identidad',
                'label' => 'documento',
                'rules' => 'required|trim|min_length[6]|max_length[10]|numeric'
            ),
            array(
                'field' => 'txt_telefono',
                'label' => 'telefono',
                'rules' => 'required|trim|min_length[6]|max_length[10]|numeric'
            ),
        );
        $this->form_validation->set_rules($config);

        //Reglas
        $this->form_validation->set_message('required', 'El campo'.' %s '.'son requerido');
        $this->form_validation->set_message('min_length', 'El campo'.' %s '.'debe contener un mínimo de'.' %s '.'caracteres');
        $this->form_validation->set_message('max_length', 'El campo'.' %s '.'debe contener un máximo de'.' %s '.'caracteres');
        $this->form_validation->set_message('numeric', 'El campo'.' %s '.'debe de contener solo números');
        
        if (!$this->form_validation->run()) {

            foreach ($config as $v1) {
                foreach ($v1 as $k => $v) {
                    $mensaje = form_error($v);
                    if ($mensaje != "") {
                        break 2;
                    }
                }
            }
            $arrMessage['mensaje'] = $mensaje;
        } else {

            $data = array(
                'id_rol_persona'         => $this->input->post('cb_rol_persona'),
                'id_tipo_persona'        => $this->input->post('cb_tipo_persona'),
                'nombre_completo'        => $this->input->post('txt_nombre_completo'),
                'documento_identidad'    => $this->input->post('txt_documento_identidad'),
                'telefono'               => $this->input->post('txt_telefono'),
            );
            
            try {
                $result = $this->persona_m->agregar_persona($data);
                $arrMessage['mensaje'] = $result[0]['Mensaje'];
            } catch (Exception $e) {
                $arrMessage['mensaje'] = 'Error en la transaccion';
            }
        }
        echo $arrMessage['mensaje'];
    }
    
    public function actualizar_persona() {
        // if ($this->seguridad->sec_class(__METHOD__)) return;
        
        // Datos de validación
        $config = array(
            array(
                'field' => 'txt_nombre_completo',
                'label' => 'nombre',
                'rules' => 'required|trim|min_length[3]'
            ),
            array(
                'field' => 'txt_documento_identidad',
                'label' => 'documento',
                'rules' => 'required|trim|min_length[6]|max_length[10]|numeric'
            ),
            array(
                'field' => 'txt_telefono',
                'label' => 'telefono',
                'rules' => 'required|trim|min_length[6]|max_length[10]|numeric'
            ),
        );
        $this->form_validation->set_rules($config);

        //Reglas
         $this->form_validation->set_message('required', 'El campo'.' %s '.'son requerido');
        $this->form_validation->set_message('min_length', 'El campo'.' %s '.'debe contener un mínimo de'.' %s '.'caracteres');
        $this->form_validation->set_message('max_length', 'El campo'.' %s '.'debe contener un máximo de'.' %s '.'caracteres');
        $this->form_validation->set_message('numeric', 'El campo'.' %s '.'debe de contener solo números');
        
        if (!$this->form_validation->run()) {

            foreach ($config as $v1) {
                foreach ($v1 as $k => $v) {
                    $mensaje = form_error($v);
                    if ($mensaje != "") {
                        break 2;
                    }
                }
            }
            $arrMessage['mensaje'] = $mensaje;
        } else {

            $arrParam = array(
                'id_persona'             => $this->input->post('txt_id'),
                'id_rol_persona'         => $this->input->post('cb_rol_persona'),
                'id_tipo_persona'        => $this->input->post('cb_tipo_persona'),
                'nombre_completo'        => $this->input->post('txt_nombre_completo'),
                'documento_identidad'    => $this->input->post('txt_documento_identidad'),
                'telefono'               => $this->input->post('txt_telefono')
            );
            try {
                $result = $this->persona_m->actualizar_persona($arrParam);
                 $arrMessage['mensaje'] = $arrMessage['mensaje'] = $result[0]['Mensaje'];;
            } catch (Exception $e) {
                $arrMessage['mensaje'] = 'Error en la transaccion';
            }
             echo $arrMessage['mensaje'];
        }
        
    }

}