<div class="dashboard-analytics">
	<div class="analytics-header">
		<h2>My trafic</h2>
		<span class="minimize">-</span>
	</div>
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
	</div>
</div>