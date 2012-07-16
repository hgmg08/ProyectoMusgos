<div class="taxon_search">

<?php
	
	$this->load->helper('form');
	
	$attrib = array('class' => 'taxon_search_form');
	echo form_open('taxon/search', $attrib);
	
	$fieldset_att = array(
												'name'	=>	'fieldset_taxon_search',
												'class'	=>	'fieldset_taxon_search',
												);
	echo form_fieldset('Busqueda de especies');
	$search_att = array(
											'name'    		=> 'name',
              				'class'       => 'taxon_name',
              				'maxlength'		=> '100',
       								);
	echo form_input($search_att);
	
	$submit_att = array(
											'name'	=>	'buscar',
											'value'	=>	'Buscar',
											'class'	=>	'taxon_search_button',
											);
	echo form_submit($submit_att);
	
	echo "<p>";
	echo form_label('Habito', 'habito');
	
	$options_sustrato = array(
														'hab1'  => 'Habito 1',
														'hab2'  => 'Habito 2',
														'hab3'  => 'Habito 3',
														'hab4' 	=> 'Habito 4',
														);
	$sustrato_att = array(
												'class'	=>	'taxon_habito',
												);
	
	echo form_dropdown('habito', $options_sustrato, NULL, $sustrato_att);
	echo "</p>";
	
	echo "<p>";
	echo form_label('Sustrato', 'sustrato');
	
	$options_sustrato = array(
														'sus1'  => 'Sustrato 1',
														'sus2'  => 'Sustrato 2',
														'sus3'  => 'Sustrato 3',
														'sus4' 	=> 'Sustrato 4',
														);
	$sustrato_att = array(
												'class'	=>	'taxon_sustrato',
												);
	
	echo form_dropdown('sustrato', $options_sustrato, NULL, $sustrato_att);
	echo "</p>";
	
	echo form_fieldset_close();
	
	echo form_close();
	
?>

</div>