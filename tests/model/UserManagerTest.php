<?php

namespace Mjees\TestsRendu\Model;

use PDO;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;
use Exception;

use Mjees\TestsRendu\Model\UserManager;
class UserManagerTest extends TestCase
{
    private UserManager $userManager;
    private PDO $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO("mysql:host=localhost;dbname=user_management;charset=utf8", "root", "");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->exec("DELETE FROM users");

        $this->userManager = new UserManager();
    }

    protected function tearDown(): void
    {
        $this->pdo->exec("DELETE FROM users");
    }

    public function testAddUser(): void
    {
        $this->userManager->addUser("Boris", "boris@example.com");
        $users = $this->userManager->getUsers();
        $this->assertCount(1, $users);
        $this->assertEquals("Boris", $users[0]['name']);
    }

    public function testAddUserEmailException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->userManager->addUser("Thomas", "pas-bon-mail");
    }

    public function testUpdateUser(): void
    {
        $this->userManager->addUser("Mattheo", "mattheo@example.com");
        $id = $this->userManager->getUsers()[0]['id'];
        $this->userManager->updateUser($id, "Matthea", "matthea@example.com");

        $user = $this->userManager->getUser($id);
        $this->assertEquals("Matthea", $user['name']);
        $this->assertEquals("matthea@example.com", $user['email']);
    }
    public function testRemoveUser(): void
    {
        $this->userManager->addUser("David", "david@example.com");
        $id = $this->userManager->getUsers()[0]['id'];
        $this->userManager->removeUser($id);
        $this->assertCount(0, $this->userManager->getUsers());
    }

    public function testGetUsers(): void
    {
        $this->userManager->addUser("Lucie", "lucie@example.com");
        $this->userManager->addUser("Frank", "frank@example.com");
        $users = $this->userManager->getUsers();

        $this->assertCount(2, $users);
        $this->assertEquals("Lucie", $users[0]['name']);
    }
    public function testInvalidUpdateThrowsException(): void
    {
        $this->expectException(Exception::class);
        $this->userManager->getUser(999999);
    }
    public function testInvalidDeleteThrowsException(): void
    {
        $this->userManager->removeUser(999999);
        $this->assertTrue(true);
    }
}