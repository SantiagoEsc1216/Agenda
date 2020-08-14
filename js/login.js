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

  let throw_error = true;

  if (throw_error === true) {
    message("El usuario o contraseña es incorrecto", "danger");
    throw_error = false;
  }

  
}


function message(message, type){

    const container = document.getElementById("div-form");
    const inputs = document.getElementById("form");
    let div = document.createElement("div");
    let text = document.createTextNode(message);

    div.setAttribute("class", "mx-auto alert alert-"+type);
    div.setAttribute("id", "alert");
   // div.style.width = "95%";

    div.appendChild(text);

    container.insertBefore(div, inputs);

    }

  

  function delete_message(){

    const container = document.getElementById("contacts-container");
    const alert = document.getElementById("alert");
    
    container.removeChild(alert);

  }