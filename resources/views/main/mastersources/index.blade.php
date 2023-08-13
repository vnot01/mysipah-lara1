@extends('admin.admin_dashboard')
@section('admin')
@include('sweetalert::alert')
<div class="page-content">
    <nav class="page-breadcrumb">
        <div class="breadcrumb d-flex justify-content-between align-items-center">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Lists of Sources</li>
            </ol>
            <button type="button" class="btn btn-primary btn-icon-text"
                data-bs-toggle="modal" data-bs-target="#modalNewIncoming"
                data-bs-whatever="@getbootstrap">
                <i class="btn-icon-prepend" data-feather="plus"></i>
                Create Sources</button>

                <div class="modal fade" id="modalNewIncoming"
                    tabindex="-1" aria-labelledby="modalNewIncomingLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalNewIncomingLabel">Add New Sources</h5>
                          <button type="button" class="btn-close"
                            data-bs-dismiss="modal" aria-label="btn-close"></button>
                        </div>
                        <form method="POST" action="{{ url('/all/sources/add') }}"
                            class="forms-sample"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="source_name" class="form-label">Source Name</label>
                                    <input type="text" class="form-control
                                        @error('source_name') is-invalid
                                        @enderror " value="{{ old('source_name', '')}}"
                                        id="source_name" name="source_name" autocomplete="off"
                                        placeholder="Leave Blank If Not Add New">
                                    @error('source_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
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

    <!-- Modal Update Barang-->
{{-- <div class="modal fade" id="modalUpdateBarang{{ $barang->kode_barang }}" tabindex="-1" aria-labelledby="modalUpdateBarang" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <!--FORM UPDATE BARANG-->
                <form action="/beranda-yo/{{ $barang->kode_barang }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="">Nama Barang</label>
                        <input type="text" class="form-control" id="updateNamaBarang" name="updateNamaBarang"
                        value="{{ $barang->nama_barang}}">
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Barang</label>
                        <input type="text" class="form-control" id="updateJumlahBarang" name="updateJumlahBarang"
                        value="{{ $barang->jumlah_barang}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui Data</button>
                </form>
                <!--END FORM UPDATE BARANG-->
            </div>
        </div>
    </div>
</div> --}}
<!-- End Modal UPDATE Barang-->
<div class="modal fade" id="modalEditSources"
tabindex="-1" aria-labelledby="modalEditSourcesLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditSourcesLabel">Edit Sources</h5>
                    <button type="button" class="btn-close"
                        data-bs-dismiss="modal" aria-label="btn-close"></button>
            </div>
            <form method="POST" action="{{ url('/all/sources/edit') }}" class="forms-sample"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                @method('put')
            <input type="hidden" class="form-control" id="source_id" name="source_id">
            <div class="modal-body">
                <div class="mb-3">
                    <label for="edit_source_name" class="form-label">Source Name</label>
                    {{-- <input type="text" value="{{ old('edit_source_name', '')}}"
                    id="edit_source_name" name="edit_source_name"> --}}
                    <input type="text" class="form-control @error('edit_source_name') is-invalid
                    @enderror " id="edit_source_name"
                    name="edit_source_name" placeholder="Enter Source Name" value="" required>
                    @error('edit_source_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table id="dataTableExample" class="table">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Sources</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($listSources as $key => $item)
                  <tr class="align-middle">
                    <td>{{ $key+1 }}</td>
                    <td>{{ $item->nama }}</td>
                    <td class="text-start">
                        <form onsubmit="return confirm('Are you sure ?');"
                            action="{{ route('delete.sources', $item->id) }}" method="POST">
                        {{-- <a href="javascript:void(0)" id="btn-edit-source"
                            data-id="{{ $item->id }}" class="btn btn-primary btn-sm">EDIT</a> --}}
                            <a href="javascript:void(0)" data-toggle="tooltip"
                                data-id="{{ $item->id }}" data-original-title="Edit"
                                class="btn btn-primary btn-sm editPost fa-regular fa-pen-to-square"></a>
                        {{-- <button type="button" class="btn btn-primary btn-sm btn-icon-text editPost"
                            id="btn-edit-source">
                            <i href="javascript:void(0)" data-toggle="tooltip"
                                data-id="{{ $item->id }}" data-original-title="Edit"
                                id="btn-edit-source"
                                class="btn-icon-prepend edit btn-sm"
                                data-feather="edit"></i>
                            EDIT</button> --}}
                        @csrf
                        @method('POST')
                        {{-- <button type="submit" class="btn btn-sm btn-danger">HAPUS</button> --}}
                        {{-- <a href="javascript:void(0)" data-toggle="tooltip"
                            data-id="{{ url('/all/sources/delete/$item->id') }}" data-original-title="Delete"
                            class="btn btn-danger btn-sm deletePost">Delete</a> --}}
                            <button type="submit" class="btn btn-sm btn-danger fa-regular fa-trash-can">
                                <i value="{{ $item->id }}" class="btn-icon-prepend"></i>
                            </button>
                        </form>
                    </td>
                  </tr>
                  @empty
                    <div class="alert alert-danger">
                        No Data Available.
                    </div>
                  @endforelse
                </tbody>
              </table>
              {{-- {{ $source->links() }} --}}
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  {{-- @include('components.modal-edit-sources') --}}
@endsection

@push('js')
    <script type="text/javascript">
    //button create source event
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('body').on('click', '.editPost', function () {
        var source_id = $(this).data('id');
        //fetch detail source with ajax
        // alert(source_id);
        // $('#modalEditSources').modal('show');

        $.ajax({
            url: `/all/sources/edit/${source_id}`,
            type: "GET",
            cache: false,
            success:function(response){
                //fill data to form
                console.log(response.data.nama);
                console.log(response);
                //open modal
                $('#source_id').val(response.data.id);
                $('#edit_source_name').val(response.data.nama);
                $('#savedata').val("edit-user");
                // $('#id').val(response.data.id);
                // $('#name').val(response.data.name);
                $('#modalEditSources').modal('show');
            }
        });
    });

    // //action update source
    // $('#update').click(function(e) {
    //     e.preventDefault();
    //     //define variable
    //     let source_id = $('#source_id').val();
    //     let nama   = $('#name-edit').val();
    //     let token   = $("meta[name='csrf-token']").attr("content");
    //     //ajax
    //     $.ajax({

    //         url: `/edit/sources/${source_id}`,
    //         type: "PUT",
    //         cache: false,
    //         data: {
    //             "nama": title,
    //             "content": content,
    //             "_token": token
    //         },
    //         success:function(response){

    //             //show success message
    //             Swal.fire({
    //                 type: 'success',
    //                 icon: 'success',
    //                 title: `${response.message}`,
    //                 showConfirmButton: false,
    //                 timer: 3000
    //             });

    //             //data source
    //             let source = `
    //                 <tr id="index_${response.data.id}">
    //                     <td>${response.data.nama}</td>
    //                     <td class="text-center">
    //                         <a href="javascript:void(0)" id="btn-edit-source"
    //                             data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
    //                         <a href="javascript:void(0)" id="btn-delete-source"
    //                             data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
    //                     </td>
    //                 </tr>
    //             `;
    //             //append to source data
    //             $(`#index_${response.data.id}`).replaceWith(source);
    //             //close modal
    //             $('#modal-edit').modal('hide');

    //         },
    //         error:function(error){
    //             if(error.responseJSON.title[0]) {
    //                 //show alert
    //                 $('#alert-title-edit').removeClass('d-none');
    //                 $('#alert-title-edit').addClass('d-block');
    //                 //add message to alert
    //                 $('#alert-title-edit').html(error.responseJSON.title[0]);
    //             }

    //             if(error.responseJSON.content[0]) {
    //                 //show alert
    //                 $('#alert-content-edit').removeClass('d-none');
    //                 $('#alert-content-edit').addClass('d-block');
    //                 //add message to alert
    //                 $('#alert-content-edit').html(error.responseJSON.content[0]);
    //             }
    //         }
    //     });
    // });

</script>
@endpush
