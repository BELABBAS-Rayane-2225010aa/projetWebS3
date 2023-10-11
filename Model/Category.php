<?php

namespace App\Model;

class Category
{
    public function __construct(public string $label,public string $description){
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}