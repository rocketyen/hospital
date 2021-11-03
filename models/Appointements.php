<?php
require_once(dirname(__FILE__) . '/../utils/database.php');

class Appointements{

    private $_id;
    private $_dateHour;
    private $_idPatient;

    // fonction magique __construct
    public function __construct($id = '', $dateHour = '', $idPatient = ''){
        
        $this->_dateHour = $dateHour;
        $this->_idPatient =intval($idPatient);
        $this->_pdo = Database::connect();
        $this->_id = intval($id);
        
    }

    public function createAppointement(){
        
        
        try {
            // marqueurs nominatif :lastname etc
            $sql = 'INSERT INTO `appointements` (`dateHour`, `idPatient`)
                VALUES (:dateHour, :idPatient)`
                JOIN `patients`
                ON `appointements`.`idPatients` = `patients`.`id`;';
            // préparation protège des injections sql 
            // Avec un prepare au aura forcement un bindValue et un execute de sth     
            $sth = $this->_pdo->prepare($sql);

            // bindValue associe une valeur à un paramètre
            // $this = objet en cours
            $sth->bindValue(':dateHour', $this->_dateHour, PDO::PARAM_STR);
            $sth->bindValue(':idPatient', $this->_idPatient, PDO::PARAM_INT);

            // execute            
            if ($sth->execute()) {
                $appointement = $sth->fetch();
                if ($appointement) {
                    return $appointement;
                } else {
                    throw new PDOException('n\'existe pas');
                }
            } else {
                throw new PDOException('erreur d\'execution');
            }
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }
}
