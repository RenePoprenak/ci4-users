<?php

namespace App\Models;

use CodeIgniter\Model;

class PatientModel extends Model
{
    protected $table            = 'patients';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';

    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;

    protected $allowedFields = [
        'first_name',
        'last_name',
        'birth_number',
        'birth_date', 
        'email',
        'phone',
        'address_line1',
        'address_line2',
        'city',
        'zip',
        'note',
    ];

    public function paginatedList(int $perPage = 15)
    {
        return $this->orderBy('last_name', 'ASC')
            ->orderBy('first_name', 'ASC')
            ->paginate($perPage);
    }
}