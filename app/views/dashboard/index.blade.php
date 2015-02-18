@extends('layout')

@section('content')
		
	<div class="dashboard">
		<div class="container">
			<div class="dashboard-section">
				<h2>Collections</h2>
				{{ Form::open(['route' => 'auth.check', 'method' => 'POST', 'class' => 'search-form']) }}
					
					{{ Form::text('search') }}

					{{ Form::submit('Save'); }}

				{{ Form::close() }}
				<div class="dashboard-collections">
					<div class="dashboard-collection">
						
					</div>
					<div class="dashboard-collection">
						
					</div>
					<div class="dashboard-collection">
						
					</div>
				</div>
			</div>
			<div class="dashboard-section">
				<h2>Newest</h2>
				<div class="dashboard-activities">
					<ul>
						<li>
							<div class="activity-info">
								<span class="activity-date">7 jan, 01:25</span>
								<span class="activity-action">created</span>
							</div>
							<span class="activity">Lorem ipsum dolem atives a lards</span>
						</li>
						<li>
							<div class="activity-info">
								<span class="activity-date">7 jan, 01:25</span>
								<span class="activity-action">edit</span>
							</div>
							<span class="activity">Lorem ipsum dolem atives a lards</span>
						</li>
						<li>
							<div class="activity-info">
								<span class="activity-date">7 jan, 01:25</span>
								<span class="activity-action">remove</span>
							</div>
							<span class="activity">Lorem ipsum dolem atives a lards</span>
						</li>
						<li>
							<div class="activity-info">
								<span class="activity-date">7 jan, 01:25</span>
								<span class="activity-action">created</span>
							</div>
							<span class="activity">Lorem ipsum dolem atives a lards</span>
						</li>
						<li>
							<div class="activity-info">
								<span class="activity-date">7 jan, 01:25</span>
								<span class="activity-action">remove</span>
							</div>
							<span class="activity">Lorem ipsum dolem atives a lards</span>
						</li>
						<li>
							<div class="activity-info">
								<span class="activity-date">7 jan, 01:25</span>
								<span class="activity-action">edit</span>
							</div>
							<span class="activity">Lorem ipsum dolem atives a lards</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

@stop