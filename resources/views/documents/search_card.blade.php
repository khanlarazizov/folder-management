<div class="card collapsed-card">
    <div class="card-header">
        <h3 class="card-title">Axtarış</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <form action="" id="documentFilter">
            <div class="row">
                <div class="col-3 my-2">
                    <label for="number">Nömrə:</label>
                    <input type="text" class="form-control" name="number" id="number" placeholder="Nömrə"
                           value="{{ request()->get('number') }}">
                </div>
                <div class="col-3 my-2">
                    <label for="contract_id">Bağlı olduğu müqavilə:</label>
                    <select name="contract_id" id="contract_id" class="form-select">
                        <option value="{{ null }}">Bağlı olduğu müqaviləni seç</option>
                        @forelse($contracts as $contract)
                            <option
                                value="{{ $contract->id }}" {{ request()->get('contract_id') == $contract->id ? "selected" : "" }}>{{ $contract->number }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="col-3 my-2">
                    <label for="startDate">Başlanğıc tarix:</label>
                    <input type="date" class="form-control" name="startDate" id="startDate"
                           value="{{ request()->get('startDate')}}">

                </div>
                <div class="col-3 my-2">
                    <label for="endDate">Son tarix:</label>
                    <input type="date" class="form-control" name="endDate" id="endDate"
                           value="{{ request()->get('endDate')}}">

                </div>
                <div class="col-3 my-2">
                    <label for="price">Qiymət</label>
                    <input type="text" class="form-control" name="price" id="price" placeholder="Qiymət"
                           value="{{ request()->get('price') }}">
                </div>
                <div class="col-3 my-2">
                    <label for="currency">Valyuta:</label>
                    <select name="currency" id="currency" class="form-select">
                        <option value="{{ null }}">Valyuta seç</option>
                        <option value="AZN" {{ request()->get('currency')=='AZN' ? 'selected' : ''}}>AZN</option>
                        <option value="USD" {{ request()->get('currency')=='USD' ? 'selected' : ''}}>USD</option>
                    </select>
                </div>
                <div class="col-3 my-2">
                    <label for="document_type">Sənəd tipi:</label>
                    <select name="document_type" id="document_type" class="form-select">
                        <option value="{{ null }}">Sənəd tipi seç</option>
                        <option value="Müqavilə" {{ request()->get('currency')=='Müqavilə' ? 'selected' : ''}}>
                            Müqavilə
                        </option>
                        <option
                            value="Müqaviləyə Əlavə" {{ request()->get('currency')=='Müqaviləyə Əlavə' ? 'selected' : ''}}>
                            Müqaviləyə Əlavə
                        </option>
                        <option value="Protokol" {{ request()->get('currency')=='Protokol' ? 'selected' : ''}}>
                            Protokol
                        </option>
                        <option
                            value="Təhvil-təslim aktı" {{ request()->get('currency')=='Təhvil-təslim aktı' ? 'selected' : ''}}>
                            Təhvil-təslim aktı
                        </option>
                    </select>
                </div>
                <div class="col-3 my-2">
                    <label for="contract_type">Müqavilə tipi:</label>
                    <select name="contract_type" id="contract_type" class="form-select">
                        <option value="{{ null }}">Müqavilə tipi seç</option>
                        <option
                            value="Partnyorluq" {{ request()->get('currency')=='Partnyorluq' ? 'selected' : ''}}>
                            Partnyorluq
                        </option>
                        <option value="Xidmət" {{ request()->get('currency')=='Xidmət' ? 'selected' : ''}}>Xidmət
                        </option>
                        <option value="Alqı-satqı" {{ request()->get('currency')=='Alqı-satqı' ? 'selected' : ''}}>
                            Alqı-satqı
                        </option>
                    </select>
                </div>
                <div class="col-3 my-2">
                    <label for="shopping">Alqı/Satqı tipi:</label>
                    <select name="shopping" id="shopping" class="form-select">
                        <option value="{{ null }}">Alqı/Satqı tipi seç</option>
                        <option value="Biz alırıq" {{ request()->get('shopping')=='Biz alırıq' ? 'selected' : ''}}>
                            Biz alırıq
                        </option>
                        <option
                            value="Biz satırıq" {{ request()->get('shopping')=='Biz satırıq' ? 'selected' : ''}}>
                            Biz satırıq
                        </option>
                    </select>
                </div>
                <div class="col-3 my-2">
                    <label for="product_service_name">Məhsul/xidmət adı:</label>
                    <input type="text" class="form-control" name="product_service_name" id="product_service_name"
                           placeholder="Məhsul/xidmət adı"
                           value="{{ request()->get('product_service_name') }}">
                </div>
                <div class="col-3 my-2">
                    <label for="product_service_number_integer">Məhsul/xidmət miqdarı:</label>
                    <input type="number" class="form-control" name="product_service_number_integer"
                           id="product_service_number_integer"
                           placeholder="Məhsul/xidmət miqdarı"
                           value="{{ request()->get('product_service_number_integer') }}">
                </div>
                <div class="col-3 my-2">
                    <label for="product_service_number_string">Məhsul/xidmət miqdarı(mətn):</label>
                    <input type="text" class="form-control" name="product_service_number_string"
                           id="product_service_number_string"
                           placeholder="Məhsul/xidmət miqdarı(mətn)"
                           value="{{ request()->get('product_service_number_string') }}">
                </div>
            </div>

            <div class="row">
                <div class="text-right mt-2">
                    <button type="submit" class="btn btn-primary">Axtar</button>
                    <a type="submit" class="btn btn-danger btnClearFilter">Təmizlə</a>
                </div>
            </div>
        </form>
    </div>
</div>
@include('documents.js')
