const captchaLabel = document.getElementById("captchaLabel");
const refreshCaptcha = document.getElementById("refreshCaptcha");
const kwitansiForm = document.getElementById("kwitansiForm");
const dataTable = document.getElementById("dataTable");

let captchaValue;

// Fungsi untuk generate captcha
function generateCaptcha() {
    const a = Math.floor(Math.random() * 10);
    const b = Math.floor(Math.random() * 10);
    captchaValue = a + b;
    captchaLabel.textContent = `${a} + ${b}`;
}

// Fungsi untuk mengambil data dari server dan memperbarui tabel
async function loadData() {
    const response = await fetch("get_data.php");
    const data = await response.json();

    dataTable.innerHTML = "";
    data.forEach(item => {
        const row = `
            <tr>
                <td>${item.namaLengkap}</td>
                <td>${item.tanggalBayar}</td>
                <td>${item.kelas}</td>
                <td>${item.jurusan}</td>
                <td>${item.totalBayar}</td>
                <td>${item.keterangan}</td>
            </tr>
        `;
        dataTable.innerHTML += row;
    });
}

// Event submit form
kwitansiForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const captchaInput = document.getElementById("captcha").value;
    if (parseInt(captchaInput) !== captchaValue) {
        alert("Captcha salah!");
        return;
    }

    const formData = new FormData(kwitansiForm);
    const response = await fetch("submit.php", {
        method: "POST",
        body: formData,
    });

    if (response.ok) {
        alert("Data berhasil disimpan!");
        kwitansiForm.reset();
        generateCaptcha();
        loadData(); // Refresh tabel setelah submit
    } else {
        alert("Terjadi kesalahan saat menyimpan data.");
    }
});

// Event refresh captcha
refreshCaptcha.addEventListener("click", generateCaptcha);

generateCaptcha();
loadData(); // Muat data saat halaman pertama kali dibuka
