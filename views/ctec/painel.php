<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/dist/excanvas.min.js"></script><![endif]-->

<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/dist/jquery.jqplot.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/dist/jquery.jqplot.min.css" />

<script type="text/javascript" src="<?php echo base_url();?>js/dist/plugins/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/dist/plugins/jqplot.donutRenderer.min.js"></script>

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
            <li class="bg_ly"> <a href="<?php echo base_url()?>chamados/abertos"> <i class="icon-wrench"></i> Chamados em Abertos</a> </li>
      </ul>
      <ul class="quick-actions">
            <li class="bg_lv"> <a href="<?php echo base_url()?>chamados/encerrados"> <i class="icon-ok-sign"></i> Chamados Encerrados</a> </li>
      </ul>	  
      <ul class="quick-actions">
            <li class="bg_lg"> <a href="<?php echo base_url()?>chamados/adicionar"> <i class="icon-plus"></i> Novo Chamado</a> </li>
      </ul>		  
    </div>
  </div>  
<!--End-Action boxes-->  


<div class="row-fluid" >

    <div class="span6">
        
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Total Chamados - Abertos e Encerrados</h5></div>
            <div class="widget-content">
                <div class="row-fluid">
                    <div class="span12">
                      <div id="chart-financeiro" style=""></div>
                    </div>
            
                </div>
            </div>
        </div>
    </div>

    <div class="span6">
        
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Chamados por Usuários</h5></div>
            <div class="widget-content">
                <div class="row-fluid">
                    <div class="span12">
                      <div id="chart-financeiro2" style=""></div>
                    </div>
            
                </div>
            </div>
        </div>
    </div>

</div>


<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>

<?php if($estatisticas != null && $estatisticasusuarios != '[]') {
?>
<script type="text/javascript">
    
    $(document).ready(function(){

      var data2 = [['Chamados Abertos',<?php echo ($estatisticas->aberto != null ) ?  $estatisticas->aberto : 0; ?>],['Chamados Encerrados', <?php echo ($estatisticas->encerrado != null ) ?  $estatisticas->encerrado : 0; ?>]];
      var plot2 = jQuery.jqplot ('chart-financeiro', [data2], 
        {  

          seriesColors: [ "#9ACD32", "#FF8C00", "#EAA228", "#579575", "#839557", "#958c12","#953579", "#4b5de4", "#d8b83f", "#ff5800", "#0085cc"],   
          seriesDefaults: {
            // Make this a pie chart.
            renderer: jQuery.jqplot.PieRenderer, 
            rendererOptions: {
              // Put data labels on the pie slices.
              // By default, labels show the percentage of the slice.
              dataLabels: 'value',
              showDataLabels: true
            }
          }, 
          legend: { show:true, location: 'e' }
        }
      );
      

      var data3 = <?php echo $estatisticasusuarios?>;
      var plot3 = jQuery.jqplot ('chart-financeiro2', [data3], 
        {  

          seriesColors: [ "#90EE90", "#FF0000", "#EAA228", "#579575", "#839557", "#958c12","#953579", "#4b5de4", "#d8b83f", "#ff5800", "#0085cc"],   
          seriesDefaults: {
            // Make this a pie chart.
            renderer: jQuery.jqplot.PieRenderer, 
            rendererOptions: {
              // Put data labels on the pie slices.
              // By default, labels show the percentage of the slice.
              dataLabels: 'value',
              showDataLabels: true
            }
          }, 
          legend: { show:true, location: 'e' }
        }
        ); 
    });
 
</script>

<?php  } ?>