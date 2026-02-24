$(document).ready(function () {

    let reportTypeSelect = $('#report-type-select');
    let reportTypeBtn = $('#report-type-button');
    let bookCampusSelect = $('#book-campus-select');
    let bookCategorySelect = $('#book-category-select');
    let bookScienceTypeSelect = $('#book-science-type-select');
    let bookLangSelect = $('#book-lang-select');
    let bookTMSelect = $('#book-tm-select');

    function turnOffSelectsTypeOne(){
        bookCampusSelect.attr('disabled',true);
        bookCategorySelect.attr('disabled',true);
        bookScienceTypeSelect.attr('disabled',true);
        bookLangSelect.attr('disabled',true);
        bookTMSelect.attr('disabled',true);
        reportTypeBtn.attr('disabled',true);
    }
    function turnOnSelectsTypeOne(){
        bookCampusSelect.attr('disabled',false);
        bookCategorySelect.attr('disabled',false);
        bookScienceTypeSelect.attr('disabled',false);
        bookLangSelect.attr('disabled',false);
        bookTMSelect.attr('disabled',false);
    }
    bookCampusSelect.on('change',function () {
        if (bookCategorySelect.val() && bookScienceTypeSelect.val() && bookLangSelect.val()
            && bookTMSelect.val()){
            reportTypeBtn.attr('disabled',false)
        }
    })
    bookCategorySelect.on('change',function () {
        if (bookCampusSelect.val() && bookScienceTypeSelect.val() && bookLangSelect.val()
            && bookTMSelect.val()){
            reportTypeBtn.attr('disabled',false)
        }
    })
    bookScienceTypeSelect.on('change',function () {
        if (bookCategorySelect.val() && bookCampusSelect.val() && bookLangSelect.val()
            && bookTMSelect.val()){
            reportTypeBtn.attr('disabled',false)
        }
    })
    bookLangSelect.on('change',function () {
        if (bookCategorySelect.val() && bookScienceTypeSelect.val() && bookCampusSelect.val()
            && bookTMSelect.val()){
            reportTypeBtn.attr('disabled',false)
        }
    })
    bookTMSelect.on('change',function () {
        if (bookCategorySelect.val() && bookScienceTypeSelect.val() && bookLangSelect.val()
            && bookCampusSelect.val()){
            reportTypeBtn.attr('disabled',false)
        }
    })

    reportTypeSelect.on('change', function () {
        let reportType = $(this).val();
        if (reportType === "1"){
            turnOnSelectsTypeOne();
        }
        else if(reportType === "2"){
            turnOnSelectsTypeOne();
        }
        else if(reportType === "3"){
            turnOffSelectsTypeOne();
        }
        else{
            turnOffSelectsTypeOne();
        }
    });

    reportTypeBtn.click(function () {
        if (reportTypeSelect.val() === "1"){
            $('#finded-data-count-div').html("");
            $('#table-div').html("");
            $('#table-loader').show();
            let reportTypeData = {
                '_for_what': 'getReport',
                'report_type': reportTypeSelect.val(),
                'campus_id': bookCampusSelect.val(),
                'book_category_id': bookCategorySelect.val(),
                'book_science_type_id': bookScienceTypeSelect.val(),
                'book_lang_id': bookLangSelect.val(),
                'book_tm': bookTMSelect.val()
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('',reportTypeData, function (reportResponse) {
                if (reportResponse.answer === 'success'){
                    let allFindedData = reportResponse.result;
                    let findedDataCount = `<h3>Saralangan adabiyotlar: <b class="text-primary">${reportResponse['result-count']}</b> nomda</h3>`;

                    let tableContent = ``;
                    for (let currentData in allFindedData){
                        tableContent+= `
                        <tr>
                            <td>${allFindedData[currentData]['id']}</td>
                            <td>${allFindedData[currentData]['book_name']}</td>
                            <td>${allFindedData[currentData]['book_author']}</td>
                            <td>${allFindedData[currentData]['book_year']}</td>
                            <td class="ac"><b><span class="text-primary">${allFindedData[currentData]['book_copy_count']}</span> / <span class="text-success">${allFindedData[currentData]['book_copy_count_now']}</span></b></td>
                            <td class="ac">${allFindedData[currentData]['updated_at']}</td>
                            <td class="ac"><button data-id = "${allFindedData[currentData]['id']}" class="delete-book btn btn-danger"><i class="bi-trash mr-1"></i>O'chirish</button></td>
                        </tr>
                    `
                    }
                    let newTable = `
                    <table id="filtered-books-table" class="table table-hover table-bordered" style="display: none;width:100%">
                        <thead>
                            <tr class="ac">
                                <th width="5%" class="font-weight-bold">ID</th>
                                <th width="23%" class="font-weight-bold">Nomi</th>
                                <th width="15%" class="font-weight-bold">Muallifi</th>
                                <th width="5%" class="font-weight-bold">Yili</th>
                                <th width="20" class="font-weight-bold">Umumiy nusxalar soni / hozirgi vaqtdagi nusxalar soni</th>
                                <th width="15%" class="font-weight-bold">Tahrirlangan vaqti</th>
                                <th width="17%" class="ac"></th>
                            </tr>
                        </thead>
                        <tbody>
                            ${tableContent}
                        </tbody>
                        <tfoot>
                            <tr class="ac">
                                <th width="5%" class="font-weight-bold">ID</th>
                                <th width="23%" class="font-weight-bold">Nomi</th>
                                <th width="15%" class="font-weight-bold">Muallifi</th>
                                <th width="5%" class="font-weight-bold">Yili</th>
                                <th width="20" class="font-weight-bold">Umumiy nusxalar soni / hozirgi vaqtdagi nusxalar soni</th>
                                <th width="15%" class="font-weight-bold">Tahrirlangan vaqti</th>
                                <th width="17%" class="ac"></th>
                            </tr>
                        </tfoot>
                        </table>`;

                    $('#finded-data-count-div').html(findedDataCount);
                    $('#table-div').html(newTable);
                    $('#table-loader').hide();
                    $('#filtered-books-table').dataTable().css('display','table').on('click','.delete-book',function () {
                        let currentBookID = $(this).attr('data-id');
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
                                    'book_type': 'book',
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
                                        location.reload();
                                    }
                                });
                            }
                        });

                    })
                }
            })
        }
        if (reportTypeSelect.val() === "2"){
            $('#finded-data-count-div').html("");
            $('#table-div').html("");
            $('#table-loader').show();
            let reportTypeData = {
                '_for_what': 'getReport',
                'report_type': reportTypeSelect.val(),
                'campus_id': bookCampusSelect.val(),
                'book_category_id': bookCategorySelect.val(),
                'book_science_type_id': bookScienceTypeSelect.val(),
                'book_lang_id': bookLangSelect.val(),
                'book_tm': bookTMSelect.val()
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post('',reportTypeData, function (reportResponse) {
                if (reportResponse.answer === 'success'){
                    let allFindedData = reportResponse.result;
                    let findedDataCount = `<h3>Saralangan adabiyotlar: <b class="text-primary">${reportResponse['result-count']}</b> nomda</h3>`;

                    let tableContent = ``;
                    for (let currentData in allFindedData){
                        let isbnTemp = '';
                        if (allFindedData[currentData]['ebook_isbn']){
                            isbnTemp = allFindedData[currentData]['ebook_isbn'];
                        }
                        tableContent+= `
                        <tr>
                            <td>${allFindedData[currentData]['id']}</td>
                            <td>${allFindedData[currentData]['ebook_name']}</td>
                            <td>${allFindedData[currentData]['ebook_author']}</td>
                            <td>${allFindedData[currentData]['ebook_year']}</td>
                            <td class="ac"><b><span class="text-primary">${isbnTemp}</span></b></td>
                            <td class="ac">${allFindedData[currentData]['updated_at']}</td>
                            <td class="ac"><button data-id = "${allFindedData[currentData]['id']}" class="delete-book btn btn-danger"><i class="bi-trash mr-1"></i>O'chirish</button></td>
                        </tr>
                    `
                    }
                    let newTable = `
                    <table id="filtered-books-table" class="table table-hover table-bordered" style="display: none;width:100%">
                        <thead>
                            <tr class="ac">
                                <th width="7%" class="font-weight-bold">ID</th>
                                <th width="23%" class="font-weight-bold">Nomi</th>
                                <th width="15%" class="font-weight-bold">Muallifi</th>
                                <th width="5%" class="font-weight-bold">Yili</th>
                                <th width="18" class="font-weight-bold">ISBN</th>
                                <th width="15%" class="font-weight-bold">Tahrirlangan vaqti</th>
                                <th width="17%" class="ac"></th>
                            </tr>
                        </thead>
                        <tbody>
                            ${tableContent}
                        </tbody>
                        <tfoot>
                            <tr class="ac">
                                <th width="7%" class="font-weight-bold">ID</th>
                                <th width="23%" class="font-weight-bold">Nomi</th>
                                <th width="15%" class="font-weight-bold">Muallifi</th>
                                <th width="5%" class="font-weight-bold">Yili</th>
                                <th width="18" class="font-weight-bold">ISBN</th>
                                <th width="15%" class="font-weight-bold">Tahrirlangan vaqti</th>
                                <th width="17%" class="ac"></th>
                            </tr>
                        </tfoot>
                        </table>`;

                    $('#finded-data-count-div').html(findedDataCount);
                    $('#table-div').html(newTable);
                    $('#table-loader').hide();
                    $('#filtered-books-table').dataTable().css('display','table').on('click','.delete-book',function () {
                        let currentBookID = $(this).attr('data-id');
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
                                    'book_type': 'ebook',
                                    'book-id-for-delete': currentBookID
                                }
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.post('',deleteBookData, function (recivedData) {
                                    if (recivedData?.answer === 'success'){
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
                                        location.reload();
                                    }
                                });
                            }
                        });

                    })
                }
            })
        }

    });

    $('#empty-table').dataTable();



});
