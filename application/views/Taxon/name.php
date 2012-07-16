<?php $taxon = $params; ?>

<div class="taxon_name_page">
	<h1>
		<?php
			if ($taxon->getAcceptedName()) {
				echo "!".$taxon->getName();
			}
			else {
				echo $taxon->getName();
			}
		?>
		</h1>
		
		<h6>Clasificación: <?php echo $taxon->getRank()->getName(); ?></h6>
		
				<div id="tabs">
			<ul>
				<li><a href="#detalles">Detalles</a></li>
				<li><a href="#sinonimos">Sinonimos</a></li>
				<li><a href="#distribucion">Distribución</a></li>
				<li><a href="#publicaciones">Publicaciones</a></li>
				<li><a href="#colecciones">Colecciones</a></li>
			</ul>
			
			<div id="detalles">
				<ul id="details_list">
					<?php
						if ($taxon->getRank()->getName() == 'Especie') {
							echo '<li><p>Autor:</p><span id="title1">'.$taxon->getAuthorInitials().'</span></li>';
						}
					?>
					<li><p>Jerarquía superior:</p></li>
					<li>
						<ul id="taxon_hierarchy">
							<?php
								$taxon_aux = $taxon;
								while($taxon_aux = $taxon_aux->getParentRank()) {
										echo '<li>'.$taxon_aux->getRank()->getName().': '.anchor('taxon/'.$taxon_aux->getId(), $taxon_aux->getName()).'</li>';
								}
							?>
						</ul>
					</li>
				</ul>
			</div>
			
			<div id="sinonimos">
				Lista de sinonimos AQUI
			</div>
			
			<div id="distribucion">
				Lista de localidades AQUI
			</div>
			
			<div id="publicaciones">
				<ul id="list_publications">
					<?php
						$publications = $taxon->getPublications();
						for($it = $publications->first(); $publications->current(); $it = $publications->next()) {
							$authors = $it->getAuthors();
							echo "<li>";
							for($itz = $authors->first(); $authors->current(); $itz = $authors->next()) {
								echo $itz->getName();
								if ($authors->next() != NULL) {
									echo ", ";
								}
							}
								echo ". ".$it->getYear().". ".anchor('publication/'.$it->getId(), $it->getTitle()).". ".$it->getData()."</li>";
						}
					?>
				</ul>
			</div>
			
			<div id="colecciones">
				Lista de colecciones AQUI
			</div>
			
		</div>
</div>