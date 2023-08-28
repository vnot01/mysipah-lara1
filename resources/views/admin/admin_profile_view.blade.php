@extends('admin.admin_dashboard')
@section('admin')
@include('sweetalert::alert')
<div class="page-content">
    <div class="row profile-body">
        <!-- left wrapper start -->
        <div class="d-none d-md-block col-md-4 col-xl-4 left-wrapper">
            <div class="card rounded mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="position-relative">
                            <div>
                                <img class="wd-100 rounded-circle"
                                    src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}"
                                    alt="profile">
                                <span class="h4 ms-3">{{ $profileData->username }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Name:</label>
                        <p class="text-muted">{{ $profileData->name }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                        <p class="text-muted">{{ $profileData->email }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Phone:</label>
                        <p class="text-muted">{{ $profileData->phone }}</p>
                    </div>
                    <div class="mt-3">
                        <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
                        <p class="text-muted">{{ $profileData->address }}</p>
                    </div>
                    {{-- <div class="mt-3">
              <label class="tx-11 fw-bolder mb-0 text-uppercase">Address:</label>
              <Address>{{ $profileData->address }}</Address>
                </div> --}}
                {{-- <div class="mt-3 d-flex social-links">
                    <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                        <i data-feather="github"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                        <i data-feather="twitter"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-icon border btn-xs me-2">
                        <i data-feather="instagram"></i>
                    </a>
                </div> --}}
            </div>
        </div>

        <div class="card rounded">
            <div class="card-body">
                <h6 class="card-title">CHANGE PASSWORD</h6>
                <form method="POST" action="{{ route('admin.change.password') }}" class="forms-sample"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="old_password" class="form-label">Old Password</label>
                        <input type="password" class="form-control @error('old_password') is-invalid @enderror "
                            id="old_password" name="old_password" autocomplete="off"
                            placeholder="Leave Blank If Not Changes">
                        @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror "
                            id="new_password" name="new_password" autocomplete="off"
                            placeholder="Leave Blank If Not Changes">
                        @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="new_password_confirmation"
                            name="new_password_confirmation" autocomplete="off" placeholder="Confirm Your New Password">
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Update Your Password</button>
                </form>
            </div>
        </div>
    </div>

    <!-- left wrapper end -->
    <!-- middle wrapper start -->
    <div class="col-md-8 col-xl-8 middle-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">UPDATE PROFILE</h6>
                        <form method="POST" action="{{ route('admin.profile.store') }}" class="forms-sample"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" autocomplete="off"
                                    placeholder="Username" value="{{ $profileData->username }}">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" autocomplete="on"
                                    placeholder="Name" value="{{ $profileData->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                    value="{{ $profileData->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="phone" class="form-control" id="phone" name="phone"
                                    placeholder="Phone Number" value="{{ $profileData->phone }}">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea id="address" name="address" class="form-control"
                                    placeholder="Address">{{ $profileData->address }}</textarea>
                                {{-- <input type="text" class="form-control" id="aa" name="aa"
                    placeholder="Phone Number" value="{{ public_path('upload/admin_images/').$profileData->photo }}">
                                --}}
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="formFile">Photo Upload</label>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="mb-2">
                                            <img id="showImage" class="wd-80 rounded-circle"
                                                src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/no_image.jpg') }}"
                                                alt="profile">
                                        </div>
                                    </div><!-- Col -->
                                    <div class="col-sm-10 align-self-center">
                                        <div class="mb-2">
                                            <input class="form-control" type="file"
                                                accept="image/png,image/jpeg" name="image" id="image">
                                        </div>
                                    </div><!-- Col -->
                                </div><!-- Row -->
                            </div>
                            <button type="submit" class="btn btn-primary me-2">Update Your Changes</button>
                        </form>

                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">Token Key (API Key)</h6>
                            <form method="POST" action="{{ route('admin.profile.membuatToken') }}" class="forms-sample"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="token_name" class="form-label">Token Name</label>
                                    <input type="text" class="form-control" id="token_name" name="token_name"
                                        placeholder="Your Token Name" value="{{ $profileData->username.'-token' }}">
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary me-2">Create New Token</button>
                                </div>
                            </form>
                            {{-- <form method="POST" action="{{ route('admin.profile.membuatToken') }}"
                            class="forms-sample"
                            enctype="multipart/form-data">
                            @csrf --}}
                            <div class="table-responsive">
                                <table id="dataTableExample" class="table">
                                    <thead>
                                        <tr>
                                            <th style="vertical-align : middle;text-align:center;">API TOKENS</th>
                                            <th style="vertical-align : middle;text-align:center;">TYPE</th>
                                            <th style="vertical-align : middle;text-align:center;" colspan="2">ACTION
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($listTokens as $a)
                                        <form action="{{ route('admin.profile.token.hapus', $a->id) }}"
                                            method="POST">
                                            {{-- @csrf @method('POST') --}}
                                            <tr>
                                                <td style="vertical-align : middle;text-align:center;">
                                                    <input type="text" class="form-control" value="{{ $a->api_tokens }}"
                                                        id="{{ $a->id }}-{{$a->api_tokens}}" name="api_tokens" readonly>
                                                    <input type="text" class="form-control" value="{{ $a->id }}"
                                                        id="{{ $a->id }}-{{$a->api_tokens}}" name="id_token" readonly>
                                                </td>
                                                <td style="vertical-align : middle;text-align:center;">
                                                    {{ $a->token_type }}
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-info btn-icon"
                                                        onclick="CopyToClipboard('{{ $a->id }}-{{$a->api_tokens}}')"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Copy Token to Clipboard">
                                                        <i data-feather="clipboard"></i>
                                                    </button>
                                                    {{-- <button class="btn btn-primary"
                                                    onclick="showSwal('passing-parameter-execute-cancel')">Click
                                                    here!</button> --}}

                                                </td>
                                                <td class="text-center">
                                                    {{-- <form method="post"  --}}
                                                    {{-- action="{{url('admin/removeCategory')}}/{{$product->id}}"> --}}
                                                    {{-- <form onsubmit="return confirm('Are you sure?');"
                                                action="{{ route('admin.profile.token.hapus', $a->id) }}"
                                                    method="POST">

                                                    @csrf @method('POST')--}}
                                                    {{-- <button type="submit" class="btn btn-sm btn-danger">
                                                        DELETE
                                                    </button> --}}
                                                    @csrf @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                                        class="btn btn-danger btn-icon" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="Delete Token">
                                                        <i data-feather="trash-2"></i>
                                                    </button>
                                                    {{-- </form>                                                 --}}
                                                </td>
                                            </tr>

                                            @empty
                                            <div class="alert alert-danger">
                                                Data Not Available.
                                            </div>
                                            @endforelse
                                        </form>
                                        {{-- {{ $listTokens->links() }} --}}
                                    </tbody>
                                </table>
                                {!! $listTokens->withQueryString()->links('pagination::bootstrap-5') !!}
                                {{-- {{ $listTokens->links() }}
                            </form> --}}
                            </div>
                           {{-- {{ $listTokens->links() }} --}}
                            {{-- </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- middle wrapper end -->
</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>

<script>
    function CopyToClipboard(element) {
        // const copyBtn = document.getElementById('copyBtn')
        const copyText1 = document.getElementById(element)
        copyText1.select();
        copyText1.setSelectionRange(0, 99999); /* For mobile devices */
        document.execCommand('copy'); // Simply copies the selected text to clipboard
        Swal.fire({ //displays a pop up with sweetalert
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'Text copied to clipboard',
            showConfirmButton: false,
            timerProgressBar: true,
            timer: 1500
        });
        // const Toast = Swal.mixin({
        //     toast: true,
        //     position: 'top-end',
        //     showConfirmButton: false,
        //     timer: 1500,
        //     timerProgressBar: true,
        // });

        // Toast.fire({
        //     icon: 'success',
        //     title: 'Text copied to clipboard'
        // })
        console.log('Text copied to clipboard');
    }

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

</script>

@endsection
