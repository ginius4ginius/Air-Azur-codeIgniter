DELIMITER $$
CREATE DEFINER=`giniusAdmin`@`localhost` PROCEDURE `air_azur_dev_reset`()
    NO SQL
BEGIN
	SET FOREIGN_KEY_CHECKS = 0;
	TRUNCATE TABLE aeroport;
	TRUNCATE TABLE agence;
	TRUNCATE TABLE client;
	TRUNCATE TABLE reservation;
	TRUNCATE TABLE vol;
	TRUNCATE TABLE vol_g;

	BEGIN
		DECLARE EXIT HANDLER FOR SQLEXCEPTION
		BEGIN
			SHOW ERRORS;
			ROLLBACK;
		END;
		START TRANSACTION;
		INSERT INTO aeroport (`code`, `libelle`, `pays`, `arp_nom`) VALUES
			(1, 'CDG', 'France', 'Roissy-CDG'),
			(2, 'MLE', 'Maldives', 'Malé'),
			(3, 'JFK', 'Etats-Unis', 'John-F-Kennedy'),
			(4, 'LCY', 'Royaume-Uni', 'Londres-City');

		INSERT INTO agence (`gnc_id`, `code_agence`, `mot_de_passe`) VALUES
			(1, 810, '123456'),
			(2, 815, '987654');


		INSERT INTO client (`cln_id`, `nom`, `prenom`, `adr_rue`, `adr_cp`, `adr_ville`) VALUES
			(1, 'Zor', 'Dino', 'Rue des Lézards', 75014, 'Paris'),
			(3, 'Solete', 'Bob', 'Rue des Chats', 75019, 'Paris'),
			(4, 'Piazza', 'Roberto', 'Rue des Mouettes', 76600, 'Le Havre');

		INSERT INTO vol_g (`vlg_num`, `heure_dep`, `heure_arr`, `prix`, `nbr_places`, `jour`, `code_arp_dep`, `code_arp_arr`) VALUES
			('AF150', '15:30:00', '16:30:00', 39, 185, 'mercredi', 1, 4),
			('AF410', '20:30:00', '09:30:00', 766, 180, 'lundi', 1, 2),
			('AF660', '08:00:00', '16:00:00', 277, 180, 'mardi', 1, 3);
        
        INSERT INTO vol (`date_dep`, `vlg_num`, `date_arr`) VALUES
			('2018-01-15', 'AF410', '2018-01-16'),
			('2018-01-16', 'AF660', '2018-01-16'),
			('2018-01-17', 'AF150', '2018-01-17'),
			('2018-01-22', 'AF410', '2018-01-23'),
			('2018-01-23', 'AF660', '2018-01-23'),
			('2018-01-24', 'AF150', '2018-01-24');
            
		INSERT INTO `reservation` (`rsr_num`, `gnc_id`, `nbr_places_res`, `date_reservation`, `cln_id`, `vlg_num`, `date_dep`) VALUES
			(1, 1, 2, '2018-01-06', 1, 'AF660', '2018-01-16'),
			(2, 1, 1, '2018-01-06', 3, 'AF150', '2018-01-17');
					
					
		COMMIT;
	END;

	SET FOREIGN_KEY_CHECKS = 1;
END$$
DELIMITER ;
