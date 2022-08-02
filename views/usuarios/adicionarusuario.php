<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Cadastro de Usuários</h5>
            </div>
            <div class="widget-content nopadding">
                <?php
                if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                }
                ?>
                <form action="<?php echo current_url(); ?>" id="formUsuario" method="post" class="form-horizontal" >
                    <div class="span12" style="padding: 1%">
                        <div class="span12">
                            <label for="usuario">Nome<span class="required">*</span></label>                       
                            <input id="usuario" class="span12" type="text" name="usuario" value="<?php echo set_value('usuario'); ?>"  />
                        </div>
                    </div>	

                    <div class="span12" style="padding: 1%; margin-left: 0">
                        <div class="span12">
                            <label for="empresa">Empresa<span class="required">*</span></label>
                            <select name="empresa" id="empresa" class="span12">
                                <option value=""></option>
                                <?php foreach ($empresas as $empresa): ?>
                                    <option value="<?php echo $empresa->cd_empresa; ?>" > <?php echo $empresa->ds_empresa;?></option>
                                <?php endforeach; ?>
                            </select>                         
                        </div>
                    </div>

                    <div class="span12" style="padding: 1%; margin-left: 0">
                        <div class="span7">
                            <label for="login">Login<span class="required">*</span></label>
                            <input id="login" class="span12" type="text" name="login" value="<?php echo set_value('login'); ?>"  />
                        </div>

                        <div class="span5">
                            <label for="senha" >Senha<span class="required">*</span></label>
                            <input id="senha" class="span12" type="text" name="senha" value="<?php echo set_value('senha'); ?>"  />
                        </div>
                    </div>

                    <div class="span12" style="padding: 1%; margin-left: 0">
                        <div class="span6">
                            <label for="tipo" >Tipo Usuário<span class="required">*</span></label>
                            <select name="tipo" id="tipo" class="span12">
                                <option value=""></option>
                                <option value="1">USUÁRIO</option>
                                <option value="0">SUPORTE</option>
                            </select>                          
                        </div>  

                        <div class="span6">
                            <label for="situacao" >Situação<span class="required">*</span></label>
                            <select name="situacao" id="situacao" class="span12">
                                <option value=""></option>
                                <option value="1">ATIVO</option>
                                <option value="0">INATIVO</option>
                            </select>                      
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar</button>
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




