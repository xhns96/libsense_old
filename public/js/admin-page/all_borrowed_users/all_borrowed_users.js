$(document).ready(function () {

    $('#all-borrowed-users-table').dataTable();
    $("#all-borrowed-users-table").on("click", ".borrow-delete", function(){
        let currentBorrowID = $(this)[0].attributes[1].nodeValue;

        Swal.fire({
            title: 'Ishonchingiz komilmi?',
            text: "Siz, qarzdorlik haqidagi yozuvni o'chirmoqchisiz.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#f5243c',
            confirmButtonText: 'Ha, ishinchim komil',
            cancelButtonText: 'Bekor qilish',
            allowOutsideClick: false
        }).then((result) => {
            if (result.isConfirmed) {
                let borrowDeleteData = {
                    '_for_what': 'borrowDelete',
                    'borrow_id': currentBorrowID
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post('',borrowDeleteData, function (borrowDeleteResponse) {
                    if (borrowDeleteResponse.answer === 'success'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Muvaffaqiyat!',
                            text: "Qarzdorlik ma'lumotlar bazasidan o'chirildi.",
                            allowOutsideClick: false
                        }).then((e)=>{
                           if (e.isConfirmed){
                               location.reload();
                           }
                        });
                    }
                    if (borrowDeleteResponse.answer === 'empty'){
                        location.reload();
                    }
                    if (borrowDeleteResponse.answer === 'hacked'){
                        location.reload();
                    }
                })
            }
        })

    }).on('click', '.borrow-edit', function () {
        let currentBorrowID = $(this)[0].attributes[1].nodeValue;
        let borrowEditData = {
            '_for_what': 'borrowEdit',
            'borrow_id': currentBorrowID
        }
    });
});
