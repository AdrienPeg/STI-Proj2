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
            $stmt = $this->bdd->prepare("SELECT * FROM Utilisateurs WHERE username = ? AND valid ='1'");
            $stmt->bindValue(1, $username, PDO::PARAM_STR);
            $stmt->execute();
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
        session_regenerate_id();
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
            $stmt = $this->bdd->prepare("DELETE FROM Message WHERE Message.id = ?");
            $stmt->bindValue(1, $idMessage, PDO::PARAM_INT);
            $stmt->execute();
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
            $stmt = $this->bdd->prepare("DELETE FROM Utilisateurs WHERE id = ?");
            $stmt->bindValue(1, $idUser, PDO::PARAM_INT);
            $stmt->execute();
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
        $stmt = $this->bdd->prepare("SELECT * FROM Message WHERE id_recepteur = ?");
        $stmt->bindValue(1, $idUser, PDO::PARAM_INT);
        $stmt->execute();
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
        $stmt = $this->bdd->prepare("SELECT * FROM Message WHERE id = ?");
        $stmt->bindValue(1, $idMessage, PDO::PARAM_INT);
        $stmt->execute();
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
            $stmt = $this->bdd->prepare("INSERT INTO `Message` (`id`, `date`, `id_expediteur`, `subject`, `body`, `id_recepteur`) VALUES (NULL, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $date, PDO::PARAM_STR);
            $stmt->bindValue(2, $idSender, PDO::PARAM_INT);
            $stmt->bindValue(3, $subject, PDO::PARAM_STR);
            $stmt->bindValue(4, $body, PDO::PARAM_STR);
            $stmt->bindValue(5, $idReceiver, PDO::PARAM_INT);
            $stmt->execute();
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
        $stmt = $this->bdd->prepare("SELECT * FROM Utilisateurs");
        $stmt->execute();
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
        $stmt = $this->bdd->prepare("SELECT username FROM Utilisateurs WHERE id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);
        $stmt->execute();
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
            $stmt = $this->bdd->prepare("SELECT * FROM Utilisateurs WHERE id = ?");
            $stmt->bindValue(1, $_SESSION['id'], PDO::PARAM_INT);
            $stmt->execute();
            $user = $stmt->fetch();
            if ($user['password'] == $oldPassword && $newPassword == $newPasswordAgain && $oldPassword != $newPassword) {
                $stmt = $this->bdd->prepare("UPDATE Utilisateurs SET password = ? WHERE id = ?");
                $stmt->bindValue(1, $newPassword, PDO::PARAM_STR);
                $stmt->bindValue(2, $_SESSION['id'], PDO::PARAM_INT);
                $stmt->execute();
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
            $stmt = $this->bdd->prepare("INSERT INTO `Utilisateurs` (`id`, `username`, `password`, `valid`, `type`) VALUES (NULL, ?, ?, ?, ?)");
            $stmt->bindValue(1, $username, PDO::PARAM_STR);
            $stmt->bindValue(2, $password, PDO::PARAM_STR);
            $stmt->bindValue(3, $valid, PDO::PARAM_INT);
            $stmt->bindValue(4, $type, PDO::PARAM_STR);
            $res = $stmt->execute();
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
            $stmt = $this->bdd->prepare("SELECT * FROM Utilisateurs WHERE id = ?");
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->execute();
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
            $stmt = $this->bdd->prepare("UPDATE Utilisateurs SET password = ?, valid = ?, type = ? WHERE id = ?");
            $stmt->bindValue(1, $password, PDO::PARAM_STR);
            $stmt->bindValue(2, $valid, PDO::PARAM_INT);
            $stmt->bindValue(3, $type, PDO::PARAM_STR);
            $stmt->bindValue(4, $id, PDO::PARAM_INT);
            $res = $stmt->execute();
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
                header("Location: /index.php?page=home");
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
                header("Location: /index.php?page=home");
            }
        } catch (Exception $e) {
            return null;
        }
    }

    public function verifyUserMessage($messageid)
    {
        try{
            $userid = $_SESSION['id'];
            $messages = $this->getMessages($userid);
            // on contrôle que le message accédé soit bien accessible par l'utilisateur
            foreach ($messages as $mess) {
                if($messageid == $mess['id']){
                    return true;
                }
            }
            return false;
        }catch (Exception $e) {
            return null;
        }
    }
}