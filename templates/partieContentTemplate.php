			<div data-role="content">
				<h1>PartieContent</h1>
					<?php
						echo '<h5>';
						if(isset($idPartieEnCours)){
							echo 'Partie n°'.$idPartieEnCours.'</h5>';
							if(isset($infoPartie))
								echo '<p>' . $infoPartie . '</p>';
						}
						else
							echo 'Aucune partie sélectionner</h5>';
					?>
				<div class="listeJoueurs">
					<table>
						<tr>
							<th>joueur</th>
							<th>score</th>
						</tr>
						<?php
							if(isset($listeJoueurs)){
								foreach($listeJoueurs as $key => $value){
									echo '<tr><th>' . $listeJoueurs[$key]['login'] . '</th>';
									echo '<th>' . $listeJoueurs[$key]['score'] . '</th></tr>';
								}
							}
						?>
					</table>
					<h3>ListePartie</h3>
				</div>
				<div class="listePartieEnCours">
					<table>
						<tr>
							<th>id partie</th>
							<th>createur</th>
							<th>nombre de joueurs</th>
							<th>Participants</th>
							<th></th>
						</tr>
						<?php
							if(isset($listeParties) && isset($idPartieEnCours)){
								foreach($listeParties as $key => $value){
									if($listeParties[$key]['id_partie'] != $idPartieEnCours){
										echo '<tr>';
											echo '<td>' . $listeParties[$key]['id_partie'] . '</td>';
											echo '<td>' . $listeParties[$key]['id_createur'] . '</td>';
											echo '<td>' . $listeParties[$key]['nombre_joueurs'] . '</td>';
											echo '<td>';
											if(!empty($listeParties[$key]['listeInvites'])){
												foreach($listeParties[$key]['listeInvites'] as $key2 => $value2){
													echo $listeParties[$key]['listeInvites'][$key2] . '<br>';
												}
											}else
												echo 'Aucun participant';
											echo '</td>';
											echo '<td><button><a href="index.php?action=changerPartie&amp;idPartie='.$listeParties[$key]['id_partie'].'">Changer partie</a></button></td>';
										echo '</tr>';
									}
								}
							}
						?>
					</table>
				</div>
			</div>