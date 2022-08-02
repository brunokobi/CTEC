<?php
class Relatorios_model extends CI_Model {


    /**
     * author: Ramon Silva 
     * email: silva018-mg@yahoo.com.br
     * 
     */
    
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

    function count($table) {
        return $this->db->count_all($table);
    }
    
    public function chamadosCustom($dataInicial = null,$dataFinal = null){
        
        if($dataInicial == null || $dataFinal == null){
            $dataInicial = date('Y-m-d');
            $dataFinal = date('Y-m-d');
        }
        $query = "SELECT * FROM chamados a, usuarios b WHERE  a.cd_usuario = b.cd_usuario and  a.dt_abertura BETWEEN ? AND ?";
		
		if ($this->session->userdata('tipo') == '1') {
            $query .= ' and a.cd_empresa = ' . $this->session->userdata('cd_empresa');
        } 
		
        return $this->db->query($query, array($dataInicial,$dataFinal))->result();
    }

    public function chamadosRapid(){
        $this->db->select('chamados.cd_chamado,chamados.dt_abertura,chamados.dt_encerramento,chamados.ds_assunto, chamados.cd_prioridade ,usuarios.nm_usuario, empresas.ds_empresa');
        $this->db->from('chamados');
        $this->db->join('usuarios','usuarios.cd_usuario = chamados.cd_usuario');
        $this->db->join('empresas','empresas.cd_empresa = chamados.cd_empresa');
		
		if ($this->session->userdata('tipo') == '1') {
           $this->db->where('chamados.cd_empresa = '  . $this->session->userdata('cd_empresa'));
        } 
		
        $this->db->order_by('chamados.dt_abertura ','desc');
		
        return $this->db->get()->result();
    }

   
}