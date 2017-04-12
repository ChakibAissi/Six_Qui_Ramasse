			<?php
				if(isset($inscriptionErrorText))
					echo '<span class="error">' . $inscriptionErrorText . '</span>';
			?>
			
			<div data-role="content">
				<h2>Inscription</h2>
				<form action="index.php" method="post">
					<table>
						<tr>
							<th>Login* :</th>
							<td><input type="text" name="inscriptionLogin"/></td>
						</tr>
						<tr>
							<th>Mot de passe* :</th>
							<td><input type="password" name="inscriptionPassword"/></td>
						</tr>
						<tr>
							<th>Mail :</th>
							<td><input type="test" name="inscriptionMail"/></td>
						</tr>
						<tr>
							<th></th>
							<td><input type="submit" name="Creer mon compte..."/></td>
						</tr>
					</table>
				</form>
			</div>