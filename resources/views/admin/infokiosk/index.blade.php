@extends('layouts.infokiosk')
@section('title','Libsense kiosk')

@section('headerStyles')
    @parent
    <link rel="stylesheet" href="{{asset('infokiosk/css/custom.css')}}">
@endsection

@section('content')
    <div class="row ml-3" style="margin-top: -600px">
        <div class="col">
            <img style="margin-top: -200px; max-width: 700px; max-height: 700px" src="{{asset('infokiosk/images/lib_white.svg')}}" alt="Kiosk img">
        </div>
        <div class="col">
            <div class="row">
                <div class="col-12">
                    <div class="select">
                        <div class="row">
                            <div class="col-5 mb-3 ac" style="margin-top: -100px">
                                <img src="{{asset('storage/university-logos')}}/{{$uImage}}" class="s125 rounded-circle" style="box-shadow: 0 0 15px white" alt="OTM-logo">
                            </div>
                            <div class="col-7 mb-3 ac" style="margin-top: -100px"></div>
                            <div class="col-5 mb-5 ac">
                                <img class="mr-3 rounded" src="{{asset('infokiosk/images/qr-code.png')}}" style="max-width: 35px; max-height: 35px;box-shadow: 3px 3px 5px whitesmoke;background: whitesmoke" alt="QR-code"> <span style="color: whitesmoke;font-weight: bold;font-size: 1.2rem;text-shadow: 1px 1px 5px whitesmoke">ELEKTRON KUNDALIK</span>
                            </div>
                            <div class="col-7 mb-5">

                            </div>
                            <div class="col-5">
                                <select id="all-campuses-select" class="font-weight-bold custom-select mr-sm-2 borderRadius20 inputPR20" style="width: 350px;box-shadow: 1px 1px 10px ghostwhite;">
                                    <option value="" disabled selected>O'quv zali / Abonementni tanlang:</option>
                                    @forelse($allCampuses as $currentCampus)
                                        <option value="{{$currentCampus->id}}">{{$currentCampus->campus_name}}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            <div class="col-7" >
                                <span id="reload-span" class="rounded-circle" style="margin-left: -20px;color: gray;cursor: default;padding: 5px 10px;font-weight: bold; font-size: 1.5rem;box-shadow: 1px 1px 10px ghostwhite;"><i class="bi bi-arrow-repeat"></i></span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 mt-5">
                    <div class="row">
                        <div class="col-6" style="margin-left: -30px" id="qr-code-scanner-div">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footerScripts')
    @parent
    <script src="{{asset('infokiosk/js/index.js')}}"></script>
@endsection
