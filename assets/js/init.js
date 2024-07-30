window.addEventListener("load", function(){ 

    "use strict"; 
    const form = document.querySelector(".contact") 
    form.addEventListener("submit", function (event){
        event.preventDefault() 
        let fields = document.querySelectorAll(".contact .form-control") 
        let valid = true
        if(valid){ 
            document.querySelector(".formfields").style.display = "none"
            document.querySelector("#alert"). innerText = "Processing your submission, please wait..."
            grecaptcha.ready(function() { 
                grecaptcha
                    .execute("6LfykhoqAAAAAO6vEXGgXCpbGRpIIpRnAXUHuee-", {
                        action: "contact"
                    }) 
                    .then(function(token){
                        
                        let recaptchaResponse = document.getElementById("recaptchaResponse")
                        recaptchaResponse.value = token 

                        fetch("/verify.php", {
                            method: "POST",
                            body: new FormData(form), 
                        })
                            .then((response) => {
                                response.text()
                                console.log("fetch req sent")
                            })
                            .then((response) => {
                                console.log(response)
                                // window.location.replace("/thanks.html") 
                            })
                    })
            })
        }
    })
})