function validarSenha(senha) {
    var erros = [];

    if (!senha) {
        erros.push("número mínimo 8 caracteres, número, letra minúscula, letra maiúscula e caractere especial");
    } else {
        if (senha.length < 8) {
            erros.push("número mínimo caracteres");
        }
        if (!/[a-z]/.test(senha)) {
            erros.push("letra minúscula");
        }
        if (!/[A-Z]/.test(senha)) {
            erros.push("letra maiúscula");
        }
        if (!/\d/.test(senha)) {
            erros.push("número");
        }
        if (!/[\W_]/.test(senha)) {
            erros.push("caractere especial");
        }
    }
    if (erros.length > 0) {
        return "Não contém " + erros.join(", ");
    } else {
        return "Senha válida";
    }
}