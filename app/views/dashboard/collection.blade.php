<div class="collection">
	@if($authUserGroup->name == 'Developer')
		<span class="collection-drop"></span>
	@endif
	<a href="{{ route('registers', $collection->slug) }}">
		<div class="collection-info">
			<span class="collection-total-registers">{{ $collection->registers()->count() }}</span>
			<span class="collection-name">{{ $collection->name }}</span>
		</div>
		<span class="collection-updated">Atualizado em 12:30 de 01/08/1996</span>
	</a>
	@if($authUserGroup->name == 'Developer')
		<span class="collection-actions">
			<a class="view" href="{{ route('registers', $collection->slug) }}">View items</a>
			<a class="edit" href="{{ route('collections.edit', $collection->id) }}">Edit collection</a>
			<a class="delete" href="{{ route('collections.destroy', $collection->id) }}">Delete collection</a>
		</span>
	@endif
</div>