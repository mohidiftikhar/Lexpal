<?php $question    =   \App\Models\Question::find($model->id)?>
{!! strip_tags($question->question) !!}
