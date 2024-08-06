<div class="modal fade show" id="resetPasswordModal" tabindex="-1" role="dialog"
     aria-labelledby="resetPasswordModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Şifrəni dəyiş</h5>
                <button type="button" onclick="$('#resetPasswordModal').modal('hide')" class="close"
                        data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="resetPasswordForm">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="new_password">Yeni şifrə</label>
                        <div class="input-group input-group">
                            <input type="password" name="new_password" id="new_password" class="form-control">
                            <div class="input-group-append">
                                <a class="btn btn-default showPassword">
                                    <i class="fas fa-eye-slash" id="showPasswordIcon"></i>
                                </a>
                            </div>
                        </div>
                        <span id="newPasswordError" class="text-danger error-message"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary savePasswordBtn">Yadda saxla</button>
            </div>
        </div>
    </div>
</div>
