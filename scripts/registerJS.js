function checkPass()
{
    var password = document.getElementById('password');
    var repeatPassword  = document.getElementById('repeatPassword');

    if(password.value === repeatPassword.value){
        repeatMessage.innerHTML = '';
        return true;

    }else{
        repeatMessage.style.color = "#ff6666";
        repeatMessage.innerHTML = 'Passwords Do Not Match!';
        return false;
    }
}

function checkMail()
{
  var email = document.getElementById('email').value;
  
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  
    if(re.test(String(email).toLowerCase())){
        emailMessage.innerHTML = '';
        return true;
    }else{
        emailMessage.style.color = "#ff6666";
        emailMessage.innerHTML = 'Enter a valid e-mail address!';
        return false;
    }
}