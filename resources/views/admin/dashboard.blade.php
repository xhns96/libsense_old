@extends('layouts.admin')
@section('title', 'Statistika')

@section('headerStyles')
    @parent
    <link rel="stylesheet" href="{{asset('css/DataTable/bootstrapTable.css')}}">
@endsection

@section('content')
    <!-- *************************************************************** -->
    <!-- Start First Cards -->
    <!-- *************************************************************** -->
    <div class="card-group">
        <div class="card border-right">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <div class="d-inline-flex align-items-center">
                            <h3 class="text-dark mb-1 font-weight-medium"><span class="text-orange">{{$bookNameCount}}</span> | <span class="text-cyan">{{$bookCopyCount}}</span> | <span class="text-danger">{{$bookTMCount}}</span></h3>
                            <span
                                class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">{{$tmPercentage}}%</span>
                        </div>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Adabiyotlar: <span class="text-orange">Nomda</span> | <span class="text-cyan">Sonda</span> | <span class="text-danger">To'liq matni</span></h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="book-open"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-right">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">{{$allEbooksCount}}</h2>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Elektron adabiyotlar soni:
                        </h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="download-cloud"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card border-right">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <div class="d-inline-flex align-items-center">
                            <h2 class="text-dark mb-1 font-weight-medium">0</h2>
{{--                            <span class="badge bg-success font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block">--}}{{-- + kunlik buyurtma soni --}}{{--</span>--}}
                        </div>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Buyurtmalar soni</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="shopping-cart"></i></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="d-flex d-lg-flex d-md-block align-items-center">
                    <div>
                        <h2 class="text-dark mb-1 font-weight-medium">{{$usersCount}}</h2>
                        <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Kitobxonlar soni</h6>
                    </div>
                    <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted"><i data-feather="users"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- *************************************************************** -->
    <!-- End First Cards -->
    <!-- *************************************************************** -->
    <!-- *************************************************************** -->
    <!-- Start Sales Charts Section -->
    <!-- *************************************************************** -->
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Adabiyotlarni til bo'yicha taqsimlanishi:</h4>
                    <div id="campaign-v2" class="mt-3" style="height:283px; width:100%;"></div>
                    <ul class="list-style-none mb-0">
                        <li class="mt-1">
                            <i class="fas fa-circle font-10 mr-2" style="color: #a0f588"></i>
                            <span class="text-muted">O'zbek tilida (lotin)</span>
                            <span class="text-dark float-right font-weight-medium">{{$langs['uz_l']}}</span>
                        </li>
                        <li class="">
                            <i class="fas fa-circle text-primary font-10 mr-2"></i>
                            <span class="text-muted">O'zbek tilida (kirill)</span>
                            <span class="text-dark float-right font-weight-medium">{{$langs['uz_k']}}</span>
                        </li>
                        <li class="">
                            <i class="fas fa-circle text-danger font-10 mr-2"></i>
                            <span class="text-muted">Rus tilida</span>
                            <span class="text-dark float-right font-weight-medium">{{$langs['ru']}}</span>
                        </li>
                        <li class="">
                            <i class="fas fa-circle text-cyan font-10 mr-2"></i>
                            <span class="text-muted">Ingliz tilida</span>
                            <span class="text-dark float-right font-weight-medium">{{$langs['en']}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">To'liq matnlar taqsimlanishi:</h4>
                    <div id="campaign-v22" class="mt-3" style="height:283px; width:100%;"></div>
                    <ul class="list-style-none mb-0">
                        <li class="mt-1">
                            <i class="fas fa-circle font-10 mr-2" style="color: #a0f588"></i>
                            <span class="text-muted">Darslik</span>
                            <span class="text-dark float-right font-weight-medium">{{$tmCategories['darslik']}}</span>
                        </li>
                        <li class="">
                            <i class="fas fa-circle text-primary font-10 mr-2"></i>
                            <span class="text-muted">O'quv qo'llanma</span>
                            <span class="text-dark float-right font-weight-medium">{{$tmCategories['oquvq']}}</span>
                        </li>
                        <li class="">
                            <i class="fas fa-circle text-danger font-10 mr-2"></i>
                            <span class="text-muted">Badiiy adabiyot</span>
                            <span class="text-dark float-right font-weight-medium">{{$tmCategories['badiiy']}}</span>
                        </li>
                        <li class="">
                            <i class="fas fa-circle text-cyan font-10 mr-2"></i>
                            <span class="text-muted">Ilmiy adabiyot</span>
                            <span class="text-dark float-right font-weight-medium">{{$tmCategories['ilmiy']}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Earning by Location</h4>
                    <div class="" style="height:180px">
                        <div id="visitbylocate" style="height:100%"></div>
                    </div>
                    <div class="row mb-3 align-items-center mt-1 mt-5">
                        <div class="col-4 text-right">
                            <span class="text-muted font-14">India</span>
                        </div>
                        <div class="col-5">
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"
                                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-3 text-right">
                            <span class="mb-0 font-14 text-dark font-weight-medium">28%</span>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-4 text-right">
                            <span class="text-muted font-14">UK</span>
                        </div>
                        <div class="col-5">
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 74%"
                                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-3 text-right">
                            <span class="mb-0 font-14 text-dark font-weight-medium">21%</span>
                        </div>
                    </div>
                    <div class="row mb-3 align-items-center">
                        <div class="col-4 text-right">
                            <span class="text-muted font-14">USA</span>
                        </div>
                        <div class="col-5">
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar bg-cyan" role="progressbar" style="width: 60%"
                                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-3 text-right">
                            <span class="mb-0 font-14 text-dark font-weight-medium">18%</span>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-4 text-right">
                            <span class="text-muted font-14">China</span>
                        </div>
                        <div class="col-5">
                            <div class="progress" style="height: 5px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 50%"
                                     aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <div class="col-3 text-right">
                            <span class="mb-0 font-14 text-dark font-weight-medium">12%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- *************************************************************** -->
    <!-- End Sales Charts Section -->
    <!-- *************************************************************** -->
    <!-- *************************************************************** -->
    <!-- Start Location and Earnings Charts Section -->
    <!-- *************************************************************** -->
{{--    <div class="row">--}}
{{--        <div class="col-md-6 col-lg-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="d-flex align-items-start">--}}
{{--                        <h4 class="card-title mb-0">Earning Statistics</h4>--}}
{{--                        <div class="ml-auto">--}}
{{--                            <div class="dropdown sub-dropdown">--}}
{{--                                <button class="btn btn-link text-muted dropdown-toggle" type="button"--}}
{{--                                        id="dd1" data-toggle="dropdown" aria-haspopup="true"--}}
{{--                                        aria-expanded="false">--}}
{{--                                    <i data-feather="more-vertical"></i>--}}
{{--                                </button>--}}
{{--                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">--}}
{{--                                    <a class="dropdown-item" href="#">Insert</a>--}}
{{--                                    <a class="dropdown-item" href="#">Update</a>--}}
{{--                                    <a class="dropdown-item" href="#">Delete</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="pl-4 mb-5">--}}
{{--                        <div class="stats ct-charts position-relative" style="height: 315px;"></div>--}}
{{--                    </div>--}}
{{--                    <ul class="list-inline text-center mt-4 mb-0">--}}
{{--                        <li class="list-inline-item text-muted font-italic">Earnings for this month</li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-md-6 col-lg-4">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <h4 class="card-title">Recent Activity</h4>--}}
{{--                    <div class="mt-4 activity">--}}
{{--                        <div class="d-flex align-items-start border-left-line pb-3">--}}
{{--                            <div>--}}
{{--                                <a href="javascript:void(0)" class="btn btn-info btn-circle mb-2 btn-item">--}}
{{--                                    <i data-feather="shopping-cart"></i>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="ml-3 mt-2">--}}
{{--                                <h5 class="text-dark font-weight-medium mb-2">New Product Sold!</h5>--}}
{{--                                <p class="font-14 mb-2 text-muted">John Musa just purchased <br> Cannon 5M--}}
{{--                                    Camera.--}}
{{--                                </p>--}}
{{--                                <span class="font-weight-light font-14 text-muted">10 Minutes Ago</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex align-items-start border-left-line pb-3">--}}
{{--                            <div>--}}
{{--                                <a href="javascript:void(0)"--}}
{{--                                   class="btn btn-danger btn-circle mb-2 btn-item">--}}
{{--                                    <i data-feather="message-square"></i>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="ml-3 mt-2">--}}
{{--                                <h5 class="text-dark font-weight-medium mb-2">New Support Ticket</h5>--}}
{{--                                <p class="font-14 mb-2 text-muted">Richardson just create support <br>--}}
{{--                                    ticket</p>--}}
{{--                                <span class="font-weight-light font-14 text-muted">25 Minutes Ago</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex align-items-start border-left-line">--}}
{{--                            <div>--}}
{{--                                <a href="javascript:void(0)" class="btn btn-cyan btn-circle mb-2 btn-item">--}}
{{--                                    <i data-feather="bell"></i>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                            <div class="ml-3 mt-2">--}}
{{--                                <h5 class="text-dark font-weight-medium mb-2">Notification Pending Order!--}}
{{--                                </h5>--}}
{{--                                <p class="font-14 mb-2 text-muted">One Pending order from Ryne <br> Doe</p>--}}
{{--                                <span class="font-weight-light font-14 mb-1 d-block text-muted">2 Hours--}}
{{--                                                Ago</span>--}}
{{--                                <a href="javascript:void(0)" class="font-14 border-bottom pb-1 border-info">Load More</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- *************************************************************** -->
    <!-- End Location and Earnings Charts Section -->
    <!-- *************************************************************** -->
    <!-- *************************************************************** -->
    <!-- Start Top Leader Table -->
    <!-- *************************************************************** -->
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-12 ac">
                    <h3>ARM bo'limlari statistikasi</h3>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="all-campus-tms-count-table" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                <tr class="ac">
                                    <th width="10%" class="font-weight-bold ">T/r</th>
                                    <th width="25%" class="font-weight-bold ">ARM bo'limi</th>
                                    <th width="25%" class="font-weight-bold ">Adabiyot nomda</th>
                                    <th width="20%" class="font-weight-bold ">Adabiyot nusxada</th>
                                    <th width="20%" class="font-weight-bold ">To'liq matnlar soni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($allCampusTMsCount as $c=>$currentCampusTMCount)
                                    <tr>
                                        <td class="ac">{{++$c}}</td>
                                        <td>
                                            <h4>{{$currentCampusTMCount->campus_name}}</h4>
                                        </td>
                                        <td class="ac">
                                            @forelse($eachCampusStat as $currentStat)
                                                @if($currentStat->campus_id == $currentCampusTMCount->campus_id)
                                                    {{$currentStat->book_nomda}}
                                                @endif
                                            @empty
                                            @endforelse
                                        </td>
                                        <td class="ac">
                                            @forelse($eachCampusStat as $currentStat)
                                                @if($currentStat->campus_id == $currentCampusTMCount->campus_id)
                                                    {{$currentStat->book_nusxada}}
                                                @endif
                                            @empty
                                            @endforelse
                                        </td>
                                        <td class="ac">
                                            {{$currentCampusTMCount->tm_count}}
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr class="ac">
                                    <th width="10%" class="font-weight-bold ">T/r</th>
                                    <th width="25%" class="font-weight-bold ">ARM bo'limi</th>
                                    <th width="25%" class="font-weight-bold ">Adabiyot nomda</th>
                                    <th width="20%" class="font-weight-bold ">Adabiyot nusxada</th>
                                    <th width="20%" class="font-weight-bold ">To'liq matnlar soni</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-12 ac">
                    <h3>Hodimlar statistikasi</h3>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="all-admins-table" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                <tr class="ac">
                                    <th width="10%" class="font-weight-bold ">ID</th>
                                    <th width="50%" class="font-weight-bold ">Hodim FIO</th>
                                    <th width="40%" class="font-weight-bold ">Kiritgan adabiyotlar soni</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($allAdmins as $choosedAdmin)
                                    <tr>
                                        <td class="ac">{{$choosedAdmin->id}}</td>
                                        <td>
                                            <h4 class="my-0">{{$choosedAdmin->name}}</h4>
                                        </td>
                                        <td class="ac">
                                            {{$choosedAdmin->admin_added_book_count}}
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr class="ac">
                                    <th width="10%" class="font-weight-bold ">ID</th>
                                    <th width="50%" class="font-weight-bold ">Hodim FIO</th>
                                    <th width="40%" class="font-weight-bold ">Kiritgan adabiyotlar soni</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-12 ac">
                    <h3>Adabiyot turi statistikasi</h3>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="all-categories-table" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                <tr class="ac">
                                    <th width="10%" class="font-weight-bold ">T/r</th>
                                    <th width="40%" class="font-weight-bold ">Adabiyot turi</th>
                                    <th width="25%" class="font-weight-bold ">Nomda</th>
                                    <th width="25%" class="font-weight-bold ">Sonda</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($bookCategoryCount as $c=>$currentCount)
                                    <tr>
                                        <td class="ac">{{++$c}}</td>
                                        <td>
                                            {{$allCategories[$currentCount->book_category]}}
                                        </td>
                                        <td class="ac">{{$currentCount->book_category_count}}</td>
                                        <td class="ac">{{$currentCount->book_copy_count}}</td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr class="ac">
                                    <th width="10%" class="font-weight-bold ">T/r</th>
                                    <th width="40%" class="font-weight-bold ">Adabiyot turi</th>
                                    <th width="25%" class="font-weight-bold ">Nomda</th>
                                    <th width="25%" class="font-weight-bold ">Sonda</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- *************************************************************** -->
    <!-- End Top Leader Table -->
    <!-- *************************************************************** -->
@endsection

@section('footerScripts')
    @parent
    <script src="{{asset('js/admin-page/core/d3.min.js')}}"> </script>
    <script src="{{asset('js/admin-page/core/c3.min.js')}}"> </script>
    <script src="{{asset('js/admin-page/core/chartist.min.js')}}"> </script>
    <script src="{{asset('js/admin-page/core/chartist-plugin-tooltip.min.js')}}"> </script>
    <script src="{{asset('js/admin-page/core/jquery-jvectormap-2.0.2.min.js')}}"> </script>
    <script src="{{asset('js/admin-page/core/jquery-jvectormap-world-mill-en.js')}}"> </script>
    <script src="{{asset('js/DataTable/jqueryTable.js')}}"></script>
    <script src="{{asset('js/DataTable/bootstrapTable.js')}}"></script>
    <script src="{{asset('js/admin-page/core/dashboard1.min.js')}}"> </script>

@endsection

