document.getElementById('bolsista').addEventListener('change', function () {
    var selectedOption = this.options[this.selectedIndex];
    var nomeBolsista = selectedOption.getAttribute('data-nome');
    
    // Atualizando todos os campos ocultos com o mesmo nome
    var camposNomeBolsista = document.getElementsByName('nome_bolsista');
    for (var i = 0; i < camposNomeBolsista.length; i++) {
        camposNomeBolsista[i].value = nomeBolsista;
    }
});
