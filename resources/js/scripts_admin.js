
let inputPrice = document.getElementById('price');
// verificar se existe o campo preço
if(inputPrice){
    inputPrice.addEventListener('input', function(){
        let v = this.value.replace(/\D/g,"");

        v = (v/100).toFixed(2) + "";

        v = v.replace(".", ",");
        v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
        v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
        this.value=v

    });
}



// receber o seletor apagar e percorrer a lista de registro
document.querySelectorAll('.btnDelete').forEach(function (button){

    // aguardar o clique no botao apagar
    button.addEventListener('click', function (event){
        event.preventDefault();

        // receber o atributo que possui o id do registro que deve ser excluido
        var deleteId = this.getAttribute('data-delete-id');

        Swal.fire({
            title: 'Tem certeza?',
            text: 'Essa ação não poderá ser revertida',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#0d6efd',
            cancelButtonText: 'Cancelar',
            confirmButtonColor: '#dc3445',
            confirmButtonText: 'Sim, excluir!'
        }).then((result)=>{
            // carregar a pagina responsvel em excluir se o usuario confirmar a exclusao
            if(result.isConfirmed){
                document.getElementById(`edit${deleteId}`).submit();

            }
        });
    });
});

// select2
$(function() {
    $('.select2').select2({
        theme: 'bootstrap-5'
    });
});
