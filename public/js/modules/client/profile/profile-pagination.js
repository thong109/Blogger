$(document).ready(function () {
   let tab = getUrlParameter('tab');
   setActiveTab(tab);

   $(document).on('click', '.page-numbers li a', function (event) {
      event.preventDefault();
      var page = $(this).attr('href').split('page=')[1];
      let tab = getUrlParameter('tab');
      getMoreUsers(page, tab);
   });

   function getMoreUsers(page, tab) {
      if (tab == 'video') {
         $.ajax({
            type: "GET",
            url: urls.profile + '?tab=' + tab + '&page=' + page,
            data: { tab },
            success: function (data) {
               $('#video').html(data);
               history.pushState(null, '', '/profile' + '?tab=' + tab + '&page=' + page);
            }
         });
         return;
      }
      if (tab == 'wishlist') {
         $.ajax({
            type: "GET",
            url: urls.profile + '?tab=' + tab + '&page=' + page,
            data: { tab },
            success: function (data) {
               $('#wishlist').html(data);
               console.log(data);
               history.pushState(null, '', '/profile' + '?tab=' + tab + '&page=' + page);
            }
         });
         return;
      }
   }
});
/**
 * @param string tab 
 * 
 * @desc tab sẽ có value là null hoặc video hoặc wishlist
 */
function setActiveTab(tab) {
   if (!tab) {
      $(`#home-tab`).addClass("active");
      $(`#home`).addClass("active show")
   }
   // set active tab
   $(`#${tab}-tab`).addClass("active");

   //set active panel
   $(`#${tab}`).addClass("active show")
}

function getUrlParameter(sParam) {
   var sPageURL = window.location.search.substring(1),
      sURLVariables = sPageURL.split('&'),
      sParameterName,
      i;

   for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');

      if (sParameterName[0] === sParam) {
         return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
      }
   }
   return false;
};
