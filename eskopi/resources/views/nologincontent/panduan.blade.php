@extends('layouts.app')

@section('content')
<main class="main-area fix">

    <section class="features__area_auth">
        <div class="container">
            <div class="row justify-content-start">
                <span style="font-size: 30px; color: #FFFFFF;">Panduan</span>
            </div>
        </div>
    </section>
    <section class="panduan__area section-pb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="dashboard__sidebar-wrap">
                        <div class="dashboard__sidebar-title mb-20">
                            <h6 class="title">Daftar Panduan</h6>
                        </div>
                        <nav class="dashboard__sidebar-menu">
                            <ul class="list-wrap">
                            @foreach ($panduans as $panduan)
                                <li class="">
                                    <a href="#"
                                       onclick="openPdfAndChangeTitle('{{ asset($panduan->file_panduan) }}', '{{ $panduan->judul_panduan }}')">
                                       {{ $panduan->judul_panduan }}</a>
                                </li>
                            @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="dashboard__content-wrap">
                      <div class="dashboard__content-title d-flex justify-content-between">
                          <h4 id="panduanTitle" class="title">{{ __('Pilih Panduan') }}</h4>
                      </div>
                      <iframe id="pdfViewer" src="" style="width: 100%; height: 1000px; border: none; margin-top: 20px;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
@endsection