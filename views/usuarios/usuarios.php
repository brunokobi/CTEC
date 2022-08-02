<?php
function selected($value) {
    if ($value == "1") {
    return  'ATIVO';
    }else{
    return  'INATIVO';
    }
}
?>

<a href="<?php echo base_url();?>usuarios/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Usuário</a>    

<?php
if(!$results){?>

        <div class="widget-box">
        <div class="widget-title">
            <span class="icon">
                <i class="icon-user"></i>
            </span>
            <h5>Usuários</h5>

        </div>

        <div class="widget-content nopadding">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Login</th>
                        <th>Empresa</th>
                        <th>Situação</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5">Nenhum Usuário Cadastrado</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

<?php }else{
	

?>
<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-user"></i>
         </span>
        <h5>Usuários</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Login</th>
                        <th>Empresa</th>
                        <th>Situação</th>
                        <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
            echo '<tr>';
            echo '<td>'.$r->cd_usuario.'</td>';
            echo '<td>'.$r->nm_usuario.'</td>';
            echo '<td>'.$r->login.'</td>';
            echo '<td>'.$r->ds_empresa.'</td>'; 
            echo '<td>' . selected($r->st_usuario) .'</td>';             
            echo '<td>';
            echo '<a href="'.base_url().'usuarios/visualizar/'.$r->cd_usuario.'" style="margin-right: 1%" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>'; 
            echo '<a href="'.base_url().'usuarios/editar/'.$r->cd_usuario.'" style="margin-right: 1%" class="btn btn-info tip-top" title="Editar Usuário"><i class="icon-pencil icon-white"></i></a>'; 
            echo '<a href="#modal-excluir" role="button" data-toggle="modal" usuario="'.$r->cd_usuario.'" style="margin-right: 1%" class="btn btn-danger tip-top" title="Excluir Usuário"><i class="icon-remove icon-white"></i></a>'; 
            echo '</td>';
            echo '</tr>';
        }?>
        <tr>
            
        </tr>
    </tbody>
</table>
</div>
</div>
<?php echo $this->pagination->create_links();}?>



 
<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>usuarios/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Usuário</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idUsuario" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir este usuário?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Excluir</button>
  </div>
  </form>
</div>






<script type="text/javascript">
$(document).ready(function(){


   $(document).on('click', 'a', function(event) {
        
        var usuario = $(this).attr('usuario');
        $('#idUsuario').val(usuario);

    });

});

</script>
