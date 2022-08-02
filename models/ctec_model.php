<?php
class Ctec_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    
    function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getById($id){
        $this->db->from('usuarios');
        $this->db->select('usuarios.*, empresas.*');
        $this->db->join('empresas', 'empresas.cd_empresa = usuarios.cd_empresa', 'left');
        $this->db->where('cd_usuario',$id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function alterarSenha($senha,$oldSenha,$id){

        $this->db->where('cd_usuario', $id);
        $this->db->limit(1);
        $usuario = $this->db->get('usuarios')->row();

        if($usuario->senha != $oldSenha){
            return false;
        }
        else{
            $this->db->set('senha',$senha);
            $this->db->where('cd_Usuario',$id);
            return $this->db->update('usuarios');    
        }

        
    }

    function pesquisar($termo){
         $data = array();

        $this->db->like('chamados.ds_assunto',$termo);
        $this->db->select('chamados.cd_chamado,chamados.dt_abertura,chamados.dt_encerramento,chamados.ds_assunto, chamados.cd_prioridade ,usuarios.nm_usuario, empresas.ds_empresa');
        $this->db->from('chamados');
        $this->db->join('usuarios','usuarios.cd_usuario = chamados.cd_usuario');
        $this->db->join('empresas','empresas.cd_empresa = chamados.cd_empresa');
		
		if ($this->session->userdata('tipo') == '1') {
           $this->db->where('chamados.cd_empresa = '  . $this->session->userdata('cd_empresa'));
        } 
        
		$this->db->order_by('chamados.dt_abertura ','desc');
         $data['chamados'] = $this->db->get()->result();

         return $data;   		 
		 }

    
    function add($table,$data){
        $this->db->insert($table, $data);         
        if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;       
    }
    
    function edit($table,$data,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->update($table, $data);

        if ($this->db->affected_rows() >= 0)
		{
			return TRUE;
		}
		
		return FALSE;       
    }
    
    function delete($table,$fieldID,$ID){
        $this->db->where($fieldID,$ID);
        $this->db->delete($table);
        if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;        
    }   
	
	function count($table){
		return $this->db->count_all($table);
	}


    public function getEstatisticas(){
        $sql = "SELECT sum(CASE WHEN st_chamado = 'A' THEN 1
             ELSE 0 END) as aberto, 
       sum(CASE WHEN st_chamado = 'E' THEN 1
             ELSE 0 END) as encerrado FROM chamados";
        return $this->db->query($sql)->row();
    }

    public function getEstatisticasEmpresa($id){
        $sql = "SELECT sum(CASE WHEN st_chamado = 'A' THEN 1
             ELSE 0 END) as aberto, 
       sum(CASE WHEN st_chamado = 'E' THEN 1
             ELSE 0 END) as encerrado FROM chamados where cd_empresa = " . $id;
        return $this->db->query($sql)->row();
    }

    public function getEstatisticasUsuarios() {
        $this->db->select('count(*) total, b.nm_usuario');
        $this->db->from('chamados a');
        $this->db->from('usuarios b');
        $this->db->where('a.cd_usuario = b.cd_usuario');
        $this->db->group_by('b.nm_usuario');        
        
        $query = $this->db->get();

        $resultado = $query->result();

        return $resultado;
    }
    
    public function getEstatisticasUsuariosEmpresa($id) {
        $this->db->select('count(*) total, b.nm_usuario');
        $this->db->from('chamados a');
        $this->db->from('usuarios b');
        $this->db->where('a.cd_usuario = b.cd_usuario');
        $this->db->where('a.cd_empresa', $id);
        $this->db->group_by('b.nm_usuario');        
        
        $query = $this->db->get();

        $resultado = $query->result();

        return $resultado;
    }
    
}