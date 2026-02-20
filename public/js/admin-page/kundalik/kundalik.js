$(document).ready(function () {
    $('#kundalik-table').dataTable().css('display','table');

    let campusSelect = $("#choose-campus-select");
    let campusUpdateBtn = $('#choosed-campus-update-button');

    campusSelect.on('change',function () {
        campusUpdateBtn.attr('disabled',false);
        let campusKundalikData = {
            '_for_what': 'campus_kundalik',
            'campus_id': $(this).val()
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post('',campusKundalikData, function (kR) {
            if (kR.answer === 'success'){
                let tableContent = ``;
                if (kR.cType === 'ab'){
                    for (let kRKey in kR.filteredData) {
                        let currentUserFaculty = 'Kiritilmagan';
                        for (let facKey in kR.allFaculties) {
                            if (kR.allFaculties[facKey]['id'] === kR.filteredData[kRKey]['ab_user_faculty_id']){
                                currentUserFaculty = kR.allFaculties[facKey]['faculty_name'];
                            }
                        }
                        let currentUserGroup = 'Kiritilmagan';
                        for (let grKey in kR.allGroups) {
                            if (kR.allGroups[grKey]['id'] === kR.filteredData[kRKey]['ab_user_group_id']){
                                currentUserGroup = kR.allGroups[grKey]['group_name'];
                            }
                        }
                        let trCounter = 1 + parseInt(kRKey);
                        let notExit = kR?.filteredData[kRKey]['updated_at'];
                        if (kR?.filteredData[kRKey]['created_at'] === kR?.filteredData[kRKey]['updated_at']){
                            notExit = 'Xonada';
                        }
                        tableContent += `<tr class="ac">
                        <td>${trCounter}</td>
                        <td>${kR?.filteredData[kRKey]['ab_user_name']}</td>
                        <td class="ac">${currentUserFaculty}</td>
                        <td class="ac">${kR?.filteredData[kRKey]['ab_user_course']}-bosqich</td>
                        <td class="ac">${currentUserGroup}</td>
                        <td class="ac">${kR?.filteredData[kRKey]['created_at']}</td>
                        <td class="ac">${notExit}</td>
                    </tr>`
                    }
                }
                if (kR.cType === 'oz'){

                    for (let kRKey in kR.filteredData) {
                        let currentUserFaculty = 'Kiritilmagan';
                        for (let facKey in kR.allFaculties) {
                            if (kR.allFaculties[facKey]['id'] === kR.filteredData[kRKey]['oz_user_faculty_id']){
                                currentUserFaculty = kR.allFaculties[facKey]['faculty_name'];
                            }
                        }
                        let currentUserGroup = 'Kiritilmagan';
                        for (let grKey in kR.allGroups) {
                            if (kR.allGroups[grKey]['id'] === kR.filteredData[kRKey]['oz_user_group_id']){
                                currentUserGroup = kR.allGroups[grKey]['group_name'];
                            }
                        }
                        let trCounter = 1 + parseInt(kRKey);
                        let notExit = kR?.filteredData[kRKey]['updated_at'];
                        if (kR?.filteredData[kRKey]['created_at'] === kR?.filteredData[kRKey]['updated_at']){
                            notExit = 'Xonada';
                        }
                        tableContent += `<tr class="ac">
                        <td>${trCounter}</td>
                        <td>${kR?.filteredData[kRKey]['oz_user_name']}</td>
                        <td class="ac">${currentUserFaculty}</td>
                        <td class="ac">${kR?.filteredData[kRKey]['oz_user_course']}-bosqich</td>
                        <td class="ac">${currentUserGroup}</td>
                        <td class="ac">${kR?.filteredData[kRKey]['created_at']}</td>
                        <td class="ac">${notExit}</td>
                    </tr>`
                    }
                }

                let filteredTable = `
                <table id="kundalik-table" class="table table-hover table-bordered" style="display: none;width:100%">
                <thead>
                <tr class="ac">
                    <th width="5%" class="font-weight-bold">T/r</th>
                    <th width="25%" class="font-weight-bold">Talaba FIO</th>
                    <th width="15%" class="font-weight-bold">Fakultet</th>
                    <th width="15%" class="font-weight-bold">Bosqich</th>
                    <th width="10%" class="font-weight-bold">Guruh</th>
                    <th width="15%" class="font-weight-bold">Kirgan vaqti</th>
                    <th width="15" class="font-weight-bold">Chiqgan vaqti</th>
                </tr>
                </thead>
                <tbody>
                    ${tableContent}
                </tbody>
                <tfoot>
                <tr class="ac">
                    <th width="5%" class="font-weight-bold">T/r</th>
                    <th width="25%" class="font-weight-bold">Talaba FIO</th>
                    <th width="15%" class="font-weight-bold">Fakultet</th>
                    <th width="15%" class="font-weight-bold">Bosqich</th>
                    <th width="10%" class="font-weight-bold">Guruh</th>
                    <th width="15%" class="font-weight-bold">Kirgan vaqti</th>
                    <th width="15" class="font-weight-bold">Chiqgan vaqti</th>
                </tr>
                </tfoot>
            </table>`;

            $('#table-div').html(filteredTable);
            $('#kundalik-table').dataTable().css('display','table');
            }
            if (kR.answer === 'empty'){
                Swal.fire({
                    icon: 'info',
                    title: "Ma'lumot",
                    text: "Hech qanday ma'lumot topilmadi.",
                    allowOutsideClick: false
                }).then((emptyRes)=>{
                    if (emptyRes.isConfirmed){
                        location.reload();
                    }
                })
            }
        })
    })

    campusUpdateBtn.on('click', function () {

        let campusKundalikData = {
            '_for_what': 'campus_kundalik',
            'campus_id': campusSelect.val()
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.post('',campusKundalikData, function (kR) {
            if (kR.answer === 'success'){
                let tableContent = ``;
                if (kR.cType === 'ab'){
                    for (let kRKey in kR.filteredData) {
                        let currentUserFaculty = 'Kiritilmagan';
                        for (let facKey in kR.allFaculties) {
                            if (kR.allFaculties[facKey]['id'] === kR.filteredData[kRKey]['ab_user_faculty_id']){
                                currentUserFaculty = kR.allFaculties[facKey]['faculty_name'];
                            }
                        }
                        let currentUserGroup = 'Kiritilmagan';
                        for (let grKey in kR.allGroups) {
                            if (kR.allGroups[grKey]['id'] === kR.filteredData[kRKey]['ab_user_group_id']){
                                currentUserGroup = kR.allGroups[grKey]['group_name'];
                            }
                        }
                        let trCounter = 1 + parseInt(kRKey);
                        let notExit = kR?.filteredData[kRKey]['updated_at'];
                        if (kR?.filteredData[kRKey]['created_at'] === kR?.filteredData[kRKey]['updated_at']){
                            notExit = 'Xonada';
                        }
                        tableContent += `<tr class="ac">
                        <td>${trCounter}</td>
                        <td>${kR?.filteredData[kRKey]['ab_user_name']}</td>
                        <td class="ac">${currentUserFaculty}</td>
                        <td class="ac">${kR?.filteredData[kRKey]['ab_user_course']}-bosqich</td>
                        <td class="ac">${currentUserGroup}</td>
                        <td class="ac">${kR?.filteredData[kRKey]['created_at']}</td>
                        <td class="ac">${notExit}</td>
                    </tr>`
                    }
                }
                if (kR.cType === 'oz'){

                    for (let kRKey in kR.filteredData) {
                        let currentUserFaculty = 'Kiritilmagan';
                        for (let facKey in kR.allFaculties) {
                            if (kR.allFaculties[facKey]['id'] === kR.filteredData[kRKey]['oz_user_faculty_id']){
                                currentUserFaculty = kR.allFaculties[facKey]['faculty_name'];
                            }
                        }
                        let currentUserGroup = 'Kiritilmagan';
                        for (let grKey in kR.allGroups) {
                            if (kR.allGroups[grKey]['id'] === kR.filteredData[kRKey]['oz_user_group_id']){
                                currentUserGroup = kR.allGroups[grKey]['group_name'];
                            }
                        }
                        let trCounter = 1 + parseInt(kRKey);
                        let notExit = kR?.filteredData[kRKey]['updated_at'];
                        if (kR?.filteredData[kRKey]['created_at'] === kR?.filteredData[kRKey]['updated_at']){
                            notExit = 'Xonada';
                        }
                        tableContent += `<tr class="ac">
                        <td>${trCounter}</td>
                        <td>${kR?.filteredData[kRKey]['oz_user_name']}</td>
                        <td class="ac">${currentUserFaculty}</td>
                        <td class="ac">${kR?.filteredData[kRKey]['oz_user_course']}-bosqich</td>
                        <td class="ac">${currentUserGroup}</td>
                        <td class="ac">${kR?.filteredData[kRKey]['created_at']}</td>
                        <td class="ac">${notExit}</td>
                    </tr>`
                    }
                }

                let filteredTable = `
                <table id="kundalik-table" class="table table-hover table-bordered" style="display: none;width:100%">
                <thead>
                <tr class="ac">
                    <th width="5%" class="font-weight-bold">T/r</th>
                    <th width="25%" class="font-weight-bold">Talaba FIO</th>
                    <th width="15%" class="font-weight-bold">Fakultet</th>
                    <th width="15%" class="font-weight-bold">Bosqich</th>
                    <th width="10%" class="font-weight-bold">Guruh</th>
                    <th width="15%" class="font-weight-bold">Kirgan vaqti</th>
                    <th width="15" class="font-weight-bold">Chiqgan vaqti</th>
                </tr>
                </thead>
                <tbody>
                    ${tableContent}
                </tbody>
                <tfoot>
                <tr class="ac">
                    <th width="5%" class="font-weight-bold">T/r</th>
                    <th width="25%" class="font-weight-bold">Talaba FIO</th>
                    <th width="15%" class="font-weight-bold">Fakultet</th>
                    <th width="15%" class="font-weight-bold">Bosqich</th>
                    <th width="10%" class="font-weight-bold">Guruh</th>
                    <th width="15%" class="font-weight-bold">Kirgan vaqti</th>
                    <th width="15" class="font-weight-bold">Chiqgan vaqti</th>
                </tr>
                </tfoot>
            </table>`;

                $('#table-div').html(filteredTable);
                $('#kundalik-table').dataTable().css('display','table');
            }
            if (kR.answer === 'empty'){
                Swal.fire({
                    icon: 'info',
                    title: "Ma'lumot",
                    text: "Hech qanday ma'lumot topilmadi.",
                    allowOutsideClick: false
                }).then((emptyRes)=>{
                    if (emptyRes.isConfirmed){
                        location.reload();
                    }
                })
            }
        })
    })

})
