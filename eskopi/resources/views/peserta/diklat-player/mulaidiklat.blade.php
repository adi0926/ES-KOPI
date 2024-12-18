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
                                                    data-id-konten="{{ $konten->id_konten }}" data-type="video"  data-url="{{ $konten->materiVideo->url_materi }}" style="pointer-events: none;" {{ $isChecked ? 'checked' : '' }}>
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
                                                    data-id-konten="{{ $konten->id_konten }}" data-type="pdf" data-url="{{ $konten->materiPdf->url_materi }}" style="pointer-events: none;" {{ $isChecked ? 'checked' : '' }}>
                                                <label class="form-check-label lesson-item" data-id-konten="{{ $konten->id_konten }}" data-type="pdf" data-url="{{ $konten->materiPdf->url_materi }}" style="pointer-events: {{ $isLocked ? 'none' : 'auto' }}; color: {{ $isLocked ? '#B0B0B0' : 'inherit' }};">
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
                                        @elseif($konten->id_tipe_konten == 9)
                                            <div class="form-check">
                                                <input class="form-check-input lesson-completed-checkbox" type="checkbox" data-judul="{{ $konten->materiSoal->judul_soal }}" data-mata-diklat="{{ $mataDiklat->mata_diklat }}"
                                                    data-id-konten="{{ $konten->id_konten }}" data-type="soal" data-status="{{ $reference->status }}" data-tipe-soal="{{ $konten->materiSoal->tipe }}" data-jumlahsoal="{{ $konten->materiSoal->soals->count() }}" data-durasi="{{ $konten->materiSoal->durasi }}" style="pointer-events: none;" {{ $isChecked ? 'checked' : '' }}>
                                                <label class="form-check-label lesson-item" data-judul="{{ $konten->materiSoal->judul_soal }}" data-mata-diklat="{{ $mataDiklat->mata_diklat }}" data-id-konten="{{ $konten->id_konten }}" data-type="soal" data-status="{{ $reference->status }}"
                                                    data-tipe-soal="{{ $konten->materiSoal->tipe }}" data-jumlahsoal="{{ $konten->materiSoal->soals->count() }}" data-durasi="{{ $konten->materiSoal->durasi }}" style="pointer-events: {{ $isLocked ? 'none' : 'auto' }}; color: {{ $isLocked ? '#B0B0B0' : 'inherit' }};">
                                                    {{ $konten->materiSoal->judul_soal }}
                                                    @if($isLocked)
                                                        <img src="{{ asset('frontend/img/lock_icon.png') }}" alt="locked" class="img-fluid" style="width: 18px; margin-left: 10px;">
                                                    @endif
                                                    <span>
                                                        @if($konten->materiSoal->tipe == "evaluasi")
                                                            <img src="{{ asset('frontend/img/evaluasi_icon.png') }}"
                                                                alt="video" class="img-fluid">
                                                        @else
                                                            <img src="{{ asset('frontend/img/test_icon.png') }}"
                                                                alt="video" class="img-fluid">
                                                        @endif
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
                                        @elseif($konten->id_tipe_konten == 4)
                                            <div class="form-check">
                                                <input class="form-check-input lesson-completed-checkbox" type="checkbox" data-mata-diklat="{{ $mataDiklat->mata_diklat }}"
                                                    data-id-konten="{{ $konten->id_konten }}" data-type="vclass" data-url="{{ $konten->materiVclass->url_materi }}" style="pointer-events: none;" {{ $isChecked ? 'checked' : '' }}>
                                                <label class="form-check-label lesson-item" data-mata-diklat="{{ $mataDiklat->mata_diklat }}" data-id-konten="{{ $konten->id_konten }}" data-type="vclass" data-url="{{ $konten->materiVclass->url_materi }}" style="pointer-events: {{ $isLocked ? 'none' : 'auto' }}; color: {{ $isLocked ? '#B0B0B0' : 'inherit' }};">
                                                    {{ $konten->materiVclass->judul_materi }}
                                                    @if($isLocked)
                                                        <img src="{{ asset('frontend/img/lock_icon.png') }}" alt="locked" class="img-fluid" style="width: 18px; margin-left: 10px;">
                                                    @endif
                                                    <span>
                                                        <img src="{{ asset('frontend/img/vclass_icon.png') }}"
                                                            alt="video" class="img-fluid">
                                                        {{ $konten->materiVclass->durasi ? gmdate("H:i:s", $konten->materiPdf->durasi * 60) : '--:--:--' }}
                                                    </span>
                                                </label>
                                            </div>
                                        @elseif($konten->id_tipe_konten == 20)
                                            <div class="form-check">
                                                <input class="form-check-input lesson-completed-checkbox" type="checkbox" data-penyelenggara="{{ $konten->materiEvalpenyelenggara->penyelenggara }}" data-mata-diklat="{{ $mataDiklat->mata_diklat }}"
                                                    data-id-konten="{{ $konten->id_konten }}" data-type="evaluasiA" data-status="{{ $reference->status }}" style="pointer-events: none;" {{ $isChecked ? 'checked' : '' }}>
                                                <label class="form-check-label lesson-item" data-penyelenggara="{{ $konten->materiEvalpenyelenggara->penyelenggara }}" data-mata-diklat="{{ $mataDiklat->mata_diklat }}"
                                                    data-id-konten="{{ $konten->id_konten }}" data-type="evaluasiA" data-status="{{ $reference->status }}"
                                                    style="pointer-events: {{ $isLocked ? 'none' : 'auto' }}; color: {{ $isLocked ? '#B0B0B0' : 'inherit' }};">
                                                    {{ $konten->materiEvalpenyelenggara->judul_evaluasi }}
                                                    @if($isLocked)
                                                        <img src="{{ asset('frontend/img/lock_icon.png') }}" alt="locked" class="img-fluid" style="width: 18px; margin-left: 10px;">
                                                    @endif
                                                    <span>
                                                        <img src="{{ asset('frontend/img/evaluasi_icon.png') }}"
                                                            alt="video" class="img-fluid">
                                                        {{ $konten->materiEvalpenyelenggara->durasi ? gmdate("H:i:s", $konten->materiEvalpenyelenggara->durasi * 60) : '--:--:--' }}
                                                    </span>
                                                </label>
                                            </div>
                                        @elseif($konten->id_tipe_konten == 21)
                                            <div class="form-check">
                                                <input class="form-check-input lesson-completed-checkbox" type="checkbox" data-pengajar="{{ $konten->materiEvalpengajar->pengajar }}" data-mata-diklat="{{ $mataDiklat->mata_diklat }}"
                                                    data-id-konten="{{ $konten->id_konten }}" data-type="evaluasiB" data-status="{{ $reference->status }}" style="pointer-events: none;" {{ $isChecked ? 'checked' : '' }}>
                                                <label class="form-check-label lesson-item" data-pengajar="{{ $konten->materiEvalpengajar->pengajar }}" data-mata-diklat="{{ $mataDiklat->mata_diklat }}"
                                                    data-id-konten="{{ $konten->id_konten }}" data-type="evaluasiB" data-status="{{ $reference->status }}"
                                                    style="pointer-events: {{ $isLocked ? 'none' : 'auto' }}; color: {{ $isLocked ? '#B0B0B0' : 'inherit' }};">
                                                    {{ $konten->materiEvalpengajar->judul_evaluasi }}
                                                    @if($isLocked)
                                                        <img src="{{ asset('frontend/img/lock_icon.png') }}" alt="locked" class="img-fluid" style="width: 18px; margin-left: 10px;">
                                                    @endif
                                                    <span>
                                                        <img src="{{ asset('frontend/img/evaluasi_icon.png') }}"
                                                            alt="video" class="img-fluid">
                                                        {{ $konten->materiEvalpengajar->durasi ? gmdate("H:i:s", $konten->materiEvalpengajar->durasi * 60) : '--:--:--' }}
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
        var lastCheckpointType = "{{ $lastCheckpointType }}"

        "use strict";
        $(document).ready(function() {
            
            var namadiklatselesai = $("#diklat-data").attr("data-diklat-name");
            const completeHtml = `
                <div class="resource-file">
                    <div class="file-info">
                        <div class="text-center">
                            <div class="test-completion">
                                <div class="completion-header">
                                    <img src="/uploads/website-images/trophy.png" alt="Test Image" class="trophy-icon">
                                    <h2 class="completion-title">Selamat! Anda sudah menyelesaikan Diklat ${namadiklatselesai}</h2>
                                </div>

                                <div class="button-container" style="margin-top: 20px;">
                                    <a href="{{ route('peserta.diklatsaya') }}" class="btn btn-primary">Selesai</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            if (lastCheckpointIdMataDiklat === "null" || lastCheckpointType === "completed") {
                $(".video-payer").html(completeHtml);
            } else {
                var defaultButton = document.querySelector("[data-bs-target='#collapse-" + lastCheckpointIdMataDiklat + "']");
                if (defaultButton) {
                    defaultButton.click();
                }
                var lessonItem = document.querySelector(".lesson-item[data-id-konten='" + lastCheckpointIdKonten + "'][data-type='" + lastCheckpointType + "']");
                if (lessonItem) {
                    $(lessonItem).trigger('click');
                }
            }
        })
    </script>
    <script src="{{ asset('frontend/js/custom-tinymce.js') }}"></script>
@endpush
