<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<div class="btn-group">
    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
        Action
    </button>
    <ul class="dropdown-menu">
        <li>
            <a class="dropdown-item btn btn-xs" href="{!! route('plans.edit',$model->id) !!}">Edit</a>
            <form method="POST" action="{!!route('plans.delete',$model->id) !!}">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button type="submit" class=" dropdown-item btn btn-xs btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button>
            </form>
            <a class="dropdown-item btn btn-xs" href="{!!route('plans.change',$model->id) !!}">Change Status</a>
        </li>

    </ul>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
    $('.show_confirm').click(function(event) {
        var form =  $(this).closest("form");
        event.preventDefault();
        swal({
            title: `Are you sure you want to delete?`,
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    form.submit();
                }
            });
    });
</script>
