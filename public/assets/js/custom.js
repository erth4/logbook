/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";


var Modal;
Modal = window.Modal || {}

Modal.create = function(modaltitle, ukuran = 'modal-lg', headerbg = '') {
    var data = `<div class="modal fade fadeIn" id="modal" data-keyboard="false" data-backdrop="static">
                            <div class="modal-dialog  ${ukuran}">
                                <div class="modal-content">
                                    <div class="modal-header ${headerbg}">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i class="fa fa-close fa-1x"></i> </button>
                                        <h5 class="modal-title" id="myModalLabel"> ${modaltitle} </h5>
                                    </div>
                                    <div id="modal-data" class="modal-body"></div>
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" class="btn btn-danger btn-md">Cancel</button>
                                        <button type="button" class="btn btn-primary btn-md btn-simpan">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>`
    $('body').append(data)
    $('#modal').modal('show')
    $('#modal-data').html('<div style="text-align:center">Loading...</div>')
}

Modal.createNoFooter = function(modaltitle, ukuran = 'modal-lg', headerbg = '') {
    var data = `<div class="modal fade fadeIn" id="modal" data-keyboard="false" data-backdrop="static">
                            <div class="modal-dialog  ${ukuran}">
                                <div class="modal-content">
                                    <div class="modal-header  ${headerbg}">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <i class="fa fa-close fa-1x"></i> </button>
                                        <h5 class="modal-title" id="myModalLabel"> ${modaltitle} </h5>
                                    </div>
                                    <div id="modal-data" class="modal-body"></div>
                                </div>
                            </div>
                        </div>`
    $('body').append(data)
    $('#modal').modal('show')
    $('#modal-data').html('<div style="text-align:center">Loading...</div>')
}

Modal.html = (data) => {
    $('#modal-data').html(data)
}

Modal.close = () => {
    $('.modal-body').html('')
    $('#modal').modal('hide');
    $('.modal-backdrop').remove();
}

$('body').on('hidden.bs.modal', function() {
    $('#modal').remove()
})

// toastr.options = {
//     positionClass: "toast-top-right"
// };

// $(document).ajaxStart(function() {
//     NProgress.start();
// });

// $(document).ajaxStop(function() {
//     NProgress.done();
// })

const formatDate = (date, format = 'full') => {
    var month_names = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var month_names_short = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    var spl = date.split('-');

    if (format == 'short') return `${spl[2]}-${month_names_short[parseInt(spl[1])-1]}-${spl[0]}`
    else return `${spl[2]}-${month_names[parseInt(spl[1])-1]}-${spl[0]}`
}

const formatMoney = (param) => {

    var uang = param.val();

    var hasil = uang;

    var result_uang = 0;

    if (hasil.indexOf(',') > -1 && hasil.indexOf('-') > -1) {

        var num_parts = hasil.toString().split(",");
        var hype = num_parts[0].toString().split("-");

        hype[1] = hype[1].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        result_uang = hype.join("-");
        result_uang = num_parts.join(',')

    } else if (hasil.indexOf('-') > -1) {

        var num_parts = hasil.toString().split("-");
        num_parts[1] = num_parts[1].replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        result_uang = num_parts.join("-");

    } else if (hasil.indexOf(',') > -1) {

        var num_parts = hasil.toString().split(",");
        num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        result_uang = num_parts.join(",");

    } else {

        result_uang = hasil.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");

    }

    return param.val(result_uang);

}
