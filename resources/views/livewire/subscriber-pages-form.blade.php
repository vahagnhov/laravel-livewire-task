<div>
    @if(!empty($successMessage))
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
    @endif

    @if($errors->has('submissionError'))
        <div class="alert alert-danger">
            {{ $errors->first('submissionError') }}
        </div>
    @endif

    <div
        class="row setup-content {{ $currentStep != \App\Livewire\SubscriberPagesForm::FIRST_PAGE ? 'displayNone' : '' }}"
        id="step-1">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Page 1</h3>

                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" wire:model="form.first_name" class="form-control">
                    @error('form.first_name') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" wire:model="form.last_name" class="form-control">
                    @error('form.last_name') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" wire:model="form.address" class="form-control">
                    @error('form.address') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" wire:model="form.city" class="form-control">
                    @error('form.city') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="country">Country:</label>
                    <input type="text" wire:model="form.country" class="form-control">
                    @error('form.country') <span class="error">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label>Date of Birth:</label>
                    <div class="row">
                        <div class="col">
                            <select wire:model="form.dob_month" class="form-control">
                                @include('components.form.date.month-options')
                            </select>
                            @error('form.dob_month') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col">
                            <select wire:model="form.dob_day" class="form-control">
                                @include('components.form.date.day-options')
                            </select>
                            @error('form.dob_day') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="col">
                            <select wire:model="form.dob_year" class="form-control">
                                @include('components.form.date.year-options')
                            </select>
                            @error('form.dob_year') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary nextBtn btn-lg pull-right" wire:click="firstStepSubmit" type="button">
                    Next
                </button>
            </div>
        </div>
    </div>

    <div
        class="row setup-content {{ $currentStep != \App\Livewire\SubscriberPagesForm::SECOND_PAGE ? 'displayNone' : '' }}"
        id="step-2">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Page 2</h3>

                <div class="form-group">
                    <label>Are you married?</label><br/>
                    <label class="radio-inline"><input type="radio" wire:model="formSecond.married" value="1"
                                                       wire:change="selectMarried(1)"> Yes</label>
                    <label class="radio-inline"><input type="radio" wire:model="formSecond.married" value="0"
                                                       wire:change="selectMarried(0)"> No</label>
                    @error('formSecond.married') <span class="error">{{ $message }}</span> @enderror
                </div>

            @if($showMarriedInfo)
                <!-- Add fields for married -->
                    <div class="form-group">
                        <label for="date_of_marriage">Date of Marriage:</label>
                        <div class="row">
                            <div class="col">
                                <select wire:model="formSecond.date_of_marriage_month" class="form-control">
                                    @include('components.form.date.month-options')
                                </select>
                                @error('formSecond.date_of_marriage_month') <span
                                    class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col">
                                <select wire:model="formSecond.date_of_marriage_day" class="form-control">
                                    @include('components.form.date.day-options')
                                </select>
                                @error('formSecond.date_of_marriage_day') <span
                                    class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col">
                                <select wire:model="formSecond.date_of_marriage_year" class="form-control">
                                    @include('components.form.date.year-options')
                                </select>
                                @error('formSecond.date_of_marriage_year') <span
                                    class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <input type="hidden" wire:model="marriageAge">
                        @error('marriageAge') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="marriage_country">Country of Marriage:</label>
                        <input type="text" wire:model="formSecond.marriage_country" class="form-control">
                        @error('formSecond.marriage_country') <span class="error">{{ $message }}</span> @enderror
                    </div>

            @else
                <!-- Add fields for not married -->
                    <div class="form-group">
                        <label>Are you widowed?</label><br/>
                        <label class="radio-inline"><input type="radio" wire:model="formSecond.widowed" value="1">
                            Yes</label>
                        <label class="radio-inline"><input type="radio" wire:model="formSecond.widowed" value="0">
                            No</label>
                        @error('formSecond.widowed') <span class="error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>Have you ever been married in the past?</label><br/>
                        <label class="radio-inline"><input type="radio" wire:model="formSecond.previously_married"
                                                           value="1">
                            Yes</label>
                        <label class="radio-inline"><input type="radio" wire:model="formSecond.previously_married"
                                                           value="0">
                            No</label>
                        @error('formSecond.previously_married') <span class="error">{{ $message }}</span> @enderror
                    </div>
                @endif

                <button class="btn btn-danger nextBtn btn-lg pull-right" type="button" wire:click="previous(1)">
                    Previous
                </button>
                <button class="btn btn-success btn-lg pull-right" wire:click="secondStepSubmit" type="button">
                    Submit
                </button>
            </div>
        </div>
    </div>

    <div
        class="row setup-content {{ $currentStep != \App\Livewire\SubscriberPagesForm::THIRD_PAGE ? 'displayNone' : '' }}"
        id="step-3">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3> Result</h3>
                <h3>First Name: {{ $form->first_name }}</h3>
                <h3>Last Name: {{ $form->last_name }}</h3>
                <h3>Address: {{ $form->address }}</h3>
                <h3>City: {{ $form->city }}</h3>
                <h3>Country: {{ $form->country }}</h3>

                <h3>Date of Birth:
                    @if (!empty($form->dob_month) && !empty($form->dob_day) && !empty($form->dob_year))
                        {{ $form->dob_month }}/{{ $form->dob_day }}/{{ $form->dob_year }}
                    @else
                        N/A
                    @endif
                </h3>

                <h3>Married:
                    @if ($formSecond->married)
                        Yes
                    @else
                        No
                    @endif
                </h3>

                @if ($formSecond->married)
                    <h3>Date of Marriage:
                        @if (!empty($formSecond->date_of_marriage_month) && !empty($formSecond->date_of_marriage_day) && !empty($formSecond->date_of_marriage_year))
                            {{ $formSecond->date_of_marriage_month }}/{{ $formSecond->date_of_marriage_day }}
                            /{{ $formSecond->date_of_marriage_year }}
                        @else
                            N/A
                        @endif
                    </h3>
                    <h3>Country of Marriage: {{ $formSecond->marriage_country }}</h3>
                @else
                    <h3>Widowed:
                        @if ($formSecond->widowed)
                            Yes
                        @else
                            No
                        @endif
                    </h3>

                    <h3>Previously Married:
                        @if ($formSecond->previously_married)
                            Yes
                        @else
                            No
                        @endif
                    </h3>
                @endif

            </div>
        </div>
    </div>
</div>


