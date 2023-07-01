<?php

namespace App\Models;

use App\Core\Db;

class User extends Db
{

    protected Int $id;
    protected String $firstname;
    protected String $lastname;
    protected String $email;
    protected String $password;
    protected String $token;
    protected String $role;
    protected Bool $confirmation;
/*     protected $date_inserted;
    protected $date_updated;
 */
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param String $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return String
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param String $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    /**
     * @return String
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param String $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * @return String
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return String
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param String $password
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

     /**
     * @return null
     */
    public function setToken($token): void
    {
        $this->token=$token;
    }

    /**
     * @param null
     */
    public function generateToken(): string
    {
        $bytes = random_bytes(128);
        return $this->token = substr(str_shuffle(bin2hex($bytes)), 0, 255);
    }

    // /**
    //  * @return mixed
    //  */
    // public function getDateInserted()
    // {
    //     return $this->date_inserted;
    // }

    // /**
    //  * @return mixed
    //  */
    // public function getDateUpdated()
    // {
    //     return $this->date_updated;
    // }

    public function getUserByEmail(string $email)
    {
        return $this->read(["email" => $email]);
    }

    // Permet (read) d'accèder au Token spécifique du User  
    /* public function getUserToken(string $token)
    {
        return $this->read(["token" => $token]);
    } */
    public function getUserToken(string $token): string
    {
        $user = $this->read(["token" => $token]);
        return $user ? $user[0]['token'] : null;
        
    }

    public function findUserByToken(string $token)
    {
        return $this->read(["token" => $token]);
    }

    /**
     * @return null
     */
 

    public function findUserById(Int $id)
    {
        return $this->read(["id" => $id]);
    }

    public function getAllUsers()
    {
        return $this->read();
    }

    public function deleteUserById(Int $id)
    {
        return $this->delete(["id" => $id]);
    }

    public function getUserById($id)
    {
        return $this->read(["id" => $id]);
    }

    public function getUserByEmail(string $email)
    {
        return $this->read(["email" => $email]);
    }

    public function getUserToken(string $token): string
    {
        $user = $this->read(["token" => $token]);
        return $user ? $user[0]['token'] : null;
        
    }

    public function findUserByToken(string $token)
    {
        return $this->read(["token" => $token]);
    }

    /**
     * @return null
     */
    public function getConfirmation(): ?bool
    {
        return $this->confirmation;
    }

     /**
     * @return null
     */
    public function setConfirmation(bool $confirmation): void
    {
        $this->confirmation=$confirmation;
    }

    // Permet (read) d'accèder au à la colonne confirmation spécifique du User  
    public function getUserConfirmation(bool $confirmation)
    {
        return $this->read(["confirmation" => $confirmation]);
    }

    // Permet de mettre à jour la colonne "confirmation" de l'utilisateur et de la mettre à True
    public function updateUserConfirmation(bool $confirmation,$id)
    {
        $this->update(["confirmation" => $confirmation], "id", $id);
    }

    public function updateFirstname(string $firstname,$id)
    {
        $this->update(["firstname" => $firstname], "id", $id);
    }

    public function updateLastname(string $lastname,$id)
    {
        $this->update(["lastname" => $lastname], "id", $id);
    }

        public function updateEmail(string $email,$id)
    {
        $this->update(["email" => $email], "id", $id);
    }

        public function updateRole(string $role,$id)
    {
        $this->update(["role" => $role], "id", $id);
    }

}
