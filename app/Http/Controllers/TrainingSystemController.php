<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\TrainingMode;
use App\TrainingSystem;

class TrainingSystemController extends Controller
{
    public function index()
    {
        return view('training-system.index');
    }

    public function indexData(Datatables $datatables)
    {
        $query = TrainingSystem::orderBy('name', 'ASC')
        ->select('training_systems.*');
        return $datatables->eloquent($query)
          ->addColumn('action', function ($training_system) {
              return view('training-system.actions', ['training_system' => $training_system]);
          })
          ->make(true);
    }
    public function create(Request $request)
    {
        return view('training-system.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    if (TrainingSystem::where('name', '=', $request->name)->count()) {
                        return $fail("Training System name already exists");
                    }
                }
            ],
        ]);

        $TrainingSystem = new TrainingSystem();
        $TrainingSystem->fill($request->all() + ['active_status' => 1]);
        $TrainingSystem->save(); 

        //$TrainingSystem = TrainingSystem::create($request->all());

        return ["success" => "Training System created Successfully"];
    }

    public function edit($id)
    {
        $training_system = TrainingSystem::find($id);
        return view('training-system.edit', ['training_system' => $training_system]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => [
                'required',
            ],
        ]);
        $training_system = TrainingSystem::find($id);
        $training_system->update($request->all() + ['active_status' => $request->active_status]);
        return ["success" => "Training System updated Successfully"];
    }

    public function delete($id)
    {
        $training_system = TrainingSystem::find($id);
        return view('training-system.delete', ['training_system' => $training_system]);
    }
    public function destroy($id)
    {
        // $system = TrainingSystem::find($id);
        // $system->delete();
        TrainingSystem::where('id',$id)->update(['active_status' => 0]);
        return ["success" => "Training System Deleted Successfully"];
    }
}
