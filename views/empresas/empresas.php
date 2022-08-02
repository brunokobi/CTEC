<a href="<?php echo base_url(); ?>empresas/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Empresa</a>    

<?php if (!$results) { ?>

    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-user"></i>
            </span>
            <h5>Empresas</h5>

        </div>

        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Telefone</th>                      
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Nenhum Empresa Cadastrado</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php } else {
    ?>
    <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-user"></i>
            </span>
            <h5>Empresas</h5>

        </div>

        <div class="widget-content nopadding">


            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
    <?php
    foreach ($results as $r) {
        echo '<tr>';
        echo '<td>' . $r->cd_empresa  . '</td>';
        echo '<td>' . $r->ds_empresa  . '</td>';       
        echo '<td>' . $r->ds_telefone . '</td>';
        echo '<td>';
        echo '<a href="' . base_url() . 'empresas/visualizar/' . $r->cd_empresa . '" style="margin-right: 1%" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>';
        echo '<a href="' . base_url() . 'empresas/editar/' . $r->cd_empresa . '" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Empresa"><i class="icon-pencil icon-white"></i></a>';
        echo '<a href="#modal-excluir" role="button" data-toggle="modal" empresa="' . $r->cd_empresa . '" style="margin-right: 1%" class="btn btn-danger tip-top" title="Excluir Empresa"><i class="icon-remove icon-white"></i></a>';
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
} ?>




<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo base_url() ?>empresas/excluir" method="post" >
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h5 id="myModalLabel">Excluir Empresa</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" id="idEmpresa" name="id" value="" />
            <h5 style="text-align: center">Deseja realmente excluir esta empresa?</h5>
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

            var empresa = $(this).attr('empresa');
            $('#idEmpresa').val(empresa);

        });

    });

</script>
