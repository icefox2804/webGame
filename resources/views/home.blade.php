@extends('layouts.app')

@section('title', 'Trang chủ - Game Store')

@section('content')

    <!-- Carousel Video -->
    <div id="videoCarousel" class="carousel slide" data-bs-ride="carousel">

        <div class="carousel-inner">
            {{-- Carousel Video Tĩnh - Dùng video từ storage --}}

            <!-- Video 1: carousel1.mp4 -->
            <div class="carousel-item active position-relative">
                <video class="video-bg" autoplay loop muted playsinline>
                    <source src="{{ asset('videos/carousel1.mp4') }}" type="video/mp4">
                </video>
                <div class="overlay" style="background-color: rgba(0,0,0,0.5);"></div>
                <div class="carousel-caption d-none d-md-block">
                    <h2>Black Myth: Zhong Kui</h2>
                    <p>Khám phá thế giới game sinh động và hấp dẫn nhất</p>
                    @php
                        $featuredGame = App\Models\Product::with('category')->where('id', 18)->first();
                    @endphp
                    @if ($featuredGame)
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                @include('components.product-card', [
                                    'product' => $featuredGame,
                                    'showDescription' => true,
                                ])
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Video 2: lolTrailer.mp4 -->
            <div class="carousel-item position-relative">
                <video class="video-bg" autoplay loop muted playsinline>
                    <source src="{{ asset('videos/lolTrailer.mp4') }}" type="video/mp4">
                </video>
                <div class="overlay" style="background-color: rgba(0,0,0,0.5);"></div>
                <div class="carousel-caption d-none d-md-block">
                    <h2>League of Legends</h2>
                    <p>Tham gia trận chiến MOBA huyền thoại cùng hàng triệu game thủ</p>
                    @php
                        $featuredGame = App\Models\Product::with('category')->where('id', 19)->first();
                    @endphp
                    @if ($featuredGame)
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                                @include('components.product-card', [
                                    'product' => $featuredGame,
                                    'showDescription' => true,
                                ])
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Video 3: wukongTrailer.mp4 -->
        <div class="carousel-item position-relative">
            <video class="video-bg" autoplay loop muted playsinline>
                <source src="{{ asset('videos/wukongTrailer.mp4') }}" type="video/mp4">
            </video>
            @php
                $product = App\Models\Product::find(3);
            @endphp

            <div class="overlay" style="background-color: rgba(0,0,0,0.5);"></div>
            <div class="carousel-caption d-none d-md-block">
                <h2>Black Myth: Wukong</h2>
                <p>Hành trình thần thoại Tây Du Ký với đồ họa đỉnh cao</p>
                @php
                    $featuredGame = App\Models\Product::with('category')->where('id', 17)->first();
                @endphp
                @if ($featuredGame)
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            @include('components.product-card', [
                                'product' => $featuredGame,
                                'showDescription' => true,
                            ])
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <!-- Nút điều hướng -->
    <button class="carousel-control-prev" type="button" data-bs-target="#videoCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#videoCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>


    <!-- Các phần game -->
    <div class="container my-5">
        <h3 class="mt-5 mb-4">Game Hot</h3>
        <div class="row">
            @forelse($products as $product)
                <div class="col-md-3 mb-4">
                    @include('components.product-card', ['product' => $product, 'showDescription' => true])
                </div>
            @empty
                <div class="col-12 text-center text-white">
                    <div class="alert alert-warning bg-dark border-warning">
                        <i class="fas fa-exclamation-triangle"></i> Không tìm thấy game nào!
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Game Mới Nhất -->
        <h3 class="mt-5 mb-4">Game Mới Nhất</h3>
        <div class="row">
            @forelse($newGames as $game)
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    @include('components.product-card', ['product' => $game, 'showDescription' => true])
                </div>
            @empty
                <div class="col-12 text-center text-white">
                    <div class="alert alert-warning bg-dark border-warning">
                        <i class="fas fa-exclamation-triangle"></i> Không có game mới!
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Game Hành Động -->
        <h3 class="mt-5 mb-4">Game Hành Động</h3>
        <div class="row">
            @forelse($actionGames as $game)
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    @include('components.product-card', ['product' => $game, 'showDescription' => true])
                </div>
            @empty
                <div class="col-12 text-center text-white">
                    <div class="alert alert-warning bg-dark border-warning">
                        <i class="fas fa-exclamation-triangle"></i> Không có game hành động!
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Game RPG -->
        <h3 class="mt-5 mb-4">Game RPG</h3>
        <div class="row">
            @forelse($rpgGames as $game)
                <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                    @include('components.product-card', ['product' => $game, 'showDescription' => true])
                </div>
            @empty
                <div class="col-12 text-center text-white">
                    <div class="alert alert-warning bg-dark border-warning">
                        <i class="fas fa-exclamation-triangle"></i> Không có game RPG!
                    </div>
                </div>
            @endforelse
        </div>
    </div>

@endsection

<style>
    /* === Carousel === */
    #videoCarousel {
        width: 100vw;
        height: 100vh;
        /* phủ toàn màn hình */
        position: relative;
        overflow: hidden;
        background: #000;
        /*nền đen*/
        isolation: isolate;
        /* Tạo stacking context riêng */
    }

    /* === Carousel Items === */
    .carousel-item {
        height: 100vh;
        background: #000;
    }

    /* === Video === */
    .video-bg {
        position: absolute;
        top: 50%;
        left: 50%;
        min-width: 100%;
        min-height: 100%;
        width: auto;
        height: auto;
        object-fit: cover;
        transform: translate(-50%, -50%);
        z-index: 0;
    }

    /* === Overlay === */
    #videoCarousel .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.5));
        z-index: 1;
        pointer-events: none;
        /* Cho phép click qua overlay */
    }

    /* === Caption (nội dung text) === */
    .carousel-caption {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        bottom: auto;
        z-index: 2;
        text-shadow: 0 3px 8px rgba(0, 0, 0, 0.7);
    }

    /* === Nút điều hướng === */
    .carousel-control-prev,
    .carousel-control-next {
        position: absolute;
        top: 0;
        bottom: 0;
        z-index: 3;
        width: 5%;
        opacity: 0;
        cursor: pointer;
        transition: all 0.3s ease;
        /* Chỉ cho phép click trong vùng carousel */
        pointer-events: auto;
    }

    #videoCarousel:hover .carousel-control-prev,
    #videoCarousel:hover .carousel-control-next {
        opacity: 0.7;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        opacity: 1 !important;
        background: transparent;
    }

    .carousel-control-prev {
        left: 0;
    }

    .carousel-control-next {
        right: 0;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        filter: invert(1);
        width: 2.5rem;
        height: 2.5rem;
        background-color: transparent;
        border: none;
        padding: 1rem;
        transition: all 0.3s ease;
    }

    .carousel-control-prev-icon:hover,
    .carousel-control-next-icon:hover {
        background-color: transparent;
        transform: scale(1.2);
        filter: drop-shadow(0 0 15px rgba(255, 0, 68, 0.8));
    }

    /* === Featured Game Cards === */
    .featured-game-card {
        text-decoration: none;
        display: block;
        transition: all 0.3s ease;
    }

    .featured-game-card:hover {
        transform: translateY(-10px);
    }

    .featured-game-card .card {
        border: 2px solid rgba(255, 0, 68, 0.3);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .featured-game-card:hover .card {
        border-color: #ff0044;
        box-shadow: 0 10px 30px rgba(255, 0, 68, 0.5);
    }

    .featured-game-img {
        height: 300px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .featured-game-card:hover .featured-game-img {
        transform: scale(1.1);
    }

    .featured-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .featured-game-card:hover .featured-overlay {
        opacity: 1;
    }

    .rating-stars {
        font-size: 14px;
    }

    .rating-stars i {
        margin-right: 2px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Carousel Script Loaded');

        // Kiểm tra Bootstrap
        if (typeof bootstrap === 'undefined') {
            console.error(' Bootstrap not loaded!');
        } else {
            console.log('Bootstrap loaded');
        }

        // Lấy tất cả videos
        const videos = document.querySelectorAll('#videoCarousel video');
        console.log('Found videos:', videos.length);

        // Force play từng video
        videos.forEach((video, index) => {
            console.log(`Video ${index}:`, video.src);

            video.addEventListener('loadeddata', function() {
                console.log(`Video ${index} loaded`);
                // Ẩn loading text khi video đã load
                const carousel = document.getElementById('videoCarousel');
                if (carousel) {
                    carousel.style.setProperty('--loading-display', 'none');
                }
            });

            video.addEventListener('error', function(e) {
                console.error(`Video ${index} error:`, e);
            });

            // Force play
            video.play().catch(function(error) {
                console.warn(`Video ${index} autoplay blocked:`, error);
                // Retry với user interaction
                document.addEventListener('click', function() {
                    video.play();
                }, {
                    once: true
                });
            });
        });

        // Khởi động carousel
        const carouselElement = document.getElementById('videoCarousel');
        if (carouselElement) {
            const carousel = new bootstrap.Carousel(carouselElement, {
                interval: 8000, // 8 giây mỗi slide
                ride: 'carousel',
                wrap: true
            });
            console.log('Carousel initialized');

            // Play video khi slide change
            carouselElement.addEventListener('slide.bs.carousel', function(e) {
                console.log('Slide changing:', e.direction);
                const currentVideo = e.relatedTarget.querySelector('video');
                if (currentVideo) {
                    currentVideo.currentTime = 0; // Reset về đầu
                    currentVideo.play();
                }
            });
        }

        // Debug: Test click events cho nút Previous và Next
        const prevBtn = document.querySelector('.carousel-control-prev');
        const nextBtn = document.querySelector('.carousel-control-next');

        if (prevBtn) {
            prevBtn.addEventListener('click', function(e) {
                console.log('Previous button clicked!');
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function(e) {
                console.log('Next button clicked!');
            });
        }
    });
</script>
