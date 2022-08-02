
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CTec - Chamados</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/matrix-style.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/matrix-media.css" />
        <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fullcalendar.css" /> 

        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
        <script type="text/javascript"  src="<?php echo base_url(); ?>assets/js/jquery-1.10.2.min.js"></script>

    </head>
    <body>

        <!--Header-part-->
        <div id="header">
            <h1><a href="">CTéc - Chamado Técnico</a></h1>
        </div>
        <!--close-Header-part--> 

        <!--top-Header-menu-->
        <div id="user-nav" class="navbar-nav" >
            <ul class="navbar-header">
                <li class=""><a title="" href="<?php echo base_url(); ?>ctec/minhaConta"><i class="icon icon-star"></i> <span class="text">Minha Conta</span></a></li>
                <li class=""><a title="" href="<?php echo base_url(); ?>ctec/sair"><i class="icon icon-share-alt"></i> <span class="text">Sair do Sistema</span></a></li>
            </ul>
        </div>

        <!--start-top-serch-->
        <div id="search">
            <form action="<?php echo base_url() ?>ctec/pesquisar">
                <input type="text" name="termo" placeholder="Pesquisar..."/>
                <button type="submit"  class="button" title="Pesquisar"><i class="icon-search icon-white"></i></button>

            </form>
        </div>
        <!--close-top-serch--> 

        <!--sidebar-menu-->

        <div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-list"></i> Menu</a>
            <ul>
                <li class="<?php
                if (isset($menuPainel)) {
                    echo 'active';
                };
                ?>"><a href="<?php echo base_url() ?>"><i class="icon icon-asterisk"></i> <span>Dashboard</span></a></li>

                <li class="submenu <?php
                if (isset($menuChamado)) {
                    echo 'active open';
                };
                ?>">
                    <a href="#"><i class="icon icon-wrench"></i> <span>Chamados Técnicos</span> <span class="label"><i class="icon-chevron-down"></i></span></a>
                    <ul>
					    <li><a href="<?php echo base_url() ?>chamados">Todos</a></li>
                        <li><a href="<?php echo base_url() ?>chamados/abertos">Chamados em aberto</a></li>
                        <li><a href="<?php echo base_url() ?>chamados/encerrados">Chamados Encerrados</a></li>
                    </ul>
                </li>                

                <li class="submenu <?php
                if (isset($menuRelatorios)) {
                    echo 'active open';
                };
                ?>" >
                    <a href="#"><i class="icon icon-list-alt"></i> <span>Relatórios</span> <span class="label"><i class="icon-chevron-down"></i></span></a>
                    <ul>
                        <li><a href="<?php echo base_url() ?>relatorios/chamados">Chamados</a></li>
                    </ul>
                </li>

                <?php
                if ($tipoUsuario == "0") { if (isset($menuConfiguracoes)) { $out =  '<li class="submenu active open">'; } else { $out =  '<li class="submenu">'; }
                    
                   $out .= " <a href=\"#\"><i class=\"icon icon-cog\"></i> <span>Configurações</span> <span class=\"label\"><i class=\"icon-chevron-down\"></i></span></a> \n" .
                    " <ul> \n" .
                    "     <li><a href=\" ".base_url(). "usuarios\">Usuários</a></li>\n" .
                    "     <li><a href=\" ".base_url(). "empresas\">Empresas</a></li>\n" .
                    "     <li><a href=\" ".base_url(). "ctec/backup\">Backup</a></li>\n" .
                    " </ul>\n" .
                    "</li>\n" ;
               echo $out; }
                ?>

            </ul>
        </div>
        <div id="content">
            <div id="content-header">
                <div id="breadcrumb"> <a href="<?php echo base_url() ?>" title="Dashboard" class="tip-bottom"><i class="icon-asterisk"></i> Dashboard</a> <?php if ($this->uri->segment(1) != null) { ?><a href="<?php echo base_url() . $this->uri->segment(1) ?>" class="tip-bottom" title="<?php echo ucfirst($this->uri->segment(1)); ?>"><?php echo ucfirst($this->uri->segment(1)); ?></a> <?php if ($this->uri->segment(2) != null) { ?><a href="<?php echo base_url() . $this->uri->segment(1) . '/' . $this->uri->segment(2) ?>" class="current tip-bottom" title="<?php echo ucfirst($this->uri->segment(2)); ?>"><?php
                        echo ucfirst($this->uri->segment(2));
                    }
                    ?></a> <?php } ?></div>
            </div>
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span12">
                            <?php if ($this->session->flashdata('error') != null) { ?>
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo $this->session->flashdata('error'); ?>
                            </div>
                            <?php } ?>

                            <?php if ($this->session->flashdata('success') != null) { ?>
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php echo $this->session->flashdata('success'); ?>
                            </div> 
                        <?php } ?>

                        <?php
                        if (isset($view)) {
                            echo $this->load->view($view);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!--Footer-part-->
        <div class="row-fluid">
            <div id="footer" class="span12"> 2015 &copy; Infovix - Informática Vitória</div>
        </div>
        <!--end-Footer-part-->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> 
        <script src="<?php echo base_url(); ?>assets/js/matrix.js"></script> 
		

	
	
<?php
$this->load->helper('cookie');
$cookie = get_cookie('aviso');

 if ($cookie!=1){
	$aviso=1;
$cookie= array(
      'name'   => 'aviso',
      'value'  => 1,
       'expire' => time()+3600*24*1,
  );
  $this->input->set_cookie($cookie);
}else
	$aviso=0;

if ($aviso){
?>
<script type="text/javascript">
 $(document).ready(function() {	

	var id = '#dialog';

	//Get the screen height and width
	var maskHeight = $(document).height();
	var maskWidth = $(window).width();

	//Set heigth and width to mask to fill up the whole screen
	$('#mask').css({'width':maskWidth,'height':maskHeight});
	
	//transition effect		
	$('#mask').fadeIn(1000);	
	$('#mask').fadeTo("slow",0.8);	

	//Get the window height and width
	var winH = $(window).height();
	var winW = $(window).width();
		  
	//Set the popup window to center
	$(id).css('top',  winH/2-$(id).height()/2);
	$(id).css('left', winW/2-$(id).width()/2);

	//transition effect
	$(id).fadeIn(2000); 	
	
	//fade out after delay		
	$('#mask, .window').delay(10000).fadeOut(1000);

//if close button is clicked
$('.window .close').click(function (e) {
	//Cancel the link behavior
	e.preventDefault();
	
	$('#mask').hide();
	$('.window').hide();
});		

//if mask is clicked
$('#mask').click(function () {
	$(this).hide();
	$('.window').hide();
});		

});
</script>
<style type="text/css">     
    #mask
    {
        position: absolute;
        left: 0;
        top: 0;
        z-index: 9000;
        background-color: #000;
        display: none;
    }
    #boxes .window
    {
        position: absolute;
        left: 0;
        top: 0;
        width: 440px;
        height: 200px;
        display: none;
        z-index: 9999;
        padding: 20px;
    }
    #boxes #dialog
    {
        width: 375px;
        height: 203px;
        padding: 10px;
        background-color: #ffffff;
    }
</style>
<!-- Exibe o popup -->
<div id="boxes">
<div style="top: 199.5px; left: 551.5px; display: none; font-size:20px; text-align:center" id="dialog" class="window">
Tenha um ótimo dia de trabalho. <br /><br /><br /><br /><br /><br />
 <a href="#" class="close">Fechar</a>
</div>

<!-- Div que cobre toda a área -->
<div style="width: 1478px; height: 602px; display: none; opacity: 0.8;" id="mask"></div>
<?php }; ?>
		
    </body>
</html>







