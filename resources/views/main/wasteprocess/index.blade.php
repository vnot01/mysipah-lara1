@extends('admin.admin_dashboard')
@section('admin')
@include('sweetalert::alert')

<div class="page-content">

    <nav class="page-breadcrumb">
        <div class="breadcrumb d-flex justify-content-between align-items-center">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Waste Process</li>
            </ol>
            <button type="button" class="btn btn-primary btn-icon-text"
                data-bs-toggle="modal" data-bs-target="#modalNewIncoming"
                data-bs-whatever="@getbootstrap">
                <i class="btn-icon-prepend" data-feather="plus"></i>
                New Waste Process</button>
                <div class="modal fade" id="modalNewIncoming"
                    tabindex="-1" aria-labelledby="modalNewIncomingLabel" aria-hidden="true">
                    {{-- <div class="modal-dialog modal-dialog-scrollable"> --}}
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalNewIncomingLabel">New Waste Process</h5>
                          <button type="button" class="btn-close"
                            data-bs-dismiss="modal" aria-label="btn-close"></button>
                        </div>
                        <form id='addNewIncoming' method="POST" action="{{ url('/incomingwaste/add') }}"
                            class="forms-sample"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="sources-name" class="form-label">Sources Waste</label>
                                    <select class="my-select2 form-select" name="source_id" data-width="100%">
                                        @forelse ($listSources as $key => $item_source)
                                        <option name="source_id" value="{{ $item_source->id }}">{{ $item_source->nama }}</option>
                                        @empty
                                        <div class="alert alert-danger">
                                            <option value="-1">No Data Available.</option>
                                        </div>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="types-name" class="form-label">Types Waste</label>
                                    <select class="my-select2 form-select" id="type_id"
                                        name="type_id" data-width="100%">
                                        @forelse ($listTypes as $key => $item_Types)
                                        <option name="type_id" value="{{ $item_Types->id }}"
                                            data-nama="{{ $item_Types->nama }}">{{ $item_Types->nama }}</option>
                                        @empty
                                        <div class="alert alert-danger">
                                            <option value="-1">No Data Available.</option>
                                        </div>
                                        @endforelse
                                    </select>
                                    <input name="type_name" id="type_name" type="hidden" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="manufactures-name" class="form-label">Manufactures Waste</label>
                                    <select class="my-select2 form-select" name="manufacture_id" data-width="100%">
                                        @forelse ($listManufactures as $key => $item_Manufactures)
                                        <option name="manufacture_id" value="{{ $item_Manufactures->id }}">{{ $item_Manufactures->nama }}</option>
                                        @empty
                                        <div class="alert alert-danger">
                                            <option value="-1">No Data Available.</option>
                                        </div>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="volume" class="form-label">Volume (kg)</label>
                                        <input type="text" class="form-control
                                            @error('volume') is-invalid
                                            @enderror " value="{{ old('volume', '')}}"
                                            id="volume" name="volume" autocomplete="off"
                                            placeholder="Leave Blank If Not Add New">
                                            @error('volume')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
            {{-- <h6 class="card-title"><a href="{{ route('admin.dashboard') }}">Waste Process</h6> --}}
            <div class="table-responsive">
              <table id="dataTableExample" class="table">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Product</th>
                    <th>Type</th>
                    {{-- <th>Location</th> --}}
                    <th>Vol (kg)</th>
                    <th>Size (cm)</th>
                    <th>Amount (qty)</th>
                    <th>Photo</th>
                    {{-- <th>Last Update</th> --}}
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($listProcessingsStatus as $key => $item)
                    <tr class="align-middle">
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item->products->nama }} <br>
                        <td>{{ $item->processings->types->nama }}</td>
                        {{-- <td>{{ $item->location_id }}</td> --}}
                        <td>{{ $item->volume }}</td>
                        <td>{{ $item->processings->ukuran }}</td>
                        <td>{{ $item->processings->jumlah_produk }}</td>
                        {{-- <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td> --}}
                        <td class="text-start">
                            @if(!empty($item->photo))
                                <img src="{{ url('/upload/images/products/'.$item->processings->photo.'.png') }}">
                            @else
                                <img src="{{ url('/upload/images/products/no_image.jpg') }}">
                            @endif
                            {{-- <img src="{{ url('/upload/images/products'.$item->processings->photo.'.png') }}"
                                    style="height: 50px;width:50px;" > --}}
                        </td>
                        <td class="text-start">
                            <div class="d-grid gap-2">
                            @if ($item->status == 0)
                                <button type="button" class="btn btn-danger"
                                    data-bs-dismiss="modal" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-title="Click to Change Status Finish">
                                    On Process</button>

                            @else
                                <button type="button" class="btn btn-success"
                                    data-bs-dismiss="modal" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-title="Click to Change Status"
                                    disabled>Finish</button>

                            @endif
                            </div>
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
    $(document).ready(function(){
        var self = $(this),
        nokartu = self.data('nokartu');
        // id = self.data('id');
        // id = self.data('id');
        volume = self.data('volume');
        setInterval(function(){
            $.ajax({
                type:"GET",
                url:"/incomingwaste/scan",
                data: {
                    nokartu: nokartu,
                    volume: volume
                },
                dataType: 'json',
                success:function(data)
                {
                    $('#rfid').val(data.nokartu);
                    $('#volume').val(data.volume);
                }
            });
        },1000);

        $('#type_id').on('change',function(){
            var typeName = $(this).children('option:selected').data('nama');
            $('#type_name').val(typeName);
        });
    });

</script>

@endsection
