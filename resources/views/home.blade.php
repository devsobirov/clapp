@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-12">
            @foreach ($g_categories->whereNull('parent_id') as $parent)
            @if (count($g_categories->where('parent_id', $parent->id)))
            <div class="d-flex align-items-center justify-content-between mb-2">
                <h4 class=" mb-0 cate-title">{{$parent->title}}</h4>
                <a href="{{route('menu.category', $parent->id)}}" class="text-primary">View all <i class="fa-solid fa-angle-right ms-2"></i></a>
            </div>
            <div class="swiper mySwiper-2">
                <div class="swiper-wrapper">
                @foreach ($g_categories->where('parent_id', $parent->id) as $category)
                    <div class="swiper-slide">
                        <div class="cate-bx text-center">
                            <a href="{{route('menu.menu', $category->id)}}" class="card b-hover">
                                <div class="card-body">
                                    <img class="d-inline-block p-1 rounded" src="{{$category->image_url()}}" alt="{{$category->title}}"
                                        style="width: 60px; height: 60px;">
                                    <h6 class="mb-0 font-w500">{{$category->title}}</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('scripts')
 <script>
	  var swiper2 = new Swiper(".mySwiper-2", {
        slidesPerView: 7,
        spaceBetween: 30,
		// loop:true,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
		breakpoints: {
          360: {
            slidesPerView: 2,
            spaceBetween: 20,
          },
		  600: {
            slidesPerView: 3,
            spaceBetween: 20,
          },
		  768: {
            slidesPerView: 4,
            spaceBetween: 20,
          },
          1024: {
            slidesPerView: 5,
            spaceBetween: 20,
          },
		  1200: {
            slidesPerView: 6,
            spaceBetween: 20,
          },
		  1480: {
            slidesPerView: 6,
            spaceBetween: 20,
          },
		  1600: {
            slidesPerView: 6,
            spaceBetween: 20,
          },
		  1920: {
            slidesPerView: 6,
            spaceBetween: 10,
          },

        },

      });

	//   var swiper3 = new Swiper(".mySwiper-3", {
    //     slidesPerView: 3,
    //     spaceBetween: 20,
    //     pagination: {
    //       el: ".swiper-pagination",
    //       clickable: true,
    //     },
	// 	breakpoints: {
    //       360: {
    //         slidesPerView: 1,
    //         spaceBetween: 20,
    //       },
	// 	  600: {
    //         slidesPerView: 1,
    //         spaceBetween: 20,
    //       },
	// 	  768: {
    //         slidesPerView: 2,
    //         spaceBetween: 20,
    //       },
    //       1024: {
    //         slidesPerView: 2,
    //         spaceBetween: 20,
    //       },
	// 	  1200: {
    //         slidesPerView: 2,
    //         spaceBetween: 20,
	// 		},
	// 	1480: {
    //         slidesPerView: 3,
    //         spaceBetween: 20,
    //       },
	// 	1600: {
	// 		slidesPerView: 3,
	// 		spaceBetween: 20,
    //       },
	// 	  1920: {
    //         slidesPerView: 3,
    //         spaceBetween: 20,
    //       },

    //     },
    //   });

    //   var swiper6 = new Swiper(".mySwiper-6", {
    //     slidesPerView: 5,
    //     spaceBetween: 30,
    //     pagination: {
    //       el: ".swiper-pagination",
    //       clickable: true,
    //     },
	// 	breakpoints: {
    //       360: {
    //         slidesPerView: 1,
    //         spaceBetween: 20,
    //       },
	// 	  600: {
    //         slidesPerView: 2,
    //         spaceBetween: 20,
    //       },
    //       1024: {
    //         slidesPerView: 3,
    //         spaceBetween: 20,
    //       },
	// 	 1480: {
    //         slidesPerView: 5,
    //         spaceBetween: 20,
    //       },

	// 	  1600: {
    //         slidesPerView: 5,
    //         spaceBetween: 20,
    //       },
	// 	  1920: {
    //         slidesPerView: 5,
    //         spaceBetween: 20,
    //       },

    //     },
    //   });
	//   var swiper5 = new Swiper(".mySwiper-5", {
    //     slidesPerView: 3,
    //     spaceBetween: 30,
    //     pagination: {
    //       el: ".swiper-pagination",
    //       clickable: true,
    //     },
	// 	breakpoints: {
    //       360: {
    //         slidesPerView: 1,
    //         spaceBetween: 20,
    //       },
	// 	  768: {
    //         slidesPerView: 3,
    //         spaceBetween: 20,
    //       },
	// 	  768: {
    //         slidesPerView: 2,
    //         spaceBetween: 20,
    //       },
    //       1024: {
    //         slidesPerView: 2,
    //         spaceBetween: 20,
    //       },
	// 	  1200: {
    //         slidesPerView: 2,
    //         spaceBetween: 20,
    //       },
	// 	  1480: {
    //         slidesPerView: 3,
    //         spaceBetween: 20,
    //       },
	// 	  1600: {
    //         slidesPerView: 3,
    //         spaceBetween: 20,
    //       },
	// 	  1920: {
    //         slidesPerView: 3,
    //         spaceBetween: 20,
    //       },

    //     },
    //   });

    </script>
@endsection
