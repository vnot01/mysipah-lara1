@extends('admin.admin_dashboard')
@section('admin')
@include('sweetalert::alert')

<div class="page-content">
    <div class="row profile-body">
        <div class="card rounded">
            <div class="card-body">
                <h6 class="card-title">Add New Manufactures</h6>
                <form method="POST" action="{{ route('store.manufacturess') }}" class="forms-sample"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="manufacture_name" class="form-label">Manufacture Name</label>
                            <input type="text" class="form-control
                                @error('manufacture_name') is-invalid
                                @enderror " value="{{ old('manufacture_name', '')}}"
                                id="manufacture_name" name="manufacture_name" autocomplete="off"
                                placeholder="Leave Blank If Not Add New">
                            @error('manufacture_name')
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
