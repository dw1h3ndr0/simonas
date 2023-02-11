@extends('layouts.master')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Ganti Password </h1>
    </div>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">              
                <h6 class="m-0 font-weight-bold  card-title">
                    <a href="{{ asset(route('home', [], false)) }}"><i class="fas fa-chevron-left"></i></a>
                    {{$pengguna->nama}}
                </h6>
            </div>


            <form method="POST" action="{{ asset(route('change.password.post', ['id'=>$pengguna->id,'page'=>'change'], false)) }}">
            <div class="modal-body">
                <div class="auth-box">
                    <div class="content">
                        @csrf 

                        @if(session('sukses'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <i class="fa fa-check-circle"></i> {{session('sukses')}}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="password">Current Password</label>        
                            <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                            @if ($errors->has('current_password'))
                                <span class="text-danger">{{$errors->first('current_password')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                            @if ($errors->has('new_password'))
                                <span class="text-danger">{{$errors->first('new_password')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="password">New Confirm Password</label>      
                            <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                            @if ($errors->has('new_confirm_password'))
                                <span class="text-danger">{{$errors->first('new_confirm_password')}}</span>
                            @endif
                        </div>  
                    </div>
                </div>                         
            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.href = '{{ asset(route('home', [], false)) }}'"><i class="fa fa-times-circle"></i> Batal</button> --}}  
                <button type="submit" id="btn-update-password" class="btn btn-primary"><i class="fa fa-check-circle"></i> Update Password</button>
            </div>

            </form>
        </div>
    </div>

@endsection