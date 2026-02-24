$(document).ready(function () {
    $('#all-ebooks-table').dataTable().css('display','table');
    $('#choosed-book-modal').on('hide.bs.modal',function () {
        $('#choosed-book-content-div').html('');
    })

    $("#all-ebooks-table").on("click", ".btn-book", function(){
        let currentButton = $(this)[0];
        let currentBookID = $(this)[0].attributes[1].nodeValue;
        //////////////////////////////// Edit Book //////////////////////////////////
        if (currentButton.attributes[0].nodeValue==='edit-book'){
            let choosedBookData = {
                '_for_what': 'changeBook',
                'book-id': currentBookID
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('',choosedBookData,function (recivedData) {
                if (recivedData.answer === 'hacked'){
                    throw Swal.fire({
                        icon: 'error',
                        title: 'Xatolik!',
                        text: 'Tarmoqda kutilmagan xatolik!',
                        allowOutsideClick: false
                    }).then((he)=>{
                        if (he.isConfirmed){
                            location.reload();
                        }
                    });
                }
                else{

                    let bookISBN = '';
                    if (recivedData.answer['ebook_isbn']){
                        bookISBN = recivedData.answer['ebook_isbn'];
                    }
                    let allCampuses =`<select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="book-campus-id" id="book-campus-id" data-toggle="tooltip" data-placement="right" data-original-title="Adabiyot tili.">
                        <option selected disabled>ARM bo'limi...</option>`;
                    for (let currentCampus of recivedData.allCampuses){
                        allCampuses += `<option value="${currentCampus['id']}">${currentCampus['campus_name']}</option>`;
                    }
                    allCampuses +=`</select>`;

                    let modalContent = `
                                    <div class="col-12 mt-2 ac">
                                        <h2 class="text-uppercase">Adabiyotni tahrirlash</h2>
                                    </div>
                                    <div class="col-6 mt-2 d-none">
                                        <input type="text" name="form-book-id" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" value="${recivedData.answer['id']}">
                                    </div>
                                    <div class="col-6 mt-2">
                                        <input type="text" autocomplete="off" name="book-name" id="book-name" data-toggle="tooltip" data-placement="top" title="" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Adabiyot nomi:" value="${recivedData.answer['ebook_name']}" data-original-title="Adabiyot nomi.">
                                    </div>
                                    <div class="col-6 mt-2">
                                        <input type="text" autocomplete="off" name="book-author" id="book-author" data-toggle="tooltip" data-placement="top" title="" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Adabiyot muallifi:" value="${recivedData.answer['ebook_author']}" data-original-title="Adabiyot muallifi.">
                                    </div>

                                    <div class="col-6 mt-2">
                                        <input type="text" autocomplete="off" name="book-isbn" id="book-isbn" data-toggle="tooltip" data-placement="left" title="" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Adabiyot ISBN raqami:" value="${bookISBN}" data-original-title="Adabiyot ISBN raqami.">
                                    </div>
                                    <div class="col-3 mt-2">
                                        <input type="number" autocomplete="off" name="book-page-count" id="book-page-count" data-toggle="tooltip" data-placement="top" title="" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Adabiyot bet soni:" value="${recivedData.answer['ebook_page_count']}" data-original-title="Adabiyot bet soni.">
                                    </div>
                                    <div class="col-3 mt-2">

                                    </div>
                                    <div class="col-3 mt-2">
                                        <input type="text" autocomplete="off" name="book-publishing" id="book-publishing" data-toggle="tooltip" data-placement="left" title="" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Adabiyot nashriyoti:" value="${recivedData.answer['ebook_publishing']}" data-original-title="Adabiyot nashriyoti.">
                                    </div>
                                    <div class="col-3 mt-2">
                                        <input type="number" autocomplete="off" name="book-year" id="book-year" data-toggle="tooltip" data-placement="right" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" placeholder="Adabiyot nashr yili:" value="${recivedData.answer['ebook_year']}" data-original-title="Adabiyot nashr yili.">
                                    </div>
                                    <div class="col-6 mt-2">

                                    </div>

                                    <div class="col-4 mt-2">
                                        <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="book-type" id="book-page-type" data-toggle="tooltip" data-placement="left" data-original-title="Adabiyot ko'rinishi." disabled>
                                            <option selected disabled>Adabiyot ko'rinishi...</option>
                                            <option value="1">Bosma taboq (qog'oz)</option>
                                            <option value="2">Elektron adabiyot</option>
                                        </select>
                                    </div>
                                    <div class="col-4 mt-2">
                                        <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="is-book-primary" id="is-book-primary" data-toggle="tooltip" data-placement="top" data-original-title="Adabiyot asosiymi ?">
                                            <option selected disabled>Adabiyot asosiymi ?</option>
                                            <option value="1">Ha</option>
                                            <option value="2">Yo'q</option>
                                        </select>
                                    </div>
                                    <div class="col-4 mt-2">
                                        <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="book-lang" id="book-lang" data-toggle="tooltip" data-placement="right" data-original-title="Adabiyot tili.">
                                            <option selected disabled>Adabiyot tili...</option>
                                            <option value="uz_l">O'zbek tilida (Lotin)</option>
                                            <option value="uz_k">O'zbek tilida (Kirill)</option>
                                            <option value="ru">Rus tilida</option>
                                            <option value="en">Ingliz tilida</option>
                                            <option value="al">Arab tilida</option>
                                            <option value="fr">Fransuz tilida</option>
                                            <option value="de">Nemis tilida</option>
                                            <option value="kr">Koreys tilida</option>
                                            <option value="cn">Xitoy tilida</option>
                                            <option value="jp">Yapon tilida</option>
                                            <option value="x_l">Boshqa tilda</option>
                                        </select>
                                    </div>

                                    <div class="col-4 mt-2">
                                        <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="book-category" id="book-category" data-toggle="tooltip" data-placement="left" data-original-title="Adabiyot tili.">
                                            <option selected disabled>Adabiyot turi...</option>
                                            <option value="1">Darslik</option>
                                            <option value="2">O'quv qo'llanma</option>
                                            <option value="3">O'quv uslubiy qo'llanma</option>
                                            <option value="4">Monografiya</option>
                                            <option value="5">Risola</option>
                                            <option value="6">Dastur</option>
                                            <option value="7">To'plam</option>
                                            <option value="8">Ensiklopediya</option>
                                            <option value="9">Lug'at</option>
                                            <option value="10">Qonunlar</option>
                                            <option value="11">Ma'lumotnoma</option>
                                            <option value="12">Avtoreferat</option>
                                            <option value="13">Dissertatsiya</option>
                                            <option value="999">Boshqa</option>
                                        </select>
                                    </div>
                                    <div class="col-4 mt-2">
                                        <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 " name="book-science-type" id="book-science-type" data-toggle="tooltip" data-placement="bottom" data-original-title="Adabiyot tili.">
                                            <option selected disabled>Adabiyot fan soxasi...</option>
                                            <option value="1">Umumiy va sohalaroro bilimlar</option>
                                            <option value="2">Umumiy tabiiy fanlar</option>
                                            <option value="3">Fizika-matematika fanlari</option>
                                            <option value="4">Kimyo fanlari</option>
                                            <option value="5">Yer haqidagi fanlar (geodeziya, geofizika, geologiya va geografiya fanlari)</option>
                                            <option value="6">Biologiya fanlari</option>
                                            <option value="7">Texnika fanlari</option>
                                            <option value="8">Badiiy adabiyotlar</option>
                                            <option value="9">Sog'liqni saqlash. Tibbiyot fanlari</option>
                                            <option value="10">Sotsiologiya</option>
                                            <option value="11">Tarix. Tarix fanlari</option>
                                            <option value="12">Iqtisod. Iqtisodiy fanlar</option>
                                            <option value="13">Siyosat. Siyosiy fanlar</option>
                                            <option value="14">Huquq. Yuridik fanlar</option>
                                            <option value="15">Harbiy fan. Harbiy ish</option>
                                            <option value="16">San'at</option>
                                            <option value="17">Din. Dinshunoslik</option>
                                            <option value="18">Falsafa. Falsafa fanlari</option>
                                            <option value="19">Pedagogika va Psixologiya fanlari</option>
                                            <option value="20">Jismoniy tarbiya va sport fanlari</option>
                                            <option value="21">Universal mazmunli adabiyotlar</option>
                                            <option value="22">Tilshunoslik adabiyotlar</option>
                                            <option value="999">Boshqa</option>
                                        </select>
                                    </div>
                                    <div class="col-4 mt-2">
                                        `+allCampuses+`
                                    </div>

                                    <div id="book-image-div" class="col-12 mt-3 p-3 ac" style="border: 2px dashed silver">
                                        <b>Adabiyot betlik rasmini tanlang (agar mavjud bo'lsa):</b><br><input type="file" name="book-image" accept=".jpg,.jpeg,.png" class="form-control-file">
                                    </div>

                                    <div id="book-file-div" class="col-12 mt-3 p-3 ac" style="border: 2px dashed silver">
                                        <b>Adabiyot elektron ko'rinishini tanlang:</b><br><input type="file" name="book-file" accept=".pdf,.djvu,.epub,.doc,.docx" class="form-control-file">
                                    </div>
                                    <div class="col-2 mt-3 ">
                                    </div>
                                    <div class="col-4 mt-3 ac py-3 px-1" style="border: 2px dashed silver">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="book-image-delete" name="book-image-delete">
                                            <label class="custom-control-label text-danger" for="book-image-delete">Betlik rasmini o'chirish</label>
                                        </div>
                                    </div>
                                    <div class="col-4 mt-3 ac py-3 px-1" style="border: 2px dashed silver">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="book-file-delete" name="book-file-delete">
                                            <label class="custom-control-label text-danger" for="book-file-delete">To'liq matnini o'chirish</label>
                                        </div>
                                    </div>
                                    <div class="col-2 mt-3 ">
                                    </div>
                                    <div class="col-12 px-0 mt-3 progress">
                                        <div id="book-upload" class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                                    </div>

                                    <div class="col-12 mt-3 ac">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-dismiss="modal">Bekor qilish</button>
                                            <button type="submit" class="btn btn-info">Saqlash</button>
                                        </div>
                                    </div>

                                `;
                    $('#choosed-book-content-div').html(modalContent);
                    if (recivedData.answer['ebook_type']){
                        $('#book-page-type').val(recivedData.answer['ebook_type']);
                    }
                    if (recivedData.answer['is_book_primary']){
                        $('#is-book-primary').val(recivedData.answer['is_book_primary']);
                    }
                    if (recivedData.answer['ebook_lang']){
                        $('#book-lang').val(recivedData.answer['ebook_lang']);
                    }
                    if (recivedData.answer['ebook_category']){
                        $('#book-category').val(recivedData.answer['ebook_category']);
                    }
                    if (recivedData.answer['ebook_science_type']){
                        $('#book-science-type').val(recivedData.answer['ebook_science_type']);
                    }
                    if (recivedData.answer['ebook_campus_id']){
                        $('#book-campus-id').val(recivedData.answer['ebook_campus_id']);
                    }
                    $('[data-toggle="tooltip"]').tooltip();

                }
            });
        }
        //\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

        /////////////////////////////// Delete book /////////////////////////////////
        if (currentButton.attributes[0].nodeValue==='delete-book'){
            Swal.fire({
                icon:'warning',
                title: 'Ogohlantirish!',
                text: 'Ushbu resursni o\'chirib yuborganingizdan so\'ng, qayta tiklash imkoni mavjud bo\'lmaydi. Ishonchingiz komilmi ?',
                showCancelButton: true,
                cancelButtonText: 'Bekor qilish',
                showConfirmButton: true,
                confirmButtonColor: '#f00',
                confirmButtonText: 'O\'chirish',
                allowOutsideClick: false
            }).then((e)=>{
                if (e.isConfirmed){
                    let deleteBookData = {
                        '_for_what': 'deleteBook',
                        'book-id-for-delete': currentBookID
                    }
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.post('',deleteBookData, function (recivedData) {
                        if (recivedData.answer === 'success'){
                            Swal.fire({
                                icon: 'success',
                                title: 'Muvafaqqiyat!',
                                text: 'Resurs, ma\'lumotlar bazasidan o\'chirildi.',
                                allowOutsideClick: false
                            }).then((sD)=>{
                                if (sD.isConfirmed){
                                    location.reload();
                                }
                            });
                        }
                        if (recivedData.answer === 'hacked'){

                        }
                    });
                }
            });
        }
        //\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
    });
    $('#choosed-book-form').ajaxForm({
        beforeSend: function () {

        },
        uploadProgress: function (event, position, total, percentComplete) {
            $('#book-upload').text(percentComplete+'%').css('width', percentComplete+'%');
        },
        success: function (data) {
            if (data.answer === 'success'){
                Swal.fire({
                    icon: 'success',
                    title: 'Muvaffaqiyat!',
                    text: `Adabiyot tahrirlandi!`,
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        location.reload();
                    }
                });
            }

            if (data.answer === 'error'){
                Swal.fire({
                    icon: 'error',
                    title: 'Xatolik!',
                    text: `Ma'lumotlar to'liq emas!`,
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        //location.reload();
                    }
                });
            }
        }
    });

})
