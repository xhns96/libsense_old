$(document).ready(function () {
    let allCampusesDiv = $('#all-campuses-div');
    let allFacultiesDiv = $('#all-facults-div');
    let allSpeialtiesDiv = $('#all-specialties-div');
    let allGroupsDiv = $('#all-groups-div');

    allFacultiesDiv.hide();
    allSpeialtiesDiv.hide();
    allGroupsDiv.hide();
    ///////////////////////////////////// DataTables ///////////////////////////////////////
    $('#all-campuses-table').dataTable()
    $('#all-facults-table').dataTable();
    $('#all-specialties-table').dataTable();
    $('#all-groups-table').dataTable();
    //-------------------------------------------------------------------------------------\\
    $('#univer-change-logo-form').ajaxForm({
        beforeSend: function () {

        },
        uploadProgress: function (event, position, total, percentComplete) {
            $('#logo-upload').text(percentComplete+'%').css('width', percentComplete+'%');
        },
        success: function (data) {
            if (data.answer === 'error'){
                $('.progress-bar').text('0%').css('width','0%');
                Swal.fire({
                    icon: 'error',
                    title: 'Xatolik!',
                    text: 'Logotip tanlanmadi.'
                });
            }
            if (data.answer === 'success'){
                Swal.fire({
                    icon: 'success',
                    title: 'Muvaffaqiyat!',
                    text: 'Logotip yangilandi.',
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        location.reload();
                    }
                });
            }

        }
    });
    $('#campus-change-form').ajaxForm({
        beforeSend: function () {

        },
        uploadProgress: function (event, position, total, percentComplete) {
        },
        success: function (data) {
            if (data.answer === 'equal'){
                Swal.fire({
                    icon: 'info',
                    title: 'O\'xshashlik',
                    text: 'Logotip tanlanmadi.'
                });
            }
            if (data.answer === 'hacked'){
                location.reload();
            }
            if (data.answer === 'success'){
                Swal.fire({
                    icon: 'success',
                    title: 'Muvaffaqiyat!',
                    text: 'ARM bo\'limi tahrirlandi.',
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        location.reload();
                    }
                });
            }

        }
    });
    //-------------------------------------------------------------------------------------\\
    $('input:radio').on('change',function (event) {
        if (this.id === 'campusesRadio'){
            allCampusesDiv.show();
            allFacultiesDiv.hide();
            allSpeialtiesDiv.hide();
            allGroupsDiv.hide();
        }
        if (this.id === 'facultiesRadio'){
            allCampusesDiv.hide();
            allFacultiesDiv.show();
            allSpeialtiesDiv.hide();
            allGroupsDiv.hide();
        }
        if (this.id === 'specialtiesRadio'){
            allCampusesDiv.hide();
            allFacultiesDiv.hide();
            allSpeialtiesDiv.show();
            allGroupsDiv.hide();
        }
        if (this.id === 'groupsRadio'){
            allCampusesDiv.hide();
            allFacultiesDiv.hide();
            allSpeialtiesDiv.hide();
            allGroupsDiv.show();
        }
    });

    $('#univer-name-submit').on('click',function () {
        let uName = $('#univer-name-input').val();
        if (uName.length === 0){
            Swal.fire({
                icon: 'error',
                title: 'Xatolik!',
                text: `Hech qanday ma'lumot kiritmadingiz.`,
                allowOutsideClick: false
            });
        }
        if (uName.length > 15){
            let uNameData = {
                '_for_what': 'changeUniverName',
                'univer_name': uName
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('',uNameData, function (data) {
                if (data.answer){
                    Swal.fire({
                        icon: 'success',
                        title: 'Muvaffaqiyat!',
                        text: `Ma'lumot muvaffaqiyat bilan saqlandi.`,
                        allowOutsideClick: false
                    }).then((e)=>{
                        if (e.isConfirmed){
                            location.reload();
                        }
                    })
                }
            });

        }
        else {
            Swal.fire({
                icon: 'error',
                title: 'Xatolik!',
                text: `Ma'lumot noto'g'ri kiritilgan.`,
                allowOutsideClick: false
            });
        }
    })
    $('#univer-short-name-submit').on('click',function () {
        let uShortName = $('#univer-short-name-input').val();
        if (uShortName.length === 0){
            Swal.fire({
                icon: 'error',
                title: 'Xatolik!',
                text: `Hech qanday ma'lumot kiritmadingiz.`,
                allowOutsideClick: false
            });
        }
        if (uShortName.length < 10){
            let uShortNameData = {
                '_for_what': 'changeUniverShortName',
                'univer_short_name': uShortName
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('',uShortNameData, function (data) {
                if (data.answer){
                    Swal.fire({
                        icon: 'success',
                        title: 'Muvaffaqiyat!',
                        text: `Ma'lumot muvaffaqiyat bilan saqlandi.`,
                        allowOutsideClick: false
                    }).then((e)=>{
                        if (e.isConfirmed){
                            location.reload();
                        }
                    })
                }
            });

        }
        else {
            Swal.fire({
                icon: 'error',
                title: 'Xatolik!',
                text: `Ma'lumot noto'g'ri kiritilgan.`,
                allowOutsideClick: false
            });
        }
    })
    $('#univer-course-count-submit').on('click',function () {
        let uCourseCount = $('#univer-course-count-select').val();
        if (uCourseCount == null){
            Swal.fire({
                icon: 'error',
                title: 'Xatolik!',
                text: `Hech qanday ma'lumot kiritmadingiz.`,
                allowOutsideClick: false
            });
        }
        if (uCourseCount != null){
            let uCourseCountData = {
                '_for_what': 'changeUniverCourseCount',
                'univer_course_count': uCourseCount
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('',uCourseCountData, function (data) {
                if (data.answer){
                    Swal.fire({
                        icon: 'success',
                        title: 'Muvaffaqiyat!',
                        text: `Ma'lumot muvaffaqiyat bilan saqlandi.`,
                        allowOutsideClick: false
                    }).then((e)=>{
                        if (e.isConfirmed){
                            location.reload();
                        }
                    })
                }
            });

        }

    })

    //////////////////////////////////// ARM bo'limi ////////////////////////////////////////
    $('#new-campus-name-input').on('input', function (e) {
        if ($('#new-campus-name-input').val().length < 5){
            $('#new-campus-name-input').addClass('is-invalid');
        }
        else {
            $('#new-campus-name-input').removeClass('is-invalid').addClass('is-valid');
        }
    })
    $('#new-campus-name-submit').click(function () {
        let newCampName = $('#new-campus-name-input');
        if (newCampName.val().length < 5 ){
            Swal.fire({
                icon: 'error',
                title: 'Xatolik!',
                text: `ARM bo'limi nomi noto'g'ri kiritilgan.`,
                allowOutsideClick: false
            });
            if (!newCampName.hasClass('is-invalid')){
                newCampName.addClass('is-invalid');
            }
        }
        else {
            $('#new-campus-name-submit').attr('disabled',true);
            $('#new-campus-name-input').attr('readonly',true);
            let newCampusData = {
                '_for_what': 'addNewCampus',
                'campus_name': $('#new-campus-name-input').val(),
                'campus_type': $('#select-campus-type').val()
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('',newCampusData,function (data) {
                if (data.answer){
                    switch (data.answer) {
                        case 'success':
                            Swal.fire({
                                icon: 'success',
                                title: 'Muvaffaqiyat!',
                                text: `ARM bo'limi, ma'lumotlar bazasiga qo'shildi.`,
                                allowOutsideClick: false
                            }).then((e)=>{
                                if (e.isConfirmed){
                                    location.reload();
                                }
                            });
                            break;
                        case 'equal':
                            Swal.fire({
                                icon: 'info',
                                title: 'O\'hshashlik!',
                                text: `Ushbu ARM bo'limi, ma'lumotlar bazasida mavjud.`,
                                allowOutsideClick: false
                            }).then((e)=>{
                                if (e.isConfirmed){
                                    location.reload();
                                }
                            });
                            break;
                        default:
                            break;
                    }
                }
                else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Xatolik!',
                        text: `Bog'lanishda xatolik yuz berdi.`,
                        allowOutsideClick: false
                    }).then((e)=>{
                        if (e.isConfirmed){
                            location.reload();
                        }
                    });
                }
            })
        }
    })

    //=============================== Edit/Delete Click Listener ===========================//
    $('.btn-campus').click(function (clickedButton) {
        let campusID = $(this).attr('data-id');
        let campusName = $(this).attr('data-edit-value');
        let campusForWhat = $(this).attr('data-for-what');
        if (campusForWhat === 'edit-campus') {
            let campusChangeModalBody = `
                <div class="col-12 ac">
                    <h4>${campusName}</h4>
                </div>
                <div class="col-12 mt-3">
                    <input type="text" autocomplete="off" name="campus-new-name" data-toggle="tooltip" data-placement="top" title="" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="ARM bo'limi yangi nomi:">
                    <input type="text" class="d-none" name="campus-id" value="${campusID}">
                    <input type="text" class="d-none" name="campus-for-what" value="${campusForWhat}">
                </div>
                <div class="col-12 mt-3">
                    <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="campus-type" >
                        <option selected="" disabled>Xona turi :</option>
                        <option value="abonement">Abonement</option>
                        <option value="oquvzal">O'quv zali</option>
                        <option value="boshqa">Boshqa</option>
                    </select>
                </div>

            `;
            $('#campus-change-modal-body').html(campusChangeModalBody);
            // Swal.fire({
            //     title: 'ARM bo\'limi!',
            //     text: 'Bo\'limning hozirgi nomi: '+campusName,
            //     input: 'text',
            //     inputLabel: 'Bo\'limning yangi nomi:',
            //     showCancelButton: true,
            //     cancelButtonText: 'Bekor qilish',
            //     confirmButtonText: 'Saqlash'
            // }).then((sweetData)=>{
            //    if (sweetData.isConfirmed){
            //        let typedNewCampusName = sweetData.value;
            //        if (typedNewCampusName){
            //            let changeCampusNameData = {
            //                '_for_what': 'campusNameChange',
            //                'campus_id': campusID,
            //                'campus_name': campusName,
            //                'campus_new_name': typedNewCampusName
            //            };
            //            $.ajaxSetup({
            //                headers: {
            //                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                }
            //            });
            //            $.post('',changeCampusNameData,function (recivedData) {
            //                if (recivedData.answer === 'success'){
            //                    Swal.fire({
            //                        icon: 'success',
            //                        title: 'Muvaffaqiyat!',
            //                        text: 'ARM bo\'limini nomi o\'zgartirildi.',
            //                        allowOutsideClick: false
            //                    }).then((sweetS)=>{
            //                        if (sweetS.isConfirmed){
            //                            location.reload();
            //                        }
            //                    });
            //                }
            //                if (recivedData.answer === 'equal'){
            //                    Swal.fire({
            //                        icon: 'info',
            //                        title: 'O\'hshashlik!',
            //                        text: `Ushbu ARM bo'limi, ma'lumotlar bazasida mavjud.`,
            //                        allowOutsideClick: false
            //                    }).then((e)=>{
            //                        if (e.isConfirmed){
            //                            location.reload();
            //                        }
            //                    });
            //                }
            //                if (recivedData.error === 'hacked'){
            //                    Swal.fire({
            //                        icon: 'warning',
            //                        title: 'Ogohlantirish!',
            //                        text: 'Kiruvchi ma\'lumotlar o\'zgartirilgan. Tizimning havfsizlik administratoriga murojat qiling!',
            //                        confirmButtonText: 'Tasdiqlash',
            //                        allowOutsideClick: false
            //                    }).then((sweetE)=>{
            //                       if (sweetE.isConfirmed){
            //                           location.reload();
            //                       }
            //                    });
            //                }
            //                if (recivedData.error === '404'){
            //                    Swal.fire({
            //                        icon: 'error',
            //                        title: 'Xatolik!',
            //                        text: 'ARM bo\'limi topilmadi.',
            //                        allowOutsideClick: false
            //                    }).then((sweetS)=>{
            //                        if (sweetS.isConfirmed){
            //                            location.reload();
            //                        }
            //                    });
            //                }
            //            });
            //        }
            //        else {
            //            Swal.fire({
            //                icon: 'info',
            //                title: 'Ma\'lumot!',
            //                text: 'Hech qanday o\'zgartirish kiritmadingiz!'
            //            });
            //        }
            //    }
            // });
        }
        if (campusForWhat === 'delete-campus'){
            Swal.fire({
                icon: 'warning',
                title: 'Ogohlantirish!',
                text: `ARM bo'limini o'chirganingizdan so'ng, ushbu bo'limga bog'liq bo'lgan ma'lumotlarni tiklash imkoniyati mavjud bo'lmaydi!`,
                showCancelButton: true,
                cancelButtonText: 'Bekor qilish',
                confirmButtonText: `Bo'limni o'chirish`,
                confirmButtonColor: '#f00',
                allowOutsideClick: false
            }).then((sweetD)=>{
                if (sweetD.isConfirmed){
                    let deletedCampusData = {
                        '_for_what': 'campusDelete',
                        'campus_id': campusID,
                        'campus_name': campusName
                    }
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.post('',deletedCampusData,function (recivedData) {
                        if (recivedData.answer === 'success'){
                            Swal.fire({
                                icon: 'success',
                                title: 'Muvaffaqiyat!',
                                text: `ARM bo'limi ma'lumotlar bazasidan o'chirildi.`,
                                allowOutsideClick: false
                            }).then((sweetS)=>{
                               if (sweetS.isConfirmed){
                                   location.reload();
                               }
                            });
                        }
                        if (recivedData.error === 'hacked'){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Ogohlantirish!',
                                text: 'Kiruvchi ma\'lumotlar o\'zgartirilgan. Tizimning havfsizlik administratoriga murojat qiling!',
                                confirmButtonText: 'Tasdiqlash',
                                allowOutsideClick: false
                            }).then((sweetE)=>{
                                if (sweetE.isConfirmed){
                                    location.reload();
                                }
                            });
                        }
                        if (recivedData.error === '404'){
                            Swal.fire({
                                icon: 'error',
                                title: 'Xatolik!',
                                text: 'ARM bo\'limi topilmadi.',
                                allowOutsideClick: false
                            }).then((sweetS)=>{
                                if (sweetS.isConfirmed){
                                    location.reload();
                                }
                            });
                        }
                    })
                }
            });
        }
    })
    //--------------------------------------------------------------------------------------\\

    ///////////////////////////////// Fakultetlar bo'limi ////////////////////////////////////
    $('#new-faculty-name-input').on('input', function (e) {
        if ($('#new-faculty-name-input').val().length < 2){
            $('#new-faculty-name-input').addClass('is-invalid');
        }
        else {
            $('#new-faculty-name-input').removeClass('is-invalid').addClass('is-valid');
        }
    });
    $('#new-faculty-name-submit').click(function () {
        let newFacultyName = $('#new-faculty-name-input');
        if (newFacultyName.val().length < 2 ){
            Swal.fire({
                icon: 'error',
                title: 'Xatolik!',
                text: `Fakultet nomi noto'g'ri kiritilgan.`,
                allowOutsideClick: false
            });
            if (!newFacultyName.hasClass('is-invalid')){
                newFacultyName.addClass('is-invalid');
            }
        }
        else {
            $('#new-faculty-name-submit').attr('disabled',true);
            $('#new-faculty-name-input').attr('readonly',true);
            let newFacultyData = {
                '_for_what': 'addNewFaculty',
                'faculty_name': $('#new-faculty-name-input').val()
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('',newFacultyData,function (recivedData) {
                if (recivedData.answer === 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'Muvaffaqiyat!',
                        text: `Fakultet, ma'lumotlar bazasiga qo'shildi.`,
                        allowOutsideClick: false
                    }).then((e)=> {
                        if (e.isConfirmed) {
                            location.reload();
                        }
                    });
                }
                if (recivedData.answer === 'equal'){
                    Swal.fire({
                        icon: 'info',
                        title: 'O\'hshashlik!',
                        text: `Ushbu fakultet, ma'lumotlar bazasida mavjud.`,
                        allowOutsideClick: false
                    }).then((e)=>{
                        if (e.isConfirmed){
                            location.reload();
                        }
                    });
                }
                // if (false) {
                //     Swal.fire({
                //         icon: 'error',
                //         title: 'Xatolik!',
                //         text: `Bog'lanishda xatolik yuz berdi.`,
                //         allowOutsideClick: false
                //     }).then((e)=>{
                //         if (e.isConfirmed){
                //             location.reload();
                //         }
                //     });
                // }
            });
        }
    });
    //============================== Edit/Delete btn click listener =========================//
    $('.btn-faculty').click(function () {
        let facultyForWhat = $(this).attr('data-for-what');
        let facultyID = $(this).attr('data-id');
        let facultyName = $(this).attr('data-edit-value');
        if (facultyForWhat === 'edit-faculty'){
            Swal.fire({
                title: 'Fakultet nomi',
                text: 'Fakultetning hozirgi nomi: '+facultyName,
                input: 'text',
                inputLabel: 'Fakultetning yangi nomi:',
                showCancelButton: true,
                cancelButtonText: 'Bekor qilish',
                confirmButtonText: 'Saqlash'
            }).then((sweetData)=>{
                if (sweetData.isConfirmed){
                    let typedNewFacultyName = sweetData.value;
                    if (typedNewFacultyName){
                        let changeFacultyNameData = {
                            '_for_what': 'facultyNameChange',
                            'faculty_id': facultyID,
                            'faculty_name': facultyName,
                            'faculty_new_name': typedNewFacultyName
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.post('',changeFacultyNameData,function (recivedData) {
                            if (recivedData.answer === 'success'){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Muvaffaqiyat!',
                                    text: 'Fakultet nomi o\'zgartirildi.',
                                    allowOutsideClick: false
                                }).then((sweetS)=>{
                                    if (sweetS.isConfirmed){
                                        location.reload();
                                    }
                                });
                            }
                            if (recivedData.answer === 'equal'){
                                Swal.fire({
                                    icon: 'info',
                                    title: 'O\'hshashlik!',
                                    text: `Ushbu fakultet, ma'lumotlar bazasida mavjud.`,
                                    allowOutsideClick: false
                                }).then((e)=>{
                                    if (e.isConfirmed){
                                        location.reload();
                                    }
                                });
                            }
                            if (recivedData.error === 'hacked'){
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Ogohlantirish!',
                                    text: 'Kiruvchi ma\'lumotlar o\'zgartirilgan. Tizimning havfsizlik administratoriga murojat qiling!',
                                    confirmButtonText: 'Tasdiqlash',
                                    allowOutsideClick: false
                                }).then((sweetE)=>{
                                    if (sweetE.isConfirmed){
                                        location.reload();
                                    }
                                });
                            }
                            if (recivedData.error === '404'){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Xatolik!',
                                    text: 'Fakultet topilmadi.',
                                    allowOutsideClick: false
                                }).then((sweetS)=>{
                                    if (sweetS.isConfirmed){
                                        location.reload();
                                    }
                                });
                            }
                        });
                    }
                    else {
                        Swal.fire({
                            icon: 'info',
                            title: 'Ma\'lumot!',
                            text: 'Hech qanday o\'zgartirish kiritmadingiz!'
                        });
                    }
                }
            });
        }
        if (facultyForWhat === 'delete-faculty'){
            Swal.fire({
                icon: 'warning',
                title: 'Ogohlantirish!',
                text: `Fakultetni o'chirganingizdan so'ng, ushbu fakultetga bog'liq bo'lgan ma'lumotlarni tiklash imkoniyati mavjud bo'lmaydi!`,
                showCancelButton: true,
                cancelButtonText: 'Bekor qilish',
                confirmButtonText: `Fakultetni o'chirish`,
                confirmButtonColor: '#f00',
                allowOutsideClick: false
            }).then((sweetD)=>{
                if (sweetD.isConfirmed){
                    let deletedFacutyData = {
                        '_for_what': 'facultyDelete',
                        'faculty_id': facultyID,
                        'faculty_name': facultyName
                    }
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.post('',deletedFacutyData,function (recivedData) {
                        if (recivedData.answer === 'success'){
                            Swal.fire({
                                icon: 'success',
                                title: 'Muvaffaqiyat!',
                                text: `Fakultet, ma'lumotlar bazasidan o'chirildi.`,
                                allowOutsideClick: false
                            }).then((sweetS)=>{
                                if (sweetS.isConfirmed){
                                    location.reload();
                                }
                            });
                        }
                        if (recivedData.error === 'hacked'){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Ogohlantirish!',
                                text: 'Kiruvchi ma\'lumotlar o\'zgartirilgan. Tizimning havfsizlik administratoriga murojat qiling!',
                                confirmButtonText: 'Tasdiqlash',
                                allowOutsideClick: false
                            }).then((sweetE)=>{
                                if (sweetE.isConfirmed){
                                    location.reload();
                                }
                            });
                        }
                        if (recivedData.error === '404'){
                            Swal.fire({
                                icon: 'error',
                                title: 'Xatolik!',
                                text: 'ARM bo\'limi topilmadi.',
                                allowOutsideClick: false
                            }).then((sweetS)=>{
                                if (sweetS.isConfirmed){
                                    location.reload();
                                }
                            });
                        }
                    })
                }
            });
        }
    });
    //---------------------------------------------------------------------------------------\\

    ///////////////////////////////// Yo'nalishlar bo'limi ////////////////////////////////////
    $('#new-specialty-name-input').on('input', function (e) {
        if ($('#new-specialty-name-input').val().length < 2){
            $('#new-specialty-name-input').addClass('is-invalid');
        }
        else {
            $('#new-specialty-name-input').removeClass('is-invalid').addClass('is-valid');
        }
    });
    $('#faculty-name-for-new-specialty').on('change', function (e) {
        if ($('#faculty-name-for-new-specialty').val()==null){
            $('#faculty-name-for-new-specialty').addClass('is-invalid');
        }
        else {
            $('#faculty-name-for-new-specialty').removeClass('is-invalid').addClass('is-valid');
        }
    });
    $('#new-specialty-name-submit').click(function () {
        let facultyID = $('#faculty-name-for-new-specialty');
        let newSpecName = $('#new-specialty-name-input');
        if (newSpecName.val().length < 2 || facultyID.val() == null){
            Swal.fire({
                icon: 'error',
                title: 'Xatolik!',
                text: `Fakultet yoki yo'nalish nomi noto'g'ri kiritilgan.`,
                allowOutsideClick: false
            });
            if (!newSpecName.hasClass('is-invalid')){
                newSpecName.addClass('is-invalid');
            }
            if (facultyID.val()==null && !facultyID.hasClass('is-invalid')){
                facultyID.addClass('is-invalid');
            }
        }
        else {
            $('#new-specialty-name-submit').attr('disabled',true);
            $('#new-specialty-name-input').attr('readonly',true);
            let newSpecData = {
                '_for_what': 'addNewSpecialty',
                'faculty_id': facultyID.val(),
                'specialty_name': newSpecName.val()
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('',newSpecData,function (recivedData) {
                if (recivedData.answer === 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'Muvaffaqiyat!',
                        text: 'Yo\'nalish kiritildi.',
                        allowOutsideClick: false
                    }).then((sweetS)=>{
                        if (sweetS.isConfirmed){
                            location.reload();
                        }
                    });
                }
                if (recivedData.answer === 'equal'){
                    Swal.fire({
                        icon: 'info',
                        title: 'O\'hshashlik!',
                        text: `Ushbu yo'nalish, ma'lumotlar bazasida mavjud.`,
                        allowOutsideClick: false
                    }).then((e)=>{
                        if (e.isConfirmed){
                            location.reload();
                        }
                    });
                }
                if (recivedData.error === 'hacked'){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Ogohlantirish!',
                        text: 'Kiruvchi ma\'lumotlar o\'zgartirilgan. Tizimning havfsizlik administratoriga murojat qiling!',
                        confirmButtonText: 'Tasdiqlash',
                        allowOutsideClick: false
                    }).then((sweetE)=>{
                        if (sweetE.isConfirmed){
                            location.reload();
                        }
                    });
                }
                if (recivedData.error === '404'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Xatolik!',
                        text: 'Yo\'nalish topilmadi.',
                        allowOutsideClick: false
                    }).then((sweetS)=>{
                        if (sweetS.isConfirmed){
                            location.reload();
                        }
                    });
                }
            });
        }
    });
    //================================ Edit/Delete btn click listener ========================//
    $('.btn-specialty').click(function () {
        let specialtyID = $(this).attr('data-id');
        let specialtyName = $(this).attr('data-edit-value');
        let specialtyForWhat = $(this).attr('data-for-what');
        if (specialtyForWhat === 'edit-specialty'){
            Swal.fire({
                title: 'Yo\'nalish nomi',
                text: 'Yo\'nalishning hozirgi nomi: '+specialtyName,
                input: 'text',
                inputLabel: 'Yo\'nalishning yangi nomi:',
                showCancelButton: true,
                cancelButtonText: 'Bekor qilish',
                confirmButtonText: 'Saqlash'
            }).then((sweetData)=>{
                if (sweetData.isConfirmed){
                    let typedNewSpecialtyName = sweetData.value;
                    if (typedNewSpecialtyName){
                        let changeSpecialtyNameData = {
                            '_for_what': 'specialtyNameChange',
                            'specialty_id': specialtyID,
                            'specialty_name': specialtyName,
                            'specialty_new_name': typedNewSpecialtyName
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.post('',changeSpecialtyNameData,function (recivedData) {
                            console.log(recivedData.data);
                            if (recivedData.answer === 'success'){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Muvaffaqiyat!',
                                    text: 'Yo\'nalish nomi o\'zgartirildi.',
                                    allowOutsideClick: false
                                }).then((sweetS)=>{
                                    if (sweetS.isConfirmed){
                                        location.reload();
                                    }
                                });
                            }
                            if (recivedData.answer === 'equal'){
                                Swal.fire({
                                    icon: 'info',
                                    title: 'O\'hshashlik!',
                                    text: `Ushbu yo'nalish, ma'lumotlar bazasida mavjud.`,
                                    allowOutsideClick: false
                                }).then((e)=>{
                                    if (e.isConfirmed){
                                        location.reload();
                                    }
                                });
                            }
                            if (recivedData.error === 'hacked'){
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Ogohlantirish!',
                                    text: 'Kiruvchi ma\'lumotlar o\'zgartirilgan. Tizimning havfsizlik administratoriga murojat qiling!',
                                    confirmButtonText: 'Tasdiqlash',
                                    allowOutsideClick: false
                                }).then((sweetE)=>{
                                    if (sweetE.isConfirmed){
                                        console.log(recivedData.error);
                                        //location.reload();
                                    }
                                });
                            }
                            if (recivedData.error === '404'){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Xatolik!',
                                    text: 'Fakultet topilmadi.',
                                    allowOutsideClick: false
                                }).then((sweetS)=>{
                                    if (sweetS.isConfirmed){
                                        location.reload();
                                    }
                                });
                            }
                        });
                    }
                    else {
                        Swal.fire({
                            icon: 'info',
                            title: 'Ma\'lumot!',
                            text: 'Hech qanday o\'zgartirish kiritmadingiz!'
                        });
                    }
                }
            });
        }
        if (specialtyForWhat === 'delete-specialty'){
            Swal.fire({
                icon: 'warning',
                title: 'Ogohlantirish!',
                text: `Yo'nalishni o'chirganingizdan so'ng, ushbu fakultetga bog'liq bo'lgan ma'lumotlarni tiklash imkoniyati mavjud bo'lmaydi!`,
                showCancelButton: true,
                cancelButtonText: 'Bekor qilish',
                confirmButtonText: `Yo'nalishni o'chirish`,
                confirmButtonColor: '#f00',
                allowOutsideClick: false
            }).then((sweetD)=>{
                if (sweetD.isConfirmed){
                    let deletedSpecialtyData = {
                        '_for_what': 'specialtyDelete',
                        'specialty_id': specialtyID,
                        'specialty_name': specialtyName
                    }
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.post('',deletedSpecialtyData,function (recivedData) {
                        if (recivedData.answer === 'success'){
                            Swal.fire({
                                icon: 'success',
                                title: 'Muvaffaqiyat!',
                                text: `Yo'nalish, ma'lumotlar bazasidan o'chirildi.`,
                                allowOutsideClick: false
                            }).then((sweetS)=>{
                                if (sweetS.isConfirmed){
                                    location.reload();
                                }
                            });
                        }
                        if (recivedData.error === 'hacked'){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Ogohlantirish!',
                                text: 'Kiruvchi ma\'lumotlar o\'zgartirilgan. Tizimning havfsizlik administratoriga murojat qiling!',
                                confirmButtonText: 'Tasdiqlash',
                                allowOutsideClick: false
                            }).then((sweetE)=>{
                                if (sweetE.isConfirmed){
                                    location.reload();
                                }
                            });
                        }
                        if (recivedData.error === '404'){
                            Swal.fire({
                                icon: 'error',
                                title: 'Xatolik!',
                                text: 'Yo\'nalish topilmadi.',
                                allowOutsideClick: false
                            }).then((sweetS)=>{
                                if (sweetS.isConfirmed){
                                    location.reload();
                                }
                            });
                        }
                    });
                }
            });
        }
    });
    //-----------------------------------------------------------------------------------------\\

    ////////////////////////////////// Guruhlar bo'limi /////////////////////////////////////////
    $('#new-group-name-input').on('input', function (e) {
        if ($('#new-group-name-input').val().length < 2){
            $('#new-group-name-input').addClass('is-invalid');
        }
        else {
            $('#new-group-name-input').removeClass('is-invalid').addClass('is-valid');
        }
    });
    $('#select-faculty-for-new-group').on('change', function (e) {
        if ($('#select-faculty-for-new-group').val()==null){
            $('#select-faculty-for-new-group').addClass('is-invalid');
        }
        else {
            $('#select-faculty-for-new-group').removeClass('is-invalid').addClass('is-valid');
            $.get('settingsGetFSData/',function (recivedData) {
                let filteredSpecialties = recivedData.allSpecialties;
                let fitleredSpecialtiesView = `<option selected="" disabled>Yo'nalishni tanlang:</option>`;
                for (let i=0; i<filteredSpecialties.length; i++){
                    if (parseInt($('#select-faculty-for-new-group').val()) === parseInt(filteredSpecialties[i].specialty_faculty_id)){
                        fitleredSpecialtiesView += `<option value="${filteredSpecialties[i].id}">${filteredSpecialties[i].specialty_name}</option>`;
                    }
                }
                $('#select-specialty-for-new-group').html(fitleredSpecialtiesView);
            });
            document.getElementById('select-specialty-for-new-group').selectedIndex = 0;
            $('#select-specialty-for-new-group').attr('disabled',false).removeClass('is-valid').removeClass('is-invalid');

            document.getElementById('select-course-number-for-new-group').selectedIndex = 0;
            $('#select-course-number-for-new-group').attr('disabled',true).removeClass('is-valid').removeClass('is-invalid');

            $('#new-group-name-input').val('').attr('readonly',true).removeClass('is-valid').removeClass('is-invalid');
        }
    });
    $('#select-specialty-for-new-group').on('change', function (e) {
        if ($('#select-specialty-for-new-group').val()==null){
            $('#select-specialty-for-new-group').addClass('is-invalid');
        }
        else {
            $('#select-specialty-for-new-group').removeClass('is-invalid').addClass('is-valid');
            document.getElementById('select-course-number-for-new-group').selectedIndex = 0;
            $('#select-course-number-for-new-group').attr('disabled',false).removeClass('is-valid').removeClass('is-invalid');
            $('#new-group-name-input').val('').attr('readonly',true).removeClass('is-valid').removeClass('is-invalid');
        }
    });
    $('#select-course-number-for-new-group').on('change', function (e) {
        if ($('#select-course-number-for-new-group').val()==null){
            $('#select-course-number-for-new-group').addClass('is-invalid');
        }
        else {
            $('#select-course-number-for-new-group').removeClass('is-invalid').addClass('is-valid');
            $('#new-group-name-input').val('').attr('readonly',false).removeClass('is-valid').removeClass('is-invalid');
        }
    });
    $('#new-group-name-submit').click(function () {
        let facultyID = $('#select-faculty-for-new-group');
        let specialtyID = $('#select-specialty-for-new-group');
        let courseID = $('#select-course-number-for-new-group');
        let newGroupName = $('#new-group-name-input');
        if (newGroupName.val().length < 2 || facultyID.val() == null || specialtyID.val() == null || courseID.val() == null){
            Swal.fire({
                icon: 'error',
                title: 'Xatolik!',
                text: `Ma'lumotlar kiritilmagan.`,
                allowOutsideClick: false
            });
            if (!newGroupName.hasClass('is-invalid')){
                newGroupName.addClass('is-invalid');
            }
            if (facultyID.val()==null && !facultyID.hasClass('is-invalid')){
                facultyID.addClass('is-invalid');
            }
            if (specialtyID.val()==null && !specialtyID.hasClass('is-invalid')){
                specialtyID.addClass('is-invalid');
            }
            if (courseID.val()==null && !courseID.hasClass('is-invalid')){
                courseID.addClass('is-invalid');
            }
        }
        else {
            $('#new-group-name-submit').attr('disabled',true);
            $('#new-group-name-input').attr('readonly',true);
            let newGroupData = {
                '_for_what': 'addNewGroup',
                'faculty_id': facultyID.val(),
                'specialty_id': specialtyID.val(),
                'course_number': courseID.val(),
                'group_name': newGroupName.val()
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('',newGroupData,function (recivedData) {
                if (recivedData.answer === 'success'){
                    Swal.fire({
                        icon: 'success',
                        title: 'Muvaffaqiyat!',
                        text: 'Guruh kiritildi.',
                        allowOutsideClick: false
                    }).then((sweetS)=>{
                        if (sweetS.isConfirmed){
                            location.reload();
                        }
                    });
                }
                if (recivedData.answer === 'equal'){
                    Swal.fire({
                        icon: 'info',
                        title: 'O\'hshashlik!',
                        text: `Ushbu yo'nalish, ma'lumotlar bazasida mavjud.`,
                        allowOutsideClick: false
                    }).then((e)=>{
                        if (e.isConfirmed){
                            location.reload();
                        }
                    });
                }
                if (recivedData.error === 'hacked'){
                    Swal.fire({
                        icon: 'warning',
                        title: 'Ogohlantirish!',
                        text: 'Kiruvchi ma\'lumotlar o\'zgartirilgan. Tizimning havfsizlik administratoriga murojat qiling!',
                        confirmButtonText: 'Tasdiqlash',
                        allowOutsideClick: false
                    }).then((sweetE)=>{
                        if (sweetE.isConfirmed){
                            location.reload();
                        }
                    });
                }
                if (recivedData.error === '404'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Xatolik!',
                        text: 'Yo\'nalish topilmadi.',
                        allowOutsideClick: false
                    }).then((sweetS)=>{
                        if (sweetS.isConfirmed){
                            location.reload();
                        }
                    });
                }
            });
        }
    });
    //============================== Edit/Delete click listener ================================//
    $('.btn-groups').click(function () {
        let groupID = $(this).attr('data-id');
        let groupName = $(this).attr('data-edit-value');
        let groupForWhat = $(this).attr('data-for-what');
        if (groupForWhat === 'edit-group'){
            Swal.fire({
                title: 'Guruh nomi',
                text: 'Guruhning hozirgi nomi: '+groupName,
                input: 'text',
                inputLabel: 'Guruhning yangi nomi:',
                showCancelButton: true,
                cancelButtonText: 'Bekor qilish',
                confirmButtonText: 'Saqlash'
            }).then((sweetData)=>{
                if (sweetData.isConfirmed){
                    let typedNewGroupName = sweetData.value;
                    if (typedNewGroupName){
                        let changeGroupNameData = {
                            '_for_what': 'groupNameChange',
                            'group_id': groupID,
                            'group_name': groupName,
                            'group_new_name': typedNewGroupName
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.post('',changeGroupNameData,function (recivedData) {
                            if (recivedData.answer === 'success'){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Muvaffaqiyat!',
                                    text: 'Guruh nomi o\'zgartirildi.',
                                    allowOutsideClick: false
                                }).then((sweetS)=>{
                                    if (sweetS.isConfirmed){
                                        location.reload();
                                    }
                                });
                            }
                            if (recivedData.answer === 'equal'){
                                Swal.fire({
                                    icon: 'info',
                                    title: 'O\'hshashlik!',
                                    text: `Ushbu guruh, ma'lumotlar bazasida mavjud.`,
                                    allowOutsideClick: false
                                }).then((e)=>{
                                    if (e.isConfirmed){
                                        location.reload();
                                    }
                                });
                            }
                            if (recivedData.error === 'hacked'){
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Ogohlantirish!',
                                    text: 'Kiruvchi ma\'lumotlar o\'zgartirilgan. Tizimning havfsizlik administratoriga murojat qiling!',
                                    confirmButtonText: 'Tasdiqlash',
                                    allowOutsideClick: false
                                }).then((sweetE)=>{
                                    if (sweetE.isConfirmed){
                                        console.log(recivedData.error);
                                        //location.reload();
                                    }
                                });
                            }
                            if (recivedData.error === '404'){
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Xatolik!',
                                    text: 'Guruh topilmadi.',
                                    allowOutsideClick: false
                                }).then((sweetS)=>{
                                    if (sweetS.isConfirmed){
                                        location.reload();
                                    }
                                });
                            }
                        });
                    }
                    else {
                        Swal.fire({
                            icon: 'info',
                            title: 'Ma\'lumot!',
                            text: 'Hech qanday o\'zgartirish kiritmadingiz!'
                        });
                    }
                }
            });
        }
        if (groupForWhat === 'delete-group'){
            Swal.fire({
                icon: 'warning',
                title: 'Ogohlantirish!',
                text: `Guruhni o'chirganingizdan so'ng, ushbu guruhga bog'liq bo'lgan ma'lumotlarni tiklash imkoniyati mavjud bo'lmaydi!`,
                showCancelButton: true,
                cancelButtonText: 'Bekor qilish',
                confirmButtonText: `Guruhni o'chirish`,
                confirmButtonColor: '#f00',
                allowOutsideClick: false
            }).then((sweetD)=>{
                if (sweetD.isConfirmed){
                    let deletedGroupData = {
                        '_for_what': 'groupDelete',
                        'group_id': groupID,
                        'group_name': groupName
                    }
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.post('',deletedGroupData,function (recivedData) {
                        if (recivedData.answer === 'success'){
                            Swal.fire({
                                icon: 'success',
                                title: 'Muvaffaqiyat!',
                                text: `Guruh, ma'lumotlar bazasidan o'chirildi.`,
                                allowOutsideClick: false
                            }).then((sweetS)=>{
                                if (sweetS.isConfirmed){
                                    location.reload();
                                }
                            });
                        }
                        if (recivedData.error === 'hacked'){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Ogohlantirish!',
                                text: 'Kiruvchi ma\'lumotlar o\'zgartirilgan. Tizimning havfsizlik administratoriga murojat qiling!',
                                confirmButtonText: 'Tasdiqlash',
                                allowOutsideClick: false
                            }).then((sweetE)=>{
                                if (sweetE.isConfirmed){
                                    location.reload();
                                }
                            });
                        }
                        if (recivedData.error === '404'){
                            Swal.fire({
                                icon: 'error',
                                title: 'Xatolik!',
                                text: 'Guruh topilmadi.',
                                allowOutsideClick: false
                            }).then((sweetS)=>{
                                if (sweetS.isConfirmed){
                                    location.reload();
                                }
                            });
                        }
                    });
                }
            });
        }
    });
    //------------------------------------------------------------------------------------------\\



});
