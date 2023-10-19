<?php

namespace App\Model;

class User
{

    public function __construct(private int $user_id, private string $password,
                                private string $pseudo, private string $email,
                                private string $dateFirstCo, private string $dateLastCo){

    }

    public static function loginUser (string $password , string $login):self {
        return new self($password,'',$login,'','','');
    }

    /**
     * @return integer
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getPseudo(): string
    {
        return $this->pseudo;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getDateFirstCo(): string
    {
        return $this->dateFirstCo;
    }

    /**
     * @return string
     */
    public function getDateLastCo(): string
    {
        return $this->dateLastCo;
    }
}