@extends('layouts.admin')
@section('title', "Hisobot")

@section('headerStyles')
    @parent
    <link rel="stylesheet" href="{{asset('css/DataTable/bootstrapTable.css')}}">
    <link rel="stylesheet" href="{{asset('css/bi.css')}}">
@endsection

@section('content')
    <div class="col-12 mt-3 profileCard">

            <div class="row">
                <div class="col-12 pt-3 mb-2">
                    <div class="row">
                        <div class="col-2">
                            <h4 class="font-weight-bold text-primary"><i data-feather="file-plus" class="feather-icon mb-1 mr-2"></i> Hisobotlar bo'limi: </h4>
                        </div>
                        <div class="col-2">
                            <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" id="report-type-select" >
                                <option selected disabled>Hisobot yo'nalishi</option>
                                <option value="1">Adabiyotlar bo'yicha</option>
                                <option value="2">Elektron adabiyotlar bo'yicha</option>
                                <option value="3">Qatnov bo'yicha </option>
{{--                                <option disabled>Kitobxonlar bo'yicha </option>--}}
{{--                                <option disabled>Buyurtmalar bo'yicha </option>--}}
                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <hr>
                </div>

                <div class="col-2 pt-2">
                    <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" disabled id="book-campus-select">
                        <option selected disabled>ARM bo'limi...</option>
                        @foreach($allCampuses as $currentCampus)
                            <option value="{{$currentCampus->id}}">{{$currentCampus->campus_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-2 mt-2">
                    <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" id="book-category-select" disabled>
                        <option selected disabled>Adabiyot turi...</option>
                        <option value="all" class="text-success">Barcha turlar</option>
                        <option value="1">Darslik</option>
                        <option value="2">O'quv qo'llanma</option>
                        <option value="3">O'quv uslubiy qo'llanma</option>
                        <option value="4">Monografiya</option>
                        <option value="5">Risola</option>
                        <option value="6">Dastur</option>
                        <option value="7">To'plam</option>
                        <option value="8">Ensiklopediya</option>
                        <option value="9">Lug'at</option>
                        <option value="10">Qonunlar</option>
                        <option value="11">Ma'lumotnoma</option>
                        <option value="12">Avtoreferat</option>
                        <option value="13">Dissertatsiya</option>
                        <option value="999">Boshqa</option>
                    </select>
                </div>

                <div class="col-2 mt-2">
                    <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 " id="book-science-type-select" disabled>
                        <option selected disabled>Adabiyot fan soxasi...</option>
                        <option value="all" class="text-success">Barcha fan soxalari</option>
                        <option value="1">Umumiy va sohalaroro bilimlar</option>
                        <option value="2">Umumiy tabiiy fanlar</option>
                        <option value="3">Fizika-matematika fanlari</option>
                        <option value="4">Kimyo fanlari</option>
                        <option value="5">Yer haqidagi fanlar (geodeziya, geofizika, geologiya va geografiya fanlari)</option>
                        <option value="6">Biologiya fanlari</option>
                        <option value="7">Texnika fanlari</option>
                        <option value="8">Badiiy adabiyotlar</option>
                        <option value="9">Sog'liqni saqlash. Tibbiyot fanlari</option>
                        <option value="10">Sotsiologiya</option>
                        <option value="11">Tarix. Tarix fanlari</option>
                        <option value="12">Iqtisod. Iqtisodiy fanlar</option>
                        <option value="13">Siyosat. Siyosiy fanlar</option>
                        <option value="14">Huquq. Yuridik fanlar</option>
                        <option value="15">Harbiy fan. Harbiy ish</option>
                        <option value="16">San'at</option>
                        <option value="17">Din. Dinshunoslik</option>
                        <option value="18">Falsafa. Falsafa fanlari</option>
                        <option value="19">Pedagogika va Psixologiya fanlari</option>
                        <option value="20">Jismoniy tarbiya va sport fanlari</option>
                        <option value="21">Universal mazmunli adabiyotlar</option>
                        <option value="22">Tilshunoslik adabiyotlar</option>
                        <option value="999">Boshqa</option>
                    </select>
                </div>
                <div class="col-2 mt-2">
                    <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" id="book-lang-select" disabled>
                        <option selected disabled>Adabiyot tili...</option>
                        <option value="all" class="text-success">Barcha tilda</option>
                        <option value="uz_l">O'zbek tilida (Lotin)</option>
                        <option value="uz_k">O'zbek tilida (Kirill)</option>
                        <option value="kg">Qirg'iz tilida (Kirill)</option>
                        <option value="ru">Rus tilida</option>
                        <option value="en">Ingliz tilida</option>
                        <option value="al">Arab tilida</option>
                        <option value="fr">Fransuz tilida</option>
                        <option value="de">Nemis tilida</option>
                        <option value="kr">Koreys tilida</option>
                        <option value="cn">Xitoy tilida</option>
                        <option value="jp">Yapon tilida</option>
                        <option value="it">Italian tilida</option>
                        <option value="is">Ispan tilida</option>
                        <option value="x_l">Boshqa tilda</option>
                    </select>
                </div>
                <div class="col-2 mt-2">
                    <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" id="book-tm-select" disabled>
                        <option selected disabled>To'liq matni mavjudligi: </option>
                        <option value="all" class="text-success">Barcha holatda</option>
                        <option value="1">Mavjud</option>
                        <option value="2">Mavjud emas</option>
                    </select>
                </div>
                <div class="col-2 ac">
                    <button type="button" id="report-type-button" class="btn btn-primary" disabled><i data-feather="save" class="feather-icon mr-2"></i>Saqlash</button>
                </div>
            </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">

        </div>
        <div class="col-12 ac">
            <h3>Saralangan adabiyotlar jadvali (bosma taboq)</h3>
        </div>

        <div id="global-table-div" class="col-12">
            <div class="row">
                <div class="col-12 ac">
                    <img src="{{asset('images/core/loader_gif2.gif')}}" class="mt-5 s125" id="table-loader" style="display: none" alt="">
                </div>
                <div id="finded-data-count-div" class="col-12 ac mb-3">
                    <div class="row">
                        <div class="col ac">
                            <img src="{{asset('images/core/filter_books.png')}}" style="max-width: 400px; max-height: 400px" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-12" id="table-div">

                </div>
            </div>

        </div>
    </div>
    <div id="choosed-book-modal" class="modal fade" tabindex="-1" role="dialog"
         aria-hidden="true"
         data-backdrop="static" data-keyboard="false" aria-labelledby="staticBackdropLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-info">
                    <h4 class="modal-title" id="info-header-modalLabel">Sozlamalar</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">×</button>
                </div>
                <div class="row p-3">
                    <div class="col m-auto">
                        <form id="choosed-book-form" action="{{route('admin.all_books.post')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row" id="choosed-book-content-div">
                                <div class="col-4">
                                </div>
                                <div class="col-4 ac">
{{--                                    <img width="100" src="{{asset('images/core/loader.svg')}}" alt="">--}}
                                </div>
                                <div class="col-4"></div>
                            </div>
                        </form>
                    </div>
                </div>

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection

@section('footerScripts')
    @parent
    <script src="{{asset('js/admin-page/add_books/jqueryForm.js')}}"></script>
    <script src="{{asset('js/DataTable/jqueryTable.js')}}"></script>
    <script src="{{asset('js/DataTable/bootstrapTable.js')}}"></script>
    <script src="{{asset('js/admin-page/reports/reports.js')}}"></script>
@endsection
