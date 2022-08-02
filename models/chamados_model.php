<?php
class Chamados_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    
    function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields.',usuarios.nm_usuario, empresas.ds_empresa');
        $this->db->from($table);
        $this->db->join('usuarios','usuarios.cd_usuario = chamados.cd_usuario');
        $this->db->join('empresas','empresas.cd_empresa = chamados.cd_empresa');
        $this->db->limit($perpage,$start);
        $this->db->order_by('dt_abertura ','desc');
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getById($id){
        $this->db->select('chamados.*, empresas.*, usuarios.*');
        $this->db->from('chamados');
        $this->db->join('empresas','empresas.cd_empresa = chamados.cd_empresa');
        $this->db->join('usuarios','usuarios.cd_usuario = chamados.cd_usuario');
        $this->db->where('chamados.cd_chamado',$id);
        $this->db->limit(1);
        return $this->db->get()->row();
    }

    public function getLancamentos($id = null){
        $this->db->select('lancamentos.*, usuarios.*');
        $this->db->from('lancamentos');
        $this->db->join('usuarios','usuarios.cd_usuario = lancamentos.cd_usuario');
        $this->db->where('lancamentos.cd_chamado',$id);
        $this->db->order_by('lancamentos.cd_lancamento', 'asc');
        
        return $this->db->get()->result();
    }
    
    function add($table,$data,$returnId = false){
        $this->db->insert($table, $data);         
        if ($this->db->affected_rows() == '1')
		{
                        if($returnId == true){
                            return $this->db->insert_id($table);
                        }
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

    function count($table,$where=''){	
	    $this->db->select ( 'COUNT(*) AS `numrows`' );
        if($where){
             $this->db->where($where);
            } 
        $query = $this->db->get($table);
        return $query->row()->numrows;
    }


    public function autoCompleteUsuario($q){

        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('nome', $q);
        $this->db->where('situacao',1);
        $query = $this->db->get('usuarios');
        if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = array('label'=>$row['nome'].' | Telefone: '.$row['telefone'],'id'=>$row['idUsuarios']);
            }
            echo json_encode($row_set);
        }
    }




    public function anexar($os, $anexo, $url, $thumb, $path){
        
        $this->db->set('anexo',$anexo);
        $this->db->set('url',$url);
        $this->db->set('thumb',$thumb);
        $this->db->set('path',$path);
        $this->db->set('cd_chamado',$os);

        return $this->db->insert('anexos');
    }

    public function getAnexos($os){
        
        $this->db->where('cd_chamado', $os);
        return $this->db->get('anexos')->result();
    }
}