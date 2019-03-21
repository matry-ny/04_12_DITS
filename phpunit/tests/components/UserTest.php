<?php

namespace phpunit\tests\components;

use components\db\Query;
use components\User;
use PDOStatement;
use PHPUnit\Framework\TestCase;

/**
 * Class UserTest
 * @package phpunit\tests\components
 */
class UserTest extends TestCase
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var array
     */
    private $userData = [];

    public function setUp()
    {
        $this->user = new User();
        $this->userData = [
            'name' => 'Unit Test',
            'login' => 'test',
            'password' => password_hash('qwerty', PASSWORD_BCRYPT )
        ];
    }

    public function testAuth()
    {
        $this->doLogin();

        $userData = $this->userData;
        unset($userData['password']);
        $this->assertEquals($userData, $this->user->getUserData());
    }

    public function testLogout()
    {
        $this->doLogin();

        $this->user->logout();
        $this->assertTrue($this->user->getIsGuest());
        $this->assertEmpty($this->user->getUserData());
    }

    private function doLogin()
    {
        $sqlMock = $this->createMock(PDOStatement::class);
        $sqlMock->method('fetch')->willReturn($this->userData);

        $queryMock = $this->createMock(Query::class);
        $queryMock
            ->method('prepare')
            ->with('SELECT * FROM users WHERE login = :login')
            ->willReturn($sqlMock);

        $this->user->setQueryBuilder($queryMock);

        $this->assertTrue($this->user->getIsGuest());
        $this->user->auth('test', 'qwerty');
        $this->assertFalse($this->user->getIsGuest());
    }
}
