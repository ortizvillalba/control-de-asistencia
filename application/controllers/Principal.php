<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {
	public $user_indicadores;
	public $mensaje;

	function __construct() {
		parent::__construct();		
		
		$this->load->model('Principal_model');
		$this->user_indicadores = $this->session->userdata('user_session');	
	}
	public function index(){
		if(!$this->user_indicadores){ redirect('login'); }
		redirect('portada');
	}

	public function _remap($method, $params = array()){
        $param_offset = 2;	
        if ( !method_exists($this, $method)){
            $this->index();
        }else{
            // Dado que todo lo que tenemos es $ method, cargar todo lo demás en la URI
            $params = array_slice($this->uri->rsegment_array(), $param_offset);
            // llamamos al método determinado con todos sus parametros
            call_user_func_array(array($this, $method), $params);
        }
	}

	public function login(){	
		if($this->user_indicadores){ redirect('portada'); }

		$this->form_validation->set_rules('usuario', 'usuario', 'required|trim|min_length[4]|max_length[30]');
        $this->form_validation->set_rules('contrasena', 'contraseña', 'required|trim|min_length[5]|max_length[50]');         
        $this->form_validation->set_message('required', '<b>%s</b> es necesario');
        $this->form_validation->set_message('min_length', '<b>%s</b> debe tener al menos <b>%s</b> carácteres');
        $this->form_validation->set_message('max_length', '<b>%s</b> debe tener máximo <b>%s</b> carácteres');		
        $this->form_validation->set_error_delimiters('<span class="c-red">','</span>');
		if(!empty($_POST)) {			
			if ($this->form_validation->run() == TRUE) {		
				$usuario = htmlentities($this->input->post('usuario'));
                $contrasena = htmlentities($this->input->post('contrasena'));
								
				$link = ldap_connect('correo.senatics.gov.py') or die("Could not connect");
				if($link) {
					ldap_set_option($link, LDAP_OPT_PROTOCOL_VERSION, 3);
					if(ldap_set_option($link, LDAP_OPT_PROTOCOL_VERSION, 3)){
						if (!ldap_bind($link, 'uid='.$usuario.',ou=People,dc=senatics,dc=gov,dc=py', ''.$contrasena.'')) {
							$this->mensaje = "notify('Ups...','Credencial incorrecta', 'error');"; 
						}else {
							$params['usuario'] = $usuario;
							$this->session->set_userdata('user_session', $params);
							ldap_close($link); 
							redirect('portada');
						}
					}else{
						$this->mensaje = "notify('Ups...','No se conecto al servidor', 'error');"; 
					}
				}else {
					$this->mensaje = "notify('Ups...','No se conecto al servidor', 'error');"; 
				}
			}
		}		

		$data['titulo'] = "Iniciar sesión";
		$this->load->view('Template/login', $data);
	}
	
	public function portada(){
		if(!$this->user_indicadores){ redirect('login'); }
		$data['super_admin'] = $this->Principal_model->super_admin($this->user_indicadores['usuario']);

		$data['cant_total_indicadores'] = $this->Principal_model->cantidad_indicadores();

		$params['usuario'] = $this->user_indicadores['usuario'];
		$data['cant_mis_indicadores'] = $this->Principal_model->cantidad_indicadores($params);
		$data['listado_indicadores_estado'] = $this->Principal_model->listado_indicadores_estado($params);

		$data['titulo'] = "<i class='fa-tachometer-alt'></i> Dashboard";
		$data['content'] = 'portada';
		$this->load->view('Template/template', $data);
	}

	public function mis_indicadores(){
		if(!$this->user_indicadores){ redirect('login'); }
		$data['super_admin'] = $this->Principal_model->super_admin($this->user_indicadores['usuario']);

		$data['cant_total_indicadores'] = $this->Principal_model->cantidad_indicadores();
		$data['super_admin'] = $this->Principal_model->super_admin($this->user_indicadores['usuario']);

		$params['usuario'] = $this->user_indicadores['usuario'];
		$data['indicadores'] = $this->Principal_model->listado_indicadores($params);

		$data['cant_mis_indicadores'] = $this->Principal_model->cantidad_indicadores($params);

		$data['titulo'] = "<i class='ti-bag'></i> Mis indicadores";
		$data['content'] = 'tabla_indicadores';
		$this->load->view('Template/template', $data);
	}

	public function todos_los_indicadores(){
		if(!$this->user_indicadores){ redirect('login'); }
		$data['super_admin'] = $this->Principal_model->super_admin($this->user_indicadores['usuario']);

		$data['cant_total_indicadores'] = $this->Principal_model->cantidad_indicadores();
		$data['super_admin'] = $this->Principal_model->super_admin($this->user_indicadores['usuario']);

		$data['indicadores'] = $this->Principal_model->listado_indicadores();

		$params['usuario'] = $this->user_indicadores['usuario'];
		$data['cant_mis_indicadores'] = $this->Principal_model->cantidad_indicadores($params);

		$data['titulo'] = "<i class='fa fa-chart-pie'></i> Todos los indicadores";
		$data['content'] = 'tabla_indicadores';
		$this->load->view('Template/template', $data);
	}

	public function ver_indicador($id_indicador){
		if(!$this->user_indicadores){ redirect('login'); }
		$data['super_admin'] = $this->Principal_model->super_admin($this->user_indicadores['usuario']);

		$data['cant_total_indicadores'] = $this->Principal_model->cantidad_indicadores();
		$params['usuario'] = $this->user_indicadores['usuario'];
		$data['cant_mis_indicadores'] = $this->Principal_model->cantidad_indicadores($params);
		$data['super_admin'] = $this->Principal_model->super_admin($this->user_indicadores['usuario']);

		$data['detalles_indicador'] = $this->Principal_model->detalles_indicador($id_indicador);
		$data['listado_evolucion'] = $this->Principal_model->listado_evolucion($id_indicador);
		$data['grafico_detalle_evolucion'] = $this->Principal_model->grafico_detalle_evolucion($id_indicador);
		$params['id_indicador'] = $id_indicador;
		$data['listado_indicadores_estado'] = $this->Principal_model->listado_indicadores_estado($params);
		
		$data['titulo'] = "<i class='ti-menu'></i> Evolución de indicador";
		$data['content'] = 'detalles_indicador';
		$this->load->view('Template/template', $data);
	}
	
	public function agregar_evolucion($id_indicador){
		if(!$this->user_indicadores){ redirect('login'); }
		$data['super_admin'] = $this->Principal_model->super_admin($this->user_indicadores['usuario']);

		$data['es_reponsable'] = $this->Principal_model->es_reponsable($id_indicador, $this->user_indicadores['usuario']);
		if($data['es_reponsable']){
			$data['cant_total_indicadores'] = $this->Principal_model->cantidad_indicadores();
			$params['usuario'] = $this->user_indicadores['usuario'];
			$data['cant_mis_indicadores'] = $this->Principal_model->cantidad_indicadores($params);
			
			$data['detalles_indicador'] = $this->Principal_model->detalles_indicador($id_indicador);
			
			if(!empty($_POST)) {
				$this->form_validation->set_rules('mes', 'Mes', 'trim|required|strip_tags');
				$this->form_validation->set_rules('anho', 'Año', 'trim|required|strip_tags');
				$this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|strip_tags|max_length[11]');
				$this->form_validation->set_rules('masc', 'Hombres', 'trim|strip_tags|max_length[11]');
				$this->form_validation->set_rules('fem', 'Mujeres', 'trim|strip_tags|max_length[11]');
				$this->form_validation->set_rules('fuente_verificacion', 'Fuente de verificación', 'trim|strip_tags|max_length[2000]');
				$this->form_validation->set_rules('observacion', 'Observación', 'trim|strip_tags|max_length[2000]');
				$this->form_validation->set_message('required', '<b>%s</b> es necesario');
				$this->form_validation->set_message('min_length', '<b>%s</b> debe tener al menos <b>%s</b> carácteres');
				$this->form_validation->set_message('max_length', '<b>%s</b> debe tener máximo <b>%s</b> carácteres');	
				$this->form_validation->set_error_delimiters('<h4 style="color:red">','</h4>');

				if ($this->form_validation->run() == TRUE) {

					$params['id_indicador'] = $this->input->post('id_indicador');
					$params['mes'] = $this->input->post('mes');
					$params['anho'] = $this->input->post('anho');
					$params['cantidad'] = $this->input->post('cantidad');
					$params['masc'] = $this->input->post('masc');
					$params['fem'] = $this->input->post('fem');
					$params['fuente_verificacion'] = $this->input->post('fuente_verificacion');
					$params['observacion'] = $this->input->post('observacion');
					
					$resultado = $this->Principal_model->agregar_evolucion($params);
					if ($resultado === TRUE){
						redirect('indicador/'.$id_indicador);
					}else{
						if($resultado === "duplicado"){
							$this->mensaje = "notify('Ups...','Convinación mes/año ya se encuentra registrada. Intente con una fecha diferente','error');"; 
						}else{
							$this->mensaje = "notify('Ups...','Algo salio mal, intente de nuevo','error');"; 
						}
					}
				}
			}

			$data['titulo'] = "<i class='fa fa-plus'></i> Agregar Evolución al indicador";
			$data['content'] = 'agregar_evolucion';
			$this->load->view('Template/template', $data);
		}else{
			redirect('indicador/'.$id_indicador,'refresh');
		}
	}

	public function editar_evolucion($id_indicador,$id_evolucion){
		if(!$this->user_indicadores){ redirect('login'); }
		$data['super_admin'] = $this->Principal_model->super_admin($this->user_indicadores['usuario']);

		$data['es_reponsable'] = $this->Principal_model->es_reponsable($id_indicador, $this->user_indicadores['usuario']);
		if($data['es_reponsable']){
			$params['usuario'] = $this->user_indicadores['usuario'];

			if(!empty($_POST)) {
				$this->form_validation->set_rules('mes', 'Mes', 'trim|required|strip_tags');
				$this->form_validation->set_rules('anho', 'Año', 'trim|required|strip_tags');
				$this->form_validation->set_rules('cantidad', 'Cantidad', 'trim|strip_tags|max_length[11]');
				$this->form_validation->set_rules('masc', 'Hombres', 'trim|strip_tags|max_length[11]');
				$this->form_validation->set_rules('fem', 'Mujeres', 'trim|strip_tags|max_length[11]');
				$this->form_validation->set_rules('fuente_verificacion', 'Fuente de verificación', 'trim|strip_tags|max_length[2000]');
				$this->form_validation->set_rules('observacion', 'Observación', 'trim|strip_tags|max_length[2000]');
				$this->form_validation->set_message('required', '<b>%s</b> es necesario');
				$this->form_validation->set_message('min_length', '<b>%s</b> debe tener al menos <b>%s</b> carácteres');
				$this->form_validation->set_message('max_length', '<b>%s</b> debe tener máximo <b>%s</b> carácteres');	
				$this->form_validation->set_error_delimiters('<h4 style="color:red">','</h4>');

				if ($this->form_validation->run() == TRUE) {
					$params['id_evolucion'] = $this->input->post('id_evolucion');
					$params['id_indicador'] = $this->input->post('id_indicador');
					$params['mes'] = $this->input->post('mes');
					$params['anho'] = $this->input->post('anho');
					$params['cantidad'] = $this->input->post('cantidad');
					$params['masc'] = $this->input->post('masc');
					$params['fem'] = $this->input->post('fem');
					$params['fuente_verificacion'] = $this->input->post('fuente_verificacion');
					$params['observacion'] = $this->input->post('observacion');
					
					$resultado = $this->Principal_model->editar_evolucion($params);
					if ($resultado === TRUE){
						$this->mensaje = "notify('Yeah...','Cambios guardados con éxito','success');"; 
					}else{
						$this->mensaje = "notify('Ups...','Algo salio mal, intente de nuevo','error');"; 
					}
				}
			}
			$data['detalles_indicador'] = $this->Principal_model->detalles_indicador($id_indicador);
			$data['detalles_evolucion'] = $this->Principal_model->detalles_evolucion($id_evolucion);

			$data['titulo'] = "<i class='fa fa-edit'></i> Editar Evolución del indicador";
			$data['content'] = 'editar_evolucion';
			$this->load->view('Template/template', $data);
		}else{
			redirect('indicador/'.$id_indicador,'refresh');
		}
	}

	public function agregar_indicador(){
		if(!$this->user_indicadores){ redirect('login'); }
		$data['super_admin'] = $this->Principal_model->super_admin($this->user_indicadores['usuario']);
		if($data['super_admin']){
			$data['cant_total_indicadores'] = $this->Principal_model->cantidad_indicadores();
			$params['usuario'] = $this->user_indicadores['usuario'];
			$data['cant_mis_indicadores'] = $this->Principal_model->cantidad_indicadores($params);
						
			if(!empty($_POST)) {
				$this->form_validation->set_rules('indicador_desc', 'Nombre del indicador', 'trim|required|strip_tags|min_length[4]|max_length[126]');
				$this->form_validation->set_rules('descripcion', 'Descripción', 'trim|strip_tags|min_length[4]|max_length[500]');
				$this->form_validation->set_rules('frecuencia', 'Frecuencia', 'trim|strip_tags|min_length[4]|max_length[10]');
				$this->form_validation->set_rules('unidad_medida', 'Unidad de medida', 'trim|strip_tags|min_length[4]|max_length[36]');
				$this->form_validation->set_rules('responsables', 'Responsables', 'trim|strip_tags|min_length[4]|max_length[74]');
				$this->form_validation->set_message('required', '<b>%s</b> es necesario');
				$this->form_validation->set_message('min_length', '<b>%s</b> debe tener al menos <b>%s</b> carácteres');
				$this->form_validation->set_message('max_length', '<b>%s</b> debe tener máximo <b>%s</b> carácteres');	
				$this->form_validation->set_error_delimiters('<h4 style="color:red">','</h4>');

				if ($this->form_validation->run() == TRUE) {
					$params['indicador_desc'] = $this->input->post('indicador_desc');
					$params['descripcion'] = $this->input->post('descripcion');
					$params['frecuencia'] = $this->input->post('frecuencia');
					$params['unidad_medida'] = $this->input->post('unidad_medida');
					$params['responsables'] = $this->input->post('responsables');
					
					$resultado = $this->Principal_model->agregar_indicador($params);
					if ($resultado == TRUE){
						redirect('indicador/'.$resultado);
					}else{
						$this->mensaje = "notify('Ups...','Algo salio mal, intente de nuevo','error');"; 
					}
				}
			}
			
			$data['titulo'] = "<i class='fa fa-plus'></i> Agregar indicador";
			$data['content'] = 'agregar_indicador';
			$this->load->view('Template/template', $data);
		}else{
			redirect('indicador/'.$id_indicador,'refresh');
		}
	}

	public function editar_indicador($id_indicador){
		if(!$this->user_indicadores){ redirect('login'); }
		$data['super_admin'] = $this->Principal_model->super_admin($this->user_indicadores['usuario']);
		if($data['super_admin']){
			$params['usuario'] = $this->user_indicadores['usuario'];
			$accion = NULL;
			$data['detalles_indicador'] = $this->Principal_model->detalles_indicador($id_indicador);
			
			if(!empty($_POST)) {
				$accion = $this->input->post('accion');
				if($accion == "editar"){
					$this->form_validation->set_rules('indicador_desc', 'Nombre del indicador', 'trim|required|strip_tags|min_length[4]|max_length[126]');
					$this->form_validation->set_rules('descripcion', 'Descripción', 'trim|strip_tags|min_length[4]|max_length[500]');
					$this->form_validation->set_rules('frecuencia', 'Frecuencia', 'trim|strip_tags|min_length[4]|max_length[10]');
					$this->form_validation->set_rules('unidad_medida', 'Unidad de medida', 'trim|strip_tags|min_length[4]|max_length[36]');
					$this->form_validation->set_rules('responsables', 'Responsables', 'trim|strip_tags|min_length[4]|max_length[74]');
					$this->form_validation->set_message('required', '<b>%s</b> es necesario');
					$this->form_validation->set_message('min_length', '<b>%s</b> debe tener al menos <b>%s</b> carácteres');
					$this->form_validation->set_message('max_length', '<b>%s</b> debe tener máximo <b>%s</b> carácteres');	
					$this->form_validation->set_error_delimiters('<h4 style="color:red">','</h4>');

					if ($this->form_validation->run() == TRUE) {
						$params['id_indicador'] = $id_indicador;
						$params['indicador_desc'] = $this->input->post('indicador_desc');
						$params['descripcion'] = $this->input->post('descripcion');
						$params['frecuencia'] = $this->input->post('frecuencia');
						$params['unidad_medida'] = $this->input->post('unidad_medida');
						$params['responsables'] = $this->input->post('responsables');
						
						$resultado = $this->Principal_model->editar_indicador($params);
						if ($resultado === TRUE){
							$this->mensaje = "notify('Yeah...','Cambios guardados con éxito','success');"; 
						}else{
							$this->mensaje = "notify('Ups...','Algo salio mal, intente de nuevo','error');"; 
						}
					}
				}
				if($accion == "eliminar"){
					$params['id_indicador'] = $id_indicador;
					
					$resultado = $this->Principal_model->eliminar_indicador($params);
					if ($resultado === TRUE){
						$this->mensaje = "notify('Yeah...','Elimnado con éxito','success');"; 
					}else{
						$this->mensaje = "notify('Ups...','Algo salio mal, intente de nuevo','error');"; 
					}
				}
			}
			$data['detalles_indicador'] = $this->Principal_model->detalles_indicador($id_indicador);

			if($accion == "eliminar"){
				$data['indicadores'] = $this->Principal_model->listado_indicadores();
				$params['usuario'] = $this->user_indicadores['usuario'];
				$data['cant_mis_indicadores'] = $this->Principal_model->cantidad_indicadores($params);

				$data['titulo'] = "<i class='fa fa-chart-pie'></i> Todos los indicadores";
				$data['content'] = 'tabla_indicadores';
			}else{
				$data['titulo'] = "<i class='fa fa-edit'></i> Editar indicador";
				$data['content'] = 'editar_indicador';
			}
			$this->load->view('Template/template', $data);
		}else{
			redirect('indicador/'.$id_indicador,'refresh');
		}
	}
	

	public function logout() {
		$this->session->sess_destroy();
		redirect('login');
	}
}
