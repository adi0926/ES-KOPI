@foreach ($filteredDiklats as $diklat)
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
                <p class="author">{{ $diklat->pesertaCount() }} <a href="#">Peserta</a></p>
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
