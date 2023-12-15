<div>
    <form wire:submit.prevent="next">
        <div class="row setup-content {{--{{ $currentPage != 1 ? 'displayNone' : '' }}--}}" id="step-1">
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
                                    <option value="">Select Month</option>
                                    @foreach (range(1, 12) as $month)
                                        <option
                                            value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
                                    @endforeach
                                </select>
                                @error('form.dob_month') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col">
                                <select wire:model="form.dob_day" class="form-control">
                                    <option value="">Select Day</option>
                                    @for ($day = 1; $day <= 31; $day++)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endfor
                                </select>
                                @error('form.dob_day') <span class="error">{{ $message }}</span> @enderror
                            </div>
                            <div class="col">
                                <select wire:model="form.dob_year" class="form-control">
                                    <option value="">Select Year</option>
                                    @for ($year = date('Y'); $year >= date('Y') - 100; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                                @error('form.dob_year') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit">Next</button>
                </div>
            </div>
        </div>
    </form>
</div>
