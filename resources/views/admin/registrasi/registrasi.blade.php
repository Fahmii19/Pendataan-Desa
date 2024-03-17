@extends('layouts.template_admin')
@section('content')

@php
$Roles = '';
@endphp

<style>
    .dataTables_length {
        display: none;
    }

    .dataTables_filter {
        display: none;
    }


    /* custom datatables */

    #table-regis_length {
        margin-bottom: 0.5rem !important;
        margin-left: 1.3% !important;
    }

    #table-regis_filter {
        margin-right: 2.2% !important;
    }

    #table-regis_info {
        margin-left: 1.5% !important;
        margin-top: 0.6% !important;
    }

    #table-regis_paginate {
        margin-right: 1.4% !important;
        margin-top: 1.5% !important;
    }


    table.dataTable>thead>tr>th:not(.sorting_disabled),
    table.dataTable>thead>tr>td:not(.sorting_disabled) {
        padding-right: 10px !important;
    }

    /* proses */
    /* #table-regis_processing {
        top: 5px !important;
    } */
</style>

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">

                    <div style="display: none;" class="lazy_name_kinerja">
                        Registrasi
                    </div>

                    <div class="hide_lazyload_kinerja">
                        <div style="width: 11.1rem; height:1.8rem; border-radius:2px position: relative;"
                            class="skeleton-image"></div>
                    </div>


                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-12 col-md-auto ms-auto d-print-none">
                <div class="btn-list">

                    <div style="display: none;" class="lazy_name_kinerja">
                        <button class="btn btn-primary d-none d-sm-inline-block" onclick="create()">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            Tambah User
                        </button>
                    </div>

                    <div class="hide_lazyload_kinerja">
                        <div style="width: 11.1rem; height:1.8rem; border-radius:2px position: relative;"
                            class="skeleton-image"></div>
                    </div>

                    {{-- <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                        data-bs-target="#modal-report" aria-label="Create new report">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- modal add --}}
    <form action="{{ route('add-register') }}" method="POST">
        @csrf
        <div class="modal modal-blur fade" id="modalAddUsers" tabindex="-1" role="dialog" aria-hidden="true"
            aria-labelledby="modalEditAddLabel">

            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditAddLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="add_page">
                            <div class="row">
                                <div class="col-md-12 col-xl-12">

                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="Masukan Nama User">

                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">E-mail</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Masukan Email User">

                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Masukan Password User">

                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Kegiatan</label>
                                        <select class="form-control" name="kegiatan[]" id="kegiatan" multiple>
                                            @foreach ($kegiatan as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Role</label>
                                        <select class="form-control" name="role" required>
                                            <option>Pilih Role</option>
                                            @foreach ($role as $r)
                                            <option value="{{ $r->name }}">{{ $r->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-label">Penempatan</div>
                                        <input class="form-control" name="penempatan" required
                                            placeholder="Wilayah Penempatan">
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-label">Jabatan</div>
                                        <input class="form-control" name="jabatan" required
                                            placeholder="Masukan Jabatan">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Status Pegawai</label>
                                        <select class="form-control" name="id_status_pegawai" required>
                                            <option>Pilih Status Pegawai</option>
                                            @foreach ($status_pegawai as $s)
                                            <option value="{{ $s->id }}">{{ $s->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-label">Sektor</div>
                                        <select class="form-control" name="sektor[]" id="sektor_list" multiple>
                                            @foreach($sektor as $s)
                                            <optgroup label="{{ $s->name }}">
                                                @foreach ($s->chanel as $c)
                                                <option value="{{ base64_encode($c->id) }}">{{ $c->name }}</option>
                                                @endforeach

                                            </optgroup>
                                            @endforeach
                                        </select>
                                        {{-- <select class="form-control" name="sektor[]" id="sektor_list" multiple>
                                            @foreach ($sektor as $s)
                                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                                            @endforeach
                                        </select> --}}

                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Izin Login</label>
                                        <select class="form-control" name="allowed" required>
                                            <option value="1">Ya</option>
                                            <option value="0">Tidak</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn me-auto btn-primary" onclick="add_modal()">Kirim</button>
                        <button type="button" class="btn" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>


            </div>
        </div>
    </form>


    {{-- modal update --}}
    <form action="{{ route('update-register') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal modal-blur fade" id="modalEditUsers" tabindex="-1" role="dialog" aria-hidden="true"
            aria-labelledby="modalEditUserLabel">
            {{-- <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditUserLabel">Edit Pegawai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-xl-12">

                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="hidden" class="form-control" name="id" id="idUser">
                                    <input type="text" class="form-control" name="name" id="namaUser"
                                        placeholder="Masukan Nama User">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">E-mail</label>
                                    <input class="form-control" name="email" type="email"
                                        placeholder="Masukan Email User" id="emailUser">
                                </div>

                                <div class="mb-3">
                                    <div class="form-label">Penempatan</div>
                                    <select class="form-select" name="penempatan" required>

                                        <option id="penempatanUser"></option>

                                        @foreach ($kecamatan as $kec)
                                        <option value="{{ $kec }}">{{ $kec }}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn me-auto btn-primary" data-bs-dismiss="modal">Kirim</button>
                        <button type="button" class="btn" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>


            </div> --}}
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditAddLabel">Edit Data User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="add_page">
                            <div class="row">
                                <div class="col-md-12 col-xl-12">

                                    <div class="mb-3">
                                        <label class="form-label">Nama</label>
                                        <input type="hidden" class="form-control" name="id" id="idUser">
                                        <input type="text" class="form-control" name="name" id="nameUser"
                                            placeholder="Masukan Nama User">

                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">E-mail</label>
                                        <input type="email" class="form-control" name="email" id="emailUser"
                                            placeholder="Masukan Email User">

                                    </div>

                                    {{-- <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Masukan Password User">

                                    </div> --}}

                                    <div class="mb-3">
                                        <label class="form-label">Kegiatan</label>
                                        <select class="form-control" name="kegiatan[]" id="kegiatanEdit" multiple>
                                            @foreach ($kegiatan as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Role</label>
                                        <select class="form-control" name="role" id="roleUser" required>
                                            <option>Pilih Role</option>
                                            @foreach ($role as $r)
                                            <option value="{{ $r->name }}">{{ $r->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-label">Penempatan</div>
                                        <input class="form-control" name="penempatan" id="penempatanUser" required
                                            placeholder="Wilayah Penempatan">
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-label">Jabatan</div>
                                        <input class="form-control" name="jabatan" id="jabatanUser" required
                                            placeholder="Masukan Jabatan">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Status Pegawai</label>
                                        <select class="form-control" name="id_status_pegawai" id="statusPegawaiUser"
                                            required>
                                            <option>Pilih Status Pegawai</option>
                                            @foreach ($status_pegawai as $s)
                                            <option value="{{ $s->id }}">{{ $s->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-label">Sektor</div>
                                        <select class="form-cotrol" name="sektor[]" id="sektor_list_edit" multiple>
                                            @foreach($sektor as $s)
                                            <optgroup label="{{ $s->name }}">
                                                @foreach ($s->chanel as $c)
                                                <option value="{{ base64_encode($c->id) }}">{{ $c->name }}</option>
                                                @endforeach

                                            </optgroup>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Izin Login</label>
                                        <select class="form-control" name="allowed" id="allowedUser" required>
                                            <option value="1">Ya</option>
                                            <option value="0">Tidak</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn me-auto btn-primary">Kirim</button>
                        <button type="button" class="btn" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>


            </div>

        </div>
    </form>


</div>

<div class="page-body">
    <div class="container-xl">
        <!-- konten disini -->

        <div class="row row-cards">
            <div class="col-md-12 col-xl-12">
                <div class="card">
                    <div class="card-status-top bg-primary"></div>
                    <div class="card-header">
                        <h3 class="card-title" style="font-size:14px; font-weight:400; letter-spacing:0.5px;">
                            <div style="display: none;" class="lazy_name_kinerja">
                                Daftar User
                            </div>
                            <div class="hide_lazyload_kinerja">
                                <div style="width: 10rem; height:1.8rem; border-radius:2px position: relative;"
                                    class="skeleton-image"></div>
                            </div>
                        </h3>
                    </div>



                    <div class="card-body px-0">
                        <div style="overflow-x: hidden !important;" class="table-responsive">
                            <table class="display table table-striped" id="table-regis" style="width: 100%">
                                <thead class="text-center">
                                    <tr>

                                        <th>
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Nama
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th>
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                E-mail
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th>
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Role
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th>
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Jabatan
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th>
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Penempatan
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                        <th>
                                            <div style="display: none;" class="lazy_name_kinerja">
                                                Aksi
                                            </div>

                                            <div class="hide_lazyload_kinerja">
                                                <div class='skeleton-line'></div>
                                            </div>
                                        </th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    @php
                                    for ($x = 0; $x <= 9; $x++) { echo"<tr class='hide_lazyload_kinerja'>
                                        <td>
                                            <div class='skeleton-line'></div>
                                        </td>
                                        <td>
                                            <div class='skeleton-line'></div>
                                        </td>
                                        <td>
                                            <div class='skeleton-line'></div>
                                        </td>
                                        <td>
                                            <div class='skeleton-line'></div>
                                        </td>
                                        <td>
                                            <div class='skeleton-line'></div>
                                        </td>
                                        <td>
                                            <div class='skeleton-line'></div>
                                        </td>
                                        </tr>";
                                        }
                                        @endphp

                                </tfoot>
                                </tbody>
                            </table>
                        </div>
                    </div>



                </div>
            </div>
        </div>

    </div>
</div>


<script>
    // tampil modal add
    function create() {
        $.get("{{ url('dashboard/register') }}", {}, function(data, status) {
            $("#modalEditAddLabel").html('Tambah User');

            $("#add_page").html(data);

            $("#modalAddUsers").modal('show');

        });
    }

    // proses modal add
    function add_modal() {
        var name = $("#name").val();
        $.ajax({
            type: "post"
            , url: "{{ url('dashboard/register') }}"
            , dataType: 'json'
                // , data: "name" + name
            , success: function(data) {
                $(".btn-close").click();
            }
        , });
    }



    // $(document).ready(function() {

    //     var table = $('.data-pegawai').DataTable({

    //         "drawCallback": function(settings) {
    //             $(".hide_lazyload_kinerja").hide();
    //             $(".lazy_name_kinerja").show();
    //             $(".dataTables_length").show();
    //             $(".dataTables_filter").show();
    //         },

    //         ordering: false
    //         , order: [
    //             [4, "asc"]
    //         ]
    //         , processing: false
    //         , serverSide: true
    //         , "deferRender": true
    //             // , "language": {
    //             //     processing: '<div class="loader_lazy_load"></div>'
    //             // }
    //         , ajax: "{{ url('/dashboard/register') }}"

    //         , columns: [{
    //                 data: 'name'
    //                 , name: 'name'
    //             }
    //             , {
    //                 data: 'email'
    //                 , name: 'email'
    //             },

    //             {
    //                 data: 'roles'
    //                 , name: 'roles'
    //             },

    //             {
    //                 data: 'jabatan'
    //                 , name: 'jabatan'
    //             },

    //             {
    //                 data: 'penempatan'
    //                 , name: 'penempatan'
    //             },

    //             {
    //                 data: 'aksi'
    //                 , name: 'aksi'
    //             }
    //         , ]
    //         , columnDefs: [{
    //                 orderSequence: ["asc", "desc"]
    //                 , targets: [0]
    //             , }
    //             , {
    //                 orderSequence: ["asc", "desc"]
    //                 , targets: [1]
    //             , }
    //             , {
    //                 orderSequence: ["asc", "desc"]
    //                 , targets: [2]
    //                 , className: "text-center"
    //             , }
    //             , {
    //                 orderSequence: ["asc", "desc"]
    //                 , targets: [3]

    //             , }
    //             , {
    //                 orderSequence: ["asc", "desc"]
    //                 , targets: [4]

    //             , }

    //             , {
    //                 width: "17%"
    //                 , targets: [5]
    //             }
    //         , ]
    //     , });

    // });

</script>


<script type="text/javascript">
    $(document).ready(function(){
            $('#table-regis').DataTable({
                processing: true,
                serverSide: true,

                "drawCallback": function(settings) {
                $(".hide_lazyload_kinerja").hide();
                $(".lazy_name_kinerja").show();
                $(".dataTables_length").show();
                $(".dataTables_filter").show();
                },

                ordering: true
                , language: {
                        search: "Pencarian:",
                        processing: '<i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span>'
                    , }
                , order: [
                [0, "asc"]
                ],


                ajax: "{{ url('/dashboard/user-register') }}",
                columns: [
                {
                data: 'name'
                , name: 'name'
                }
                , {
                data: 'email'
                , name: 'email'
                },

                {
                data: 'roles.[0].name'
                , name: 'roles.[0].name'
                },

                {
                data: 'jabatan'
                , name: 'jabatan'
                },

                {
                data: 'penempatan'
                , name: 'penempatan'
                },

                {
                data: 'aksi'
                , name: 'aksi'
                },
                ],
                columnDefs: [{
                orderSequence: ["asc", "desc"]
                ,width: "14%"
                , targets: [0]
                , }
                , {
                orderSequence: ["asc", "desc"]
                ,width: "14%"
                , targets: [1]
                , }
                , {
                orderSequence: ["asc", "desc"]
                ,width: "14%"
                , targets: [2]
                , className: "text-center"
                , }
                , {
                orderSequence: ["asc", "desc"]
                ,width: "14%"
                , targets: [3]
                , }
                , {
                orderSequence: ["asc", "desc"]
                ,width: "17%"
                , targets: [4]
                , }

                , {
                width: "14%"
                , targets: [5]
                }

                , ]
                ,
            });
        })
</script>

@endsection