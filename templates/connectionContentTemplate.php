			<?php
				if(isset($connectionErrorText))
					echo '<span class="error">' . $connectionErrorText . '</span>';
			?>
			
			<div data-role="content">
				<h2>Connection</h2>
				<form action="index.php" method="post">
					<table>
						<tr>
							<th>Login :</th>
							<td><input type="text" name="connectionLogin"/></td>
						</tr>
						<tr>
							<th>Mot de passe :</th>
							<td><input type="password" name="connectionPassword"/></td>
						</tr>
						<tr>
							<th></th>
							<td><input type="submit" name="Se connecter"/></td>
						</tr>
					</table>
				</form>
			</div>