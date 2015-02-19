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
						<li>
							<a href="#">Page 1</a>
						</li>
						<li>
							<a href="#">Page 2</a>
						</li>
						<li>
							<a href="#">Page 3</a>
						</li>
						<li>
							<a href="#">Page 4</a>
						</li>
						<li>
							<a href="#">Add +</a>
						</li>
					</ul>
				</li>
				<li class="drop-down">
					Collections
					<ul>
						@foreach($menu['collections'] as $collection)
						<li>
							<a href="#">{{ $collection->name }}</a>
						</li>
						@endforeach
						<li>
							<a href="{{ route('collections.create') }}">Add +</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#">Config</a>
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