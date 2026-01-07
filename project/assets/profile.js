const options = document.querySelectorAll(".option");
const detailBox = document.getElementById("optionDetails");
const email = detailBox.dataset.email;


options.forEach(option => {
    option.addEventListener("click", (e) => {

        const id = option.id;

        if (id == "logout") return;

        e.preventDefault();
        if (id == "profile") {
            let opt = document.getElementById(id);
            options.forEach(o => o.style.color = "#7F8899");
            opt.style.color = "#EC009B";
            
        }
        
    })
})