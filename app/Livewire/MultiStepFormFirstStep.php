<?php

namespace App\Livewire;

use App\Livewire\Forms\SubscriptionFirstStepRequestForm;
use Livewire\Component;

class MultiStepFormFirstStep extends Component
{
    public SubscriptionFirstStepRequestForm $form;

    public $dataFromStep2 = [];
    protected $listeners = ['dataPassedToStep1'];

    public function mount()
    {
        $this->dataFromStep2 = $this->dataFromStep2 ?? [];

    }

    public function render()
    {
        return view('livewire.multi-form-first-step');
    }

    public function next()
    {
        $this->form->validate();

        $this->dispatch('nextStep', 2);
        $this->dispatch('dataPassedToStep2', $this->form->toArray());

    }

    public function dataPassedToStep1()
    {
        $this->dispatch('dataPassedToStep2', $this->form->toArray());
    }
}
