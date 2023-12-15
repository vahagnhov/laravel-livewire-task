<?php

namespace App\Livewire;

use Livewire\Component;

class MultiStepForm extends Component
{
    public $step = 1;

    public $dataFromStep1 = [];
    public $dataFromStep2 = [];

    protected $listeners = ['nextStep' => 'nextStep', 'dataPassedToStep2', 'dataPassedToStep1'];

    public function render()
    {
        return view('livewire.multi-step-form');
    }

    public function nextStep($step)
    {
        $this->step = $step;
    }

    public function dataPassedToStep1($data)
    {
        $this->dataFromStep2 = $data;
        $this->dispatch('dataPassedToStep1', $data);
    }

    public function dataPassedToStep2($data)
    {
        $this->dataFromStep1 = $data;
        $this->dispatch('dataPassedToStep2', $data);
    }
}
