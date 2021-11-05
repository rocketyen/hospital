<?php
require_once(dirname(__FILE__) . '/../utils/database.php');

class Appointments{

    
    private $_dateHour;
    private $_idPatients;
	private $_id;
    private $_pdo;

    // fonction magique __construct
    // SELECT * FROM `appointments`
	public function __construct($dateHour = '', $idPatients = '', $id = '')
	{		
		try 
		{			
			$this->_dateHour = $dateHour;
			$this->_idPatients = $idPatients;
			$this->_id = intval($id);
			$this->_pdo = Database::connect();
		}
		catch (\PDOException $e)
		{
			return $e;
		}
	}

    public function createAppointment(){        
        
        try 
		{
			// if the appointement do not exist
			if ($this->exist() === false)
			{
				// insert the informations
				$sth = $this->_pdo->prepare('INSERT INTO `appointments` (`dateHour`, `idPatients`) VALUES (:dateHour, :idPatients)');

				// affectation
				$sth->bindValue(':dateHour', $this->_dateHour, PDO::PARAM_STR);
				$sth->bindValue(':idPatients', $this->_idPatients, PDO::PARAM_STR);

				// excecute the request
				// if the resquest passed, return it. If not, return a PDO error.
				if (!$sth->execute()){
					throw new PDOException('Erreur dans la matrice. Un incident est arrivé durant \'enregistrement');
				}
			}
			else
			{
				return $this->exist();
				// throw new PDOException('Les informations fournies correspondent à un rendez-vous existant.');
			}
		}
		catch (PDOException $e) 
		{
			// return new PDOException('Il y a une erreur dans les informations fournies. Veuillez contacter quelqu\'un si le problème persiste.');
			return $e;
		}
    }

    public function exist()
	{
		try 
		{
			// check if the appointement exist with the dateHour & the patient ID.
			$sth = $this->_pdo->prepare('SELECT * FROM `appointments` WHERE `dateHour` = :dateHour AND `idPatients` = :idPatients ;');

			// affectation
			$sth->bindValue(':dateHour', $this->_dateHour, PDO::PARAM_STR);
			$sth->bindValue(':idPatients', $this->_idPatients, PDO::PARAM_STR);

			if ($sth->execute())
			{
				$result_fetch = $sth->fetch();
				if ($result_fetch){
					/* ! USER MESSAGE TO SHOW */
					throw new PDOException('Les informations fournies correspondent à un rendez-vous existant.');

					/* ! DEVELOPPER PART : DEBUG */
					// return $result_fetch;
				} else {
					// do not exist
					return false;

					/* ! DEVELOPPER PART : DEBUG */
					// return $result_fetch;
				}
			} else {
				/* ! USER MESSAGE TO SHOW */
				throw new PDOException('Erreur dans la matrice. Un incident est arrivé durant la vérification des données.');
			}	
		}
		catch (PDOException $e) 
		{
			return $e;
		}
	}

	public static function readAppointment()
    {
        // récupérer tous les utilisateurs
        $sql = 'SELECT `appointments`.`id`, 
		`patients`.`lastname`, 
		`patients`.`firstname`, 
		`patients`.`phone`,
		`appointments`.`dateHour` 
		FROM `appointments`
		INNER JOIN `patients`
		ON `patients`.`id` = `appointments`.`idPatients`;'; 

        try {
            $pdo = Database::connect();
            // le query  execute la requète
            $sth = $pdo->query($sql);
            $appointment = $sth->fetchAll();
            return $appointment;
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

	public static function profileAppointment($id)
    {		
        // récupérer un utilisateur
        $sql = 'SELECT * FROM `appointments` WHERE `id`= :id;';

        try {
            $pdo = Database::connect();
            // On fait un prepare ici car on doit récupérer la valeur de l'id de la requete
            $sth = $pdo->prepare($sql);

            // bindValue associe une valeur à un paramètre
            $sth->bindValue(':id', $id, PDO::PARAM_INT);

            // execute            
            if ($sth->execute()) {
                $appointment = $sth->fetch();
                if ($appointment) {
                    return $appointment;
                } else {
                    throw new PDOException('n\'existe pas');
                }
            } else {
                throw new PDOException('erreur d\'execution');
            }
        } catch (\PDOException $e) {
            return $e;
        }
    }

	// public function updateAppointement()
    // {
    //     // modifier un rdv   
    //     $sql =
    //     'UPDATE `appointments` 
    //     SET `dateHour` = :dateHour, 
    //     `idPatients` = :idPatients
    //     WHERE `id`= :id;';

    //     try {
    //         // On fait un prepare ici car on doit récupérer l'id de la requete
    //         $sth = $this->_pdo->prepare($sql);

    //         // bindValue marqueur nominatif,  valeur, PDO paramètre
    //         $sth->bindValue(':id', $this->_id, PDO::PARAM_INT);
    //         $sth->bindValue(':dateHour', $this->_dateHour, PDO::PARAM_STR);
    //         $sth->bindValue(':idPatients', $this->_idPatients, PDO::PARAM_STR);

    //         // execute
    //         if (!$sth->execute()) {
    //             throw new PDOException('Problème');
    //         } else {
    //             return true;
    //         }
    //     } catch (\PDOException $e) {
    //         return $e;
    //     }
    // }
}
