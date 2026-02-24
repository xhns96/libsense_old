@extends('layouts.infokiosk')
@section('title','Kitoblar')

@section('headerStyles')
    @parent
    <link rel="stylesheet" href="{{asset('infokiosk/css/custom.css')}}">
@endsection

@section('content')
    <div class="row ml-3" style="margin-top: -800px; padding: 100px">
        <div class="col-12 ac">
            <h2 style="color: lightgrey; margin-top: -50px; margin-bottom: 50px; font-weight: bold">ADABIYOT FAN SOXALARI</h2>
        </div>
        <div class="col-2 mb-3">
            <div class="card p-1" id="cat1" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" id="at1" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/all-inclusive.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" id="t1" style="font-weight: bold; color: #4F5467">Umumiy va sohalaroro bilimlar</h5>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3">
            <div class="card p-1" id="cat2" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/innovation.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Umumiy tabiiy fanlar</h5>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3">
            <div class="card p-1" id="cat3" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/atom.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Fizika-matematika fanlari</h5>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat4" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/flask.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Kimyo fanlari</h5>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat5" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/globe.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Yer haqidagi fanlar</h5>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat6" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/dna.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Biologiya fanlari</h5>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat7" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/cpu.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Texnika fanlari</h5>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat8" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/poem.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Badiiy adabiyotlar</h5>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat9" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/hospital.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Sog'liqni saqlash. Tibbiyot fanlari</h5>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat10" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/social-care.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Sotsiologiya</h5>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat11" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/history.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Tarix. Tarix fanlari</h5>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat12" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/economic.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Iqtisod. Iqtisodiy fanlar</h5>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat13" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/political-science.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Siyosat. Siyosiy fanlar</h5>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat14" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/law.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Huquq. Yuridik fanlar</h5>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat15" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/military-rank.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Harbiy fan. Harbiy ish</h5>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat16" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/paint-palette.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">San'at</h5>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat17" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/mosque.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Din. Dinshunoslik</h5>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat18" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/mind.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Falsafa. Falsafa fanlari</h5>
                    <br>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat19" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/whiteboard.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Pedagogika va psixologiya fanlari</h5>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat20" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/exercise.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Jismoniy tarbiya va sport fanlari</h5>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat21" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/education.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Universal mazmunli adabiyotlar</h5>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat22" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/translate.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Tilshunoslik adabiyotlar</h5>
                </div>
            </div>
        </div>
        <div class="col-2 mb-3" style="">
            <div class="card p-1" id="cat999" style="text-align: center;border-radius: 30px">
                <img class="card-img-top mx-auto" style="max-width: 200px; max-height: 200px" src="{{asset('infokiosk/images/resources/layers.png')}}" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold; color: #4F5467">Boshqa turdagi adabiyotlar</h5>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('footerScripts')
    @parent
    <script src="{{asset('infokiosk/js/books.js')}}"></script>
@endsection
