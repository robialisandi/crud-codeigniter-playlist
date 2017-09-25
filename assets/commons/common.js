var COMMON = COMMON || {};

COMMON.Page = COMMON.Page || {};

COMMON.Components = {
   GetMessage: {
      confirm: function(popupTitle, messageID, messageParam, isReload, funcCallback, paramFunc) {
         bootbox.dialog({
             title: '<div class="close" style="opacity: 1 !important; margin-top: -7px;">confirm</div><h4 class="modal-title" id="popup-title">' + popupTitle + '</h4>',
             message: result,
             closeButton: false,
             buttons: {
                 success: {
                     label: "Yes",
                     className: "btn-success",
                     callback: function () {
                         return funcCallback(paramFunc);
                     }
                 },
                 danger: {
                     label: "No",
                     className: "btn-danger",
                     callback: function () {
                         COMMON.Components.GetMessage.isReloaded(isReload);
                     }
                 }
             }
         });
      }
   }
};
