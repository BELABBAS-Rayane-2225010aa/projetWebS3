<?php

namespace Model;

use Model\User;

class Admin extends User
{
    public function __construct(private string $password,
                                private string $imgPath,private string $pseudo,
                                private string $email,private string $dateFirstCo,
                                private string $dateLastCo,private bool $isAdmin){
        parent::__construct($this->password,$this->imgPath,$this->pseudo,$this->email,$this->dateFirstCo,$this->dateLastCo);
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->isAdmin;
    }
}