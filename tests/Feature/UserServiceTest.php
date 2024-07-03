<?php

namespace Tests\Unit;

use App\Exports\UsersExport;
use App\Interfaces\UserRepositoryInterface;
use Tests\TestCase;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
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

        // Create instance of UserService with mocked dependency
        $this->userService = new UserService($this->userRepository);
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

    public function testExportUsersValidFormats()
    {
        // Arrange
        $validFormats = ['xlsx', 'csv', 'pdf'];

        foreach ($validFormats as $format) {
            // Mock repository method call
            $this->userRepository->shouldReceive('export')
                ->once()
                ->andReturn([]);

            // Mock Excel facade for download
            Excel::shouldReceive('download')
                ->once()
                ->withArgs(function (UsersExport $export, $filename) use ($format) {
                    // Assert filename matches expected pattern
                    $this->assertStringContainsString('users.', $filename);
                    $this->assertStringContainsString($format, $filename);
                    return true;
                })
                ->andReturn(new Response('dummy_export_file_content'));

            // Act
            $response = $this->userService->exportUsers($format);

            // Assert
            $this->assertInstanceOf(Response::class, $response);
            $this->assertEquals('dummy_export_file_content', $response->getContent());
        }
    }

    public function testExportUsersInvalidFormat()
    {
        // Mocking export method to return an empty array
        $this->userRepository->shouldReceive('export')
            ->andReturn([]);

        // Arrange
        // Assuming 'docx' is not a valid format
        $invalidFormat = 'docx';

        // Assert
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Invalid Format');

        // Act
        $this->userService->exportUsers($invalidFormat);
    }
}
