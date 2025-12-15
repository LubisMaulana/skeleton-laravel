<script>
    const dataTable = new DataTable('#table-data', {
        ajax: {
            url: URL_GET_USERS,
            dataSrc: 'data'
        },
        columns: [{
                data: null,
                visible: false
            },
            {
                data: 'name'
            },
            {
                data: 'email'
            },
            {
                data: 'role'
            },
            {
                data: null,
                width: "100px",
                render: function(data, _, _) {
                    return `
                        <div class="w-100 d-flex gap-3 align-items-center justify-content-center">
                            <a class="cursor-pointer" data-id="${data.id}" id="btnEdit">
                                <i class="lni lni-pencil-alt"></i>
                            </a>
                            <a class="cursor-pointer" data-name="${data.name}" data-url="${URL_DELETE_USERS.replace('__id__', data.id)}" id="btnDelete">
                                <i class="lni lni-trash text-danger"></i>
                            </a>
                        </div>
                    `;
                }
            }
        ]
    });

    $('#modalAdd form').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);

        const data = {
            name: $('#modalAdd #add_name').val(),
            username: $('#modalAdd #add_email').val(),
            password: $('#modalAdd #add_role').val(),
            password: $('#modalAdd #add_password').val(),
            password_confirmation: $('#modalAdd #add_password_confirmation').val(),
            _token: $('#modalAdd [name="_token"]').val(),
        };

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: JSON.stringify(data),
            contentType: 'application/json',
            processData: false,
            beforeSend: function() {
                $('.loader-app').show();
                $('.overlay-lock').show();
                $('body').addClass('loading');
            },
            success: function(response) {
                toastr.success(`${response.message}`, "Success");

                form[0].reset();
                $('#modalAdd').modal('hide');

                dataTable.ajax.reload(null, false);
            },
            complete: function() {
                $('.loader-app').hide();
                $('.overlay-lock').hide();
                $('body').removeClass('loading');
            },
            error: function(xhr, _, _) {
                const errorMsg = xhr.responseJSON?.message || "Terjadi kesalahan.";
                toastr.error(errorMsg, "Error");
            }
        });
    });

    $('#modalEdit form').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);

        const data = {
            name: $('#modalEdit #edit_name').val(),
            username: $('#modalEdit #edit_email').val(),
            username: $('#modalEdit #edit_role').val(),
            password: $('#modalEdit #edit_password').val(),
            password_confirmation: $('#modalEdit #edit_password_confirmation').val(),
            _method: 'PUT'
        };

        $.ajax({
            type: 'PUT',
            url: form.attr('action'),
            data: JSON.stringify(data),
            contentType: 'application/json',
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('#modalEdit [name="_token"]').val(),
            },
            beforeSend: function() {
                $('.loader-app').show();
                $('.overlay-lock').show();
                $('body').addClass('loading');
            },
            success: function(response) {
                toastr.success(`${response.message}`, "Success");

                form[0].reset();
                $('#modalEdit').modal('hide');

                dataTable.ajax.reload(null, false);
            },
            complete: function() {
                $('.loader-app').hide();
                $('.overlay-lock').hide();
                $('body').removeClass('loading');
            },
            error: function(xhr, _, _) {
                const errorMsg = xhr.responseJSON?.message || "Terjadi kesalahan.";
                toastr.error(errorMsg, "Error");
            }
        });
    });

    $('#modalForDelete form').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);

        var confirmationText = $('#konfirmasi').text().trim();
        var inputName = $('#modalForDelete #name');

        if (inputName.val().trim().toLowerCase() !== confirmationText.toLowerCase()) {
            alert('Masukkan tidak sesuai. Silakan coba lagi.');
            return;
        }

        $.ajax({
            type: 'DELETE',
            url: form.attr('action'),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('#modalForDelete [name="_token"]').val(),
            },
            beforeSend: function() {
                $('.loader-app').show();
                $('.overlay-lock').show();
                $('body').addClass('loading');
            },
            success: function(response) {
                toastr.success(`${response.message}`, "Success");

                form[0].reset();
                $('#modalForDelete').modal('hide');

                dataTable.ajax.reload(null, false);
            },
            complete: function() {
                $('.loader-app').hide();
                $('.overlay-lock').hide();
                $('body').removeClass('loading');
            },
            error: function(xhr, _, _) {
                const errorMsg = xhr.responseJSON?.message || "Terjadi kesalahan.";
                toastr.error(errorMsg, "Error");
            }
        });
    });

    $('#table-data').on('click', '#btnEdit', function() {
        const t = $(this);
        const modalEdit = $('#modalEdit');

        $.ajax({
            type: 'GET',
            url: URL_SHOW_USERS.replace('__id__', t.data('id')),
            beforeSend: function() {
                $('.loader-app').show();
                $('.overlay-lock').show();
                $('body').addClass('loading');
            },
            success: function(response) {
                modalEdit.find('form').attr('action', URL_UPDATE_USERS.replace('__id__', t.data(
                    'id')));

                modalEdit.find('#edit_name').val(response.data.name);
                modalEdit.find('#edit_email').val(response.data.email);
                modalEdit.find('#edit_role').val(response.data.role);

                modalEdit.modal('show');
            },
            complete: function() {
                $('.loader-app').hide();
                $('.overlay-lock').hide();
                $('body').removeClass('loading');
            },
            error: function(xhr, _, _) {
                const errorMsg = xhr.responseJSON?.message || "Terjadi kesalahan.";
                toastr.error(errorMsg, "Error");
            }
        });
    });

    $('#table-data').on('click', '#btnDelete', function() {
        const t = $(this);
        const modalDelete = $('#modalForDelete');
        $('#konfirmasi').text(t.data('name'));
        modalDelete.find('form').attr('action', t.data('url'));

        modalDelete.modal('show');
    });

    function showOrHidePassword(inputSelector, iconSelector = '#toggle-password-icon') {
        const passwordInput = $(inputSelector);
        const icon = $(iconSelector);
        const isVisible = passwordInput.attr('type') === 'text';

        passwordInput.attr('type', isVisible ? 'password' : 'text');

        icon.toggleClass('bx-show', isVisible);
        icon.toggleClass('bx-hide', !isVisible);
    }
</script>
