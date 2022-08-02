<?php

class Relatorios extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('ctec/login');
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('relatorios_model', '', TRUE);
        $this->data['tipoUsuario'] = $this->session->userdata('tipo');
		$this->data['menuRelatorios'] = 'Relatórios';
		
    }

    function index() {
        $this->gerenciar();
    }

    function chamados() {
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('ctec/login');
        }

        $this->data['view'] = 'relatorios/chamados';
        $this->data['menuRelatorios'] = 'X';

        $this->load->view('tema/topo', $this->data);
    }

	
    public function chamadosRapid(){
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('ctec/login');
        }

        $data['results'] = $this->relatorios_model->chamadosRapid();

        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirchamados', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirChamados', $data, true);
        pdf_create($html, 'relatorio_chamados' . date('d/m/y'), TRUE);
    }

    public function chamadosCustom(){
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('ctec/login');
        }

        $dataInicial = $this->input->get('dataInicial');
        $dataFinal = $this->input->get('dataFinal');

        $data['results'] = $this->relatorios_model->chamadosCustom($dataInicial,$dataFinal);

        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirchamados', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirChamados', $data, true);
        pdf_create($html, 'relatorio_chamados' . date('d/m/y'), TRUE);
    
    }	
	
    public function chamadosExport(){
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('ctec/login');
        }

        $results = $this->relatorios_model->chamadosRapid();
		
		$texto = '';
		foreach ($results as $r)
		{
		   $texto .= 'Código: ' . $r->cd_chamado;
		   $texto .= PHP_EOL;
		   $texto .= 'Assunto: ' . $r->ds_assunto;
		   $texto .= PHP_EOL;
		   $texto .= 'Data Abertura: ' . $r->dt_abertura;
		   $texto .= PHP_EOL;
		   $texto .= 'usuario: ' . $r->nm_usuario;
		   $texto .= PHP_EOL;
		   $texto .= 'Ecerramento: ' . $r->dt_encerramento;
		   $texto .= PHP_EOL;
		   $texto .= '----------------------------------------------------------------';
		   $texto .= PHP_EOL;
		   
		}

		$caminho = '/var/www/htdocs/chamado/assets/arquivos/export.txt';
		
		$fp = fopen($caminho, "w"); 
		$escreve = fwrite($fp, $texto);
		fclose($fp);		
		
		$this->load->helper('download');
		$data = file_get_contents($caminho);
		force_download('export.txt',$data);
    }


	
}
