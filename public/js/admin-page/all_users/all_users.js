$(document).ready(function () {

    $('#all-users-table').dataTable().css('display','table');

    $('#btn-sync').on('click', function () {
        $(this).attr('disabled', true);
        let user_type = $('#user_type').val();
        let level = $('#level').val();        

        let userSync = {
            '_for_what': 'user_sync',
            'user_type': user_type,
            'level':  level
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post('',userSync, function (userDeleteResponse) {
            console.log(userDeleteResponse);
            
            if (userDeleteResponse.answer === 'success'){
                Swal.fire({
                    icon: 'success',
                    title: 'Muvaffaqiyat!',
                    text: 'Kitobxon ma\'lumotlar HEMIS bazasi bilan tekshirildi.',
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        location.reload();
                    }
                })
            }
            if (userDeleteResponse.answer === 'user-borrowed'){
                Swal.fire({
                    icon: 'warning',
                    title: 'Ogohlantirish!',
                    text: 'Kitobxon yopilmagan buyurtma yoki qarzdorligi mavjud.',
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        location.reload();
                    }
                })
            }
            if (userDeleteResponse.answer === 'empty'){
                location.reload();
            }
        })
    })

    $("#all-users-table").on("click", ".user-delete", function(){

        let userDeleteData = {
            '_for_what': 'userDelete',
            'user_id': $(this)[0].attributes[1].nodeValue
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post('',userDeleteData, function (userDeleteResponse) {
            if (userDeleteResponse.answer === 'success'){
                Swal.fire({
                    icon: 'success',
                    title: 'Muvaffaqiyat!',
                    text: 'Kitobxon ma\'lumotlar bazasidan o\'chirildi.',
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        location.reload();
                    }
                })
            }
            if (userDeleteResponse.answer === 'user-borrowed'){
                Swal.fire({
                    icon: 'warning',
                    title: 'Ogohlantirish!',
                    text: 'Kitobxon yopilmagan buyurtma yoki qarzdorligi mavjud.',
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        location.reload();
                    }
                })
            }
            if (userDeleteResponse.answer === 'empty'){
                location.reload();
            }
        })

    }).on('click','.user-edit', function () {

    })
});
