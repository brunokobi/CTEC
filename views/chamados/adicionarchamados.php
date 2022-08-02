<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.validate.js"></script>
<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-tags"></i>
                </span>
                <h5>Abertura de Chamado</h5>
            </div>
            <div class="widget-content nopadding">
                <div class="span12" id="divProdutosServicos" style=" margin-left: 0">
                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Detalhes do Chamado</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">

                            <div class="span12" id="divCadastrarOs">
                                <?php if($custom_error == true){ ?>
                                <div class="span12 alert alert-danger" id="divInfo" style="padding: 1%;">Dados incompletos, verifique os campos com asterisco.</div>
                                <?php } ?>
                                <form action="<?php echo current_url(); ?>" method="post" id="formChamado">
                                    <div class="span12" style="padding: 1%">
                                        <div class="span9">
                                            <label for="assunto">Assunto<span class="required">*</span></label>
                                            <input id="assunto" class="span12" type="text" name="assunto" value="<?php echo set_value('assunto'); ?>"  />
                                        </div>

                                        
                                        <div class="span3">
                                            <label for="prioridade">Prioridade<span class="required">*</span></label>
                                            <select class="span12" name="prioridade" id="status" value="">
                                                <option value="1">Normal</option>
                                                <option value="0">Urgente</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span12">
                                            <label for="descricaochamado">Detalhes do chamado</label>
                                            <textarea class="span12" name="descricaochamado" id="descricaoProduto" cols="30" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <div class="span6 offset3" style="text-align: center">
                                            <button class="btn btn-success" id="btnContinuar"><i class="icon-share-alt icon-white"></i> Abrir Chamado</button>
                                            <a href="<?php echo base_url() ?>chamados" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
       
.                
       </div>
    </div>
</div>
</div>



<script type="text/javascript">
$(document).ready(function(){

      $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteCliente",
            minLength: 1,
            select: function( event, ui ) {
                 $("#clientes_id").val(ui.item.id);
            }
      });

      $("#tecnico").autocomplete({
            source: "<?php echo base_url(); ?>index.php/os/autoCompleteUsuario",
            minLength: 1,
            select: function( event, ui ) {
                 $("#usuarios_id").val(ui.item.id);
            }
      });

      $("#formOs").validate({
          rules:{
             cliente: {required:true},
             tecnico: {required:true},
             dataInicial: {required:true}
          },
          messages:{
             cliente: {required: 'Campo Requerido.'},
             tecnico: {required: 'Campo Requerido.'},
             dataInicial: {required: 'Campo Requerido.'}
          },

            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
       });
    $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
});

</script>

