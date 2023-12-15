<option value="">Select Day</option>
@for ($day = 1; $day <= 31; $day++)
    <option value="{{ $day }}">{{ $day }}</option>
@endfor
