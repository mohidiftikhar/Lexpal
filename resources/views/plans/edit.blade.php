<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Plan') }}
        </h2>
    </x-slot>
    <x-slot name="cardClass"></x-slot>
    <x-slot name="cardHeader">
        <div class="btn-group float-end" role="group" aria-label="Basic example">
            <a href="{!! route('plans.index') !!}" class="btn btn-primary">All Plans</a>
        </div>
    </x-slot>
    <div class="form">
        @if(!empty(session('warning')))
            <div class="alert alert-warning mt-2 mb-2">{!! session('warning') !!}</div>
        @endif
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <form action="{!! route('plans.update',$plan->id) !!}" method="post" id="form" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Plan Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{$plan->name??old('name')}}"><br>
            </div>
            <div class="form-group">
                <label for="price">Plan Price</label>
                <input type="number" step="any" class="form-control" name="price" id="price" placeholder="Enter price" value="{{$plan->price??old('price')}}"><br>
            </div>
            <div class="form-group">
                <label for="currency">Plan Currency</label>
                <input type="text" class="form-control" name="currency" id="currency" placeholder="Enter currency" value="{{$plan->currency??old('currency')}}"><br>
            </div>
            <div class="form-group">
                <label for="plan_duration">Plan Duration</label>
                <input type="text" class="form-control" name="plan_duration" id="plan_duration" placeholder="Enter duration" value="{{$plan->plan_duration??old('plan_duration')}}"><br>
            </div>
            <div class="form-group">
                <label class="form-label">Device</label>
                <select name="duration_period" id="" class="form-select">
                    <option value="week" @if($plan->duration_period == 'week') selected @endif>Week</option>
                    <option value="month" @if($plan->duration_period == 'month') selected @endif>Month</option>
                    <option value="year" @if($plan->duration_period == 'year') selected @endif>Year</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="content">Content</label>
                <a class=" btn btn-primary" onclick="appendText('add')">Include</a>
                <a class=" btn btn-primary" onclick="appendText('remove')">Not Include</a><br><br>
                <textarea name="content" placeholder="Enter plan content" id="editor">{{$plan->content??old('content')}}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" id="" class="form-select">
                    <option value="active" @if($plan->status == 'active') selected @endif>Active</option>
                    <option value="inactive" @if($plan->status == 'inactive') selected @endif>In Active</option>
                </select>
            </div>
            <br>
            <button class="btn btn-primary upload_btn" type="submit">Save</button>
        </form>

    </div>

    <script>
        var editor1 = CKEDITOR.replace('editor', {
            allowedContent: 'i h1 h2 h3 style strong(*);' +
                'a[!href];' +
                'img(left,right)[!src,alt,width,height];' +
                'table tr th td caption;' +
                'span{!font-family};' +
                'span{!color};' +
                'span(!marker);' +
                'del ins;'+
                '*[class];'+
                '*[id];',
            height: 460,
            removeButtons: 'PasteFromWord'
        });

        editor1.on('instanceReady', function() {
            // Output self-closing tags the HTML4 way, like <br>.
            this.dataProcessor.writer.selfClosingEnd = '>';
            CKEDITOR.dtd.$removeEmpty['i'] = true;
            // Use line breaks for block elements, tables, and lists.
            var dtd = CKEDITOR.dtd;
            for (var e in CKEDITOR.tools.extend({}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent)) {
                this.dataProcessor.writer.setRules(e, {
                    indent: false,
                    breakBeforeOpen: true,
                    breakAfterOpen: false,
                    breakBeforeClose: true,
                    breakAfterClose: false
                });
            }
            // Start in source mode.
            this.setMode('source');
        });
    </script>
    <script>
        function appendText(text){
            if(text === 'add'){
                var value = CKEDITOR.instances['editor'].getData();
                var add = '<p><i class="far fa-check"></i></p><br>';
                var data = value + '' + add;
                CKEDITOR.instances['editor'].updateElement();
                CKEDITOR.instances['editor'].setData(data);
                // $('#editor').val(value + '' + add);
            }
            else if(text === 'remove'){
                var value = CKEDITOR.instances['editor'].getData();
                var remove = '<p><i class="far fa-times"></i></p><br>';
                var data = value + '' + remove;
                CKEDITOR.instances['editor'].updateElement();
                CKEDITOR.instances['editor'].setData(data);
            }
        }
    </script>
</x-app-layout>
