<?php

function selected($value) {
    if ($value == "1") {
        return 'NORMAL';
    } else {
        return 'URGENTE';
    }
}
?>

<?php
if ($this->uri->segment(2) == 'abertos') {
    echo '<a href="'. base_url().'chamados/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Chamado</a>';
}
?>

<?php if (!$results) { ?>
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-tags"></i>
            </span>
            <h5>Chamados</h5>

        </div>

        <div class="widget-content nopadding">


            <table class="table table-bordered ">
                <thead>
                    <tr style="backgroud-color: #2D335B">
                        <th>#</th>
                        <th>Assunto</th>
                        <th>Data Abertura</th>
                        <th>Usuário</th>
                        <?php
                        if ($this->uri->segment(2) == 'encerrados') {
                            echo '<th>Encerramento</th>';
                        }
                        ?>                        
                        <th>Prioridade</th>
                        <th>Empresa</th> 
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="8">Nenhum Chamado Cadastrada</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php } else { ?>


    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-tags"></i>
            </span>
            <h5>Chamados</h5>

        </div>

        <div class="widget-content nopadding">


            <table class="table table-bordered ">
                <thead>
                    <tr style="backgroud-color: #2D335B">
                        <th>#</th>
                        <th>Assunto</th>
                        <th>Data Abertura</th>
                        <th>Usuário</th>
                        <?php
                        if ($this->uri->segment(2) == 'encerrados') {
                            echo '<th>Encerramento</th>';
                        }
                        ?>                          
                        <th>Prioridade</th>
                        <th>Empresa</th> 
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($results as $r) {
                        $dataInicial = date(('d/m/Y'), strtotime($r->dt_abertura));
                        $dataFinal = date(('d/m/Y'), strtotime($r->dt_encerramento));
                        echo '<tr>';
                        echo '<td>' . $r->cd_chamado . '</td>';
                        echo '<td>' . $r->ds_assunto . '</td>';
                        echo '<td>' . $dataInicial . '</td>';
                        echo '<td>' . $r->nm_usuario . '</td>';

                        if ($this->uri->segment(2) == 'encerrados') {
                            echo '<td>' . $dataFinal . '</td>';
                        }

                        echo '<td>' . selected($r->cd_prioridade) . '</td>';
                        echo '<td>'.$r->ds_empresa.'</td>'; 

                        echo '<td>';
                        echo '<a style="margin-right: 1%" href="' . base_url() . 'chamados/editar/' . $r->cd_chamado . '" class="btn btn-info tip-top" title="Editar Chamado"><i class="icon-pencil icon-white"></i></a>';
                        echo '<a href="#modal-excluir" role="button" data-toggle="modal" os="' . $r->cd_chamado . '" class="btn btn-danger tip-top" title="Excluir Chamado"><i class="icon-remove icon-white"></i></a>  ';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                    <tr>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <?php echo $this->pagination->create_links();
}
?>


<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo base_url() ?>chamados/excluir" method="post" >
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Excluir Chamado</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" id="idChamado" name="id" value="" />
            <h5 style="text-align: center">Deseja realmente excluir este chamado?</h5>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
            <button class="btn btn-danger">Excluir</button>
        </div>
    </form>
</div>






<script type="text/javascript">
    $(document).ready(function () {


        $(document).on('click', 'a', function (event) {

            var os = $(this).attr('os');
            $('#idChamado').val(os);

        });

    });

</script>