<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#addProjectForm').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    $(document).on('click', '.btnProjectStore', function (e) {
        e.preventDefault();
        $('.error-message').html('');
        $(this).prop("disabled", true);
        $(this).html('Gözləyin');
        let formData = new FormData(document.getElementById('addProjectForm'));

        $.ajax({
            type: "POST",
            url: "projects",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == "success") {
                    $("#addProjectModal").modal('hide');
                    $('.modal-backdrop').remove();
                    $("#addProjectForm").trigger('reset');
                    $('.btnProjectStore').prop("disabled", false).html('Yadda saxlayın');
                    $(".table_content").load(location.href + " .table_content");

                    toastr.success('Uğurlu!');
                }

            },
            error: function (error) {
                $('#nameError').html(error.responseJSON.errors.name);
                $('.btnProjectStore').prop("disabled", false).html('Yadda saxlayın');
            }

        });
    });

    $(document).on('click', '.btnProjectEdit', function (e) {
        e.preventDefault();
        let project_id = $(this).data('id');

        $('#editProjectModal').modal('show');

        $.ajax({
            type: "GET",
            url: "projects/" + project_id + "/edit",
            success: function (response) {
                $('#project_id').val(project_id);
                $('#edit_name').val(response.name);
            }
        });
    });

    $(document).on('click', '.btnProjectUpdate', function (e) {
        e.preventDefault();

        let project_id = $('#project_id').val();
        $('.error-message').html('');
        $(this).prop("disabled", true);
        $(this).html('Gözləyin');

        let formData = new FormData(document.getElementById('editProjectForm'));

        $.ajax({
            type: "POST",
            url: "projects/" + project_id,
            data: formData,
            // cache: false,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    $('#editProjectModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $("#editProjectForm").trigger('reset');
                    $('.btnProjectUpdate').prop("disabled", false).html('Yadda saxlayın');

                    $(".table_content").load(location.href + " .table_content");

                    toastr.success('Uğurlu!');
                }
            },
            error: function (error) {
                $('#projectNameError').html(error.responseJSON.errors.name);
                $('.btnProjectUpdate').prop("disabled", false).html('Yadda saxlayın');
            }
        });
    });

    $(document).on('click', '.btnProjectDelete', function (e) {
        e.preventDefault();
        let project_id = $(this).data('id');
        Swal.fire({
            title: 'Əminsinizmi?',
            text: "Bunu geri qaytara bilməyəcəksiniz!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Bəli, sil!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'delete',
                    url: 'projects/' + project_id,
                    data:
                        {
                            _token: '{{ csrf_token() }}'
                        }
                    ,
                    async: false,
                    success: function (response) {
                        $("#row-" + project_id).remove();
                        toastr.success('Uğurlu!');
                    }
                });
            }
        })
    });


</script>
