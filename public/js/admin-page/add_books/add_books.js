$(document).ready(function () {

    var bookName = $('#book-name');
    var bookAuthor = $('#book-author');
    var bookISBN = $('#book-isbn');
    var bookPageCont = $('#book-page-count');
    var bookCopyCount = $('#book-copy-count');
    var bookRealCopyCount = $('#book-real-time-count');
    var bookPublishing = $('#book-publishing');
    var bookYear = $('#book-year');
    var bookPageType = $('#book-page-type');
    var bookForHome = $('#book-for-home');
    var isBookPrimary = $('#is-book-primary');
    var bookLang = $('#book-lang');
    var bookCategory = $('#book-category');
    var bookScienceType = $('#book-science-type');
    var bookCampusID = $('#book-campus-id');

    bookName.on('input',function () {
       if (bookName.val().length < 4){
           if (bookName.hasClass('is-valid')){
               bookName.removeClass('is-valid');
           }
           if (bookName.hasClass('is-invalid')){

           }
           else {
               bookName.addClass('is-invalid');
           }
       }
       else {
           if (bookName.hasClass('is-invalid')){
               bookName.removeClass('is-invalid');
           }
           if (bookName.hasClass('is-valid')){

           }
           else {
               bookName.addClass('is-valid');
           }
       }
    });
    bookAuthor.on('input',function () {
       if (bookAuthor.val().length < 4){
           if (bookAuthor.hasClass('is-valid')){
               bookAuthor.removeClass('is-valid');
           }
           if (bookAuthor.hasClass('is-invalid')){

           }
           else {
               bookAuthor.addClass('is-invalid');
           }
       }
       else {
           if (bookAuthor.hasClass('is-invalid')){
               bookAuthor.removeClass('is-invalid');
           }
           if (bookAuthor.hasClass('is-valid')){

           }
           else {
               bookAuthor.addClass('is-valid');
           }
       }
    });
    bookISBN.on('input',function () {
       if (bookISBN.val().length < 4){
           if (bookISBN.hasClass('is-valid')){
               bookISBN.removeClass('is-valid');
           }
           if (bookISBN.hasClass('is-invalid')){

           }
           else {
               bookISBN.addClass('is-invalid');
           }
       }
       else {
           if (bookISBN.hasClass('is-invalid')){
               bookISBN.removeClass('is-invalid');
           }
           if (bookISBN.hasClass('is-valid')){

           }
           else {
               bookISBN.addClass('is-valid');
           }
       }
    });
    bookPageCont.on('input',function () {
       if (bookPageCont.val().length < 2 || bookPageCont.val().length > 4){
           if (bookPageCont.hasClass('is-valid')){
               bookPageCont.removeClass('is-valid');
           }
           if (bookPageCont.hasClass('is-invalid')){

           }
           else {
               bookPageCont.addClass('is-invalid');
           }
       }
       else {
           if (parseInt(bookPageCont.val())<0){
               bookPageCont.addClass('is-invalid');
           }
           else {
               if (bookPageCont.hasClass('is-invalid')){
                   bookPageCont.removeClass('is-invalid');
               }
               if (bookPageCont.hasClass('is-valid')){

               }
               else {
                   bookPageCont.addClass('is-valid');
               }
           }
       }

    });
    bookCopyCount.on('input',function () {
       if (bookCopyCount.val().length > 4 || parseInt(bookCopyCount.val())<0){
           if (bookCopyCount.hasClass('is-valid')){
               bookCopyCount.removeClass('is-valid');
           }
           if (bookCopyCount.hasClass('is-invalid')){

           }
           else {
               bookCopyCount.addClass('is-invalid');
           }
       }
       else {
           if (bookCopyCount.hasClass('is-invalid')){
               bookCopyCount.removeClass('is-invalid');
           }
           if (bookCopyCount.hasClass('is-valid')){

           }
           else {
               bookCopyCount.addClass('is-valid');
           }
       }

    });
    bookRealCopyCount.on('input',function () {
      if (bookRealCopyCount.val().length > 4 || parseInt(bookRealCopyCount.val())<0 || parseInt(bookRealCopyCount.val())>parseInt(bookCopyCount.val())){
           if (bookRealCopyCount.hasClass('is-valid')){
               bookRealCopyCount.removeClass('is-valid');
           }
           if (bookRealCopyCount.hasClass('is-invalid')){

           }
           else {
               bookRealCopyCount.addClass('is-invalid');
           }
       }
       else {
           if (bookRealCopyCount.hasClass('is-invalid')){
               bookRealCopyCount.removeClass('is-invalid');
           }
           if (bookRealCopyCount.hasClass('is-valid')){

           }
           else {
               bookRealCopyCount.addClass('is-valid');
           }
       }
    });
    bookPublishing.on('input',function () {
       if (bookPublishing.val().length < 3){
           if (bookPublishing.hasClass('is-valid')){
               bookPublishing.removeClass('is-valid');
           }
           if (bookPublishing.hasClass('is-invalid')){

           }
           else {
               bookPublishing.addClass('is-invalid');
           }
       }
       else {
           if (bookPublishing.hasClass('is-invalid')){
               bookPublishing.removeClass('is-invalid');
           }
           if (bookPublishing.hasClass('is-valid')){

           }
           else {
               bookPublishing.addClass('is-valid');
           }
       }
    });
    bookYear.on('input',function () {
       if (bookYear.val().length < 4 || parseInt(bookYear.val())<1950 || parseInt(bookYear.val())>2021){
           if (bookYear.hasClass('is-valid')){
               bookYear.removeClass('is-valid');
           }
           if (bookYear.hasClass('is-invalid')){

           }
           else {
               bookYear.addClass('is-invalid');
           }
       }
       else {
           if (bookYear.hasClass('is-invalid')){
               bookYear.removeClass('is-invalid');
           }
           if (bookYear.hasClass('is-valid')){

           }
           else {
               bookYear.addClass('is-valid');
           }
       }
    });
    bookPageType.on('change',function () {
        if (!bookPageType.hasClass('is-valid')){
            bookPageType.addClass('is-valid');
        }
        if ($(this).val()==='1'){
            isBookPrimary.css('display','none');
            bookCopyCount.show();
            bookRealCopyCount.show();
            bookForHome.show();
        }
        if ($(this).val()==='2'){
            bookCopyCount.hide();
            bookRealCopyCount.hide();
            bookForHome.hide();
            isBookPrimary.css('display','inline');
        }
    });
    bookForHome.on('change',function () {
        if (!bookForHome.hasClass('is-valid')){
            bookForHome.addClass('is-valid');
        }
    });
    bookLang.on('change',function () {
        if (!bookLang.hasClass('is-valid')){
            bookLang.addClass('is-valid');
        }
    });
    bookCategory.on('change',function () {
        if (!bookCategory.hasClass('is-valid')){
            bookCategory.addClass('is-valid');
        }
    });
    bookScienceType.on('change',function () {
        if (!bookScienceType.hasClass('is-valid')){
            bookScienceType.addClass('is-valid');
        }
    });
    bookCampusID.on('change',function () {
        if (!bookCampusID.hasClass('is-valid')){
            bookCampusID.addClass('is-valid');
        }
    });


    $('form').ajaxForm({
        beforeSend: function () {

        },
        uploadProgress: function (event, position, total, percentComplete) {
            $('#book-upload').text(percentComplete+'%').css('width', percentComplete+'%');
        },
        success: function (data) {
            if (data.answer === 'error'){
                $('.progress-bar').text('0%').css('width','0%');
                Swal.fire({
                    icon: 'error',
                    title: 'Xatolik!',
                    text: 'Ma\'lumotlar kiritilmagan yoki noto\'g\'ri kiritilgan.',
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        Swal.close();
                    }
                });
            }
            if (data.answer === 'success'){
                Swal.fire({
                   icon: 'success',
                   title: 'Muvaffaqiyat!',
                   text: 'Kiritilgan adabiyot, ma\'lumotlar bazasiga qo\'shildi.',
                   allowOutsideClick: false
                }).then((e)=>{
                   if (e.isConfirmed){
                       location.reload();
                   }
                });
            }
            if (data.answer === 'equal'){
                Swal.fire({
                    icon: 'info',
                    title: 'O\'xshashlik!',
                    text: 'Kiritgan adabiyotingiz ma\'lumotlar bazasida mavjud.',
                    allowOutsideClick: false
                }).then((e)=>{
                   if (e.isConfirmed){
                       location.reload();
                   }
                });
            }
        }
    });
})
