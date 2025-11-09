// ================================
// 🔹 LOGIN PAGE INTERAKSI
// ================================

// 👁️ Toggle tampil/sembunyi password
function togglePassword() {
    const passField = document.getElementById("password");
    passField.type = passField.type === "password" ? "text" : "password";
}

// 🚨 Auto-hide alert setelah 3 detik
document.addEventListener("DOMContentLoaded", () => {
    const alert = document.querySelector(".alert");
    if (alert) {
        setTimeout(() => {
            alert.style.opacity = "0";
            alert.style.transition = "opacity 0.5s ease";
            setTimeout(() => alert.remove(), 500);
        }, 3000);
    }
});

// ================================
// 🔹 DASHBOARD INTERAKSI
// ================================

// 🔍 Fungsi pencarian tabel mahasiswa
document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("searchInput");
    if (searchInput) {
        searchInput.addEventListener("keyup", function () {
            const filter = this.value.toLowerCase();
            const rows = document.querySelectorAll("table tbody tr");

            let found = false;

            rows.forEach((row) => {
                const text = row.textContent.toLowerCase();
                const visible = text.includes(filter);
                row.style.display = visible ? "" : "none";
                if (visible) found = true;
            });

            // Jika tidak ada hasil
            let noData = document.getElementById("noDataRow");
            if (!found) {
                if (!noData) {
                    const tbody = document.querySelector("table tbody");
                    noData = document.createElement("tr");
                    noData.id = "noDataRow";
                    noData.innerHTML = `<td colspan="6" class="text-center text-danger fw-bold">❌ Data tidak ditemukan</td>`;
                    tbody.appendChild(noData);
                }
            } else if (noData) {
                noData.remove();
            }
        });
    }
});

// ================================
// 🔹 CRUD NOTIFIKASI
// ================================

// Fungsi menampilkan notifikasi melayang
function showNotification(message, type = "success") {
    const notif = document.createElement("div");
    notif.className = `notif ${type}`;
    notif.textContent = message;

    // Style inline biar pasti muncul
    notif.style.position = "fixed";
    notif.style.top = "20px";
    notif.style.right = "20px";
    notif.style.padding = "12px 20px";
    notif.style.borderRadius = "8px";
    notif.style.color = "white";
    notif.style.fontWeight = "600";
    notif.style.zIndex = "9999";
    notif.style.boxShadow = "0 3px 10px rgba(0,0,0,0.1)";
    notif.style.transition = "opacity 0.3s ease";

    if (type === "success") notif.style.backgroundColor = "#198754";
    else if (type === "error") notif.style.backgroundColor = "#dc3545";
    else notif.style.backgroundColor = "#0d6efd";

    document.body.appendChild(notif);

    // Hilang otomatis setelah 3 detik
    setTimeout(() => {
        notif.style.opacity = "0";
        setTimeout(() => notif.remove(), 400);
    }, 3000);
}
