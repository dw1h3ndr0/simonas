@extends('layouts.master')

@section('content')

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Pemasukan Dokumen</h1>
  </div>

	<div class="container-fluid">

	  <!-- DataTables Dokumen -->
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Daftar Pemasukan Dokumen</h6>
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
	              <th>NKS</th>
	              <th>Petugas</th>
	              <th>NUS</th>
	              <th>P1</th>
	              <th>P2</th>
	              <th>P3</th>
	              <th class="text-center">Status</th>
	              <th class="text-center">Aksi</th>
	            </tr>
	          </thead>
	          <tfoot>
	            <tr>
	              <th>NKS</th>
	              <th>Petugas</th>
	              <th>NUS</th>
	              <th>P1</th>
	              <th>P2</th>
	              <th>P3</th>
	              <th>Status</th>
	              <th class="text-center">Aksi</th>
	            </tr>
	          </tfoot>
	          <tbody>

	          	@foreach($data_dokumen as $dokumen)
	            <tr>
	              <td>{{ $dokumen->nks }}</td>
	              <td>{{ $dokumen->user_pcl->nama }}</td>
	              <td>{{ $dokumen->nus }}</td>
	              <th>{{ $dokumen->p1 }}</th>
	              <th>{{ $dokumen->p2 }}</th>
	              <th>{{ $dokumen->p3 }}</th>
	              <td class="text-center">
	              	@if($dokumen->status == 'Selesai')
	              		<a href="#" class="btn btn-success btn-circle btn-sm">
		                    <i class="fas fa-check"></i>
		                </a>
	              	@endif
	              </td>
	              <td class="text-center">
					<a href="{{ asset(route('dokumen.edit', ['kode_kegiatan'=> $kode_kegiatan, 'kode_nks'=> $dokumen->nks, 'kode_nus'=> $dokumen->nus, 'page'=>'index'], false)) }}" class="btn btn-info btn-sm text-xs" title="edit"><span class="fa fa-keyboard"></span> Input</a>					
	              	{{-- <a href="{{ asset(route('dokumen.lihat', ['id'=> $dokumen->id], false)) }}" class="fa fa-eye" title="lihat"></a> --}}
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
				var	url = base_url+'dokumen/'+kode_kegiatan+'/'+kode_nks+'/refresh';
    		 	
    		 	if(kode_nks) {
    		 		window.location = url;
    		 	}
    		});	

    	});

    </script>
 @endpush
