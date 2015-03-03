<div class="dashboard-analytics">
	<div class="analytics-header">
		<h2>My trafic - Updated at {{ $analyticsCreatedAt }} <strong class="analytics-reload">(reload)</strong></h2>
		<span class="minimize">-</span>
	</div>
	<div class="analytics-wrap">
		@if($analytics !== FALSE)
			<div class="analytics-charts">
					<div id="pages-view" class="pages-view" data-pages-view='{{ $analytics["pagesViewLastWeek"] }}'>
						
					</div>
					<div class="analytics-info">
						<div class="info">
							<span class="info-value">{{ $analytics['sessions'] }}</span>
							<span class="info-type">Sessions</span>
						</div>
						<div class="info">
							<span class="info-value">{{ $analytics['users'] }}</span>
							<span class="info-type">Users</span>
						</div>
						<div class="info">
							<span class="info-value">{{ $analytics['pages'] }}</span>
							<span class="info-type">Pages</span>
						</div>
						<div class="info">
							<span class="info-value">{{ $analytics['pagesViewBySession'] }}</span>
							<span class="info-type">Pages/Sessions</span>
						</div>
						<div class="info">
							<span class="info-value">{{ $analytics['avgDuration'] }}</span>
							<span class="info-type">Duration</span>
						</div>
						<div class="info">
							<span class="info-value">{{ $analytics['bounceRate'] }}</span>
							<span class="info-type">Rejection</span>
						</div>
						<div class="info">
							<span class="info-value">{{ $analytics['newSessions'] }}</span>
							<span class="info-type">New sessions</span>
						</div>
					</div>
					<span class="maximize">+</span>
			</div>
			<div class="analytics-page-views">
				<ul>
					<li>
						<span class="page-title">Page</span>
						<span class="views-title">Views</span>
					</li>
					@foreach($analytics['pageViews'] as $page)
						<li>
							<a target="_blank" href="http://{{ $analytics['clientSite'] . $page[0] }}" class="page">{{ $analytics['clientSite'] . $page[0] }}</a>
							<span class="views">{{ $page[1] }}</span>
						</li>
					@endforeach
				</ul>
			</div>
		@else
			<p>You need to set your analytics credentials in the config page</p>
		@endif
	</div>
</div>