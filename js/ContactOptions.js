

  function print_contact(name, image, phone, mail, i){

    var cards_container = document.getElementById("cards_container");

    //divs card
    var card_row = document.createElement("div");
    var card = document.createElement("div") ;
    var card_header = document.createElement("div") ;
    var card_body = document.createElement("div") ;
    var card_footer = document.createElement("div") ;


    // class/style divs card
    card_row.setAttribute("class", "col col-md-3 col-xs-12 mt-2" ) 
    card.setAttribute("class", "card");
    card_header.setAttribute("class", "card-header")
    card_body.setAttribute("class", "card-body")
    card_footer.setAttribute("class", "card-footer text-center")

    // elements card
    var p_name = document.createElement("p");
    var img = document.createElement("img");
    var p_phone = document.createElement("p");
    var p_mail = document.createElement("p");
    var btn_edit = document.createElement("button");
    var btn_delete = document.createElement("button");
    var btn_cancel = document.createElement("button");
    var btn_accept = document.createElement("button");

    // class/style elements card
    var p_class = "card-text"
    p_name.setAttribute("class", p_class);
    p_phone.setAttribute("class", p_class);
    p_mail.setAttribute("class", p_class);
    img.setAttribute("class", "card-img-top rounded");
    img.style.height = "25vh";
    img.style.objectFit = "cover";
    btn_edit.setAttribute("class", "btn btn-primary mx-1");
    btn_delete.setAttribute("class", "btn btn-danger mx-1");
    btn_cancel.setAttribute("class", "btn btn-danger mx-1");
    btn_accept.setAttribute("class", "btn btn-primary mx-1");
    btn_accept.setAttribute("name", "btn_accept");
    btn_delete.setAttribute("name", "btn_delete");
    btn_edit.setAttribute("onclick", "edit_options(this)")
    btn_edit.setAttribute("onsubmit", "return false")

    btn_accept.style.display = "none";
    btn_cancel.style.display = "none";

    // value elements card card
    var contact_img = "../Imagenes/" + image;
    var text_edit = document.createTextNode("editar");
    var text_delete = document.createTextNode("eliminar");
    var text_cancel = document.createTextNode("cancelar");
    var text_accept = document.createTextNode("aceptar");

    var name_input = document.createElement("input");
    var mail_input = document.createElement("input");
    var phone_input = document.createElement("input");

    name_input.setAttribute("name", "NameContact");
    phone_input.setAttribute("name", "PhoneContact");
    mail_input.setAttribute("name", "MailContact");
    name_input.setAttribute("class", "form-control");
    phone_input.setAttribute("class", "form-control");
    mail_input.setAttribute("class", "form-control");


    name_input.setAttribute("value", name)
    mail_input.setAttribute("value" ,mail);
    phone_input.setAttribute("value" ,phone);
    name_input.readOnly = true;
    mail_input.readOnly = true;
    phone_input.readOnly = true;

    p_name.appendChild(name_input);
    p_phone.appendChild(phone_input);
    p_mail.appendChild(mail_input);
    img.setAttribute("src", contact_img)
    btn_edit.appendChild(text_edit);
    btn_delete.appendChild(text_delete);
    btn_cancel.appendChild(text_cancel);
    btn_accept.appendChild(text_accept);
    card_footer.appendChild(btn_edit);
    card_footer.appendChild(btn_delete);
    card_footer.appendChild(btn_cancel);
    card_footer.appendChild(btn_accept);

    // asignar elementos de card a padre
    card_row.appendChild(card);
    card.appendChild(card_header);
    card.appendChild(card_body);
    card.appendChild(card_footer);

    // asignar valores de contacto a elementos de card
    card_header.appendChild(p_name);
    card.insertBefore(img, card_body)
    card_body.appendChild(p_phone);
    card_body.appendChild(p_mail);

    
    card.setAttribute("id", "card_"+i);
    name_input.setAttribute("id", "name_"+i);
    mail_input.setAttribute("id", "mail_"+i);
    phone_input.setAttribute("id", "phone_"+i);
    img.setAttribute("id", "img_"+i);
    btn_edit.setAttribute("id", i);

    // insertar cards en el DOM 
    cards_container.appendChild(card_row);
    
    function aa(){
      
    }
  }


  function edit_options(id){


    const card = document.getElementById("card-"+id);
    const card_header = document.getElementById("card-header-"+id);
    const card_body = document.getElementById("card-body-"+id);
    const footer = document.getElementById("card-footer-"+id)
    const padlock = document.getElementById("padlock");


  
    card_header.children[0].readOnly = false;

    card_body.children[0].readOnly = false;
    card_body.children[1].readOnly = false;

    footer.children[0].style.display = "none";
    footer.children[1].style.display = "none";
    footer.children[2].style.display = "inline-block";
    footer.children[3].style.display = "inline-block";

    padlock.style.width = "100%";
    padlock.style.height = "100%";

    card.style.zIndex = "100"
    
    return false;
  }

  function edit_cancel(button){

    const id = button.id;
    const card = document.getElementById("card-"+id);
    const card_header = document.getElementById("card-header-"+id);
    const card_body = document.getElementById("card-body-"+id);
    const footer = document.getElementById("card-footer-"+id)
  
    card_header.children[0].readOnly = true;

    card_body.children[0].readOnly = true;
    card_body.children[1].readOnly = true;

    footer.children[0].style.display = "inline-block";
    footer.children[1].style.display = "inline-block";
    footer.children[2].style.display = "none";
    footer.children[3].style.display = "none";

    padlock.style.width = "0%";
    padlock.style.height = "0%";

    card.style.zIndex = "0"
    
    
    return false;
  }

  function edit_success(){

    message("Contacto editado", "success")
    setTimeout(delete_message, 5000);
    
  }

    function edit_error(){

      message("Error al editar el contacto, revise que todos los campos esten rellenados o intente recargar la pagina", "danger")

    }

    function delete_error(){

      message("Error al eliminar contacto, intente recargar la pagina", "danger") 

    }


    function message(message, type){

    const container = document.getElementById("contacts-container");
    const contacts = document.getElementById("cards_container");
    let div = document.createElement("div");
    let text = document.createTextNode(message);

    div.setAttribute("class", "mx-auto alert alert-"+type);
    div.setAttribute("id", "alert")
   // div.style.width = "95%";

    div.appendChild(text);

    container.insertBefore(div, contacts)

    }

  

  function delete_message(){

    const container = document.getElementById("contacts-container");
    const alert = document.getElementById("alert");
    
    container.removeChild(alert);

  }
