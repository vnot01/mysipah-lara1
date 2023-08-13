@extends('admin.admin_dashboard')
@section('admin')
@include('sweetalert::alert')
<div class="page-content">

    <nav class="page-breadcrumb">
        <div class="breadcrumb d-flex justify-content-between align-items-center">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nasabah</li>
            </ol>
            <button type="button" class="btn btn-primary btn-icon-text"
                data-bs-toggle="modal" data-bs-target="#modalNewNasabah"
                data-bs-whatever="@getbootstrap">
                <i class="btn-icon-prepend" data-feather="plus"></i>
                New Nasabah</button>

                <div class="modal fade" id="modalNewNasabah"
                    tabindex="-1" aria-labelledby="modalNewNasabahLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalNewNasabahLabel">New Nasabah</h5>
                          <button type="button" class="btn-close"
                            data-bs-dismiss="modal" aria-label="btn-close"></button>
                        </div>
                        <form id='addNewNasabah' method="POST" action="{{ url('/nasabah/add') }}"
                            class="forms-sample"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                {{-- <div class="mb-3" name="nokartu" id="nokartu">
                                    @forelse($scanKartu as $item)
                                    <div class="form-group" align="center">
                                        <label>Scan Your RFID Card</label>
                                        <br>
                                        <img src="{{ url('/upload/rfid.gif') }}"
                                            style="height: 100px;width:100px;" >
                                        <br>
                                        {{-- <img src="{{ url('/upload/animasi2.gif') }}"
                                            style="width:100px;"> -- }}
                                        <input disabled type="text" name="nokartu" id="nokartu"
                                            placeholder="Tempelkan Kartu RFID" class="form-control"
                                            style="width: 200px;" value='{{ $item->nokartu }}'>
                                    </div>
                                    @endforeach
                                </div> --}}
                                <div class="mb-3" name="nokartu1" id="nokartu1">
                                    <div class="form-group" align="center">
                                        <label>Scan Your RFID Card</label>
                                        <br>
                                        <img src="{{ url('/upload/rfid.gif') }}"
                                            style="height: 100px;width:100px;" >
                                        <br>
                                    </div>
                                </div>
                                <div class="mb-3" name="nokartu" id="nokartu">
                                </div>
                                <div class="mb-3">
                                    <label for="nasabah-name" class="form-label">Nama Calon Nasabah</label>
                                    {{-- <select class="my-select2 form-select form-control" name="users_id">
                                        <option>Select Item</option>
                                        {{ $selectedID = '' }}
                                        @foreach ($userData as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ ( $key == $selectedID) ? 'selected' : '' }}>
                                                {{ $value->name }}
                                            </option>
                                        @endforeach
                                    </select> --}}
                                        {{-- @foreach ($userData as $key => $value) --}}
                                        <input type="text" class="form-control
                                            @error('rfid') is-invalid
                                            @enderror " value="{{ old('rfid', '')}}"
                                            id="rfid" name="rfid" autocomplete="off"
                                            placeholder="Leave Blank If Not Add New">
                                        {{-- @endforeach --}}

                                            @error('rfid')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    <select class="my-select2 form-select" name="users_id" data-width="100%">
                                        <option>Select Calon Nasabah</option>
                                        @foreach($userData as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table id="dataTableExample" class="table">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>ID Nasabah</th>
                    <th>Nama Nasabah</th>
                    <th>No Kartu</th>
                    <th>Photo</th>
                  </tr>
                </thead>
                <tbody>
                @forelse ($nasabahData as $key => $item)
                  <tr class="align-middle">
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->user->id }}</td>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->nokartu }}</td>
                    <td>
                        @if($item->user->photo)
                            <img src="{{ url('/upload/'.$item->user->photo) }}"
                                style="height: 35px;width:35px;">
                        @else
                            <span>No image found!</span>
                        @endif
                        {{-- {{ $item->user->photo }} --}}
                    </td>
                  </tr>
                @empty
                  <div class="alert alert-danger">
                      No Data Available.
                  </div>
                @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
{{-- <script type="text/javascript">
    $(document).ready(function() {
        alert('1');
        $("#nokartu").change(function(e) {
            alert('1');
            // $.ajax({
            //     alert('1');
            // });
        });

    });
</script> --}}
<script type="text/javascript">
    // $(document).ready(function(){
    //     setInterval(function(){
    //         // $("#nokartu").load('/nasabah/nokartu');
    //         $("#nokartu").load('/nasabah/scan');
    //         // $.GET('/nasabah/nokartu', function (data) {
    //         //     // $('#modalNewNasabah').html("User Details");
    //         //     // $('#modalNewNasabah').modal('show');
    //         //     $('#nokartu').val(data.nokartu);
    //         // })
    //     },1000);
    // });
    $(document).ready(function(){
        var self = $(this),
        nokartu = self.data('nokartu');
        id = self.data('id');
        // var target = self.data('target');
        setInterval(function(){
            $.ajax({
                type:"GET",
                url:"/nasabah/scan",
                data: {
                    nokartu: nokartu,
                    id: id
                },
                dataType: 'json',
                success:function(data)
                {
                    // var data1 = JSON.parse(data);
                    // for (i = 0; i < data1.length; i += 1)
                    // {
                    //     var record = data1[i];
                    //     console.log(record.nokartu);
                    // }
                    //do something with response data
                    // console.log(data);
                    $('#rfid').val(data.nokartu);
                }
            });
        },1000);
    });
    // $(document).on('change', '#nokartu',function(){
    // var testId = $(this).val();
    // console.log($(this).val());
    //     $.ajax({
    //         type:'GET',
    //         url:"{{ route('nokartu') }}",
    //         data:{'test_id':testId},
    //         success:function(data){
    //             console.log(data);
    //         }
    //     });
    // });
</script>
{{-- <script type="text/javascript">
    $(document).ready(function(){
        $('#nokartu').change(function(){
            var eid = $(this).val();
            // var csrf = $('#token').val();
            $.ajax({
                url : '/nasabah/nokartu',
                data : {rfid:nokartu},
                type : 'get'
            }).success(function(e){
                $('#rfid').val(e)
            })
        })
    });
</script> --}}
{{-- <script type="text/javascript">
    $(document).ready(function(){
        setInterval(function(){
            $("#nokartu").load('nokartu.php')
        },1000);
    });
</script> --}}
@endsection
