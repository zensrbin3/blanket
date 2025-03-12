
document.addEventListener("DOMContentLoaded", function(){
    const radios = document.querySelectorAll('.radio-custom input[type="radio"][disabled]');
    radios.forEach(function(radio) {
    radio.style.transition = 'opacity 0.5s ease';
    radio.style.opacity = 0;
    setTimeout(function() {
    radio.style.display = 'none';
}, 500);
});
});
