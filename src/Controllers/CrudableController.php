<?php

namespace Warkensoft\Laradmin\Controllers;

use Warkensoft\Laradmin\Requests\CrudableRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;

//use App\Jobs\StoreUploadedFile;
//use App\Models\Media;
//use App\Services\Crudable;

class CrudableController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @param CrudableRequest $crudableRequest
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index(CrudableRequest $crudableRequest)
    {
    	$crudable = $crudableRequest->model();

    	/** @var \Illuminate\Database\Eloquent\Builder $query */
    	$query = $crudable->modelname()::query();

	    if($filtered = $crudableRequest->get('filtered'))
	    {
	    	list($key, $value) = explode(',', $filtered, 2);
	    	$key = preg_replace('#[^a-z0-9_-]#is', '', trim($key));
	    	$value = trim($value);
	    	$query=$query->where( $key, $value );
	    }

	    if($search = $crudableRequest->get('search'))
	    {
	    	$query = $query->where(function ($q) use ($crudable, $search) {
	    		$fields = collect($crudable->fields);
	    		$q = $q->where($fields->shift()['field'], 'LIKE', '%' . $search . '%');
			    $fields->each(function ($field) use ($q, $search) {
					$q->orWhere($field['field'], 'LIKE', '%' . $search . '%');
			    });
		    });
	    }

	    $sortKey = $crudableRequest->has('sort') ? $crudableRequest->get('sort') : $crudable->sort['key'];
	    $sortDir = $crudableRequest->has('dir') ? $crudableRequest->get('dir') : $crudable->sort['dir'];

	    $query->orderBy($sortKey, $sortDir);

    	$entries = $query->paginate( config('laradmin.index-length') );

    	return view()->first([
    		'laradmin::' . $crudable->route . '.index',
		    'laradmin::crudable.index'
	    ], compact('crudable', 'entries'));
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @param CrudableRequest $crudableRequest
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function create(CrudableRequest $crudableRequest)
    {
	    $crudable = $crudableRequest->model();
        return view('laradmin::crudable.create', compact('crudable'));
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param CrudableRequest $crudableRequest
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function store(CrudableRequest $crudableRequest)
    {
	    $crudable = $crudableRequest->model();
	    $validatedData = $crudableRequest->validatedData();

	    dd($validatedData);

	    $modelInstance = $crudable->modelname()::create($validatedData);

//	    // Related data
//	    $relatedData = $crudableRequest->relationshipData();
//	    foreach($relatedData as $key => $value)
//	    {
//		    $modelInstance->$key()->sync($value);
//	    }
//
//	    // Upload data
//	    $uploadData = $crudableRequest->uploadData();
//
//	    /**
//	     * @var string $key
//	     * @var UploadedFile $uploadedFile
//	     */
//	    foreach($uploadData as $key => $uploadedFile)
//	    {
//			$path = $uploadedFile->store('documents');
//			$modelInstance->update([
//				$key => $path,
//				$key . '_name' => $uploadedFile->getClientOriginalName(),
//				$key . '_type' => $uploadedFile->getClientMimeType(),
//			]);
//	    }

	    return redirect()->route( config('laradmin.adminpath') . '.' . $crudable->route . '.index')
	                     ->with('success', 'Success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($model_id, CrudableRequest $crudableRequest)
    {
	    $crudable = $crudableRequest->model();
	    $modelInstance = $crudable->modelname()::findOrFail($model_id);
	    return view('laradmin::crudable.edit', compact('crudable', 'modelInstance'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update($model_id, CrudableRequest $crudableRequest)
    {
	    $modelName = $crudableRequest->modelName();
	    $modelInstance = $modelName::findOrFail($model_id);
	    $validatedData = $crudableRequest->validatedData()->generalData();
	    $modelInstance->update($validatedData);

	    // Related data
	    $relatedData = $crudableRequest->relationshipData();
	    foreach($relatedData as $key => $value)
	    {
	    	$modelInstance->$key()->sync($value);
	    }

	    // Upload data
	    $uploadData = $crudableRequest->uploadData();
	    foreach($uploadData as $key => $uploadedFile)
	    {
	    	$media = Media::upload($uploadedFile, $key);
		    $modelInstance->update([
			    $key => $media->id,
		    ]);
	    }

	    return redirect()->route( config('laradmin.adminpath') . '.' . $modelName::Crudable()->route . '.index')
	                     ->with('success', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($model_id, CrudableRequest $crudableRequest)
    {
	    $modelName = $crudableRequest->modelName();
	    $modelInstance = $modelName::findOrFail($model_id);
	    $modelInstance->delete();
	    return redirect()->route( config('laradmin.adminpath') . '.' . $modelName::Crudable()->route . '.index')
	                     ->with('success', 'Success');
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function show($model_id, Crudable $crudableService)
	{
		//
	}
}
