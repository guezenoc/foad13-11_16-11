$(document).ready(function () {
    $("#form-inscription").validate({
        rules: {
            nom: {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                minlength: 8,
            },
            password_confirmed: {
                required: true,
                minlength: 8,
                equalTo: "#password"
            },
        },
        messages: {
            nom: {
                required: "un nom est requis"
            },
            email: {
                required: "un email est requis"
            },
            password: {
                required: "un mot de passe est requis",
                minlength: "la longueur de votre mot de passe est de 8 min"
            },
            password_confirmed: {
                required: "un mot de passe est requis",
                minlength: "la longueur de votre mot de passe est de 8 min",
                equalTo: "vos mots de passe ne sont pas identiques"
            },
        }
    })
});