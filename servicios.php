<?php
session_start();
require_once("inc/init.php");
require_once("inc/config.ui.php");
$page_title = "Servicios";
$page_css[] = "your_style.css";
include("inc/header.php");
$page_nav["Servicios"]["sub"]["Consultar"]["active"] = true;
include("inc/nav.php");
include_once "controlador/conexion.php";
if(!isset($_SESSION['Logueado']))
{
	
		?>
		<script type="text/javascript">
			window.location="index.php";
		</script>
		<?php
}
else
{
	?>
	<div id="main" role="main">
		<?php
		$breadcrumbs["Servicios"] = "";
		include("inc/ribbon.php");
		?>
		<div id="content">
			<div class="row">
				<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
					<h1 class="page-title txt-color-blueDark">
						<i class="fa-fw fa fa-home"></i> 
						Servicios
						<span>>  
							Consultar
						</span>
					</h1>
				</div>
				<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
				</div>
			</div>
			<section id="widget-grid" class="">
				<div class="row">
					<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div style="width:100%;overflow:auto;">
						<table id="jqgrid"></table>
						</div>
						<div id="pjqgrid"></div>
						<br>
					</article>
				</div>
			</section>
		</div>
	</div>
	<div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-den="true">
		<form name="" action="Servicios.php" method="GET" id="">

			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModalLabel">Buscar</h4>
					</div>
					<div class="modal-body"> 
						<div class="well well-sm well-primary">            
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="category">Buscar</label>
										<input type="text" class="form-control" name="buscar" id="buscar" required />
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">                    
										<label for="category"> En</label>
										<select name='en' id="en" class="form-control">
											<option value="Cliente">Cliente</option><option value="Tipo">Tipo</option><option value="Telefono">Telefono</option><option value="Km">Km</option>
										</select>
									</div>
								</div>              
							</div>  
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">
								Cancelar
							</button>
							<input type="submit" class="btn btn-primary"  value="Buscar""> 

						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<?php
	include("inc/footer.php");
}
?>
<?php 
include("inc/scripts.php"); 
?>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/jqgrid/jquery.jqGrid.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/jqgrid/grid.locale-en.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		jQuery("#jqgrid").jqGrid({
			<?php
			if(!$_GET['buscar'])
			{
				echo 'url:"Data/data_servicios.php",';
			}else
			{
				echo 'url:"Busqueda/busqueda_servicios.php?buscar='.$_GET[buscar].'&en='.$_GET[en].'",';
			}
			?>
			datatype : "json",
			height : 'auto',

			autowidth: true,
			shrinkToFit: false,
			colNames : ['Acciones', 'id', 'Cliente', 'Tipo', 'Km','CoordenadasOrigen','CoordenadasDestino', 'DireccionOrigen', 'DireccionDestino','Descripcion','Valor','Mensajero','Estado','FechaSolicitud','FechaEntrega'],
			colModel : [
			{ name : 'act', index:'act', sortable:false, width:"100px" }, 
			{ name : 'id', index : 'id',editable : false ,hidden: false ,  align : "center",editable: false, width:"50px"}, 
			{ name : 'Cliente', index : 'Cliente',  align : "center",editable : true , width:"200px"}, 
			{ name : 'Tipo', index : 'Tipo', align : "center", editable : true , width:"100px"}, 
			{ name : 'Km', index : 'Km', align : "center", editable : true , width:"50px"}, 
			{ name : 'CoordenadasOrigen', index : 'CoordenadasOrigen', align : "center", editable : true, hidden:false , width:"100px"},
			{ name : 'CoordenadasDestino', index : 'CoordenadasDestino', align : "center", editable : true , width:"100px"},
			{ name : 'DireccionOrigen', index : 'DireccionOrigen', align : "center", editable : true , width:"200px"},
			{ name : 'DireccionDestino', index : 'DireccionDestino', align : "center", editable : true , width:"200px"},
			{ name : 'Descripcion', index : 'Descripcion', align : "center", editable : true , width:"200px"},
			{ name : 'Valor', index : 'Valor', align : "center", editable : true , width:"50px"},
			{ name : 'Mensajero', index : 'Mensajero', align : "center", editable : true , width:"100px"},
			//{ name : 'Estado', index : 'Estado', align : "center", editable : true , width:"200px"},
			{ name : 'Estado', index : 'Estado', align : "center", sortable : true, width:"200px", editable : true, edittype:'select',editoptions:{value:{
					'Espera':'Espera',
					'Asignado':'Asignado',
					'Cancelado':'Cancelado',
					'Rechazado':'Rechazado',
					'Entregado':'Entregado',
					'Aceptado':'Aceptado',
					'Solicitud':'Solicitud'
				}}},
			{ name : 'FechaSolicitud', index : 'FechaSolicitud', align : "center", editable : true , width:"200px"},
			{ name : 'FechaEntrega', index : 'FechaEntrega', align : "center", editable : true , width:"200px"}			
			],
			rowNum : 15,
			rowList : [15, 30, 45],
			pager : '#pjqgrid',
			sortname : '',
			toolbarfilter: true,
			viewrecords : true,
			sortorder : "asc",
			gridComplete: function(){
				var ids = jQuery("#jqgrid").jqGrid('getDataIDs');
				for(var i=0;i < ids.length;i++){
					var cl = ids[i];
					var n= $("#jqgrid").getCell(ids[i],"Cliente");
					be = "<button class='btn btn-xs btn-default' data-original-title='Editar' onclick=\"jQuery('#jqgrid').editRow('"+cl+"');\"><i class='fa fa-pencil'></i></button>"; 
					se = "<button class='btn btn-xs btn-default' data-original-title='Guardar' onclick=\"jQuery('#jqgrid').saveRow('"+cl+"');\"><i class='fa fa-save'></i></button>";
					ca = "<button class='btn btn-xs btn-default' data-original-title='Cancelar' onclick=\"jQuery('#jqgrid').restoreRow('"+cl+"');\"><i class='fa fa-times'></i></button>";
					jQuery("#jqgrid").jqGrid('setRowData',ids[i],{act:be+se+ca});
				}	
			},
			editurl : "Edit/edit_servicios.php",
			caption : "Servicios",
			
			multiselect : false,
			autowidth : true,
			multiboxonly: true 


		});
		jQuery("#jqgrid").jqGrid('navGrid', "#pjqgrid", {
			edit : false,
			add : false,
			del : true,
			search : false,
			refresh: true,
		});
		jQuery("#jqgrid").navButtonAdd('#pjqgrid',{
			caption: "",
			buttonicon: "ui-icon-search",
			title: "Buscar",
			onClickButton: function(){ 		   	 	    	
				$("#search").modal();
			}, 
			position:"last"
		});
		jQuery("#jqgrid").jqGrid('inlineNav', "#pjqgrid",{
		add:false,	
		save:false,
		cancel:false,
		edit:false,
		search:false,
		});
		$('.navtable .ui-pg-button').tooltip({
			container : 'body',
			
		});
		


		jQuery("#m1").click(function() {
			var s;
			s = jQuery("#jqgrid").jqGrid('getGridParam', 'selarrrow');
			alert(s);
		});
		jQuery("#m1s").click(function() {
			jQuery("#jqgrid").jqGrid('setSelection', "13");
		});
		//$("#jqgrid").jqGrid("navGrid", "#pager",{add: false, edit: false, del: false, search: false, refresh: false});
		$(".ui-jqgrid").removeClass("ui-widget ui-widget-content");
		$(".ui-jqgrid-view").children().removeClass("ui-widget-header ui-state-default");
		$(".ui-jqgrid-labels, .ui-search-toolbar").children().removeClass("ui-state-default ui-th-column ui-th-ltr");
		$(".ui-jqgrid-pager").removeClass("ui-state-default");
		$(".ui-jqgrid").removeClass("ui-widget-content");

		    // add classes
		    $(".ui-jqgrid-htable").addClass("table table-bordered table-hover");
		    $(".ui-jqgrid-btable").addClass("table table-bordered table-striped");


		    $(".ui-pg-div").removeClass().addClass("btn btn-sm btn-primary");
		    $(".ui-icon.ui-icon-plus").removeClass().addClass("fa fa-plus");
		    $(".ui-icon.ui-icon-pencil").removeClass().addClass("fa fa-pencil");
		    $(".ui-icon.ui-icon-trash").removeClass().addClass("fa fa-trash-o");
		    $(".ui-icon.ui-icon-search").removeClass().addClass("fa fa-search");
		    $(".ui-icon.ui-icon-refresh").removeClass().addClass("fa fa-refresh");
		    $(".ui-icon.ui-icon-disk").removeClass().addClass("fa fa-save").parent(".btn-primary").removeClass("btn-primary").addClass("btn-success");
		    $(".ui-icon.ui-icon-cancel").removeClass().addClass("fa fa-times").parent(".btn-primary").removeClass("btn-primary").addClass("btn-danger");

		    $( ".ui-icon.ui-icon-seek-prev" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
		    $(".ui-icon.ui-icon-seek-prev").removeClass().addClass("fa fa-backward");

		    $( ".ui-icon.ui-icon-seek-first" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
		    $(".ui-icon.ui-icon-seek-first").removeClass().addClass("fa fa-fast-backward");		  	

		    $( ".ui-icon.ui-icon-seek-next" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
		    $(".ui-icon.ui-icon-seek-next").removeClass().addClass("fa fa-forward");

		    $( ".ui-icon.ui-icon-seek-end" ).wrap( "<div class='btn btn-sm btn-default'></div>" );
		    $(".ui-icon.ui-icon-seek-end").removeClass().addClass("fa fa-fast-forward");

		})

$(window).on('resize.jqGrid', function () {
	$("#jqgrid").jqGrid( 'setGridWidth', $("#content").width() );
})

</script>


<?php 
include("inc/google-analytics.php"); 
?>
