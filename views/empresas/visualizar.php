<div class="widget-box">
    <div class="widget-title">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Dados da Empresa</a></li>
        </ul>
    </div>
    <div class="widget-content tab-content">
        <div id="tab1" class="tab-pane active" style="min-height: 300px">
            <div class="accordion" id="collapse-group">
                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                                <span class="icon"><i class="icon-list"></i></span><h5>Informações</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse in accordion-body" id="collapseGOne">
                        <div class="widget-content">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Nome</strong></td>
                                        <td><?php echo $result->ds_empresa ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGTwo" data-toggle="collapse">
                                <span class="icon"><i class="icon-list"></i></span><h5>Contatos</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGTwo">
                        <div class="widget-content">
                            <table class="table table-bordered">
                                <tbody>
                                     <tr>
                                        <td style="text-align: right; width: 30%"><strong>Telefone</strong></td>
                                        <td><?php echo $result->ds_telefone ?></td>
                                     </tr>   
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Telefone 2</strong></td>
                                        <td><?php echo $result->ds_telefone2 ?></td>
                                    </tr> 
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Email</strong></td>
                                        <td><?php echo $result->ds_email ?></td>
                                    </tr>                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="accordion-group widget-box">
                    <div class="accordion-heading">
                        <div class="widget-title">
                            <a data-parent="#collapse-group" href="#collapseGThree" data-toggle="collapse">
                                <span class="icon"><i class="icon-list"></i></span><h5>Endereço</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGThree">
                        <div class="widget-content">
                            <table class="table table-bordered">
                                <tbody>
                                     <tr>
                                        <td style="text-align: right; width: 30%"><strong>Cep</strong></td>
                                        <td><?php echo $result->cep ?></td>
                                     </tr>   
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Rua</strong></td>
                                        <td><?php echo $result->ds_logradouro ?></td>
                                    </tr> 
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Numero</strong></td>
                                        <td><?php echo $result->numero ?></td>
                                    </tr>  
                                     <tr>
                                        <td style="text-align: right; width: 30%"><strong>Bairro</strong></td>
                                        <td><?php echo $result->ds_bairro ?></td>
                                     </tr>   
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Cidade</strong></td>
                                        <td><?php echo $result->ds_cidade ?></td>
                                    </tr> 
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Estado</strong></td>
                                        <td><?php echo $result->ds_estado ?></td>
                                    </tr>                                     
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
