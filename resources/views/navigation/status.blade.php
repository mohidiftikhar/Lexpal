<?php $nav_item    =   \App\Models\NavigationBar::find($model->id)?>
@php
if($nav_item->status == 'active'){
@endphp
<span type="button" class="btn-success p-3 rounded">Active</span>
@php
    }
@endphp
@php
    if($nav_item->status == 'deactive'){
@endphp
<span type="button" class="btn-danger p-3 rounded">Deactive</span>
@php
}
@endphp

{{--{!! ($client->status) !!}--}}


