@extends('admin.admin_dashboard')
@section('admin')
@include('sweetalert::alert')

<div class="page-content">
    <nav class="page-breadcrumb">
        <div class="breadcrumb d-flex justify-content-between align-items-center">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Inventory</li>
            </ol>
        </div>
    </nav>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="all-tab" 
                        data-bs-toggle="tab" data-bs-target="#all" 
                        role="tab" aria-controls="all" aria-selected="true">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="in-tab" 
                        data-bs-toggle="tab" data-bs-target="#in" 
                        role="tab" aria-controls="in" aria-selected="false">Incoming</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="out-tab" 
                        data-bs-toggle="tab" data-bs-target="#out" 
                        role="tab" aria-controls="out" aria-selected="false">Out / Take</a>
                </li>
                <li class="nav-item">
                    {{-- <a class="nav-link disabled" id="process-tab"  --}}
                    <a class="nav-link" id="process-tab" 
                        data-bs-toggle="tab" data-bs-target="#process" 
                        {{-- role="tab" aria-controls="disabled"  --}}
                        role="tab" aria-controls="process" 
                        aria-selected="false">Processing</a>
                </li>
                </ul>
                <div class="tab-content border border-top-0 p-3" id="myTabContent">
                    <div class="tab-pane fade show active" 
                        id="all" role="tabpanel" aria-labelledby="all-tab">
                        <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Product</th>
                                <th>Type</th>
                                <th>Location</th>
                                <th>Vol (kg)</th>
                                <th>Size (cm)</th>
                                <th>Amount (qty)</th>
                                <th>Photo</th>
                                {{-- <th>Last Update</th> --}}
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($listProcessings as $key => $item)
                            <tr class="align-middle">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->nasabahs->user->name }} <br>
                                    {{ Str::mask($item->nasabahs->nokartu, '*',-20, 7) }}</td>
                                <td>{{ $item->types->nama }}</td>
                                <td>{{ $item->location_id }}</td>
                                <td>{{ $item->volume }}</td>
                                <td>{{ $item->ukuran }}</td>
                                <td>{{ $item->jumlah_produk }}</td>
                                <td>{{ $item->photo }}</td>
                                {{-- <td>{{ $item->created_at->format('d-m-Y H:i:s') }}</td> --}}
                                <td class="text-start">
                                    <img src="{{ url('/upload/images/'.$item->remark.'.png') }}"
                                            style="height: 50px;width:50px;" >
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
                    <div class="tab-pane fade" 
                        id="in" role="tabpanel" aria-labelledby="out-tab">INCOMING</div>
                    <div class="tab-pane fade" 
                        id="out" role="tabpanel" aria-labelledby="out-tab">OUTCOMING</div>
                    <div class="tab-pane fade" 
                        id="process" role="tabpanel" aria-labelledby="process-tab">PROCESSING</div>
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
        id = self.data('id');
        setInterval(function(){
            $.ajax({
                type:"GET",
                url:"/incomingwaste/scan",
                data: {
                    nokartu: nokartu,
                    id: id
                },
                dataType: 'json',
                success:function(data)
                {
                    $('#rfid').val(data.nokartu);
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