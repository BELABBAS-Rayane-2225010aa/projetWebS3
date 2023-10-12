<?php

namespace App\Model;

class Comment
{
    public function __construct(public string $text, public string $date,
                                public User $author, public Billet $billet){
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @return Billet
     */
    public function getBillet(): Billet
    {
        return $this->billet;
    }
}