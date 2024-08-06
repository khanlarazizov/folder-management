<!-- Edit Modal -->
<div class="modal fade show" id="editUserModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">İstifadəçi redaktə et</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editUserForm">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="user_id" id="user_id">

                    <div class="form-group">
                        <label for="edit_name">Ad</label>
                        <input type="text" class="form-control" name="name" id="edit_name">
                        <span id="edit_nameError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="edit_email">Email</label>
                        <input type="email" class="form-control" name="email" id="edit_email">
                        <span id="edit_emailError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="edit_password">Şifrə</label>
                        <input type="password" class="form-control" name="password" id="edit_password" autocomplete="off">
                        <span id="edit_passwordError" class="text-danger error-message"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btnUserUpdate">Yadda saxla</button>
            </div>
        </div>
    </div>

</div>

