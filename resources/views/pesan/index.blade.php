@extends('layouts.master')

@section('content')

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pesan</h1>
    
  </div>

	<div class="container-fluid">

	  <!-- DataTables Listing -->
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Pesan</h6>
	    </div>
	    <div class="card-body">
	    	<form action="{{ asset(route('pesan.send', [], false)) }}" method="POST">
	    		@csrf
	    	<div class="form-group row mb-3{{$errors->has('jenis_penerima') ? 'has-error' : ''}}">	    		
	    	  	<label class="col-sm-2">Penerima</label>
              	<select class="form-control col-sm-10" id="jenis_penerima" name="jenis_penerima" data-live-search="true">
				  <option value="petugas" selected>Petugas</option>
				  <option value="pml">PML</option>
				  <option value="pcl">PCL</option>
				</select>
				@if ($errors->has('jenis_penerima'))
					<span class="text-danger">{{$errors->first('jenis_penerima')}}</span>
				@endif
	    	</div>

	    	<div class="pp form-group row mb-3 {{$errors->has('petugas') ? 'has-error' : ''}}">
	    		<label class="col-sm-2">Petugas</label>
		        <select id="petugas" class="form-control col-sm-10" name="petugas" style="width:100%;">  
  			      <option value="" selected>--- pilih petugas ---</option>		          
		          @foreach($users as $user)
		          <option value="{{$user->id}}"  {{old('petugas') == $user->id?'selected':''}} >{{$user->nama}} ({{$user->no_hp}})</option>
		          @endforeach
		        </select>
		        @if ($errors->has('petugas'))
					<span class="text-danger">{{$errors->first('petugas')}}</span>
				@endif
		    </div>
			
			<div class="form-group row mb-3 {{$errors->has('judul') ? 'has-error' : ''}}">
				<label for="judul" class="col-sm-2">Judul Pesan</label>
			    <input class="form-control col-sm-10" name="judul" rows="3" value="{{old('judul')}}"></input>
			    @if ($errors->has('judul'))
					<span class="text-danger">{{$errors->first('judul')}}</span>
				@endif
			</div>
	    	
	    	<div class="row g-3">
	    	<div class="col-md-8 {{$errors->has('pesan') ? 'has-error' : ''}}">
				<label for="pesan">Isi Pesan</label>
			    <textarea class="form-control" name="pesan" rows="8" >{{old('pesan')}}</textarea>
			    @if ($errors->has('pesan'))
					<span class="text-danger">{{$errors->first('pesan')}}<br></span>
				@endif
			    <small class="text-muted">Tulis pesan sesuai format penulisan dalam Whatsapp.<br></small>
			    {{-- <div class="card-footer text-xs"> --}}
			    	
			    {{-- </div> --}}
			</div>
			<div class="col-md-4">
				<small class="text-muted">
					<br>variabel:<br>
		    		#RL = Jumlah realisasi listing penerima<br>
		    		#TL = Jumlah target listing penerima<br>
		    		#RC = Jumlah realisasi pencacahan penerima<br>
		    		#TC = Jumlah target pencacahan penerima<br>
		    		#RD = Jumlah pengumpulan dokumen penerima<br>
		    		#TD = Jumlah target pengumpulan dokumen penerima<br>
		    	</small>
			</div>
			</div>
			<div class="card-footer py-3">
				  <button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Kirim</button>
			</div>
			</form>
	    </div>
	</div>
	<div class="card shadow mb-4">
	    <div class="card-body">
	      <div class="table-responsive">
	        <table class="table table-bordered" id="listingtable" width="100%" cellspacing="0">
	          <thead>
	            <tr>
	              <th>Judul</th>
	              <th>Pesan</th>
	              <th>Penerima</th>
	              <th>Nomor Penerima</th>
	            </tr>
	          </thead>
	          <tfoot>
	            <tr>
	              <th>Judul</th>
	              <th>Pesan</th>
	              <th>Penerima</th>
	              <th>Nomor Penerima</th>
	            </tr>
	          </tfoot>
	          <tbody>

	          	@foreach($data_pesan as $pesan)
	            <tr>
	              <td>{{ $pesan->judul }}</td>
	              <td>{{ $pesan->pesan }}</td>
	              <td>{{ $pesan->penerima }}</td>
	              <td>{{ $pesan->no_penerima }}</td>         
	            </tr>
	            @endforeach

	          </tbody>
	        </table>
	      </div>
	    </div>
	  </div>

	</div>

 @endsection

 @push('scripts')

<script src="{{asset('vendor/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<script>

    $(document).ready(function() {

        $('#listingtable').DataTable(); 

        $('#jenis_penerima').change(function(e){
		    var jenis = $(this).val();
		    if(jenis=='petugas'){
		      $('#petugas').show();
		      $('.pp').show();
		    }else{
		      $('#petugas').hide();
		      $('.pp').hide();
		    }
		});				

	});


	base_url="{{asset('')}}";	

		/**** JQuery Dinamic Dropdown Pilih Wilayah *******/

		$(document).ready(function() {    			

    		$('select[id="selectpicker"]').selectpicker();

    	});

    </script>
 @endpush
