
var page=1;

$(function(){
    $(document).ready(function(){
        listClients();
        $('#newClient').click(function(event){
            event.preventDefault();
            showClientForm();
        });

        $('form').submit(function(event){
            event.preventDefault()
            if($(this).attr("id")=="newClientForm"){
                addClient();
            }else{
                updateClient()
            }
        })
    });
});

function addClient(){
    if( $("#inputCity").val() == ""){
        alert("Please, select a city");
    }else{
        form_data = new FormData(),
        form_data.append('name', $("#inputName").val())
        form_data.append('cod', $("#inputCode").val())
        form_data.append('city_id', $("#inputCity").val())

        $.ajax({
            url: '../server/new_client.php',
            dataType: "json",
            cache: false,
            processData: false,
            contentType: false,
            data: form_data,
            type: 'POST',
            success: (data) =>{
                if (data.msg=="OK") {
                    alert('The client was registered succesfully');
                    listClients();
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


function showClientList(data){
    $(".pagination").empty();
    $(".pagination").append("<li class='page-item' id='previous'><a class='page-link' href='#' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>");
    for(i=1; i<=data.total_pages; i++){
        if(i==page){
            $(".pagination").append("<li class='page-item active' aria-current='page' id='"+i+"'><a class='page-link' href='#'>"+i+"<span class='sr-only'>(current)</span></a></li>");
        }else{
            $(".pagination").append("<li class='page-item' id='"+i+"'><a class='page-link' href='#'>"+i+"</a></li>");
        }
    }
    $(".pagination").append("<li class='page-item' id='next'><a class='page-link' href='#' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>");
    
    $("tbody").empty();
    for (i = 0; i < data.clients.length; i++) {
        client = data.clients[i];
        $("tbody").append("<tr><th scope='row'>"+(i+1)+"</th><td>"+client["code"]+"</td><td>"+client["name"]+"</td><td>"+client["city"]["name"]+"</td><td><a href='' id='update"+i+"'>Editar</a><a href='' id='delete"+i+"'>    Eliminar</a></td></tr>")
        $("#update"+i).click(function(event){
            event.preventDefault();
            showUpdateClient(data.clients, this)
        })

        $("#delete"+i).click(function(event){
            event.preventDefault();
            deleteClient(data.clients, this)
        })
    }
    
    $('.page-item').click(function(event){
        event.preventDefault();
        idPage = $(this).attr("id");
        if(idPage=="previous"){
            if(page>1){
                page-=1;
            }
        }else if(idPage=="next"){
            if(page+1<=data.total_pages){
                page+=1;
            }
        }else{
            page=idPage;
        }
        listClients();
    });
}

function listClients(){
    $('#clientList').css("display", "block");
    $('#newClientBlock').removeClass("newClientShow");
    $('#newClientBlock').addClass("newClientHidden");
    $.ajax({
        url: '../server/get_clients.php?page='+page,
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        type: 'GET',
        success: (data) =>{
        if (data.msg=="OK") {
            showClientList(data, page);
          }else {
            alert(data.msg)
          }
        },
        error: function(){
          alert("Error");
        }
    });  
}

function showClientForm(defaultCity = ""){
    $('#clientList').css("display", "none");
    $('#newClientBlock').removeClass("newClientHidden");
    $('#newClientBlock').addClass("newClientShow");
    getCities(defaultCity);
}

function showUpdateClient(clients, index){
    index=parseInt($(index).attr("id").split("update")[1]);
    showClientForm(clients[index]["city"]["id"]);
    $("#inputCode").attr("value", clients[index]["code"]);
    $("#inputName").attr("value", clients[index]["name"]);
    $("#inputId").attr("value", clients[index]["id"]);
    $("form").attr("id", "updateClientForm");    
}

function updateClient(){
    if( $("#inputCity").val() == ""){
        alert("Please, select a city");
    }else{
        form_data = new FormData(),
        form_data.append('name', $("#inputName").val())
        form_data.append('cod', $("#inputCode").val())
        form_data.append('city_id', $("#inputCity").val())
        form_data.append('id', $("#inputId").val())

        $.ajax({
            url: '../server/update_client.php',
            dataType: "json",
            cache: false,
            processData: false,
            contentType: false,
            data: form_data,
            type: 'POST',
            success: (data) =>{
                if (data.msg=="OK") {
                    alert('The client was updated succesfully');
                    listClients();
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

function deleteClient(clients, index){
    index=parseInt($(index).attr("id").split("delete")[1]);
    form_data = new FormData(),
    form_data.append('id', clients[index]["id"])

    $.ajax({
        url: '../server/delete_client.php',
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        data: form_data,
        type: 'POST',
        success: (data) =>{
            if (data.msg=="OK") {
                alert('The client was deleted succesfully');
                listClients();
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

function getCities(defaultCity=""){
    $.ajax({
        url: '../server/get_cities.php',
        dataType: "json",
        cache: false,
        processData: false,
        contentType: false,
        type: 'GET',
        success: (data) =>{
          if (data.msg=="OK") {
            data.cities.forEach(city => {
                $("#inputCity").append("<option value='"+city.id+"'>"+city.name+"</option>");
            });
            $("#inputCity").val(defaultCity);
          }else {
            alert(data.msg)
          }
        },
        error: function(){
          alert("Error");
        }
    });
}


