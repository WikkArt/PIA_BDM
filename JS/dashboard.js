
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal');
    document.querySelector('.courses').addEventListener('click', (event) => {
        const course = event.target.closest('.course');
        if (course) {
            document.getElementById('modal-title').innerText = course.querySelector('h2').innerText;
            document.getElementById('modal-description').innerText = course.dataset.description;
            document.getElementById('modal-image').src = course.querySelector('img').src;
            document.getElementById('modal-category').innerText = `Categoría: ${course.querySelector('p').innerText}`;
            document.getElementById('modal-price').innerText = `Precio: ${course.dataset.price}`;
            document.getElementById('modal-publisher').innerText = `Publicado por: ${course.dataset.publisher}`;
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


