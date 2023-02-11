@extends('layouts.master')

@section('content')

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800">Alokasi Petugas</h1>
    </div>

    <div class="container-fluid">
    	<div class="card shadow mb-4">
    		<div class="card-header py-3">    			
		      	<h6 class="m-0 font-weight-bold  card-title">
		      		<a href="{{ asset(route('alokasi', [], false)) }}"><i class="fas fa-chevron-left"></i></a>
		      		Edit Alokasi Petugas
		  		</h6>
		    </div>    	

	    	<form action="{{ asset(route('alokasi.update', ['id'=> $alokasi->id], false)) }}" method="POST">
	    	@csrf
		    
		    <div class="card-body">

		    	<div class="form-group">
		    	  <label>Kegiatan</label>
	              <select name="kegiatan" class="form-control">
	                <option value=""}}>-- Pilih Kegiatan --</option>
	                @foreach($data_kegiatan as $kegiatan)
	                  <option value="{{ $kegiatan->id }}" {{ ($alokasi->kegiatan_id == $kegiatan->id) ? 'selected' : '' }}>{{$kegiatan->nama_keg}}&nbsp;{{$kegiatan->periode}}&nbsp;{{$kegiatan->tahun}}</option>                
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
				      		<option value="{{ $provinsi->kode }}" {{ ($alokasi->simonas_dsbs->provinsi_id == $provinsi->kode) ? 'selected' : '' }}>[{{$provinsi->kode}}]&nbsp;{{$provinsi->provinsi}}</option>
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
				      		<option value="{{ $kabupaten->kode }}" {{ ($alokasi->simonas_dsbs->kabupaten_id == $kabupaten->kode) ? 'selected' : '' }}>[{{$kabupaten->kode}}]&nbsp;{{$kabupaten->kabupaten}}</option>
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
				      		<option value="{{ $kecamatan->kode }}" {{ ($alokasi->simonas_dsbs->kecamatan_id == $kecamatan->kode) ? 'selected' : '' }}>[{{$kecamatan->kode}}]&nbsp;{{ $kecamatan->kecamatan}}</option>
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
				      		<option value="{{ $desa->kode }}" {{ ($alokasi->simonas_dsbs->desa_id == $desa->kode) ? 'selected' : '' }}>[{{$desa->kode}}]&nbsp;{{ $desa->desa}}</option>
				      	@endforeach
				    </select>
				    @if ($errors->has('desa'))
						<span class="text-danger">{{$errors->first('desa')}}</span>
					@endif
				</div>

				<div class="form-group {{$errors->has('nks') ? 'has-error' : ''}}">
					<label for="nks">Nomor Kode Sampel</label>
				    <select name="nks" class="form-control" id="nks">
				      	<option value="">--- Pilih Nomor Kode Sampel ---</option>
				      	@foreach($data_dsbs as $dsbs)
				      		<option value="{{ $dsbs->nks }}" {{ ($alokasi->simonas_dsbs->nks == $dsbs->nks) ? 'selected' : '' }}>{{ $dsbs->nks }}</option>
				      	@endforeach
				    </select>
				    @if ($errors->has('nks'))
						<span class="text-danger">{{$errors->first('nks')}}</span>
					@endif
				</div>

	            <div class="form-group {{$errors->has('nama_petugas') ? 'has-error' : ''}}">
					<label for="nama_petugas">Nama Petugas</label>
				    <select name="nama_petugas" class="form-control" id="nama_petugas">
				      	<option value="">--- Pilih Nama Petugas ---</option>
				      	@foreach($data_petugas as $petugas)
				      		<option value="{{ $petugas->id }}" {{ ($alokasi->users->id == $petugas->id) ? 'selected' : '' }}>{{$petugas->nama}}</option>
				      	@endforeach
				    </select>
				    @if ($errors->has('nama_petugas'))
						<span class="text-danger">{{$errors->first('nama_petugas')}}</span>
					@endif
				</div>

				<div id="jab" class="form-group {{$errors->has('jabatan') ? 'has-error' : ''}}">
					<label for="jabatan">Jabatan</label>
				    <input name="jabatan" class="form-control" id="jabatan" value="{{$alokasi->users->jabatan}}" readonly>
				      	{{-- <option value="">--- Jabatan ---</option>				      	
				      	<option value="organik" {{ ($alokasi->users->jabatan == 'organik') ? 'selected' : '' }}>Organik</option>
				      	<option value="mitra" {{ ($alokasi->users->jabatan == 'mitra') ? 'selected' : '' }}>Mitra</option>	 --}}				      				      	
				    </input>
				    @if ($errors->has('jabatan'))
						<span class="text-danger">{{$errors->first('jabatan')}}</span>
					@endif
				</div>

				<div class="form-group {{$errors->has('status') ? 'has-error' : ''}}">
					<label for="status">Status</label>
				    <select name="status" class="form-control" id="status" >
				      	<option value="">--- Pilih Status ---</option>				      	
				      	<option value="PCL" {{ ($alokasi->status == 'PCL') ? 'selected' : '' }}>PCL</option>
				      	<option value="PML" {{ ($alokasi->status == 'PML') ? 'selected' : '' }}>PML</option>				      	
				    </select>
				    @if ($errors->has('status'))
						<span class="text-danger">{{$errors->first('status')}}</span>
					@endif
				</div>

	            <div class="form-group {{$errors->has('kode') ? 'has-error' : ''}}">
	              <label>Kode Petugas</label>
	              <input name="kode" type="text" class="form-control" placeholder="Kode Petugas" value="{{ $alokasi->kode }}">
	              @if ($errors->has('kode'))
	                <span class="text-danger">{{$errors->first('kode')}}</span>
	              @endif
	            </div>

				<div id="atasan" class="form-group {{$errors->has('nama_atasan') ? 'has-error' : ''}}">
					<label for="nama_atasan">Nama Pengawas</label>
				    <select name="nama_atasan" class="form-control" id="nama_atasan">
				      	@if($leader)
				      		<option value="">--- Pilih Nama Pengawas ---</option>
					      	@foreach($data_petugas as $petugas)
					      		<option value="{{ $petugas->id }}" {{ ($alokasi->users_leader->id == $petugas->id) ? 'selected' : '' }}>{{$petugas->nama}}
					      		</option>
					      	@endforeach
				      	@else
					      	<option value="" selected>--- Pilih Nama Pengawas ---</option>
					      	@foreach($data_petugas as $petugas)
						      	<option value="{{ $petugas->id }}" {{ (old('nama_atasan') == $petugas->id) ? 'selected' : '' }}>{{$petugas->nama}}
						      	</option>
					      	@endforeach
				      	@endif
				    </select>
				    @if ($errors->has('nama_atasan'))
						<span class="text-danger">{{$errors->first('nama_atasan')}}</span>
					@endif
				</div>
  
			</div>
			
			<div class="card-footer py-3">
				  <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Update Alokasi Petugas</button>
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
    		 				$('select[name="nks"]').empty();
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
    		 				$('select[name="nks"]').empty();
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
    		 				$('select[name="nks"]').empty();
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
    		 				$('select[name="nks"]').empty();
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

    	$(document).ready(function(){
    		$('select[name="desa"]').on('change', function() {
    		 	
    		 	var kode_kegiatan = $('select[name="kegiatan"]').val();
    		 	var kode_provinsi = $('select[name="provinsi"]').val();
    		 	var kode_kabupaten = $('select[name="kabupaten"]').val();
    		 	var kode_kecamatan = $('select[name="kecamatan"]').val();
    		 	var kode_desa = $(this).val();
    		 	console.log(kode_kegiatan)
    		 	console.log(kode_provinsi)
    		 	console.log(kode_kabupaten)
    		 	console.log(kode_kecamatan)
    		 	console.log(kode_desa)
    		 	if(kode_desa) {

    		 		$.ajax({

    		 			url: base_url+'desa/'+kode_kegiatan+'/'+kode_provinsi+'/'+kode_kabupaten+'/'+kode_kecamatan+'/'+kode_desa,
    		 			type: 'GET',
    		 			dataType: 'json',
    		 			success: function(data){
    		 				// console.log(data)
    		 				$('select[name="nks"]').empty();
    		 				$('select[name="nks"]').append('<option value="">--- Pilih NKS ---</option>');
    		 				$.each(data, function(key, value) {
			                    $('select[name="nks"]').append('<option value="'+ value +'">'+ value +'</option>');
			                 });
    		 			}
    		 		});
    		 	}else{
    		 		$('select[name="nks"]').empty();
    		 	}
    		});
    	});

    	$(document).ready(function(){
    		$('select[name="nama_petugas"]').on('change', function() {
    		 	
    		 	var id_petugas = $(this).val();
    		 	var jab = document.getElementById("jab");
    		 	// console.log(id_petugas)
    		 	if(id_petugas) {

    		 		$.ajax({

    		 			url: base_url+'petugas/'+id_petugas+'/jabatan',
    		 			type: 'GET',
    		 			dataType: 'json',
    		 			success: function(data){
    		 				// console.log(data)
    		 				$.each(data, function(key, value) {
			                    $('#jabatan').val(value);
			    		 		jab.style.display = "block";
			                 });
    		 			}
    		 		});
    		 	}else{
    		 		$('#jabatan').empty();
    		 		jab.style.display = "none";
    		 	}
    		});
    	});

    	$(document).ready(function(){
    		$('select[name="status"]').on('change', function() {
    		 	
    		 	var status = $(this).val();
    		 	var atasan = document.getElementById("atasan");
    		 	console.log(status)
    		 	if(status == "PCL") {
    		 		document.getElementById("nama_atasan").selectedIndex = 0;
			    	atasan.style.display = "block";    		 		    		 		
    		 	}else{    		 		
    		 		document.getElementById("nama_atasan").selectedIndex = 0;
    		 		atasan.style.display = "none";
    		 	}
    		});
    	});


</script>
@endpush