yii.confirm = function (message, okCallback,cancelCallback){
    swal({
        title: message,
        type: 'warning',
        showCancelButton:true,
        closeOnConfrim: true ,
        allowOutsideClick:true
    }, okCallback);
}