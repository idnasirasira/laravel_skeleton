<?php

namespace App\Exports;

use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UsersExport implements FromCollection, WithHeadings, WithMapping
{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->users;
    }

    public function headings(): array
    {
        return [
            '#',
            'User',
            'Date',
        ];
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            Carbon::parse($user->created_at)->format('Y-m-d H:i:s'),
        ];
    }
}
