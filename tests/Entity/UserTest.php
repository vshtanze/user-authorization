<?php declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\User;
use App\Security\AppCustomAuthenticator;
use App\Tests\EntityTestCase;

class UserTest extends EntityTestCase
{
    /** @var User */
    protected $entity;

    public function setParams(): void
    {
        $this->params = [
            'setUsername' => 'test user',
            'setPassword' => 'testPassword',
            'setRoles'    => [AppCustomAuthenticator::ROLE_USER, AppCustomAuthenticator::ROLE_ADMIN],
        ];
    }

    protected function setUp(): void
    {
        $this->entity = new User();
    }
}
