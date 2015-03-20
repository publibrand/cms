<div class="dashboard-analytics">
	<div class="analytics-header">
		<h2>{{ Lang::get('messages.my_trafic') }} - {{ Lang::get('messages.updated_at') }} {{ $analyticsCreatedAt }} <strong class="analytics-reload">({{ Lang::get('messages.ga_reload') }})</strong></h2>
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
							<span class="info-type">{{ Lang::get('messages.ga_sessions') }}</span>
						</div>
						<div class="info">
							<span class="info-value">{{ $analytics['users'] }}</span>
							<span class="info-type">{{ Lang::get('messages.ga_users') }}</span>
						</div>
						<div class="info">
							<span class="info-value">{{ $analytics['pages'] }}</span>
							<span class="info-type">{{ Lang::get('messages.ga_pages') }}</span>
						</div>
						<div class="info">
							<span class="info-value">{{ $analytics['pagesViewBySession'] }}</span>
							<span class="info-type">{{ Lang::get('messages.ga_pagessessions') }}</span>
						</div>
						<div class="info">
							<span class="info-value">{{ $analytics['avgDuration'] }}</span>
							<span class="info-type">{{ Lang::get('messages.ga_duration') }}</span>
						</div>
						<div class="info">
							<span class="info-value">{{ $analytics['bounceRate'] }}</span>
							<span class="info-type">{{ Lang::get('messages.ga_rejection') }}</span>
						</div>
						<div class="info">
							<span class="info-value">{{ $analytics['newSessions'] }}</span>
							<span class="info-type">{{ Lang::get('messages.ga_new_sessions') }}</span>
						</div>
					</div>
					<span class="maximize">+</span>
			</div>
			<div class="analytics-page-views">
				<ul>
					<li>
						<span class="page-title">{{ Lang::get('messages.pages') }}</span>
						<span class="views-title">{{ Lang::get('messages.views') }}</span>
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
			<p>{{ Lang::get('messages.ga_configga') }}</p>
		@endif
		
		@include('partials.loader')
	</div>
</div>

