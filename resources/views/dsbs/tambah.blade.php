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
		      		Tambah DSBS
		  		</h6>
		    </div>    	

	    	<form action="{{ asset(route('dsbs.create', [], false)) }}" method="POST">
	    	@csrf
		    
		    <div class="card-body">

		    	<div class="form-group">
		    	  <label>Kegiatan</label>
	              <select name="kegiatan" class="form-control">
	                <option value="" selected }}>-- Pilih Kegiatan --</option>
	                @foreach($data_kegiatan as $kegiatan)
	                  <option value="{{ $kegiatan->id }}">{{$kegiatan->nama_keg}}&nbsp;{{$kegiatan->periode}}&nbsp;{{$kegiatan->tahun}}</option>                
	                @endforeach
	              </select>
	              @if ($errors->has('kegiatan'))
						<span class="text-danger">{{$errors->first('kegiatan')}}</span>
				  @endif
		    	</div>

		    	<div class="form-group {{$errors->has('provinsi') ? 'has-error' : ''}}">
					<label for="provinsi">Provinsi</label>
				    <select name="provinsi" class="form-control" id="provinsi">
				      	{{-- <option value="">--- Pilih Provinsi ---</option>
				      	@foreach($data_provinsi as $provinsi)
				      		<option value="{{ $provinsi->kode }}" {{ (old('provinsi') == $provinsi->kode) ? 'selected' : '' }}>[{{$provinsi->kode}}]&nbsp;{{$provinsi->provinsi}}</option>
				      	@endforeach --}}
				    </select>
				    @if ($errors->has('provinsi'))
						<span class="text-danger">{{$errors->first('provinsi')}}</span>
					@endif
				</div>

				<div class="form-group {{$errors->has('kabupaten') ? 'has-error' : ''}}">
					<label for="kabupaten">Kabupaten/Kota</label>
				    <select name="kabupaten" class="form-control" id="kabupaten">
				      	{{-- <option value="">--- Pilih Kabupaten ---</option>
				      	@foreach($data_kabupaten as $kabupaten)
				      		<option value="{{ $kabupaten->kode }}" {{ (old('kabupaten') == $kabupaten->kode) ? 'selected' : '' }}>[{{$kabupaten->kode}}]&nbsp;{{$kabupaten->kabupaten}}</option>
				      	@endforeach --}}
				    </select>
				    @if ($errors->has('kabupaten'))
						<span class="text-danger">{{$errors->first('kabupaten')}}</span>
					@endif
				</div>

				<div class="form-group {{$errors->has('kecamatan') ? 'has-error' : ''}}">
					<label for="kecamatan">Kecamatan</label>
				    <select name="kecamatan" class="form-control" id="kecamatan">
				      	{{-- <option value="">--- Pilih Kecamatan ---</option>
				      	@foreach($data_kecamatan as $kecamatan)
				      		<option value="{{ $kecamatan->kode }}" {{ (old('kecamatan') == $kecamatan->kode) ? 'selected' : '' }}>[{{$kecamatan->kode}}]&nbsp;{{ $kecamatan->kecamatan}}</option>
				      	@endforeach --}}
				    </select>
				    @if ($errors->has('kecamatan'))
						<span class="text-danger">{{$errors->first('kecamatan')}}</span>
					@endif
				</div>

				<div class="form-group {{$errors->has('desa') ? 'has-error' : ''}}">
					<label for="desa">Desa/Kelurahan</label>
				    <select name="desa" class="form-control" id="desa">
				      	{{-- <option value="">--- Pilih Desa ---</option>
				      	@foreach($data_desa as $desa)
				      		<option value="{{ $desa->kode }}" {{ (old('desa') == $desa->kode) ? 'selected' : '' }}>[{{$desa->kode}}]&nbsp;{{ $desa->desa}}</option>
				      	@endforeach --}}
				    </select>
				    @if ($errors->has('desa'))
						<span class="text-danger">{{$errors->first('desa')}}</span>
					@endif
				</div>

	            <div class="form-group {{$errors->has('nbs') ? 'has-error' : ''}}">
	              <label>Nomor Blok Sensus</label>
	              <input name="nbs" type="text" class="form-control" placeholder="Nomor Blok Sensus" value="{{ old('nbs') }}">
	              @if ($errors->has('nbs'))
	                <span class="text-danger">{{$errors->first('nbs')}}</span>
	              @endif
	            </div>   

	            <div class="form-group {{$errors->has('nks') ? 'has-error' : ''}}">
	              <label>Nomor Kode Sampel</label>
	              <input name="nks" type="text" class="form-control" placeholder="Nomor Kode Sampel" value="{{ old('nks') }}">
	              @if ($errors->has('nks'))
	                <span class="text-danger">{{$errors->first('nks')}}</span>
	              @endif
	            </div>  
			</div>
			
			<div class="card-footer py-3">
				  <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Tambah DSBS</button>
			</div>
			
			</form>
		    	
		</div>	
   	</div>	

@endsection

@push('scripts')
<script>

	base_url="{{asset('')}}";	

		/**** JQuery Dinamic Dropdown Pilih Wilayah *******/

		$(document).ready(function() {
    		$('select[name="kegiatan"]').on('change', function() {
    		 	
    		 	var kode_kegiatan = $(this).val();
    		 	if(kode_kegiatan) {

    		 		$.ajax({

    		 			url: base_url+'kegiatan',
    		 			type: 'GET',
    		 			dataType: 'json',
    		 			success: function(data){
    		 				// console.log(data)
    		 				$('select[name="provinsi"]').empty();
    		 				$('select[name="kabupaten"]').empty();
    		 				$('select[name="kecamatan"]').empty();
    		 				$('select[name="desa"]').empty();
    		 				$('select[name="provinsi"]').append('<option value="">--- Pilih Provinsi ---</option>');
    		 				$.each(data, function(key, value) {
			                    $('select[name="provinsi"]').append('<option value="'+ key +'">'+'['+key+'] '+ value +'</option>');
			                 });
    		 			}
    		 		});
    		 	}else{
    		 		$('select[name="provinsi"]').empty();
    		 	}
    		});	

    	});

		$(document).ready(function() {
    		$('select[name="provinsi"]').on('change', function() {
    		 	
    		 	var kode_provinsi = $(this).val();
    		 	
    		 	if(kode_provinsi) {

    		 		$.ajax({

    		 			url: base_url+'provinsi/'+kode_provinsi,
    		 			type: 'GET',
    		 			dataType: 'json',
    		 			success: function(data){
    		 				// console.log(data)
    		 				$('select[name="kabupaten"]').empty();
    		 				$('select[name="kecamatan"]').empty();
    		 				$('select[name="desa"]').empty();
    		 				$('select[name="kabupaten"]').append('<option value="">--- Pilih Kabupaten ---</option>');
    		 				$.each(data, function(key, value) {
			                    $('select[name="kabupaten"]').append('<option value="'+ key +'">'+'['+key+'] '+ value +'</option>');
			                 });
    		 			}
    		 		});
    		 	}else{
    		 		$('select[name="kabupaten"]').empty();
    		 	}
    		});	

    	});

    	$(document).ready(function(){
    		$('select[name="kabupaten"]').on('change', function() {
    		 	
    		 	var kode_provinsi = $('select[name="provinsi"]').val();
    		 	var kode_kabupaten = $(this).val();
    		 	// console.log(kode_provinsi)
    		 	// console.log(kode_kabupaten)
    		 	if(kode_kabupaten) {

    		 		$.ajax({

    		 			url: base_url+'kabupaten/'+kode_provinsi+'/'+kode_kabupaten,
    		 			type: 'GET',
    		 			dataType: 'json',
    		 			success: function(data){
    		 				// console.log(data)
    		 				$('select[name="kecamatan"]').empty();
    		 				$('select[name="desa"]').empty();
    		 				$('select[name="kecamatan"]').append('<option value="">--- Pilih Kecamatan ---</option>');
    		 				$.each(data, function(key, value) {
			                    $('select[name="kecamatan"]').append('<option value="'+ key +'">'+'['+key+'] '+ value +'</option>');
			                 });
    		 			}
    		 		});
    		 	}else{
    		 		$('select[name="kecamatan"]').empty();
    		 	}
    		});
    	});

    	$(document).ready(function(){
    		$('select[name="kecamatan"]').on('change', function() {
    		 	
    		 	var kode_provinsi = $('select[name="provinsi"]').val();
    		 	var kode_kabupaten = $('select[name="kabupaten"]').val();
    		 	var kode_kecamatan = $(this).val();
    		 	// console.log(kode_provinsi)
    		 	// console.log(kode_kabupaten)
    		 	// console.log(kode_kecamatan)
    		 	if(kode_kecamatan) {

    		 		$.ajax({

    		 			url: base_url+'kecamatan/'+kode_provinsi+'/'+kode_kabupaten+'/'+kode_kecamatan,
    		 			type: 'GET',
    		 			dataType: 'json',
    		 			success: function(data){
    		 				// console.log(data)
    		 				$('select[name="desa"]').empty();
    		 				$('select[name="desa"]').append('<option value="">--- Pilih Desa ---</option>');
    		 				$.each(data, function(key, value) {
			                    $('select[name="desa"]').append('<option value="'+ key +'">'+'['+key+'] '+ value +'</option>');
			                 });
    		 			}
    		 		});
    		 	}else{
    		 		$('select[name="desa"]').empty();
    		 	}
    		});
    	});


</script>
@endpush