<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Item</h4>
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
                        <label for="item_name" class="control-label">Item Name</label>
                        <input type="text" name="item_name" id="item_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="code_item" class="control-label">Item Code</label>
                        <input type="text" name="code_item" id="code_item" class="form-control" required placeholder="DEV/YYYYMMDD/SEQUENCE">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-close-modal" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn-simpan">
                        Save 
                        <span class="loading" style="display: none;"><i class="fa fa-spin fa-spinner"></i></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="createModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Update Item</h4>
            </div>
            <form id="form-edit">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category_id_edit">Category</label>
                        <select name="category_id_edit" id="category_id_edit" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="item_name_edit" class="control-label">Item Name</label>
                        <input type="text" name="item_name_edit" id="item_name_edit" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="code_item_edit" class="control-label">Item Code</label>
                        <input type="text" name="code_item_edit" id="code_item_edit" readonly disabled class="form-control" required placeholder="DEV/YYYYMMDD/SEQUENCE">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-close-modal" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn-update">
                        Update  
                        <span class="loading" style="display: none;"><i class="fa fa-spin fa-spinner"></i></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Item</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure to delete this item <strong><span id="data-hapus"></span></strong>?</p>
            </div>
            <div class="modal-footer">
                <form id="form-hapus">
                    <button type="button" class="btn btn-default btn-close-modal" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" id="btn-hapus">
                        Delete 
                        <span class="loading" style="display: none;"><i class="fa fa-spin fa-spinner"></i></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createCategoryModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Category</h4>
            </div>
            <form id="form-create-category">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category_name" class="control-label">Category Name</label>
                        <input type="text" name="category_name" id="category_name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-close-modal" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn-simpan-category">
                        Save 
                        <span class="loading" style="display: none;"><i class="fa fa-spin fa-spinner"></i></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>