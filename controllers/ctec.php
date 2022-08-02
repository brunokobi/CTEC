<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ctec extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ctec_model', '', TRUE);
    }

    public function index() {
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('ctec/login');
        }

        $this->data['menuPainel'] = 'Painel';
        $this->data['view'] = 'ctec/painel';
        $tipousuario = $this->session->userdata('tipo');

        if ($tipousuario == 0) {
            $this->data['estatisticas'] = $this->ctec_model->getEstatisticas();
            $result1 = $this->ctec_model->getEstatisticasUsuarios();
        } else {
            $this->data['estatisticas'] = $this->ctec_model->getEstatisticasEmpresa($this->session->userdata('cd_empresa'));
            $result1 = $this->ctec_model->getEstatisticasUsuariosEmpresa($this->session->userdata('cd_empresa'));
        }

        $cont = 1;
        $qtde = count($result1);
        $out = '[';
        foreach ($result1 as $r1):;
            $out .= '[' . "'" . $r1->nm_usuario . "'" . ',' . $r1->total . ']';
            if ($cont !== $qtde) {
                $out .= ',';
                $cont ++;
            };
        endforeach;
        $out .= ']';

        $this->data['estatisticasusuarios'] = $out;

        $this->data['tipoUsuario'] = $this->session->userdata('tipo');
        $this->load->view('tema/topo', $this->data);
    }

    public function minhaConta() {
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('ctec/login');
        }

        $this->data['usuario'] = $this->ctec_model->getById($this->session->userdata('id'));
        $this->data['view'] = 'ctec/minhaConta';
        $this->data['tipoUsuario'] = $this->session->userdata('tipo');
        $this->load->view('tema/topo', $this->data);
    }

    public function alterarSenha() {
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('ctec/login');
        }
		
        $this->load->library('encrypt');
		
        $oldSenha = $this->encrypt->sha1($this->input->post('oldSenha'));
        $senha = $this->encrypt->sha1($this->input->post('novaSenha'));
        $result = $this->ctec_model->alterarSenha($senha, $oldSenha, $this->session->userdata('id'));
        if ($result) {
            $this->session->set_flashdata('success', 'Senha Alterada com sucesso!');
            redirect(base_url() . 'ctec/minhaConta');
        } else {
            $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar alterar a senha!');
            redirect(base_url() . 'ctec/minhaConta');
        }
    }

    public function pesquisar() {
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('ctec/login');
        }

        $termo = $this->input->get('termo');

		$this->data['tipoUsuario'] = $this->session->userdata('tipo');
		
        $data['result'] = $this->ctec_model->pesquisar($termo);
        $this->data['results'] = $data['result']['chamados'];

        $this->data['view'] = 'ctec/pesquisa';
        $this->load->view('tema/topo', $this->data);
    }

    public function login() {

        $this->load->view('ctec/login');
    }

    public function sair() {
        $this->session->sess_destroy();
        redirect('ctec/login');
    }

    public function verificarLogin() {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|xss_clean|trim');
        $this->form_validation->set_rules('senha', 'Senha', 'required|xss_clean|trim');
        $ajax = $this->input->get('ajax');
        if ($this->form_validation->run() == false) {

            if ($ajax == true) {
                $json = array('result' => false);
                echo json_encode($json);
            } else {
                $this->session->set_flashdata('error', 'Os dados de acesso estão incorretos.');
                redirect($this->login);
            }
        } else {

            $usuario = $this->input->post('email');
            $senha = $this->input->post('senha');

            $this->load->library('encrypt');
            $senha = $this->encrypt->sha1($senha);

            $this->db->where('login', $usuario);
            $this->db->where('senha', $senha);
            $this->db->where('st_usuario', '1');
            $this->db->where('a.cd_empresa = b.cd_empresa');
            $this->db->limit(1);
            $usuario = $this->db->get('usuarios a, empresas b')->row();
            if (count($usuario) > 0) {
                $dados = array('nome' => $usuario->nm_usuario, 'id' => $usuario->cd_usuario, 'logado' => TRUE, 'cd_empresa' => $usuario->cd_empresa, 'tipo' => $usuario->tp_usuario);
                $this->session->set_userdata($dados);

                if ($ajax == true) {
                    $json = array('result' => true);
                    echo json_encode($json);
                } else {
                    redirect(base_url() . 'ctec');
                }
            } else {
                if ($ajax == true) {
                    $json = array('result' => false);
                    echo json_encode($json);
                } else {
                    $this->session->set_flashdata('error', 'Os dados de acesso estão incorretos.');
                    redirect($this->login);
                }
            }
        }
    }

    public function backup() {

        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('ctec/login');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'cBackup')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para efetuar backup.');
            redirect(base_url());
        }



        $this->load->dbutil();
        $prefs = array(
            'format' => 'zip',
            'filename' => 'backup' . date('d-m-Y') . '.sql'
        );

        $backup = & $this->dbutil->backup($prefs);

        $this->load->helper('file');
        write_file(base_url() . 'backup/backup.zip', $backup);

        $this->load->helper('download');
        force_download('backup' . date('d-m-Y H:m:s') . '.zip', $backup);
    }

    function do_upload() {
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('ctec/login');
        }

        if (!$this->permission->checkPermission($this->session->userdata('permissao'), 'cEmitente')) {
            $this->session->set_flashdata('error', 'Você não tem permissão para configurar emitente.');
            redirect(base_url());
        }

        $this->load->library('upload');

        $image_upload_folder = FCPATH . 'assets/uploads';

        if (!file_exists($image_upload_folder)) {
            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
        }

        $this->upload_config = array(
            'upload_path' => $image_upload_folder,
            'allowed_types' => 'png|jpg|jpeg|bmp',
            'max_size' => 2048,
            'remove_space' => TRUE,
            'encrypt_name' => TRUE,
        );

        $this->upload->initialize($this->upload_config);

        if (!$this->upload->do_upload()) {
            $upload_error = $this->upload->display_errors();
            print_r($upload_error);
            exit();
        } else {
            $file_info = array($this->upload->data());
            return $file_info[0]['file_name'];
        }
    }

}
