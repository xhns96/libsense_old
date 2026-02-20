$(document).ready(function () {

    $('#all-employees-table').dataTable();
    $('#new-admin-data-form').ajaxForm({
        beforeSend: function () {

        },
        uploadProgress: function (event, position, total, percentComplete) {

        },
        success: function (data) {
            if (data['answer']==='success'){
                Swal.fire({
                    icon: 'success',
                    title: `Muvaffaqiyat!`,
                    text: 'Yangi hodim ma\'lumotlari saqlandi.',
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        location.reload();
                    }
                });
            }
            if (data['answer']==='equal'){
                Swal.fire({
                    icon: 'info',
                    title: `O'xshashlik!`,
                    text: 'Kiritilgan elektron po\'chta manzili boshqa hodimga biriktirilgan.',
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        location.reload();
                    }
                });
            }
            if (data['answer']==='error'){
                Swal.fire({
                    icon: 'error',
                    title: `Xatolik!`,
                    text: 'Yangi hodim F.I.SH, elektron po\'chta manzili hamda parolni kiriting.',
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        location.reload();
                    }
                });
            }
            if (data['answer']==='invalid'){
                Swal.fire({
                    icon: 'error',
                    title: `Xatolik!`,
                    text: 'Ma\'lumotlarni to\'g\'ri kiriting.',
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        location.reload();
                    }
                });
            }
        }
    });
    $('#admin-change-form').ajaxForm({
        beforeSend: function () {

        },
        uploadProgress: function (event, position, total, percentComplete) {

        },
        success: function (data) {
            if (data['answer']==='success'){
                Swal.fire({
                    icon: 'success',
                    title: `Muvaffaqiyat!`,
                    text: 'Hodim ma\'lumotlari saqlandi.',
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        location.reload();
                    }
                });
            }
            if (data['answer']==='empty'){
                Swal.fire({
                    icon: 'error',
                    title: `Xatolik!`,
                    text: 'Hech qanday o\'zgartirish kiritmadingiz.',
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        location.reload();
                    }
                });
            }
        }
    });

    $("#all-employees-table").on("click", ".btn-admin", function(){
        let currentBtn = $(this)[0];
        let adminID = currentBtn.attributes[2].nodeValue;
        let adminName = currentBtn.attributes[3].nodeValue;
        if (currentBtn.attributes[1].nodeValue === 'edit-admin'){
            let allCampsData = {
                '_for_what': 'getAllCamps'
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('',allCampsData,function (res) {
                if (res.answer){
                    let allCampsData = `<option selected="" disabled>Arm bo'limini tanlang :</option>`;
                    for (let camps of res.answer) {
                        allCampsData+=`<option value="${camps.id}">${camps.campus_name}</option>`;
                    }
                    let adminChangeModalBody = `
                        <div class="col-12 ac">
                            <h4>${adminName}</h4>
                        </div>
                        <div class="col-12 mt-3">
                            <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="admin-campus-change" >
                                ${allCampsData}
                            </select>
                            <input type="text" class="d-none" name="admin-id" value="${adminID}">
                        </div>
                        <div class="col-12 mt-3">
                            <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="admin-profile-status-change" >
                                <option selected="" disabled>Hodim profil holati:</option>
                                <option class="text-success" value="active">Faol</option>
                                <option class="text-danger" value="inactive">Nofaol</option>
                            </select>
                        </div>
                    `;
                    $('#admin-change-modal-body').html(adminChangeModalBody);
                }
            })

        }

        if (currentBtn.attributes[1].nodeValue === 'delete-admin'){
            console.log(currentBtn.attributes[1].nodeValue);
            Swal.fire({
                title: 'Ishonchingiz komilmi?',
                text: "O'chirib yuborganingizdan so'ng, ushbu hodimning barcha ma'lumotlari o'chirilib yuboriladi va tiklash imkoniyati mavju bo'lmaydi.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f00',
                confirmButtonText: 'O\'chirish',
                cancelButtonText: 'Bekor qilish'
            }).then((result) => {
                if (result.isConfirmed) {
                    let deleteAdminData = {
                        '_for_what':'adminDelete',
                        'admin_id': currentBtn.attributes[2].nodeValue
                    }
                    console.log(deleteAdminData);
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.post('',deleteAdminData,function (reciveData) {
                        if (reciveData['answer']==='success'){
                            Swal.fire({
                                title:'Muvaffaqiyat!',
                                text:`Hodim, ma'lumotlar bazasidan o'chirildi.`,
                                icon:'success',
                                allowOutsideClick: false
                            }).then((deleteState)=>{
                                if (deleteState.isConfirmed){
                                    location.reload();
                                }
                            });
                        }
                        if (reciveData['answer']==='hacked'){
                            Swal.fire({
                                icon: 'warning',
                                title: 'Ogohlantirish!',
                                text: 'Tizim jarayoniga o\'zgartirish kiritishga urinildi, havfsizlik nuqtai nazaridan tarmoq administratoriga murojat qiling.',
                                allowOutsideClick: false
                            }).then((answerAfterPost)=>{
                                if (answerAfterPost.isConfirmed){
                                    location.reload();
                                }
                            });
                        }
                    });

                }
            })
        }
    });

});
