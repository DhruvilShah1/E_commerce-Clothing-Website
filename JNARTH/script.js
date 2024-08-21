document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form');
    const pass = document.getElementById('password');
    const cpass = document.getElementById('cpassword');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); 

        if (pass.value !== cpass.value) {
            swal({
                title: "Registration Unsuccessful!",
                text: "Passwords do not match.",
                icon: "error",
                timer: 3000,
                buttons: false
            });
            
        } else {
            swal({
                title: "Registration Successful!",
                text: "You will be redirected shortly.",
                icon: "success",
                timer: 2000,
                buttons: false
            }).then(() => {
                window.location.href = 'sign.html';
            });
        }
    });
});
