			<div data-role="content">
				<h1>UserContent</h1>
				<h3>ListePartie</h3>
				<table>
					<tr>
						<th>id partie</th>
						<th>createur</th>
						<th>nombre de joueurs</th>
						<th>partie en cours</th>
						<th>partie terminee</th>
						<th>partie public</th>
						<th>date de creation</th>
						<th>Participants</th>
						<th></th>
						<?php if(isset($peutInviter)) echo '<th></th>';?>
					</tr>
					<?php
						if(isset($listeParties)){
							foreach($listeParties as $key => $value){
								echo '<tr>';
									echo '<td>' . $listeParties[$key]['id_partie'] . '</td>';
									echo '<td>' . $listeParties[$key]['id_createur'] . '</td>';
									echo '<td>' . $listeParties[$key]['nombre_joueurs'] . '</td>';
									echo '<td>' . $listeParties[$key]['est_commencee'] . '</td>';
									echo '<td>' . $listeParties[$key]['est_terminee'] . '</td>';
									echo '<td>' . $listeParties[$key]['est_public'] . '</td>';
									echo '<td>' . $listeParties[$key]['date_creation'] . '</td>';
									echo '<td>';
									if(!empty($listeParties[$key]['listeInvites'])){
										foreach($listeParties[$key]['listeInvites'] as $key2 => $value2){
											echo $listeParties[$key]['listeInvites'][$key2] . '<br>';
										}
									}else
										echo 'Aucun participant';
									echo '</td><td>';
									if($listeParties[$key]['est_terminee'] == '0')
										echo '<button><a href="index.php?action=rejoindrePartie&amp;idPartie='.$listeParties[$key]['id_partie'].'">' . $rejoindrePartie . '</a></button>';
									else
										echo 'Terminée';
									echo '</td>';
									if(isset($peutInviter)){
										if($peutInviter){
											echo '<td>';
											if(!$listeParties[$key]['complet'] && $listeParties[$key]['est_terminee'] == '0')
													echo '<button><a href="index.php?action=invitation&amp;idPartie='.$listeParties[$key]['id_partie'].'">Inviter</a></button>';
											else
												echo 'complet';
											echo '</td>';
										}
									}
								echo '</tr>';
							}
						}
					?>
				</table>
			</div>