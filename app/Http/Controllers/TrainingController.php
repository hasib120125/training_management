<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use App\Training;
use App\TrainingFile;
use App\TrainingUser;
use App\TrainingType;
use App\TrainingMode;
use App\Role;
use App\User;
use App\Status;
use App\TrainingSystem;
use App\TrainingBrand;
use Storage;
use DB;
class TrainingController extends Controller
{
    public function index()
    {
        return view('trainings.index');
    }

    public function indexData(Datatables $datatables)
    {
        if(auth()->user()->hasRole('admin')){
            $query = Training::where('company_id', '=', auth()->user()->company->id)
            ->where('trainings.active_status','=','1')
            ->with('status')
            ->with('type')
            ->with('mode')
            ->orderBy('id','DESC')
            ->select('trainings.*');
            return $datatables->eloquent($query)
            ->addColumn('action', function ($training) {
                return view('trainings.actions', ['training' => $training]);
            })
            ->addColumn('status', function ($training) {
                return $training->status->display_name;
            })

            ->addColumn('type', function ($training) {
                return $training->type->name;
            })

             ->addColumn('mode', function ($training) {
                return $training->mode->name;
            })
            ->rawColumns(['name', 'action'])
            ->make(true);
        }
        if(auth()->user()->hasRole('trainer')){
            $query = Training::join('training_user', 'training_user.training_id', 'trainings.id')
            ->join('statuses', 'training_user.status_id', 'statuses.id')
            ->where('training_user.user_id', '=', auth()->user()->id)
            ->select([
                'trainings.id as id',
                'trainings.title as title',
                'trainings.description as description',
                'trainings.status_id as status_id',
                'training_user.started_at as started_at',
                'training_user.ended_at as ended_at',
                'statuses.display_name as training_status'
            ]);
            return $datatables->eloquent($query)
            ->addColumn('action', function ($training) {
                return view('trainings.actions', ['training' => $training]);
            })
            ->rawColumns(['name', 'action'])
            ->make(true);
        }
    }
    public function create()
    {
        $training_types = TrainingType::where('active_status',1)->orderBy('name')->pluck('name', 'id');
        $training_modes = TrainingMode::where('active_status',1)->orderBy('name')->pluck('name', 'id');
        $training_system = TrainingSystem::where('active_status',1)->orderBy('name')->pluck('name','id');
        $training_brand = TrainingBrand::where('active_status',1)->orderBy('name')->pluck('name','id');

        return view('trainings.create', compact('training_types', 'training_modes','training_system','training_brand'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => [
                'required',
                function($attribute, $value, $fail) use ($request){
                    $training_title = Training::where('title',$request->title)->first();                                           
                    if ($training_title) {
                        $fail('Training Title already add');
                    }                 
                }
            ],
            'started_at'=> 'required',
            'ended_at' => 'required',
            'training_type_id' => 'required',
            'training_mode_id' => 'required'
        ],
        [
          'training_type_id.required' => 'Please select a training type',
          'training_mode_id.required' => 'Please select a training mode',
          'started_at.required' => 'Start Date is required',
          'ended_at.required' => 'End Date is required',
        ]);
        if ($request->validate) {
            return response('success', 200);
        }
        $status_id = Carbon::parse($request->ended_at)->gte(Carbon::now()) ? 1: 2;
        $training = new Training();
        $training->fill($request->all() + ['company_id' => auth()->user()->company->id, 'status_id' => $status_id,'active_status' => 1]);
        $training->type()->associate($request->training_type_id);
        $training->mode()->associate($request->training_mode_id);
        $training->save();

        $data = $request->all();
        if(!empty($request->file('files'))){
          for($i = 0; $i < count($request->file('files')); $i++){
            $fileIn = $data['files'][$i];
            $file_raw_name = $fileIn->getClientOriginalName();
            $path = Storage::putFileAs('trainings', $fileIn, $file_raw_name);
            $file = new TrainingFile();
            $file = $file->fill([
              'name' => $fileIn->getClientOriginalName(),
              'raw_name'  => $fileIn->getClientOriginalName(),
              'extension' => $fileIn->getClientOriginalExtension(),
              'path' => $path,
            ]);
            $file->training()->associate($training);
            $file->save();
          }
        }
        return ['success' => 'Training Added Successfully'];

    }

    public function show(Request $request, $id){
      $training = Training::with('files')->find($id);
      $training_user = TrainingUser::where('user_id', $request->user()->id)->where('training_id', $training->id)->first();
      $training->user_started_at = $training_user->started_at->toDateTimeString();
      $training->user_ended_at = $training_user->ended_at->toDateTimeString();
      $training->user_status = $training_user->status_id;
      return $training;
    }

    public function edit($id)
    {
        $training_types = TrainingType::where('active_status',1)->orderBy('name')->pluck('name', 'id');
        $training_modes = TrainingMode::where('active_status',1)->orderBy('name')->pluck('name', 'id');
        $training_system = TrainingSystem::where('active_status',1)->orderBy('name')->pluck('name','id');
        $training_brand = TrainingBrand::where('active_status',1)->orderBy('name')->pluck('name','id');
        $training = Training::find($id);
        return view('trainings.edit', compact('training', 'training_types', 'training_modes','training_system','training_brand'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'started_at'=> 'required',
            'ended_at' => 'required',
            'training_type_id' => 'required',
            'training_mode_id' => 'required'
        ],[
          'training_type_id' => 'Please select a training type',
          'training_mode_id' => 'Please select a training mode',
          'started_at.required' => 'Start Date is required',
          'ended_at.required' => 'End Date is required',
        ]);
        if ($request->validate) {
            return response('success', 200);
        }
        $training = Training::find($id);
        $training->update($request->all());

        $training->status_id =  Carbon::parse($request->ended_at)->gte(Carbon::now()) ? 1: 2;
        $training->save();
        if($request->existing_files){
          foreach($request->existing_files as $file_id => $value){
            if(!$value){
              $file = TrainingFile::find($file_id);
              Storage::delete($file->path);
              $file->delete();
        }
          }
        }
        if($request->file('files')){
          for($i = 0; $i < count($request->file('files')); $i++){
            $fileIn = $request->file('files')[$i];
            $file_raw_name = $fileIn->getClientOriginalName();
            $path = Storage::putFileAs('trainings', $fileIn, $file_raw_name);
            $file = new TrainingFile();
            $file = $file->fill([
              'name' => $fileIn->getClientOriginalName(),
              'raw_name'  => $fileIn->getClientOriginalName(),
              'extension' => $fileIn->getClientOriginalExtension(),
              'path' => $path,
            ]);
            $file->training()->associate($training);
            $file->save();
          }
        }
        return ['success' => 'Training Updated Successfully'];
    }
    public function delete($id)
    {
        $training = Training::find($id);
        return view('trainings.delete', compact('training'));
    }
    public function destroy($id)
    {
        //$training = Training::find($id);
        // foreach($training->files as $file){
        //   Storage::delete($file->path);
        //   $file->delete();
        // }
            
        //$training->delete();

        Training::where('id',$id)->update(['active_status' => 0]);
        return ['success' => 'Training deleted Successfully'];
    }

    public function getTitles()
    {
       return Training::pluck('title','id')->toArray();              
    }

    public function DownloadFile($id)
    {       
        
        $training = TrainingFile::where('training_id',$id)->first();          
        if($training)
        {           
            return response()->download(Storage::path('trainings/'.$training->raw_name));            
        }
        else
        {
            return view('trainings.file');
        }
           
    }
}
