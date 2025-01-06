@extends('layouts.admin')

@section('title')
  {{ __('Dashboard') }}
@endsection

@section('content')
  <div class="page-content">
    <div class="page-title" style="margin-bottom:25px">
      <div class="row justify-content-between align-items-center">
        <div class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
          <div class="d-inline-block">
            <h5 class="h4 d-inline-block font-weight-400 mb-0"><b>Dashboard</b></h5><br>
          </div>
        </div>
      </div>
    </div>

    <!-- Banner Section -->
    {{-- <div class="swiper-container">
      <div class="swiper-wrapper">
        @foreach($banners as $banner)
          <div class="swiper-slide">
            <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->name }}">
          </div>
        @endforeach
      </div>

      <!-- Pagination, Navigation, Scrollbar -->
      <div class="swiper-pagination"></div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-scrollbar"></div>
    </div> --}}
  </div>

  <!-- Add Swiper CSS and JS here -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var swiper = new Swiper('.swiper-container', {
        slidesPerView: 1,  // One slide at a time
        spaceBetween: 10,   // Space between slides
        loop: true,         // Infinite looping
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        scrollbar: {
          el: '.swiper-scrollbar',
        },
      });
    });
  </script>

@endsection

<style>
  .swiper-container {
    position: relative; /* Set position to relative to position buttons inside */
    width: 100%;
    /* max-width: 600px; */
    height: 300px;
    margin: auto;
  }

  .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
    }
</style>
