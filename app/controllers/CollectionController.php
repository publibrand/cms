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

}
