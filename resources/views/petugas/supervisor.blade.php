@extends('layouts.master')

@section('content')

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Supervisor</h1>
    <div>
    	<div class="btn-group">
	        <button class="d-none d-sm-inline-block btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	        <i class="fa fa-user-cog fa-lg text-white-50"></i> &nbsp; Kelola
	        </button>
	        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">
	          <a data-toggle="modal" data-target="#importSupervisor" class="dropdown-item" href="#"><i class="fas fa-file-import fa-sm fa-fw mr-2 text-gray-400"></i>Import</a>
	          <a class="dropdown-item" href="{{ asset(route('supervisor.export_excel', [], false)) }}"><i class="fas fa-file-export fa-sm fa-fw mr-2 text-gray-400"></i>Export</a>
	        </div>
	    </div>    	

	    <a href="#" data-toggle="modal" data-target="#addSupervisorModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-user-plus fa-lg text-white-50"></i> &nbsp; Tambah Supervisor</a>
    	
    </div>
  </div>

	<div class="container-fluid">

	  <!-- DataTales Supervisor -->
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Daftar Supervisor</h6>
	    </div>
	    <div class="card-body">
	      <div class="table-responsive">
	        <table class="table table-bordered" id="spvtable" width="100%" cellspacing="0">
	          <thead>
	            <tr>
	              <th>Nama</th>
	              <th>Nomor HP</th>
	              <th>Email</th>
	              <th class="text-center">Aksi</th>
	            </tr>
	          </thead>
	          <tfoot>
	            <tr>
	              <th>Nama</th>
	              <th>Nomor HP</th>
	              <th>Email</th>
	              <th class="text-center">Aksi</th>
	            </tr>
	          </tfoot>
	          <tbody>

	          	@foreach($data_supervisor as $supervisor)
	            <tr>
	              <td>{{ $supervisor->nama }}</td>
	              <td>{{ $supervisor->no_hp }}</td>
	              <td>{{ $supervisor->email }}</td>
	              <td class="text-center">
	              	<a href="#" class="fa fa-eye view_spv" data-id="{{$supervisor->id}}" title="lihat"></a>
					<a href="#" class="fa fa-edit edit_spv" data-id="{{$supervisor->id}}" title="edit"></a>
					<a href="{{ asset(route('supervisor.konfirmasi', ['id'=> $supervisor->id], false)) }}" class="fa fa-trash" title="hapus" {{-- onclick="return confirm('Yakin mau dihapus?')" --}}></a>
				  </td>	              
	            </tr>
	            @endforeach

	          </tbody>
	        </table>
	      </div>
	    </div>
	  </div>

	</div>

<!-- Tambah Supervisor Modal-->
  <div class="modal fade" id="addSupervisorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{ asset(route('supervisor.tambah', [], false)) }}" method="POST">             
          @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Supervisor</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="form-group {{$errors->has('add_kegiatan_id') ? 'has-error' : ''}}">
              {{-- <label>Kegiatan</label>
              <select name="add_kegiatan_id" class="form-control">
                <option disabled value="" {{(Auth::user()->simonas_kegiatan->kegiatan_id == '') ? 'selected' : ''}}>-- Pilih Kegiatan --</option>
                @foreach($data_kegiatan as $kegiatan)
                  <option value="{{$kegiatan->id}}" {{(Auth::user()->simonas_kegiatan->kegiatan_id == $kegiatan->id) ? 'selected' : ''}}>{{$kegiatan->nama_keg}}&nbsp;{{$kegiatan->periode}}&nbsp;{{$kegiatan->tahun}}</option>                
                @endforeach
              </select> --}}
              @if ($errors->has('add_kegiatan_id'))
                <span class="text-danger">{{$errors->first('add_kegiatan_id')}}</span>
              @endif
            </div>  
            <div class="form-group {{$errors->has('add_nama') ? 'has-error' : ''}}">
              <label>Nama Lengkap</label>
              <input name="add_nama" type="text" class="form-control" placeholder="Nama Lengkap" value="{{ old('add_nama') }}">
              @if ($errors->has('add_nama'))
                <span class="text-danger">{{$errors->first('add_nama')}}</span>
              @endif
            </div>                                         
            <div class="form-group {{$errors->has('add_no_hp') ? 'has-error' : ''}}">
              <label>Nomor HP</label>
              <input name="add_no_hp" type="text" class="form-control" placeholder="Nomor Handphone" value="{{ old('add_no_hp') }}">
              @if ($errors->has('add_no_hp'))
                <span class="text-danger">{{$errors->first('add_no_hp')}}</span>
              @endif
            </div>              
            <div class="form-group {{$errors->has('add_email') ? 'has-error' : ''}}">
              <label>Email</label>
              <input name="add_email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Email" value="{{ old('add_email') }}">
              @if ($errors->has('add_email'))
                <span class="text-danger">{{$errors->first('add_email')}}</span>
              @endif
            </div>
            {{-- <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
              <label>Password</label>
              <input name="password" type="password" class="form-control" aria-describedby="passwordHelp" placeholder="Password" value="{{ old('password') }}">
              @if ($errors->has('password'))
                <span class="help-block">{{$errors->first('password')}}</span>
              @endif
            </div> --}}                   

        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
            <button type="submit" id="update" class="btn btn-primary">Tambah</button>   
        </div>
        </form>
      </div>
    </div>
  </div>


<!-- Edit Supervisor Modal-->
  <div class="modal fade" id="editSupervisorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{ asset(route('supervisor.update', [], false)) }}" method="POST" id="editform">             
          @csrf
          {{-- {{ method_field('PUT')}} --}}

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Supervisor</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="form-group {{$errors->has('kegiatan_id') ? 'has-error' : ''}}">
              {{-- <label>Kegiatan</label>
              <select name="kegiatan_id" id="kegiatan_id" class="form-control">
                <option disabled value="" {{(old('kegiatan_id') == '') ? 'selected' : ''}}>-- Pilih Kegiatan --</option>
                @foreach($data_kegiatan as $kegiatan)
                  <option value="{{$kegiatan->id}}" {{(Auth::user()->simonas_kegiatan->kegiatan_id == $kegiatan->id) ? 'selected' : 'disabled'}}>{{$kegiatan->nama_keg}}&nbsp;{{$kegiatan->periode}}&nbsp;{{$kegiatan->tahun}}</option>                
                @endforeach
              </select> --}}
              @if ($errors->has('kegiatan_id'))
                <span class="text-danger">{{$errors->first('kegiatan_id')}}</span>
              @endif
            </div>  
            <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
              <label>Nama Lengkap</label>
              <input name="nama" id="nama" type="text" class="form-control" placeholder="Nama Lengkap" value="{{ old('nama') }}">
              @if ($errors->has('nama'))
                <span class="text-danger">{{$errors->first('nama')}}</span>
              @endif
            </div>                                         
            <div class="form-group {{$errors->has('no_hp') ? 'has-error' : ''}}">
              <label>Nomor HP</label>
              <input name="no_hp" id="no_hp" type="text" class="form-control" placeholder="Nomor Handphone" value="{{ old('no_hp') }}">
              @if ($errors->has('no_hp'))
                <span class="text-danger">{{$errors->first('no_hp')}}</span>
              @endif
            </div>              
            <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
              <label>Email</label>
              <input name="email" id="email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="Email" value="{{ old('email') }}">
              @if ($errors->has('email'))
                <span class="text-danger">{{$errors->first('email')}}</span>
              @endif
            </div>                   

        </div>
        <div class="modal-footer">
        	<input type="hidden" name="id" id="id">
            <button type="button" id="btn_batal" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="submit" id="btn_update" class="btn btn-primary">Update</button>   
            <button type="button" id="btn_ok" class="btn btn-primary" type="button" data-dismiss="modal">Ok</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="importSupervisor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form method="post" action="{{ asset(route('supervisor.import_excel', [], false)) }}" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Import Supervisor</h5>
					</div>
					<div class="modal-body">

						{{ csrf_field() }}

						<label>Pilih file excel</label>
						<div class="form-group">
							<input type="file" name="file" required="required">
						</div>
						<div class="form-group">
							<a href="{{ URL::to( '/assets/template/template_supervisor.xls')  }}" target="_blank">download template</a>
						</div>

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

    $(document).ready(function() {

        $('#spvtable').DataTable(); 
		
		//edit data
		$('.edit_spv').on("click",function() {
			
			var id = $(this).attr('data-id');
			
			$.ajax({
				url : "{{route('supervisor.edit')}}?id="+id,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{
					$('#id').val(data.id);
					// $('#kegiatan_id').val(data.kegiatan_id);
					// document.getElementById('kegiatan_id').readOnly = false;
		            $('#nama').val(data.nama);
		            document.getElementById('nama').readOnly = false;
		            $('#no_hp').val(data.no_hp);
		            document.getElementById('no_hp').readOnly = false;
		            $('#email').val(data.email);
		            document.getElementById('email').readOnly = false;

		            document.getElementById('btn_update').hidden = false;
		            document.getElementById('btn_batal').hidden = false;

		            document.getElementById('btn_ok').hidden = true;

					$('#editSupervisorModal').modal('show');
				}				
			});
		});

		//view data
		$('.view_spv').on("click",function() {
			
			var id = $(this).attr('data-id');
			
			$.ajax({
				url : "{{route('supervisor.edit')}}?id="+id,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{
					$('#id').val(data.id);
					// $('#kegiatan_id').val(data.kegiatan_id);
					// document.getElementById('kegiatan_id').readOnly = true;
		            $('#nama').val(data.nama);
		            document.getElementById('nama').readOnly = true;
		            $('#no_hp').val(data.no_hp);
		            document.getElementById('no_hp').readOnly = true;
		            $('#email').val(data.email);
		            document.getElementById('email').readOnly = true;

		            document.getElementById('btn_update').hidden = true;
		            document.getElementById('btn_batal').hidden = true;

		            document.getElementById('btn_ok').hidden = false;

					$('#editSupervisorModal').modal('show');
				}				
			});
		});


	});

    </script>
 @endpush