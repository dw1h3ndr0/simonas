@extends('layouts.master')

@section('content')

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800">Input Pencacahan</h1>
    </div>

    <div class="container-fluid">
    	<div class="card shadow mb-4">
    		<div class="card-header py-3">    			
		      	<h6 class="m-0 font-weight-bold  card-title">
		      		<a href="{{ asset(route('sampel.refresh', ['kode_kegiatan'=> $pencacahan->kegiatan_id, 'kode_nks'=> $pencacahan->nks], false)) }}"><i class="fas fa-chevron-left"></i></a>
		      		Input Pencacahan Rumah Tangga
		  		</h6>
		    </div>    	

	    	<form action="{{ asset(route('sampel.update', ['page'=> $page], false)) }}" method="POST">
	    	@csrf
		    
		    <div class="card-body">

		    	<fieldset disabled>
		    		
		    	<div class="form-group">
		    	  <label>Kegiatan</label>
	              <select name="kegiatan" class="form-control">
	                <option value=""}}>-- Pilih Kegiatan --</option>
	                @foreach($data_kegiatan as $kegiatan)
	                  <option value="{{ $kegiatan->id }}" {{ ($pencacahan->kegiatan_id == $kegiatan->id) ? 'selected' : '' }}>{{$kegiatan->nama_keg}}&nbsp;{{$kegiatan->periode}}&nbsp;{{$kegiatan->tahun}}</option>                
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
				      		<option value="{{ $provinsi->kode }}" {{ ($kode_provinsi == $provinsi->kode) ? 'selected' : '' }}>[{{$provinsi->kode}}]&nbsp;{{$provinsi->provinsi}}</option>
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
				      		<option value="{{ $kabupaten->kode }}" {{ ($kode_kabupaten == $kabupaten->kode) ? 'selected' : '' }}>[{{$kabupaten->kode}}]&nbsp;{{$kabupaten->kabupaten}}</option>
				      	@endforeach
				    </select>
				    @if ($errors->has('kabupaten'))
						<span class="text-danger">{{$errors->first('kabupaten')}}</span>
					@endif
				</div>
		    	</fieldset>	

	            <div class="form-group {{$errors->has('nks') ? 'has-error' : ''}}">
					<label for="nks">Nomor Kode Sampel</label>
				    <select name="nks" class="form-control" id="nks">
				      	<option value="">--- Pilih Nomor Kode Sampel ---</option>
				      	@foreach($data_dsbs as $dsbs)
				      		<option value="{{ $dsbs['nks'] }}" {{ ($pencacahan->nks == $dsbs['nks']) ? 'selected' : '' }}>{{ $dsbs['nks'] }}</option>
				      	@endforeach
				    </select>
				    @if ($errors->has('nks'))
						<span class="text-danger">{{$errors->first('nks')}}</span>
					@endif
				</div>  

	            <div class="form-group {{$errors->has('nus') ? 'has-error' : ''}}">
					<label for="nus">Nomor Urut Sampel</label>
				    <select name="nus" class="form-control" id="nus">
				      	<option value="">--- Pilih Nomor Urut Sampel ---</option>
				      	@for ($i = 1; $i < 11; $i++)
				      		<option value="{{ $i }}" {{ ($pencacahan->nus == $i) ? 'selected' : '' }}>{{ $i }}</option>
				      	@endfor
				    </select>
				    @if ($errors->has('nus'))
						<span class="text-danger">{{$errors->first('nus')}}</span>
					@endif
				</div>    

		    	<input type="hidden" name="kegiatan" value="{{$pencacahan->kegiatan_id}}">
		    	<input type="hidden" name="provinsi" value="{{$kode_provinsi}}">
		    	<input type="hidden" name="kabupaten" value="{{$kode_kabupaten}}">
		    	{{-- <input type="hidden" name="nks" value="{{$pencacahan->nks}}"> --}}
		    	{{-- <input type="hidden" name="nus" value="{{$pencacahan->nus}}"> --}}
		    	<input type="hidden" name="page" value="{{$page}}">

				<div class="form-group {{$errors->has('p1') ? 'has-error' : ''}}">
	              <label>P1</label>
	              <input name="p1" type="text" class="form-control" placeholder="" value="{{ $pencacahan->p1 }}">
		            <span class="text-xs">
				      Jumlah ART (R301)
				    </span>
	              @if ($errors->has('p1'))
	                <span class="text-danger">{{$errors->first('p1')}}</span>
	              @endif
	            </div>

	            <div class="form-group {{$errors->has('p2') ? 'has-error' : ''}}">
	              <label>P2</label>
	              <input name="p2" type="text" class="form-control" placeholder="" value="{{ $pencacahan->p2 }}">
		            <span class="text-xs">
				      BIV.3.2. R16 Kolom 3
				    </span>
	              @if ($errors->has('p2'))
	                <span class="text-danger">{{$errors->first('p2')}}</span>
	              @endif
	            </div>

	            <div class="form-group {{$errors->has('p3') ? 'has-error' : ''}}">
	              <label>P3</label>
	              <input name="p3" type="text" class="form-control" placeholder="" value="{{ $pencacahan->p3 }}">
		            <span class="text-xs">
				      BIV.3.3. R8 Kolom 3
				    </span>
	              @if ($errors->has('p3'))
	                <span class="text-danger">{{$errors->first('p3')}}</span>
	              @endif
	            </div>

	            <div class="form-group {{$errors->has('p4') ? 'has-error' : ''}}">
	              <label>P4</label>
	              <input name="p4" type="text" class="form-control" placeholder="" value="{{ $pencacahan->p4 }}">
		            <span class="text-xs">
				      R304
				    </span>
	              @if ($errors->has('p4'))
	                <span class="text-danger">{{$errors->first('p4')}}</span>
	              @endif
	            </div>

	            <div class="form-group {{$errors->has('p5') ? 'has-error' : ''}}">
	              <label>P5</label>
	              <input name="p5" type="text" class="form-control" placeholder="" value="{{ $pencacahan->p5 }}">
		            <span class="text-xs">
				      R305
				    </span>
	              @if ($errors->has('p5'))
	                <span class="text-danger">{{$errors->first('p5')}}</span>
	              @endif
	            </div>

	            <div class="form-group {{$errors->has('status') ? 'has-error' : ''}}">
	            	<label>Status Pencacahan</label>
		            <div class="form-check">
					  <input class="form-check-input" value="Selesai" type="radio" name="status" id="status_selesai" {{ ($pencacahan->status == 'Selesai') ? 'checked' : '' }}>
					  <label class="form-check-label" for="status_selesai">
					    Selesai
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input" value="Belum" type="radio" name="status" id="status_belum" {{ ($pencacahan->status == 'Belum') ? 'checked' : '' }}>
					  <label class="form-check-label" for="status_belum">
					    Belum Selesai
					  </label>
					</div>
	            </div>

			</div>
			
			<div class="card-footer py-3">
				  <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Input Pencacahan</button>
			</div>
			
			</form>
		    	
		</div>	
   	</div>	

@endsection


@push('scripts')
<script>

	base_url="{{asset('')}}";	

		/**** JQuery Dinamic Dropdown Pilih Sampel *******/

		$(document).ready(function() {			

    		$('select[name="nus"]').on('change', function() {
    		 	var kegiatan = $('select[name="kegiatan"]').val();    		 	
    		 	var nks = $('select[name="nks"]').val();
    		 	var page = $('select[name="page"]').val();
    		 	nus = $(this).val();

    		 	var url = base_url+'sampel/'+kegiatan+'/'+nks+'/'+nus+'/'+page+'/edit';

    		 	if(nus) {
    		 		window.location = url;
    		 	}
    		});	

    	});

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

</script>
@endpush