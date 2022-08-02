<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-user"></i>
                </span>
                <h5>Editar Empresa</h5>
            </div>
            <div class="widget-content nopadding">
                <?php  if ($custom_error != '') {
                    echo '<div class="alert alert-danger">' . $custom_error . '</div>';
                }
                ?>
                <form action="<?php echo current_url(); ?>" id="formEmpresa" method="post" class="form-horizontal" >
                    <div class="span12" style="padding: 1%">
                        <div class="span8">
                            <?php echo form_hidden('cd_empresa', $result->cd_empresa) ?>
                            <label for="nomeCliente">Nome<span class="required">*</span></label>                       
                            <input id="nomeCliente" class="span12" type="text" name="nomeEmpresa" value="<?php echo $result->ds_empresa; ?>"  />
                        </div>
                        <div class="span4">
                            <label for="documento">CNPJ<span class="required">*</span></label>
                            <input id="documento" class="span12" type="text" name="documento" value="<?php echo $result->nr_cnpj; ?>"  />
                        </div>
                    </div>	
                    <div class="span12" style="padding: 1%; margin-left: 0">
                        <div class="span3">
                            <label for="telefone">Telefone<span class="required">*</span></label>
                            <input id="telefone" class="span12" type="text" name="telefone" value="<?php echo $result->ds_telefone; ?>"  />
                        </div>
                        <div class="span3">
                            <label for="celular" >Celular</label>
                            <input id="celular" class="span12" type="text" name="celular" value="<?php echo $result->ds_telefone2; ?>"  />
                        </div>
                        <div class="span6">
                            <label for="email" >Email<span class="required">*</span></label>
                            <input id="email" class="span12" type="text" name="email" value="<?php echo $result->ds_email; ?>"  />
                        </div>
                    </div>

                    <div class="span12" style="padding: 1%; margin-left: 0">
                        <div class="span3">
                            <label for="cep">CEP<span class="required">*</span></label>
                            <input id="cep" class="span12" type="text" name="cep" value="<?php echo $result->cep; ?>"  />
                        </div>
                        <div class="span7">
                            <label for="rua">Rua<span class="required">*</span></label>
                            <input id="rua" class="span12" type="text" name="rua" value="<?php echo $result->ds_logradouro; ?>"  />
                        </div>

                        <div class="span2">
                            <label for="numero" >Número<span class="required">*</span></label>
                            <input id="numero" class="span12" type="text" name="numero" value="<?php echo $result->numero; ?>"  />
                        </div>
                    </div>

                    <div class="span12" style="padding: 1%; margin-left: 0">
                        <div class="span5">
                            <label for="bairro" >Bairro<span class="required">*</span></label>
                            <input id="bairro" class="span12" type="text" name="bairro" value="<?php echo $result->ds_bairro; ?>"  /> 
                        </div>  

                        <div class="span5">
                            <label for="cidade" >Cidade<span class="required">*</span></label>
                            <input id="cidade" class="span12" type="text" name="cidade" value="<?php echo $result->ds_cidade; ?>"  />
                        </div>

                        <div class="span2">
                            <label for="estado">Estado<span class="required">*</span></label>
                            <input id="estado" class="span12" type="text" name="estado" value="<?php echo $result->ds_estado; ?>"  />
                        </div>
                    </div>

                    <div class="form-actions">
                        <div class="span12">
                            <div class="span6 offset3">
                                <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i> Alterar</button>
                                <a href="<?php echo base_url() ?>empresas" id="" class="btn"><i class="icon-arrow-left"></i> Voltar</a>
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
        $('#formEmpresa').validate({
            rules: {
                nomeEmpresa: {required: true}
            },
            messages: {
                nomeEmpresa: {required: 'Campo Requerido.'}

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

