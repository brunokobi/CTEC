<?php

class Chamados extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('ctec/login');
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('chamados_model', '', TRUE);
        $this->data['menuChamado'] = 'chamados';
        $this->data['tipoUsuario'] = $this->session->userdata('tipo');
    }

    function index() {
        $this->gerenciar();
    }

    function gerenciar() {

        $tipoUsuario = $this->session->userdata('tipo');
        $empresa = $this->session->userdata('cd_empresa');

        $this->load->library('pagination');


        $config['base_url'] = base_url() . 'chamados/gerenciar/';
        if ($tipoUsuario == '1') {
            $config['total_rows'] = $this->chamados_model->count('chamados', 'cd_empresa = ' . $empresa);
        } else {
            $config['total_rows'] = $this->chamados_model->count('chamados');
        }
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

        $tipoUsuario = $this->session->userdata('tipo');
        if ($tipoUsuario == '1') {
            $this->data['results'] = $this->chamados_model->get('chamados', 'cd_chamado,dt_abertura,dt_encerramento,ds_assunto, cd_prioridade', 'chamados.cd_empresa = ' . $empresa, $config['per_page'], $this->uri->segment(3));
        } else {
            $this->data['results'] = $this->chamados_model->get('chamados', 'cd_chamado,dt_abertura,dt_encerramento,ds_assunto, cd_prioridade', '', $config['per_page'], $this->uri->segment(3));
        }
        $this->data['view'] = 'chamados/visualizar';
        $this->load->view('tema/topo', $this->data);
    }

    function abertos() {

        $tipoUsuario = $this->session->userdata('tipo');
        $empresa = $this->session->userdata('cd_empresa');

        $this->load->library('pagination');


        $config['base_url'] = base_url() . 'chamados/abertos/';
        if ($tipoUsuario == '1') {
            $config['total_rows'] = $this->chamados_model->count('chamados', "st_chamado = 'A' and cd_empresa = " . $empresa);
        } else {
            $config['total_rows'] = $this->chamados_model->count('chamados', "st_chamado = 'A'");
        }
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

        $tipoUsuario = $this->session->userdata('tipo');
        $empresa = $this->session->userdata('cd_empresa');

        if ($tipoUsuario == '1') {
            $this->data['results'] = $this->chamados_model->get('chamados', 'cd_chamado,dt_abertura,dt_encerramento,ds_assunto, cd_prioridade', "st_chamado = 'A' and chamados.cd_empresa = " . $empresa, $config['per_page'], $this->uri->segment(3));
        } else {
            $this->data['results'] = $this->chamados_model->get('chamados', 'cd_chamado,dt_abertura,dt_encerramento,ds_assunto, cd_prioridade', "st_chamado = 'A'", $config['per_page'], $this->uri->segment(3));
        }
        $this->data['view'] = 'chamados/chamados';
        $this->load->view('tema/topo', $this->data);
    }

    function encerrados() {

        $tipoUsuario = $this->session->userdata('tipo');
        $empresa = $this->session->userdata('cd_empresa');

        $this->load->library('pagination');


        $config['base_url'] = base_url() . 'chamados/encerrados/';
        if ($tipoUsuario == '1') {
            $config['total_rows'] = $this->chamados_model->count('chamados', "st_chamado = 'E' and cd_empresa = " . $empresa);
        } else {
            $config['total_rows'] = $this->chamados_model->count('chamados', "st_chamado = 'E'");
        }
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

        $tipoUsuario = $this->session->userdata('tipo');
        $empresa = $this->session->userdata('cd_empresa');

        if ($tipoUsuario == '1') {
            $this->data['results'] = $this->chamados_model->get('chamados', 'cd_chamado,dt_abertura,dt_encerramento,ds_assunto, cd_prioridade', "st_chamado = 'E' and chamados.cd_empresa = " . $empresa, $config['per_page'], $this->uri->segment(3));
        } else {
            $this->data['results'] = $this->chamados_model->get('chamados', 'cd_chamado,dt_abertura,dt_encerramento,ds_assunto, cd_prioridade', "st_chamado = 'E'", $config['per_page'], $this->uri->segment(3));
        }
        $this->data['view'] = 'chamados/chamados';
        $this->load->view('tema/topo', $this->data);
    }

    function adicionar() {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('chamados') == false) {
            $this->data['custom_error'] = (validation_errors() ? true : false);
        } else {
            $dataInicial = date('Y/m/d');
            $data = array(
                'dt_abertura' => $dataInicial,
                'cd_usuario' => $this->session->userdata('id'),
                'ds_assunto' => $this->input->post('assunto'),
                'cd_prioridade' => $this->input->post('prioridade'),
                'cd_empresa' => $this->session->userdata('cd_empresa'),
                'st_chamado' => 'A'
            );

            if (is_numeric($id = $this->chamados_model->add('chamados', $data, true))) {
                $this->session->set_flashdata('success', 'Chamado adicionado com sucesso, você pode adicionar imagens também"!');

                $data = array(
                    'dt_lancamento' => $dataInicial,
                    'cd_usuario' => $this->session->userdata('id'),
                    'ds_lancamento' => $this->input->post('descricaochamado'),
                    'cd_chamado' => $id
                );

                $this->chamados_model->add('lancamentos', $data, true);
                $this->enviarEmail($id,0);
                redirect('chamados/editar/' . $id);
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }

        $this->data['view'] = 'chamados/adicionarchamados';
        $this->load->view('tema/topo', $this->data);
    }

    public function adicionarAjax() {
        $this->load->library('form_validation');

        if ($this->form_validation->run('os') == false) {
            $json = array("result" => false);
            echo json_encode($json);
        } else {
            $data = array(
                'dataInicial' => set_value('dataInicial'),
                'clientes_id' => $this->input->post('clientes_id'), //set_value('idCliente'),
                'usuarios_id' => $this->input->post('usuarios_id'), //set_value('idUsuario'),
                'dataFinal' => set_value('dataFinal'),
                'garantia' => set_value('garantia'),
                'descricaoProduto' => set_value('descricaoProduto'),
                'defeito' => set_value('defeito'),
                'status' => set_value('status'),
                'observacoes' => set_value('observacoes'),
                'laudoTecnico' => set_value('laudoTecnico')
            );

            if (is_numeric($id = $this->os_model->add('os', $data, true))) {
                $json = array("result" => true, "id" => $id);
                echo json_encode($json);
            } else {
                $json = array("result" => false);
                echo json_encode($json);
            }
        }
    }

    function editar() {
        $this->data['result'] = $this->chamados_model->getById($this->uri->segment(3));
        $this->data['anexos'] = $this->chamados_model->getAnexos($this->uri->segment(3));
        $this->data['lancamentos'] = $this->chamados_model->getLancamentos($this->uri->segment(3));

        $this->data['view'] = 'chamados/editarchamados';
        $this->load->view('tema/topo', $this->data);
    }

    public function visualizar() {

        $this->data['custom_error'] = '';
        $this->load->model('mapos_model');
        $this->data['result'] = $this->os_model->getById($this->uri->segment(3));
        $this->data['produtos'] = $this->os_model->getProdutos($this->uri->segment(3));
        $this->data['servicos'] = $this->os_model->getServicos($this->uri->segment(3));
        $this->data['emitente'] = $this->mapos_model->getEmitente();

        $this->data['view'] = 'os/visualizarOs';
        $this->load->view('tema/topo', $this->data);
    }

    function excluir() {

        $id = $this->input->post('id');

        if ($id == null) {
            $this->session->set_flashdata('error', 'Erro ao tentar excluir o chamado.');
            redirect(base_url() . 'chamados/gerenciar/');
        }

        $this->db->where('cd_chamado', $id);
        $this->db->delete('lancamentos');

        $this->db->where('cd_chamado', $id);
        $this->db->delete('anexos');

        $this->chamados_model->delete('chamados', 'cd_chamado', $id);


        $this->session->set_flashdata('success', 'Chamado excluído com sucesso!');
        redirect(base_url() . 'chamados/gerenciar/');
    }

    public function andamento() {
        $dataInicial = date('Y/m/d');
        $chamado = $this->input->post('chamado');
        $data = array(
            'ds_lancamento' => $this->input->post('andamento'),
            'cd_chamado' => $chamado,
            'dt_lancamento' => $dataInicial,
            'cd_usuario' => $this->session->userdata('id')
        );

        if ($this->chamados_model->add('lancamentos', $data) == TRUE) {
            $this->session->set_flashdata('success', 'Andamento adicionado com sucesso!');
            $this->enviarEmail($chamado,1);
            $json = array('result' => true);
            echo json_encode($json);
        } else {
            $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar adicionar o andamento.');
            $json = array('result' => false);
            echo json_encode($json);
        }
    }

    public function encerrar() {
        $dataInicial = date('Y/m/d');
        $dataFim = date('Y/m/d');
        $chamado = $this->input->post('chamado');
        $usuario = $this->session->userdata('id');

        $data = array(
            'ds_lancamento' => $this->input->post('andamento'),
            'cd_chamado' => $this->input->post('chamado'),
            'dt_lancamento' => $dataInicial,
            'cd_usuario' => $this->session->userdata('id')
        );

        if ($this->chamados_model->add('lancamentos', $data) == TRUE) {
            $sql = "UPDATE chamados set st_chamado = 'E', cd_usuario_encerrou = ?, dt_encerramento = ? WHERE cd_chamado = ?";
            $this->db->query($sql, array($usuario, $dataFim, $chamado));
            $this->enviarEmail($chamado,2);
            $this->session->set_flashdata('success', 'Processo encerrado!');
            $json = array('result' => true);
            echo json_encode($json);
        } else {
            $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar encerrar o processo.');
            $json = array('result' => false);
            echo json_encode($json);
        }
    }

    public function anexar() {

        $this->load->library('upload');
        $this->load->library('image_lib');

        $upload_conf = array(
            'upload_path' => realpath('./assets/anexos'),
            'allowed_types' => 'jpg|png|gif|jpeg|JPG|PNG|GIF|JPEG|pdf|PDF|cdr|CDR|docx|DOCX|txt', // formatos permitidos para anexos de os
            'max_size' => 0,
        );

        $this->upload->initialize($upload_conf);

        // Change $_FILES to new vars and loop them
        foreach ($_FILES['userfile'] as $key => $val) {
            $i = 1;
            foreach ($val as $v) {
                $field_name = "file_" . $i;
                $_FILES[$field_name][$key] = $v;
                $i++;
            }
        }
        // Unset the useless one ;)
        unset($_FILES['userfile']);

        // Put each errors and upload data to an array
        $error = array();
        $success = array();

        // main action to upload each file
        foreach ($_FILES as $field_name => $file) {
            if (!$this->upload->do_upload($field_name)) {
                // if upload fail, grab error 
                $error['upload'][] = $this->upload->display_errors();
            } else {
                // otherwise, put the upload datas here.
                // if you want to use database, put insert query in this loop
                $upload_data = $this->upload->data();

                if ($upload_data['is_image'] == 1) {

                    // set the resize config
                    $resize_conf = array(
                        // it's something like "/full/path/to/the/image.jpg" maybe
                        'source_image' => $upload_data['full_path'],
                        // and it's "/full/path/to/the/" + "thumb_" + "image.jpg
                        // or you can use 'create_thumbs' => true option instead
                        'new_image' => $upload_data['file_path'] . 'thumbs/thumb_' . $upload_data['file_name'],
                        'width' => 200,
                        'height' => 125
                    );

                    // initializing
                    $this->image_lib->initialize($resize_conf);

                    // do it!
                    if (!$this->image_lib->resize()) {
                        // if got fail.
                        $error['resize'][] = $this->image_lib->display_errors();
                    } else {
                        // otherwise, put each upload data to an array.
                        $success[] = $upload_data;

                        $this->load->model('chamados_model');

                        $this->chamados_model->anexar($this->input->post('chamado'), $upload_data['file_name'], base_url() . 'assets/anexos/', 'thumb_' . $upload_data['file_name'], realpath('./assets/anexos/'));
                    }
                } else {

                    $success[] = $upload_data;

                    $this->load->model('chamados_model');

                    $this->chamados_model->anexar($this->input->post('chamado'), $upload_data['file_name'], base_url() . 'assets/anexos/', '', realpath('./assets/anexos/'));
                }
            }
        }

        // see what we get
        if (count($error) > 0) {
            //print_r($data['error'] = $error);
            echo json_encode(array('result' => false, 'mensagem' => 'Nenhum arquivo foi anexado.'));
        } else {
            //print_r($data['success'] = $upload_data);
            echo json_encode(array('result' => true, 'mensagem' => 'Arquivo(s) anexado(s) com sucesso .'));
        }
    }

    public function excluirAnexo($id = null) {
        if ($id == null || !is_numeric($id)) {
            echo json_encode(array('result' => false, 'mensagem' => 'Erro ao tentar excluir anexo.'));
        } else {

            $this->db->where('idAnexos', $id);
            $file = $this->db->get('anexos', 1)->row();

            unlink($file->path . '/' . $file->anexo);

            if ($file->thumb != null) {
                unlink($file->path . '/thumbs/' . $file->thumb);
            }

            if ($this->os_model->delete('anexos', 'idAnexos', $id) == true) {

                echo json_encode(array('result' => true, 'mensagem' => 'Anexo excluído com sucesso.'));
            } else {
                echo json_encode(array('result' => false, 'mensagem' => 'Erro ao tentar excluir anexo.'));
            }
        }
    }

    public function downloadanexo($id = null) {

        if ($id != null && is_numeric($id)) {

            $this->db->where('cd_anexos', $id);
            $file = $this->db->get('anexos', 1)->row();

            $this->load->library('zip');

            $path = $file->path;

            $this->zip->read_file($path . '/' . $file->anexo);

            $this->zip->download('file' . date('d-m-Y-H.i.s') . '.zip');
        }
    }

    public function enviarEmail($id, $nivel) {
        $chamado = $this->chamados_model->getById($id);
        $lancamentos = $this->chamados_model->getLancamentos($id);

        $tipousuario = $this->session->userdata('tipo');

        if ($nivel == 0) {
            $assunto = '#Protocolo: ' . $id . ' Abertura de Chamado - ' . $chamado->ds_assunto . ' - ' . $chamado->ds_empresa;
        };
        if ($nivel == 1) {
            $assunto = '#Protocolo: ' . $id . ' Andamento de Chamado - ' . $chamado->ds_assunto . ' - ' . $chamado->ds_empresa;
        };
        if ($nivel == 2) {
            $assunto = '#Protocolo: ' . $id . ' Encerramento de Chamado - ' . $chamado->ds_assunto . ' - ' . $chamado->ds_empresa;
        };
        
        
$mensagem = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
$mensagem .= '<html> <head> <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
$mensagem .= '<title>cTéc</title>';
$mensagem .= '<style type="text/css">';
$mensagem .= 'body{margin:0; padding:0;}';
$mensagem .= '</style></head><body>';
$mensagem .= '<table cellpadding="0" cellspacing="0" border="0" width="100%" style="width:100%;font-family:Verdana, Helvetica, sans-serif;color:#FFFFFF;font-size:13px;line-height:180%">';
$mensagem .= '	<tr>';
$mensagem .= '		<td style="background-color:#1F2327;border-bottom:2px #FFFFFF solid" bgcolor="#1F2327">';
$mensagem .= '			<table cellpadding="10" cellspacing="0" border="0" width="650px" style="width:650px" align="center">';
$mensagem .= '				<tr>';
$mensagem .= '					<td align="right">';
$mensagem .= '					<span style="font-size:12px;font-weight:bold">Sistema de controle de chámados técnicos</span><br/>';
$mensagem .= '					</td>';
$mensagem .= '				</tr>';
$mensagem .= '			</table>';
$mensagem .= '		</td>';
$mensagem .= '	</tr>';
$mensagem .= '	<tr>';
$mensagem .= '		<td style="background-color:#5F872F;" bgcolor="#5F872F">';
$mensagem .= '			<table cellpadding="10" cellspacing="0" border="0" width="650px" style="width:650px;font-family:Verdana, Helvetica, sans-serif;color:#FFFFFF;font-size:13px;line-height:180%" align="center">';
$mensagem .= '				<tr>';
$mensagem .= '					<td align="left">';
$mensagem .= '						<span style="font-size:15px;font-weight:bold">' .$assunto.'</span><br/>';
$mensagem .= '					</td>';
$mensagem .= '				</tr>';
$mensagem .= '			</table>';
$mensagem .= '		</td>';
$mensagem .= '	</tr>';
$mensagem .= '	<tr>';
$mensagem .= '		<td style="background-color:#EBEDE2;" bgcolor="#EBEDE2">';
$mensagem .= '			<table cellpadding="10" cellspacing="0" border="0" width="650px" style="width:650px;font-family:Verdana, Helvetica, sans-serif;color:#000000;font-size:13px;line-height:180%" align="center">';
$mensagem .= '				<tr>';
$mensagem .= '					<td style="font-size:12px;font-weight:bold;color:#5F872F" align="center">';
$mensagem .= '						Andamentos da solicitação';
$mensagem .= '					</td>';
$mensagem .= '				</tr>';
$mensagem .= '				<tr>';
$mensagem .= '					<td>';
$mensagem .= '						<table cellpadding="0" cellspacing="0" border="0" width="600px" style="width:600px" align="center">';
$mensagem .= '							<tr>';
$mensagem .= '								<td>';
        foreach ($lancamentos as $r) {
                         $dataInicial = date(('d/m/Y'), strtotime($r->dt_lancamento));
$mensagem .= '									<table cellpadding="10" cellspacing="0" border="0" width="100%px" style="width:100%px;font-family:Verdana, Helvetica, sans-serif;color:#000000;font-size:11px;border:1px #EBEDE2 solid;line-height:200%" align="right">';
$mensagem .= '										<tr>';
$mensagem .= '											<td style="color:#FFFFFF;font-size:14px;font-weight:bold" bgcolor="#1F2327" align="left">';
$mensagem .= 												 $dataInicial . ' - ' . $r->nm_usuario;
$mensagem .= '											</td>';
$mensagem .= '										</tr>';
$mensagem .= '										<tr>';
$mensagem .= '											<td bgcolor="#F9FAF5" align="left">';
$mensagem .=                                                                                           nl2br($r->ds_lancamento);
$mensagem .= '											</td>';
$mensagem .= '										</tr>';
$mensagem .= '									</table>';
                                    };
$mensagem .= '								</td>';
$mensagem .= '							</tr>';
$mensagem .= '						</table>';
$mensagem .= '					</td>';
$mensagem .= '				</tr>';
$mensagem .= '			</table><br/><br/>';
$mensagem .= '		</td>';
$mensagem .= '	</tr>';
$mensagem .= '	<tr>';
$mensagem .= '		<td style="background-color:#1F2327;border-bottom:2px #FFFFFF solid" bgcolor="#1F2327">';
$mensagem .= '			<table cellpadding="10" cellspacing="0" border="0" width="650px" style="width:650px;color:#9D9A93;font-family:Verdana, Helvetica, sans-serif;font-size:11px" align="center">';
$mensagem .= '				<tr>';
$mensagem .= '					<td align="left">';
$mensagem .= '						© Copyright 2016 - <a href="http://infovix.ddns.net" style="text-decoration:none;color:#0066CC"><span style="color:#0066CC">infovix.ddns.net</span></a>';
$mensagem .= '					</td>';
$mensagem .= '				</tr>';
$mensagem .= '			</table>';
$mensagem .= '		</td>';
$mensagem .= '	</tr>';
$mensagem .= '</table>';
$mensagem .= '</body>';
$mensagem .= '</html>';

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'ayolphi@gmail.com',
            'smtp_pass' => 'adm123',
            'mailtype' => 'html',
            'charset' => 'UTF-8'
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");

        if ($tipousuario == '0') {
            $this->email->from('ayolphi@gmail.com', 'ayolphi@gmail.com');
            $this->email->to($chamado->login);
        } else {
            $this->email->from($chamado->login, $chamado->login);
            $this->email->to('ayolphi@gmail.com');
        }
        $this->email->subject($assunto);
        $this->email->message($mensagem);

        if ($this->email->send()) {return true;}else{return false;}
    }

}
