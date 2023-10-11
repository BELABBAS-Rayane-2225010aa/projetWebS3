<?php

namespace Unit\Model;
require_once './Model/User.php';

use Model\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /* private string $password,
     * private string $imgPath,
     * private string $pseudo,
     * private string $email,
     * private string $dateFirstCo,
     * private string $dateLastCo */

    /** @test */
    public function getPassword(): void
    {
        //etant donné que(given) un nouvel user
        $user = new User("motdepasse", "", "TestPseudo", "email", "10/08", "10/08");
        //quand(when) on appel la méthode getPassword
        $expected = "motdepasse";
        //alors(then) on vérifie que password a été renvoyer
        $this->assertSame($expected, $user->getPassword());
    }

    /** @test */
    public function getImgPath(): void
    {
        //etant donné que(given) un nouvel user
        $user = new User("motdepasse", "", "TestPseudo", "email", "10/08", "10/08");
        //quand(when) on appel la méthode getPassword
        $expected = "";
        //alors(then) on vérifie que password a été renvoyer
        $this->assertSame($expected, $user->getImgPath());
    }

    /** @test */
    public function getPseudo(): void
    {
        //etant donné que(given) un nouvel user
        $user = new User("motdepasse", "", "TestPseudo", "email", "10/08", "10/08");
        //quand(when) on appel la méthode getPassword
        $expected = "TestPseudo";
        //alors(then) on vérifie que password a été renvoyer
        $this->assertSame($expected, $user->getPseudo());
    }

    /** @test */
    public function getEmail(): void
    {
        //etant donné que(given) un nouvel user
        $user = new User("motdepasse", "", "TestPseudo", "email", "10/08", "10/08");
        //quand(when) on appel la méthode getPassword
        $expected = "email";
        //alors(then) on vérifie que password a été renvoyer
        $this->assertSame($expected, $user->getEmail());
    }

    /** @test */
    public function getDateFirstCo(): void
    {
        //etant donné que(given) un nouvel user
        $user = new User("motdepasse", "", "TestPseudo", "email", "10/08", "10/08");
        //quand(when) on appel la méthode getPassword
        $expected = "10/08";
        //alors(then) on vérifie que password a été renvoyer
        $this->assertSame($expected, $user->getDateFirstCo());
    }

    /** @test */
    public function getDateLastCo(): void
    {
        //etant donné que(given) un nouvel user
        $user = new User("motdepasse", "", "TestPseudo", "email", "10/08", "12/06");
        //quand(when) on appel la méthode getPassword
        $expected = "12/06";
        //alors(then) on vérifie que password a été renvoyer
        $this->assertSame($expected, $user->getDateLastCo());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->SessionActiveMock = new SessionActive();
    }

    /** @test */
    public function user_is_delete_from_bd(): void
    {
        //etant donné un utilisateur
        //quand la methode delete_Utilisateur est appelé
        //then on vérifie que l'utilisateur a été supprimer de la bd
    }

    /** @test */
    public function user_is_updated_from_bd(): void
    {
        //etant donné un utilisateur
        //quand la methode modif_Utilisateur est appelé
        //alors on vérifie que l'utilisateur a été mis a jour dans la bd
    }
}
