<?php

namespace Tests\Unit\Model;

use PHPUnit\Framework\TestCase;

class BilletTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->SessionActiveMock = new SessionActive();
    }

    /** @test  */
    public function billet_is_deleted_from_bd():void
    {
        //etant donné un billet
        //quand la methode delete_Billet() est appelé
        //alors on vérifie que le billet a été supprimer de la bd
    }

    /** @test  */
    public function billet_is_updated_from_bd():void
    {
        //etant donné un billet
        //quand la methode modif_Billet() est appelé
        //alors on vérifie que le billet a été mis a jour dans la bd
    }
}
