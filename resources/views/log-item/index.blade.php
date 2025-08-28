@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">Log Item</div>
                        <div class="col-6">
                            
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
                                            <th>Item Code</th>
                                            <th>Item Name</th>
                                            <th>In/Out</th>
                                            <th>Quantity</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        <tr>
                                            <td>
                                                <input type="text" data-field="code_item" class="form-control search-by" placeholder="Search by Code..." style="width: 150px;">
                                            </td>
                                            <td>
                                                <input type="text" data-field="item_name" class="form-control search-by" placeholder="Search by Name..." style="width: 150px;">
                                            </td>
                                            <td>
                                                <select name="type" data-field="type" class="form-control search-by" style="width: 150px;">
                                                    <option value="">Select In/Out</option>
                                                    <option value="masuk">In</option>
                                                    <option value="keluar">out</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" data-field="quantity" class="form-control search-by" placeholder="Search by Qty..." style="width: 150px;">
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

@endsection

@push('after-script')
@include('log-item.script')
@endpush