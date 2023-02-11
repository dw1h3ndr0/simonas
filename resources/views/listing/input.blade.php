@extends('layouts.master')

@section('content')

	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800">Input Listing</h1>
	    <div>
	    	<a href="#" data-toggle="modal" data-target="#importListing" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-file-import fa-lg text-white-50"></i> &nbsp; Import File </a>
	    </div>
    </div>

    <div class="container-fluid">
    	<div class="card shadow mb-4">
    		<div class="card-header py-3">    			
		      	<h6 class="m-0 font-weight-bold  card-title">
		      		<a href="{{ asset(route('listing', [], false)) }}"><i class="fas fa-chevron-left"></i></a>
		      		Input Listing Rumah Tangga
		  		</h6>
		    </div>    	

	    	<form action="{{ asset(route('listing.update', ['page'=> 'input'], false)) }}" method="POST">
	    	@csrf
		    
		    <div class="card-body">

		    	<fieldset disabled>
		    		
		    	<div class="form-group">
		    	  <label>Kegiatan</label>
	              <select name="kegiatan" class="form-control">
	                <option value=""}}>-- Pilih Kegiatan --</option>
	                @foreach($data_kegiatan as $kegiatan)
	                  <option value="{{ $kegiatan->id }}" {{ ($kode_kegiatan == $kegiatan->id) ? 'selected' : '' }}>{{$kegiatan->nama_keg}}&nbsp;{{$kegiatan->periode}}&nbsp;{{$kegiatan->tahun}}</option>                
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

		    	<input type="hidden" name="kegiatan" value="{{$kode_kegiatan}}">
		    	<input type="hidden" name="provinsi" value="{{$kode_provinsi}}">
		    	<input type="hidden" name="kabupaten" value="{{$kode_kabupaten}}">

	            <div class="form-group {{$errors->has('nks') ? 'has-error' : ''}}">
					<label for="nks">Nomor Kode Sampel</label>
				    <select name="nks" class="form-control" id="nks">
				      	<option value="">--- Pilih Nomor Kode Sampel ---</option>
				      	@foreach($data_dsbs as $dsbs)
				      		<option value="{{ $dsbs['nks'] }}" {{ (old('nks') == $dsbs['nks']) ? 'selected' : '' }}>{{ $dsbs['nks'] }}</option>
				      	@endforeach
				    </select>
				    @if ($errors->has('nks'))
						<span class="text-danger">{{$errors->first('nks')}}</span>
					@endif
				</div>     

				<div class="form-group {{$errors->has('p1') ? 'has-error' : ''}}">
	              <label>P1</label>
	              <input name="p1" type="text" class="form-control" placeholder="" value="{{ old('p1') }}">
		            <span class="text-xs">
				      Jumlah Rumah Tangga Hasil Listing
				    </span>
	              @if ($errors->has('p1'))
	                <span class="text-danger">{{$errors->first('p1')}}</span>
	              @endif
	            </div>

	            <div class="form-group {{$errors->has('status') ? 'has-error' : ''}}">
	            	<label>Status Listing</label>
		            <div class="form-check">
					  <input class="form-check-input" value="Selesai" type="radio" name="status" id="status_selesai" {{ (old('status') == 'Selesai') ? 'checked' : '' }}>
					  <label class="form-check-label" for="status_selesai">
					    Selesai
					  </label>
					</div>
					<div class="form-check">
					  <input class="form-check-input" value="Belum" type="radio" name="status" id="status_belum" {{ (old('status') == 'Belum') ? 'checked' : '' }}>
					  <label class="form-check-label" for="status_belum">
					    Belum Selesai
					  </label>
					</div>
	            </div>

			</div>
			
			<div class="card-footer py-3">
				  <button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i> Input Listing</button>
			</div>
			
			</form>
		    	
		</div>	
   	</div>	

   	<div class="modal fade" id="importListing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form method="post" action="{{ asset(route('listing.import_excel', [], false)) }}" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Import Listing</h5>
					</div>
					<div class="modal-body">

						{{ csrf_field() }}

						<label>Pilih file excel</label>
						<div class="form-group">
							<input type="file" name="file" required="required">
						</div>
						<div class="form-group">
							<a href="{{ URL::to( '/assets/template/template_listing.xls')  }}" target="_blank">download template</a>
						</div>
						@if (isset($errors) && $errors->any())
							<div class="alert alert-danger">
								@foreach($errors->all() as $error)
									{{ $error }} <br>
								@endforeach
							</div>
						@endif

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Import</button>
					</div>
				</div>
			</form>
		</div>
	</div>

@endsection


@push('scripts')
<script>

	base_url="{{asset('')}}";	


		/**** JQuery Dinamic Dropdown Pilih Listing *******/

		$(document).ready(function() {			

    		$('select[name="nks"]').on('change', function() {
    		 	var kegiatan = $('select[name="kegiatan"]').val();
    		 	var nks = $(this).val();

    		 	var url = base_url+'listing/'+kegiatan+'/'+nks+'/input/edit';

    		 	if(nks) {
    		 		window.location = url;
    		 	}
    		});	

    	});

</script>
@endpush