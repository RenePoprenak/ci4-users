<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------

    public array $patient = [
        'id' => 'permit_empty|is_natural_no_zero',
        'first_name' => 'required|min_length[2]|max_length[100]',
        'last_name'  => 'required|min_length[2]|max_length[100]',

        'birth_number' => 'required|regex_match[/^\d{9,10}$/]|is_unique[patients.birth_number,id,{id}]',

        'birth_date' => 'permit_empty|valid_date[Y-m-d]',
        'email'      => 'permit_empty|valid_email|max_length[190]',
        'phone'      => 'permit_empty|max_length[50]',

        'address_line1' => 'permit_empty|max_length[190]',
        'address_line2' => 'permit_empty|max_length[190]',
        'city'          => 'permit_empty|max_length[120]',
        'zip'           => 'permit_empty|max_length[20]',

        'note' => 'permit_empty',
    ];

    public array $patient_errors = [
        'birth_number' => [
            'required'    => 'Rodné číslo je povinné.',
            'regex_match' => 'Rodné číslo musí obsahovať 9 až 10 číslic (bez lomky).',
            'is_unique'   => 'Toto rodné číslo už existuje.',
        ],
    ];
}
