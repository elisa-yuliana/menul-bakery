// Tunggu sampai DOM selesai dimuat
document.addEventListener('DOMContentLoaded', function() {
    const inputCari = document.getElementById('cariBahan');
    
    // Jika input pencarian ada di halaman tersebut
    if (inputCari) {
        inputCari.addEventListener('keyup', function() {
            let filter = this.value.toLowerCase();
            // Ambil semua baris di dalam tbody
            let rows = document.querySelectorAll("table tbody tr");

            rows.forEach(row => {
                // Kolom nama bahan biasanya ada di index ke-1 (setelah kolom No)
                let namaBahan = row.cells[1].textContent.toLowerCase();
                
                // Jika teks pencarian cocok dengan nama bahan
                if (namaBahan.includes(filter)) {
                    row.style.display = ""; // Tampilkan
                } else {
                    row.style.display = "none"; // Sembunyikan
                }
            });
        });
    }
});