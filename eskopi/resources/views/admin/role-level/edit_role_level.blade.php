@extends('admin.master_layout')
@section('title')
    <title>{{ __('Role Level') }}</title>
@endsection

@section('admin-content')
<div class="main-content" style="min-height: 606px;">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('admin.role-level') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>{{ __('Ubah Role Level') }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dasbor') }}</a>
                    </div>
                    <div class="breadcrumb-item active">
                        <a href="{{ route('admin.role-level') }}">{{ __('Role Level') }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ __('Ubah User Level') }}</div>
                </div>
            </div>

            <div class="section-body">                
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Ubah Role Level</h4>
                                <div>
                                    <a href="{{ route('admin.role-level') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                                </div>
                            </div>
                            <div class="card-body">
                            <form action="{{ route('admin.role-level-update') }}" method="POST" enctype="multipart/form-data">
                            @csrf     
                                  
                                    <div class="row">
                                        @foreach($menuList as $row)
                                        <div class="col-md-2">
                                            <div class="form-check mb-3">
                                            @if (in_array($row->id, $aksesgroup))
                                                <input class="form-check-input" type="checkbox" name="menu[]" id="formCheck{{$row->id}}" value="{{$row->id}}" checked>
                                                @else
                                                <input class="form-check-input" type="checkbox" name="menu[]" id="formCheck{{$row->id}}" value="{{$row->id}}">
                                                @endif
                                                <label class="form-check-label" for="formCheck{{$row->id}}">
                                                    {{$row->nama_menu}}
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <hr />
                                    <div>
                                         <input type="hidden" id="id_group" class="form-control" name="id_group" value="{{$id}}">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                        <a href="{{URL::to('admin/role-level')}}" class="btn btn-danger">Cancel</a>
                                    </div>

                             </form>
                             </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
        </div></section>
    </div>
@endsection