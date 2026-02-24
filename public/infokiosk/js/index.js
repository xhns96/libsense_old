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

        $('#reload-span').css('color','ghostwhite').css('cursor','pointer').on('click',function () {
            location.reload();
        });

        scanner.addListener('scan',function(c){

            let QRCodeData = {
                '_for_what': 'userCheck',
                'user_hashed_id': c,
                'campus_id': campusID
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('',QRCodeData,function (QrCodeResponse) {
                if (QrCodeResponse.answer === 'success'){
                    console.log(QrCodeResponse);
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
                if (QrCodeResponse.answer === "userNotFound"){
                    Swal.fire({
                        icon: 'info',
                        title: "Bunday foydalanuvchini topib bo‘lmadi!",
                        showConfirmButton: false,
                        timer: 3500,
                        timerProgressBar: true
                    });
                }
            })
        });
        $(this).attr('disabled',true);
        $('#reload-page-btn').attr('disabled',false).on('click', function(){
            location.reload();
        })
    });

})
