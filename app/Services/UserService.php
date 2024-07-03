<?php

namespace App\Services;

use App\Exports\UsersExport;
use App\Interfaces\UserRepositoryInterface;
use Maatwebsite\Excel\Facades\Excel;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->all();
    }

    public function getUserById($id)
    {
        return $this->userRepository->find($id);
    }

    public function createUser(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function updateUser($id, array $data)
    {
        return $this->userRepository->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }

    function exportUsers($format)
    {
        $validFormats = ['xlsx', 'csv', 'pdf'];

        if (!in_array($format, $validFormats)) {
            throw new \Exception('Invalid Format');
        }

        if ($format == 'pdf') {
            // TODO: Implement Export To PDF
        }

        $filename =  'Users_export_' . date('Y_m_d_H_i_s') . '.' . $format;

        $users = $this->userRepository->export();

        return Excel::download(new UsersExport($users), $filename);
    }
}
