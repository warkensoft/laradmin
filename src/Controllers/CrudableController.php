<?php

namespace Warkensoft\Laradmin\Controllers;

use App\Http\Requests\CrudableRequest;
use App\Http\Controllers\Controller;
use App\Jobs\StoreUploadedFile;
use App\Models\Media;
use App\Services\Crudable;
use Illuminate\Http\UploadedFile;

class CrudableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CrudableRequest $crudableRequest)
    {
    	$model = $crudableRequest->modelName();

    	/** @var \Illuminate\Database\Eloquent\Builder $query */
    	$query = $model::query();

	    if($filtered = $crudableRequest->get('filtered'))
	    {
	    	list($key, $value) = explode(',', $filtered, 2);
	    	$key = preg_replace('#[^a-z0-9_-]#is', '', trim($key));
	    	$value = trim($value);
	    	$query=$query->where( $key, $value );
	    }

	    if($search = $crudableRequest->get('search'))
	    {
	    	$query = $query->where(function ($q) use ($model, $search) {
	    		$fields = collect($model::Crudable()->fields);
	    		$q = $q->where($fields->shift()['field'], 'LIKE', '%' . $search . '%');
			    $fields->each(function ($field) use ($q, $search) {
					$q->orWhere($field['field'], 'LIKE', '%' . $search . '%');
			    });
		    });
	    }

	    $sortKey = $crudableRequest->has('sort') ? $crudableRequest->get('sort') : $model::Crudable()->sort['key'];
	    $sortDir = $crudableRequest->has('dir') ? $crudableRequest->get('dir') : $model::Crudable()->sort['dir'];

	    $query->orderBy($sortKey, $sortDir);

    	$entries = $query->paginate( config('cms.index-length') );

    	return view()->first(['admin.' . $model::Crudable()->route . '.index', 'admin.crudable.index'], compact('model', 'entries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CrudableRequest $crudableRequest)
    {
	    $modelName = $crudableRequest->modelName();
	    $modelInstance = new $modelName;
        return view('admin.crudable.create', compact('modelName', 'modelInstance'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrudableRequest $crudableRequest)
    {
	    $model = $crudableRequest->modelName();
	    $validatedData = $crudableRequest->validatedData()->generalData();
	    $modelInstance = $model::create($validatedData);

	    // Related data
	    $relatedData = $crudableRequest->relationshipData();
	    foreach($relatedData as $key => $value)
	    {
		    $modelInstance->$key()->sync($value);
	    }

	    // Upload data
	    $uploadData = $crudableRequest->uploadData();

	    /**
	     * @var string $key
	     * @var UploadedFile $uploadedFile
	     */
	    foreach($uploadData as $key => $uploadedFile)
	    {
			$path = $uploadedFile->store('documents');
			$modelInstance->update([
				$key => $path,
				$key . '_name' => $uploadedFile->getClientOriginalName(),
				$key . '_type' => $uploadedFile->getClientMimeType(),
			]);
	    }

	    return redirect()->route( 'admin.' . $model::Crudable()->route . '.index')
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
	    $modelName = $crudableRequest->modelName();
	    $modelInstance = $modelName::findOrFail($model_id);
	    return view('admin.crudable.edit', compact('modelName', 'modelInstance'));
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

	    return redirect()->route( 'admin.' . $modelName::Crudable()->route . '.index')
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
	    return redirect()->route( 'admin.' . $modelName::Crudable()->route . '.index')
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
