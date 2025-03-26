@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ url('/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/vendors/owlcarousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/vendors/rating.css') }}">
@endsection

@section('js')
    <script src="{{ url('/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('/js/rating/jquery.barrating.js') }}"></script>
    <script src="{{ url('/js/rating/rating-script.js') }}"></script>
    <script src="{{ url('/js/owlcarousel/owl.carousel.js') }}"></script>
    <script src="{{ url('/js/ecommerce.js') }}"></script>
    <script src="{{ url('/js/product-list-custom.js') }}"></script>

    <script>
        const url = 'recruitations';

        function handleUpdate(id) {
            $('#delete-form').attr('action', `{{ url('${url}/${id}') }}`);
            $('#delete-modal').modal('show');
        }
    </script>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="d-flex justify-content-between">
                <div class="">
                    <h3>Recruitations list</h3>
                </div>
                <div class="">
                    <a class="btn btn-primary" href="{{ route('recruitations.export') }}">Export To Excel</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid list-categories">
        <div class="row">
            <!-- Individual column searching (text inputs) Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5>Recruitations </h5>
                        <span>Selamat datang di Recruitation Center! Admin dapat dengan mudah menerima atau menolak calon
                            member yang mendaftar. Lihat daftar calon member dan ambil keputusan dengan cepat dan efisien.
                            Bangun tim yang kuat dengan kemudahan di ujung jari Anda!.</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive product-table">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>NIM</th>
                                        <th>Jurusan</th>
                                        <th>Divisi</th>
                                        <th>No Whatsapp</th>
                                        <th>Created At</th>
                                        <th>Resource</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($recruitations as $row)
                                        <tr>
                                            <td class="text-start">{{ $loop->iteration }}</td>
                                            <td class="text-start">{{ $row->name }}</td>
                                            <td class="text-start">{{ $row->nim }}</td>
                                            <td class="text-start">{{ $row->major . ' / ' . $row->generation }}</td>
                                            <td class="text-start">{{ $row->division }}</td>
                                            <td class="text-start"><a href="https://wa.me/+62{{ $row->whatsapp }}"
                                                    target="_blank">{{ $row->whatsapp }}</a></td>
                                            <td>{{ date('d F Y', strtotime($row->created_at)) }}</td>
                                            <td>
                                                <a class="btn btn-info btn-xs my-1" type="button" target="_blank"
                                                    href="{{ $row->cv }}">CV</a>
                                                @if ($row->portofolio)
                                                    <a class="btn btn-info btn-xs my-1" type="button" target="_blank"
                                                        href="{{ $row->portofolio }}">Portfolio</a>
                                                @endif
                                                <a class="btn btn-info btn-xs my-1" type="button" target="_blank"
                                                    href="{{ $row->motivation_letter }}">Motivation Video</a>
                                                <a class="btn btn-info btn-xs my-1" type="button" target="_blank"
                                                    href="{{ $row->ksm }}">KSM</a>
                                                <a class="btn btn-warning btn-xs my-1" type="button" target="_blank"
                                                    href="{{ $row->share_poster }}">Share Poster</a>
                                                <a class="btn btn-warning btn-xs my-1" type="button" target="_blank"
                                                    href="{{ $row->yt_evidence }}">Youtube</a>
                                                <a class="btn btn-warning btn-xs my-1" type="button" target="_blank"
                                                    href="{{ $row->instagram_evidence }}">Instagram</a>
                                                <a class="btn btn-warning btn-xs my-1" type="button" target="_blank"
                                                    href="{{ $row->line_evidence }}">Line</a>
                                                <a class="btn btn-warning btn-xs my-1" type="button" target="_blank"
                                                    href="{{ $row->linkedin_evidence }}">Linkedin</a>
                                                <a class="btn btn-warning btn-xs my-1" type="button" target="_blank"
                                                    href="{{ $row->twibbon_evidence }}">Twibbon</a>
                                            </td>
                                            <td>
                                                @if ($row->is_accepted == 0)
                                                    <button class="btn btn-info btn-xs" type="button"
                                                        data-original-title="btn btn-primary btn-xs" title=""
                                                        onclick="handleUpdate({{ $row->id }})" data-bs-toggle="modal"
                                                        data-bs-target="#delete-modal"><i
                                                            class="fas fa-check"></i>Wawancara</button>
                                                @elseif($row->is_accepted == 1)
                                                    <button class="btn btn-danger btn-xs" type="button"
                                                        data-original-title="btn btn-danger btn-xs" title=""
                                                        onclick="handleUpdate({{ $row->id }})" data-bs-toggle="modal"
                                                        data-bs-target="#delete-modal"><i
                                                            class="fas fa-user"></i>Intern</button>
                                                @elseif($row->is_accepted == 2)
                                                    <button class="btn btn-success btn-xs" type="button"
                                                        data-original-title="btn btn-danger btn-xs" title=""
                                                        onclick="handleUpdate({{ $row->id }})" data-bs-toggle="modal"
                                                        data-bs-target="#delete-modal"><i
                                                            class="fas fa-user"></i>Terima</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Individual column searching (text inputs) Ends-->
    <!-- Container-fluid Ends-->

    <!-- Delete Modal -->
    <form action="" method="POST" id="delete-form">
        @csrf
        @method('PUT')
        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="exampleModalLabel">Apakah anda yakin?</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Ingin meluluskan mahasiswa ini pada tahap seleksi berkas ke tahap selanjutnya.
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Konfirmasi</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
