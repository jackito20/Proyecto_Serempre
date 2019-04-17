$(function(){
    $(document).ready(function(){
        $('form').submit(function(event){
            event.preventDefault()
            formValidate();
        })
    });
});

function formValidate(){
    if( $("#inputPassword").val() != $("#inputConfirmPassword").val()){
        alert("The Passwords must be equals");
    }else{
        form_data = new FormData(),
        form_data.append('name', $("#inputUser").val())
        form_data.append('password', $("#inputPassword").val())
        form_data.append('passwordConfirm', $("#inputConfirmPassword").val())

        $.ajax({
            url: '../server/new_user.php',
            dataType: "json",
            cache: false,
            processData: false,
            contentType: false,
            data: form_data,
            type: 'POST',
            success: (data) =>{
              if (data.msg=="OK") {
                alert('The user was registered succesfully');
                window.location.href = '../index.html';
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