@extends('layouts.master')

@section('content')

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Rekapan Pemasukan Dokumen</h1>
    <div>
    	<a href="{{ asset(route('rekap.dokumen.export_excel', [], false)) }}" class="d-none d-sm-inline-block btn btn-primary shadow-sm"><i class="fas fa-file-excel fa-lg text-white-50"></i> &nbsp; Export Excel</a>
    </div>
    
  </div>

	<div class="container-fluid">

	  <!-- DataTables Dokumen -->
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Rekapan Pemasukan Dokumen</h6>
	    </div>
	    <div class="card-body">
	    	{{-- <form action="{{ asset(route('dokumen.refresh', [], false)) }}" method="POST"> --}}
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
	        <table class="table table-bordered" id="dokumentable" width="100%" cellspacing="0">
	          <thead>
	            <tr>
	              <th>Provinsi</th>
	              <th>Kabupaten</th>
	              <th>NKS</th>
	              <th>NUS</th>
	              <th>Status</th>
	              <th>P1</th>
	              <th>P2</th>
	              <th>P3</th>
	            </tr>
	          </thead>
	          <tfoot>
	            <tr>
	              <th>Provinsi</th>
	              <th>Kabupaten</th>
	              <th>NKS</th>
	              <th>NUS</th>
	              <th>Status</th>
	              <th>P1</th>
	              <th>P2</th>
	              <th>P3</th>
	            </tr>
	          </tfoot>
	          <tbody>

	          	@foreach($data_dokumen as $dokumen)
	            <tr>
	              <td>{{ $dokumen->provinsi_id }}</td>
	              <td>{{ $dokumen->kabupaten_id }}</td>
	              <td>{{ $dokumen->nks }}</td>
	              <td>{{ $dokumen->nus }}</td>
	              <td>{{ $dokumen->status }}</td>
	              <th>{{ $dokumen->p1 }}</th>
	              <th>{{ $dokumen->p2 }}</th>
	              <th>{{ $dokumen->p3 }}</th>            
	            </tr>
	            @endforeach

	          </tbody>
	        </table>
	      </div>
	    </div>
	    <div class="card-footer text-xs">
	    	<h6>Keterangan:</h6>
	    	<p>
	    		P1 = Jumlah ART yang Sedang Bersekolah (P612=2)<br>
		    	P2 = Jumlah Simcard Aktif (Blok VIII Jumlah R803 s.d. R806)<br>
		    	P3 = Jumlah ART yang Memiliki BPJS (Blok XI R1101 yang dilingkari A)<br>
	    	</p>

	    </div>
	  </div>

	</div>

 @endsection

 @push('scripts')
<script>

    $(document).ready(function() {

        $('#dokumentable').DataTable(); 				

	});


	base_url="{{asset('')}}";	

		/**** JQuery Dinamic Dropdown Pilih Wilayah *******/

		$(document).ready(function() {
    		$('select[name="nks"]').on('change', function() {
    		 	
				var kode_kegiatan = $('select[name="kegiatan"]').val();
    		 	var kode_nks = $(this).val();
				var	url = base_url+'rekap/dokumen/'+kode_kegiatan+'/'+kode_nks+'/refresh';
    		 	
    		 	if(kode_nks) {
    		 		window.location = url;
    		 	}
    		});	

    	});

    </script>
 @endpush
