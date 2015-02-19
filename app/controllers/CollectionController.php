<?php

class CollectionController extends BaseController {

	public function index() {
		
		$collections = Collection::where('is_visible', '=', 1)
								 ->get();

		return View::make('dashboard.Collections.index')
				   ->with('collections', $collections);
                   
	}

	public function create() {

		return View::make('dashboard.collections.create');

	}

	private function generateLabelsAndRules() {

		$labels = [
			'name' => 'Name',
			'slug' => 'Slug'
		];

		$rules = [
            'name' => 'required',
            'slug' => 'required',
		];

		foreach(Input::get('fields') as $key => $values) {
			$field = "fields." . $key . ".";
			$options = FALSE;

			foreach($values as $key => $value) {

				if($key == 'type' && $value == 'select'){
					$options = TRUE;
				}

				if($key !== "value" && ($key !== 'options' || $options !== FALSE)) {
					$labels[$field . $key] = ucfirst($key);
					$rules[$field . $key] = 'required';
				}

			} 
		}

		return [
			'labels' => $labels,
			'rules' => $rules,
		];

	}

	private function formatFields($field) {
		return str_replace("'", "", json_encode($field));
	}

	private function formatMax($max) {
		return empty($max) ? -1 : $max;
	}

	public function store() {
		
		$labelsAndRules = $this->generateLabelsAndRules();

        $validator = Validator::make(Input::all(), $labelsAndRules['rules'], [], $labelsAndRules['labels']);

		if($validator->fails()) {
			return Response::json([
				'errors' => $validator->getMessageBag()->toArray(),
            ], 400); 
		}

		$collection = new Collection;
		$collection->name = Input::get('name');
		$collection->slug = Input::get('slug');
		$collection->fields = $this->formatFields(Input::get('fields'));
		$collection->max = $this->formatMax(Input::get('max'));
		$collection->save();

		return Response::json([
			'collection' => $collection,
			'redirect' => route('collections'),
			'timeiout' => 1000,
		], 200);

	}


	public function show($id){

		$collection = Collection::find($id);

		return View::make('dashboard.collections.show')
				   ->with('collection', $collection);

	}

	public function edit($id) {

		$collection = Collection::find($id);
		$fields = json_decode($collection->fields);

		return View::make('dashboard.collections.edit')
				   ->with('collection', $collection)
				   ->with('fields', $fields);
	
	}

	public function update($id) {

		$labelsAndRules = $this->generateLabelsAndRules();

        $validator = Validator::make(Input::all(), $labelsAndRules['rules'], [], $labelsAndRules['labels']);

		if($validator->fails()) {
			return Response::json([
				'errors' => $validator->getMessageBag()->toArray(),
            ], 400); 
		}

		$collection = Collection::find($id);
		$collection->name = Input::get('name');
		$collection->slug = Input::get('slug');
		$collection->fields = $this->formatFields(Input::get('fields'));
		$collection->max = $this->formatMax(Input::get('max'));
		$collection->save();

		return Response::json([
			'collection' => $collection,
			'redirect' => route('collections'),
			'timeiout' => 1000,
		], 200);

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

	public function search() {

		$query = trim(Input::get('query'));

		$collections = Collection::where('name', 'like', $query . '%')
								 ->get();

	 	if($collections->count() == 0) {
	 		return Response::json([
				'view' => View::make('partials.message')
							  ->with('message', "No result found for '" . $query . "'")
							  ->render(),
	        ], 200); 
	 	}

		$view = "";

		foreach($collections as $collection) {
			$view.= View::make('dashboard.collection')
				   		->with('collection', $collection)
				   		->render();
		}

		return Response::json([
			'view' => $view,
        ], 200);

	}

}
