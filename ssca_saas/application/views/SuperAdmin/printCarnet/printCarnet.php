<?php 
	$html_frente = $carnet[0]->html_frente;
	$html_posterior = $carnet[0]->html_posterior;

	foreach ($user[0] as $key => $value) {
		$pos = strpos($html_frente, $key);
		if($pos != false) {
			$re = "/(%%)(?!.*(?=db=\"{$key}\"))/";
			$html_frente = preg_replace($re, $value, $html_frente, 1);
		}
	}
	foreach ($user[0] as $key => $value) {
		$pos2 = strpos($html_posterior, $key);
		if($pos2 != false) {
			$re = "/(%%)(?!.*(?=db=\"{$key}\"))/";
			$html_posterior = preg_replace($re, $value, $html_posterior, 1);
		}
	}
?>


<div id="print_carnet">
	<?php 
		sleep(3); 
		echo $html_frente.''.$html_posterior; 
	?>
</div>

<script>
	$(document).ready(function() {
		var element = document.getElementById('print_carnet');
		html2canvas(element,  {
			onrendered: function(canvas) {
				$.ajax({
					type: "POST",
					url: base_url + 'index.php/SuperAdmin/print_carnet',
					data: { image: canvas.toDataURL("image/png") },
					success: function(response) {
						console.log(response);
					}
				});
			}
		});
	});
</script>