<div class="btn-group">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Action
    </button>
    <ul class="dropdown-menu">
        <li>
            <a url="{!! route('csv.allUploadCsv',$model->id) !!}" method="post" params='{"a":1}' modal_size="xl" is_html="1" class="dropdown-item open_modal_class" href="">View CSV</a>
        </li>

    </ul>
</div>
