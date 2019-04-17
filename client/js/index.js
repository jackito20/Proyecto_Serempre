$(function(){
    $(document).ready(function(){
        $('#client').load('./client.html');
        $("#client-tab").click(function(){
            $('#client').empty();
            $('#client').load('./client.html');
        })
        $("#user-tab").click(function(){
            $('#user').empty();
            $('#user').load('./user.html');
        })
        $("#close-tab").click(function(){
            logOut();
        })
    });
});

function logOut(){
    $.ajax({
        url: '../server/logout.php',
        cache: false,
        processData: false,
        contentType: false,
        type: 'GET',
        success: () =>{
          alert("Cerrado session...");
          window.location.href = '../login.html';
        },
        error: function(){
          alert("Error");
        }
    });
}
