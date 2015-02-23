<?php

class RegisterController extends BaseController {

	public function index($slug) {

		try{
			$collection = Collection::where('slug','=', $slug)
									->firstOrFail();
		} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return Redirect::to('/');
		}

		$registers = $collection->registers();
								
		if($collection->max == 1) {

			if($registers->count() == 0) {
				return Redirect::route('registers.create', $slug);
			}

			return Redirect::route('registers.show', [
				$slug,
				$registers->first()
						  ->id,
			]);

		}

		return View::make('dashboard.registers.index')
				   ->with('collection', $collection);

	}

	public function create($slug) {
		
		try{
			$collection = Collection::where('slug','=', $slug)
									->firstOrFail();
		} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return Redirect::to('/');
		}
		
		if($collection->max == 1 && $collection->registers()->count() == 1) {

			$register = $collection->registers()->first();

			return Redirect::route('registers.edit', [
				$slug,
				$register->id
			]);

		}

		$fields = json_decode($collection->fields, TRUE);
		
		return View::make('dashboard.registers.create')
				   ->with('collection', $collection)
				   ->with('fields', $fields);

	}
	
	private function generateLabelsAndRules($store = TRUE){
		
		$labels = [
			'name' => 'Name',
		];

		$rules = [
            'name' => 'required',
		];

		$collection = Collection::find(Input::get('collections_id'));
		$fields = json_decode($collection->fields, TRUE);

		foreach($fields AS $field){
			if(!empty($field['required'])) {

				if(Input::get('field_type.' . $field['label']) == 'file' && $store === FALSE) {
					continue;
				}

				$labels['fields.' . $field['label']] = $field['name'];
				$rules['fields.' . $field['label']] = 'required';

			}
		}
		
		return [
			'labels' => $labels,
			'rules' => $rules
		];
	}
	

	private function saveMetaData($register, $store = TRUE) {

		$fields = Input::all();
		$fields = $fields['fields'];
		
		foreach($fields as $key => $value) {
			if(Input::hasFile('fields.' . $key)) {

				$value = $this->saveFile(Input::file('fields.' . $key));

			} elseif(Input::get('field_type.' . $key) == 'file') {
				
				$value = MetaData::where('key', '=', $key)
								 ->first()
								 ->value;

			}
			
			if($store) {

				$metaData = new MetaData;
				$metaData->registers_id = $register->id;

			} else {

				$metaData = MetaData::where('key', '=', $key)
									->first();

			}

			$metaData->key = $key;
			$metaData->value = $value;
			$metaData->save();
		}

	}

	private function storeMetaData($register) {

		$this->saveMetaData($register);

	}

	private function updateMetaData($register) {

		$this->saveMetaData($register, FALSE);

	}

	public function store($slug) {

		$labelsAndRules = $this->generateLabelsAndRules();
        $validator = Validator::make(Input::all(), $labelsAndRules['rules'], [], $labelsAndRules['labels']);

		if($validator->fails()) {

			return Response::json([
				'errors' => $validator->getMessageBag()->toArray(),
            ], 400); 

		}
		
		$register = new Register;
		$register->name = Input::get('name');
		$register->collections_id = Input::get('collections_id');
		$register->save();
		
		$this->storeMetaData($register);
		
		return Response::json([
			'register' => $register,
			'redirect' => route('registers', $slug),
			'timeiout' => 1000,
		], 200);
		
	}
	
	
	public function show($slug, $id){

		try{
			$collection = Collection::where('slug','=', $slug)
									->firstOrFail();

			$register = $collection->registers()
								   ->findOrFail($id);

		} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return Redirect::to('/');
		}

		$metaData = $register->metaData()
							 ->get();

		return View::make('dashboard.registers.show')
				   ->with('metaData', $metaData)
				   ->with('register', $register);

	}

	private function formatMetaData($metaData) {

		$meta = [];

		foreach($metaData as $values){

			$meta[$values['key']] = $values['value'];

		}

		return $meta;

	}

	public function edit($slug, $id) {

		try{
			$collection = Collection::where('slug', '=', $slug)
								    ->firstOrFail();

			$register = $collection->registers()
								   ->findOrFail($id);
		} catch(Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			return Redirect::to('/');
		}

		$metaData = $register->metaData()
							 ->get()
							 ->toArray();

		$metaData = $this->formatMetaData($metaData);
		
		$fields = json_decode($collection->fields, TRUE);
		
		return View::make('dashboard.registers.edit')
				   ->with('register', $register)
				   ->with('metadatas', $metaData)
				   ->with('collection', $collection)
				   ->with('fields', $fields);
	
	}

	public function update($slug, $id) {

		$labelsAndRules = $this->generateLabelsAndRules(FALSE);
		$validator = Validator::make(Input::all(), $labelsAndRules['rules'], [], $labelsAndRules['labels']);
		
		if($validator->fails()) {

			return Response::json([
				'errors' => $validator->getMessageBag()->toArray(),
            ], 400);
             
		}
		
		$register = Register::find($id);
		$register->name = Input::get('name');
		$register->collections_id = Input::get('collections_id');
		$register->save();
		
		$this->updateMetaData($register);
		
		return Response::json([
			'register' => $register,
			'redirect' => route('registers', $slug),
			'timeiout' => 1000,
		], 200);
		

	}

	public function destroy($slug, $id) {

		$register = Register::find($id);
		$register->delete();

		return Redirect::to('/registers/'.$slug);

	}

}
