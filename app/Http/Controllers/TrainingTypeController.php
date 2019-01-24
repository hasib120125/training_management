<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\TrainingType;
use App\Training;

class TrainingTypeController extends Controller
{
    public function index()
    {
        return view('training-types.index');
    }

    public function indexData(Datatables $datatables)
    {
        $query = TrainingType::
        orderBy('name','ASC')
        ->select('training_types.*');
        return $datatables->eloquent($query)
          ->addColumn('action', function ($training_type) {
              return view('training-types.actions', ['training_type' => $training_type]);
          })
        ->make(true);
    }
    public function create(Request $request)
    {
        return view('training-types.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if (TrainingType::where('name', '=', $request->name)->count()) {
                        return $fail("Training Type name already exists");                        
                    }
                }
            ],
        ]);
       
        $Trainingtype = new TrainingType();
        $Trainingtype->fill($request->all() + ['active_status' => 1]);
        $Trainingtype->save();    
        //$trainingType = TrainingType::create($request->all());

        return ["success" => "Training Type created Successfully"];
        
    }

    public function edit($id)
    {
        $training_type = TrainingType::find($id);
        return view('training-types.edit', ['training_type' => $training_type]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',               
        ]);
        $training_type = TrainingType::find($id);
        $training_type->update($request->all() + ['active_status' => $request->active_status]);
        return ["success" => "Training Type updated Successfully"];
    }

    public function delete($id)
    {
        $training_type = TrainingType::find($id);
        //$is_used = Training::where('training_type_id',$id)->first();
        //dd($is_used);
        return view('training-types.delete', ['training_type' => $training_type]);
    }
    public function destroy($id)
    {
        // $user = TrainingType::find($id);
        // $user->delete();
        TrainingType::where('id',$id)->update(['active_status' => 0]);
        return ["success" => "TrainingType Deleted Successfully"];
    }
}
