var check = function () {
    if (document.getElementById('password').value == document.getElementById('confirm_password').value) {
        document.getElementById('message').style.color = 'green';
        document.getElementById('message').innerHTML = 'Matching';
        $('#submit-button').prop('disabled', false);

    } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('message').innerHTML = 'Not matching';
        document.getElementById('submit-button').prop()
    }
}





var $password1 = $("#password"),
    $password2 = $("#confirm_password"),
    $statusMessage = $("#validate-status"),
    $submitButton = $('#submit-button');

function validate() {

    if($password1.val() == $password2.val()) {
        $statusMessage.text("Passwords Match!");
        $submitButton.prop('disabled', false);
    }
    else {
        $statusMessage.text("Passwords Do Not Match!");
        $submitButton.prop('disabled', true);
    }
}



