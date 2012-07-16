<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="<?php echo base_url('css/960_16_col.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/reset.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/text.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('css/styles.css'); ?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/base/jquery-ui.css" type="text/css" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.js" type="text/javascript"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>

<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>

<title>Proyecto Musgos</title>

</head>

<body>

<div class="container_16">
	<div class="grid_16 header">
	</div>
	<div class="clear"></div>
					  
	<div class="grid_3 left_menu">
		<?php $this->load->view('left_menu'); ?>
	</div>
							    
	<div class="grid_10 central_content">
		<?php 
			if (isset($params)) {
				$this->load->view($view, $params);
			}
			else {
				$this->load->view($view);
			}
		?>
	</div>
									    
	<div class="grid_3 right_menu">
		<?php $this->load->view('right_menu'); ?>
	</div>
	<div class="clear"></div>

   	<div class="grid_16 footer">
		<?php $this->load->view('footer'); ?>
	</div>
</div>

</body>
</html>

