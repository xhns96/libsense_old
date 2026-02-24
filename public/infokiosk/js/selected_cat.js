$(document).ready(function () {

    $('#selected-category-pagination').rpmPagination({
        domElement: '.selectedCategory',
        limit: 5
    });
    $(document).on('click','.btn',function () {
        let bookID = $(this).attr('data-id');
        let bookData = {
            "_for_what": 'bookData',
            "book_id": bookID
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post('',bookData, function (bookDataResponse) {

            if (bookDataResponse.answer === 'success'){

                let bookID = bookDataResponse.bookData['id'];

                let modalBody = `
                    <div class="row">
                        <div class="col-12">
                            <h5><span style="font-weight: bold">Adabiyot nomi:</span> ${bookDataResponse.bookData['book_name']}</h5>
                        </div>
                        <div class="col-12">
                            <h5><span style="font-weight: bold">Adabiyot nusxalar soni:</span> <b class="text-danger">${bookDataResponse.bookData['book_copy_count_now']}</b></h5>
                        </div>
                        <div class="col-12 ac">
                            <h5>Kitobxonlik biletingizdagi <b>QR kodni</b> skaner qiling</h5>
                        </div>
                        <div class="col-12" id="qr-code-scanner-div">

                        </div>
                    </div>`;
                $('#modal-body').html(modalBody);

                let videoTag = `<video id="preview" class="border" style="width: 100%; height: 100%;border: none"></video>`;
                $('#qr-code-scanner-div').html(videoTag);
                let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
                Instascan.Camera.getCameras().then(function(cameras){
                    if(cameras.length > 0 ){
                        scanner.start(cameras[0]);
                    } else{
                        alert('Web kamera topilmadi.');
                    }

                }).catch(function(e) {
                    console.error(e);
                });

                scanner.addListener('scan',function(c){
                    let QRCodeData = {
                        '_for_what': 'bookBorrow',
                        'user_hashed_id': c,
                        'book_id': bookID
                    };

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.post('',QRCodeData,function (QrCodeResponse) {
                        console.log(QrCodeResponse);
                        if (QrCodeResponse.answer === 'empty-copy'){

                        }
                        if (QrCodeResponse.answer === 'success'){

                        }
                        if (QrCodeResponse.answer === 'empty-book'){

                        }
                        if (QrCodeResponse.answer === 'alien'){

                        }

                    })
                });


            }
        })
    })

    $('#qrModal').on('hide.bs.modal', function (e) {

        location.reload();
    })


})
