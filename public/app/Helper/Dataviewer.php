<?php 

namespace App\Helper;
use Validator;


trait Dataviewer{
	public $operators = [
		'equal' => '=',
		'not_equal' => '<>',
		'less_than' => '<',
		'greater_than' => '>',
		'less_than_or_equal_to' => '<=',
		'greater_than_or_equal_to' => '>='
	];

	public  function scopeSearchPaginateAndOrder($query)
	{
		$request = app()->make('request');

		$v = Validator::make($request->only([
			'column','direction','page','per_page','search_input','user_id'
		]),
		[
			'column'=>'required|alpha_dash|in:'.implode(',',self::$tblcolumns),
			'direction'=>'required|in:asc,desc',
			'user_id'=>'integer|min:1',
			'per_page'=>'integer|min:1',
			'search_column'=>'alpha_dash|in'.implode(',', self::$tblcolumns),
			'search_operator'=>'alpha_dash|in:'.implode(',', array_keys($this->operators)),
			'search_input'=>'max:255'
		]);

		if ($v->fails()) {
			dd($v->messages());
		}
		    
		    return $query
			->orderBy($request->column,$request->direction)
			->where(function($query) use ($request){
				if ($request->has('search_input')) {
					$query->where($request->search_column,$this->operators[$request->search_operator],$request->search_input);
				}
			})
			->where("user_id","=",$request->user_id)
			->paginate($request->per_page);
	}

}