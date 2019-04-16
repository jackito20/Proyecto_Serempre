$(function(){
    $(document).ready(function(){
        $('form').submit(function(event){
            event.preventDefault()
            formLogin();
        })
    });
});

function formLogin(){
    if( $("#inputUser").val() != "" && $("#inputPassword").val()!=""){
        form_data = new FormData(),
        form_data.append('name', $("#inputUser").val())
        form_data.append('password', $("#inputPassword").val())

        $.ajax({
            url: './server/check_login.php',
            dataType: "json",
            cache: false,
            processData: false,
            contentType: false,
            data: form_data,
            type: 'POST',
            success: (data) =>{
              if (data.msg=="OK") {
                window.location.href = './client/index.html';
              }else {
                alert(data.msg)
              }
            },
            error: function(){
              alert("Error");
            }
          });
    }else{
        alert("Login Error")
    }
}