@if(\Illuminate\Support\Facades\File::exists(public_path($model->csv_path)))
<a style="text-decoration: none" href="{!! url($model->csv_path) !!}">Download CSV</a>
@else
    N/A
@endif

