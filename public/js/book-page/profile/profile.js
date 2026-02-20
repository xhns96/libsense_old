$(document).ready(function() {
    $('#all-Orders-Table').DataTable();
    /////////////////////////////////////////////////
    var userName = $('#user-name');
    var userPassportID = $('#user-passport-id');
    var userPhone = $('#user-phone');
    var userUniversityID = $('#user-university-id');
    var userFacultyID = $('#user-faculty-id');
    var userSpecialtyID = $('#user-specialty-id');
    var userCourseNumber = $('#user-course-number');
    var userGroupID = $('#user-group-id');
    var userPicture = $('#user-profile-image');
    var userPassport = $('#user-passport-image');
    /////////////////////////////////////////////////
    var currentUniversityID = null;
    var currentSpecialtyID = null;
    var filteredUniversityDATA = null;
    var filteredFaculties = null;
    var filteredSpecialties = null;
    var filteredGroups = null;

    /////////////////////////////////////////////////////////
    userUniversityID.on('change',function () {
        currentUniversityID = $(this).val();

        $(this).addClass('is-valid');

        userFacultyID.val('').attr('disabled', true);
        document.getElementById('user-faculty-id').selectedIndex = 0;

        userSpecialtyID.val('').attr('disabled',true);
        document.getElementById('user-specialty-id').selectedIndex = 0;

        userCourseNumber.val('').attr('disabled',true);
        document.getElementById('user-course-number').selectedIndex = 0;

        userGroupID.val('').attr('disabled',true);
        document.getElementById('user-group-id').selectedIndex = 0;

        let userUnivesityData = {
            '_for_what': 'getUniversityData',
            'university_id': currentUniversityID
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post('',userUnivesityData,function (recivedData) {
           if (recivedData.answer === 'success'){
                filteredUniversityDATA = recivedData.currentUniversity;
                filteredFaculties = recivedData.allFaculties;
                filteredSpecialties = recivedData.allSpecialties;
                filteredGroups = recivedData.allGroups;

                let dataForFacultySelect = `<option selected disabled>Fakultetni tanlang:</option>`;
                for (let i=0; i<filteredFaculties.length; i++){
                    dataForFacultySelect += `<option value="${filteredFaculties[i].id}">${filteredFaculties[i].faculty_name}</option>`
                }
                userFacultyID.html(dataForFacultySelect);
                userFacultyID.val('').attr('disabled', false);
                document.getElementById('user-faculty-id').selectedIndex = 0;
           }
           if (recivedData.answer === 'error'){

           }
        });
    });
    /////////////////////////////////////////////////////////
    userFacultyID.on('change',function () {
        let currentFacultyID = $(this).val();
        userSpecialtyID.val('').attr('disabled',true);
        document.getElementById('user-specialty-id').selectedIndex = 0;

        userCourseNumber.val('').attr('disabled',true);
        document.getElementById('user-course-number').selectedIndex = 0;

        userGroupID.val('').attr('disabled',true);
        document.getElementById('user-group-id').selectedIndex = 0;

        let dataForSpecialtiesSelect = `<option selected disabled>Yo'nalishni tanlang:</option>`;
        for (let i=0; i< filteredSpecialties.length; i++){
            if (parseInt(currentFacultyID) === parseInt(filteredSpecialties[i].specialty_faculty_id)){
                dataForSpecialtiesSelect += `<option value="${filteredSpecialties[i].id}">${filteredSpecialties[i].specialty_name}</option>`
            }
        }
        userSpecialtyID.html(dataForSpecialtiesSelect);
        userSpecialtyID.val('').attr('disabled',false);
        document.getElementById('user-specialty-id').selectedIndex = 0;
    });
    /////////////////////////////////////////////////////////
    userSpecialtyID.on('change',function () {
        currentSpecialtyID = $(this).val();

        userCourseNumber.val('').attr('disabled',true);
        document.getElementById('user-course-number').selectedIndex = 0;

        userGroupID.val('').attr('disabled',true);
        document.getElementById('user-group-id').selectedIndex = 0;

        let dataForCourseCountSelect = `<option selected disabled>Yo'nalishni tanlang:</option>`;
        for (let i=1; i<=filteredUniversityDATA.univer_course_count; i++){
            dataForCourseCountSelect += `<option value="${i}">${i}-bosqich</option>`
        }
        userCourseNumber.html(dataForCourseCountSelect);
        userCourseNumber.val('').attr('disabled',false);
        document.getElementById('user-course-number').selectedIndex = 0;
    });
    /////////////////////////////////////////////////////////
    userCourseNumber.on('change',function () {
        let currentCourseNumber = $(this).val();

        userGroupID.val('').attr('disabled',true);
        document.getElementById('user-group-id').selectedIndex = 0;

        let dataForGroupsSelect = `<option selected disabled>Guruhni tanlang:</option>`;
        for (let i=0; i< filteredGroups.length; i++){
            if (parseInt(currentSpecialtyID) === parseInt(filteredGroups[i].group_specialty_id) && parseInt(currentCourseNumber) === parseInt(filteredGroups[i].group_course_number)){
                dataForGroupsSelect += `<option value="${filteredGroups[i].id}">${filteredGroups[i].group_name}</option>`
            }
        }
        userGroupID.html(dataForGroupsSelect);
        userGroupID.val('').attr('disabled',false);
        document.getElementById('user-group-id').selectedIndex = 0;
    });
    /////////////////////////////////////////////////////////
    // userGroupID.on('change',function () {
    //     let currentFacultyID = $(this).val();
    //     userSpecialtyID.val('').attr('disabled',true);
    //     document.getElementById('user-specialty-id').selectedIndex = 0;
    //
    //     userCourseNumber.val('').attr('disabled',true);
    //     document.getElementById('user-course-number').selectedIndex = 0;
    //
    //     userGroupID.val('').attr('disabled',true);
    //     document.getElementById('user-group-id').selectedIndex = 0;
    //
    //     let dataForSpecialtiesSelect = `<option selected disabled>Yo'nalishni tanlang:</option>`;
    //     for (let i=0; i< filteredSpecialties.length; i++){
    //         if (parseInt(currentFacultyID) === parseInt(filteredSpecialties[i].specialty_faculty_id)){
    //             dataForSpecialtiesSelect += `<option value="${filteredSpecialties[i].id}">${filteredSpecialties[i].specialty_name}</option>`
    //         }
    //     }
    //     userSpecialtyID.html(dataForSpecialtiesSelect);
    //     userSpecialtyID.val('').attr('disabled',false);
    //     document.getElementById('user-specialty-id').selectedIndex = 0;
    // });
    ////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////
    $('form').ajaxForm({
        beforeSend: function () {

        },
        uploadProgress: function (event, position, total, percentComplete) {
            $('#edit-data-upload').text(percentComplete+'%').css('width', percentComplete+'%');
        },
        success: function (data) {
            if (data.answer === 'success'){
                Swal.fire({
                    icon: 'success',
                    title: 'Muvaffaqiyat',
                    text: `Barcha kiritgan ma'lumotlaringiz saqlandi.`,
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        location.reload();
                    }
                });
            }
            if (data.answer === 'empty'){
                Swal.fire({
                    icon: 'error',
                    title: 'Xatolik',
                    text: `HEMIS bazasida ma'lumotlar mavjud emas.`,
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        location.reload();
                    }
                });
            }
        }
    });

    $('.order-reject').on('click',function () {
        let orderData = {
            '_for_what': 'orderReject',
            'order_id': $(this)[0].attributes[1].nodeValue
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post('',orderData,function (orderRejectResponse) {
            if (orderRejectResponse.answer === 'success'){
                Swal.fire({
                    icon: 'success',
                    title: 'Muvaffaqiyat!',
                    text: 'Buyurtma bekor qilindi.',
                    allowOutsideClick: false
                }).then((rejRes)=>{
                    if (rejRes.isConfirmed){
                        location.reload();
                    }
                });
            }
            if (orderRejectResponse.answer === 'hacked'){
                Swal.fire({
                    icon: 'warning',
                    title: 'Ogohlantirish!',
                    text: 'Tizim ish jarayoniga tashqi aralashuv qayd qilindi, havfsizlik uchun tarmoq administratoriga murojat qiling.',
                    allowOutsideClick: false
                }).then((rejRes)=>{
                    if (rejRes.isConfirmed){
                        location.reload();
                    }
                });
            }
            if (orderRejectResponse.answer === 'empty'){
                location.reload();
            }
        })
    });
    $('.order-accept').on('click',function () {
    });

    $('#passport_number').inputmask("AA9999999");
    $('#passport_pin').inputmask("99999999999999");

});
