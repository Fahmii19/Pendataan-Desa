// Running Teks

$(document).ready(function () {
  // Initialize marquee
  $(".teks-berjalan-pencarian").marquee({
    duration: 17500,
    delayBeforeStart: 0,
    direction: "left",
    pauseOnHover: true,
  });
});

document.addEventListener("DOMContentLoaded", function () {
  // Fungsi untuk mengaktifkan tab
  function activateTab(btnId) {
    // Mendapatkan semua elemen konten
    const allContents = document.querySelectorAll('[id^="content-"]');
    // Sembunyikan semua konten
    allContents.forEach((content) => {
      content.classList.add("hidden");
    });

    // Mendapatkan semua tombol
    const allButtons = document.querySelectorAll('[id^="btn-"]');
    // Reset kelas untuk semua tombol
    allButtons.forEach((btn) => {
      // Reset tombol ke default tidak aktif
      btn.classList.add("border-blue-500", "text-[#007bff]"); // Teks biru untuk tombol tidak aktif
      btn.classList.remove("bg-blue-500", "text-white"); // Hapus kelas untuk tombol aktif
      btn.querySelector("svg").classList.add("text-[#007bff]"); // Teks biru untuk SVG
      btn.querySelector("svg").classList.remove("text-white"); // Hapus kelas teks putih pada SVG
    });

    // Tampilkan konten yang sesuai
    const contentId = "content-" + btnId.split("-")[1];
    document.getElementById(contentId).classList.remove("hidden");

    // Tambahkan kelas pada tombol yang aktif
    const activeBtn = document.getElementById(btnId);
    activeBtn.classList.add("bg-blue-500", "text-white"); // Tombol aktif dengan background biru dan teks putih
    activeBtn.classList.remove("text-[#007bff]", "border-blue-500"); // Hapus kelas teks biru dan border biru
    activeBtn.querySelector("svg").classList.remove("text-[#007bff]"); // Hapus kelas teks biru pada SVG
    activeBtn.querySelector("svg").classList.add("text-white"); // Teks putih untuk SVG
  }

  // Tambahkan event listener ke setiap tombol
  document.querySelectorAll('[id^="btn-"]').forEach((btn) => {
    btn.addEventListener("click", function () {
      activateTab(btn.id);
    });
  });

  // Aktifkan konten pertama secara default
  activateTab("btn-1");
});
