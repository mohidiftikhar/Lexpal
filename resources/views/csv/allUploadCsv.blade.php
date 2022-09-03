<div class="modal-header">
    <h5 class="modal-title">View CSV</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="form">
        {!! $dataTable->table(['class' => 'table table-condensed table-hover'], true) !!}
    </div>
    {!! $dataTable->scripts() !!}
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
