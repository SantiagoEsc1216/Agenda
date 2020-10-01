function profile_options(){
    const btn_name = document.getElementById("btn_edit_username");
    const btn_mail = document.getElementById("btn_edit_mail");
    const btn_pass = document.getElementById("btn_edit_pass");
    const form_div = document.getElementById("form");
    const input = document.getElementById("input");
    const input_password = document.getElementById("input_password");
    const confirm_pass = document.getElementById("input_confirm_pass");
    const btn_cancel = document.getElementById("btn_cancel");
    const btn_submit = document.getElementById("btn_submit");
    const label = document.getElementById("label");
    const div_pass = document.getElementById("div_pass");
    btn_name.addEventListener("click", btn_edit_username);
    btn_mail.addEventListener("click", btn_edit_mail);
    btn_pass.addEventListener("click", btn_edit_pass);
    btn_cancel.addEventListener("click", reset_form);

    function reset_form(){
        input.setAttribute("name", "");
        input.type = "text";
        form_div.style.display = "none";
        input.value = "";
        input_password.value = "";
        label.innerHTML = "";
        div_pass.style.display = "none";
        confirm_pass.value ="";
        document.body.appendChild(form_div);
        unlock_button(btn_submit);
    }

    function btn_edit_username(){
        reset_form();
        form_div.style = "inline-block";
        const row_name = document.getElementById("row_name");
        input.setAttribute("name", "new_name");
        label.innerHTML = "Nuevo nombre:";
        row_name.appendChild(form_div);
    }

    function btn_edit_mail(){
        reset_form();
        form_div.style = "inline-block";
        const row_mail = document.getElementById("row_mail");
        input.setAttribute("name", "new_mail");
        input.type = "email";
        label.innerHTML = "Nuevo correo:"
        row_mail.appendChild(form_div);
    }

    function btn_edit_pass(){
        reset_form();
        form_div.style = "inline-block";
        const row_pass = document.getElementById("row_pass");
        input.setAttribute("name", "new_pass");
        input.type = "password";
        label.innerHTML = "Nueva Contraseña:";
        div_pass.style.display = "flex";
        row_pass.appendChild(form_div);
    }
}

function valid_inputs(){

    const input_variable = document.getElementById("input");
    const input_pass = document.getElementById("input_password");
    const input_confirm_pass = document.getElementById("input_confirm_pass");
    const btn_submit = document.getElementById("btn_submit");

    btn_submit.addEventListener("click", valid_form);

    function valid_name(){
        let re = /^[a-zA-Zá-ýÁ-Ý0-9\u00f1\u00d1\(\)+ ]+$/;

        let match_invalid_character = input_variable.value.match(re);

        if(match_invalid_character === null){
            return false;
        }else{
            return true;
        }
    }

    function valid_mail(){
        let re = /^([a-zA-Z-0-9_\.-]+)@([a-z_\.-]+)\.([a-z\.]{2,6})$/;

        let match_invalid_character = input_variable.value.match(re);

        if(match_invalid_character === null){
            return false;
        }else{
            return true;
        }
    }

    function valid_pass(input_password){
        let re = /^([a-zA-Zá-ýÁ-Ý0-9\u00f1\u00d1]{6,})+$/;

        let match_invalid_character = input_password.value.match(re);

        if(match_invalid_character === null){
            return false;
        }else{
            return true;
        }
      }

    function confirm_pass(){
        if(input_variable.value == input_confirm_pass.value){
            return true;
        }else{
            return false;
        }
    }

    function valid_form(){
        let a = false;
        const b = valid_pass(input_pass);
        if(input_variable.getAttribute("name") == "new_mail"){
            a = valid_mail();
        }
        if(input_variable.getAttribute("name") == "new_name"){
            a = valid_name();
        }

        if(input_variable.getAttribute("name") == "new_pass"){
            if(valid_pass(input_variable)){
                if(confirm_pass()){
                    a = true;
                }else{
                    if (!document.getElementById("alert")) {
                        message("Las contraseñas no coinciden", "danger");
                    }
                    a = false;
                }
            }else{
                if (!document.getElementById("alert")) {
                    message("Ingrese una contraseña valida de minimo 6 letras o numeros, nada de caracteres especiales", "danger");
                }
                a =  false;
            }
        }

        if(b == false){
            message("La contraseña no es valida", "danger");
        }

        if(a === true && b === true){
            unlock_button(btn_submit);
        }else{
            lock_button(btn_submit);
        }
    }

}

    function message(message, type){
        const container = document.getElementById("user_options");
        let div = document.createElement("div");
        let text = document.createTextNode(message);

        div.setAttribute("class", "div_alert alert alert-"+type);
        div.setAttribute("id", "alert")

        div.appendChild(text);

        document.body.insertBefore(div, container);
        setTimeout(delete_message, 5000);
    }

    function delete_message(){

        const container = document.body;
        const alert = document.getElementById("alert");

        container.removeChild(alert);

      }

      function lock_button(btn_submit){
        btn_submit.type = "button";
        btn_submit.classList.remove("btn-primary");
        btn_submit.classList.add("btn-danger");
       }

       function unlock_button(btn_submit){
        btn_submit.type = "submit";
        btn_submit.classList.remove("btn-danger");
        btn_submit.classList.add("btn-primary");
       }