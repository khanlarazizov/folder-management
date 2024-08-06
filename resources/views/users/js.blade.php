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

    $('#addUserForm').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });

    $(document).on('click', '.btnUserStore', function (event) {
        event.preventDefault();
        $('.error-message').html('');
        $(this).prop("disabled", true);
        $(this).html('Gözləyin');
        let formData = new FormData(document.getElementById('addUserForm'));

        $.ajax({
            type: 'POST',
            url: 'users',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    $('#addUserModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $("#addUserForm").trigger('reset');
                    $('.btnUserStore').prop("disabled", false).html('Yadda saxlayın');
                    $(".table_content").load(location.href + " .table_content");
                }
            },
            error: function (error) {
                $('#nameError').html(error.responseJSON.errors.name)
                $('#emailError').html(error.responseJSON.errors.email)
                $('#passwordError').html(error.responseJSON.errors.password)
                $('.btnUserStore').prop("disabled", false).html('Yadda saxlayın')
            }
        })
    })

    $(document).on('click', '.btnUserEdit', function (event) {
        event.preventDefault();
        let user_id = $(this).data('id');

        $('#editUserModal').modal('show');

        $.ajax({
            type: 'GET',
            url: 'users/' + user_id + '/edit',
            success: function (response) {
                console.log(response.password);
                $('#user_id').val(user_id);
                $('#edit_name').val(response.name);
                $('#edit_email').val(response.email);
                $('#edit_password').val(response.password);
            }
        });
    })

    $(document).on('click', '.btnUserUpdate', function (event) {
        event.preventDefault();
        let user_id = $('#user_id').val();
        $('.error-message').html('');
        $(this).prop("disabled", true);
        $(this).html('Gözləyin');
        let formData = new FormData(document.getElementById('editUserForm'));

        $.ajax({
            type: 'POST',
            url: 'users/' + user_id,
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    $('#editUserModal').modal('hide');
                    $('.modal-backdrop').remove();
                    $("#editUserForm").trigger('reset');
                    $('.btnUserUpdate').prop("disabled", false).html('Yadda saxlayın');

                    $(".table_content").load(location.href + " .table_content");

                    toastr.success('Uğurlu!');
                }
            },
            error: function (error) {
                $('#edit_nameError').html(error.responseJSON.errors.name);
                $('#edit_emailError').html(error.responseJSON.errors.email);
                $('#edit_passwordError').html(error.responseJSON.errors.password);
                $('.btnUserUpdate').prop("disabled", false).html('Yadda saxlayın');
            }
        })
    })

    $(document).on('click', '.btnUserDelete', function (event) {
        event.preventDefault()
        let user_id = $(this).data('id');
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
                    url: 'users/' + user_id,
                    data:
                        {
                            _token: '{{ csrf_token() }}'
                        }
                    ,
                    async: false,
                    data:
                        {
                            _token: '{{ csrf_token() }}'
                        }
                    ,
                    success: function (response) {
                        $("#row-" + user_id).remove();
                        toastr.success('Uğurlu!');
                    }
                });
            }
        })

    })
</script>
