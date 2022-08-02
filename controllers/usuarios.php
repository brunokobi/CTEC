<?php

class Usuarios extends CI_Controller {
    

    function __construct() {
        parent::__construct();
            if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('ctec/login');
            }
            $this->load->helper(array('codegen_helper'));
            $this->load->model('usuarios_model','',TRUE);
            $this->data['menuConfiguracoes'] = 'Usuarios';
            $this->data['tipoUsuario'] = $this->session->userdata('tipo');
	}	
	
	function index(){
		$this->gerenciar();
	}

	function gerenciar(){

    /*    if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCliente')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar clientes.');
           redirect(base_url());
        } */
        $this->load->library('table');
        $this->load->library('pagination');
        
   
        $config['base_url'] = base_url().'usuarios/gerenciar/';
        $config['total_rows'] = $this->usuarios_model->count('usuarios');
        $config['per_page'] = 10;
        $config['next_link'] = 'Próxima';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div class="pagination alternate"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a style="color: #2D335B"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = 'Primeira';
        $config['last_link'] = 'Última';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        
        $this->pagination->initialize($config); 	
        
	$this->data['results'] = $this->usuarios_model->get('usuarios a, empresas b','a.cd_usuario, a.nm_usuario, a.login, a.cd_empresa, b.ds_empresa, a.st_usuario','a.cd_empresa = b.cd_empresa',$config['per_page'],$this->uri->segment(3));
       	
       	$this->data['view'] = 'usuarios/usuarios';
       	$this->load->view('tema/topo',$this->data);
    }
	
    function adicionar() {
  /*      if(!$this->permission->checkPermission($this->session->userdata('permissao'),'aCliente')){
           $this->session->set_flashdata('error','Você não tem permissão para adicionar clientes.');
           redirect(base_url());
        }
*/
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('usuarios') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $this->load->library('encrypt');
            $data = array(
                'nm_usuario' => set_value('usuario'),
                'cd_empresa' => set_value('empresa'),
                'login' => set_value('login'),
                'senha' => $this->encrypt->sha1($this->input->post('senha')),
                'tp_usuario' => set_value('tipo'),
                'st_usuario' => set_value('situacao'),
            );

            if ($this->usuarios_model->add('usuarios', $data) == TRUE) {
                $this->session->set_flashdata('success','Usuário adicionada com sucesso!');
                redirect(base_url() . 'usuarios/adicionar');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->load->model('empresas_model','',TRUE);        
	$this->data['empresas'] = $this->empresas_model->get('empresas','cd_empresa,ds_empresa','',0,0,'','',true);        
        $this->data['view'] = 'usuarios/adicionarusuario';
        $this->load->view('tema/topo', $this->data);

    }

    function editar() {
    /*    if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eCliente')){
           $this->session->set_flashdata('error','Você não tem permissão para editar clientes.');
           redirect(base_url());
        } */
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('usuarios') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'nm_usuario' => $this->input->post('usuario'),
                'cd_empresa' => $this->input->post('empresa'),
                'login' => $this->input->post('login'),
                'tp_usuario' => $this->input->post('tipo'),
                'st_usuario' => $this->input->post('situacao')                    
            );

            if ($this->usuarios_model->edit('usuarios', $data, 'cd_usuario', $this->input->post('cd_usuario')) == TRUE) {
                $this->session->set_flashdata('success','Usuário editado com sucesso!');
                redirect(base_url() . 'usuarios/editar/'.$this->input->post('cd_usuario'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }

        $this->data['result'] = $this->usuarios_model->getById($this->uri->segment(3));
        $this->data['view'] = 'usuarios/editarusuario';
        $this->load->view('tema/topo', $this->data);
    }

    public function visualizar(){

     /*   if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCliente')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar clientes.');
           redirect(base_url());
        } */

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->usuarios_model->getById($this->uri->segment(3));
        $this->data['view'] = 'usuarios/visualizar';
        $this->load->view('tema/topo', $this->data);

        
    }
	
    public function excluir(){

          /*  if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dCliente')){
               $this->session->set_flashdata('error','Você não tem permissão para excluir clientes.');
               redirect(base_url());
            } */

            
            $id =  $this->input->post('id');
            if ($id == null){

                $this->session->set_flashdata('error','Erro ao tentar excluir cliente.');            
                redirect(base_url().'usuarios/gerenciar');
            }

            $this->usuarios_model->delete('usuarios','cd_usuario',$id); 

            $this->session->set_flashdata('success','Usuário excluido com sucesso!');            
            redirect(base_url().'usuarios/gerenciar');
    }
}

