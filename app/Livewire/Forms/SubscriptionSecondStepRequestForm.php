<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class SubscriptionSecondStepRequestForm extends Form
{
    #[Rule('required')]
    public bool $married = false;

    #[Rule('required_if:married,true')]
    public $marriage_country;

    #[Rule('required_if:married,true|nullable|numeric|between:1,12')]
    public $date_of_marriage_month;

    #[Rule('required_if:married,true|nullable|numeric|between:1,31')]
    public $date_of_marriage_day;

    #[Rule('required_if:married,true|nullable|numeric')]
    public $date_of_marriage_year;

    #[Rule('required_if:married,false|boolean')]
    public bool $widowed = false;

    #[Rule('required_if:married,false|boolean')]
    public bool $previously_married = false;

}
