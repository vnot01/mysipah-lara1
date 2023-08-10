@extends('admin.admin_dashboard')
@section('admin')
@include('sweetalert::alert')

<div class="page-content">
    <div class="row profile-body">
        <div class="card rounded">
            <div class="card-body">
                <h6 class="card-title">Add New Products</h6>
                <form method="POST" action="{{ route('store.products') }}" class="forms-sample"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="product_name" class="form-label">Product Name</label>
                            <input type="text" class="form-control
                                @error('product_name') is-invalid
                                @enderror " value="{{ old('product_name', '')}}"
                                id="product_name" name="product_name" autocomplete="off"
                                placeholder="Leave Blank If Not Add New">
                            @error('product_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                    <button type="submit" class="btn btn-primary me-2 btn-icon-text">
                        <i class="btn-icon-prepend" data-feather="save"></i>
                        SAVE
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
