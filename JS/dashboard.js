/*MODAL CURSO*/
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('idModalDashboard');
    document.getElementById('dashboard').addEventListener('click', (event) => {
        const course = event.target.closest('.course');
        if (course) {
            document.getElementById('modal-title').innerText = course.querySelector('h2').innerText;
            document.getElementById('modal-description').innerText = course.dataset.description;
            document.getElementById('modal-image').src = course.querySelector('img').src;
            document.getElementById('modal-category').innerText = course.querySelector('p').innerText;
            document.getElementById('modal-price').innerText = course.dataset.price;
            document.getElementById('modal-publisher').innerText = course.dataset.publisher;
            document.getElementById('modal-idcourse').href = "index.php?controlador=cursos&accion=mostrarInfo&idCurso="+course.dataset.idcourse;
            modal.style.display = 'block';
        }
    });
    document.querySelector('.close').addEventListener('click', () => {
        modal.style.display = 'none';
    });
    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});

/*MODAL CATEGORIA*/
$('#idCategoriaModal').on('shown.bs.modal', function () {
    $('#idCategoriaModal').trigger('focus')
})
