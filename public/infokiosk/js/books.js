$(document).ready(function () {
   $('.card').on('click', function () {
       let currentCatID = $(this).attr('id');
       window.location.href = window.location.href + `/${currentCatID}`;
       //console.log(window.location.href);
   })
});
