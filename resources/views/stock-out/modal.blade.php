<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModal">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Stock Out</h4>
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
                        <label for="item_id" class="control-label">Item Code</label>
                        <select name="item_id" id="item_id" class="form-control" required>
                            <option value="">-- Select Code Item --</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity" readonly disabled class="control-label">Quantity</label>
                        <input type="number" min="0" name="quantity" id="quantity" class="form-control" required>
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

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Stock Out</h4>
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