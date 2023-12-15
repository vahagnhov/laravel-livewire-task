<?php

namespace App\Livewire;

use App\Livewire\Forms\SubscriptionFirstStepRequestForm;
use App\Livewire\Forms\SubscriptionSecondStepRequestForm;
use App\Repositories\Interfaces\SubscriberRepositoryInterface;
use App\Rules\MarriageDateRule;
use Carbon\Carbon;
use Livewire\Component;

class MultiStepFormSecondStep extends Component
{
    public SubscriptionFirstStepRequestForm $formFirst;
    public SubscriptionSecondStepRequestForm $form;

    public bool $showMarriedInfo = false;
    public $successMessage = '';

    public $dataFromStep1 = [];

    protected $listeners = ['nextStep' => 'nextStep', 'dataPassedToStep2'];

    private $subscriberRepository;

    public function boot(SubscriberRepositoryInterface $subscriberRepository)
    {
        $this->subscriberRepository = $subscriberRepository;
    }

    public function mount()
    {
        $this->dataFromStep1 = $this->dataFromStep1 ?? [];
    }


    public function render()
    {
        return view('livewire.multi-step-second-form');
    }

    public function nextStep($step)
    {
        $this->form->validate();
        $this->dispatch('nextStep', $step);
        $this->dispatch('dataPassedToStep1', $this->form->toArray());

    }

    public function dataPassedToStep2()
    {
        $this->dispatch('dataPassedToStep1', $this->form->toArray());
    }


    public function submitForm()
    {
        $this->dispatch('nextStep', 3);
        $this->secondStepSubmit();
        $subscriber = $this->subscriberRepository->createSubscriber($this->form);

        $this->form->reset();

        $this->currentStep = 1;
        session()->flash('successMessage', __('Subscriber Account Created Successfully.'));
        session()->flash('subscriber', $subscriber);
        return redirect()->to('/form-submitted');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function secondStepSubmit()
    {
        if ($this->form->married) {
            $this->form->validate();

            if ($this->form->date_of_marriage_year && $this->form->date_of_marriage_month && $this->form->date_of_marriage_day) {
                //In helper
                $carbon_date_birth = Carbon::create($this->formFirst->dob_year, $this->formFirst->dob_month, $this->formFirst->dob_day);
                $carbon_date_marriage = Carbon::create($this->form->date_of_marriage_year, $this->form->date_of_marriage_month, $this->form->date_of_marriage_day);

                $marriageAge = $carbon_date_birth->diffInYears($carbon_date_marriage);
                $this->marriageAge = $marriageAge;
                if ($marriageAge < 18) {

                    $this->validate([
                        'marriageAge' => ['required_if:married,true|nullable|numeric', new MarriageDateRule],
                    ]);
                }

            }
        } else {
            $this->form->validate();
        }

        $this->currentStep = 3;
    }

    public function toggleMarried()
    {
        $this->showMarriedInfo = !$this->showMarriedInfo;
    }

    public function selectMarried($selected)
    {
        if ($selected === 1) {
            $this->form->married = true;
            $this->showMarriedInfo = true;
        } else {

            $this->marriageAge = '';
            $this->showMarriedInfo = false;

            $this->form->married = false;
            $this->form->date_of_marriage_month = '';
            $this->form->date_of_marriage_day = '';
            $this->form->date_of_marriage_year = '';
            $this->form->marriage_country = '';
            $this->form->widowed = false;
            $this->form->previously_married = false;
        }
    }
}
