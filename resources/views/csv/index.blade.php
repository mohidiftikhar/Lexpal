<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-slot name="cardClass"></x-slot>
    <x-slot name="cardHeader">
        <div class="btn-group float-end" role="group" aria-label="Basic example">
            <a href="{!! route('csv.create') !!}" class="btn btn-primary">Upload CSV</a>
        </div>
    </x-slot>
    <div class="form">
        {!! $dataTable->table(['class' => 'table table-condensed table-hover'], true) !!}
    </div>
    <script src="{!! asset('js/datatable.js') !!}"></script>
    {!! $dataTable->scripts() !!}
</x-app-layout>


