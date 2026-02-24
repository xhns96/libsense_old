@extends('layouts.book')
@section('title','Kitoblar')
@section('headerStyles')
@parent
<link rel="stylesheet" href="{{asset('css/typeahead.css')}}">
<link rel="stylesheet" href="{{asset('css/customcard.css')}}">
@endsection

@section('content')
<div class="row">
  <div class="col ac">
    <img id="book-page-main-image" class="s600" src="{{asset('images/book-page/index/search-bg.png')}}" alt="search"><br>
    <select class="font-weight-bold custom-select mr-sm-2 borderRadius20 inputPR20" id="otm-id">
      <option selected disabled>OTM: </option>
      @forelse($allUniversities as $currentUniversity)
      @if($currentUniversity->univer_payment)
      <option value="{{$currentUniversity->id}}">{{$currentUniversity->univer_short_name}}</option>
      @endif
      @empty
      @endforelse
    </select>
    <input style="display: none" type="search" id="search-input2" autocomplete="off" class="form-control font-weight-bold bookBoxShadow borderRadius20 inputPR20 mx-auto" placeholder="Qidiruv: (Adabiyot nomi bo'yicha)" readonly>
    <input type="search" class="form-control font-weight-bold bookBoxShadow borderRadius20 inputPR20 mx-auto" id="search-input" placeholder="Qidiruv: (Adabiyot nomi bo'yicha)" readonly>
  </div>
</div>
<div class="container mt-5">
  <div class="row" id="findedBookContent">
    
  </div>
</div>
@endsection

@section('footerScripts')
@parent
<script>
  var loaderURL = "{{asset('images/core/loader_gif2.gif')}}";
  var bookImgURL = "{{asset('storage/book-images/')}}";
</script>
<script src="{{asset('js/book-page/pagination.js')}}"></script>
<script src="{{asset('js/typeahead.js')}}"></script>
<script src="{{asset('js/handlebars-v4.7.7.js')}}"></script>
<script src="{{asset('js/book-page/index/index.js')}}"></script>
<script>
  $(document).ready(function () {
    @if (Session::has('not-signed')) {
    Swal.fire({
    icon: 'info',
    title: 'Ma\'lumot!',
    text: 'Adabiyotni yuklab olish uchun akkauntingizga kirishingiz kerak bo‘ladi.',
    allowOutsideClick: false
 }).then((res)=>{
    if (res.isConfirmed){
        Swal.close();
        currentBtn.disabled = false;
    }
  });
  }
  @endif
  @if (Session::has('inactive'))
    Swal.fire({
        icon: 'info',
        title: 'Ma\'lumot!',
        text: 'Adabiyotni yuklab olish uchun akkauntingiz "FAOL" holatda bo\'lishi kerak.',
        allowOutsideClick: false
    }).then((res)=>{
        if (res.isConfirmed){
          Swal.close();
          currentBtn.disabled = false;
        }
      });
@endif
@if (Session::has('pending'))
    Swal.fire({
         icon: 'info',
         title: 'Ma\'lumot!',
         text: 'Adabiyotni yuklab olish uchun akkauntingiz "FAOL" holatda bo\'lishi kerak.',
         allowOutsideClick: false
        }).then((res)=>{
             if (res.isConfirmed){
                Swal.close();
                currentBtn.disabled = false;
              }
       });
  @endif

  @if (Session::has('download_error'))
    Swal.fire({
         icon: 'info',
         title: 'Ma\'lumot!',
         text: 'Badiiy adabiyotlarni yuklab olish mumkun emas iltimos ARM bo‘limiga murajat qiling',
         allowOutsideClick: false
        }).then((res)=>{
             if (res.isConfirmed){
                Swal.close();
                currentBtn.disabled = false;
              }
       });
  @endif

  })
  
</script>
@endsection