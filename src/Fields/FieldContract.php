<?php namespace Warkensoft\Laradmin\Fields;

interface FieldContract
{
	public static function Setup( $parameters = [] );
	public function view();
	public function parameters();
	public function value(\Illuminate\Foundation\Http\FormRequest $request);
	public function filterValue($value);
}