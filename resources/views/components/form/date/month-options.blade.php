<option value="">Select Month</option>
@foreach (range(1, 12) as $month)
    <option value="{{ $month }}">{{ date('F', mktime(0, 0, 0, $month, 1)) }}</option>
@endforeach
