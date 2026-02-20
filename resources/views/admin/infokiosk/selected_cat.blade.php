@extends('layouts.infokiosk')
@section('title','Libsense kiosk')

@section('headerStyles')
    @parent
    <link rel="stylesheet" href="{{asset('infokiosk/css/custom.css')}}">

@endsection

@section('content')
    <div class="row ml-3" style="margin-top: -600px">
        <div class="col-12 ac">
            <h3 class="" style="color: whitesmoke;margin-top: -150px"><span style="font-weight: bold">Adabiyot fan soxasi:</span> {{$sName}}</h3>
        </div>
        <div class="col-1"></div>
        @foreach($books as $currentBook)
            <div class="col-2 mb-3 selectedCategory d-none">
                <div class="card p-1" style="text-align: center;border-radius: 30px">
                    <img class="card-img-top mx-auto" id="at1" style="max-width: 230px; max-height: 310px; margin-top: -60px" src="{{asset('storage/book-images/')}}/@if($currentBook->book_image){{$currentBook->book_image}}@else{{'default.png'}}@endif" alt="Card image cap">
                    <div class="card-body" style="height: 120px; overflow-y: auto">
                        <h5 class="card-title" id="t1" style="font-weight: bold; color: #4F5467">{{$currentBook->book_name}}</h5>
                    </div>
                    <div class="card-footer" style="background: white;border-radius: 30px">
                        <button data-id="{{$currentBook->id}}" class="btn btn-success" style="border-radius: 30px"  data-toggle="modal" data-target="#qrModal"><span style="font-weight: bold" ><i class="bi bi-bag-check-fill mr-2" style="font-weight: bold; font-size: 1.2rem"></i>BUYURTMA QILISH</span></button>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-12 mt-3">

            <div class="row">
                <div class="col-1"> </div>
                <div class="col-8 ac ml-auto" style="font-size: 1.2rem; text-align: center">
                    <ul class="pagination ac" id="selected-category-pagination" style="margin-left: 100px"></ul>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buyurtma</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Bekor qilish</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footerScripts')
    @parent
    <script src="{{asset('js/book-page/pagination.js')}}"></script>
    <script src="{{asset('js/handlebars-v4.7.7.js')}}"></script>
    <script src="{{asset('infokiosk/js/selected_cat.js')}}"></script>
@endsection
