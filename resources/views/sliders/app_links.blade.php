<?php $apps    =   \App\Models\Slider::find($model->id)?>

@foreach($apps->appLinks as $link)
{!! ($link->appHeading->heading) !!} ,
@endforeach
