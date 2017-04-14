			<div data-role="content">
				<h1>UserContent</h1>
				<h5>Login : <?php echo $login ?></h5>
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
									}else {
										echo 'no one';
									}
									echo '</td>';
									
								echo '</tr>';
							}
						}
					?>
				</table>
			</div>