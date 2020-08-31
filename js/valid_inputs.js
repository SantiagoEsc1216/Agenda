
function valid_inputs(){
    const btn_submit =  document.getElementById("btn_submit");
    const submit_class = btn_submit.classList;

    const name_input = document.getElementById("input_name");
    const name_info = document.getElementById("name_info");

    const mail_input = document.getElementById("input_mail");
    const mail_info = document.getElementById("mail_info");

    const phone_input = document.getElementById("input_phone");
    const phone_info = document.getElementById("phone_info");

    const img_input = document.getElementById("input_img");
    const img_info = document.getElementById("img_info");
    
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

        function valid_phone(){
            let re = /^[0-9\+\- ]{10,18}$/;
            let match_invalid_character = phone_input.value.match(re);
        
            if(match_invalid_character === null){
                phone_info.classList.remove("text-muted");
                phone_info.classList.add("text-danger");

                return false;

            }else{
                phone_info.classList.add("text-muted");
                phone_info.classList.remove("text-danger");

                return true;

            }
        }

        function valid_img(){
            let re = /^(image\/)+(jpeg||png)$/

            if(img_input.value === ""){
               
                return true;
            }else{
                let img_type = img_input.files[0].type;
                let img_size = img_input.files[0].size;
    
                let match_invalid_character = img_type.match(re);

                if(match_invalid_character === null || img_size > 2097152){

                    img_info.classList.remove("text-muted");
                    img_info.classList.add("text-danger");
          
                    return false;
    
                }else{
                    img_info.classList.add("text-muted");
                    img_info.classList.remove("text-danger");
                    return true;
    
                    }
            }
           
        }

       function valid_form(){

        let a = valid_name();
        let b = valid_mail();
        let c = valid_phone();
        let d = valid_img();
       
           if(a === true && b === true && c === true && d === true ){
                unlock_button();
           }else{
            name_input.addEventListener("change", valid_name);
            mail_input.addEventListener("change", valid_mail);
            phone_input.addEventListener("change", valid_phone);
            img_input.addEventListener("change", valid_img);
            
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
        const container = document.getElementById("form-container");
        const contacts = document.getElementById("form");
        let div = document.createElement("div");
        let text = document.createTextNode(message);
    
        div.setAttribute("class", "mx-auto text-center alert alert-"+type);
        div.setAttribute("id", "alert")
      
        div.appendChild(text);
    
        container.insertBefore(div, contacts)
        }

        function clean_inputs(){
            const name_input = document.getElementById("input_name");
            const mail_input = document.getElementById("input_mail");
            const phone_input = document.getElementById("input_phone");
            const img_input = document.getElementById("input_img");
            
            name_input.value = "";
            mail_input.value = "";
            phone_input.value = "";
            img_input.value = "";
        }