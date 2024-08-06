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
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.btnModalShow', function (e) {
        e.preventDefault();
        $("#addFolderModal").modal('show');
    })

    $('#addFolderForm').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    $(document).on('click', '.btnClearFilter', function (e) {
        e.preventDefault();
        $("#name").val("")
        $("#startDate").val("")
        $("#endDate").val("")
        $("#folderFilter").submit();
    })

    $(document).on('click', '.btnFolderStore', function (e) {
        e.preventDefault();
        $('.error-message').html('');
        $(this).prop("disabled", true);
        let formData = new FormData(document.getElementById('addFolderForm'));

        $.ajax({
            type: "POST",
            url: "folders",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == "success") {
                    $("#addFolderModal").modal('hide');
                    $('.modal-backdrop').remove();
                    $("#addFolderForm").trigger('reset');
                    $('.btnFolderStore').prop("disabled", false).html('Yadda saxlayın');

                    $(".table_content").load(location.href + " .table_content");

                    toastr.success('Uğurlu!');
                }
            },
            error: function (error) {
                $('#nameError').html(error.responseJSON.errors.name);
                $('#dateError').html(error.responseJSON.errors.date);
                $('.btnFolderStore').prop("disabled", false).html('Yadda saxlayın')
            }

        });
    });

    $(document).on('click', '.btnFolderEdit', function (e) {
        e.preventDefault();
        let folder_id = $(this).data('id');
        $('#editFolderModal').modal('show');

        $.ajax({
            type: "GET",
            url: "folders/" + folder_id + "/edit",
            success: function (response) {
                $('#folder_id').val(folder_id);
                $('#edit_name').val(response.name);
                $('#edit_date').val(response.date);
                // $('#edit_project_id').val(response.project_id);
            },
            error: function (response) {
                console.log(response)
            }
        });
    });

    $(document).on('click', '.btnFolderUpdate', function (e) {
        e.preventDefault();

        let folder_id = $('#folder_id').val();
        $('.error-message').html('');
        $(this).prop("disabled", true);
        $(this).html('Gözləyin');
        let formData = new FormData(document.getElementById('editFolderForm'));

        $.ajax({
            type: "POST",
            url: "folders/" + folder_id,
            data: formData,
            // cache: false,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    $('#editFolderModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $("#editFolderForm").trigger('reset');
                    $('.btnFolderUpdate').prop("disabled", false).html('Yadda saxlayın');
                    $(".table_content").load(location.href + " .table_content");

                    toastr.success('Uğurlu!');
                }
            },
            error: function (error) {
                $('#folderNameError').html(error.responseJSON.errors.name);
                $('#folderProjectIDError').html(error.responseJSON.errors.project_id);
                $('.btnFolderUpdate').prop("disabled", false).html('Yadda saxlayın');
            }
        });
    });

    $(document).on('click', '.btnFolderDelete', function (e) {
        e.preventDefault();
        let folder_id = $(this).data('id');
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
                    url: 'folders/' + folder_id,
                    data:
                        {
                            _token: '{{ csrf_token() }}'
                        }
                    ,
                    async: false,
                    success: function (response) {
                        $("#row-" + folder_id).remove();
                        toastr.success('Uğurlu!');
                    }
                });
            }
        })
    });


</script>
