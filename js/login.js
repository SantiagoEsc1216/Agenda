
function visible_password(){

  const input_password = document.getElementById("pass");

    if(input_password.type === "password"){
        input_password.type = "text";
    }else{
        input_password.type = "password"
    }
}

function empty_input(){
    message("rellene todos los campos", "danger");
}

function login_error(){

    message("El usuario o contraseña es incorrecto", "danger");
    throw_error = false;
}


function message(message, type){

    const container = document.body;

  let div = document.createElement("div");
  let text = document.createTextNode(message);

  div.setAttribute("class", "div_alert alert alert-"+type);
  div.setAttribute("id", "alert");

  div.appendChild(text);

  container.appendChild(div);

  }
