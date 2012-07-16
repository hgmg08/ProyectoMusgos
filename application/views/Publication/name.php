<?php $publication = $params; ?>

<div class="template_name_page">
	<h1>
		<?php
			echo $publication->getTitle();
		?>
	</h1>
		
	<div id="tabs">
			<ul>
				<li><a href="#detalles">Detalles</a></li>
				<li><a href="#localidades">Localidades</a></li>
			</ul>
			
			<div id="detalles">
				<ul id="details_list">
					<li><p>Autores:</p><span id="title1">
						<?php
							$authors = $publication->getAuthors();
							for($it = $authors->first(); $authors->current(); $it = $authors->next()) {
								echo $authors->current()->getName();
								if ($it = $authors->next() != NULL) {
									echo ", ";
								}
							}
						?>
					</span></li>
					<li><p>Año:</p><span id="title1"><?php echo $publication->getYear(); ?></span></li>
					<li><p>Tipo de publicación:</p><span id="title1"><?php echo $publication->getType(); ?></span></li>
					<li><p>Cita completa:</p>
						<span id="title1">
						<?php
							$authors = $publication->getAuthors();
							for($it = $authors->first(); $authors->current(); $it = $authors->next()) {
								echo $it->getName();
								if ($authors->next() != NULL) {
									echo ", ";
								}
							}
							echo ". ".$publication->getYear().". ".$publication->getTitle().". ".$publication->getData();
						?>
						</span>
					</li>
				</ul>
			</div>
			
			<div id="localidades">
				Lista de localidades de especies AQUI
			</div>
			
		</div>
</div>