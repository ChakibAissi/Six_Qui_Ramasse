<?php
	
	Partie::addSqlQuery('PARTIE_CREATE', '
		INSERT INTO partie (id_partie, id_createur, nombre_joueurs, est_commencee, est_terminee, est_public, date_creation) 
			VALUES(NULL, :login, :nombre_joueurs, 0, 0, :est_public, :date)');
			
	Partie::addSqlQuery('PARTIE_EST_CREATEUR', '
		SELECT id_createur
		FROM partie
		WHERE partie.id_partie = :id_partie
		AND partie.id_createur = :login');

	Partie::addSqlQuery('PARTIE_DISPONIBLES', '
		SELECT id_partie, id_createur,  nombre_joueurs, est_commencee, est_terminee, est_public, date_creation
		FROM partie p
		WHERE NOT p.id_createur = :login
		AND p.est_commencee = \'0\'
		AND p.est_terminee =  \'0\'
		AND p.est_public =  \'1\'
		AND p.nombre_joueurs -1 > (
			SELECT COUNT(j.login)
			FROM joue j
			WHERE j.id_partie = p.id_partie)
		AND :login NOT IN (
			SELECT login 
			FROM joueur 
			WHERE joueur.login IN (
				SELECT login 
				FROM joue j2
				WHERE j2.id_partie = p.id_partie
				AND j2.login = :login))');
				
	Partie::addSqlQuery('PARTIE_COMPLET', '
		SELECT id_partie
		FROM partie p
		WHERE p.id_partie = :id_partie
		AND p.nombre_joueurs = (
			SELECT COUNT(j.login)
			FROM joue j
			WHERE j.id_partie = p.id_partie)');
			
	Partie::addSqlQuery('PARTIE_INVITER', '
		INSERT INTO `invitation` 
			(`login`, `id_partie`) VALUES 
			( :login, :id_partie)');
	
	Partie::addSqlQuery('PARTIE_EST_INVITE', '
		SELECT login 
		FROM invitation e
		WHERE e.login = :login 
		AND e.id_partie = :id_partie');
		
	Partie::addSqlQuery('PARTIE_PARTICIPE', '
		SELECT login
		FROM joue j
		WHERE j.id_partie = :id_partie
		AND j.login = :login');
?>