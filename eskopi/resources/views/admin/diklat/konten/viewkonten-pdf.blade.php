@extends('admin.master_layout')
@section('title')
    <title>{{ __('Konten Materi Soal') }}</title>
@endsection

@section('admin-content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                @php 
                    $id_diklat = Crypt::encrypt($id_diklat);
                    $id_materi_pdf = Crypt::encrypt($materipdf->id_materi);
                @endphp
                <div class="section-header-back">
                    <a href="{{ route('admin.matadiklat', $id_diklat) }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Konten Materi PDF') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.diklat') }}">{{ __('Diklat') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.matadiklat', $id_diklat) }}">{{ __('Ubah Diklat') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Konten Materi PDF') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col">
                    <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    
                                    <h4> {{ $materipdf->judul_materi }} </h4>
                                    <div class="d-flex">
                                            
                                             <a href="{{ route('admin.editkonten-pdf', ['idmateri' => $id_materi_pdf]) }}" class="btn btn-warning btn-sm  mr-3">
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                            </a>
                                            <a href="javascript:;" data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-sm" onclick="deleteMateriPdf({{ $materipdf->id_materi }})">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
</div>
                                </div>
                                <div class="card-body">
                                    <iframe id="pdfViewer" src="" style="width: 100%; height: 1000px; border: none; margin-top: 20px;"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>

    <!-- Modal for Salin dari Bank Soal -->
    
    

@endsection
<script>
        function deleteMateriPdf(idmateri) {
            $("#deleteForm").attr("action", "{{ url('admin/deletekonten-pdf') }}" + "/" + idmateri);
        }
    </script>
<script>
    window.onload = function() {
        // Define the PDF URL and title dynamically from your server-side template engine
        var pdfUrl = '{{ asset($materipdf->url_materi) }}';  // Dynamic PDF URL
        var title = '{{ $materipdf->judul_materi }}';      // Dynamic title

        // Change the title of the page
        document.title = title;

        // Set the iframe's 'src' to the provided PDF URL
        var pdfViewer = document.getElementById('pdfViewer');
        pdfViewer.src = pdfUrl;
    }
</script>