<header class="header">
	<div class="container">
		<nav class="menu">
			<a class="title" href="{{ url('/') }}">
				<h1>{{ Lang::get('messages.title') }}</h1>
			</a>
			<span class="bars">
				<span></span>
				<span></span>
				<span></span>
			</span>
			<div class="clear-fix"></div>
			<ul class="menu-list">
				<li class="drop-down">
					{{ Lang::get('messages.pages') }}
					<ul>
						@if(count($menu['pages']) > 0)
							@foreach($menu['pages'] as $page)
								<li>
									<a href="{{ route('registers.edit', ['pages', $page->id]) }}">{{ $page->name }}</a>
								</li>
							@endforeach
						@endif
						<li class="more">
							<a href="{{ route('registers.create', 'pages') }}">+</a>
						</li>
					</ul>
				</li>
				<li class="drop-down collections">
					{{ Lang::get('messages.collections') }}
					<ul>
						@if(count($menu['collections']) > 0)
							@foreach($menu['collections'] as $collection)
								<li>
									<a href="{{ route('registers', $collection->slug) }}">{{ $collection->name }}</a>
								</li>
							@endforeach
						@endif
						@if($authUserGroup->name == 'Developer') 
							<li class="more">
								<a href="{{ route('collections.create') }}">+</a>
							</li>
						@endif
					</ul>
				</li>
				@if($authUserGroup->name == 'Developer' || $authUserGroup->name == 'Editor') 
					<li class="no-drop">
						<a href="{{ route('users') }}">{{ Lang::get('messages.users') }}</a>
					</li>
				@endif
				<li class="no-drop">
					<a href="{{ route('registers', 'config') }}">{{ Lang::get('messages.config') }}</a>
				</li>
				<li class="drop-down">
					{{ Sentry::getUser()->first_name }}
					<ul>
						<li>
							<a href="{{ route('users.profile') }}">{{ Lang::get('messages.profile') }}</a>
						</li>
						<li>
							<a href="{{ route('auth.logout') }}">{{ Lang::get('messages.logout') }}</a>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</header>