let newPass = document.getElementById("newPass");
let confirmPass = document.getElementById("confirmPass");


const check = ()=>{
    if(newPass.value === confirmPass.value){
        return true;
    }
    else{
        alert("passwords does not match!")
        return false;
    }
}