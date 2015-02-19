<?php

class RegisterController extends BaseController {

	public function index($slug) {
		$collection = Collection::where('slug','=',$slug)->first();
		$registers = Register::where('collections_id','=',$collection->id)->get();
		
		return View::make('dashboard.Registers.index')
					->with('registers', $registers);
	}

	public function create($slug) {
		
		$collection = Collection::where('slug','=',$slug)->first();
		
		$fields = json_decode($collection->fields, TRUE);
		
		return View::make('dashboard.registers.create')
				   ->with('collection', $collection)
				   ->with('fields', $fields);

	}
	
	private function generateLabelsAndRules(){
		
		$labels = [
			'name' => 'Name',
		];

		$rules = [
            'name' => 'required',
		];

		$collection = Collection::find(Input::get('collections_id'));
		$fields = json_decode($collection->fields, TRUE);
		foreach($fields AS $field){
			if(!empty($field['required']) ){
				$labels['fields.'.$field['label']] = $field['label'];
				$rules['fields.'.$field['label']] = 'required';
			}
		}
		
		return [
			'labels'=>$labels,
			'rules'=>$rules
		];
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
		
		$fields = Input::all();
		$fields = $fields['fields'];
		
		foreach($fields as $key => $value) {
			if(Input::hasFile('fields.'.$key)) {
				$value= $this->saveFile(Input::file('fields.'.$key));
			}
			
			$metaData = new MetaData;
			$metaData->registers_id = $register->id;
			$metaData->key = $key;
			$metaData->value = $value;
			$metaData->save();
		}
		
		
		
		return Response::json([
			'register' => $register,
			'redirect' => route('registers', $slug),
			'timeiout' => 1000,
		], 200);
		
	}
	
	
	public function show($id){

		$register = Register::find($id);

		return View::make('dashboard.registers.index')
				   ->with('register', $register);

	}

	public function edit($slug, $id) {

		$register = Register::find($id);
		$metadatas_db = $register->metaData()->get()->toArray();
		
		foreach($metadatas_db as $metadata){
			$metadatas[$metadata['key']]=$metadata['value'];
		}
		
		$collection = Collection::where('slug', '=', $slug)->first();
		$fields = json_decode($collection->fields, TRUE);
		
		if($collection->id != $register->collections_id){
			die('ERROR'); // TO DO
		}
		
		return View::make('dashboard.registers.edit')
				   ->with('register', $register)
				   ->with('metadatas', $metadatas)
				   ->with('collection', $collection)
				   ->with('fields', $fields);
	
	}

	public function update($slug, $id) {

		$labelsAndRules = $this->generateLabelsAndRules();
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
		
		$fields = Input::all();
		$fields = $fields['fields'];
		
		foreach($fields as $key => $value) {
			if(Input::hasFile('fields.'.$key)) {
				$value= $this->saveFile(Input::file('fields.'.$key));
			}else if(Input::get('field_type.'.$key)=='file') {
				$value = MetaData::where('key', '=', $key)->first()->value;
			}
			
			
			$metaData = MetaData::where('key', '=', $key)->first();
			$metaData->value = $value;
			$metaData->save();
		}
		
		
		return Response::json([
			'register' => $register,
			'redirect' => route('registers', $slug),
			'timeiout' => 1000,
		], 200);
		

	}

	public function destroy($id) {

		$register = Register::find($id);
		$register->delete();

		return Response::json([
			'redirect' => route('registers'),
        ], 200); 

	}

	public function addField() {

		$view = View::make('dashboard.registers.field')
				    ->with('fieldNumber', Input::get('fieldNumber'));

		return Response::json([
			'view' => $view->render(),
        ], 200); 

	}

}
