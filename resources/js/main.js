
import Toast from './src/toast'
$(document).ready(function (){
    $('body').on('click','.open_modal_class',function (e){
        e.preventDefault();
        const elem      =   $(this);
        const url       =   elem.attr('url');
        const method    =   elem.attr('method');
        const is_html    =   Number(elem.attr('is_html'));
        const modal_size    =   elem.attr('modal_size');
        const param     =   JSON.parse(elem.attr('params'));
        let config = {
            headers: {
                Accept:(is_html ===1)?'text/html':'application/json'
            }
        }
        axios[method](url,param,config).then(function (response) {
            $('#default_modal .modal-dialog').addClass('modal-'+modal_size);
            $('#default_modal .modal-content').html(response.data);
            $('#default_modal').modal('show')
        }).catch(function (error) {
            ToastShow('Error',error.response.statusText,'bg-danger')
        })
        return false;
    });
    $('body').on('click','.btn-close',function (){
        $('#Notification .toast').addClass('');
        $('#Notification .toast-header strong').html('')
        $('#Notification .toast-body').html('')
    });
});

const ToastShow =function (Title,Messages,Class){
    $('#Notification .toast').addClass(Class);
    $('#Notification .toast-header strong').html(Title)
    $('#Notification .toast-body').html(Messages)
    var toast = new Toast(document.getElementById('Notification'));
    toast.show()
}
