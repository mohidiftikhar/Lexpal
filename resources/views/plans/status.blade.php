<?php $client    =   \App\Models\Plan::find($model->id)?>
@php
if($client->status == 'active'){
@endphp
<span type="button" class="btn-success p-3 rounded">Active</span>
@php
    }
@endphp
@php
    if($client->status == 'inactive'){
@endphp
<span type="button" class="btn-danger p-3 rounded">InActive</span>
@php
}
@endphp

{{--{!! ($client->status) !!}--}}


