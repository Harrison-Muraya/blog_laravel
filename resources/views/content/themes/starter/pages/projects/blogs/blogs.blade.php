@extends("$theme_dir.layouts.$layoutName")
{{-- {{dd($theme_dir, $layoutName)}} --}}
{{-- Content --}}
@section('content')

       <!-- Blog Posts Section -->
       <section id="blog-posts" class="blog-posts section">

        <div class="container">
          <div class="row gy-4">

            @unless (count($blogs)==0)
    
            @foreach ($blogs as $blog)
           
            <div class="col-lg-4">
              <article class="position-relative h-100">
  
                <div class="post-img position-relative overflow-hidden">
                  <img src="assets/img/blog/blog-1.jpg" class="img-fluid" alt="">
                  <span class="post-date">December 12</span>
                </div>
  
                <div class="post-content d-flex flex-column">
  
                  <h3 class="post-title">{{$blog->title}}</h3>
  
                  <div class="meta d-flex align-items-center">
                    <div class="d-flex align-items-center">
                      <i class="bi bi-person"></i> <span class="ps-2">John Doe</span>
                    </div>
                    <span class="px-3 text-black-50">/</span>
                    <div class="d-flex align-items-center">
                      <i class="bi bi-folder2"></i> <span class="ps-2">Politics</span>
                    </div>
                  </div>
  
                  <p>{{$blog->content}}</p>
  
                  <hr>
  
                  <a href="/blogcontent/{{$blog->id}}" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
  
                </div>
  
              </article>
            </div><!-- End post list item -->
       
            @endforeach
                
            @else
                <p>No results</p>
            @endunless 
  
           

  
          </div>
        </div>
  
      </section>
      <!-- /Blog Posts Section -->


          <!-- Blog Pagination Section -->
    <section id="blog-pagination" class="blog-pagination section">

        <div class="container">
          <div class="d-flex justify-content-center">
            <ul>
              <li><a href="#"><i class="bi bi-chevron-left"></i></a></li>
              <li><a href="#">1</a></li>
              <li><a href="#" class="active">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li>...</li>
              <li><a href="#">10</a></li>
              <li><a href="#"><i class="bi bi-chevron-right"></i></a></li>
            </ul>
          </div>
        </div>
  
      </section><!-- /Blog Pagination Section -->
  

@endsection