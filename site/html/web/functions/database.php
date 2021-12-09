<?php
date_default_timezone_set('UTC');
session_start();

/**
 * Classe contenant les fonctions faisant appel à la base de données
 * Auteurs : Peguiron A., Viotti N.
 */
class database
{
    private $bdd;

    /***
     * Permet de se connecter à la BDD
     */
    private function connect()
    {
        try {
            $this->bdd = new PDO('sqlite:/usr/share/nginx/databases/database.sqlite');
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Permet de se déconnecter de la BDD
     */
    private function disconnect()
    {
        $this->bdd = null;
    }

    /**
     * Fonction vérifiant les credentials passés dans le login. Si l'authentification réussit, les variables de 
     * session sont initiées
     * @param $username
     * @param $password
     * @return bool
     */
    public function login($username, $password)
    {
        try {
            $this->connect();
            $stmt = $this->bdd->query("SELECT * FROM Utilisateurs WHERE username ='" . $username . "' AND valid ='1'");
            $result = $stmt->fetch();
            $this->disconnect();
            if (isset($result) && $password == $result['password']) {
                $_SESSION['type'] = $result['type'];
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $result['id'];
                $_SESSION['loggedin'] = true;
                return true;
            } else {
                $_SESSION['loggedin'] = false;
                return false;
            }
        } catch (Exception $e) {
            $this->disconnect();
            return false;
        }
    }

    /**
     * Permet de déconnecter l'utilisateur, en détruisant les variables de session
     */
    public function unlogin()
    {
        session_destroy();
    }

    /**
     * Permet de supprimer un message dans la bdd
     * @param $idMessage
     * @return void|null
     */
    public function deleteMessage($idMessage)
    {
        try {
            $this->connect();
            $this->bdd->exec("DELETE FROM Message WHERE Message.id='" . $idMessage . "'");
            $this->disconnect();
        } catch (Exception $e) {
            $this->disconnect();
            return null;
        }

    }

    /**
     * Permet de supprimer un utilisateur dans la bdd
     * @param $idUser
     * @return void|null
     */
    public function deleteUser($idUser)
    {
        try {
            $this->connect();
            $this->bdd->exec("DELETE FROM Utilisateurs WHERE id ='" . $idUser . "'");
            $this->disconnect();
        } catch (Exception $e) {
            $this->disconnect();
            return null;
        }
    }

    /**
     * Permet de récupérer tous les messages appartenant à un utilisateur
     * @param $idUser
     * @return mixed
     */
    public function getMessages($idUser)
    {
        $this->connect();
        $stmt = $this->bdd->query("SELECT * FROM Message WHERE id_recepteur='" . $idUser . "'");
        $messages = $stmt->fetchAll();
        $this->disconnect();
        return $messages;
    }

    /**
     * Permet de récupérer les détails d'un message via son ID
     * @param $idMessage
     * @return mixed
     */
    public function getMessage($idMessage)
    {
        $this->connect();
        $stmt = $this->bdd->query("SELECT * FROM Message WHERE id='" . $idMessage . "'");
        $message = $stmt->fetch();
        $this->disconnect();
        return $message;
    }

    /**
     * Permet d'envoyer(créer) un nouveau message
     * @param $idSender
     * @param $idReceiver
     * @param $subject
     * @param $date
     * @param $body
     * @return void|null
     */
    public function sendMessage($idSender, $idReceiver, $subject, $date, $body)
    {
        try {
            $this->connect();
            $this->bdd->exec("INSERT INTO `Message` (`id`, `date`, `id_expediteur`, `subject`, `body`, `id_recepteur`) VALUES (NULL, '$date', '$idSender', '$subject', '$body', '$idReceiver')");
            $this->disconnect();
        } catch (Exception $e) {
            $this->disconnect();
            return null;
        }
    }

    /**
     * Permet d'afficher tous les utilisateurs présents dans la bdd
     * @return mixed
     */
    public function getAllUsers()
    {
        $this->connect();
        $stmt = $this->bdd->query("SELECT * FROM Utilisateurs");
        $users = $stmt->fetchAll();
        $this->disconnect();
        return $users;
    }

    /**
     * Permet de récupérer le username d'un utilisateur grâce à son id
     * @param $id
     * @return mixed
     */
    public function getUsernameFromId($id)
    {
        $this->connect();
        $stmt = $this->bdd->query("SELECT username FROM Utilisateurs WHERE id='" . $id . "'");
        $username = $stmt->fetch();
        $this->disconnect();
        return $username;
    }

    /**
     * Permet de vérifier que le nouveau password a bien été entré deux fois correctement
     * @param $oldPassword
     * @param $newPassword
     * @param $newPasswordAgain
     * @return bool
     */
    public function changePassword($oldPassword, $newPassword, $newPasswordAgain)
    {
        try {
            $this->connect();
            $stmt = $this->bdd->query("SELECT *FROM Utilisateurs WHERE id='" . $_SESSION['id'] . "'");
            $user = $stmt->fetch();
            if ($user['password'] == $oldPassword && $newPassword == $newPasswordAgain && $oldPassword != $newPassword) {
                $this->bdd->exec("UPDATE Utilisateurs SET password='" . $newPassword . "' WHERE id='" . $_SESSION['id'] . "'");
                $this->disconnect();
                return true;
            } else {
                $this->disconnect();
                return false;
            }


        } catch (Exception $e) {
            $this->disconnect();
            return false;
        }
    }

    /**
     * Permet de créer un nouvel utilisateur sur la bdd
     * @param $username
     * @param $password
     * @param $passwordAgain
     * @param $valid
     * @param $type
     * @return false|null
     */
    public function createUser($username, $password, $passwordAgain, $valid, $type)
    {
        try {
            if ($password != $passwordAgain) {
                return false;
            }
            $this->connect();
            $res = $this->bdd->exec("INSERT INTO `Utilisateurs` (`id`, `username`, `password`, `valid`, `type`) VALUES (NULL, '$username', '$password', '$valid', '$type')");
            $this->disconnect();
            return $res;
        } catch (Exception $e) {
            $this->disconnect();
            return null;
        }
    }

    /**
     * Permet d'obtenir toutes les informations sur un utilisateur à partir de son id
     * @param $id
     * @return null
     */
    public function getUserInfo($id)
    {
        try {
            $this->connect();
            $stmt = $this->bdd->query("SELECT * FROM Utilisateurs WHERE id='" . $id . "'");
            $user = $stmt->fetch();
            $this->disconnect();
            return $user;

        } catch (Exception $e) {
            $this->disconnect();
            return null;
        }
    }

    /**
     * Permet l'édition des données d'une utilisateur
     * @param $id
     * @param $password
     * @param $valid
     * @param $type
     * @return null
     */
    public function editUser($id, $password, $valid, $type)
    {
        try {
            $this->connect();
            $res = $this->bdd->exec("UPDATE Utilisateurs SET password='" . $password . "', valid='" . $valid . "', type='" . $type . "' WHERE id='" . $id . "'");
            $this->disconnect();
            return $res;
        } catch (Exception $e) {
            $this->disconnect();
            return null;
        }
    }

    /**
     * Permet de vérifier que la session actuelle soit celle d'un admin
     * @return void|null
     */
    public function verifyAdmin()
    {
        try {
            if (!isset($_SESSION['type']) || $_SESSION['type'] != 'admin' || $_SESSION['loggedin'] == false) {
                header("Location: http://localhost:8080/index.php?page=home");
            }
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Permet de vérifier que la session actuelle soit celle d'un utilisateur
     * @return void|null
     */
    public function verifyUser()
    {
        try {
            if (!isset($_SESSION['type']) || ($_SESSION['type'] != 'admin' && $_SESSION['type'] != 'user') || $_SESSION['loggedin'] == false) {
                header("Location: http://localhost:8080/index.php?page=home");
            }
        } catch (Exception $e) {
            return null;
        }
    }

}