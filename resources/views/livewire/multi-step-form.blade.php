<div>
    <h1>{{$step}}</h1>
    @if($step === 1)
        @livewire('multi-step-form-step1')
    @elseif($step === 2)
        @livewire('multi-step-form-step2')
    @else
        <div>
            <h1>Form Submitted Successfully</h1>
        </div>
    @endif
</div>
