let phone = document.getElementById("phone");

function numberChecker(){
    if(isNaN(phone.value) || phone.value.length <12){
    alert("give a proper phone number");
    return false;
}
else{
    return true;
}
}