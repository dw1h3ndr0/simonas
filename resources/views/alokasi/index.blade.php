@extends('layouts.master')

@section('content')

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Alokasi Petugas</h1>
    <div>
    	<div class="btn-group">
	        <button class="d-none d-sm-inline-block btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	        <i class="fa fa-user-cog fa-lg text-white-50"></i> &nbsp; Kelola
	        </button>
	        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">
	          <a data-toggle="modal" data-target="#importPetugas" class="dropdown-item" href="#"><i class="fas fa-file-import fa-sm fa-fw mr-2 text-gray-400"></i>Import</a>
	          <a class="dropdown-item" href="{{ asset(route('alokasi.export_excel', [], false)) }}"><i class="fas fa-file-export fa-sm fa-fw mr-2 text-gray-400"></i>Export</a>
	        </div>
	    </div>    	

	    <a href="{{ asset(route('alokasi.tambah', [], false)) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fa fa-user-plus fa-lg text-white-50"></i> &nbsp; Input Alokasi Petugas</a>
    	
    </div>
  </div>

	<div class="container-fluid">

	  <!-- DataTables Alokasi -->
	  <div class="card shadow mb-4">
	    <div class="card-header py-3">
	      <h6 class="m-0 font-weight-bold text-primary">Alokasi Petugas</h6>
	    </div>
	    <div class="card-body">
	      <div class="table-responsive">
	        <table class="table table-bordered" id="alokasitable" width="100%" cellspacing="0">
	          <thead>
	            <tr>
	              <th>Kegiatan</th>
	              <th>NKS</th>
	              <th>Petugas</th>
	              <th>Jabatan</th>
	              <th>Status</th>
	              <th>Kode Petugas</th>
	              <th>Pengawas</th>
	              <th class="text-center">Aksi</th>
	            </tr>
	          </thead>
	          <tfoot>
	            <tr>
	              <th>Kegiatan</th>
	              <th>NKS</th>
	              <th>Petugas</th>
	              <th>Jabatan</th>
	              <th>Status</th>
	              <th>Kode Petugas</th>
	              <th>Pengawas</th>
	              <th class="text-center">Aksi</th>
	            </tr>
	          </tfoot>
	          <tbody>

	          	@foreach($data_alokasi as $alokasi)
	            <tr>
	              <td>{{ $alokasi->nama_keg }}&nbsp;{{$alokasi->periode}}&nbsp;{{$alokasi->tahun}}</td>
	              <td>{{ $alokasi->nks }}</td>
	              <td>{{ $alokasi->namaPetugas }} </td>
	              <td>{{ $alokasi->jabatan }} </td>
	              <td>{{ $alokasi->status }}</td>
	              <td>{{ $alokasi->kode }}</td>
	              <td>{{ $alokasi->namaLeader }}</td>
	              <td class="text-center">
	              	<a href="{{ asset(route('alokasi.lihat', ['id'=> $alokasi->id], false)) }}" class="fa fa-eye" title="lihat"></a>
					<a href="{{ asset(route('alokasi.edit', ['id'=> $alokasi->id], false)) }}" class="fa fa-edit" title="edit"></a>
					<a href="{{ asset(route('alokasi.konfirmasi', ['id'=> $alokasi->id], false)) }}" class="fa fa-trash" title="hapus" {{-- onclick="return confirm('Yakin mau dihapus?')" --}}></a>
				  </td>	              
	            </tr>
	            @endforeach

	          </tbody>
	        </table>
	      </div>
	    </div>
	  </div>

	</div>

  <div class="modal fade" id="importPetugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form method="post" action="{{ asset(route('alokasi.import_excel', [], false)) }}" enctype="multipart/form-data">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Import Alokasi Petugas</h5>
					</div>
					<div class="modal-body">

						{{ csrf_field() }}

						<label>Pilih file excel</label>
						<div class="form-group">
							<input type="file" name="file" required="required">
						</div>
						<div class="form-group">
							<a href="{{ URL::to( '/assets/template/template_alokasi.xls')  }}" target="_blank">download template</a>
						</div>
						<div class="form-group">
							<a href="{{ asset(route('alokasi.export_petugas', [], false)) }}" target="_blank">download daftar petugas</a>
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

        $('#alokasitable').DataTable(); 				

	});

    </script>
 @endpush