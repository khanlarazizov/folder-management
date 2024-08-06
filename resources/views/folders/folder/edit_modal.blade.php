<!-- Edit Modal -->
<div class="modal fade show" id="editFolderModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Qovluq redaktə et</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editFolderForm">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="folder_id" id="folder_id">

                    <div class="form-group">
                        <label for="edit_name">Ad</label>
                        <input type="text" class="form-control" name="name" id="edit_name">
                        <span id="folderNameError" class="text-danger error-message"></span>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="date">Tarix</label>
                            <input type="date" class="form-control" name="date" id="edit_date">
                            <span id="folderDateError" class="text-danger error-message"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btnFolderUpdate">Yadda saxla</button>
            </div>
        </div>
    </div>

</div>

