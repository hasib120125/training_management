<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\TrainingBrand;

class TrainingBrandController extends Controller
{
    public function index()
    {
        return view('training-brand.index');
    }

    public function indexData(Datatables $datatables)
    {
        $query = TrainingBrand::orderBy('name', 'ASC')
        ->select('training_brands.*');
        return $datatables->eloquent($query)
          ->addColumn('action', function ($training_brand) {
              return view('training-brand.actions', ['training_brand' => $training_brand]);
          })
          ->make(true);
    }
    public function create(Request $request)
    {
        return view('training-brand.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if (TrainingBrand::where('name', '=', $request->name)->count()) {
                        return $fail("Training Brand name already exists");
                    }
                }
            ],
        ]);

        $TrainingBrand = new TrainingBrand();
        $TrainingBrand->fill($request->all() + ['active_status' => 1]);
        $TrainingBrand->save();     

        //$trainingBrand = TrainingBrand::create($request->all());

        return ["success" => "Training Brand created Successfully"];
    }

    public function edit($id)
    {
        $training_brand = TrainingBrand::find($id);
        return view('training-brand.edit', ['training_brand' => $training_brand]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => [
                'required',               
            ],
        ]);
        $training_brand = TrainingBrand::find($id);
        $training_brand->update($request->all() + ['active_status' => $request->active_status]);
        return ["success" => "Training Brand updated Successfully"];
    }

    public function delete($id)
    {
        $training_brand = TrainingBrand::find($id);
        return view('training-brand.delete', ['training_brand' => $training_brand]);
    }
    public function destroy($id)
    {
        // $brand = TrainingBrand::find($id);
        // $brand->delete();
        TrainingBrand::where('id',$id)->update(['active_status' => 0]);
        return ["success" => "Training Brand Deleted Successfully"];
    }
}
