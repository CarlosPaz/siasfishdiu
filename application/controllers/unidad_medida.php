<?php

if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');


class Unidad_medida extends CI_Controller {
    var $_arr_Sesion;
    public function __construct() {
        
         parent::__construct();
         
         $this->_arr_Sesion = $this->session->userdata('ses_usuario');// datos traidos desde el login y permanentes mientras sigaactiva la sesion
         // $this->lang->load('generales');
         $this->load->helper('form');
         $this->load->library('form_validation'); // validacion de formulario
         $this->load->model('unidad_medida_m'); // carga el modelo asociado al controlador persona
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
        $this->load->view('backend/unidad_medida/unidad_medida_list_v', $arrSesion);
        $this->load->view('includes/footer');
    }
    
    public function get_unidad_medida_list(){
        // if ($this->seguridad->sec_class(__METHOD__)) return;
        // $arrSesion = $this->_arr_Sesion;
        $data = array(
            'id_persona' => null,
            'opcion'  => 2
        );
        $result = $this->unidad_medida_m->get_unidad_medida_list($data);	
        header("Content-type: application/json");
	echo Json_encode($result);
    }
    
    public function nueva_unidad_medida() {
        // if ($this->seguridad->sec_class(__METHOD__)) return;
        $this->load->view('backend/unidad_medida/unidad_medida_new_v',null);
    }
    
    public function editar_unidad_medida() {
        // if ($this->seguridad->sec_class(__METHOD__)) return;
        $data = array(
            'id_unidad_medida' => $this->input->post('id'),
            'opcion'  => 1
        );
        $result = $this->unidad_medida_m->get_unidad_medida_list($data);
        if (count($result) == 0) {
            echo 'No se encontraron datos!';
        } else {
            $arrSesion = array(
                'txt_id'                    => $result[0]['id_unidad_medida'],
                'txt_descripcion'           => $result[0]['descripcion'],
                'txt_estado'                => $result[0]['estado']    
            );          
            $this->load->view('backend/unidad_medida/unidad_medida_edit_v', $arrSesion);
        }
    }
    
    public function agregar_unidad_medida() {
        // if ($this->seguridad->sec_class(__METHOD__)) return;
        // Datos de validación
        $config = array(
            array(
                'field' => 'txt_descripcion',
                'label' => 'descripcion',
                'rules' => 'required|trim|min_length[3]'
            ),
            array(
                'field' => 'txt_estado',
                'label' => 'estado',
                'rules' => 'required|trim|min_length[6]|max_length[10]'
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
                'descripcion'        => $this->input->post('txt_descripcion'),
                'estado'             => $this->input->post('txt_estado')
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
    
    public function actualizar_unidad_medida() {
        // if ($this->seguridad->sec_class(__METHOD__)) return;
        
        // Datos de validación
        $config = array(
            array(
                'field' => 'txt_descripcion',
                'label' => 'descripcion',
                'rules' => 'required|trim|min_length[3]'
            ),
            array(
                'field' => 'txt_estado',
                'label' => 'estado',
                'rules' => 'required|trim|min_length[6]|max_length[10]'
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
                'id_unidad_medida'          => $this->input->post('txt_id'),
                'descripcion'               => $this->input->post('txt_descripcion'),
                'estado'                    => $this->input->post('txt_estado')
            );
            try {
                $result = $this->unidad_medida_m->actualizar_unidad_medida($arrParam);
                 $arrMessage['mensaje'] = $arrMessage['mensaje'] = $result[0]['Mensaje'];;
            } catch (Exception $e) {
                $arrMessage['mensaje'] = 'Error en la transaccion';
            }
             echo $arrMessage['mensaje'];
        }
        
    }            
    
}
