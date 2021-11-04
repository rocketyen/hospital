<?php
require_once(dirname(__FILE__) . '/../utils/database.php');

class Appointments{

    private $_id;
    private $_dateHour;
    private $_idPatient;
    private $_pdo;

    // fonction magique __construct
    // SELECT * FROM `appointments`
	public function __construct($dateHour, $idPatient)
	{
		try 
		{
			$this->_pdo = Database::connect();
			$this->_dateHour = $dateHour;
			$this->_idPatient = $idPatient;
		}
		catch (\PDOException $ex)
		{
			return $ex;
		}
	}

    public function createAppointment(){        
        
        try 
		{
			// if the appointement do not exist
			if ($this->exist() === false)
			{
				// insert the informations
				$sth = $this->_pdo->prepare('INSERT INTO `appointments` (`dateHour`, `iPatients`) VALUES (:dateHour, :idPatients)');

				// affectation
				$sth->bindValue(':dateHour', $this->_dateHour, PDO::PARAM_STR);
				$sth->bindValue(':idPatients', $this->_idPatient, PDO::PARAM_STR);

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
		catch (PDOException $ex) 
		{
			// return new PDOException('Il y a une erreur dans les informations fournies. Veuillez contacter quelqu\'un si le problème persiste.');
			return $ex;
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
			$sth->bindValue(':idPatients', $this->_idPatient, PDO::PARAM_STR);

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
		catch (PDOException $ex) 
		{
			return $ex;
		}
	}
}
