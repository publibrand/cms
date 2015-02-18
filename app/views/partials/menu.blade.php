<header class="header">
	<div class="container">
		<nav class="menu">
			<h1>Title</h1>
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
					</ul>
				</li>
				<li class="drop-down">
					Collections
					<ul>
						<li>
							<a href="#">Collection 1</a>
						</li>
						<li>
							<a href="#">Collection 2</a>
						</li>
						<li>
							<a href="#">Collection 3</a>
						</li>
						<li>
							<a href="#">Collection 4</a>
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
							<a href="#">Profile</a>
						</li>
						<li>
							<a href="#">Logout </a>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</header>