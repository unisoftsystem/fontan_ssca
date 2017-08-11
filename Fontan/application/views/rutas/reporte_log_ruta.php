<!-- Reporte log ruta handler -->
<div id="mReportLogRuta" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
    	<div class="modal-header">
    		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
    			<span aria-hidden="true">
    				&times;
    			</span>
    		</button>
    		<h4 class="modal-title">REPORTE LOG RUTA</h4>
    	</div>
    	<form target="_blank" action="http://190.60.211.17/Fontan/index.php/rutas/export_log_ruta">
    		<div class="modal-body">
    			<div class="alert alert-warning" role="alert" style="font-size: 10px">
    				*Esta operación puede tomar varios minutos
    			</div>
    			<div class="form-group">
    				<label>Por favor seleccione fecha</label>
    				<input type="date" name="f" class="form-control" required="true">
    			</div>
    		</div>
    		<div class="modal-footer">
    			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    			<button type="submit" class="btn btn-primary" id="mReportLogRuta_close">Generar reporte</button>
    		</div>
    	</form>
    </div>
  </div>
</div>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>
	$(document).ready(function () {
		$("a[href='_R_L__RUTA']").click(function(event) {
			event.preventDefault();
			$('#mReportLogRuta').modal('show');
		});

		$("#mReportLogRuta_close").click(function () {
			setTimeout(function() {
				$('#mReportLogRuta').modal('hide');
			}, 2000);
		});
	});
</script> 