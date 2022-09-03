<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-slot name="cardClass"></x-slot>
    <x-slot name="cardHeader">
        <div class="btn-group float-end" role="group" aria-label="Basic example">
            <a href="{!! route('csv.index') !!}" class="btn btn-primary">All CSV</a>
        </div>
    </x-slot>
    <div class="form">
        <form action="{!! route('csv.store') !!}" method="post" id="form">
            @csrf
            <div class="mb-3">
                <label class="form-label">Select a Language</label>
                <select name="language_id" class="form-select">
                    @foreach($languages as $row)
                    <option value="{!! $row->id !!}">{!! $row->from !!} to {!! $row->to !!}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Csv File</label>
                <input id="upload_csv" name="csv_path" class="form-control" type="file" id="formFile" value="{{old('csv_path')}}">
            </div>

            <div id="upload_progress">
                <div class="progress mb-3">
                    <div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <button class="btn btn-primary upload_btn" type="button">Save</button>
        </form>

    </div>
    <script>
        $(document).ready(function(){
            $('#upload_progress').hide();
            $('body').on('click','.upload_btn',function (){
                $('#upload_progress').show();
                var $this        =   $(this);
                var form = $('#form')[0];
                var fd = new FormData(form);
                fd.language_id   =   $('select[name="language_id"] option:selected').val();
                fd._token   =   $('input[name="_token"]').val();
                var files   =   (document.getElementById('upload_csv').files[0]);
                var url         =   $('#form').attr('action');
                $.ajax({
                    url: url,
                    beforeSend: function(){
                      //  $this.button("loading");
                        $(".upload_btn").prop('disabled',true);
                    },
                    xhr: function() {
                        var xhr = new XMLHttpRequest();
                        var total = 0;
                        $.each(document.getElementById('upload_csv').files, function(i, file) {
                            total += file.size;
                        });
                        xhr.upload.addEventListener("progress", function(evt) {
                            var loaded = (evt.loaded / total).toFixed(2)*100;
                            var file_size   =   Number(evt.loaded).toFixed(2);
                            $("#upload_progress .progress-bar"). attr("aria-valuenow",Math.round(file_size));
                            $("#upload_progress .progress-bar .sr-only"). text(Math.round(loaded)+"% upload");
                            $("#upload_progress .progress-bar"). css({
                                width:Math.round(loaded)+"%"
                            });
                            $("#upload_progress .progress-bar"). attr("aria-valuemax",Math.round(total));

                        }, false);

                        return xhr;
                    },
                    type: 'post',
                    processData: false,
                    contentType: false,
                    data: fd,
                    success: function(data) {
                        $(".upload_btn").prop('disabled',false);
                        $("#upload_progress .progress-bar"). css({
                            width:Math.round(0)+"%"
                        });
                        $('#upload_progress').hide();
                        window.location.href='{!! route('csv.index') !!}';
                    }
                });
            });
        });
    </script>
</x-app-layout>
