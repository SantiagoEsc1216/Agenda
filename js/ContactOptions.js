

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

  }

  function form_contact(id){

    const card_header = document.getElementById("card-header-"+id);
    const card_body = document.getElementById("card-body-"+id);

    const name_input = document.createElement("input");
    name_input.setAttribute("class", "form-control");
    name_input.setAttribute("name", "name_contact")
    let name = card_header.childNodes[1];
    name_input.setAttribute("value", name.innerHTML);

    const mail_input = document.createElement("input");
    mail_input.setAttribute("class", "form-control");
    mail_input.setAttribute("name", "mail_contact")
    let mail = card_body.childNodes[1];
    mail_input.setAttribute("value", mail.innerHTML);

    const phone_input = document.createElement("input");
    phone_input.setAttribute("class", "form-control");
    phone_input.setAttribute("name", "phone_contact")
    let phone = card_body.childNodes[5];
    phone_input.setAttribute("value", phone.innerHTML);

    const img_input = document.createElement("input");
    img_input.type = "file";
    img_input.setAttribute("class", "form-control-file img_input");
    img_input.setAttribute("name", "img_contact");




          name.hidden = true;
          card_header.appendChild(name_input);

          mail.hidden = true;
          card_body.appendChild(mail_input);

          phone.hidden = true;
          card_body.appendChild(phone_input);

          const img_edit_div = document.getElementById("img-edit-"+id);
          img_edit_div.hidden = false;
          img_edit_div.appendChild(img_input);
  }

  function confirm_delete(id){
    const div_delete = document.getElementById("div-delete-"+id);

    div_delete.style.display = "inline-block";

    form_contact(id);

  }

  function cancel_delete(id){
    const div_delete = document.getElementById("div-delete-"+id);

    div_delete.style.display = "none";
    edit_cancel(id);
  }

  function delete_contact(id){
    const card = document.getElementById("card-"+id);
    const form = card.parentElement;
    const div_flex = form.parentElement;

    div_flex.style.display = "none";

  }

  function edit_options(id){

    const card = document.getElementById("card-"+id);
    const footer = document.getElementById("card-footer-"+id)
    const padlock = document.getElementById("padlock");

    footer.children[0].style.display = "none";
    footer.children[1].style.display = "none";
    footer.children[2].style.display = "inline-block";
    footer.children[3].style.display = "inline-block";

    const btn_edit = footer.children[3];

    padlock.style.width = "100vw";
    padlock.style.height = "100vh";

    card.style.zIndex = "100"

    form_contact(id);
  }

  function confirm_edit(id){
    const card = document.getElementById("card-"+id);
    const card_header = document.getElementById("card-header-"+id);
    const card_body = document.getElementById("card-body-"+id);
    const footer = document.getElementById("card-footer-"+id);

    const btn_submit = footer.childNodes[7];

    const name_input = card_header.childNodes[5];
    const name_info = card_header.childNodes[3];

    const mail_input = card_body.childNodes[9];
    const mail_info = card_body.childNodes[3];

    const phone_input = card_body.childNodes[10]
    const phone_info = card_body.childNodes[7];

    const img_edit_div = card.childNodes[5].childNodes[1];
    const img_input = img_edit_div.childNodes[3];
    const img_info = img_edit_div.childNodes[1];

    const a = valid_name(name_input, name_info);
    const b = valid_mail(mail_input, mail_info);
    const c = valid_phone(phone_input, phone_info);
    const d = valid_img(img_input, img_info);

    if(a === true && b === true && c === true && d === true){
      unlock_button(btn_submit);

    }else{
      lock_button(btn_submit);
    }

  }

  function edit_cancel(id){

    const card = document.getElementById("card-"+id);
    const card_header = document.getElementById("card-header-"+id);
    const card_body = document.getElementById("card-body-"+id);
    const footer = document.getElementById("card-footer-"+id)

    const name = card_header.childNodes[1];
    name.hidden = false;

    const mail = card_body.childNodes[1];
    mail.hidden = false;

    const phone = card_body.childNodes[5];
    phone.hidden = false;

    const name_input = card_header.childNodes[5];
    const name_info = card_header.childNodes[3];
    name_input.remove();
    name_info.hidden = true;

    const mail_input = card_body.childNodes[9];
    const mail_info = card_body.childNodes[3];
    mail_input.remove();
    mail_info.hidden = true;

    const phone_input = card_body.childNodes[9];
    const phone_info = card_body.childNodes[7];
    phone_input.remove();
    phone_info.hidden = true;

    const img_edit_div = card.childNodes[5].childNodes[1];
    const img_input = img_edit_div.childNodes[3];
    const img_info = img_edit_div.childNodes[1];
    img_input.remove();
    img_edit_div.hidden = true;
    img_info.hidden = true;

    const btn_submit = footer.childNodes[7];
    unlock_button(btn_submit);

    footer.children[0].style.display = "inline-block";
    footer.children[1].style.display = "inline-block";
    footer.children[2].style.display = "none";
    footer.children[3].style.display = "none";

    padlock.style.width = "0%";
    padlock.style.height = "0%";

    card.style.zIndex = "0";

  }

  function edit_success(){


    message("Contacto editado", "success")
    setTimeout(delete_message, 5000);

    location.reload(true);

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

    div.setAttribute("class", "alert alert-"+type);
    div.setAttribute("id", "alert")

    div.appendChild(text);

    document.body.appendChild(div);

    }



  function delete_message(){

    const container = document.getElementById("contacts-container");
    const alert = document.getElementById("alert");

    container.removeChild(alert);

  }


 function search_contact(search_input){

  const btn_search = document.getElementById("btn_search");

  search_input.addEventListener("change", search);
  btn_search.addEventListener("click", search)

   function search(){
     let  input_name_contacts = document.getElementsByName("name_contact");

      for (let index = 0; index < input_name_contacts.length; index++) {
        const header = input_name_contacts[index].parentElement;
        const card = header.parentElement;
        const form = card.parentElement;
        const div_parent = form.parentElement;

        const name_contact = input_name_contacts[index].value;

        const match_name = name_contact.toLowerCase().indexOf(search_input.value.toLowerCase());

        if(match_name === -1){
          div_parent.style.display = "none";
        }else{
          div_parent.style.display = "inline-block"
        }

        if(search_input.value == ""){
         div_parent.style.display = "inline-block";
       }

    }
  }

 }

 function valid_name(name_input, name_info){

  let re = /^[a-zA-Zá-ýÁ-Ý0-9\u00f1\u00d1\(\)+ ]+$/;

  let match_invalid_character = name_input.value.match(re);

  if(match_invalid_character === null){
      name_info.hidden = false;
      return false;

  }else{
      name_info.hidden = true;
      return true;
  }
}

function valid_mail(mail_input, mail_info){
  let re = /^([a-zA-Z-0-9_\.-]+)@([a-z_\.-]+)\.([a-z\.]{2,6})$/;

  let match_invalid_character = mail_input.value.match(re);

  if(match_invalid_character === null){
      mail_info.hidden = false;

      return false;

  }else{
      mail_info.hidden = true;

      return true;

  }
}

function valid_phone(phone_input, phone_info){
  let re = /^[0-9\+\- ]{10,18}$/;
  let match_invalid_character = phone_input.value.match(re);

  if(match_invalid_character === null){
      phone_info.hidden = false;
      return false;

  }else{
      phone_info.hidden = true;
      return true;

  }
}

function valid_img(img_input, img_info){
  let re = /^(image\/)+(jpeg||png)$/

  if(img_input.value === ""){

      return true;
  }else{
      let img_type = img_input.files[0].type;
      let img_size = img_input.files[0].size;

      let match_invalid_character = img_type.match(re);

      if(match_invalid_character === null || img_size > 2097152){
          img_info.hidden = false;
          return false;

      }else{
          img_info.hidden = true;
          return true;

          }
  }

}

function lock_button(btn_submit){
  const submit_class = btn_submit.classList;
  btn_submit.type = "button";
  submit_class.remove("btn-primary");
  submit_class.add("btn-danger");
 }

 function unlock_button(btn_submit){
  const submit_class = btn_submit.classList;
  btn_submit.type = "submit";
  submit_class.remove("btn-danger");
  submit_class.add("btn-primary");
 }