<!-- Edit Modal -->
<div class="modal fade show" id="editProjectModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Layihə redaktə et</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editProjectForm">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="project_id" id="project_id">

                    <div class="form-group">
                        <label for="edit_name">Ad</label>
                        <input type="text" class="form-control" name="name" id="edit_name">
                        <span id="projectNameError" class="text-danger error-message"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btnProjectUpdate">Yadda saxla</button>
            </div>
        </div>
    </div>

</div>

