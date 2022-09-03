<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Licenses') }}
        </h2>
    </x-slot>
    <x-slot name="cardClass"></x-slot>
    <x-slot name="cardHeader">
        <div class="btn-group float-end" role="group" aria-label="Basic example">
            <a href="{!! route('licenses.create') !!}" class="btn btn-primary">Create</a>
        </div>
    </x-slot>
    <div class="form">
        @if(!empty(session('success')))
            <div class="alert alert-success mt-2 mb-2" id="success-alert">{!! session('success') !!}</div>
        @endif
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <div>{!! $dataTable->table(['class' => 'table table-condensed table-hover'], true) !!}</div>
    </div>
    <script src="{!! asset('js/datatable.js') !!}"></script>
    {!! $dataTable->scripts() !!}
</x-app-layout>
<script>
    $("#success-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
    });
</script>


