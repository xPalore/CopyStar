// Регистрация

$('#btn-register').click(function (e) {
    e.preventDefault();


    $('input').removeClass('error-input');

    let login = document.getElementById('login').value,
        password = document.getElementById('password').value,
        password_confirm = document.getElementById('password_confirm').value,
        email = document.getElementById('email').value,
        name = document.getElementById('name').value,
        lastname = document.getElementById('lastname').value,
        patronymic = document.getElementById('patronymic').value,
        checkbox = document.getElementById('rules').checked;


    $.ajax({
        url: 'App/Controllers/registerController.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password,
            password_confirm: password_confirm,
            email: email,
            name: name,
            lastname: lastname,
            patronymic: patronymic,
            checkbox: checkbox
        },
        success(data) {
            if (data.status) {
                document.location.href = '../profile.php';
            } else {
                if (data.type === 1) {
                    data.fields.forEach(function (field) {
                        $(`input[id="${field}"]`).addClass('error-input');
                        $('.error-msg').text(data.msg);
                    });
                } else if (data.type === 2) {
                    $(`input[id="${data.field}"]`).addClass('error-input');
                    $('.error-msg').text(data.msg);
                }
            }
        }
    });
});

//Вход

$('#btn-login').click(function (e) {
    e.preventDefault();


    $('input').removeClass('error-input');

    let login = document.getElementById('login').value,
        password = document.getElementById('password').value;


    $.ajax({
        url: 'App/Controllers/entranceController.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password,
        },
        success(data) {
            if (data.status) {
                document.location.href = '../profile.php';
            } else {
                data.fields.forEach(function (field) {
                    $(`input[id="${field}"]`).addClass('error-input');
                    $('.error-msg').text(data.msg);

                });
            }
        }
    });
});
