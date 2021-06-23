@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Karyawan</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Karyawan</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Tambah</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">
            <div class="customize-input float-right">

            </div>
        </div>
    </div>
@endsection

@section('page-wrapper')


    @include('main.components.message')


    <div class="card border-success">
        <div class="card-header bg-success">
            <h4 class="mb-0 text-white">Tambah Karyawan Perusahaan</h4>
        </div>
        <div class="card-body">
            <h3 class="card-title">Tambah Karyawan Perusahaan</h3>


            <hr>

            <form action="{{ url('karyawan/tambah') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="">Nomor Induk Karyawan</label>
                    <input type="text" class="form-control" required name="nik" placeholder="Nomor Induk Karyawan">
                    <small class="form-text text-muted">Nomor Induk Karyawan</small>
                </div>

                <div class="form-group">
                    <label for="">Nama Karyawan</label>
                    <input type="text" class="form-control" required name="nama" placeholder="Nama Karyawan">
                    <small class="form-text text-muted">Nama Karyawan</small>
                </div>

                <div class="form-group">
                    <label for="">Email Karyawan</label>
                    <input type="email" class="form-control" required name="email" placeholder="Email Karyawan">
                    <small class="form-text text-muted">Email Karyawan (Digunakan Untuk Login)</small>
                </div>

                <div class="form-group">
                    <label for="">Kontak Karyawan</label>
                    <input type="text" class="form-control" required name="kontak" placeholder="Kontak Karyawan">
                    <small class="form-text text-muted">Kontak Karyawan</small>
                </div>

                <div class="form-group">
                    <label for="">Password Karyawan</label>
                    <input type="text" class="form-control" required name="password" placeholder="Password Karyawan">
                    <small class="form-text text-muted">Password Karyawan (Digunakan Untuk Login)</small>
                </div>

                <div class="form-group">
                    <label for="">Usia Karyawan</label>
                    <input type="text" class="form-control" required name="usia" placeholder="Usia Karyawan">
                    <small class="form-text text-muted">Usia Karyawan</small>
                </div>

                <div class="form-group">
                    <label for="">Role / Jabatan / Peran</label>
                    <select required class="form-control" name="role" id="">
                        <option>Pilih Role</option>
                        <option value="2">Karyawan</option>
                        <option value="1">Admin</option>
                        <option value="3">Pemilik</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Alamat Karyawan</label>
                    <textarea class="form-control" name="alamat" id="" rows="3" placeholder="Alamat Karyawan"></textarea>
                </div>

                <button type="submit" class="btn btn-block btn-primary">Tambahkan Data Karyawan</button>
            </form>
        </div>
    </div>





@endsection


@section('app-script')
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.3/r-2.2.7/sb-1.0.1/sp-1.2.2/datatables.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js">
    </script>




    <script type="text/javascript">
        $(function() {
            var table = $('#table_santri').DataTable({
                processing: true,
                serverSide: true,
                columnDefs: [{
                    orderable: true,
                    targets: 0
                }],
                dom: 'T<"clear">lfrtip<"bottom"B>',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                buttons: [
                    'copyHtml5',
                    {
                        extend: 'excelHtml5',
                        title: 'Data Santri Export {{ \Carbon\Carbon::now()->year }}'
                    },
                    'csvHtml5',
                ],
                ajax: {
                    type: "get",
                    url: "{{ url('admin/data/santri/manage') }}",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    async: true,
                    error: function(xhr, error, code) {
                        var err = eval("(" + xhr.responseText + ")");
                        console.log(err);
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'nis',
                        name: 'nis'
                    },
                    {
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'kelas',
                        name: 'kelas'
                    },
                    {
                        data: 'asrama',
                        name: 'asrama'
                    },
                    {
                        data: 'jenjang',
                        name: 'jenjang'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },

                ]
            });


            $('body').on("click", ".btn-add-new", function() {
                var id = $(this).attr("id")
                $(".btn-destroy").attr("id", id)
                $("#insert-modal").modal("show")
            });


            // Edit & Update
            $('body').on("click", ".btn-edit", function() {
                var id = $(this).attr("id")
                $.ajax({
                    url: "{{ URL::to('/') }}/mutabaah/" + id + "/fetch",
                    method: "GET",
                    success: function(response) {
                        $("#edit-modal").modal("show")
                        console.log(response)
                        $("#id").val(response.id)
                        $("#name").val(response.judul)
                        $("#edit_date").val(response.tanggal)
                        $("#role").val(response.role)
                    }
                })
            });

            // Reset Password
            $('body').on("click", ".btn-res-pass", function() {
                var id = $(this).attr("id")
                $(".btn-reset").attr("id", id)
                $("#reset-password-modal").modal("show")
            });

        });
    </script>




@endsection
