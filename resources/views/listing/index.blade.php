@extends('layouts.master')

@section('content')

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Listing</h1>
  </div>

	<div class="container-fluid">

	  <!-- DataTables Listing -->
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Daftar Listing</h6>
	    </div>
	    <div class="card-body">
	    	{{-- <form action="{{ asset(route('listing.refresh', [], false)) }}" method="POST"> --}}
	    	<div class="form-group">
	    	<fieldset disabled>
	    		
	    	  <label>Kegiatan</label>
              <select name="kegiatan" class="form-control">
                <option value=""}}>-- Pilih Kegiatan --</option>
                @foreach($data_kegiatan as $kegiatan)
                  <option value="{{ $kegiatan->id }}" {{ ($kode_kegiatan == $kegiatan->id) ? 'selected' : '' }}>{{$kegiatan->nama_keg}}&nbsp;{{$kegiatan->periode}}&nbsp;{{$kegiatan->tahun}}</option>                
                @endforeach
              </select>
	    	</fieldset>
	    	</div>

	    	<input type="hidden" name="kegiatan" value="{{$kode_kegiatan}}">

	    	<div class="form-group {{$errors->has('nks') ? 'has-error' : ''}}">
				<label for="nks">Nomor Kode Sampel</label>
			    <select name="nks" class="form-control" id="nks">
			      	<option value="00">--- Semua NKS ---</option>
			      	@foreach($data_dsbs as $dsbs)
			      		<option value="{{ $dsbs['nks'] }}" {{ ($kode_nks == $dsbs['nks']) ? 'selected' : '' }}>{{ $dsbs['nks'] }}</option>
			      	@endforeach
			    </select>
			    @if ($errors->has('nks'))
					<span class="text-danger">{{$errors->first('nks')}}</span>
				@endif
			</div>
			{{-- <div class="card-footer py-3">
				  <button type="submit" class="btn btn-primary">Refresh</button>
			</div>
			</form> --}}
	    </div>
	    <div class="card-body">
	      <div class="table-responsive">
	        <table class="table table-bordered" id="listingtable" width="100%" cellspacing="0">
	          <thead>
	            <tr>
	              <th>NKS</th>
	              <th>Petugas</th>
	              <th>P1</th>
	              <th class="text-center">Status</th>
	              <th class="text-center">Aksi</th>
	            </tr>
	          </thead>
	          <tfoot>
	            <tr>
	              <th>NKS</th>
	              <th>Petugas</th>
	              <th>P1</th>
	              <th class="text-center">Status</th>
	              <th class="text-center">Aksi</th>
	            </tr>
	          </tfoot>
	          <tbody>

	          	@foreach($data_listing as $listing)
	            <tr>
	              <td>{{ $listing->nks }}</td>
	              <td>{{ $listing->user_pcl->nama }}</td>
	              <th>{{ $listing->p1 }}</th>
	              <td class="text-center">
	              	@if($listing->status == 'Selesai')
	              		<a href="#" class="btn btn-success btn-circle btn-sm">
		                    <i class="fas fa-check"></i>
		                </a>
	              	@endif
	              </td>
	              <td class="text-center">
					<a href="{{ asset(route('listing.edit', ['kode_kegiatan'=> $kode_kegiatan, 'kode_nks'=> $listing->nks, 'page'=>'index'], false)) }}" class="btn btn-info btn-sm text-xs" title="edit"><span class="fa fa-keyboard"></span> Input</a>					
	              	{{-- <a href="{{ asset(route('listing.lihat', ['id'=> $listing->id], false)) }}" class="fa fa-eye" title="lihat"></a> --}}
				  </td>	              
	            </tr>
	            @endforeach

	          </tbody>
	        </table>
	      </div>
	    </div>
	    <div class="card-footer text-xs">
	    	<h6>Keterangan:</h6>
	    	<p>
	    		P1 = Jumlah Rumah Tangga Hasil Listing<br>
	    	</p>

	    </div>
	  </div>

	</div>

 @endsection

 @push('scripts')
<script>

    $(document).ready(function() {

        $('#listingtable').DataTable(); 				

	});


	base_url="{{asset('')}}";	

		/**** JQuery Dinamic Dropdown Pilih Wilayah *******/

		$(document).ready(function() {
    		$('select[name="nks"]').on('change', function() {
    		 	
				var kode_kegiatan = $('select[name="kegiatan"]').val();
    		 	var kode_nks = $(this).val();
				var	url = base_url+'listing/'+kode_kegiatan+'/'+kode_nks+'/refresh';
    		 	
    		 	if(kode_nks) {
    		 		window.location = url;
    		 	}
    		});	

    	});

    </script>
 @endpush
