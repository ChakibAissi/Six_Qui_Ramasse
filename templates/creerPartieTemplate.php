			<?php
				if(isset($erreurInscription))
					echo '<span class="error">' . $erreurInscription . '</span>';
			?>
			
			<div data-role="content">
				<h2>Creer Partie</h2>
				<form action="index.php" method="post">
					<table>
						<tr>
							<th>Login* :</th>
							<td><input type="text" name="inscriptionLogin"
									<?php if(isset($inscriptionLogin))
										echo ' value="' . $inscriptionLogin . '"';
									?>
								/>
							<?php if(isset($erreurInscriptionLogin))
								echo '<span class=\'error\'>' . $erreurInscriptionLogin . '</span>';
							?>
							</td>
						</tr>
						<tr>
							<th>Mot de passe* :</th>
							<td>
								<input type="password" name="inscriptionPassword"/>
								<?php if(isset($erreurInscriptionPassword))
									echo '<span class=\'error\'>' . $erreurInscriptionPassword . '</span>';
								?>
							</td>
						</tr>
						<tr>
							<th>Mail :</th>
							<td>
								<input type="test" name="inscriptionMail"
									<?php if(isset($inscriptionMail))
										echo ' value="' . $inscriptionMail . '"';
									?>
								/>
							</td>
						</tr>
						<tr>
							<th></th>
							<td><input type="submit" name="Creer mon compte..."/></td>
						</tr>
					</table>
				</form>
			</div>