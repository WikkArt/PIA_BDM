function openModal(title, description, image, category, price, publisher) {
    document.getElementById('modal-title').innerText = title;
    document.getElementById('modal-description').innerText = description;
    document.getElementById('modal-image').src = image;
    document.getElementById('modal-category').innerText = `Categoría: ${category}`;
    document.getElementById('modal-price').innerText = `Precio: ${price}`;
    document.getElementById('modal-publisher').innerText = `Publicado por: ${publisher}`;
    document.getElementById('modal').style.display = 'block';
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';
}

// Asegúrate de que el DOM esté completamente cargado antes de agregar los event listeners
document.addEventListener('DOMContentLoaded', function() {
    const courses = document.querySelectorAll('.course');
    courses.forEach(course => {
        course.addEventListener('click', function() {
            const title = this.querySelector('h2').innerText;
            const description = this.getAttribute('data-description');
            const image = this.querySelector('img').src;
            const category = this.querySelector('p').innerText;
            const price = this.getAttribute('data-price');
            const publisher = this.getAttribute('data-publisher');
            openModal(title, description, image, category, price, publisher);
        });
    });

    document.querySelector('.close').addEventListener('click', closeModal);
});
