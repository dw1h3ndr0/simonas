@extends('layouts.master')

@section('content')

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800">Daftar Sampel Blok Sensus</h1>
    </div>

    <div class="container-fluid">
    	<div class="card shadow mb-4">
    		<div class="card-header py-3">    			
		      	<h6 class="m-0 font-weight-bold  card-title">
		      		<a href="{{ asset(route('dsbs', [], false)) }}"><i class="fas fa-chevron-left"></i></a>
		      		Edit Sampel Blok Sensus
		  		</h6>
		    </div>    	

	    	<form action="{{ asset(route('dsbs', [], false)) }}" method="GET">
	    	@csrf

	    	<fieldset disabled>
		    
		    <div class="card-body">

		    	<div class="form-group">
		    	  <label>Kegiatan</label>
	              <select name="kegiatan" class="form-control">
	                <option value=""}}>-- Pilih Kegiatan --</option>
	                @foreach($data_kegiatan as $kegiatan)
	                  <option value="{{ $kegiatan->id }}" {{ ($dsbs->kegiatan_id == $kegiatan->id) ? 'selected' : '' }}>{{$kegiatan->nama_keg}}&nbsp;{{$kegiatan->periode}}&nbsp;{{$kegiatan->tahun}}</option>                
	                @endforeach
	              </select>
	              @if ($errors->has('kegiatan'))
						<span class="text-danger">{{$errors->first('kegiatan')}}</span>
				  @endif
		    	</div>

		    	<div class="form-group {{$errors->has('provinsi') ? 'has-error' : ''}}">
					<label for="provinsi">Provinsi</label>
				    <select name="provinsi" class="form-control" id="provinsi">
				      	<option value="">--- Pilih Provinsi ---</option>
				      	@foreach($data_provinsi as $provinsi)
				      		<option value="{{ $provinsi->kode }}" {{ ($dsbs->provinsi_id == $provinsi->kode) ? 'selected' : '' }}>[{{$provinsi->kode}}]&nbsp;{{$provinsi->provinsi}}</option>
				      	@endforeach
				    </select>
				    @if ($errors->has('provinsi'))
						<span class="text-danger">{{$errors->first('provinsi')}}</span>
					@endif
				</div>

				<div class="form-group {{$errors->has('kabupaten') ? 'has-error' : ''}}">
					<label for="kabupaten">Kabupaten/Kota</label>
				    <select name="kabupaten" class="form-control" id="kabupaten">
				      	<option value="">--- Pilih Kabupaten ---</option>
				      	@foreach($data_kabupaten as $kabupaten)
				      		<option value="{{ $kabupaten->kode }}" {{ ($dsbs->kabupaten_id == $kabupaten->kode) ? 'selected' : '' }}>[{{$kabupaten->kode}}]&nbsp;{{$kabupaten->kabupaten}}</option>
				      	@endforeach
				    </select>
				    @if ($errors->has('kabupaten'))
						<span class="text-danger">{{$errors->first('kabupaten')}}</span>
					@endif
				</div>

				<div class="form-group {{$errors->has('kecamatan') ? 'has-error' : ''}}">
					<label for="kecamatan">Kecamatan</label>
				    <select name="kecamatan" class="form-control" id="kecamatan">
				      	<option value="">--- Pilih Kecamatan ---</option>
				      	@foreach($data_kecamatan as $kecamatan)
				      		<option value="{{ $kecamatan->kode }}" {{ ($dsbs->kecamatan_id == $kecamatan->kode) ? 'selected' : '' }}>[{{$kecamatan->kode}}]&nbsp;{{ $kecamatan->kecamatan}}</option>
				      	@endforeach
				    </select>
				    @if ($errors->has('kecamatan'))
						<span class="text-danger">{{$errors->first('kecamatan')}}</span>
					@endif
				</div>

				<div class="form-group {{$errors->has('desa') ? 'has-error' : ''}}">
					<label for="desa">Desa/Kelurahan</label>
				    <select name="desa" class="form-control" id="desa">
				      	<option value="">--- Pilih Desa ---</option>
				      	@foreach($data_desa as $desa)
				      		<option value="{{ $desa->kode }}" {{ ($dsbs->desa_id == $desa->kode) ? 'selected' : '' }}>[{{$desa->kode}}]&nbsp;{{ $desa->desa}}</option>
				      	@endforeach
				    </select>
				    @if ($errors->has('desa'))
						<span class="text-danger">{{$errors->first('desa')}}</span>
					@endif
				</div>

	            <div class="form-group {{$errors->has('nbs') ? 'has-error' : ''}}">
	              <label>Nomor Blok Sensus</label>
	              <input name="nbs" type="text" class="form-control" placeholder="Nomor Blok Sensus" value="{{ $errors->any() ? old('nbs')  : $dsbs->nbs}}">
	              @if ($errors->has('nbs'))
	                <span class="text-danger">{{$errors->first('nbs')}}</span>
	              @endif
	            </div>   

	            <div class="form-group {{$errors->has('nks') ? 'has-error' : ''}}">
	              <label>Nomor Kode Sampel</label>
	              <input name="nks" type="text" class="form-control" placeholder="Nomor Kode Sampel" value="{{ $errors->any() ? old('nks')  : $dsbs->nks }}">
	              @if ($errors->has('nks'))
	                <span class="text-danger">{{$errors->first('nks')}}</span>
	              @endif
	            </div>  
			</div>
			
			</fieldset>
			<div class="card-footer py-3">
				  <button type="submit" class="btn btn-primary">OK</button>
			</div>
			</form>
		    	
		</div>	
   	</div>	

@endsection