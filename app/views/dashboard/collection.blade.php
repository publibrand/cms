<div class="dashboard-collection">
	<a href="{{ route('registers', $collection->slug) }}">
		<div class="collection-info">
			<span class="collection-total-registers">{{ $collection->registers()->count() }}</span>
			<span class="collection-name">{{ $collection->name }}</span>
		</div>
	</a>
</div>