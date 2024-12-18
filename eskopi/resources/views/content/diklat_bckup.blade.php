@extends('layouts.app')


@section('content')

 <!-- main-area -->
 <main class="main-area fix">

 <!-- features-area -->
 <section class="features__area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="section__title white-title text-center mb-50">
                    <h2 class="title">Semua Diklat</h2>
                    <p>Pelajari beragam topik diklat dari mentor yang berpengalaman dibidangnya</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-4 col-md-6">
                <div class="features__item">
                    <div class="features__icon" align="center">
                        <form action="#" class="tgmenu__search-form">
                            <div class="input-grp">
                                <input type="text" placeholder="Kata kunci DIKLAT yang ingin kamu cari. . .">
                                <button type="submit"><i class="flaticon-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- features-area-end -->

<!-- all-courses -->
<section class="all-courses-area section-py-120">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 order-2 order-lg-0">
            <aside class="courses__sidebar">
                <div class="courses-widget">
                    <h4 class="widget-title">Kategori</h4>
                    <div class="courses-cat-list">
                        <ul class="list-wrap">
                            @foreach($categories as $category)
                                <li>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="cat_{{ $category->id }}">
                                        <label class="form-check-label" for="cat_{{ $category->id }}">
                                            {{ $category->nama_kategori }}  ({{ $category->diklats()->count() }})
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </aside>
            </div>
            <div class="col-xl-9 col-lg-8">
                <div class="courses-top-wrap courses-top-wrap">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="courses-top-left">
                                <p>Total {{ $alldiklat->count() }} Diklat</p>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="d-flex justify-content-center justify-content-md-end align-items-center flex-wrap">
                                <div class="courses-top-right m-0 ms-md-auto">
                                    <span class="sort-by">Urutkan Berdasar:</span>
                                    <div class="courses-top-right-select">
                                        <select name="orderby" class="orderby">
                                            <option value="Most Popular">Terbaru</option>
                                            <option value="popularity">Terlama</option>
                                            <option value="average rating">Judul</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content" id="myTabContent">
                    
                    <div class="tab-pane fade show active" id="grid" role="tabpanel" aria-labelledby="grid-tab">
                        <div class="row courses__grid-wrap row-cols-1 row-cols-xl-3 row-cols-lg-2 row-cols-md-2 row-cols-sm-1">
                            @foreach ($alldiklat as $diklat)
                            <div class="col">
                                <div class="courses__item shine__animate-item">
                                    <div class="courses__item-thumb">
                                        <a href="{{ route('diklatdetail', $diklat->id_diklat) }}" class="shine__animate-link">
                                            <img src="{{ asset($diklat->gambar) }}" alt="img">
                                        </a>
                                    </div>
                                    <div class="courses__item-content">
                                        <ul class="courses__item-meta list-wrap">
                                            <li class="courses__item-tag">
                                                <a href="#">{{ $diklat->kategori->nama_kategori }}</a>
                                            </li>
                                            
                                        </ul>
                                        <h5 class="title">
                                            <a href="{{ route('diklatdetail', $diklat->id_diklat) }}">{{ \Illuminate\Support\Str::limit($diklat->nama_diklat, 50, '...') }}</a>
                                        </h5>
                                        <p class="author">{{ $diklat->pesertaCount() }}<a href="#">Peserta</a></p>
                                        <div class="courses__item-bottom">
                                            <div class="button">
                                                <a href="{{ route('diklatdetail', $diklat->id_diklat) }}">
                                                    <span class="text">Lihat</span>
                                                    <i class="flaticon-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <nav class="pagination__wrap mt-30">
                            <ul class="list-wrap">
                                {{ $alldiklat->links() }} 
                            </ul>
                        </nav>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<!-- all-courses-end -->

</main>
<!-- main-area-end -->

@endsection