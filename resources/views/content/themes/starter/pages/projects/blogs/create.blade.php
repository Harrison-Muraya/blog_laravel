@extends("$theme_dir.layouts.$layoutName")

{{-- {{dd($theme_dir, $layoutName)}} --}}
{{-- Content --}}
@section('content')

<main class="main">
       <!-- Hero Section -->
       <section id="hero" class="hero section dark-background">

        <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
  
          <div class="carousel-item active">
            <img src="assets/img/hero-carousel/hero-carousel-1.jpg" alt="">
            <div class="container">
              <h2>Welcome to Your New Favorite Space – Where Inspiration Meets Discovery</h2>
              <p>Hello, and welcome! We’re so excited to have you here. This is a space for curious minds, creative souls, and those looking to explore new ideas and perspectives. 
                Whether you’re seeking inspiration, insightful articles, or just a bit of thoughtful entertainment, you’ve found the right place.</p>
              <a href="about.html" class="btn-get-started">Read More</a>
            </div>
          </div><!-- End Carousel Item -->
  
          <div class="carousel-item">
            <img src="assets/img/hero-carousel/hero-carousel-2.jpg" alt="">
            <div class="container">
              <h2>At vero eos et accusamus</h2>
              <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut.</p>
              <a href="about.html" class="btn-get-started">Read More</a>
            </div>
          </div><!-- End Carousel Item -->
  
          <div class="carousel-item">
            <img src="assets/img/hero-carousel/hero-carousel-3.jpg" alt="">
            <div class="container">
              <h2>Temporibus autem quibusdam</h2>
              <p>Beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt omnis iste natus error sit voluptatem accusantium.</p>
              <a href="about.html" class="btn-get-started">Read More</a>
            </div>
          </div><!-- End Carousel Item -->
  
          <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
          </a>
  
          <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
          </a>
  
          <ol class="carousel-indicators"></ol>
  
        </div>
  
      </section>
      <!-- /Hero Section -->
</main>


@endsection