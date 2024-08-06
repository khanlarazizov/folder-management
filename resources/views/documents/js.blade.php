<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.1/jquery.min.js"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>--}}

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>

<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('change', '#file', function (event) {
        event.preventDefault();
        $('#file_name').html('Fayl yüklənir');
        let formData = new FormData(document.getElementById('addDocumentForm'))
        $.ajax({
            url: '/fileUpload',
            method: 'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    console.log('uploaded');
                    $('#uploaded_file').val(response.file);
                    $('#file_name').html('Fayl uğurla yükləndi!');
                }
            },
            error: function (error) {
                $('#file_name').html('Xəta baş verdi');
                alert(error.responseJSON.errors.file);
            }
        });
    })

    $(document).on('change', '#edit_file', function (event) {
        event.preventDefault();
        $('#edit_file_name').html('Fayl yüklənir');
        $(".fa-download").remove();
        let formData = new FormData(document.getElementById('editDocumentForm'));
        let document_id = $("#document_id").val();
        $.ajax({
            url: '/fileUpdate/' + document_id,
            method: 'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == 'success') {
                    // console.log('uploaded');
                    // console.log(response.file);
                    $('#edit_uploaded_file').val(response.file);
                    $('#edit_file_name').html('Fayl uğurla yükləndi!');
                }
            },
            error: function (err) {
                $('#file_name').html('Xəta baş verdi');
                alert(error.responseJSON.errors.file);
            }
        });
    })

    $('.select2').select2({
        maximumSelectionLength: 10
    });

    $('.checkperson').click(function () {
        if ($(this).is(':checked')) {
            $('.textperson').attr('disabled', true);
            $('.textperson').val("");
        } else {
            $('.textperson').removeAttr('disabled');
            $('.textperson').focus();
        }
    });

    $(document).on('change', '#contract_id', function (event) {
        event.preventDefault();

        var contractID = this.value;
        $('#addition_id').html('');

        $.ajax({
            url: "{{ route('get.addition') }}",
            type: 'POST',
            dataType: 'json',
            data: {
                contract_id: contractID,
                _token: "{{csrf_token()}}"
            },
            success: function (response) {
                $('#addition_id').html('<option value="">Əlavə seç</option>');
                $.each(response.additions, function (index, value) {
                    $('#addition_id').append('<option value="' + value.id + '">' + value.number + '</option>');
                });
            }
        });
    });

    $(document).on('click', '.btnClearFilter', function (event) {
        event.preventDefault();
        $("#number").val("");
        $("#contract_id").val("");
        $("#startDate").val("");
        $("#endDate").val("");
        $("#price").val("");
        $("#currency").val("");
        $("#document_type").val("");
        $("#contract_type").val("");
        $("#shopping").val("");
        $("#product_service_name").val("");
        $("#product_service_number_integer").val("");
        $("#product_service_number_string").val("");
        $("#documentFilter").submit();
    });

    $(document).on('click', '.btnShowContract', function (event) {
        event.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            url: 'documents/contracts/' + id + '/show',
            type: 'get',
            success: function (response) {
                console.log(response)
                var allTags = [];
                $.each(response.tags, function (key, value) {
                    allTags.push(value.name)
                })
                $('#show_contract_id').text(response.id);
                $('#show_contract_title').text(response.number);
                $('#show_contract_number').text(response.number);
                $('#show_contract_type').text(response.document_type);
                $('#show_contract_date').text(response.date);
                $('#show_contract_folder_id').text(response.folder.name);
                $('#show_contract_document_type').text(response.document_detail.contract_type);
                $('#show_contract_tags').text(allTags.toString());
                $('#show_contract_shopping').text(response.document_detail.shopping)
                $('#show_contract_other_side_type').text(response.document_detail.other_side_type)
                $('#show_contract_other_side_name').text(response.document_detail.other_side_name);
                $('#show_contract_price').text(response.price);
                $('#show_contract_currency').text(response.currency);
            }
        });
    })

    $(document).on('click', '.btnShowContractAddition', function (event) {
        event.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            url: 'documents/contract-additions/' + id + '/show',
            type: 'get',
            success: function (response) {
                console.log(response);
                var allTags = [];
                $.each(response.document.tags, function (key, value) {
                    allTags.push(value.name)
                })
                $('#show_contract_addition_id').text(response.document.id);
                $('#show_contract_addition_title').text(response.document.number);
                $('#show_contract_addition_number').text(response.document.number);
                $('#show_contract_addition_document_type').text(response.document.document_type);
                $('#show_contract_addition_date').text(response.document.date);
                $('#show_contract_addition_contract_id').text(response.selected_contract.number);
                $('#show_contract_addition_folder_id').text(response.document.folder.name);
                $('#show_contract_addition_tags').text(allTags.toString());
                $('#show_contract_addition_other_side_name').text(response.document.document_detail.other_side_name);
                $('#show_contract_addition_price').text(response.document.price);
                $('#show_contract_addition_currency').text(response.document.currency);
            }
        });
    })

    $(document).on('click', '.btnShowProtocol', function (event) {
        event.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            url: 'documents/protocols/' + id + '/show',
            type: 'get',
            success: function (response) {
                console.log(response);
                var allTags = [];
                $.each(response.document.tags, function (key, value) {
                    allTags.push(value.name)
                })
                $('#show_protocol_id').text(response.document.id);
                $('#show_protocol_title').text(response.document.number);
                $('#show_protocol_number').text(response.document.number);
                $('#show_protocol_document_type').text(response.document.document_type);
                $('#show_protocol_date').text(response.document.date);
                $('#show_protocol_contract_id').text(response.selected_contract.number);
                $('#show_protocol_folder_id').text(response.document.folder.name);
                $('#show_protocol_tags').text(allTags.toString());
                $('#show_protocol_other_side_name').text(response.document.document_detail.other_side_name);
                $('#show_protocol_price').text(response.document.price);
                $('#show_protocol_currency').text(response.document.currency);
            }
        });
    })

    $(document).on('click', '.btnShowDeliveryStatement', function (event) {
        event.preventDefault();
        var id = $(this).data("id");
        $.ajax({
            url: 'documents/delivery-statements/' + id + '/show',
            type: 'get',
            success: function (response) {
                console.log(response);
                var allTags = [];
                $.each(response.document.tags, function (key, value) {
                    allTags.push(value.name)
                })
                $('#show_delivery_statement_id').text(response.document.id);
                $('#show_delivery_statement_title').text(response.document.number);
                $('#show_delivery_statement_number').text(response.document.number);
                $('#show_delivery_statement_document_type').text(response.document.document_type);
                $('#show_delivery_statement_date').text(response.document.date);
                $('#show_delivery_statement_contract_id').text(response.selected_contract.number);
                $('#show_delivery_statement_addition_id').text(response.selected_addition.number);
                $('#show_delivery_statement_folder_id').text(response.document.folder.name);
                $('#show_delivery_statement_tags').text(allTags.toString());
                $('#show_delivery_statement_other_side_name').text(response.document.document_detail.other_side_name);
                $('#show_delivery_statement_price').text(response.document.price);
                $('#show_delivery_statement_currency').text(response.document.currency);
            }
        });
    })

    $(document).on('click', '.btnDeleteDocument', function (event) {
        event.preventDefault();
        var id = $(this).data("id");
        console.log(id)
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
                    url: 'documents/delete/' + id,
                    method: 'delete',
                    data:
                        {
                            _token: '{{ csrf_token() }}'
                        }
                    ,
                    async: false,
                    success: function (response) {
                        $("#row-" + id).remove();
                        Swal.fire(
                            'Silindi!',
                            'Sənəd silindi.',
                            'success'
                        );
                    }
                });
            }
        });
    });
</script>
