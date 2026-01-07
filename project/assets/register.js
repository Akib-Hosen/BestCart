let mail = document.getElementById("mail");
let continueBtn = document.getElementById("ContinueBtn");
let confirmBtn = document.getElementById("confirmBtn");
let passField = document.getElementById("passField");
let passSection = document.getElementById("passSection");


Continue = () => {
    if (mail.value == "") {
        alert("Please a input mail.");
        return;
    }
    else if(!mail.checkValidity()){
        alert("Input a proper mail.");
        return;
    }
    else{
        mail.style.borderColor = "green";
        continueBtn.style.display = "none";
        confirmBtn.style.display = "block";
        passSection.style.display = "block";
    }
}



Confirm = ()=>{
    if(passField.value < 6){
        alert("The password is too short, at least 6 characters is required");
        return;
    }
}

continueBtn.addEventListener("click", Continue);
confirmBtn.addEventListener("click", Confirm);




checkMailField = () => {
    if (mail.value !== "") {
        continueBtn.style.backgroundColor = "#EC009B";
        continueBtn.style.color = "#ffffff";
    }
    
    else{
        continueBtn.style.backgroundColor = "#EFF1F4";
        continueBtn.style.color = "#858D9E";
    }
}

checkConfirm= ()=>{
    if(passField.value.length > 6){
        confirmBtn.style.backgroundColor = "#EC009B";
        confirmBtn.style.color = "white";
    }
    else{
        confirmBtn.style.backgroundColor = "#EFF1F4";
        confirmBtn.style.color = "#858D9E";
    }
}




mail.addEventListener("input", checkMailField);

passField.addEventListener("input", checkConfirm);

