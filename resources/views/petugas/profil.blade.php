@extends('layouts.master')

@section('content')

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800">Profil</h1>
    </div>

    <div class="container-fluid">
    	<div class="card shadow mb-4">
    		<div class="card-header py-3">    			
		      	<h6 class="m-0 font-weight-bold  card-title">
		      		<a href="{{ asset(route('home', [], false)) }}"><i class="fas fa-chevron-left"></i></a>
		      		Profil Petugas
		  		</h6>
		    </div>    	

	    	<form action="{{ asset(route('petugas.updateprofil', ['id'=> $pengguna->id], false)) }}" method="POST">
	    	@csrf
		    
		    <div class="card-body">		    	

		    	<fieldset disabled="">
	            <div class="form-group {{$errors->has('role') ? 'has-error' : ''}}">
	              <label>Role</label>
	              <select name="role" id="role" class="form-control">
	                <option value="" {{ (old('role') == '') ? 'selected' : ''}}>-- Pilih Role --</option>
	                <option value="admin" {{($pengguna->role == 'admin') ? 'selected' : ''}}>Admin</option>
	                <option value="user" {{($pengguna->role == 'user') ? 'selected' : ''}}>User</option>
	              </select>
	              @if ($errors->has('role'))
	                <span class="text-danger">{{$errors->first('role')}}</span>
	              @endif
	            </div>    		    		
		    	</fieldset>

	            <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
	              <label>Nama Lengkap</label>
	              <input name="nama" id="nama" type="text" class="form-control" placeholder="Nama Lengkap" value="{{ $pengguna->nama }}">
	              @if ($errors->has('nama'))
	                <span class="text-danger">{{$errors->first('nama')}}</span>
	              @endif
	            </div>   
	            <div class="form-group {{$errors->has('jabatan') ? 'has-error' : ''}}">
	              <label>Jabatan</label>
	              <select name="jabatan" id="jabatan" class="form-control">
	                <option value="" {{ (old('jabatan') == '') ? 'selected' : ''}}>-- Pilih Jabatan --</option>
	                <option value="organik" {{($pengguna->jabatan == 'organik') ? 'selected' : ''}}>Organik</option>
	                <option value="mitra" {{($pengguna->jabatan == 'mitra') ? 'selected' : ''}}>Mitra</option>
	              </select>
	              @if ($errors->has('jabatan'))
	                <span class="text-danger">{{$errors->first('jabatan')}}</span>
	              @endif
	            </div>                                       
	            <div class="form-group {{$errors->has('no_hp') ? 'has-error' : ''}}">
	              <label>Nomor HP</label>
	              <input name="no_hp" id="no_hp" type="text" class="form-control" placeholder="Nomor Handphone" value="{{ $pengguna->no_hp }}">
	              @if ($errors->has('no_hp'))
	                <span class="text-danger">{{$errors->first('no_hp')}}</span>
	              @endif
	            </div>              
	            <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
	              <label>Email</label>
	              <input name="email" id="email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Email" value="{{ $pengguna->email }}">
	              @if ($errors->has('email'))
	                <span class="text-danger">{{$errors->first('email')}}</span>
	              @endif
	            </div>                   
  
			</div>
			
			<div class="card-footer py-3">
				  <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Update Profil</button>
			</div>
			
			</form>
		    	
		</div>	
   	</div>	

@endsection
