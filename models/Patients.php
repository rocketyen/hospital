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
        // récupérer tous les utilisateurs
        $limit = 10;
        $patientsCount = 'SELECT COUNT(*) FROM `patients`;';
        $sql = 'SELECT * FROM `patients` ORDER BY `id` ASC LIMIT 1000;';
        // $page = ceil($patientsCount / $limit);
        // $offset = ($page * $limit) - $limit;

        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }

        try {
            $pdo = Database::connect();
            // le query prepare et execute en même temps
            $sth = $pdo->query($sql);
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

            // bindValue associe une valeur à un marqueur nominatif
            $sth->bindValue(':id', $id, PDO::PARAM_INT);

            // execute            
            if ($sth->execute()) {
                $nbDltUtil = $sth->rowCount();
                if ($nbDltUtil > 0) {
                    return $nbDltUtil;
                } else {
                    throw new PDOException('aucun utilisateur supprimé');
                }
            } else {
                throw new PDOException('erreur d\'execution');
            }
        } catch (\PDOException $e) {
            return $e;
        }
    }

    public static function patientCount()
    {
        $patientsCount = 'SELECT COUNT(*) FROM `patients`;';
        try {
            $pdo = Database::connect();
            // On fait un prepare ici car on doit récupérer la valeur de l'id de la requete
            $sth = $pdo->prepare($patientsCount);
            $sql = 'SELECT COUNT(*) FROM patients;';

            $sth = $pdo->query($sql);
            $result = $sth->fetchColumn();
            return $result;
            if($result == false){
                throw new PDOException('Aucun patient dans la base de données');
            }
        } catch (\PDOException $e) {
            return $e;
        }
    }
}


// 271064