// Data tujuan pembayaran
const paymentOptions = {
    dana: {
        name: "Zahra dana",
        number: "0812-8781-9067"    
    },
    mandiri: {
        name: "Bank Mandiri - Zahra Rental",
        number: "1234-5678-9101-1121"
    },
    gopay: {
        name: "Zahra Gopay",
        number: "0812-9876-5432"
    }
};

// Fungsi untuk memperbarui detail pembayaran
function updatePaymentDetails() {
    const paymentSelect = document.getElementById("payment");
    const paymentDetails = document.getElementById("paymentDetails");
    const paymentName = document.getElementById("paymentName");
    const paymentNumber = document.getElementById("paymentNumber");

    const selectedOption = paymentSelect.value;

    if (paymentOptions[selectedOption]) {
        // Tampilkan detail pembayaran
        paymentName.textContent = paymentOptions[selectedOption].name;
        paymentNumber.textContent = paymentOptions[selectedOption].number;
        paymentDetails.style.display = "block";
    } else {
        // Sembunyikan detail pembayaran jika tidak ada yang dipilih
        paymentDetails.style.display = "none";
    }
}

// Status login
const isLoggedIn = window.isLoggedIn;

// Fungsi untuk mengecek login saat klik tombol booking
function validateLogin(event) {
    if (!isLoggedIn) {
        // Jika belum login, tampilkan alert dan cegah pengiriman formulir
        event.preventDefault();
        alert('Anda harus login terlebih dahulu untuk melakukan booking.');
        window.location.href = '../Login/loginnew.php'; // Arahkan ke halaman login
    }
}

