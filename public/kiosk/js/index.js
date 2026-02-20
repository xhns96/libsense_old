$(document).ready(function () {

    $('#all-campuses-select').on('change', function () {

        let campusID = $(this).val();
        let videoTag = `<video id="preview" data-id = "${$(this).val()}" class="border" style="width: 100%; height: 100%;border: none"></video>`;
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
            console.log(c);
            let QRCodeData = {
                '_for_what': 'userCheck',
                'user_hashed_id': c,
                'campus_id': campusID
            };
            console.log(QRCodeData);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('',QRCodeData,function (QrCodeResponse) {
                console.log(QrCodeResponse);
                if (QrCodeResponse.answer === 'success'){
                    if (QrCodeResponse.status === '1'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Hush kelibsiz!',
                            showConfirmButton: false,
                            timer: 3500,
                            timerProgressBar: true
                        });
                    }
                    if (QrCodeResponse.status === '2'){
                        Swal.fire({
                            icon: 'success',
                            title: "Kuningiz hayrli o'tsin!",
                            showConfirmButton: false,
                            timer: 3500,
                            timerProgressBar: true
                        });
                    }
                }
            })
        });
        $(this).attr('disabled',true);
        $('#reload-page-btn').attr('disabled',false).on('click', function(){
            location.reload();
        })
    });




    //////////////////////////////////////////////////////////////// 2 QR / Barcode Scanner /////////////////////////////////////
    //link : https://github.com/mebjas/html5-qrcode
    // $('#all-campuses-select').on('change', function () {

    //     let campusID = $(this).val();
        
    //     Html5Qrcode.getCameras().then(devices => {
    //         /**
    //          * devices would be an array of objects of type:
    //          * { id: "id", label: "label" }
    //          */
    //         if (devices && devices.length) {
    //           var cameraId = devices[0].id;
    //           const html5QrCode = new Html5Qrcode(/* element id */ "reader");
    //             html5QrCode.start(cameraId, 
    //                 {
    //                     fps: 10,    // Optional, frame per seconds for qr code scanning
    //                     qrbox: 250  // Optional, if you want bounded box UI
    //                 },
    //                 (decodedText, decodedResult) => {
    //                     // do something when code is read
    //                 },
    //             (errorMessage) => {
    //                 // parse error, ignore it.
    //             })
    //             .catch((err) => {
    //                 // Start failed, handle it.
    //             });
    //         }
    //     }).catch(err => {
    //         // handle err
    //     });

    //     $(this).attr('disabled',true);
    // });
    //\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

})
