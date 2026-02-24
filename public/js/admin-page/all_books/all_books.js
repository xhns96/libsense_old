$(document).ready(function () {

    // SERVER-SIDE DataTable (fast for 20k rows)
    const table = $('#all-books-table').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 25,
        ajax: {
            url: allBooksAjaxUrl,   // GET same url -> controller returns JSON when ajax()
            type: 'GET'
        },
        columns: [
            {
                data: 'id',
                name: 'id',
                className: 'ac',
                render: function (data, type, row) {
                    const cls = row.has_file ? 'text-orange' : '';
                    return `<span class="font-weight-bold ${cls}">${data}</span>`;
                }
            },
            { data: 'book_name', name: 'book_name' },
            { data: 'book_author', name: 'book_author' },
            { data: 'book_year', name: 'book_year', className: 'ac' },
            { data: 'campus_name', name: 'campus_name', className: 'ac' },
            { data: 'admin_name', name: 'admin_name', className: 'ac' },
            {
                data: null,
                orderable: false,
                searchable: false,
                className: 'ac',
                render: function (data, type, row) {
                    return `
                        <button data-for-what="bookQRCodeDownload" data-id="${row.id}" class="btn btn-info btn-book"><i class="fa fa-qrcode"></i></button>
                        <button data-for-what="edit-book" data-id="${row.id}" class="btn btn-info btn-book" data-toggle="modal" data-target="#choosed-book-modal"><i class="icon-note"></i></button>
                        <button data-for-what="delete-book" data-id="${row.id}" class="btn btn-danger btn-book"><i class="icon-trash"></i></button>
                    `;
                }
            }
        ]
    });

    $('#choosed-book-modal').on('hide.bs.modal', function () {
        $('#choosed-book-content-div').html('');
    });

    // Copy book form (your old code)
    $('#cbook-form').ajaxForm({
        beforeSend: function () {},
        uploadProgress: function (event, position, total, percentComplete) {},
        success: function (data) {
            if (data.answer === 'success'){
                Swal.fire({
                    icon: 'success',
                    title: 'Muvaffaqiyat!',
                    text: 'Kiritilgan adabiyot, ma\'lumotlar bazasiga qo\'shildi.',
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        table.ajax.reload(null, false); // ✅ reload without full page refresh
                    }
                });
            }
            if (data.answer === 'equal'){
                Swal.fire({
                    icon: 'info',
                    title: 'O\'xshashlik!',
                    text: 'Kiritgan adabiyotingiz ma\'lumotlar bazasida mavjud.',
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        table.ajax.reload(null, false);
                    }
                });
            }
            if (data.answer === 'error'){
                Swal.fire({
                    icon: 'error',
                    title: 'Xatolik!',
                    text: 'Barcha ma\'lumotlarni to\'g\'ri kiriting.',
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        table.ajax.reload(null, false);
                    }
                });
            }
            if (data.answer === 'no-data'){
                Swal.fire({
                    icon: 'error',
                    title: 'Xatolik!',
                    text: `Ma'lumotlar yetarlik emas!`,
                    allowOutsideClick: false
                }).then((e)=>{
                    if (e.isConfirmed){
                        table.ajax.reload(null, false);
                    }
                });
            }
        }
    });

    // Buttons inside table (edit/delete/qr)
    $("#all-books-table").on("click", ".btn-book", function(){

        const action = $(this).data('for-what');
        const currentBookID = $(this).data('id'); // ✅ correct way

        // CSRF for your POST actions
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //////////////////////////////// Edit Book //////////////////////////////////
        if (action === 'edit-book'){
            let choosedBookData = {
                '_for_what': 'changeBook',
                'book-id': currentBookID
            };
            console.log(choosedBookData)
            // posting to same url (your old: $.post('', ...))
            $.post(window.location.href, choosedBookData, function (recivedData) {
                console.log(recivedData)
                if (recivedData.answer === 'bookNotFound'){
                    table.ajax.reload(null, false);
                    return;
                }

                if (recivedData.answer === 'hacked'){
                    Swal.fire({
                        icon: 'error',
                        title: 'Xatolik!',
                        text: 'Tarmoqda kutilmagan xatolik!',
                        allowOutsideClick: false
                    }).then((he)=>{
                        if (he.isConfirmed){
                            table.ajax.reload(null, false);
                        }
                    });
                    return;
                }

                // ======= your existing modal build code (kept) =======
                let bookISBN = '';
                if (recivedData.answer['book_isbn']){
                    bookISBN = recivedData.answer['book_isbn'];
                }

                let allCampuses =`<select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="book-campus-id" id="book-campus-id" data-toggle="tooltip" data-placement="right" data-original-title="Adabiyot tili.">
                        <option selected disabled>ARM bo'limi...</option>`;
                for (let currentCampus of recivedData.allCampuses){
                    allCampuses += `<option value="${currentCampus['id']}">${currentCampus['campus_name']}</option>`;
                }
                allCampuses +=`</select>`;

                let bookFile = ``;
                if (recivedData.answer['book_file']){
                    bookFile = `<a href="${recivedData.bookURL}"><button type="button" class="btn btn-primary" style="border-bottom-left-radius: 10px; border-top-right-radius: 10px"><i class="bi bi-download mr-1"></i>Yuklab olish</button></a>`;
                }

                let bookDownContent = ``;
                if (recivedData.answer['book_file']){
                    bookDownContent = `
                            <div class="row mx-3 px-3 py-2" style="box-shadow: lightgrey 2px 2px 5px">
                                <div class="col-2" style="text-align: right">
                                    <img src="${recivedData.imgUrl}" height="50px" width="45px" alt="pdf image">
                                </div>
                                <div class="col-5" style="text-align: left">
                                    <span style="font-size: 1.2rem; font-weight: bold">${recivedData.bookShortName}</span><br>
                                    <span style="font-weight: bold">Hajmi: <span class="text-primary">${recivedData.fileSize} Mb</span></span>
                                </div>
                                <div class="col-5 pt-2">
                                    ${bookFile}
                                </div>
                            </div>`;
                }

                let modalContent = `
                    <div class="col-12 mt-2 ac">
                        <h2 class="text-uppercase">Adabiyotni tahrirlash</h2>
                    </div>
                    <div class="col-6 mt-2 d-none">
                        <input type="text" name="book-id" class="form-control font-weight-bold boxShadow borderRadius20 inputPR20" value="${recivedData.answer['id']}">
                    </div>
                    <div class="col-6 mt-2">
                        <input type="text" autocomplete="off" name="book-name" id="book-name" data-toggle="tooltip" data-placement="top"
                               class="form-control font-weight-bold boxShadow borderRadius20 inputPR20"
                               placeholder="Adabiyot nomi:" value="${recivedData.answer['book_name']}" data-original-title="Adabiyot nomi.">
                    </div>
                    <div class="col-6 mt-2">
                        <input type="text" autocomplete="off" name="book-author" id="book-author" data-toggle="tooltip" data-placement="top"
                               class="form-control font-weight-bold boxShadow borderRadius20 inputPR20"
                               placeholder="Adabiyot muallifi:" value="${recivedData.answer['book_author']}" data-original-title="Adabiyot muallifi.">
                    </div>

                    <div class="col-6 mt-2">
                        <input type="text" autocomplete="off" name="book-isbn" id="book-isbn" data-toggle="tooltip" data-placement="left"
                               class="form-control font-weight-bold boxShadow borderRadius20 inputPR20"
                               placeholder="Adabiyot ISBN raqami:" value="${bookISBN}" data-original-title="Adabiyot ISBN raqami.">
                    </div>
                    <div class="col-3 mt-2">
                        <input type="number" autocomplete="off" name="book-page-count" id="book-page-count" data-toggle="tooltip" data-placement="top"
                               class="form-control font-weight-bold boxShadow borderRadius20 inputPR20"
                               placeholder="Adabiyot bet soni:" value="${recivedData.answer['book_page_count']}" data-original-title="Adabiyot bet soni.">
                    </div>
                    <div class="col-3 mt-2">
                        <input type="number" autocomplete="off" name="book-copy-count" id="book-copy-count" data-toggle="tooltip" data-placement="right"
                               class="form-control font-weight-bold boxShadow borderRadius20 inputPR20"
                               placeholder="Adabiyot nusxalar soni:" value="${recivedData.answer['book_copy_count']}" data-original-title="Adabiyot nusxalar soni.">
                    </div>
                    <div class="col-3 mt-2">
                        <input type="text" autocomplete="off" name="book-publishing" id="book-publishing" data-toggle="tooltip" data-placement="left"
                               class="form-control font-weight-bold boxShadow borderRadius20 inputPR20"
                               placeholder="Adabiyot nashriyoti:" value="${recivedData.answer['book_publishing']}" data-original-title="Adabiyot nashriyoti.">
                    </div>
                    <div class="col-3 mt-2">
                        <input type="number" autocomplete="off" name="book-year" id="book-year" data-toggle="tooltip" data-placement="right"
                               class="form-control font-weight-bold boxShadow borderRadius20 inputPR20"
                               placeholder="Adabiyot nashr yili:" value="${recivedData.answer['book_year']}" data-original-title="Adabiyot nashr yili.">
                    </div>
                    <div class="col-6 mt-2">
                        <input type="number" autocomplete="off" name="book-real-copy-count" id="book-real-time-count" data-toggle="tooltip" data-placement="right"
                               class="form-control font-weight-bold boxShadow borderRadius20 inputPR20"
                               placeholder="Hozirgi vaqtdagi nusxalar soni:" value="${recivedData.answer['book_copy_count_now']}" data-original-title="Hozirgi vaqtdagi nusxalar soni.">
                    </div>

                    <div class="col-4 mt-2">
                        <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="book-type" id="book-page-type" data-toggle="tooltip" data-placement="left" data-original-title="Adabiyot ko'rinishi.">
                            <option selected disabled>Adabiyot ko'rinishi...</option>
                            <option value="1">Bosma taboq (qog'oz)</option>
                            <option value="2">Elektron adabiyot</option>
                        </select>
                    </div>
                    <div class="col-4 mt-2">
                        <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="book-for-home" id="book-for-home" data-toggle="tooltip" data-placement="top" data-original-title="Adabiyot uyga beriladimi ?">
                            <option selected disabled>Uyga beriladimi ?</option>
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
                        <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 inputPR20" name="book-category" id="book-category" data-toggle="tooltip" data-placement="left" data-original-title="Adabiyot turi.">
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
                        <select class="font-weight-bold custom-select mr-sm-2 boxShadow borderRadius20 " name="book-science-type" id="book-science-type" data-toggle="tooltip" data-placement="bottom" data-original-title="Adabiyot fan soxasi.">
                            <option selected disabled>Adabiyot fan soxasi...</option>
                            <option value="1">Umumiy va sohalaroro bilimlar</option>
                            <option value="2">Umumiy tabiiy fanlar</option>
                            <option value="3">Fizika-matematika fanlari</option>
                            <option value="4">Kimyo fanlari</option>
                            <option value="5">Yer haqidagi fanlar</option>
                            <option value="6">Biologiya fanlari</option>
                            <option value="7">Texnika fanlari</option>
                            <option value="8">Badiiy adabiyotlar</option>
                            <option value="9">Sog'liqni saqlash</option>
                            <option value="10">Sotsiologiya</option>
                            <option value="11">Tarix</option>
                            <option value="12">Iqtisod</option>
                            <option value="13">Siyosat</option>
                            <option value="14">Huquq</option>
                            <option value="15">Harbiy fan</option>
                            <option value="16">San'at</option>
                            <option value="17">Din</option>
                            <option value="18">Falsafa</option>
                            <option value="19">Pedagogika va Psixologiya</option>
                            <option value="20">Jismoniy tarbiya va sport</option>
                            <option value="21">Universal</option>
                            <option value="22">Tilshunoslik</option>
                            <option value="999">Boshqa</option>
                        </select>
                    </div>

                    <div class="col-4 mt-2">
                        ${allCampuses}
                    </div>

                    <div id="book-image-div" class="col-12 mt-3 p-3 ac" style="border: 2px dashed silver">
                        <b>Adabiyot betlik rasmini tanlang (agar mavjud bo'lsa):</b><br>
                        <input type="file" name="book-image" accept=".jpg,.jpeg,.png" class="form-control-file">
                    </div>

                    <div id="book-file-div" class="col-12 mt-3 p-3 ac" style="border: 2px dashed silver">
                        <b>Adabiyot elektron ko'rinishini tanlang:</b><br>
                        <input type="file" name="book-file" accept=".pdf,.djvu,.epub,.doc,.docx" class="form-control-file">
                    </div>

                    <div class="col-12 ac mt-3">
                        ${bookDownContent}
                    </div>

                    <div class="col-2 mt-3 "></div>

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

                    <div class="col-2 mt-3 "></div>

                    <div class="col-12 px-0 mt-3 progress">
                        <div id="book-upload" class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                    </div>

                    <div class="col-12 mt-3 ac">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Bekor qilish</button>
                            <button type="submit" class="btn btn-info">Saqlash</button>
                        </div>
                    </div>
                `;

                $('#choosed-book-content-div').html(modalContent);

                // set selected values
                if (recivedData.answer['book_type']) $('#book-page-type').val(recivedData.answer['book_type']);
                if (recivedData.answer['book_for_home']) $('#book-for-home').val(recivedData.answer['book_for_home']);
                if (recivedData.answer['book_lang']) $('#book-lang').val(recivedData.answer['book_lang']);
                if (recivedData.answer['book_category']) $('#book-category').val(recivedData.answer['book_category']);
                if (recivedData.answer['book_science_type']) $('#book-science-type').val(recivedData.answer['book_science_type']);
                if (recivedData.answer['book_campus_id']) $('#book-campus-id').val(recivedData.answer['book_campus_id']);

                $('[data-toggle="tooltip"]').tooltip();
            });
        }

        /////////////////////////////// Delete book /////////////////////////////////
        if (action === 'delete-book'){
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
                    };

                    $.post(window.location.href, deleteBookData, function (recivedData) {
                        if (recivedData.answer === 'success'){
                            Swal.fire({
                                icon: 'success',
                                title: 'Muvafaqqiyat!',
                                text: 'Resurs, ma\'lumotlar bazasidan o\'chirildi.',
                                allowOutsideClick: false
                            }).then((sD)=>{
                                if (sD.isConfirmed){
                                    table.ajax.reload(null, false);
                                }
                            });
                        }
                    });
                }
            });
        }

        /////////////////////////////// QR Code download ////////////////////////////
        if (action === 'bookQRCodeDownload'){
            $("#qrcode-container").empty();

            new QRCode(document.getElementById("qrcode-container"), {
                text: qrcodeLink + "/" + currentBookID,
                width: 500,
                height: 500,
            });

            const canvas = $("#qrcode-container canvas")[0];
            if (!canvas) return;

            const downloadLink = document.createElement("a");
            downloadLink.href = canvas.toDataURL("image/png");
            downloadLink.download = "qrcode_" + currentBookID + ".png";
            downloadLink.click();

            $("#qrcode-container").empty();
        }

    });

    // Edit form submit (your old code)
    $('#choosed-book-form').ajaxForm({
        beforeSend: function () {},
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
                        table.ajax.reload(null, false);
                        $('#choosed-book-modal').modal('hide');
                    }
                });
            }

            if (data.answer === 'error'){
                Swal.fire({
                    icon: 'error',
                    title: 'Xatolik!',
                    text: `Ma'lumotlar to'liq emas!`,
                    allowOutsideClick: false
                });
            }
        }
    });

});
