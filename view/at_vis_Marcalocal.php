<?php
//sujeira embaixo do tapete :(
error_reporting(E_ALL & E_NOTICE & E_WARNING);

/*inclusão dos principais itens da página */
session_start();
$sess = "ATIVOLOCAL";
$pag = "at_eqmarcalocal.php";// Fazer o link brilhar quando a pag estiver ativa
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
						Ativos Locais
				<small>Marcas</small>
			</h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Cadastro de Marca</li>
			</ol>
        </section>
        <!-- Main content -->
        <section class="content"> 
			<?php
				
 				$rs = new recordset();
				$sql ="SELECT * FROM at_empresas 
					WHERE  emp_id=".$_SESSION['usu_empresa'];
					$rs->FreeSql($sql);
					$rs->GeraDados();
					 
				
			?> 
			<!-- Info boxes -->
			<div class="row">
				<!-- left column -->
				<div class="col-md-12">
				<!-- general form elements -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Cadastro de Departamento</h3><div class="box-tools pull-right">
		                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>   
						</div>
						</div><!-- /.box-header -->
						<!-- form start -->
						<form id="marca" role="form">
						<div class="box-body">
								<div class="row">
									<div class="form-group col-xs-6 col-sm-4 col-md-4"> 
										<label for="sel_emptp">Empresa</label><br>
										<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-building"></i> 
										</div>
										<input  type="text" DISABLED class="form-control" id="" name="" value="<?=$rs->fld("emp_nome");?>"> 
										<input type="hidden" value="<?=$rs->fld("emp_id");?>" id="sel_emptp" name="sel_emptp">
									</div>
									</div>
										<div class="form-group col-xs-6 col-sm-4 col-md-4">   
										<label for="sel_tipoId">Tipo</label><br>
										<div class="input-group">
										<div class="input-group-addon">
											<i class="glyphicon glyphicon-print"></i>
										</div>
										<select class="select2 form-control" class="form-control" id="sel_tipoId" name="sel_tipoId">
											<option value="">Selecione...</option> 
											 <?php
												$whr = "tipo_empId =".$_SESSION['usu_empresa'];
												$rs->Seleciona("*","eq_tipo",$whr); //É o mesmo que SELECT campos FROM tabela WHERE condição
												while($rs->GeraDados()){ // enquanto gerar dados da pesquisa
												?>
												<option value="<?=$rs->fld("tipo_id");?>"><?=$rs->fld("tipo_desc");?></option>
												<?php 
												} 
											?> 
										</select>   
									</div>    
									</div>    
									<div class="form-group col-md-3">
										<label for="marc_nome">Descri&ccedil;&acirc;o</label> 
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-android"></i>
											</div>
										<input type="text" class="form-control" id="marc_nome" name="marc_nome"  placeholder="Desc. da Marca">
									</div>
									</div>
								</div>  
								
								<div id="formerrosMarca" class="clearfix" style="display:none;"> 
									<div class="callout callout-danger">
										<h4>Erros no preenchimento do formul&aacute;rio.</h4>
										<p>Verifique os erros no preenchimento acima:</p>
										<ol>
											<!-- Erros são colocados aqui pelo validade -->
										</ol>
									</div>
								</div>
							</div><!-- /.box-body -->
							<div class="box-footer">  
								<button type="button" id="btn_cadMarca" class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Salvar</button>
							</div>
							<div id="mens"></div>
						</form>
					</div><!-- /.box -->
				<!-- general form elements --> 
				<div class="box box-success"> 
					<div class="box-header with-border">
						<h3 class="box-title">Marcas Cadastradas</h3><div class="box-tools pull-right">
		                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>   
						</div> 
					</div><!-- /.box-header -->
					<!-- form start -->
					<div class="box-body">
						<table id="MQmarca" class="table table-bordered table-striped">
							<thead>
								  <tr>
										<th>C&oacute;d:</th>
										<th>Empresa</th> 
										<th>Tipo</th>
										<th>Descri&ccedil;&atilde;o</th> 
										<th>A&ccedil;&otilde;es</th>
								  </tr>
							</thead>
							<tbody id="cad_marca">
								<?php require_once("at_tbMarcalocal.php");?>    
							</tbody> 
							 
						</table>
					</div><!-- /.box-body --> 
					<div class="box-footer">
				<a href="javascript:history.go(-1);" class="btn btn-sm btn-danger"><i class="fa fa-hand-o-left"></i> Voltar </a>
			</div>
							
              </div><!-- /.box --> 
			
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

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
     <!-- ChartJS 1.0.1-->
    <script src="https://infraprime.000webhostapp.com/dashboard/assets/plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) 
    <script src="https://infraprime.000webhostapp.com/dashboard/assets/dist/js/pages/dashboard2.js"></script>-->
    <!-- AdminLTE for demo purposes -->
    <script src="https://infraprime.000webhostapp.com/dashboard/assets/dist/js/demo.js"></script>
	<script src="https://infraprime.000webhostapp.com/dashboard/js/action_ativoslocais.js"></script>  <!--Chama o java script -->
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

	$(function () {
		$('[data-toggle="tooltip"]').tooltip();
		$('[data-toggle="popover"]').popover();
	});

</script> 
  </body>
</html> 