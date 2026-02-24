$(document).ready(function () {

    $('#profile-data-form').ajaxForm({
        beforeSend: function () {

        },
        uploadProgress: function (event, position, total, percentComplete) {
            $('#profile-data-upload').text(percentComplete+'%').css('width', percentComplete+'%');
        },
        success: function (data) {
            if (data['answer'] === 'success'){
                Swal.fire({
                    icon: 'success',
                    title: 'Muvaffaqiyat!',
                    text: 'Ma\'lumotlaringiz yangilandi.',
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        location.reload();
                    }
                });
            }

            if (data['answer'] === 'error'){

            }
            if (data['answer'] === 'type-error'){

            }
        }
    });


});
