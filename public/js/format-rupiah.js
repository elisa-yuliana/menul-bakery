// Fungsi untuk memformat angka menjadi format ribuan dengan titik
function formatRupiah(angka) {
    if (!angka) return '';
    let number_string = angka.toString().replace(/[^0-9]/g, ''),
        sisa = number_string.length % 3,
        rupiah = number_string.substr(0, sisa),
        ribuan = number_string.substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        let separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }
    return rupiah;
}

// Inisialisasi event listener untuk semua input dengan class 'input-harga'
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.input-harga');
    
    inputs.forEach(input => {
        // --- TAMBAHKAN LOGIKA INI ---
        const hiddenId = input.getAttribute('data-target');
        const hiddenInput = document.getElementById(hiddenId);
        
        if (input.value && hiddenInput) {
            // Ambil angka saja dari input dan masukkan ke hidden
            hiddenInput.value = input.value.replace(/[^0-9]/g, '');
            // Format tampilannya agar ada titiknya sejak awal
            input.value = formatRupiah(input.value);
        }

        input.addEventListener('keyup', function() {
            // Ambil ID input hidden yang berpasangan (misal: harga_asli)
            const hiddenId = this.getAttribute('data-target');
            const hiddenInput = document.getElementById(hiddenId);
            
            let rawValue = this.value.replace(/[^0-9]/g, '');
            
            // Simpan angka murni ke input hidden
            if (hiddenInput) {
                hiddenInput.value = rawValue;
            }

            // Tampilkan format titik ke user
            this.value = formatRupiah(rawValue);
        });
    });
});