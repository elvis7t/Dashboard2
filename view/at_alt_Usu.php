<?php
//sujeira embaixo do tapete :(
error_reporting(E_ALL & E_NOTICE & E_WARNING);

/*inclusão dos principais itens da página */
session_start();
$sess = "ATIVO";
$pag = "at_usuarios.php";// Fazer o link brilhar quando a pag estiver ativa
require_once("../config/main.php");
require_once("../config/valida.php");
require_once("../config/mnutop.php");
require_once("../config/menu.php");
require_once("../config/modals.php");

?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
			<h1>
						Ativos
				<small>Usu&aacute;rios</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Usu&aacute;rios </li>
				<li class="active">Alterar Dados</li>
			</ol>
        </section>

        <!-- Main content --> 
        <section class="content"> 
			<?php
				$menu = array(
							"P" => array("class" => "btn btn-primary btn-sm", "icone" => "fa fa-history", "id"=>"btn_pesItem","label"=>"Voltar"),
							"R" => array("class" => "btn btn-success btn-sm", "icone" => "fa fa-save", "id"=>"btn_saveItem","label"=>"Salvar"),
							"N" => array("class" => "btn btn-warning btn-sm", "icone" => "fa fa-refresh", "id"=>"btn_Altusu","label"=>"Alterar") 
							);
 				extract($_GET);
 				$rs = new recordset();
 				$sql ="SELECT * FROM at_usuarios a
				JOIN at_empresas b ON a.usu_empId = b.emp_id 
				JOIN at_departamentos c ON a.usu_dpId = c.dp_id 
				WHERE usu_id = ".$usuid;
 				$rs->FreeSql($sql);
 				$rs->GeraDados();
				
				$var = $rs->fld("emp_id");
				$usu = $rs->fld("at_usu_nome");
				$dp_id = $rs->fld("dp_id");
				
 				
			?>
			 <div class="row">
				<div class="col-md-12">
				<!-- general form elements --> 
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Dados</h3><div class="box-tools pull-right">
		                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>   
						</div>
					</div><!-- /.box-header -->
						<!-- form start --> 
						<form role="form" id="alt_emp">
							
							<div class="box-body">
								<!-- radio Clientes -->
								<div id="usuarios" class="row"> 
									<div class="form-group col-md-1">
										<label for="emp_id">#ID:</label>
										<input type="text" DISABLED class="form-control" name="usu_id" id="usu_id" value="<?=$rs->fld("usu_id");?>"/>
										<input type="hidden" value="<?=$_SESSION['token'];?>" name="token" id="token">
										<input type="hidden" value="<?=isset($_GET['lista']) ? $_GET['lista']: 0 ;?>" name="lista" id="lista">
									</div>
									<div class="form-group col-md-4">
										<label for="emp_id">#Empresa:</label>
										<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-building"></i>
										</div>
										<input type="text" DISABLED class="form-control" name="emp_nome" id="emp_nome" value="<?=$rs->fld("emp_nome");?>"/>
										<input type="hidden" value="<?=$_SESSION['token'];?>" name="token" id="token">
										<input type="hidden" value="<?=isset($_GET['lista']) ? $_GET['lista']: 0 ;?>" name="lista" id="lista">
									</div>
									</div>
									
									<div class="form-group col-md-1"><!--Tem que ser antes do selectt --> 
												<label for="usu_ativo">Ativo</label><br>  
												<input type="radio" class="minimal" value=1 <?=($rs->fld("usu_ativo")==1?"CHECKED":"");?> id="usu_ativo" name="usu_ativo"> Ativo<br>
												<input type="radio" class="minimal" value=0 <?=($rs->fld("usu_ativo")==0?"CHECKED":"");?> id="usu_ativo" name="usu_ativo"> Inativo<br>
									</div>
									
									
									<div class="form-group col-md-3">  
										<label for="dp_nome">Selecione o Departamento</label>  
										<div class="input-group">
										<div class="input-group-addon">
											<i class="glyphicon glyphicon-tasks"></i>
											</div> 
											<select class="form-control select2" id="usu_dpId" name="usu_dpId">    
											<option value="">Selecione:</option>
											<?php
												$whr = "dp_empId=".$var;
												$rs->Seleciona("*","at_departamentos",$whr); //É o mesmo que SELECT campos FROM tabela WHERE condição
												 
												while($rs->GeraDados()){ // enquanto gerar dados da pesquisa
												?>
												<option value="<?=$rs->fld("dp_id");?>"<?=($rs->fld("dp_id")==$dp_id?"SELECTED":"");?>> <?=$rs->fld("dp_nome");?></option>      
												<?php
												}  
											?> 
											</select>    
									</div>    
									</div>    
									 <div class="form-group col-md-3">  
										<label for="usu_nome">Usu&aacute;rio</label>
											<div class="input-group">
										<div class="input-group-addon">  
											<i class="fa fa-user"></i>
										</div>
										<input type="text"  class="form-control" name="usu_nome" id="usu_nome" value="<?=$usu?>"/> 
									</div>
									</div>
										
								</div> 
								
								<div id="consulta"></div>
								<div id="formerrosusu1" class="clearfix" style="display:none;">
									<div class="callout callout-danger"> 
										<h4>Erros no preenchimento do formul&aacute;rio.</h4>
										<p>Verifique os erros no preenchimento acima:</p>
										<ol>
											<!-- Erros são colocados aqui pelo validade -->
										</ol> 
									</div>
								</div>
							</div> 
							
							<div class="box-footer">
								<button class="<?=$menu[$acao]['class'];?>" type="button" id="<?=$menu[$acao]['id'];?>"><i class="<?=$menu[$acao]['icone'];?>"></i> <?=$menu[$acao]['label'];?></button>
								<a href="javascript:history.go(-1);" class="btn btn-sm btn-danger"><i class="fa fa-hand-o-left"></i> Cancela </a>
							</div>
							<div id="mens"></div>
						</form>
					</div><!-- ./box -->  
						<!-- general form elements -->
				<div class="box box-success ">
					<div class="box-header with-border">
						<h3 class="box-title">Historico de Solicita&ccedil;&atilde;o</h3><div class="box-tools pull-right"> 
		                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-ninus"></i></button>   
						</div>
					</div><!-- /.box-header -->
					<!-- form start -->
					<div class="box-body">
						<table id="manutencao" class="table table-bordered table-striped">
							<thead>
								    <tr>
										<th>C&oacute;d:</th>
										<th>Equipamento</th> 
										<th>Motivo</th> 
										<th>Data:</th> 
										<th>Cadastrado por:</th> 
										<th>Chamado N&ordm;:</th> 
										<th>A&ccedil;&atilde;o</th>
										 
										
								  </tr>
							</thead>
							<tbody id="Man_cad">  
							<?php require_once("at_tbSolic.php");?>    	
							</tbody> 
							 
						</table>
					</div><!-- /.box-body --> 
								
              </div><!-- /.box -->
					
				</div><!-- ./row -->
				
					
				
				
			</div>
		</section>
	</div>
 <?php 
        require_once("../config/footer.php");
        //require_once("../config/side.php"); 
      ?>
      <div class="control-sidebar-bg"></div>
 
    </div><!-- ./wrapper --> 

    <!-- jQuery 2.1.4 --> 
    <script src="https://infraprime.000webhostapp.com/dashboard/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="https://infraprime.000webhostapp.com/dashboard/assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="https://infraprime.000webhostapp.com/dashboard/assets/plugins/fastclick/fastclick.min.js"></script>
    <!--AdminLTE App -->
    <script src="https://infraprime.000webhostapp.com/dashboard/assets/dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="https://infraprime.000webhostapp.com/dashboard/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="https://infraprime.000webhostapp.com/dashboard/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="https://infraprime.000webhostapp.com/dashboard/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="https://infraprime.000webhostapp.com/dashboard/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<script src="https://infraprime.000webhostapp.com/dashboard/assets/js/maskinput.js"></script>
    <script src="https://infraprime.000webhostapp.com/dashboard/assets/js/jmask.js"></script>
	<!--datatables-->
    <script src="https://infraprime.000webhostapp.com/dashboard/assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="https://infraprime.000webhostapp.com/dashboard/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    
     <!-- ChartJS 1.0.1-->
    <script src="https://infraprime.000webhostapp.com/dashboard/assets/plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) 
    <script src="https://infraprime.000webhostapp.com/dashboard/assets/dist/js/pages/dashboard2.js"></script>-->
    <!-- AdminLTE for demo purposes -->
    <script src="https://infraprime.000webhostapp.com/dashboard/assets/dist/js/demo.js"></script>
	<script src="https://infraprime.000webhostapp.com/dashboard/js/action_ativos.js"></script>  <!--Chama o java script -->
	<script src="https://infraprime.000webhostapp.com/dashboard/js/functions.js"></script>  <!--Chama o java script para excluir -->
	<script src="https://infraprime.000webhostapp.com/dashboard/js/controle.js"></script>  <!--Chama o java script para mascara -->
	<!-- Validation --> 
	<!-- SELECT2 TO FORMS --> 

	<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

	<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script>
	/*------------------------|INICIA TOOLTIPS E POPOVERS|---------------------------------------*/
	$(document).ready(function () {
		$(".select2").select2({
			tags: true,
			theme: "classic"
		});
	});
</script>
<script>
		$(".select2").select2({
			tags: true,
			theme: "classic"
		});

		$(function () {
			$('#manutencao').DataTable({
		"columnDefs": [{
		"defaultContent": "-",
		"targets": "_all"
	}],
	language :{
	    "sEmptyTable": "Nenhum registro encontrado",
	    "sInfo": "Mostrando de _START_ at&eacute; _END_ de _TOTAL_ registros",  
	    "sInfoEmpty": "Mostrando 0 at&eacute; 0 de 0 registros",
	    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
	    "sInfoPostFix": "",
	    "sInfoThousands": ".",
	    "sLengthMenu": "_MENU_ resultados por p&aacute;gina",
	    "sLoadingRecords": "Carregando...",
	    "sProcessing": "Processando...",
	    "sZeroRecords": "Nenhum registro encontrado",
	    "sSearch": "Pesquisar",
	    "oPaginate": {
	        "sNext": "Pr&oacute;ximo",
	        "sPrevious": "Anterior", 
	        "sFirst": "Primeiro",
	        "sLast": "&Uacute;ltimo"   
	    },
	    "oAria": {
	        "sSortAscending": ": Ordenar colunas de forma ascendente",
	        "sSortDescending": ": Ordenar colunas de forma descendente"
	    }
	}
	});
		});
	
		
	</script>
</body>
</html>	