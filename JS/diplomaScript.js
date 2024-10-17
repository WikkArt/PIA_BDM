function guardarDiploma() {
    const options = {
        margin: 1,
        filename: 'diploma.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    const diploma = document.getElementById('diploma');
    html2pdf().from(diploma).set(options).save();
}