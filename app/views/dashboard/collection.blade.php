<div class="collection">
	@if($authUserGroup->name == 'Developer')
		<span class="collection-drop"></span>
	@endif
	<a href="{{ route('registers', $collection->slug) }}">
		<div class="collection-info">
			<span class="collection-total-registers">{{ $collection->registers()->count() }}</span>
			<span class="collection-name">{{ $collection->name }}</span>
		</div>
		<?php 
			try{
				$lastUpdate = strtotime($collection->registers()->orderBy('updated_at')->first()->updated_at); 
			} catch(Exception $e) {
				$lastUpdate = false;
			}
		?>
		@if($lastUpdate !== FALSE)
			<span class="collection-updated">Updated at {{ date('d/m/Y', $lastUpdate) }}, {{ date('H:i', $lastUpdate) }}</span>
		@endif
	</a>
	@if($authUserGroup->name == 'Developer')
		<span class="collection-actions">
			<a class="view" href="{{ route('registers', $collection->slug) }}">View items</a>
			<a class="edit" href="{{ route('collections.edit', $collection->id) }}">Edit collection</a>
			<a class="delete" href="{{ route('collections.destroy', $collection->id) }}">Delete collection</a>
		</span>
	@endif
</div>