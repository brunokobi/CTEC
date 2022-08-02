  <?php

function selected($value) {
    if ($value == "1") {
        return 'NORMAL';
    } else {
        return 'URGENTE';
    }
}
?>



  <head>
    <title>Ctec</title>
    <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/blue.css" class="skin-color" />
    <script type="text/javascript"  src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
 
  <body style="background-color: transparent">

      <div class="container-fluid">
    
          <div class="row-fluid">
              <div class="span12">

                  <div class="widget-box">
                      <div class="widget-title">
                          <h4 style="text-align: center">Chamados</h4>
                      </div>
                      <div class="widget-content nopadding">

                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th style="font-size: 1.2em; padding: 5px;">#</th>
                              <th style="font-size: 1.2em; padding: 5px;">Assunto</th>
                              <th style="font-size: 1.2em; padding: 5px;">Data Abertura</th>
                              <th style="font-size: 1.2em; padding: 5px;">Usuário</th>
                              <th style="font-size: 1.2em; padding: 5px;">Encerramento</th>
							  <th style="font-size: 1.2em; padding: 5px;">Prioridade</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          foreach ($results as $c) {
                              $dataCadastro = date('d/m/Y', strtotime($c->dt_abertura));
							  if ($c->dt_encerramento ) {$dataFim = date('d/m/Y', strtotime($c->dt_encerramento));} else {$dataFim = null;}
                              echo '<tr>';
                              echo '<td>' . $c->cd_chamado . '</td>';
                              echo '<td>' . $c->ds_assunto . '</td>';
                              echo '<td>' . $dataCadastro . '</td>';
                              echo '<td>' . $c->nm_usuario . '</td>';
                              echo '<td>' . $dataFim . '</td>';
							  echo '<td>' . selected($c->cd_prioridade) . '</td>';
                              echo '</tr>';
                          }
                          ?>
                      </tbody>
                  </table>
                  
                  </div>
                   
              </div>
                  <h5 style="text-align: right">Data do Relatório: <?php echo date('d/m/Y');?></h5>

          </div>
     


      </div>
</div>


  </body>
</html>







