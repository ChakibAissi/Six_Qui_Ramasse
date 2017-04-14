			<?php
				if(isset($erreurCreationPartie))
					echo '<span class="error">' . $erreurCreationPartie . '</span>';
			?>
			
			<div data-role="content">
				<h2>Creer une partie</h2>
				<form action="index.php" method="post">
					<table>
						<tr>
							<th>Nombre de joueurs :</th>
							<td><input type="radio" name="creationPartieNombreJoueurs" value="2" checked>2
								<input type="radio" name="creationPartieNombreJoueurs" value="3" >3
								<input type="radio" name="creationPartieNombreJoueurs" value="4" >4
								<input type="radio" name="creationPartieNombreJoueurs" value="5" >5
								<input type="radio" name="creationPartieNombreJoueurs" value="6" >6
								<input type="radio" name="creationPartieNombreJoueurs" value="7" >7
								<input type="radio" name="creationPartieNombreJoueurs" value="8" >8
								<input type="radio" name="creationPartieNombreJoueurs" value="9" >9
								<input type="radio" name="creationPartieNombreJoueurs" value="10" >10							</td>
						</tr>
						<tr>
							<th>Public :</th>
							<td>
								<input type="checkbox" name="creationPartieEstPublic" value="1" checked/>
							</td>
						</tr>
						<tr>
							<th></th>
							<td><input type="submit" name="creationPartie" value="Creer une partie"/></td>
						</tr>
					</table>
				</form>
			</div>