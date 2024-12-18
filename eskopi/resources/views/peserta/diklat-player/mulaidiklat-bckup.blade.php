@extends('peserta.diklat-player.master')
@section('meta_title', 'Judul Diklat')

@section('contents')

    <section class="wsus__course_video">
        @php 
            $id_diklat = Crypt::encrypt($diklat->id_diklat);
        @endphp
        <div id="diklat-data" data-diklat-name="{{ $diklat->nama_diklat }}"></div>
        <div class="col-12">
            <div class="wsus__course_header">
                <a href="{{ route('diklatdetail', $id_diklat)}}"><i class="fas fa-angle-left"></i>
                    {{ __('Kembali') }}</a>
                <p>{{ $diklat->nama_diklat }}</p>
                <p>{{ __('Progres Diklat') }}: {{ $status1Count }} {{ __('dari') }}
                    {{ $totalRecords }} ({{ $percentage }}%)</p>

                <div class="wsus__course_header_btn">
                    <i class="fas fa-stream"></i>
                </div>
            </div>
        </div>

        <div class="wsus__course_video_player">

            {{-- Player --}}
            <div class="video-payer">
                <div class="player-placeholder">
                    <div class="preloader-two player">
                        <div class="loader-icon-two player"><img src="{{ asset('frontend/img/favicon.png') }}"
                                alt="Preloader">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom Panel --}}
            @include('peserta.diklat-player.bottom-panel')

        </div>


        <div class="wsus__course_sidebar">
            <div class="wsus__course_sidebar_btn">
                <i class="fas fa-times"></i>
            </div>
            <h2 class="video_heading">{{ __('Konten Diklat') }}</h2>
                <div class="accordion" id="accordionExample">
                    @php
                        $startorder = 1;
                        $isLocked = false;
                    @endphp
                    @foreach($diklat->mataDiklat as $mataDiklat)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse-{{ $mataDiklat->id_mata_diklat }}" aria-expanded="false"
                                    aria-controls="collapse-{{ $mataDiklat->id_mata_diklat }}">
                                    <b>{{ $mataDiklat->mata_diklat }}</b>
                                    <span></span>
                                </button>
                            </h2>
                            <div id="collapse-{{ $mataDiklat->id_mata_diklat }}"
                                class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body course-content">
                                    @foreach($mataDiklat->mataDiklatKonten as $konten)
                                        @php
                                            
                                            $reference = $konten->references()->where('id_peserta', $id_peserta)->first();
                                            $isChecked = $reference && $reference->status == 1;

                                            if ($startorder == 1 && $reference->status == 0) {
                                                $isLocked = false; 
                                                $startorder++;
                                            } elseif ($startorder > 1 && $reference->status == 0) {
                                                $isLocked = true;
                                            }

                                        @endphp
                                        @if($konten->id_tipe_konten == 1)
                                            <div class="form-check">
                                                <input class="form-check-input lesson-completed-checkbox" type="checkbox"
                                                    data-id-konten="{{ $konten->id_konten }}" data-type="video"  data-url="{{ $konten->materiVideo->url_materi }}"  style="pointer-events: none;" {{ $isChecked ? 'checked' : '' }}>
                                                <label class="form-check-label lesson-item" data-id-konten="{{ $konten->id_konten }}" data-type="video" data-url="{{ $konten->materiVideo->url_materi }}" style="pointer-events: {{ $isLocked ? 'none' : 'auto' }}; color: {{ $isLocked ? '#B0B0B0' : 'inherit' }};">
                                                    {{ $konten->materiVideo->judul_materi }}
                                                    @if($isLocked)
                                                        <img src="{{ asset('frontend/img/lock_icon.png') }}" alt="locked" class="img-fluid" style="width: 18px; margin-left: 10px;">
                                                    @endif
                                                    <span>
                                                        <img src="{{ asset('frontend/img/video_icon_black_2.png') }}"
                                                            alt="video" class="img-fluid">
                                                        {{ $konten->materiVideo->durasi ? gmdate("H:i:s", $konten->materiVideo->durasi * 60) : '--:--:--' }}
                                                    </span>
                                                </label>
                                            </div>
                                        @elseif($konten->id_tipe_konten == 2)
                                            <div class="form-check">
                                                <input class="form-check-input lesson-completed-checkbox" type="checkbox"
                                                    data-id-konten="{{ $konten->id_konten }}" data-type="pdf" style="pointer-events: none;" {{ $isChecked ? 'checked' : '' }}>
                                                <label class="form-check-label lesson-item" data-id-konten="{{ $konten->id_konten }}" data-type="pdf" style="pointer-events: {{ $isLocked ? 'none' : 'auto' }}; color: {{ $isLocked ? '#B0B0B0' : 'inherit' }};">
                                                    {{ $konten->materiPdf->judul_materi }}
                                                    @if($isLocked)
                                                        <img src="{{ asset('frontend/img/lock_icon.png') }}" alt="locked" class="img-fluid" style="width: 18px; margin-left: 10px;">
                                                    @endif
                                                    <span>
                                                        <img src="{{ asset('frontend/img/pdf_icon.png') }}"
                                                            alt="video" class="img-fluid">
                                                        {{ $konten->materiPdf->durasi ? gmdate("H:i:s", $konten->materiPdf->durasi * 60) : '--:--:--' }}
                                                    </span>
                                                </label>
                                            </div>
                                        @elseif($konten->id_tipe_konten == 3)
                                            <div class="form-check">
                                                <input class="form-check-input lesson-completed-checkbox" type="checkbox"
                                                    data-id-konten="{{ $konten->id_konten }}" data-type="soal" data-status="{{ $reference->status }}" data-tipe-soal="{{ $konten->materiSoal->tipe }}" data-jumlahsoal="{{ $konten->materiSoal->soals->count() }}" data-durasi="{{ $konten->materiSoal->durasi }}" style="pointer-events: none;" {{ $isChecked ? 'checked' : '' }}>
                                                <label class="form-check-label lesson-item" data-id-konten="{{ $konten->id_konten }}" data-type="soal" data-status="{{ $reference->status }}"
                                                    data-tipe-soal="{{ $konten->materiSoal->tipe }}" data-jumlahsoal="{{ $konten->materiSoal->soals->count() }}" data-durasi="{{ $konten->materiSoal->durasi }}" style="pointer-events: {{ $isLocked ? 'none' : 'auto' }}; color: {{ $isLocked ? '#B0B0B0' : 'inherit' }};">
                                                    {{ $konten->materiSoal->judul_soal }}
                                                    @if($isLocked)
                                                        <img src="{{ asset('frontend/img/lock_icon.png') }}" alt="locked" class="img-fluid" style="width: 18px; margin-left: 10px;">
                                                    @endif
                                                    <span>
                                                        <img src="{{ asset('frontend/img/test_icon.png') }}"
                                                            alt="video" class="img-fluid">
                                                        {{ $konten->materiSoal->durasi ? gmdate("H:i:s", $konten->materiSoal->durasi * 60) : '--:--:--' }}
                                                    </span>
                                                </label>
                                            </div>
                                        @elseif($konten->id_tipe_konten == 0)
                                            <div class="form-check">
                                                <input class="form-check-input lesson-completed-checkbox" type="checkbox"
                                                    data-id-konten="{{ $konten->id_konten }}" data-type="open" style="pointer-events: none;" {{ $isChecked ? 'checked' : '' }}>
                                                <label class="form-check-label lesson-item" data-id-konten="{{ $konten->id_konten }}" data-type="open" style="pointer-events: {{ $isLocked ? 'none' : 'auto' }}; color: {{ $isLocked ? '#B0B0B0' : 'inherit' }};">
                                                    {{ $konten->materiLain->judul_materi }}
                                                    @if($isLocked)
                                                        <img src="{{ asset('frontend/img/lock_icon.png') }}" alt="locked" class="img-fluid" style="width: 18px; margin-left: 10px;">
                                                    @endif
                                                    <span>
                                                        <img src="{{ asset('frontend/img/open_icon.png') }}"
                                                            alt="video" class="img-fluid">
                                                        --:--:--
                                                    </span>
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        var preloader_path = "{{ asset('frontend/img/favicon.png') }}";
    </script>
    <script src="{{ asset('frontend/js/default/learning-player.js') }}"></script>
    <script src="{{ asset('frontend/js/default/quiz-page.js') }}"></script>
    <!-- <script src="{{ asset('frontend/js/default/qna.js') }}"></script> -->
    <script src="{{ asset('frontend/js/pdf.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jszip.min.js') }}"></script>
    <script src="{{ asset('frontend/js/docx-preview.min.js') }}"></script>
    <script>
        var lastCheckpointIdMataDiklat = "{{ $lastCheckpointIdMataDiklat }}";
        var lastCheckpointIdKonten = "{{ $lastCheckpointIdKonten }}";

        "use strict";
        $(document).ready(function() {

            var defaultButton = document.querySelector("[data-bs-target='#collapse-" + lastCheckpointIdMataDiklat + "']");
            if (defaultButton) {
                defaultButton.click();
            }
            var lessonItem = document.querySelector(".lesson-item[data-id-konten='" + lastCheckpointIdKonten + "']");
            if (lessonItem) {
                $(lessonItem).trigger('click');
            }
        })
    </script>
    <script src="{{ asset('frontend/js/custom-tinymce.js') }}"></script>
@endpush
