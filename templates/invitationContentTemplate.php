			<?php
				if(isset($invitationNumeroPartie))
					echo '<h5>Invitation Partie n°' . $invitationNumeroPartie . '<h5>';
			?>

			<div data-role="content">
				<h2>Invitation</h2>
				<form action="index.php" method="post">
					<table>
						<tr>
							<th>Login :</th>
							<td>
								<input type="text" name="invitationLogin"
									<?php if(isset($invitationLogin))
										echo ' value="' . $invitationLogin . '"';
									?>
								/>
								<?php if(isset($erreurInvitationLogin))
									echo '<span class=\'error\'>' . $erreurInvitationLogin . '</span>';
								?>
							</td>
						</tr>
						<tr>
							<th></th>
							<td><input type="submit" name="invitation" value="Inviter"/></td>
						</tr>
					</table>
				</form>
			</div>