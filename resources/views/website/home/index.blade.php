@extends('website.layouts.master')

@section('title')
	Welcome
@endsection

@section('carousel')
	@include('website.partials.carousel')
@endsection

@section('content')
	<section id="name">
		<div class="container">
			<center><h2>AgriMap</h2></center>
			<hr>
			
	        <?php $curr = 0; ?>

			@for($i = 1; $i <= 4; $i++)
			    <div class="row">
			        @for($j = 1; $j <= 3; $j++)
			            @if($curr < count($regions))
			                <div class="col-md-4 text-center">
			                	<div><center><span class="fa fa-power-off"></span></center></div>
			                    <h4><a href="regions/{{ $regions[$curr]->id }}">{{ $regions[$curr]->name }}</a></h4>
			                    <p>{{ $regions[$curr]->name }} has a variety of crops that are grown within it. <br>Click on this region to know the crops grown there.</p>
			                </div>
			            @endif
			        <?php $curr++; ?>
			        @endfor
			    </div>
			@endfor
		</div>
	</section>

	<section id="services">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias dignissimos laboriosam, neque suscipit corporis totam ipsam numquam soluta, iure nihil ex atque, odit quasi quia illo? Necessitatibus dolor facere atque eveniet tempora. Fugiat molestiae excepturi quisquam ipsum culpa ducimus ea dolorum alias nobis itaque iste ratione ut id numquam non eos porro inventore, soluta modi commodi dolorem quo eum iusto maiores. Consequatur ipsam molestiae aut explicabo esse dolorem voluptatibus perspiciatis qui expedita est nihil, asperiores vitae nobis id veritatis veniam repellendus nulla ab minus amet! Nisi quam autem, nobis provident est sint ut unde neque quo. Nam nisi vel eaque!</p>
				</div>
			</div>
		</div>
	</section>

	<section id="info">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae placeat blanditiis veniam repellendus sint nihil et tempora praesentium quod amet doloribus nobis nemo ad fuga cupiditate nam vel quis unde fugit sed maxime, tempore. Corrupti soluta totam tempora est accusantium! Deleniti accusamus ut, distinctio unde maiores dolor aspernatur quos nam, tempore veniam error amet id qui temporibus ducimus sint magni corporis a at. Cumque molestias voluptate, iste quibusdam, quas nihil obcaecati, delectus quo doloribus explicabo unde doloremque non ipsum itaque quaerat dicta! Alias, veniam iste incidunt dolorem quidem beatae sequi cumque blanditiis, magni ut suscipit ipsam inventore saepe corporis error!</p>
				</div>
			</div>
			
			<div class="gap"></div>

			<div class="row">
				<div class="col-sm-6 col-sm-offset-6">
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet corporis voluptates a eaque, adipisci laudantium ut quibusdam expedita non suscipit recusandae consequatur minus temporibus, sunt nisi quis cumque iste, quod ad laboriosam magnam nobis saepe in pariatur at? Earum at iure quidem alias distinctio tempore consequatur dolorem, repellat quae sint! Dolores sit voluptatem deserunt, architecto qui dolorem, dolor voluptate molestias, porro aperiam officiis doloremque et inventore dolore obcaecati quibusdam delectus. Quibusdam labore sunt nesciunt, modi necessitatibus voluptatum accusamus, dignissimos voluptatem qui quidem culpa, quod laudantium, sequi dolor! Consequuntur vero officiis voluptatem tenetur, quod dolore, ratione est vel porro sequi laudantium.</p>
				</div>
			</div>
		</div>
	</section>

	<section id="products">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<p class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa temporibus magnam, nostrum, incidunt dolorum alias quis quas cum enim facere libero. Vitae, voluptate, animi, voluptatum quisquam natus illum aspernatur, quos beatae consequatur unde ipsa quibusdam. Repudiandae eligendi eum dolorum quo porro voluptatum dolorem dolor aspernatur mollitia? Quibusdam dolore autem, soluta voluptatem at libero hic, nisi eos dolores minus, fugit eveniet nesciunt aliquid repellendus facilis in alias! Modi error quibusdam, neque eveniet eligendi. Neque iusto suscipit ipsum officiis quibusdam labore cum inventore culpa rem, molestiae quos necessitatibus perferendis ullam ratione? Rerum, nobis, iure. Laboriosam aliquid, quod temporibus quos ab repudiandae nisi aspernatur asperiores aliquam quisquam. Saepe consectetur magni corrupti? Consequuntur at placeat fugiat nobis sequi reiciendis obcaecati est velit natus sed sint ad eum esse, accusantium, aliquam. Dolorem quia at animi dicta maiores sequi rem consectetur, suscipit maxime. Alias officia eaque in, quaerat obcaecati natus quas pariatur, repudiandae et fuga consequuntur!</p>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('footer')
	@include('website.partials.footer')
@endsection