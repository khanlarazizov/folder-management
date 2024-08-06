<div class="modal fade show" id="addTagModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Açar söz əlavə et</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="addTagForm">
                    @csrf
                    <div class="form-group">
                        <label for="name">Ad</label>
                        <input type="text" class="form-control" name="name" id="name">
                        <span id="nameError" class="text-danger error-message"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btnTagStore">Yadda saxla</button>
            </div>
        </div>
    </div>

</div>
