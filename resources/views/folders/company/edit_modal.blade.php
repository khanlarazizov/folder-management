<!-- Edit Modal -->
<div class="modal fade show" id="editCompanyModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Şirkət redaktə et</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="editCompanyForm">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="company_id" id="company_id">

                    <div class="form-group">
                        <label for="edit_name">Ad</label>
                        <input type="text" class="form-control" name="name" id="edit_name">
                        <span id="companyNameError" class="text-danger error-message"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btnCompanyUpdate">Yadda saxla</button>
            </div>
        </div>
    </div>

</div>

