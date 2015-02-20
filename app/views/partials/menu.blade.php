<header class="header">
	<div class="container">
		<nav class="menu">
			<a href="{{ url('/') }}">
				<h1>Title</h1>
			</a>
			<ul>
				<li class="drop-down">
					Pages
					<ul>
						@if(count($menu['pages']) > 0)
							@foreach($menu['pages'] as $page)
								<li>
									<a href="{{ route('registers.edit', ['pages', $page->id]) }}">{{ $page->name }}</a>
								</li>
							@endforeach
						@endif
						<li>
							<a href="{{ route('registers.create', 'pages') }}">Add +</a>
						</li>
					</ul>
				</li>
				<li class="drop-down">
					Collections
					<ul>
						@if(count($menu['collections']) > 0)
							@foreach($menu['collections'] as $collection)
								<li>
									<a href="{{ route('registers', $collection->slug) }}">{{ $collection->name }}</a>
								</li>
							@endforeach
						@endif
						<li>
							<a href="{{ route('collections.create') }}">Add +</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="{{ route('registers', 'config') }}">Config</a>
				</li>
				<li class="drop-down">
					{{ Sentry::getUser()->first_name }}
					<ul>
						<li>
							<a href="{{ route('users.profile') }}">Profile</a>
						</li>
						<li>
							<a href="{{ route('auth.logout') }}">Logout </a>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</header>