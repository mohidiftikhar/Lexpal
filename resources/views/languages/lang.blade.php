<?php $lang_1    =   \App\Models\LangFlag::find($model->lang_1)?>
<?php $lang_2    =   \App\Models\LangFlag::find($model->lang_2)?>

{!! strtolower($lang_1->lang_name."_".$lang_2->lang_name) !!}
