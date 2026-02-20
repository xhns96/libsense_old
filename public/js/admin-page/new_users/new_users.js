$(document).ready(function () {

    $('#all-new-users-table').DataTable();

    $("#btn_student_id_number").on("click", function () {
        let student_id_number = $("#student_id_number").val();
        let user_type = $('#user_type').val();
        $("#reload-btn").removeClass('d-none');
        $(this).addClass('d-none');
        let student_search = {
            '_for_what': 'student_search',
            'student_id_number': student_id_number,
            'user_type': user_type
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
                let user_type = studentSearch.user_type;
                console.log(user_type);
                
                if(user_type == 'student'){
                    if (student_data['data']['pagination']['totalCount'] != 0) {
                        for (let i = 0; i < student_item.length; i++) {
                            $("#name").val(student_item[i]['full_name']);
                            $("#student_faculty_name").val(student_item[i]['department']['name']);
                            $("#student_specialty_name").val(student_item[i]['specialty']['name']);
                            $("#student_course_name").val(student_item[i]['level']['name']);
                            $("#student_group_name").val(student_item[i]['group']['name']);
                            $("#student_semestr_name").val(student_item[i]['semester']['name']);
                            $("#student_status").val(student_item[i]['studentStatus']['name']);
                            $("#student_education_year").val(student_item[i]['educationYear']['name']);
                            $("#image").val(student_item[i]['image']);
                        }
                    }
                }

                if(user_type == 'teacher'){
                    if (student_data['data']['pagination']['totalCount'] != 0) {
                        for (let i = 0; i < student_item.length; i++) {
                            $("#name").val(student_item[i]['full_name']);
                            $("#student_faculty_name").val(student_item[i]['department']['name']);
                            $("#student_specialty_name").val(student_item[i]['specialty']);
                            $("#student_course_name").val(student_item[i]['academicDegree']['name']);
                            $("#student_group_name").val(student_item[i]['academicRank']['name']);
                            $("#student_semestr_name").val(student_item[i]['employmentForm']['name']);
                            $("#student_status").val(student_item[i]['employeeStatus']['name']);
                            $("#student_education_year").val(student_item[i]['staffPosition']['name']);
                            $("#image").val(student_item[i]['image']);
                        }
                    }
                }

                
                else{
                    console.log("Hech narsa topilmadi");
                }
            }
        
        });
        
    })

    $('.user-reject').on('click', function () {

        Swal.fire({
            input: 'textarea',
            inputLabel: 'Rad qilish sababi',
            inputPlaceholder: 'Rad qilish sababini shu yerga yozing...',
            inputAttributes: {
                'aria-label': 'Rad qilish sababini shu yerga yozing...'
            },
            showCancelButton: true,
            cancelButtonText: 'Ortqa qaytish',
            confirmButtonText: 'Jo\'natish',
            allowOutsideClick: false
        }).then((rejEvent)=>{
            if (rejEvent.isConfirmed){
                let userRejectData = {
                    '_for_what': 'userReject',
                    'user_id': $(this)[0].attributes[1].nodeValue,
                    'message': rejEvent.value
                };
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.post('', userRejectData, function (userRejectResponse) {
                    if (userRejectResponse.answer === 'success'){
                        Swal.fire({
                            icon: 'success',
                            title: 'Muvaffaqiyat!',
                            text: 'Kitobxon so\'rovi bekor qilindi.',
                            allowOutsideClick: false
                        }).then((res)=>{
                            if (res.isConfirmed){
                                location.reload();
                            }
                        });
                    }
                    if (userRejectResponse.answer === ''){

                    }
                });
            }
        })


    });
    $('.user-accept').on('click', function () {
        let acceptUserData = {
            '_for_what': 'userAccept',
            'user_id': $(this)[0].attributes[1].nodeValue
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post('',acceptUserData, function (userAcceptResponse) {
            if (userAcceptResponse.answer === 'success'){
                Swal.fire({
                    icon: 'success',
                    title: 'Muvaffaqiyat!',
                    text: 'Yangi kitobxon tasdiqlandi.',
                    allowOutsideClick: false
                }).then((res)=>{
                   if (res.isConfirmed){
                       location.reload();
                   }
                });
            }
            if (userAcceptResponse.answer === 'empty'){
                location.reload();
            }
        })
    });
})
