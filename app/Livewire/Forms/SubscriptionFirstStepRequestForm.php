<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class SubscriptionFirstStepRequestForm extends Form
{
    #[Rule('required|string|max:255')]
    public string $first_name = '';

    #[Rule('required|string|max:255')]
    public string $last_name = '';

    #[Rule('required|string|max:255')]
    public string $address = '';

    #[Rule('required|string|max:255')]
    public string $city = '';

    #[Rule('required|string|max:255')]
    public string $country = '';

    #[Rule('required|numeric|between:1,12')]
    public $dob_month;

    #[Rule('required|numeric|between:1,31')]
    public $dob_day;

    #[Rule('required|numeric')]
    public $dob_year;

}
