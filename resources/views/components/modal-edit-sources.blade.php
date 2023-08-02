<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT Source</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="source_id">
                <div class="form-group">
                    <label for="name" class="control-label">Name</label>
                    <input type="text" class="form-control" id="name-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name-edit"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
                <button type="button" class="btn btn-primary" id="update">UPDATE</button>
            </div>
        </div>
    </div>
</div>

<script>
    //button create source event
    $('body').on('click', '#btn-edit-source', function () {
        let source_id = $(this).data('id');
        //fetch detail source with ajax
        $.ajax({
            url: `/sources/${source_id}`,
            type: "GET",
            cache: false,
            success:function(response){
                //fill data to form
                $('#source_id').val(response.data.id);
                $('#name-edit').val(response.data.nama);
                //open modal
                $('#modal-edit').modal('show');
            }
        });
    });

    //action update source
    $('#update').click(function(e) {
        e.preventDefault();
        //define variable
        let source_id = $('#source_id').val();
        let nama   = $('#name-edit').val();
        let token   = $("meta[name='csrf-token']").attr("content");
        //ajax
        $.ajax({

            url: `/sources/${source_id}`,
            type: "PUT",
            cache: false,
            data: {
                "nama": title,
                "content": content,
                "_token": token
            },
            success:function(response){

                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                //data source
                let source = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.nama}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-source"
                                data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-source"
                                data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;
                //append to source data
                $(`#index_${response.data.id}`).replaceWith(source);
                //close modal
                $('#modal-edit').modal('hide');

            },
            error:function(error){
                if(error.responseJSON.title[0]) {
                    //show alert
                    $('#alert-title-edit').removeClass('d-none');
                    $('#alert-title-edit').addClass('d-block');
                    //add message to alert
                    $('#alert-title-edit').html(error.responseJSON.title[0]);
                }

                if(error.responseJSON.content[0]) {
                    //show alert
                    $('#alert-content-edit').removeClass('d-none');
                    $('#alert-content-edit').addClass('d-block');
                    //add message to alert
                    $('#alert-content-edit').html(error.responseJSON.content[0]);
                }
            }
        });
    });

</script>
