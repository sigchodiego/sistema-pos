$("#formulariologin").on("submit", function (e) {
    e.preventDefault();
    const login = $("#login").val();
    const clave = $("#clave").val();

    $.post("../ajax/usuarios.php?op=verificar",
        { login: login, clave: clave },
        function (data) {
            if (data != "null") {
                $(location).attr("href", "categorias.php");
            } else {
                bootbox.alert("Usuario y o password incorrectos");
            }
        }
    )
});