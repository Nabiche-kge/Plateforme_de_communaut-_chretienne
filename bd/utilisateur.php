<?php
require_once __DIR__ . '/../config/database.php'; // Inclure la connexion à la base

class Utilisateur {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Fonction pour enregistrer un utilisateur
    public function inscrire($nom, $email, $mot_de_passe) {
        if ($this->verifierEmail($email)) {
            return "Cet email est déjà utilisé.";
        }

        $mot_de_passe_hache = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $role = "utilisateur"; // Rôle par défaut

        $stmt = $this->conn->prepare("INSERT INTO Utilisateurs (nom, email, mot_de_passe, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nom, $email, $mot_de_passe_hache, $role);

        if ($stmt->execute()) {
            return "Inscription réussie !";
        } else {
            return "Erreur : " . $stmt->error;
        }
    }

    // Vérifie si l'email existe déjà
    private function verifierEmail($email) {
        $stmt = $this->conn->prepare("SELECT id FROM Utilisateurs WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }
}
?>
