<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* @autor Edgar Cabral
*/
class Principal_model extends CI_Model {
	
    function __construct() {
        parent::__construct();
    }

    public function cantidad_indicadores($params=NULL) {  
        $this->db->select('*');
        $this->db->from('indicadores');
        if(isset($params) && $params){
            if($params['usuario']){
                $this->db->where("(responsables LIKE '%".$params['usuario']."%')");            
            }
        }
        return $this->db->count_all_results();
    }
    
    public function listado_indicadores($params=NULL) {  
        $this->db->select('*');
        $this->db->from('indicadores');
        if(isset($params) && $params){
            if($params['usuario']){
                $this->db->where("(responsables LIKE '%".$params['usuario']."%')");            
            }
        }
        return $this->db->get()->result_array();
    }

    public function listado_indicadores_estado($params=NULL) {
        $anho = date('Y');
        $mes = date('m');
        
        switch ($mes) {
            case '01':
                $mes = "Enero";
                break;

            case '02':
                $mes = "Febrero";
                break;
                
            case '03':
                $mes = "Marzo";
                break;

            case '04':
                $mes = "Abril";
                break;

            case '05':
                $mes = "Mayo";
                break;

            case '06':
                $mes = "Junio";
                break;

            case '07':
                $mes = "Julio";
                break;

            case '08':
                $mes = "Agosto";
                break;

            case '09':
                $mes = "Setiembre";
                break;

            case '10':
                $mes = "Octubre";
                break;

            case '11':
                $mes = "Noviembre";
                break;

            case '12':
                $mes = "Diciembre";
                break;
        }


        $this->db->select('a.*, (SELECT count(*) FROM evolucion b WHERE b.id_indicador = a.id_indicador and b.mes="'.$mes.'" and b.anho="'.$anho.'") as estado');
        $this->db->from('indicadores a');
        if(isset($params) && $params){
            if($params['usuario']){
                $this->db->where("a.responsables LIKE '%".$params['usuario']."%'");            
            }
            if(isset($params['id_indicador']) && $params['id_indicador']){
                $this->db->where('a.id_indicador',$params['id_indicador']);  
            }
        }
        return $this->db->get()->result_array();
    }

    public function detalles_indicador($id_indicador) {
        $this->db->select('a.*, SUM(b.cantidad) as cantidad_total, SUM(b.masc) as cantidad_hombres_total, SUM(b.fem) as cantidad_mujeres_total');
        $this->db->from('indicadores a');
        $this->db->join('evolucion b', 'a.id_indicador = b.id_indicador', 'left');
        $this->db->where('a.id_indicador',$id_indicador);            
        $this->db->group_by('a.id_indicador');  
        return $this->db->get()->result_array();
    }
    
    public function listado_evolucion($id_indicador) {  
        $this->db->select('*');
        $this->db->from('evolucion');
        $this->db->where('id_indicador',$id_indicador);  
        return $this->db->get()->result_array();
    }

    public function detalles_evolucion($id_evolucion) {  
        $this->db->select('*');
        $this->db->from('evolucion');
        $this->db->where('id_evolucion',$id_evolucion);            
        return $this->db->get()->result_array();
    }

    public function agregar_evolucion($params) {  
        $this->db->select('*');
        $this->db->from('evolucion');
        $this->db->where('id_indicador',$params['id_indicador']);  
        $this->db->where('mes',$params['mes']);            
        $this->db->where('anho',$params['anho']);            
        $existe = $this->db->get()->row();

        if(!$existe){
            $this->db->trans_start();
                $fields = array(
                    'id_indicador' => $params['id_indicador'],
                    'mes' => $params['mes'],
                    'anho' => $params['anho'],
                    'cantidad' => $params['cantidad'],
                    'masc' => $params['masc'],
                    'fem' => $params['fem'],
                    'fuente_verificacion' => $params['fuente_verificacion'],
                    'observacion' => $params['observacion']
                );                
                $this->db->insert('evolucion', $fields);
            $this->db->trans_complete();
            return $this->db->trans_status();
        }else{
            return "duplicado";
        }
    }

    public function editar_evolucion($params) {  
        $this->db->trans_start();
            $fields = array(
                'id_indicador' => $params['id_indicador'],
                'mes' => $params['mes'],
                'anho' => $params['anho'],
                'cantidad' => $params['cantidad'],
                'masc' => $params['masc'],
                'fem' => $params['fem'],
                'fuente_verificacion' => $params['fuente_verificacion'],
                'observacion' => $params['observacion']
            );                

            $this->db->where('id_evolucion', $params['id_evolucion'])->update('evolucion', $fields);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function grafico_detalle_evolucion($id_indicador) {  
        $this->db->select('a.anho, SUM(a.cantidad) as cantidad_total, SUM(a.masc) as cantidad_hombres_total, SUM(a.fem) as cantidad_mujeres_total');
        $this->db->from('evolucion a');
        $this->db->where('a.id_indicador',$id_indicador);  
        $this->db->order_by('a.anho','asc');  
        $this->db->group_by('a.anho'); 
        return $this->db->get()->result_array();
    }

    public function es_reponsable($id_indicador, $usuario) {  
        $this->db->select('*');
        $this->db->from('indicadores');
        $this->db->where('id_indicador',$id_indicador);  
        $this->db->where("(responsables LIKE '%".$usuario."%')");    
        return $this->db->get()->result_array();
    }

    public function super_admin($usuario) {  
        $this->db->select('*');
        $this->db->from('privilegios');
        $this->db->where('usuario',$usuario);  
        return $this->db->get()->result_array();
    }

    public function agregar_indicador($params) {  
        $fields = array(
            'indicador_desc' => $params['indicador_desc'],
            'descripcion' => $params['descripcion'],
            'frecuencia' => $params['frecuencia'],
            'unidad_medida' => $params['unidad_medida'],
            'responsables' => $params['responsables']
        );                
        $this->db->insert('indicadores', $fields);
        return $this->db->insert_id();
    }

    public function editar_indicador($params) {  
        $this->db->trans_start();
            $fields = array(
                'indicador_desc' => $params['indicador_desc'],
                'descripcion' => $params['descripcion'],
                'frecuencia' => $params['frecuencia'],
                'unidad_medida' => $params['unidad_medida'],
                'responsables' => $params['responsables']
            );                

            $this->db->where('id_indicador', $params['id_indicador'])->update('indicadores', $fields);
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    public function eliminar_indicador($params) {  
        $this->db->trans_start();               
            $this->db->delete('evolucion', array('id_indicador' => $params['id_indicador']));
            $this->db->delete('indicadores', array('id_indicador' => $params['id_indicador']));
        $this->db->trans_complete();
        return $this->db->trans_status();
    }
    
}