			<?php
				if(isset($erreurconnexion))
					echo '<span class=\'error\'>' . $erreurconnexion . '</span>';
			?>
			
			<div data-role="content">
				<h2>connexion</h2>
				<form action="index.php" method="post">
					<table>
						<tr>
							<th>Login :</th>
							<td>
								<input type="text" name="connexionLogin"
									<?php if(isset($connexionLogin))
										echo ' value="' . $connexionLogin . '"';
									?>
								/>
								<?php if(isset($erreurconnexionLogin))
									echo '<span class=\'error\'>' . $erreurconnexionLogin . '</span>';
								?>
							</td>
						</tr>
						<tr>
							<th>Mot de passe :</th>
							<td>
								<input type="password" name="connexionPassword"/>
								<?php if(isset($erreurconnexionPassword)) 
									echo '<span class=\'error\'>' . $erreurconnexionPassword . '</span>';
								?>
							</td>
						</tr>
						<tr>
							<th></th>
							<td><input type="submit" name="connexion" value="Se connecter"/></td>
						</tr>
					</table>
				</form>
			</div>