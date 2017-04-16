<?php
	
	User::addSqlQuery('USER_USED', '
		SELECT login 
		FROM joueur 
		WHERE joueur.login = :login');
	
	User::addSqlQuery('USER_CREATE', '
		INSERT INTO joueur (login, password, score, mail) 
		VALUES(:login, :password, 0 , :mail)');

	User::addSqlQuery('USER_CONNECT', '
		SELECT * 
		FROM joueur 
		WHERE joueur.login = :login
		AND joueur.password = :password');

	User::addSqlQuery('USER_PARTICIPANTS','
		SELECT login 
		FROM joueur 
		WHERE joueur.login IN (
			SELECT login 
			FROM joue
			WHERE joue.id_partie = :id_partie)');
	
	User::addSqlQuery('USER_INVITES', '
		SELECT login 
		FROM joueur 
		WHERE joueur.login IN (
			SELECT login 
			FROM est_invite_a
			WHERE est_invite_a.id_partie = :id_partie)');
	
	User::addSqlQuery('USER_ACCEPTER_INVITATION', '
		INSERT INTO `joue` 
			(`login`, `id_partie`, `score_partie`) VALUES 
			( :login, :id_partie, :score_partie)');
			
	User::addSqlQuery('USER_SUPPRIMER_INVITATION', '
		DELETE 
		FROM est_invite_a e
		WHERE  e.id_partie = :idPartie
		AND e.login = :login');
?>