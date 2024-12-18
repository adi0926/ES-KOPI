@extends('admin.master_layout')
@section('title')
    <title>{{ __('User') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.user') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Ubah User') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('User') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.user') }}">{{ __('User') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Ubah User') }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="mt-4 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Ubah User</h4>
                                <div>
                                    <a href="{{ route('admin.user') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.user-update') }}" method="post" enctype="multipart/form-data">
                                @csrf                              
                                    <div class="row">   

                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="slug">Nama <span class="text-danger">*</span></label>
                                                <input type="text" id="name" name="name" placeholder="" class="form-control" value="{{ $user->name }}">                                 
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="slug">Email <span class="text-danger">*</span></label>
                                                <input type="text" id="email" name="email" placeholder="" class="form-control" value="{{ $user->email }}">                                 
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="slug">Password <span class="text-danger">*</span></label>
                                                <input type="hidden" id="password_old" name="password_old" placeholder="" class="form-control" value="{{ $user->password }}">
                                                <input type="text" id="password" name="password" placeholder="*******" class="form-control" value="">                                  
                                            </div>
                                        </div>

                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="level">Level<span class="text-danger">*</span></label>
                                                <select class="form-control" name="level">
                                                    @foreach($levels as $level)
                                                        <option value="{{ $level->id_role }}" 
                                                        {{ $user->id_group== $level->id_role ? 'selected' : '' }}>
                                                        {{ $level->nama_role }}
                                                         </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-md-2">
                                            <div class="form-group">
                                                <label for="status">Status<span class="text-danger">*</span></label>
                                                <select class="form-control" name="status">
                                                    <option value="active" {{ $user->status == 'active' ? 'selected' : '' }}>Aktif</option>
                                                    <option value="nonactive" {{ $user->status == 'nonactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                                  
                                                </select>
                                            </div>
                                        </div>
                                        

                                        <div class="text-center offset-md-2 col-md-8">
                                            <input type="hidden" id="id" class="form-control" name="id" value="{{ $user->id }}">
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