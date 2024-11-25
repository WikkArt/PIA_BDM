// Obtener todas las filas de la tabla que contienen los botones
const filas = document.querySelectorAll('.columna-botones');

filas.forEach(fila => {

    const btnBloqueado = fila.querySelector('.bloqueado');
    const btnDesbloqueado = fila.querySelector('.desbloqueado');

    btnBloqueado.addEventListener('click', () => {
        btnBloqueado.disabled = true;
        btnDesbloqueado.disabled = false;
    });

    btnDesbloqueado.addEventListener('click', () => {
        btnBloqueado.disabled = false;
        btnDesbloqueado.disabled = true;
    });
});