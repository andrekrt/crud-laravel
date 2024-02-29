let inputPrice = document.getElementById('price');

inputPrice.addEventListener('input', function(){
    let v = this.value.replace(/\D/g,"");

    v = (v/100).toFixed(2) + "";

    v = v.replace(".", ",");
    v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1.$2.$3,");
    v = v.replace(/(\d)(\d{3}),/g, "$1.$2,");
    this.value=v
   
});