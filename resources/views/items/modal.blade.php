<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Item</h4>
            </div>
            <form id="form-create">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="item_name" class="control-label">Nama Item</label>
                        <input type="text" name="item_name" id="item_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="code_item" class="control-label">Code Item</label>
                        <input type="text" name="code_item" id="code_item" class="form-control" required placeholder="DEV/YYYYMMDD/SEQUENCE">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-close-modal" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="btn-simpan">
                        Simpan 
                        <span class="loading" style="display: none;"><i class="fa fa-spin fa-spinner"></i></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>