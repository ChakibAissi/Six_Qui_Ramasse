			<?php
				if(isset($erreurConnection))
					echo '<span class=\'error\'>' . $erreurConnection . '</span>';
			?>
			
			<div data-role="content">
				<h2>Connection</h2>
				<form action="index.php" method="post">
					<table>
						<tr>
							<th>Login :</th>
							<td>
								<input type="text" name="connectionLogin"
									<?php if(isset($connectionLogin))
										echo ' value="' . $connectionLogin . '"';
									?>
								/>
								<?php if(isset($erreurConnectionLogin))
									echo '<span class=\'error\'>' . $erreurConnectionLogin . '</span>';
								?>
							</td>
						</tr>
						<tr>
							<th>Mot de passe :</th>
							<td>
								<input type="password" name="connectionPassword"/>
								<?php if(isset($erreurConnectionPassword)) 
									echo '<span class=\'error\'>' . $erreurConnectionPassword . '</span>';
								?>
							</td>
						</tr>
						<tr>
							<th></th>
							<td><input type="submit" name="Se connecter"/></td>
						</tr>
					</table>
				</form>
			</div>