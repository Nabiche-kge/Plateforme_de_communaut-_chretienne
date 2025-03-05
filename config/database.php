<?php
class Database {
    private $host = "localhost"; // Serveur MySQL
    private $dbname = "communaute_chretienne"; // ⚠️ Mets le vrai nom de ta base
    private $username = "root"; // ⚠️ Mets ton utilisateur MySQL
    private $password = ""; // ⚠️ Mets ton mot de passe si nécessaire
    public $conn;

    // Fonction pour établir la connexion
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
            if ($this->conn->connect_error) {
                die("Échec de la connexion : " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
        return $this->conn;
    }
}
?>
