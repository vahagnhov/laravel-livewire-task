<div>
    <form wire:submit.prevent="submitForm">
        <div class="row setup-content" id="step-2">
            <div class="col-xs-12">
                <div class="col-md-12">
                    <h3> Page 2</h3>

                    <div class="form-group">
                        <label>Are you married?</label><br/>
                        <label class="radio-inline"><input type="radio" wire:model="form.married" value="1"
                                                           wire:change="selectMarried(1)"> Yes</label>
                        <label class="radio-inline"><input type="radio" wire:model="form.married" value="0"
                                                           wire:change="selectMarried(0)"> No</label>
                        @error('form.married') <span class="error">{{ $message }}</span> @enderror
                    </div>

                @if($showMarriedInfo)
                    <!-- Add fields for married -->
                        <div class="form-group">
                            <label for="date_of_marriage">Date of Marriage:</label>
                            <div class="row">
                                <div class="col">
                                    <select wire:model="form.date_of_marriage_month" class="form-control">
                                        <option value="">Select Month</option>
                                        @foreach (range(1, 12) as $month)
                                            <option
                                                value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                                        @endforeach
                                    </select>
                                    @error('form.date_of_marriage_month') <span
                                        class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col">
                                    <select wire:model="form.date_of_marriage_day" class="form-control">
                                        <option value="">Select Day</option>
                                        @for ($day = 1; $day <= 31; $day++)
                                            <option value="{{ $day }}">{{ $day }}</option>
                                        @endfor
                                    </select>
                                    @error('form.date_of_marriage_day') <span
                                        class="error">{{ $message }}</span> @enderror
                                </div>
                                <div class="col">
                                    <select wire:model="form.date_of_marriage_year" class="form-control">
                                        <option value="">Select Year</option>
                                        @for ($year = date('Y'); $year >= date('Y') - 100; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                    @error('form.date_of_marriage_year') <span
                                        class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <input type="hidden" wire:model="marriageAge">
                            @error('marriageAge') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="marriage_country">Country of Marriage:</label>
                            <input type="text" wire:model="form.marriage_country" class="form-control">
                            @error('form.marriage_country') <span class="error">{{ $message }}</span> @enderror
                        </div>

                @else
                    <!-- Add fields for not married -->
                        <div class="form-group">
                            <label>Are you widowed?</label><br/>
                            <label class="radio-inline"><input type="radio" wire:model="form.widowed" value="1">
                                Yes</label>
                            <label class="radio-inline"><input type="radio" wire:model="form.widowed" value="0">
                                No</label>
                            @error('form.widowed') <span class="error">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label>Have you ever been married in the past?</label><br/>
                            <label class="radio-inline"><input type="radio" wire:model="form.previously_married"
                                                               value="1">
                                Yes</label>
                            <label class="radio-inline"><input type="radio" wire:model="form.previously_married"
                                                               value="0">
                                No</label>
                            @error('form.previously_married') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    <button wire:click="nextStep(1)" type="button">Previous</button>
                    <button type="submit">Submit</button>

                </div>
            </div>
        </div>
    </form>
</div>

