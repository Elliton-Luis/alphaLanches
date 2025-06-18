$wire.on('closeModal',()=>{
    let modalElement = document.getElementById('modal-add');
    let modalInstance = bootstrap.Modal.getInstance(modalElement);

    if(modalInstance){
        modalInstance.hide();
    }
});