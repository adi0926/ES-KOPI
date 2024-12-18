@extends('admin.master_layout')
@section('title')
    <title>{{ __('Level') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.user') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Ubah Level') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Level') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.user') }}">{{ __('Level') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Ubah Level') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Ubah Level</h4>
                                <div>
                                    <a href="{{ route('admin.level') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.level-update') }}" method="post" enctype="multipart/form-data">
                                @csrf                              
                                    <div class="row">   

                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="slug">Level <span class="text-danger">*</span></label>
                                                <input type="text" id="nama_role" name="nama_role" placeholder="" class="form-control" value="{{ $level->nama_role }}">                                 
                                            </div>
                                        </div>
                                        

                                        <div class="text-center offset-md-2 col-md-8">
                                            <input type="hidden" id="id" class="form-control" name="id" value="{{ $level->id_role }}">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    
    </section>
    </div>
@endsection