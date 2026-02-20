@extends('layouts.admin')
@section('title', "Barcha adabiyotlar")

@section('headerStyles')
    @parent
    <link rel="stylesheet" href="{{asset('css/DataTable/bootstrapTable.css')}}">
    <link rel="stylesheet" href="{{asset('css/bi.css')}}">
@endsection

@section('content')
    <div class="col-12 mt-3 profileCard">
        <form id="cbook-form" action="{{route('admin.all_books.post')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-2 pt-2">
                    <h4><i data-feather="book-open" class="feather-icon mb-1 mr-2"></i> Bo'limni tanlang: </h4>
                </div>
                <div class="col-2">
                    <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" id="choose-campus-select">
                        <option selected disabled>ARM bo'limini tanlang:</option>
                        @forelse($allCampuses as $currentCampus)
                            <option value="{{$currentCampus->id}}">{{$currentCampus->campus_name}}</option>
                            @empty
                        @endforelse
                    </select>
                </div>
                <div class="col-2 ac">
                    <button id="choosed-campus-update-button" type="button" class="btn btn-primary" disabled><i class="bi-arrow-repeat mr-2"></i>Yangilash</button>
                </div>
            </div>
        </form>
    </div>
    <div class="row mt-5">
        <div class="col-12">

        </div>
        <div class="col-12 ac">
            <h3>Kitobxonlar qatnovi jadvali</h3>
        </div>

        <div id="table-div" class="col">
            <table id="kundalik-table" class="table table-hover table-bordered" style="display: none;width:100%">
                <thead>
                <tr class="ac">
                    <th width="10%" class="font-weight-bold">T/r</th>
                    <th width="25%" class="font-weight-bold">Talaba FIO</th>
                    <th width="20%" class="font-weight-bold">ARM bo'limi</th>
                    <th width="15%" class="font-weight-bold">Kirgan vaqti</th>
                    <th width="15" class="font-weight-bold">Chiqgan vaqti</th>
                    <th width="15%" ></th>
                </tr>
                </thead>
                <tbody>

                </tbody>
                <tfoot>
                <tr class="ac">
                    <th width="10%" class="font-weight-bold">T/r</th>
                    <th width="25%" class="font-weight-bold">Talaba FIO</th>
                    <th width="20%" class="font-weight-bold">ARM bo'limi</th>
                    <th width="15%" class="font-weight-bold">Kirgan vaqti</th>
                    <th width="15" class="font-weight-bold">Chiqgan vaqti</th>
                    <th width="15%" ></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
{{--    <div id="choosed-book-modal" class="modal fade" tabindex="-1" role="dialog"--}}
{{--         aria-hidden="true"--}}
{{--         data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel">--}}
{{--        <div class="modal-dialog modal-lg">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header modal-colored-header bg-info">--}}
{{--                    <h4 class="modal-title" id="info-header-modalLabel">Sozlamalar</h4>--}}
{{--                    <button type="button" class="close" data-dismiss="modal"--}}
{{--                            aria-hidden="true">×</button>--}}
{{--                </div>--}}
{{--                <div class="row p-3">--}}
{{--                    <div class="col m-auto">--}}
{{--                        <form id="choosed-book-form" action="{{route('admin.all_books.post')}}" method="post" enctype="multipart/form-data">--}}
{{--                            @csrf--}}
{{--                            <div class="row" id="choosed-book-content-div">--}}
{{--                                <div class="col-4">--}}
{{--                                </div>--}}
{{--                                <div class="col-4 ac">--}}
{{--                                    <img width="100" src="{{asset('images/core/loader.svg')}}" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="col-4"></div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--            </div><!-- /.modal-content -->--}}
{{--        </div><!-- /.modal-dialog -->--}}
{{--    </div>--}}
@endsection
@section('footerScripts')
    @parent
    <script src="{{asset('js/admin-page/add_books/jqueryForm.js')}}"></script>
    <script src="{{asset('js/DataTable/jqueryTable.js')}}"></script>
    <script src="{{asset('js/DataTable/bootstrapTable.js')}}"></script>
    <script src="{{asset('js/admin-page/kundalik/kundalik.js')}}"></script>
@endsection
