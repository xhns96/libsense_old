$(document).ready(function () {

    $('#book_id').select2({
        theme: 'bootstrap4',
        width: 'resolve',
        closeOnSelect: false,
        allowClear: false,
        minimumResultsForSearch: Infinity,
        ajax:{
            url : orderPostURL,
            type: 'get',
            dataType: 'json',
            delay:250,
            data: function (params) {
                return {
                    searchItem:params.term,
                    page:params.page
                }
            },
            processResults:function (data,params) {
                params.page=params.page || 1;
                return{
                    results:data.data,
                    pagination:{
                        more:data.last_page!=params.page
                    }
                }
            },
            cache:true
        },
        placeholder: 'ID / Nomi / Muallif / Nashr yili bo‘yicha qidirish',
        templateResult:templateResult,
        templateSelection:templateSelection
    });
    function templateResult(data) {
        if (data.loading) {
            return data.text
        }
        return data.id + " / "  + data.book_name  + " / "  + data.book_author  + " / "  + data.book_year;
    }
    function templateSelection(data) {
        let result = data.id + " / "  + data.book_name  + " / "  + data.book_author  + " / "  + data.book_year;
        return data.book_name.substr(0, 10) + " ...";
    }

    $('#user_id').select2({
        theme: 'bootstrap4',
        ajax:{
            url : getUsersData,
            type: 'get',
            dataType: 'json',
            delay:250,
            data: function (params) {
                return {
                    searchItem:params.term,
                    page:params.page
                }
            },
            processResults:function (data,params) {
                params.page=params.page || 1;
                return{
                    results:data.data,
                    pagination:{
                        more:data.last_page!=params.page
                    }
                }
            },
            cache:true
        },
        placeholder: 'Talaba F.I.O / HEMIS ID bo‘yicha qidirish',
        templateResult:templateResult2,
        templateSelection:templateSelection2
    });

    function templateResult2(data) {
        console.log(data);
        if (data.loading) {
            return data.text
        }
        return data.name + " / "  + data.student_id_number ;
    }
    function templateSelection2(data) {
        return data.name;
    }

    $('#all-orders-table').dataTable();

    $("#btn_student_id_number").on("click", function () {
        let student_id_number = $("#student_id_number").val();
        $("#reload-btn").removeClass('d-none');
        $(this).addClass('d-none');
        let student_search = {
            '_for_what': 'student_search',
            'student_id_number': student_id_number,
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.post('',student_search, function (studentSearch) {
            if(studentSearch.answer == "success"){
                $("#reload-btn").addClass('d-none');
                $("#btn_student_id_number").removeClass('d-none');

                let student_data = studentSearch.student;
                let student_item = studentSearch.student['data']['items'];

                if (student_data['data']['pagination']['totalCount'] != 0) {
                    for (let i = 0; i < student_item.length; i++) {
                        $("#student_full_name").val(student_item[i]['full_name']);
                        $("#student_faculty_name").val(student_item[i]['department']['name']);
                        $("#student_specialty_name").val(student_item[i]['specialty']['name']);
                        $("#student_course_name").val(student_item[i]['level']['name']);
                        $("#student_group_name").val(student_item[i]['group']['name']);
                        $("#student_semestr_name").val(student_item[i]['semester']['name']);
                        $("#student_status").val(student_item[i]['studentStatus']['name']);
                    }
                }else{
                    console.log("Hech narsa topilmadi");
                }
            }
        
        });
        
    })


    $("#all-orders-table").on("mouseenter", ".borrowTime", function(){
        $.datetimepicker.setLocale('ru');
        $(this).datetimepicker({
            timepicker:false,
            format:'Y-m-d'
        });
    }).on("click", ".order-reject", function(){
       let orderRejectData = {
           '_for_what': 'orderReject',
           'order_id': $(this)[0].attributes[1].nodeValue,
           'order_user_id': $(this)[0].attributes[2].nodeValue
       }

       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
       $.post('',orderRejectData, function (orderRejectResponse) {
            if (orderRejectResponse.answer){
                if (orderRejectResponse.answer === 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'Muvaffaqiyat!',
                        text: 'Buyurtma bekor qilindi.',
                        allowOutsideClick: false
                    }).then((res)=>{
                       if (res.isConfirmed){
                           location.reload();
                       }
                    });
                }
                if (orderRejectResponse.answer === 'empty'){
                    location.reload();
                }
            }
            else{
                location.reload();
            }

       })

    }).on('click', '.order-ready', function () {
        let orderReadyData = {
            '_for_what': 'orderReady',
            'order_id': $(this)[0].attributes[1].nodeValue,
            'order_user_id': $(this)[0].attributes[2].nodeValue
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post('',orderReadyData, function (orderReadyResponse) {
            if (orderReadyResponse.answer){
                if (orderReadyResponse.answer === 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'Muvaffaqiyat!',
                        text: 'Buyurtma tayyor holatga o\'tdi.',
                        allowOutsideClick: false
                    }).then((res)=>{
                        if (res.isConfirmed){
                            location.reload();
                        }
                    });
                }
                if (orderReadyResponse.answer === 'empty'){
                    location.reload();
                }
            }
            else{
                location.reload();
            }

        })

    }).on('click', '.order-take', function () {

        let invNumID = "#inv"+$(this)[0].attributes[1].nodeValue;
        let btID = "#bt"+$(this)[0].attributes[1].nodeValue;
        let invNum = $(invNumID).val();
        let borrowTime = $(btID).val();
        if (invNum == "" || borrowTime == ""){
            Swal.fire({
                icon: 'info',
                title: 'Ma\'lumot!',
                text: 'Buyurtma muddati va adabiyot inventar raqamini kiriting.'
            });
        }
        else {
            let orderTakeData = {
                '_for_what': 'orderTake',
                'order_id': $(this)[0].attributes[1].nodeValue,
                'inv_number': invNum,
                'borrow_date': borrowTime,
                'order_user_id': $(this)[0].attributes[2].nodeValue
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('',orderTakeData, function (orderTakeResponse) {
                if (orderTakeResponse.answer){
                    if (orderTakeResponse.answer === 'success'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Muvaffaqiyat!',
                            text: 'Buyurtma topshirildi.',
                            allowOutsideClick: false
                        }).then((res)=>{
                            if (res.isConfirmed){
                                location.reload();
                            }
                        });
                    }
                    if (orderTakeResponse.answer === 'invalid-time'){
                        Swal.fire({
                            icon: 'error',
                            title: 'Xatolik!',
                            text: 'Buyurtma muddati noto\'g\'ri kiritilgan.',
                            allowOutsideClick: false
                        }).then((res)=>{
                            if (res.isConfirmed){
                                location.reload();
                            }
                        });
                    }
                    if (orderTakeResponse.answer === 'empty'){
                        location.reload();
                    }
                    if (orderTakeResponse.answer === 'no-copy'){
                        Swal.fire({
                            icon: 'warning',
                            title: 'Ogohlantirish!',
                            text: 'Ushbu adabiyotning barcha nusxalari hozirda qo\'lda.',
                            allowOutsideClick: false
                        }).then((res)=>{
                            if (res.isConfirmed){
                                Swal.close();
                            }
                        });
                    }
                }
                else{
                    location.reload();
                }

            })
        }



    })

})
