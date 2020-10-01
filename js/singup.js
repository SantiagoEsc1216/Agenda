
function valid_inputs(){
    const btn_submit =  document.getElementById("btn_submit");
    const submit_class = btn_submit.classList;

    const name_input = document.getElementById("input_name");
    const name_info = document.getElementById("name_info");

    const mail_input = document.getElementById("input_mail");
    const mail_info = document.getElementById("mail_info");

    const pass_input = document.getElementById("input_pass");
    const pass_info = document.getElementById("pass_info");

    btn_submit.addEventListener("click", valid_form);


        function valid_name(){

            let re = /^[a-zA-Zá-ýÁ-Ý0-9\u00f1\u00d1\(\)+ ]+$/;

            let match_invalid_character = name_input.value.match(re);

            if(match_invalid_character === null){
                name_info.classList.remove("text-muted");
                name_info.classList.add("text-danger");

                return false;

            }else{
                name_info.classList.add("text-muted");
                name_info.classList.remove("text-danger");

                return true;
            }
        }

        function valid_mail(){
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

        function valid_pass(){
          let re = /^([a-zA-Zá-ýÁ-Ý0-9\u00f1\u00d1]{6,})+$/;

          let match_invalid_character = pass_input.value.match(re);

          if(match_invalid_character === null){
              pass_info.classList.remove("text-muted");
              pass_info.classList.add("text-danger");

              return false;

          }else{
              pass_info.classList.add("text-muted");
              pass_info.classList.remove("text-danger");

              return true;
          }
        }

       function valid_form(){

        let a = valid_name();
        let b = valid_mail();
        let c = valid_pass();

           if(a === true && b === true && c === true){
                unlock_button();
           }else{
            name_input.addEventListener("change", valid_name);
            mail_input.addEventListener("change", valid_mail);
            pass_input.addEventListener("change", valid_pass);
                lock_button();
           }

       }


       function lock_button(){
        btn_submit.type = "button";
        submit_class.remove("btn-primary");
        submit_class.add("btn-danger");
       }

       function unlock_button(){
        btn_submit.type = "submit";
        submit_class.remove("btn-danger");
        submit_class.add("btn-primary");
       }

    }

    function message(message, type){

        const container = document.body;

        let div = document.createElement("div");
        let text = document.createTextNode(message);

        div.setAttribute("class", "div_alert alert alert-"+type);
        div.setAttribute("id", "alert")

        div.appendChild(text);

        document.body.appendChild(div);

        }


    function alert_mail(){
        message("Este correo ya fue registrado", "danger");
    }

    function singup_error(){
        message("Ha ocurrido un error en el registro, recargue la pagina o intente mas tarde", "danger");
    }

    function go_login(){
        window.location.replace("http://localhost/Agenda/web_sites/login.php");
    }