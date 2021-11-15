<?php
require_once(dirname(__FILE__) . '/../utils/database.php');

class Patient
{
    private $_firstname;
    private $_lastname;
    private $_birthdate;
    private $_phone;
    private $_mail;
    private $_pdo;
    private $_id;

    // fonction magique __construct
    public function __construct($lastname = '', $firstname = '', $birthdate = '', $phone = '', $mail = '', $id = '')
    {
        $this->_firstname = $firstname;
        $this->_lastname = $lastname;
        $this->_birthdate = $birthdate;
        $this->_phone = $phone;
        $this->_mail = $mail;
        $this->_pdo = Database::connect();
        $this->_id = intval($id);
    }

    public function create()
    {
        // marqueurs nominatif :lastname etc
        $sql = 'INSERT INTO `patients` (`lastname`, `firstname`, `birthdate`, `phone`, `mail`) 
                VALUES (:lastname, :firstname, :birthdate, :phone, :mail);';

        try {
            // préparation protège des injections sql 
            // Avec un prepare on aura forcement un bindValue et un execute de sth     
            $sth = $this->_pdo->prepare($sql);

            // bindValue associe une valeur à un paramètre
            // $this = objet en cours
            $sth->bindValue(':lastname', $this->_lastname, PDO::PARAM_STR);
            $sth->bindValue(':firstname', $this->_firstname, PDO::PARAM_STR);
            $sth->bindValue(':birthdate', $this->_birthdate, PDO::PARAM_STR);
            $sth->bindValue(':phone', $this->_phone, PDO::PARAM_STR);
            $sth->bindValue(':mail', $this->_mail, PDO::PARAM_STR);

            // execute
            $sth->execute();
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }

    public static function read()
    {
        $search = htmlspecialchars($_GET['search']);
        // récupérer tous les utilisateurs
        $sql = 'SELECT * FROM patients
        WHERE `lastname` LIKE :s
        OR `firstname` LIKE :s;'; 

        try {
            $pdo = Database::connect();
            // le query prepare et execute en même temps
            $s = "%" . $search . "%";
            $sth = $pdo->prepare($sql);

            $sth->bindValue(':s', $s, PDO::PARAM_STR);

            $patient = $sth->fetchAll();
            return $patient;
        } catch (\PDOException $e) {
            $e->getMessage();
        }
    }


    public static function profile($id)
    {
        // récupérer un utilisateur
        $sql = 'SELECT * FROM `patients` WHERE `id`= :id;';

        try {
            $pdo = Database::connect();
            // On fait un prepare ici car on doit récupérer la valeur de l'id de la requete
            $sth = $pdo->prepare($sql);

            // bindValue associe une valeur à un paramètre
            $sth->bindValue(':id', $id, PDO::PARAM_INT);

            // execute            
            if ($sth->execute()) {
                $patient = $sth->fetch();
                if ($patient) {
                    return $patient;
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

    public function update()
    {
        // modifier un utilisateur    
        $sql =
        'UPDATE `patients` 
        SET `lastname` = :lastname, 
        `firstname` = :firstname,
        `birthdate` = :birthdate,
        `phone` = :phone,
        `mail` = :mail 
        WHERE `id`= :id;';

        try {
            // On fait un prepare ici car on doit récupérer l'id de la requete
            $sth = $this->_pdo->prepare($sql);

            // bindValue marqueur nominatif,  valeur, PDO paramètre
            $sth->bindValue(':id', $this->_id, PDO::PARAM_INT);
            $sth->bindValue(':lastname', $this->_lastname, PDO::PARAM_STR);
            $sth->bindValue(':firstname', $this->_firstname, PDO::PARAM_STR);
            $sth->bindValue(':birthdate', $this->_birthdate, PDO::PARAM_STR);
            $sth->bindValue(':phone', $this->_phone, PDO::PARAM_STR);
            $sth->bindValue(':mail', $this->_mail, PDO::PARAM_STR);

            // execute
            if (!$sth->execute()) {
                throw new PDOException('Problème');
            } else {
                return true;
            }

        } catch (\PDOException $e) {
            return $e;
        }
    }

    public static function deletePatient($id)
	{
		// Un patient et ses rdv   
		$sql =
			'DELETE FROM `patients`            
        WHERE `id`= :id;';

		try {
			$pdo = Database::connect();
			// On fait un prepare ici car on doit récupérer la valeur de l'id de la requete
			$sth = $pdo->prepare($sql);

			// bindValue associe une valeur à un paramètre
			$sth->bindValue(':id', $id, PDO::PARAM_INT);

			// execute            
			if ($sth->execute()) {
				$patient = $sth->fetch();
				if ($patient) {
					return $patient;
				} else {
					throw new PDOException('unkknow');
				}
			} else {
				throw new PDOException('erreur d\'execution');
			}
		} catch (\PDOException $e) {
			return $e;
		}
	}


    
}



// LUCAS L 0695806847


