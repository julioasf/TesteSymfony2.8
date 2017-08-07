function confirmarExclusao(){
    var opcao = confirm("Atenção!\n\nDeseja realmente efetuar a exclusão?");
    if(opcao == false){
        return false;
    }
}