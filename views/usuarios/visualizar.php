<?php
function SitUsuario($value) {
    if ($value == "1") {
    return  'ATIVO';
    }else{
    return  'INATIVO';
    }
}

function TipoUsuario($value) {
    if ($value == "1") {
    return  'USUÁRIO';
    }else{
    return  'SUPORTE';
    }
}
?>

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
                                        <td><?php echo $result->nm_usuario ?></td>
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
                                <span class="icon"><i class="icon-list"></i></span><h5>Outras Informações</h5>
                            </a>
                        </div>
                    </div>
                    <div class="collapse accordion-body" id="collapseGTwo">
                        <div class="widget-content">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Empresa</strong></td>
                                        <td><?php echo $result->ds_empresa ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Login</strong></td>
                                        <td><?php echo $result->login ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Tipo Usuário</strong></td>
                                        <td><?php echo TipoUsuario($result->tp_usuario) ?></td>
                                    </tr>
                                    <tr>
                                        <td style="text-align: right; width: 30%"><strong>Situação</strong></td>
                                        <td><?php echo SitUsuario($result->st_usuario)  ?></td>                                        
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
