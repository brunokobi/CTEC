<?php

function selected($value) {
    if ($value == "1") {
        return 'NORMAL';
    } else {
        return 'URGENTE';
    }
}
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.js"></script>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Editar Chamado</h5>
            </div>
            <div class="widget-content nopadding">


                <div class="span12" id="divChamados" style=" margin-left: 0">
                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Detalhes do Chamado</a></li>
                        <li id="tabAnexos"><a href="#tab4" data-toggle="tab">Anexos</a></li>
                    </ul>
                    <div class="tab-content">
                        <!--Detalhes do Chamado-->
                        <div class="tab-pane active" id="tab1">

                            <div class="span12" id="divCadastrarOs">

                                <form id="formLancamento" action="<?php echo current_url() ?>" method="post">
                                    <input type="hidden" name="chamado" id="chamado" value="<?php echo $result->cd_chamado ?>" /> 

                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <h3>#Protocolo: <?php echo $result->cd_chamado ?></h3>

                                        <div class="span4" style="margin-left: 0">
                                            <label>Assunto</label>
                                            <h4><span><?php echo $result->ds_assunto ?></span></h4>                                          
                                        </div>
                                        <div class="span2">
                                            <label>Data Abertura</label>                                            
                                            <h4><span><?php $dataAbertura = date(('d/m/Y'), strtotime($result->dt_abertura)); echo $dataAbertura
                                                       ?></span></h4>                                           
                                        </div>
                                        <?php  if ($result->st_chamado == 'E') { $dataEnc = date(('d/m/Y'), strtotime($result->dt_encerramento));
                                       echo '<div class="span2">';
                                       echo '     <label>Data Encerramento</label>';                                            
                                       echo '     <h4><span> ' .  $dataEnc . '</span></h4></div>';                                  
                                        }  ?>         
                                        
                                        <div class="span2">
                                            <label>Prioridade</label>
                                            <h4><span><?php echo selected($result->cd_prioridade) ?></span></h4>                                          
                                        </div>                                   
                                        <div class="span2">
                                            <label>Usuário</label>
                                            <h4><span><?php echo $result->nm_usuario ?></span></h4>                                          
                                        </div> 
                                    </div>



                                    <?php
                                    foreach ($lancamentos as $r) {
                                        $dataInicial = date(('d/m/Y'), strtotime($r->dt_lancamento));
                                        echo '<div class="span12" style="padding: 1%; margin-left: 0"> <div class="span12"> <p><strong>' . $dataInicial . ' - ' . $r->nm_usuario . ' </strong><br /> <span> ' . nl2br($r->ds_lancamento) . '</span></p></div> </div>';
                                    }
                                    ?>
<!-- echo '<div class="span12"> <span>' . '<a style="margin-right: 1%" href="'.base_url().'chamados/editar/'.$r->cd_lancamento.'" class="btn btn-info tip-top" title="Editar OS"><i class="icon-pencil icon-white"></i></a>'. '</span></div> '; -->
							            <div class="span12" style="padding: 1%; margin-left: 0"> 
                                        <div id="botoes">
							            <div class="span12  well" style="padding: 1%; margin-left: 0; text-align: center "> 
										   <?php  if ($result->st_chamado == 'A') {
											echo '<div class="span12" style="padding: 1%; margin-left: 0; text-align: right ">';   
                                            echo '<button class="btn btn-info" id="btn-salvar"  >Salvar</button>';
                                            echo '<button class="btn btn-primary" id="btn-encerrar"  >Salvar e Encerrar</button>'; 
											echo '</div>';
                                            echo '<textarea class="span12" name="andamento" id="andamento" cols="30" rows="5"></textarea>';
                                            } ?>
                  
                                        <div class="span6 offset3" style="text-align: center">
                                            <a href="<?php echo base_url() ?>chamados/chamados" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                                        </div>
                                    </div>	
									</div>
								 </div>	
                                </form>
                            </div>

                        </div>

                        <!--Anexos-->
                        <div class="tab-pane" id="tab4">
                            <div class="span12" style="padding: 1%; margin-left: 0">
                                <div class="span12 well" style="padding: 1%; margin-left: 0" id="form-anexos">
                                    <form id="formAnexos" enctype="multipart/form-data" action="javascript:;" accept-charset="utf-8"s method="post">
                                        <div class="span10">
                                            <input type="hidden" name="chamado" id="chamado" value="<?php echo $result->cd_chamado ?>" />
                                            <label for="">Anexo</label>
                                            <input type="file" class="span12" name="userfile[]" multiple="multiple" size="20" />
                                        </div>
                                        <div class="span2">
                                            <label for="">.</label>
                                            <button class="btn btn-success span12"><i class="icon-white icon-plus"></i> Anexar</button>
                                        </div>
                                    </form>
                                </div>

                                <div class="span12" id="divAnexos" style="margin-left: 0">
                                    <?php
                                    $cont = 1;
                                    $flag = 5;
                                    foreach ($anexos as $a) {

                                        if ($a->thumb == null) {
                                            $thumb = base_url() . 'assets/img/icon-file.png';
                                            $link = base_url() . 'assets/img/icon-file.png';
                                        } else {
                                            $thumb = base_url() . 'assets/anexos/thumbs/' . $a->thumb;
                                            $link = $a->url . $a->anexo;
                                        }

                                        if ($cont == $flag) {
                                            echo '<div style="margin-left: 0" class="span3"><a href="#modal-anexo" imagem="' . $a->cd_anexos . '" link="' . $link . '" role="button" class="btn anexo" data-toggle="modal"><img src="' . $thumb . '" alt=""></a></div>';
                                            $flag += 4;
                                        } else {
                                            echo '<div class="span3"><a href="#modal-anexo" imagem="' . $a->cd_anexos . '" link="' . $link . '" role="button" class="btn anexo" data-toggle="modal"><img src="' . $thumb . '" alt=""></a></div>';
                                        }
                                        $cont ++;
                                    }
                                    ?>
                                </div>

                            </div>
                        </div>



                    </div>

                </div>


                .

            </div>

        </div>
    </div>
</div>





<!-- Modal visualizar anexo -->
<div id="modal-anexo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Visualizar Anexo</h3>
    </div>
    <div class="modal-body">
        <div class="span12" id="div-visualizar-anexo" style="text-align: center">
            <div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
        <a href="" id-imagem="" class="btn btn-inverse" id="download">Download</a>
        <a href="" link="" class="btn btn-danger" id="excluir-anexo">Excluir Anexo</a>
    </div>
</div>
  


<script type="text/javascript" src="<?php echo base_url() ?>js/jquery.validate.js"></script>
<script src="<?php echo base_url(); ?>js/maskmoney.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
            $("#btn-salvar").click(function(event) {        
                var dados = $("form#formLancamento").serialize();
                $("#botoes").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>chamados/andamento",
                    data: dados,
                    dataType: 'json',
                    success: function (data)
                    {
                        if (data.result == true) {                            
                           window.location.href = "<?php echo current_url(); ?>";
                        }
                        else {
                            alert('Ocorreu um erro ao tentar adicionar o andamento.');
                        }
                    }
                });
               
                return false;
            }
        );
     
            $("#btn-encerrar").click(function(event) {        
                var dados = $("form#formLancamento").serialize();
                $("#botoes").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>chamados/encerrar",
                    data: dados,
                    dataType: 'json',
                    success: function (data)
                    {
                        if (data.result == true) {                            
                           window.location.href  = "<?php echo current_url(); ?>";
                        }
                        else {
                            alert('Ocorreu um erro ao tentar adicionar o andamento.');
                        }
                    }
                });
               
                return false;
            }
        );
        
        $("#formAnexos").validate({
            submitHandler: function (form) {
                //var dados = $( form ).serialize();
                var dados = new FormData(form);
                $("#form-anexos").hide('1000');
                $("#divAnexos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>chamados/anexar",
                    data: dados,
                    mimeType: "multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'json',
                    success: function (data)
                    {
                        if (data.result == true) {
                            $("#divAnexos").load("<?php echo current_url(); ?> #divAnexos");
                            $("#userfile").val('');

                        }
                        else {
                            $("#divAnexos").html('<div class="alert fade in"><button type="button" class="close" data-dismiss="alert">×</button><strong>Atenção!</strong> ' + data.mensagem + '</div>');
                        }
                    },
                    error: function () {
                        $("#divAnexos").html('<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert">×</button><strong>Atenção!</strong> Ocorreu um erro. Verifique se você anexou o(s) arquivo(s).</div>');
                    }

                });

                $("#form-anexos").show('1000');
                return false;
            }

        });

 

        $(document).on('click', '.anexo', function (event) {
            event.preventDefault();
            var link = $(this).attr('link');
            var id = $(this).attr('imagem');
            var url = '<?php echo base_url(); ?>chamados/excluirAnexo/';
            $("#div-visualizar-anexo").html('<img src="' + link + '" alt="">');
            $("#excluir-anexo").attr('link', url + id);

            $("#download").attr('href', "<?php echo base_url(); ?>chamados/downloadanexo/" + id);

        });

        $(document).on('click', '#excluir-anexo', function (event) {
            event.preventDefault();

            var link = $(this).attr('link');
            $('#modal-anexo').modal('hide');
            $("#divAnexos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");

            $.ajax({
                type: "POST",
                url: link,
                dataType: 'json',
                success: function (data)
                {
                    if (data.result == true) {
                        $("#divAnexos").load("<?php echo current_url(); ?> #divAnexos");
                    }
                    else {
                        alert(data.mensagem);
                    }
                }
            });
        });

            function limpar_campos() {
                $("#descricaoandamento").val("");
            };
            
    });

</script>




