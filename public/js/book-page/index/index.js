$(document).ready(function () {
    $('#otm-id').on('change',function () {
        $('#search-input').attr('readonly',false);
        let currentUniverID = $(this).val();

        let allBooksForCurrentUniverData = {
            '_for_what': 'filteredAllBooksRequest',
            'univer-id': currentUniverID
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post('',allBooksForCurrentUniverData,function (recivedResponse) {
            if (recivedResponse.answer === "success"){

                let tempLoader = `
                    <div class="col-12 ac">
                        <img src="`+loaderURL+`" width="100" alt="">
                    </div>`;

                let filteredAllBooks = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('book_name'),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: recivedResponse.allBooks
                });

                $('#search-input').typeahead(null, {
                    name: 'all-books',
                    display: 'book_name',
                    source: filteredAllBooks,
                    templates: {
                        empty: [
                            '<div class="empty-message">',
                            "ushbu so'rov bo'yicha hech qanday ma'lumot topilmadi",
                            '</div>'
                        ].join('\n'),
                        suggestion: Handlebars.compile('<div><strong>{{book_name}}</strong>, <i>{{book_author}}</i> – {{book_year}}<br>( <b>Joylashuvi:</b> <b class="text-info">{{campus_name}}</b>)</div>')
                    }
                }).css({'vertical-align':'','background-color':'','min-width':'400px'}).on('typeahead:selected', function(evt, item)
                {

                    let storageLocation = recivedResponse.storagePath;
                    let findedBookDivBody = $('#findedBookContent');
                    let defImg = 'default.png';
                    let downButton = `<button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" data-original-title="Hozirgi vaqtda ushbu adabiyotning elektron ko'rinishi mavjud emas."><i class="bi-download"></i> Yuklash</button>`;
                    console.log(item);

                    if (item['book_image']){
                        defImg = item['book_image'];
                    }
                    if (item['book_file']){
                        let thisLoc = '/book/book-download/'+item['id'];
                        downButton = `<a href="${thisLoc}" class="btn btn-primary" data-id ="${item['id']}"><i class="bi-download"></i> Yuklash</a>`;
                    }
                    defImg = bookImgURL+"/"+defImg;
                    let thisLoc = '/book/book-download/'+item['id'];
                    let tempContent = `
                    <div class="col-6 mx-auto">
                        <div class="card mb-3 customCard" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="${defImg}" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">${item['book_name']}</h5>
                                        <p class="card-text"><b>Nashr yili:</b> ${item['book_year']}<br>
                                        <b>Tili:</b> ${item['book_lang']}<br>
                                        <b>Joylashuvi:</b> ${item['campus_name']}</p>
                                        <p class="card-text">
<!--                                        <div class="customButtonGreen mr-3"><i class="bi bi-cart3 mr-1"></i>Buyurtma</div>-->
                                        <button type="button" class="btn btn-success book-order" data-id="${item['id']}"><i class="bi-cart3"></i> Buyurtma</button>
                                       
<!--                                        <div class="customButton"><i class="bi bi-download mr-1"></i>yuklab olish</div>-->
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                   findedBookDivBody.html(tempContent);
                   $('[data-toggle="tooltip"]').tooltip();
                   $('.book-order').on('click',function () {
                        let currentBtn = $(this)[0];
                        currentBtn.disabled = true;
                        let currentOrderBookID = $(this)[0].attributes[2].nodeValue;
                        let bookOrderData = {
                            '_for_what':'bookOrder',
                            'book_id': currentOrderBookID
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.post('',bookOrderData,function (orderRes) {
                            console.log(orderRes)
                            if (orderRes.answer === 'not-signed'){
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Ma\'lumot!',
                                    text: 'Adabiyotni buyurtma qilishingiz uchun akkauntingizga kirishingiz kerak bo\'ladi.',
                                    allowOutsideClick: false
                                }).then((res)=>{
                                    if (res.isConfirmed){
                                        Swal.close();
                                        currentBtn.disabled = false;
                                    }
                                });
                            }
                            if (orderRes.answer === 'inactive'){
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Ma\'lumot!',
                                    text: 'Adabiyotni buyurtma qilishingiz uchun akkauntingiz "FAOL" holatda bo\'lishi kerak.',
                                    allowOutsideClick: false
                                }).then((res)=>{
                                    if (res.isConfirmed){
                                        Swal.close();
                                        currentBtn.disabled = false;
                                    }
                                });
                            }
                            if (orderRes.answer === 'pending'){
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Ma\'lumot!',
                                    text: 'Adabiyotni buyurtma qilishingiz uchun akkauntingiz "FAOL" holatda bo\'lishi kerak.',
                                    allowOutsideClick: false
                                }).then((res)=>{
                                    if (res.isConfirmed){
                                        Swal.close();
                                        currentBtn.disabled = false;
                                    }
                                });
                            }
                            if (orderRes.answer === 'success'){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Muvaffaqiyat!',
                                    text: 'Buyurtmangiz qabul qilindi, barcha buyurtmalaringizni "Buyurtmalar" bo\'limidan ko\'rishingiz mumkin.',
                                    allowOutsideClick: false
                                }).then((res)=> {
                                    if (res.isConfirmed) {
                                        Swal.close();
                                        currentBtn.disabled = false;
                                    }
                                })
                            }
                        });
                    });
                });
            }
        })

    });

    $('#choose-university-select-in-book-author-search').on('change',function () {
        let currentUniverID = $(this).val();
        let findedBookDivBody = $('#book-author-search-content');

        let allBooksForCurrentUniverData = {
            '_for_what': 'filteredAllBooksRequest',
            'univer-id': currentUniverID
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post('',allBooksForCurrentUniverData,function (recivedResponse) {
            if (recivedResponse.answer === "success"){
                //console.log(recivedResponse.allBooks);
                let tempLoader = `
                    <div class="col-12 ac">
                        <img src="`+loaderURL+`" width="100" alt="">
                    </div>`;


                let filteredAllBooks = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('book_author'),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: recivedResponse.allBooks
                });

                $('#book-author-search-input').typeahead(null, {
                    name: 'all-books',
                    display: 'book_author',
                    source: filteredAllBooks,
                    templates: {
                        empty: [
                            '<div class="empty-message">',
                            'unable to find any Best Picture winners that match the current query',
                            '</div>'
                        ].join('\n'),
                        suggestion: Handlebars.compile('<div><strong>{{book_author}}</strong>, <i>{{book_name}}</i> – {{book_year}}<br>( <b>Joylashuvi:</b> <b class="text-info">{{campus_name}}</b>)</div>')
                    }
                });

                $('#book-author-search-input').on('typeahead:selected', function(evt, item) {
                    // console.log(evt);
                    // console.log(item);

                    let storageLocation = recivedResponse.storagePath;
                    let tempContent = `
                    <div class="col-4">
                        <div class="card bookCardStyle mt-3">
                            <img class="card-img-top mx-auto" src="${storageLocation}/default.png" alt="Card image cap">
                            <div class="card-body card-body-book">
                                <b>Nomi:</b> ${item['book_name']}<br>
                                <b>Muallifi:</b> ${item['book_author']}<br>
                                <b>Yili:</b> ${item['book_year']}<br>
                                <b>Joylashuvi:</b> ${item['campus_name']}<br>
                            </div>
                            <div class="card-footer ac">
                                <div class="row ">
                                    <div class="col p-0 m-0">
                                        <a href="#" class="btn btn-primary"><i class="bi-download"></i> Yuklash</a>
                                    </div>
                                    <div class="col p-0 m-0">
                                       <button type="button" class="btn btn-success book-order" data-id="${item['id']}"><i class="bi-cart3"></i> Buyurtma</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    `;
                   findedBookDivBody.html(tempContent);
                   $('.book-order').on('click',function () {
                        let currentBtn = $(this)[0];
                        currentBtn.disabled = true;
                        let currentOrderBookID = $(this)[0].attributes[2].nodeValue;
                        let bookOrderData = {
                            '_for_what':'bookOrder',
                            'book_id': currentOrderBookID
                        };
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.post('',bookOrderData,function (orderRes) {
                            if (orderRes.answer === 'not-signed'){
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Ma\'lumot!',
                                    text: 'Adabiyotni buyurtma qilishingiz uchun akkauntingizga kirishingiz kerak bo\'ladi.',
                                    allowOutsideClick: false
                                }).then((res)=>{
                                    if (res.isConfirmed){
                                        Swal.close();
                                        currentBtn.disabled = false;
                                    }
                                });
                            }
                            if (orderRes.answer === 'inactive'){
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Ma\'lumot!',
                                    text: 'Adabiyotni buyurtma qilishingiz uchun akkauntingiz "FAOL" holatda bo\'lishi kerak.',
                                    allowOutsideClick: false
                                }).then((res)=>{
                                    if (res.isConfirmed){
                                        Swal.close();
                                        currentBtn.disabled = false;
                                    }
                                });
                            }
                            if (orderRes.answer === 'pending'){
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Ma\'lumot!',
                                    text: 'Adabiyotni buyurtma qilishingiz uchun akkauntingiz "FAOL" holatda bo\'lishi kerak.',
                                    allowOutsideClick: false
                                }).then((res)=>{
                                    if (res.isConfirmed){
                                        Swal.close();
                                        currentBtn.disabled = false;
                                    }
                                });
                            }
                            if (orderRes.answer === 'success'){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Muvaffaqiyat!',
                                    text: 'Buyurtmangiz qabul qilindi, barcha buyurtmalaringizni "Buyurtmalar" bo\'limidan ko\'rishingiz mumkin.',
                                    allowOutsideClick: false
                                }).then((res)=> {
                                    if (res.isConfirmed) {
                                        Swal.close();
                                        currentBtn.disabled = false;
                                    }
                                })
                            }
                        });
                    });
                });
            }
        })

    });



})
