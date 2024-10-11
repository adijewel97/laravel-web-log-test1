 var ShowMsgSm = function(title,message,type) {
    let tybtn = '';
    if (type == 'MB_CLOSE') {
        tybtn =  '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
    };

    let myscript ='';

    myscript =
        '<div class="modal fade" tabindex="-1" id="bs-alert">'+
            '<div class="modal-dialog">'+    //    '<div class="modal-dialog modal-sm">'+
                '<div class="modal-content">'+
                    '<div class="modal-header">'+
                        '<h4 class="modal-title">'+title+'</h4>'+
                        '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span>'+
                        '</button>'+
                    '</div>'+
                    '<div class="modal-body">'+
                        '<div>'+message+'</div>'+
                    '</div>'+
                    '<div class="modal-footer">';  // '<div class="modal-footer justify-content-between">'+
                     myscript += tybtn;
         myscript += '</div>'+
                '</div>'+
            '</div>'+
        '</div>';

    if ($("#bs-alert").length == 0) {
        $('body').append(myscript)
    } else {
       $("#bs-alert .modal-body").text(message);
    }

    $("#bs-alert").modal();
 }


 