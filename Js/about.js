document.addEventListener("DOMContentLoaded", function() {
    const text = "Selamat datang di Zahrarental"; 
    let index = 0;
    let deleting = false;
    const element = document.getElementById("typedText");

    function typeWriter() {
        if (deleting) {
            element.innerHTML = text.substring(0, index - 1);
            index--;
            if (index === 0) {
                deleting = false;
                setTimeout(typeWriter, 500);
            } else {
                setTimeout(typeWriter, 100);
            }
        } else {
            element.innerHTML = text.substring(0, index + 1);
            index++;
            if (index === text.length) {
                deleting = true;
                setTimeout(typeWriter, 1000);
            } else {
                setTimeout(typeWriter, 100);
            }
        }
    }

    typeWriter();
});
