<?php

class CollectionController extends BaseController {

	public function index() {
		
		$collections = Collection::all();

		return View::make('dashboard.Collections.index')
				   ->with('collections', $collections);
                   
	}

	public function create() {

		return View::make('dashboard.collections.create');

	}


	public function store() {

		$labels = [
			'name' => 'Name',
		];

		$rules = [
            'name' => 'required',
		];

		foreach(Input::get('fields') as $key => $values) {
			$field = "fields." . $key . ".";
			$options = FALSE;

			foreach($values as $key => $value) {

				if($key == 'type' && $value == 'select'){
					$options = TRUE;
				}

				if($key !== "value" && ($key !== 'options' || $options !== FALSE)) {
					$labels[$field . $key] = 'required';
					$rules[$field . $key] = 'required';
				}

			} 
		}

        $validator = Validator::make(Input::all(), $rules, [], $labels);

		if($validator->fails()) {
			return Response::json([
				'errors' => $validator->getMessageBag()->toArray(),
            ], 400); 
		}

		$collection = new Collection;
		$collection->name = Input::get('name');
		$collection->form = str_replace("'", "",json_encode(Input::get('fields')));

		$max = Input::get('max');
		$collection->max = empty($max) ? -1 : $max;
		
		$collection->save();

		return Response::json([
			'collection' => $collection,
			'redirect' => route('collections'),
			'timeiout' => 1000,
		], 200);

	}


	public function show($id){

		$collection = Collection::find($id);

		return View::make('dashboard.collections.index')
				   ->with('collection', $collection);

	}

	public function edit($id) {

		$collection = Collection::find($id);

		return View::make('dashboard.collections.edit')
				   ->with('collection', $collection);
	
	}

	public function update($id) {


	}

	public function destroy($id) {

		$collection = Collection::find($id);
		$collection->delete();

		return Response::json([
			'redirect' => route('collections'),
        ], 200); 

	}

	public function addField() {

		$view = View::make('dashboard.collections.field')
				    ->with('fieldNumber', Input::get('fieldNumber'));

		return Response::json([
			'view' => $view->render(),
        ], 200); 

	}

}
