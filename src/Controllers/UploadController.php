<?php namespace Warkensoft\Laradmin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function store(Request $request)
    {
	    $this->validate($request, [
		    'file' => 'required|image',
	    ]);

	    $uploadedFile = $request->file('file');
	    if(!$uploadedFile)
		    return '';

	    $filename = $uploadedFile->store('public');

	    return '/' . str_replace('public', 'storage', $filename);
    }
}
