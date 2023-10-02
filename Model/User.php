<?php


namespace Model;

class User
{

    public function __construct(private string $password,
                                private string $imgPath,private string $pseudo,
                                private string $email,private string $dateFirstCo,
                                private string $dateLastCo){

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
    public function getImgPath(): string
    {
        return $this->imgPath;
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