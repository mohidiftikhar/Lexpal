<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit License') }}
        </h2>
    </x-slot>
    <x-slot name="cardClass"></x-slot>
    <x-slot name="cardHeader">
        <div class="btn-group float-end" role="group" aria-label="Basic example">
            <a href="{!! route('licenses.index') !!}" class="btn btn-primary">All Licenses</a>
        </div>
    </x-slot>
    <div class="form">
        @if(!empty(session('warning')))
            <div class="alert alert-warning mt-2 mb-2">{!! session('warning') !!}</div>
        @endif
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
            <form action="{!! route('licenses.update', $license->id) !!}" method="post" id="form" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">License Form</label>
                <select name="social_type" id="" class="form-select" >
                    <option value="google" @if($license->social_type == 'google') selected @endif>Google</option>
                    <option value="azure" @if($license->social_type == 'azure') selected @endif>Azure</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Product</label>
                <select name="product_id" id="product_id" class="form-select">
                    @foreach($products as $product)
                        <option value="{{$product->id}}"
                        @if($product->id == $license->product_id)
                        selected = "selected"
                            @endif>{{$product->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="domain">Domain Name</label>
                <input type="text" class="form-control" name="domain_name" id="domain" placeholder="Enter domain" value="{{$license->domain_name??old('domain')}}"><br>
            </div>
            <div class="form-group">
                <label for="contract_id">Contract ID</label>
                <input type="text" class="form-control" name="contract_id" id="contract_id" placeholder="Enter contract_id" value="{{$license->contract_id??old('contract_id')}}"><br>
            </div>
            <div class="form-group">
                <label for="name">Client Name</label>
                <input type="text" class="form-control" name="client_name" id="client_name" placeholder="Enter name" value="{{$license->client_name??old('client_name')}}"><br>
            </div>
            <div class="form-group">
                <label for="exp_date">Expiry Date</label>
                <input type="date" class="form-control" name="expiry_date" id="exp_date" placeholder="Enter Expiry Date" value="{{$license->expiry_date??old('exp_date')}}"><br>
            </div>
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" id="" class="form-select">
                    <option value="active" @if($license->status == 'active') selected @endif>Active</option>
                    <option value="inactive" @if($license->status == 'inactive') selected @endif>In Active</option>
                </select>
            </div>
            <br>
            <button class="btn btn-primary upload_btn" type="submit">Update</button>
        </form>
    </div>
</x-app-layout>
<script language="javascript">
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;
    $('#exp_date').attr('min',today);
</script>
