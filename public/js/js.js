async function signup() {
    const login = $('#login');
    const password = $('#password');
    const confirm_password = $('#confirm_password');
    const email = $('#email');
    const name = $('#name');
    const data = {
        'login': login.val(),
        'password': password.val(),
        'confirm_password': confirm_password.val(),
        'email': email.val(),
        'name': name.val()
    }

    request('/signup', 'POST', data)
        .then(result => {
            $('.error').remove()
            const errors = result['errors'];
            if (errors) {
                for (const field in data) {
                    showErrors(errors, field)
                }
            } else {
                document.location.href = 'login'
            }
        })
}

async function logIn() {
    const login = $('#login');
    const password = $('#password');
    const data = {
        'login': login.val(),
        'password': password.val()
    }

    request('/login', 'POST', data)
        .then(result => {
            const errors = result['errors'];
            $('.error').remove()
            if (errors) {
                for (const field in data) {
                    showErrors(errors, field)
                }
            } else {
                document.location.href = '/'
            }
        })
}

async function request(url, method, data) {
    return await fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(data)
    })
        .then(response => response.json())
}

function showErrors(errors, field) {
    const div = (errors[field])?.map(value => {
        return "<div class='error'>" + value + "</div>"
    })
    $("#" + field).after(div)
}