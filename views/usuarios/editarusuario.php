<?php
function selected($value, $selected) {
    return $value == $selected ? ' selected="selected"' : NULL;
}
?>

<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Editar de Usuários</h5>
            </div>
            <div class="widget-content nopadding">
                <?php
                if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                }
                ?>
                <form action="<?php echo current_url(); ?>" id="formUsuario" method="post" class="form-horizontal" >
                    <div class="span12" style="padding: 1%">
                        <div class="span8">
                            <?php echo form_hidden('cd_usuario', $result->cd_usuario) ?>
                            <label for="usuario">Nome<span class="required">*</span></label>                       
                            <input id="usuario" class="span12" type="text" name="usuario" value="<?php echo $result->nm_usuario; ?>"  />
                        </div>
                        
                        <div class="span4">
                            <label for="login">Login<span class="required">*</span></label>
                            <input id="login" class="span12" type="text" name="login"  value="<?php echo $result->login; ?>"/>                            
                        </div>                        
                    </div>	

                    <div class="span12" style="padding: 1%; margin-left: 0">
                        <div class="span12">
                            <label for="nomeEmpresa">Empresa<span class="required">*</span></label>
                            <input id="nomeEmpresa" class="span12" type="text" name="nomeEmpresa" value="<?php echo $result->ds_empresa; ?>"  disabled/>
                            <?php echo form_hidden('empresa', $result->cd_empresa) ?>
                        </div>
                    </div>

                    <div class="span12" style="padding: 1%; margin-left: 0">
                        <div class="span6">
                            <label for="tipo" >Tipo Usuário<span class="required">*</span></label>
                            <select name="tipo" id="tipo" class="span12">
                                <option value=""></option>
                                <option value="1" <?php echo selected(1, $result->tp_usuario); ?> >USUÁRIO</option>
                                <option value="0" <?php echo selected(0, $result->tp_usuario); ?> >SUPORTE</option>
                            </select>                          
                        </div>  

                        <div class="span6">
                            <label for="situacao" >Situação<span class="required">*</span></label>
                            <select name="situacao" id="situacao" class="span12">
                                <option value=""></option>
                                <option value="1" <?php echo selected(1, $result->st_usuario); ?> >ATIVO</option>
                                <option value="0" <?php echo selected(0, $result->st_usuario); ?> >INATIVO</option>
                            </select>                      
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Alterar</button>
                                <a href="<?php echo base_url() ?>usuarios" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="<?php echo base_url() ?>js/jquery.validate.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#formUsuario').validate({
            rules: {
                Usuario: {required: true}
            },
            messages: {
                Usuario: {required: 'Campo Requerido.'}

            },
            errorClass: "help-inline",
            errorElement: "span",
            highlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
        });
    });
</script>




