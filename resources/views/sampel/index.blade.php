@extends('layouts.master')

@section('content')

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Daftar Pencacahan</h1>
    
  </div>

	<div class="container-fluid">

	  <!-- DataTables Sampel -->
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Daftar Pencacahan</h6>
	    </div>
	    <div class="card-body">
	    	{{-- <form action="{{ asset(route('sampel.refresh', [], false)) }}" method="POST"> --}}
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
	        <table class="table table-bordered" id="sampeltable" width="100%" cellspacing="0">
	          <thead>
	            <tr>
	              <th>NKS</th>
	              <th>Petugas</th>
	              <th>NUS</th>
	              <th>P1</th>
	              <th>P2</th>
	              <th>P3</th>
	              <th>P4</th>
	              <th>P5</th>
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
	              <th>P4</th>
	              <th>P5</th>
	              <th class="text-center">Status</th>
	              <th class="text-center">Aksi</th>
	            </tr>
	          </tfoot>
	          <tbody>

	          	@foreach($data_sampel as $sampel)
	            <tr>
	              <td>{{ $sampel->nks }}</td>
	              <td>{{ $sampel->user_pcl->nama }}</td>
	              <td>{{ $sampel->nus }}</td>
	              <th>{{ $sampel->p1 }}</th>
	              <th>{{ $sampel->p2 }}</th>
	              <th>{{ $sampel->p3 }}</th>
	              <th>{{ $sampel->p4 }}</th>
	              <th>{{ $sampel->p5 }}</th>
	              <td class="text-center">
	              	@if($sampel->status == 'Selesai')
	              		<a href="#" class="btn btn-success btn-circle btn-sm">
		                    <i class="fas fa-check"></i>
		                </a>
	              	@endif
	              </td>
	              <td class="text-center">
					<a href="{{ asset(route('sampel.edit', ['kode_kegiatan'=> $kode_kegiatan, 'kode_nks'=> $sampel->nks, 'kode_nus'=> $sampel->nus, 'page'=>'index'], false)) }}" class="btn btn-info btn-sm text-xs" title="edit"><span class="fa fa-keyboard"></span> Input</a>					
	              	{{-- <a href="{{ asset(route('sampel.lihat', ['id'=> $sampel->id], false)) }}" class="fa fa-eye" title="lihat"></a> --}}
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
	    		P1 = Jumlah ART (R301)<br>
		    	P2 = BIV.3.2. R16 Kolom 3<br>
		    	P3 = BIV.3.3. R8 Kolom 3<br>
		    	P4 = R304<br>
		    	P5 = R305<br>
	    	</p>

	    </div>
	  </div>

	</div>

 @endsection

 @push('scripts')
<script>

    $(document).ready(function() {

        $('#sampeltable').DataTable(); 				

	});


	base_url="{{asset('')}}";	

		/**** JQuery Dinamic Dropdown Pilih Wilayah *******/

		$(document).ready(function() {
    		$('select[name="nks"]').on('change', function() {
    		 	
				var kode_kegiatan = $('select[name="kegiatan"]').val();
    		 	var kode_nks = $(this).val();
				var	url = base_url+'sampel/'+kode_kegiatan+'/'+kode_nks+'/refresh';
    		 	
    		 	if(kode_nks) {
    		 		window.location = url;
    		 	}
    		});	

    	});

    </script>
 @endpush
