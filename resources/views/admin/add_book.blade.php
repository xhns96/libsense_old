@extends('layouts.admin')
@section('title', "Adabiyot qo'shish")

@section('headerStyles')
    @parent
    <link rel="stylesheet" href="{{asset('css/admin-page/add_books/add_books.css')}}">
@endsection

@section('content')
<div class="row">
   <div class="col-6 m-auto">
            <form action="{{route('book-upload')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                {{-- ================================================================================== --}}
                <div class="col-12 mt-2 ac">
                    <h2 class="text-uppercase">Yangi adabiyot qo'shish</h2>
                </div>
                {{-- ================================================================================== --}}
                <div class="col-6 mt-2">
                    <input type="text" autocomplete="off" name="book-name" id="book-name" data-toggle="tooltip" data-placement="top" title="" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Adabiyot nomi:" data-original-title="Adabiyot nomi.">
                </div>
                <div class="col-6 mt-2">
                    <input type="text" autocomplete="off" name="book-author" id="book-author" data-toggle="tooltip" data-placement="top" title="" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Adabiyot muallifi:" data-original-title="Adabiyot muallifi.">
                </div>
                {{-- =================================================================================== --}}
                <div class="col-6 mt-2">
                    <input type="text" autocomplete="off" name="book-isbn" id="book-isbn" data-toggle="tooltip" data-placement="left" title="" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Adabiyot ISBN:" data-original-title="Adabiyot ISBN raqami.">
                </div>
                <div class="col-3 mt-2">
                    <input type="number" autocomplete="off" name="book-page-count" id="book-page-count" data-toggle="tooltip" data-placement="top" title="" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Necha bet:" data-original-title="Adabiyot bet soni.">
                </div>
                <div class="col-3 mt-2">
                    <input type="number" autocomplete="off" name="book-copy-count" id="book-copy-count" data-toggle="tooltip" data-placement="right" title="" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Nusxalar soni:" data-original-title="Adabiyot nusxalar soni.">
                </div>
                {{-- ==================================================================================== --}}
                <div class="col-3 mt-2">
                    <input type="text" autocomplete="off" name="book-publishing" id="book-publishing" data-toggle="tooltip" data-placement="left" title="" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Nashriyoti:" data-original-title="Adabiyot nashriyoti.">
                </div>
                <div class="col-3 mt-2">
                    <input type="number" autocomplete="off" name="book-year" id="book-year" data-toggle="tooltip" data-placement="right" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Nashr yili:" data-original-title="Adabiyot nashr yili.">
                </div>
{{--                <div class="col-1 mt-2"></div>--}}
                <div class="col-6 mt-2">
                    <input type="number" autocomplete="off" name="book-real-copy-count" id="book-real-time-count" data-toggle="tooltip" data-placement="right" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Hozirgi vaqtdagi nusxalar soni:" data-original-title="Hozirgi vaqtdagi nusxalar soni.">
                </div>
{{--                <div class="col-1 mt-2"></div>--}}
                {{-- ==================================================================================== --}}
                <div class="col-4 mt-2">
                    <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="book-type" id="book-page-type" data-toggle="tooltip" data-placement="left" data-original-title="Adabiyot ko'rinishi.">
                        <option selected disabled>Adabiyot ko'rinishi...</option>
                        <option value="1">Bosma taboq (qog'oz)</option>
                        <option value="2">Elektron adabiyot</option>
                    </select>
                </div>
                <div class="col-4 mt-2">
                    <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="book-for-home" id="book-for-home" data-toggle="tooltip" data-placement="top" data-original-title="Adabiyot uyga beriladimi ?">
                        <option selected disabled>Uyga beriladimi ?</option>
                        <option value="1">Ha</option>
                        <option value="2">Yo'q</option>
                    </select>
                    <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" style="display: none" name="is-book-primary" id="is-book-primary" data-toggle="tooltip" data-placement="top" data-original-title="Adabiyot asosiymi ?">
                        <option selected disabled>Adabiyot asosiymi ?</option>
                        <option value="1">Ha</option>
                        <option value="2">Yo'q</option>
                    </select>
                </div>
                <div class="col-4 mt-2">
                    <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="book-lang" id="book-lang" data-toggle="tooltip" data-placement="right" data-original-title="Adabiyot tili.">
                        <option selected disabled>Adabiyot tili...</option>
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
                {{-- ==================================================================================== --}}
                <div class="col-4 mt-2">
                    <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="book-category" id="book-category" data-toggle="tooltip" data-placement="left" data-original-title="Adabiyot tili.">
                        <option selected disabled>Adabiyot turi...</option>
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
                <div class="col-4 mt-2">
                    <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 " name="book-science-type" id="book-science-type" data-toggle="tooltip" data-placement="bottom" data-original-title="Adabiyot tili.">
                        <option selected disabled>Adabiyot fan soxasi...</option>
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
                <div class="col-4 mt-2">
                    <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="book-campus-id" id="book-campus-id" data-toggle="tooltip" data-placement="right" data-original-title="Adabiyot tili.">
                        <option selected disabled>ARM bo'limi...</option>
                        @foreach($allCampuses as $currentCampus)
                            <option value="{{$currentCampus->id}}">{{$currentCampus->campus_name}}</option>
                        @endforeach
                    </select>
                </div>
                {{-- ==================================================================================== --}}
                <div id="book-image-div" class="col-12 mt-5 p-3 ac" style="border: 2px dashed silver">
                    <b>Adabiyot betlik rasmini tanlang (agar mavjud bo'lsa):</b><br><input type="file" name="book-image" accept=".jpg,.jpeg,.png" class="form-control-file">
                </div>
                {{-- ==================================================================================== --}}
                <div id="book-file-div" class="col-12 mt-3 p-3 ac" style="border: 2px dashed silver">
                    <b>Adabiyot elektron ko'rinishini tanlang:</b><br><input type="file" name="book-file" accept=".pdf,.djvu,.epub,.doc,.docx" class="form-control-file">
                </div>
                {{-- ==================================================================================== --}}
                <div class="col-12 px-0 mt-3 progress">
                    <div id="book-upload" class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                </div>
                {{-- ==================================================================================== --}}
                <div class="col-12 mt-3 ac">
                    <button type="submit" class="btn btn-success borderRadius20 px-3"><i data-feather="save" class="feather-icon"></i> Saqlash</button>
                </div>
                {{-- ==================================================================================== --}}
            </div>
            </form>
   </div>
</div>
@endsection

@section('footerScripts')
    @parent
    <script src="{{asset('js/admin-page/add_books/jqueryForm.js')}}"></script>
    <script src="{{asset('js/admin-page/add_books/add_books.js')}}"></script>
@endsection
