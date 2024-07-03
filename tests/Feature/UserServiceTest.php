<?php

namespace Tests\Unit;

use App\Interfaces\UserRepositoryInterface;
use Tests\TestCase;
use App\Models\User;
use App\Services\UserService;
use Mockery;

class UserServiceTest extends TestCase
{
    protected $userService;
    protected $userRepository;
    protected $notificationService;

    public function setUp(): void
    {
        parent::setUp();

        // Mock UserRepositoryInterface
        $this->userRepository = Mockery::mock(UserRepositoryInterface::class);

        // Create instance of UserService with mocked dependencies
        $this->userService = new UserService($this->userRepository, $this->notificationService);
    }

    public function testCreateUser()
    {
        // Arrange
        $userData = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => bcrypt('password'),
        ];

        // Mock repository method call
        $this->userRepository->shouldReceive('create')
            ->once()
            ->andReturn(new User($userData));

        // Act
        $createdUser = $this->userService->createUser($userData);

        // Assert
        $this->assertInstanceOf(User::class, $createdUser);
        $this->assertEquals($userData['name'], $createdUser->name);
        $this->assertEquals($userData['email'], $createdUser->email);
    }


    public function testGetUserById()
    {
        // Arrange
        $userId = 1;
        $userData = [
            'id' => $userId,
            'name' => 'Jane',
            'email' => 'jane.doe@example.com',
            'password' => bcrypt('password'),
        ];

        // Mock repository method call
        $this->userRepository->shouldReceive('find')
            ->with($userId)
            ->once()
            ->andReturn(new User($userData));

        // Act
        $user = $this->userService->getUserById($userId);

        // Assert
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($userData['name'], $user->name);
        $this->assertEquals($userData['email'], $user->email);
    }
}
