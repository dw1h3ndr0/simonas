@extends('layouts.master')

@section('content')

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Petugas</h1>
    <div>
    	<div class="btn-group">
	        <button class="d-none d-sm-inline-block btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	        <i class="fa fa-user-cog fa-lg text-white-50"></i> &nbsp; Kelola
	        </button>
	        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">
	          <a data-toggle="modal" data-target="#importPetugas" class="dropdown-item" href="#"><i class="fas fa-file-import fa-sm fa-fw mr-2 text-gray-400"></i>Import</a>
	          <a class="dropdown-item" href="{{ asset(route('petugas.export_excel', [], false)) }}"><i class="fas fa-file-export fa-sm fa-fw mr-2 text-gray-400"></i>Export</a>
	        </div>
	    </div>    	

	    <a href="#" data-toggle="modal" data-target="#addPetugasModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-user-plus fa-lg text-white-50"></i> &nbsp; Tambah Petugas</a>
    	
    </div>
  </div>

	<div class="container-fluid">

	  <!-- DataTables Petugas -->
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Daftar Petugas</h6>
	    </div>
	    <div class="card-body">
	      <div class="table-responsive">
	        <table class="table table-bordered" id="petugastable" width="100%" cellspacing="0">
	          <thead>
	            <tr>
	              <th>Nama</th>
	              <th>Role</th>
	              <th>Jabatan</th>
	              <th>Nomor HP</th>
	              <th>Email</th>
	              <th class="text-center">Aksi</th>
	            </tr>
	          </thead>
	          <tfoot>
	            <tr>
	              <th>Nama</th>
	              <th>Role</th>
	              <th>Jabatan</th>
	              <th>Nomor HP</th>
	              <th>Email</th>
	              <th class="text-center">Aksi</th>
	            </tr>
	          </tfoot>
	          <tbody>

	          	@foreach($data_petugas as $petugas)
	            <tr>
	              <td>{{ $petugas->nama }}</td>
	              <td>{{ $petugas->role}} </td>
	              <td>{{ $petugas->jabatan}} </td>
	              <td>{{ $petugas->no_hp }}</td>
	              <td>{{ $petugas->email }}</td>
	              <td class="text-center">
	              	<a href="#" class="fa fa-eye view_petugas" data-id="{{$petugas->id}}" title="lihat"></a>
					<a href="#" class="fa fa-edit edit_petugas" data-id="{{$petugas->id}}" title="edit"></a>
					<a href="{{ asset(route('petugas.konfirmasi', ['id'=> $petugas->id], false)) }}" class="fa fa-trash" title="hapus" {{-- onclick="return confirm('Yakin mau dihapus?')" --}}></a>
				  </td>	              
	            </tr>
	            @endforeach

	          </tbody>
	        </table>
	      </div>
	    </div>
	  </div>

	</div>

<!-- Tambah Petugas Modal-->
  <div class="modal fade" id="addPetugasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{ asset(route('petugas.tambah', [], false)) }}" method="POST">             
          @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="form-group {{$errors->has('add_role') ? 'has-error' : ''}}">
              <label>Role</label>
              <select name="add_role" id="add_role" class="form-control">
                <option value="" {{ (old('add_role') == '') ? 'selected' : ''}}>-- Pilih Role --</option>
                <option value="admin" {{(old('add_role') == 'admin') ? 'selected' : ''}}>Admin</option>
                <option value="user" {{(old('add_role') == 'user') ? 'selected' : ''}}>User</option>
              </select>
              @if ($errors->has('add_role'))
                <span class="text-danger">{{$errors->first('add_role')}}</span>
              @endif
            </div>  
            <div class="form-group {{$errors->has('add_nama') ? 'has-error' : ''}}">
              <label>Nama Lengkap</label>
              <input name="add_nama" type="text" class="form-control" placeholder="Nama Lengkap" value="{{ old('add_nama') }}">
              @if ($errors->has('add_nama'))
                <span class="text-danger">{{$errors->first('add_nama')}}</span>
              @endif
            </div>    
            <div class="form-group {{$errors->has('add_jabatan') ? 'has-error' : ''}}">
              <label>Jabatan</label>
              <select name="add_jabatan" id="add_jabatan" class="form-control">
                <option value="" {{ (old('add_jabatan') == '') ? 'selected' : ''}}>-- Pilih Jabatan --</option>
                <option value="organik" {{(old('add_jabatan') == 'organik') ? 'selected' : ''}}>Organik</option>
                <option value="mitra" {{(old('add_jabatan') == 'mitra') ? 'selected' : ''}}>Mitra</option>
              </select>
              @if ($errors->has('add_jabatan'))
                <span class="text-danger">{{$errors->first('add_jabatan')}}</span>
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
            <button type="submit" id="update" class="btn btn-primary"><i class="fa fa-check-circle"></i> Tambah</button>   
        </div>
        </form>
      </div>
    </div>
  </div>


<!-- Edit Petugas Modal-->
  <div class="modal fade" id="editPetugasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="{{ asset(route('petugas.update', [], false)) }}" method="POST" id="editform">             
          @csrf
          {{-- {{ method_field('PUT')}} --}}

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Petugas</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">

            <div class="form-group {{$errors->has('role') ? 'has-error' : ''}}">
              <label>Role</label>
              <select name="role" id="role" class="form-control">
                <option value="" {{ (old('role') == '') ? 'selected' : ''}}>-- Pilih Role --</option>
                <option value="admin" {{(old('role') == 'admin') ? 'selected' : ''}}>Admin</option>
                <option value="user" {{(old('role') == 'user') ? 'selected' : ''}}>User</option>
              </select>
              @if ($errors->has('role'))
                <span class="text-danger">{{$errors->first('role')}}</span>
              @endif
            </div>    
            <div class="form-group {{$errors->has('nama') ? 'has-error' : ''}}">
              <label>Nama Lengkap</label>
              <input name="nama" id="nama" type="text" class="form-control" placeholder="Nama Lengkap" value="{{ old('nama') }}">
              @if ($errors->has('nama'))
                <span class="text-danger">{{$errors->first('nama')}}</span>
              @endif
            </div>   
            <div class="form-group {{$errors->has('jabatan') ? 'has-error' : ''}}">
              <label>Jabatan</label>
              <select name="jabatan" id="jabatan" class="form-control">
                <option value="" {{ (old('jabatan') == '') ? 'selected' : ''}}>-- Pilih Jabatan --</option>
                <option value="organik" {{(old('jabatan') == 'organik') ? 'selected' : ''}}>Organik</option>
                <option value="mitra" {{(old('jabatan') == 'mitra') ? 'selected' : ''}}>Mitra</option>
              </select>
              @if ($errors->has('jabatan'))
                <span class="text-danger">{{$errors->first('jabatan')}}</span>
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
            <button type="submit" id="btn_update" class="btn btn-primary"><i class="fa fa-check-circle"></i> Update</button>   
            <button type="button" id="btn_ok" class="btn btn-primary" type="button" data-dismiss="modal">Ok</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="importPetugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form method="post" action="{{ asset(route('petugas.import_excel', [], false)) }}" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Import Petugas</h5>
					</div>
					<div class="modal-body">

						{{ csrf_field() }}

						<label>Pilih file excel</label>
						<div class="form-group">
							<input type="file" name="file" required="required">
						</div>
						<div class="form-group">
							<a href="{{ URL::to( '/assets/template/template_petugas.xls')  }}" target="_blank">download template</a>
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

    $(document).ready(function() {

        $('#petugastable').DataTable(); 
		
		//edit data
		$(document).on('click', '.edit_petugas', function(e) {
		// $('.edit_petugas').on("click",function() {
			
			var id = $(this).attr('data-id');
			
			$.ajax({
				url : "{{route('petugas.edit')}}?id="+id,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{
					$('#id').val(data.id);
					$('#role').val(data.role);
					document.getElementById('role').readOnly = false;
		            $('#nama').val(data.nama);
		            document.getElementById('nama').readOnly = false;
		            $('#jabatan').val(data.jabatan);
					document.getElementById('jabatan').readOnly = false;
		            $('#no_hp').val(data.no_hp);
		            document.getElementById('no_hp').readOnly = false;
		            $('#email').val(data.email);
		            document.getElementById('email').readOnly = false;

		            document.getElementById('btn_update').hidden = false;
		            document.getElementById('btn_batal').hidden = false;

		            document.getElementById('btn_ok').hidden = true;

					$('#editPetugasModal').modal('show');
				}				
			});
		});

		//view data
		$(document).on('click', '.view_petugas', function(e) {
		// $('.view_petugas').on("click",function() {
			
			var id = $(this).attr('data-id');
			
			$.ajax({
				url : "{{route('petugas.edit')}}?id="+id,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{
					$('#id').val(data.id);
					$('#role').val(data.role);
					document.getElementById('role').readOnly = true;
		            $('#nama').val(data.nama);
		            document.getElementById('nama').readOnly = true;
					$('#jabatan').val(data.jabatan);
					document.getElementById('jabatan').readOnly = true;
		            $('#no_hp').val(data.no_hp);
		            document.getElementById('no_hp').readOnly = true;
		            $('#email').val(data.email);
		            document.getElementById('email').readOnly = true;

		            document.getElementById('btn_update').hidden = true;
		            document.getElementById('btn_batal').hidden = true;

		            document.getElementById('btn_ok').hidden = false;

					$('#editPetugasModal').modal('show');
				}				
			});
		});


	});

    </script>
 @endpush