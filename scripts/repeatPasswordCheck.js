function checkPass()
{
    var password = document.getElementById('password');
    var repeatPassword  = document.getElementById('repeatPassword');
    var repeatMessage = document.getElementById('repeatMessage');
    var submitButton = document.getElementById('submitButton');

    var goodColor = "#66cc66";
    var badColor  = "#ff6666";

    if(password.value == repeatPassword.value){
        repeatMessage.style.color = goodColor;
        repeatMessage.innerHTML = 'Passwords Match!';
        submitButton.disabled = false;

    }else{
        repeatMessage.style.color = badColor;
        repeatMessage.innerHTML = 'Passwords Do Not Match!';
        submitButton.disabled = true;
    }
}  