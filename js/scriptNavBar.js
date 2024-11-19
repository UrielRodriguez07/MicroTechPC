const bars = document.querySelector(".bars");

bars.onclick = function() {
    const navBar = document.querySelector(".nav-bar");
    // Alternar la clase "active" en el navbar
    navBar.classList.toggle("active");
    // Obtener el contenedor del carrusel
    const carrusel = document.querySelector(".container-fluid");
    // Si el navbar tiene la clase "active", cambiar el padding-top del carrusel
    if (navBar.classList.contains("active")) {
        carrusel.style.paddingTop = "550px"; // Establecer padding-top a 550px
    } else {
        carrusel.style.paddingTop = "0"; // Dejar padding-top en 0 si el navbar no está activo
    }
}