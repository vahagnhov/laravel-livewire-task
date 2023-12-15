<?php

namespace App\Livewire;

use App\Livewire\Forms\SubscriptionFirstStepRequestForm;
use App\Livewire\Forms\SubscriptionSecondStepRequestForm;
use App\Repositories\Interfaces\SubscriberRepositoryInterface;
use App\Rules\MarriageDateRule;
use Illuminate\View\View;
use Livewire\Component;

class SubscriberPagesForm extends Component
{
    public SubscriptionFirstStepRequestForm $form;
    public SubscriptionSecondStepRequestForm $formSecond;

    const FIRST_PAGE = 1;
    const SECOND_PAGE = 2;
    const THIRD_PAGE = 3;

    public $currentStep = self::FIRST_PAGE;
    public $marriageAge = '';
    public bool $showMarriedInfo = false;
    public $successMessage = '';
    private $subscriberRepository;

    /**
     * Boot the component, called after dependency injection.
     *
     * @param SubscriberRepositoryInterface $subscriberRepository
     * @return void
     */
    public function boot(SubscriberRepositoryInterface $subscriberRepository): void
    {
        // Set the subscriber repository for the component.
        $this->subscriberRepository = $subscriberRepository;
    }

    /**
     * Initialize the component.
     */
    public function mount(): void
    {
        $this->clearAllData();
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.subscriber-pages-form');
    }


    /**
     * Reset the fields related to a married subscriber.
     *
     * @return void
     */
    private function resetMarriedFields(): void
    {
        $this->marriageAge = '';
        $this->formSecond->date_of_marriage_month = '';
        $this->formSecond->date_of_marriage_day = '';
        $this->formSecond->date_of_marriage_year = '';
        $this->formSecond->marriage_country = '';
        $this->formSecond->widowed = false;
        $this->formSecond->previously_married = false;
    }

    /**
     * Handle the selection of the married status.
     *
     * @param  $selected
     * @return void
     */
    public function selectMarried($selected): void
    {
        if ($selected === 1) {
            $this->toggleMarried();
            $this->formSecond->married = true;
            $this->showMarriedInfo = true;
        } else {
            $this->resetNonMarriedData();
        }

    }

    /**
     * Toggle the display of married information.
     *
     * @return void
     */
    public function toggleMarried(): void
    {
        $this->showMarriedInfo = !$this->showMarriedInfo;
        if (!$this->showMarriedInfo) {
            $this->resetMarriedFields();
        }
    }

    /**
     * Reset data when the subscriber is not married.
     *
     * @return void
     */
    private function resetNonMarriedData(): void
    {
        $this->marriageAge = '';
        $this->showMarriedInfo = false;
        $this->formSecond->married = false;
        $this->formSecond->date_of_marriage_month = '';
        $this->formSecond->date_of_marriage_day = '';
        $this->formSecond->date_of_marriage_year = '';
        $this->formSecond->marriage_country = '';
        $this->formSecond->widowed = false;
        $this->formSecond->previously_married = false;
    }

    /**
     * Handle the submission of the first step form.
     *
     */
    public function firstStepSubmit(): void
    {
        $this->form->validate();
        $this->currentStep = self::SECOND_PAGE;
    }

    /**
     * Handle the submission of the second step form.
     *
     * @return void
     */
    public function secondStepSubmit(): void
    {
        $this->performValidation();
        $this->currentStep = self::THIRD_PAGE;
        $this->submitForm();
    }

    /**
     * Perform form validation based on the form's state.
     *
     */
    private function performValidation(): void
    {
        if ($this->formSecond->married) {
            $this->formSecond->validate();
            $this->validateMarriageAge();
        } else {
            $this->formSecond->validate();
        }
    }


    /**
     * Validate the age for a married subscriber.
     *
     * @return void
     */
    private function validateMarriageAge(): void
    {
        if ($this->formSecond->date_of_marriage_year
            && $this->formSecond->date_of_marriage_month
            && $this->formSecond->date_of_marriage_day) {

            $marriageAge = $this->calculateMarriageAge();

            if ($marriageAge < 18) {
                $this->validate();
            }

        }
    }

    /**
     * Calculate and set the marriage age based on the provided birth and marriage dates.
     *
     * @return int
     */
    private function calculateMarriageAge(): int
    {
        // Collect Birth date in Carbon format
        $date_of_birth = collectMysqlDateFormat(
            $this->form->dob_year,
            $this->form->dob_month,
            $this->form->dob_day);

        // Collect marriage date in Carbon format
        $date_of_marriage = collectMysqlDateFormat(
            $this->formSecond->date_of_marriage_year,
            $this->formSecond->date_of_marriage_month,
            $this->formSecond->date_of_marriage_day);

        // Calculate the age difference
        $marriageAge = $date_of_birth->diffInYears($date_of_marriage);
        // Set and return the marriage age
        return $this->marriageAge = $marriageAge;
    }

    /**
     * Handle the form submission.
     */
    public function submitForm()
    {
        try {
            $allStepsFormData = array_merge($this->form->toArray(), $this->formSecond->toArray());
            $this->subscriberRepository->createSubscriber($allStepsFormData);
            $this->successMessage = __('Subscriber Account Created Successfully.');

        } catch (\Exception $e) {
            // An error occurred, handle the exception and show an error message to the client
            $errorMessage = __('An error occurred while processing your request. Please try again.');
            // If it's a validation exception, show specific error messages
            if ($e instanceof \Illuminate\Validation\ValidationException) {
                $errorMessage = $e->errors()->first();
            }
            // Add an error message to Livewire
            $this->addError('submissionError', $errorMessage);
        }
    }

    /**
     * Previous step
     *
     * @param $step
     * @return void
     *
     */
    public function previous($step): void
    {
        $this->currentStep = $step;
    }

    /**
     * Clear all form data
     *
     * @return void
     */
    public function clearAllData(): void
    {
        $this->form->reset();
        $this->formSecond->reset();
        $this->resetData();
    }

    /**
     * Reset Data
     *
     * @return void
     */
    public function resetData(): void
    {
        $this->showMarriedInfo = false;
        $this->marriageAge = '';
        $this->successMessage = '';
        $this->subscriberRepository = '';
    }

    public function rules(): array
    {
        return [
            'marriageAge' => ['required_if:married,true|nullable|numeric', new MarriageDateRule],
        ];
    }

}
