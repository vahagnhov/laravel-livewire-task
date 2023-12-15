<option value="">Select Year</option>
@for ($year = date('Y'); $year >= date('Y') - 100; $year--)
    <option value="{{ $year }}">{{ $year }}</option>
@endfor
