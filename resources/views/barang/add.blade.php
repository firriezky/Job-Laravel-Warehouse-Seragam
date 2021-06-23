@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Barang</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Barang</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Tambah Barang</li>
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


    <div class="card border-primary">
        <div class="card-header bg-primary">
            <h4 class="mb-0 text-white">Tambah Data Barang</h4>
        </div>
        <div class="card-body">
            <h3 class="card-title">Tambah Data Barang</h3>

            <hr>

            <form action="{{ url('barang/tambah') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="">Nama / Merk / Kode Barang</label>
                    <input type="text" class="form-control" required name="nama" placeholder="Kode Barang">
                    <small class="form-text text-muted">Nama, Merk atau Kode Barang</small>
                </div>
     
                <div class="form-group">
                    <label for="">Ukuran Barang (Size)</label>
                    <input type="text" class="form-control" required name="ukuran" placeholder="Ukuran ( Misal 45 atau 32 )">
                    <small class="form-text text-muted">Ukuran Barang, gunakan satuan angka</small>
                </div>

                <div class="form-group">
                    <label for="">Jumlah Barang</label>
                    <input type="text" class="form-control" type="number" required name="stok" placeholder="Stok Awal Barang">
                    <small class="form-text text-muted">Jumlah Barang</small>
                </div>

                <div class="form-group">
                    <label for="">Jenis</label>
                    <select required class="form-control" name="type" id="">
                        <option>Jenis Barang</option>
                        <option value="Putih Panjang">Putih Panjang</option>
                        <option value="Pramuka">Pramuka</option>
                        <option value="Rok SD">Rok SD</option>
                        <option value="Putih Pendek">Putih Pendek</option>
                        <option value="Rok SMP">Rok SMP</option>
                        <option value="Celana Biru">Celana Biru</option>
                        <option value="Celana Hitam">Celana Hitam</option>
                        <option value="Celana Putih">Celana Putih</option>
                        <option value="Celana Abu">Celana Abu</option>
                        <option value="Atasan SMP">Atasan SMP</option>
                        <option value="Atasan SMA">Atasan SMA</option>
                        <option value="Atasan SD">Atasan SD</option>
                        <option value="Rok SMA">Rok SMA</option>
                        <option value="Topi SD">Topi SD</option>
                        <option value="Topi SMP">Topi SMP</option>
                        <option value="Topi SMA">Topi SMA</option>
                        <option value="Topi SMK">Topi SMK</option>
                        <option value="Batik SD">Batik SD</option>
                        <option value="Batik SMP">Batik SMP</option>
                        <option value="Batik SMA">Batik SMA</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-block btn-primary">Tambah Data Barang</button>
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
