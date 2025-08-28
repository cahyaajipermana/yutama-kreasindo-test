@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">Items</div>
                        <div class="col-6">
                            <div class="d-flex align-items-center justify-content-end gap-2">
                                <button type="button" class="btn btn-success btn-tambah" data-toggle="modal" data-target="#createModal">
                                    <span><i class="fa fa-plus"></i></span> Add Item
                                </button>
                                <button type="button" class="btn btn-primary btn-tambah" data-toggle="modal" data-target="#createCategoryModal">
                                    <span><i class="fa fa-plus"></i></span> Add Category
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-hover data-table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Category</th>
                                            <th>Item Code</th>
                                            <th>Item Name</th>
                                            <th>Stock</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            <td>
                                                <input type="number" data-field="id" class="form-control search-by" placeholder="Search by ID..." style="width: 150px;">
                                            </td>
                                            <td>
                                                <select data-field="category_id" class="form-control search-by" style="width: 150px;">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" data-field="code_item" class="form-control search-by" placeholder="Search by Code..." style="width: 150px;">
                                            </td>
                                            <td>
                                                <input type="text" data-field="item_name" class="form-control search-by" placeholder="Search by Name..." style="width: 150px;">
                                            </td>
                                            <td>
                                                <input type="number" data-field="stock" class="form-control search-by" placeholder="Search by Stok..." style="width: 150px;">
                                            </td>
                                            <td>
                                                <input type="text" data-field="created_by" class="form-control search-by" placeholder="Search by Creator..." style="width: 150px;">
                                            </td>
                                            <td>
                                                <input type="date" data-field="created_at" class="form-control search-by" placeholder="Search by Tanggal..." style="width: 150px;">
                                            </td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('items.modal')

@endsection

@push('after-script')
@include('items.script')
@endpush