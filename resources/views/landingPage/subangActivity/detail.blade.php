@extends('landingPage.bases')
@section('content-lp')

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
            integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
        </script>
    </head>
    <header class="header-area header-sticky wow slideInDown" data-wow-duration="0.75s" data-wow-delay="0s">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                            <img src="/sibersih-logo.png" alt="" width="100" height="100">
                        </a>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <div id="blog" class="blog">
        <div class="container">
            <a href="{{ route('beranda') }}" class="wow fadeInUp">
                Kembali
            </a>

            <div class="row">
                <div class="col-lg-4 offset-lg-4  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="section-heading">
                        <h4>{{ $subangActivityDetail->name }}</h4>
                    </div>
                </div>
                <div class="col-lg-12 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.3s">
                    <div class="blog-posts">
                        <div class="row">
                            <p class="text-dark">
                                Kategori Kegiatan : {{ $subangActivityDetail->activityCategory->name }}
                            </p>

                            <p class="text-dark">
                                Nama Kegiatan : {{ $subangActivityDetail->name }}
                            </p>

                            <p class="text-dark">
                                Tanggal Kegiatan :
                                {{ \Carbon\Carbon::parse($subangActivityDetail->date)->translatedFormat('d F Y') }}
                            </p>

                            <p class="text-dark">
                                Lokasi Lengkap Kegiatan : {{ $subangActivityDetail->address_details }}
                            </p>
                            <p class="text-dark">
                                Foto Lokasi :
                            </p>
                            <p class="text-dark">
                                Bukti Kegiatan
                            </p>
                            <small class="text-muted">Foto</small>
                            <div class="row row-cols-1 row-cols-md-6 g-1" data-masonry='{"percentPosition": true }'>
                                @forelse ($subangActivityDetail->imageSubangActivity as $file)
                                    <div class="col">
                                        <div class="card">
                                            <a href="{{ $file->file_url }}" data-fancybox="gallery"
                                                data-caption="{{ $file->caption }}">
                                                <img src="{{ $file->file_url }}" class="card-img-top"
                                                    alt="{{ $file->caption }}">
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col text-center">
                                        <p>Tidak ada dokumentasi lokasi</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="disqus_thread"></div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('[data-fancybox="gallery"]').fancybox();
        });
    </script>

    <script>
        /**
         *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
        var disqus_config = function() {
            this.page.url = '{{ url()->full() }}'; // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier =
                '{{ $subangActivityDetail->name }}'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document,
                s = d.createElement('script');
            s.src = 'https://sibersih-my-id-2.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
            Disqus.</a></noscript>
@endsection
