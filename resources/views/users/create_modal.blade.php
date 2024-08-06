<div class="modal fade show" id="addUserModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">İstifadəçi əlavə et</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="addUserForm">
                    @csrf

                    <div class="form-group">
                        <label for="name">Ad</label>
                        <input type="text" class="form-control" name="name" id="name">
                        <span id="nameError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                        <span id="emailError" class="text-danger error-message"></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Şifrə</label>
                        <input type="password" class="form-control" name="password" id="password" autocomplete="off">
                        <span id="passwordError" class="text-danger error-message"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btnUserStore">Yadda saxla</button>
            </div>
        </div>
    </div>

</div>
