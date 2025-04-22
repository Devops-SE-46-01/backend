@extends('layouts.admin')

@section('css')
  <link rel="stylesheet" type="text/css" href="{{ url('/css/vendors/animate.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ url('/css/vendors/chartist.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ url('/css/vendors/owlcarousel.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ url('/css/vendors/prism.css') }}" />
@endsection

@section('js')
  <script src="{{ url('/js/chart/chartjs/chart.min.js') }}"></script>
  <script src="{{ url('/js/chart/chartist/chartist.js') }}"></script>
  <script src="{{ url('/js/chart/chartist/chartist-plugin-tooltip.js') }}"></script>
  <script src="{{ url('/js/chart/apex-chart/apex-chart.js') }}"></script>
  <script src="{{ url('/js/chart/apex-chart/stock-prices.js') }}"></script>
  <script src="{{ url('/js/prism/prism.min.js') }}"></script>
  <script src="{{ url('/js/counter/jquery.waypoints.min.js') }}"></script>
  <script src="{{ url('/js/counter/jquery.counterup.min.js') }}"></script>
  <script src="{{ url('/js/counter/counter-custom.js') }}"></script>
  <script src="{{ url('/js/owlcarousel/owl.carousel.js') }}"></script>
  <script src="{{ url('/js/owlcarousel/owl-custom.js') }}"></script>
  <script src="{{ url('/js/dashboard/dashboard_2.js') }}"></script>
  <script src="{{ url('/js/tooltip-init.js') }}"></script>
@endsection

@section('content')
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-12 col-sm-6">
          <h3>
            Dashboard</h3>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid starts-->
  <div class="container-fluid default-dash">
    <div class="row">
      <div class="col-xl-12 col-md-12">
        <div class="card profile-greeting">
          <div class="card-body">
            <div class="media">
              <div class="media-body"> 
                <div class="greeting-user">
                  <h1>Hello, {{ auth()->user()->name }}</h1>
                  <p>Selamat datang di menu dashboard yang penuh keceriaan dan keseruan! Bersiaplah untuk menjelajahi dunia pilihan yang tak terbatas.</p>
                </div>
              </div>
            </div>
            <div class="cartoon-img"><img class="img-fluid" src="{{ url('images/images.svg') }}" alt=""></div>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card">
          <div class="card-body d-flex align-items-center">
            <i class="fa-light fa-user text-primary fa-fw fa-2x"></i>
            <div class="mx-4">
              <h2 class="m-0">{{ $total_admin }}</h2>
              <h5 class="m-0 fw-light">Admin</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card">
          <div class="card-body d-flex align-items-center">
            <i class="fa-light fa-user-group text-success fa-fw fa-2x"></i>
            <div class="mx-4">
              <h2 class="m-0">{{ $total_recruitation }}</h2>
              <h5 class="m-0 fw-light">Member Rekruitasi</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card">
          <div class="card-body d-flex align-items-center">
            <i class="fa-light fa-blog text-info fa-fw fa-2x"></i>
            <div class="mx-4">
              <h2 class="m-0">{{ $total_blog }}</h2>
              <h5 class="m-0 fw-light">Blog</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <div class="card bg-primary">
          <div class="card-body d-flex align-items-center">
            <i class="fa-light fa-chalkboard-user fa-fw fa-2x"></i>
            <div class="mx-4">
              <h2 class="m-0">{{ 23 }}</h2>
              <h5 class="m-0 fw-light">Aslab</h5>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card ongoing-project">
          <div class="card-header card-no-border">
            <div class="media media-dashboard">
              <div class="media-body"> 
                <h5 class="mb-0">Member Rekruitasi</h5>
              </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="table-responsive">
              <table class="table table-bordernone">
                <thead> 
                  <tr> 
                    <th> <span>Member</span></th>
                    <th> <span>Tanggal Daftar</span></th>
                  </tr>
                </thead>
                <tbody> 
                  @forelse ($recruitations as $row)
                    <tr>
                      <td>
                        <div class="media">
                          <div class="square-box me-2">
                            <i class="fa-regular fa-user text-primary"></i>
                          </div>
                          <div class="media-body ps-2">
                            <div class="avatar-details">
                              <a href="product-page.html">
                                <h6>{{ $row->name }}</h6>
                              </a>
                            <span> {{ $row->nim }}</span></div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="badge badge-light-success">{{ date("d F Y", strtotime($row->created_at)) }}</div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="2" class="text-center">Tidak ada data</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card ongoing-project">
          <div class="card-header card-no-border">
            <div class="media media-dashboard">
              <div class="media-body"> 
                <h5 class="mb-0">Member Diterima</h5>
              </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="table-responsive">
              <table class="table table-bordernone">
                <thead> 
                  <tr> 
                    <th> <span>Member</span></th>
                    <th> <span>Tanggal Daftar</span></th>
                  </tr>
                </thead>
                <tbody> 
                  @forelse ($recruitation_accepteds as $row)
                    <tr>
                      <td>
                        <div class="media">
                          <div class="square-box me-2">
                            <i class="fa-regular fa-user text-primary"></i>
                          </div>
                          <div class="media-body ps-2">
                            <div class="avatar-details">
                              <a href="product-page.html">
                                <h6>{{ $row->name }}</h6>
                              </a>
                            <span> {{ $row->nim }}</span></div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="badge badge-light-success">{{ date("d F Y", strtotime($row->created_at)) }}</div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="2" class="text-center">Tidak ada data</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card ongoing-project">
          <div class="card-header card-no-border">
            <div class="media media-dashboard">
              <div class="media-body"> 
                <h5 class="mb-0">Member Pending</h5>
              </div>
            </div>
          </div>
          <div class="card-body pt-0">
            <div class="table-responsive">
              <table class="table table-bordernone">
                <thead> 
                  <tr> 
                    <th> <span>Member</span></th>
                    <th> <span>Tanggal Daftar</span></th>
                  </tr>
                </thead>
                <tbody> 
                  @forelse ($recruitation_declineds as $row)
                    <tr>
                      <td>
                        <div class="media">
                          <div class="square-box me-2">
                            <i class="fa-regular fa-user text-primary"></i>
                          </div>
                          <div class="media-body ps-2">
                            <div class="avatar-details">
                              <a href="product-page.html">
                                <h6>{{ $row->name }}</h6>
                              </a>
                            <span> {{ $row->nim }}</span></div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <div class="badge badge-light-success">{{ date("d F Y", strtotime($row->created_at)) }}</div>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="2" class="text-center">Tidak ada data</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection