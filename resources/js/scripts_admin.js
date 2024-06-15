// Receber o seletor do campo preço

let inputPrice = document.getElementById('price');

//Verificar se eixiste o seletor no HTML
if(inputPrice){
    // Aguardar o usuário digitar valor no campo
    inputPrice.addEventListener('input', function(){
        // Obter o valor atual removendo qualquer caracter que nõa seja numero;
        let valuePrice = this.value.replace(/[^\d]/g, '');
        // Adicionar os separadores de milhares
        var formattedPrice = (valuePrice.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.')) + '' +
        valuePrice.slice(-2);
        //Adicionar a virgula e ate dois digitos se houver os centavos
        if(formattedPrice.length > 2){
            formattedPrice = formattedPrice.slice(0, -2) + "," + formattedPrice.slice(-2);
        }
        //atualizar o valor do campo
        this.value = formattedPrice;

    })
}