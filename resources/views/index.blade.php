<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('partials.header')
<body>
<div class="container mt-5">
    <div class="row mt-5 justify-content-center">
        <div class="mt-5 col-md-8">
            <div class="card">
                <div class="card-header bg-success">
                    <h2 class="text-white">Laravel 10 Livewire 3 Multi Step Form</h2>
                </div>
                <div class="card-body">
                    @livewire('subscriber-pages-form')
                </div>
            </div>
        </div>
    </div>
</div>
@livewireScripts
</body>
</html>
