<?php namespace Warkensoft\Laradmin\Controllers;

use Illuminate\Database\QueryException;
use Warkensoft\Laradmin\Requests\CrudableRequest;
use App\Http\Controllers\Controller;

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
    	$crudable = $crudableRequest->crudable();

    	/** @var \Illuminate\Database\Eloquent\Builder $query */
    	$query = $crudable->modelname()::query();

	    if($search = $crudableRequest->get('search'))
	    {
	    	$query = $query->where(function ($q) use ($crudable, $search) {
	    		$fields = collect($crudable->fields)->filter(function ($field) {
	    			return !isset($field['searchable']) OR $field['searchable'] !== false;
			    });

			    $field = $fields->shift();
			    if( isset($field['search']) && is_callable($field['search']))
				    $q->where(function ($q2) use ($field, $search) {
						call_user_func($field['search'], $q2, $search);
				    });
			    else
				    $q->where($field['name'], 'LIKE', '%' . $search . '%');

			    $fields->each(function ($field) use ($q, $search) {
					if( isset($field['search']) && is_callable($field['search']))
						$q->orWhere(function ($q2) use ($field, $search) {
							call_user_func($field['search'], $q2, $search);
						});
					else
						$q->orWhere($field['name'], 'LIKE', '%' . $search . '%');
			    });
		    });
	    }

	    $sortKey = $crudableRequest->has('sort') ? $crudableRequest->get('sort') : $crudable->sort['key'];
	    $sortDir = $crudableRequest->has('dir') ? $crudableRequest->get('dir') : $crudable->sort['dir'];

	    $query->orderBy($sortKey, $sortDir);

    	$entries = $query->paginate( config('laradmin.index-length') )->appends($crudableRequest->all());

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
	    $crudable = $crudableRequest->crudable();
	    return view()->first([
		    'laradmin::' . $crudable->route . '.create',
		    'laradmin::crudable.create'
	    ], compact('crudable'));
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
	    $crudable = $crudableRequest->crudable();
	    $validatedData = $crudableRequest->validatedData();
	    try
	    {
		    $crudable->create($validatedData);
	    }
	    catch(QueryException $exception)
	    {
		    return redirect()->back()->withInput()->with('error', $exception->getMessage());
	    }

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
	    $crudable = $crudableRequest->crudable()
	                                ->load($model_id);
	    return view()->first([
		    'laradmin::' . $crudable->route . '.edit',
		    'laradmin::crudable.edit'
	    ], compact('crudable'));
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
	    $crudable = $crudableRequest->crudable()
	                                ->load($model_id);
	    $validatedData = $crudableRequest->validatedData();
	    try
	    {
		    $crudable->update($validatedData);
	    }
	    catch(QueryException $exception)
	    {
		    return redirect()->back()->withInput()->with('error', $exception->getMessage());
	    }

	    return redirect()->route( config('laradmin.adminpath') . '.' . $crudable->route . '.index')
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
	    $crudable = $crudableRequest->crudable()
	                                ->load($model_id);
	    try
	    {
		    $crudable->delete();
	    }
	    catch(QueryException $exception)
	    {
	    	return redirect()->back()->with('error', $exception->getMessage());
	    }

	    return redirect()->route( config('laradmin.adminpath') . '.' . $crudable->route . '.index')
	                     ->with('success', 'Success');
    }

}
