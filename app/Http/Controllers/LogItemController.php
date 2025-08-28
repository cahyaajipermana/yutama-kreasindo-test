<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use App\Models\ItemHistory;
use DataTables;
use Illuminate\Http\Request;

class LogItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $searchField = $request->search_field ?? null;
            $searchValue = $request->search_value ?? null;

            $data = ItemHistory::with(['item', 'user'])
                ->withAggregate('item', 'item_name')
                ->withAggregate('item', 'code_item')
                ->withAggregate('user', 'name');

            if ($searchField && $searchValue) {
                $data = $data->where(function($query) use($searchField, $searchValue){
                    if ($searchField == 'code_item' || $searchField == 'item_name') {
                        $query->whereHas('item', function ($query) use ($searchField, $searchValue) {
                            $query->where($searchField, 'like', "%$searchValue%");
                        });
                    } else if ($searchField == 'created_by') {
                        $query->whereHas('user', function ($query) use ($searchField, $searchValue) {
                            $query->where('name', 'like', "%$searchValue%");
                        });
                    } else {
                        $query->where($searchField, 'like', "%$searchValue%");
                    }
                });
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $id = $row->id;
                    $name = "$row->item_code_item - $row->item_item_name";
                    $btn = "
                        <div class='d-flex align-items-center gap-1'>
                            <button type='button' class='btn btn-danger btn-delete' data-id='$id' data-name='$name' data-toggle='modal' data-target='#deleteModal'>
                                <i class='fa fa-trash'></i>
                            </button>
                        </div>
                    ";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $categories = ItemCategory::orderBy('name')->get();

        return view('log-item/index', compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
