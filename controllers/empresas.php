<?php

class Empresas extends CI_Controller {
    

    function __construct() {
        parent::__construct();
            if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('ctec/login');
            }
            $this->load->helper(array('codegen_helper'));
            $this->load->model('empresas_model','',TRUE);
            $this->data['menuConfiguracoes'] = 'Empresas';
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
        
   
        $config['base_url'] = base_url().'empresas/gerenciar/';
        $config['total_rows'] = $this->empresas_model->count('empresas');
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
        
	$this->data['results'] = $this->empresas_model->get('empresas','cd_empresa,ds_empresa,ds_telefone','',$config['per_page'],$this->uri->segment(3));
       	
       	$this->data['view'] = 'empresas/empresas';
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

        if ($this->form_validation->run('empresas') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'ds_empresa' => set_value('nomeEmpresa'),
                'cep' => set_value('cep'),
                'ds_logradouro' => set_value('rua'),
                'numero' => set_value('numero'),
                'ds_bairro' => set_value('bairro'),
                'ds_cidade' => set_value('cidade'),
                'ds_telefone' => set_value('telefone'),
                'ds_telefone2' => set_value('celular'),
                'ds_estado' => set_value('estado'),
                'ds_email' => set_value('email'),
                'nr_cnpj' => set_value('documento')
            );

            if ($this->empresas_model->add('empresas', $data) == TRUE) {
                $this->session->set_flashdata('success','Empresa adicionada com sucesso!');
                redirect(base_url() . 'empresas/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'empresas/adicionarempresa';
        $this->load->view('tema/topo', $this->data);

    }

    function editar() {
    /*    if(!$this->permission->checkPermission($this->session->userdata('permissao'),'eCliente')){
           $this->session->set_flashdata('error','Você não tem permissão para editar clientes.');
           redirect(base_url());
        } */
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('empresas') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $data = array(
                'ds_empresa' => $this->input->post('nomeEmpresa'),
                'cep' => $this->input->post('cep'),
                'ds_logradouro' => $this->input->post('rua'),
                'numero' => $this->input->post('numero'),
                'ds_bairro' => $this->input->post('bairro'),
                'ds_cidade' => $this->input->post('cidade'),
                'ds_telefone' => $this->input->post('telefone'),
                'ds_telefone2' => $this->input->post('celular'),
                'ds_estado' => $this->input->post('estado'),
                'ds_email' => $this->input->post('email'),
                'nr_cnpj' => $this->input->post('documento')				
            );

            if ($this->empresas_model->edit('empresas', $data, 'cd_empresa', $this->input->post('cd_empresa')) == TRUE) {
                $this->session->set_flashdata('success','Empresa editada com sucesso!');
                redirect(base_url() . 'empresas/editar/'.$this->input->post('cd_empresa'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }


        $this->data['result'] = $this->empresas_model->getById($this->uri->segment(3));
        $this->data['view'] = 'empresas/editarempresa';
        $this->load->view('tema/topo', $this->data);

    }

    public function visualizar(){

     /*   if(!$this->permission->checkPermission($this->session->userdata('permissao'),'vCliente')){
           $this->session->set_flashdata('error','Você não tem permissão para visualizar clientes.');
           redirect(base_url());
        } */

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->empresas_model->getById($this->uri->segment(3));
        $this->data['view'] = 'empresas/visualizar';
        $this->load->view('tema/topo', $this->data);

        
    }
	
    public function excluir(){

          /*  if(!$this->permission->checkPermission($this->session->userdata('permissao'),'dCliente')){
               $this->session->set_flashdata('error','Você não tem permissão para excluir clientes.');
               redirect(base_url());
            } */

            
            $id =  $this->input->post('id');
            if ($id == null){
                $this->session->set_flashdata('error','Erro ao tentar excluir empresa.');            
                redirect(base_url().'empresas/gerenciar/');
            }

            $this->empresas_model->delete('empresas','cd_empresa',$id); 

            $this->session->set_flashdata('success','Empresa excluida com sucesso!');            
            redirect(base_url().'empresas/gerenciar/');
    }
}

