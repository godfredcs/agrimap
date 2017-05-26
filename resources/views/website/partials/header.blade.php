<header>
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynav">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="/" class="navbar-brand">Agrimap</a>
			</div>
			<div id="mynav" class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="{{ empty(Request::segment(1)) ? 'current' : null }}"><a href="/">Home</a></li>
					<li class="{{ Request::segment(1) === 'crops' ? 'current' : null }}"><a href="/crops">Crops</a></li>
					<li class="{{ Request::segment(1) === 'regions' ? 'current' : null }}"><a href="/regions">Regions</a></li>
					<li class="{{ Request::segment(1) === 'districts' ? 'current' : null }}"><a href="/districts">Districts</a></li>
				</ul>
			</div>
		</div>
	</nav>
</header>