<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\TrainingAudience;

class TrainingAudienceController extends Controller
{
    public function index()
    {
        return view('training-audiences.index');
    }

    public function indexData(Datatables $datatables)
    {
        $query = TrainingAudience::orderBy('name', 'ASC')
        ->select('training_audiences.*');
        return $datatables->eloquent($query)
          ->addColumn('action', function ($training_audience) {
              return view('training-audiences.actions', ['training_audience' => $training_audience]);
          })
          ->make(true);
    }
    public function create(Request $request)
    {
        return view('training-audiences.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if (TrainingAudience::where('name', '=', $request->name)->count()) {
                        return $fail("Training Audience name already exists");
                    }
                }
            ],
        ]);


        $TrainingAudience = new TrainingAudience();
        $TrainingAudience->fill($request->all() + ['active_status' => 1]);
        $TrainingAudience->save(); 
        //$trainingAudience = TrainingAudience::create($request->all());
        return ["success" => "Training Audience created Successfully"];
    }

    public function edit($id)
    {
        $training_audience = TrainingAudience::find($id);
        return view('training-audiences.edit', ['training_audience' => $training_audience]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => [
                'required',               
            ],
        ]);
        $training_audience = TrainingAudience::find($id);
        $training_audience->update($request->all() + ['active_status' => $request->active_status]);
        return ["success" => "Training Audience updated Successfully"];
    }

    public function delete($id)
    {
        $training_audience = TrainingAudience::find($id);
        return view('training-audiences.delete', ['training_audience' => $training_audience]);
    }
    public function destroy($id)
    {
        // $user = TrainingAudience::find($id);
        // $user->delete();
        TrainingAudience::where('id',$id)->update(['active_status' => 0]);
        return ["success" => "TrainingAudience Deleted Successfully"];
    }
}
