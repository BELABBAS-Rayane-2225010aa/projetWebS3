<?php
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
    public function test_GetPassword(): void
    {
        //etant donné que(given) un nouvel user
        $user = new User("motdepasse","","TestPseudo","email","10/08","10/08");
        //quand(when) on appel la méthode getPassword
        $expected = "motdepasse";
        //alors(then) on vérifie que password a été renvoyer
        $this->assertSame($expected,$user->getPassword());
    }
}
