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
                        <div class="modal-body">
                          <form>
                              <div class="mb-3" id="norfid"></div>
                              <div class="mb-3">
                                @foreach($scanKartu as $item)
                                <label for="nokartu" class="form-label">No Kartu RFID:</label>
                                <input type="text" name="nokartu" id="nokartu" placeholder="Tempelkan Kartu RFID"
                                    class="form-control"
                                    style="width: 200px;" value="{{ $item->nokartu }}">
                                @endforeach
                                {{-- <label for="message-text" class="form-label">Message:</label>
                                <textarea class="form-control" id="message-text"></textarea> --}}
                              </div>
                              <div class="mb-3">
                                <label for="sources-name" class="form-label">Nama Nasabah</label>
                                <select class="my-select2 form-select" data-width="100%">
                                    @foreach($userData as $item)
                                        <option value='{{ $item->id }}'>{{ $item->name }}</option>
                                    @endforeach
                                    {{-- <option value="TX">Texas</option>
                                    <option value="NY">New York</option>
                                    <option value="FL">Florida</option>
                                    <option value="KN">Kansas</option>
                                    <option value="HW">Hawaii</option> --}}
                                </select>
                              </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save</button>
                        </div>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#nokartu').change(function(e) {
            var cnic = $(this).val();
            $.ajax({
                type: "GET",
                url: "/nasabah/scan",
                data: {'nokartu':cnic},
                dataType: 'json',
                success : function(data) {
                    $('#nokartu').val(data.nokartu);
                },
                error: function(response) {
                    alert(response.responseJSON.message);
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        setInterval(function(){
            $("#norfid").load('nokartu.php')
        },1000);
    });
</script>
@endsection
