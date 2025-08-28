<?php

namespace App\Http\Controllers;

use App\Models\ItemCategory;
use App\Models\Items;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ItemsController extends Controller
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

            $data = Items::with(['user', 'category'])
                ->withAggregate('user', 'name')
                ->withAggregate('category', 'name');

            if ($searchField && $searchValue) {
                $data = $data->where(function($query) use($searchField, $searchValue){
                    if ($searchField == 'created_by') {
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
                    $name = $row->item_name;
                    $btn = "
                        <div class='d-flex align-items-center gap-1'>
                            <button type='button' class='btn btn-warning btn-edit' data-id='$id' data-toggle='modal' data-target='#editModal'>
                                <i class='fa fa-edit'></i>
                            </button>
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

        return view('items/index', compact(['categories']));
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
        $request->validate([
            'category_id' => 'required',
            'item_name' => 'required',
            'code_item' => 'required'
        ]);

        $codeItem = trim($request->code_item);
        $isCodeItemExist = Items::where('code_item', $codeItem)->first();
        if ($isCodeItemExist) {
            $getCodeItem = $this->getCodeItem();
            $codeItem = $getCodeItem->original['data'];
        }

        $item = new Items();
        $item->item_name = trim($request->item_name);
        $item->code_item = $codeItem;
        $item->category_id = $request->category_id;
        $item->created_by = auth()->user()->id;
        $item->updated_by = auth()->user()->id;
        $item->save();

        return response()->json([
            'status' => 'success',
            'data' => $item
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Items::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $item
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Items::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $item
        ], 200);
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
        $request->validate([
            'category_id' => 'required',
            'item_name' => 'required'
        ]);

        $item = Items::find($id);
        $item->item_name = trim($request->item_name);
        $item->category_id = $request->category_id;
        $item->updated_by = auth()->user()->id;
        $item->updated_at = now();
        $item->update();

        return response()->json([
            'status' => 'success',
            'data' => $item
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Items::find($id);
        $item->delete();

        return response()->json([
            'status' => 'success',
            'data' => $item
        ], 200);
    }

    /**
     * Get last code item
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getCodeItem()
    {
        $today = date("Ymd", time());

        $lastItem = Items::where('code_item', 'like', "%$today%")
            ->orderBy('code_item', 'desc')
            ->first();

        $codeItem = "DEV/$today/0001";
        if ($lastItem) {
            $lasCodeItem = $lastItem->code_item;
            $lastSequence = explode('/', $lasCodeItem);
            if (count($lastSequence)) {
                $lastSequence = (int) $lastSequence[2];
                $newSequence = $lastSequence + 1;
                $newSequence = str_pad($newSequence, 4, 0, STR_PAD_LEFT);
                $codeItem = "DEV/$today/$newSequence";
            }
        }

        return response()->json([
            'status' => 'success',
            'data' => $codeItem
        ], 200);
    }

    public function getItemByCategory(Request $request)
    {
        $categoryId = $request->category_id;

        $items = Items::where('category_id', $categoryId)->get();

        return response()->json([
            'status' => 'success',
            'data' => $items
        ], 200);
    }
}
