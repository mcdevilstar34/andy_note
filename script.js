function copyNote(id) {
    // Mengambil teks dari catatan berdasarkan ID
    const text = document.getElementById('text-' + id).innerText;
    
    // Proses menyalin ke clipboard (memori HP/PC)
    navigator.clipboard.writeText(text).then(() => {
        alert("Catatan berhasil disalin ke memori!");
    }).catch(err => {
        console.error('Gagal menyalin: ', err);
    });
}