$(function(){
    $(document).ready(function(){
        $('#userForm').submit(function(event){
            event.preventDefault()
            formValidate();
        })
    });
});

function formValidate(){
    if( $("#newPassword").val() != $("#confirmPassword").val()){
        alert("The Passwords must be equals");
    }else{
        form_data = new FormData(),
        form_data.append('actualPassword', $("#actualPassword").val())
        form_data.append('newPassword', $("#newPassword").val())
        form_data.append('confirmPassword', $("#confirmPassword").val())

        $.ajax({
            url: '../server/update_user.php',
            dataType: "json",
            cache: false,
            processData: false,
            contentType: false,
            data: form_data,
            type: 'POST',
            success: (data) =>{
              if (data.msg=="OK") {
                alert('The user was updated succesfully');
                window.location.href = '../client/index.html';
              }else if(data.msg=="session"){
                alert("No se ha iniciado sesion");
                window.location.href = '../login.html';
              }else {
                alert(data.msg)
              }
            },
            error: function(){
              alert("Error");
            }
          });
    }
}