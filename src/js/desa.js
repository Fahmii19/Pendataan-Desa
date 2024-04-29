// Gambar
import rpOnImg from "../images/desa/rp-on.png";
import saldoOnImg from "../images/desa/saldo-on.png";
import penOnImg from "../images/desa/pen-on.png";
import padi1Img from "../images/desa/padi1.jpg";
import padi2Img from "../images/desa/padi2.jpg";
import padi3Img from "../images/desa/padi3.png";
import leftOffImg from "../images/desa/left-off.png";
import leftOnImg from "../images/desa/left-on.png";
import saldoOffImg from "../images/desa/saldo-off.png";
import rpOffImg from "../images/desa/rp-off.png";
import penOffImg from "../images/desa/pen-off.png";
import rightOffImg from "../images/desa/right-off.png";
import rightOnImg from "../images/desa/right-on.png";

// Dokumen
import laporanKeuanganPDF from "../Laporan_Keuangan.pdf";

// Running Teks Berjalan
$(document).ready(function () {
  $(".teks-berjalan-pencarian").marquee({
    duration: 17500,
    delayBeforeStart: 0,
    direction: "left",
    pauseOnHover: true,
  });
});

// Fungsi Untuk Menampilkan Konten Tab
document.addEventListener("DOMContentLoaded", function () {
  function activateTab(btnId) {
    const allContents = document.querySelectorAll('[id^="content-"]');
    allContents.forEach((content) => {
      content.classList.add("hidden");
    });

    const allButtons = document.querySelectorAll('[id^="btn-"]');
    allButtons.forEach((btn) => {
      btn.classList.add("border-blue-500", "text-blue-500");
      btn.classList.remove("bg-blue-500", "text-white");
      if (btn.querySelector("svg")) {
        btn.querySelector("svg").classList.add("text-blue-500");
        btn.querySelector("svg").classList.remove("text-white");
      } else if (btn.id === "btn-4") {
        btn.querySelector("img").src = `${saldoOffImg}`;
      }
      if (btn.id === "btn-6") {
        btn.querySelector("img").src = `${rpOffImg}`;
      } else if (btn.id === "btn-8") {
        btn.querySelector("img").src = `${penOffImg}`;
      }
    });

    const contentId = "content-" + btnId.split("-")[1];
    document.getElementById(contentId).classList.remove("hidden");

    const activeBtn = document.getElementById(btnId);
    activeBtn.classList.add("bg-blue-500", "text-white");
    activeBtn.classList.remove("text-blue-500", "border-blue-500");
    if (activeBtn.querySelector("svg")) {
      activeBtn.querySelector("svg").classList.remove("text-blue-500");
      activeBtn.querySelector("svg").classList.add("text-white");
    }
    // Menangani penggantian gambar ketika tombol aktif
    if (btnId === "btn-6") {
      activeBtn.querySelector("img").src = `${rpOnImg}`;
    } else if (btnId === "btn-4") {
      activeBtn.querySelector("img").src = `${saldoOnImg}`;
    } else if (btnId === "btn-8") {
      activeBtn.querySelector("img").src = `${penOnImg}`;
    }
  }

  document.querySelectorAll('[id^="btn-"]').forEach((btn) => {
    btn.addEventListener("click", function () {
      activateTab(btn.id);
    });
  });

  activateTab("btn-1");
});

// Chart Produksi Pertanian
document.addEventListener("DOMContentLoaded", function () {
  var oilCanvas = document.getElementById("produksiPertanian");

  const oilData = {
    labels: ["Beras", "Cabe", "Bawang"],
    datasets: [
      {
        data: [133.3, 86.2, 52.2], // Angka dalam jutaan
        backgroundColor: ["#FFC700", "#4CCD99", "#007F73"],
      },
    ],
  };

  const pieChart = new Chart(oilCanvas, {
    type: "pie",
    data: oilData,
    options: {
      plugins: {
        legend: {
          labels: {
            usePointStyle: true,
            boxWidth: 8,
            font: {
              size: 10, // Menyesuaikan ukuran font untuk legenda
            },
          },
        },
        tooltip: {
          callbacks: {
            label: function (context) {
              let label = context.label || "";
              if (label) {
                label += ": ";
              }
              const value = context.parsed * 1000; // Memperbaiki akses ke nilai data
              label += new Intl.NumberFormat("id-ID").format(value) + " Ton";

              return label;
            },
          },
        },
      },
      hover: {
        mode: null, // Menonaktifkan efek hover
        animationDuration: 0, // Menghilangkan animasi saat hover
      },
      animation: {
        duration: 0, // Opsi ini menghilangkan animasi saat load
        hover: {
          mode: null,
        },
      },
      events: ["mousemove", "mouseout", "click", "touchstart", "touchmove"], // Menyertakan event untuk tooltip
      interaction: {
        mode: "nearest",
        intersect: true,
        axis: "x",
      },
    },
  });
});

// Chart Distribusi Pembiayaan
document.addEventListener("DOMContentLoaded", function () {
  var oilCanvas = document.getElementById("distribusiPembiayaan");

  const oilData = {
    labels: ["Bank", "Tengkulak", "Modal Sendiri"],
    datasets: [
      {
        data: [133.3, 86.2, 52.2], // Angka dalam jutaan
        backgroundColor: ["#5356FF", "#378CE7", "#67C6E3"],
      },
    ],
  };

  const pieChart = new Chart(oilCanvas, {
    type: "pie",
    data: oilData,
    options: {
      plugins: {
        legend: {
          labels: {
            usePointStyle: true,
            boxWidth: 8,
            font: {
              size: 10, // Menyesuaikan ukuran font untuk legenda
            },
          },
        },
        tooltip: {
          callbacks: {
            label: function (context) {
              let label = context.label || "";
              if (label) {
                label += ": ";
              }
              const value = context.parsed * 1000000; // Memperbaiki akses ke nilai data
              label += " Rp " + new Intl.NumberFormat("id-ID").format(value);

              return label;
            },
          },
        },
      },
      hover: {
        mode: null, // Menonaktifkan efek hover
        animationDuration: 0, // Menghilangkan animasi saat hover
      },
      animation: {
        duration: 0, // Opsi ini menghilangkan animasi saat load
        hover: {
          mode: null,
        },
      },
      events: ["mousemove", "mouseout", "click", "touchstart", "touchmove"], // Menyertakan event untuk tooltip
      interaction: {
        mode: "nearest",
        intersect: true,
        axis: "x",
      },
    },
  });
});

// Chart
const skipped = (ctx, value) =>
  ctx.p0.skip || ctx.p1.skip ? value : undefined;
const down = (ctx, value) =>
  ctx.p0.parsed.y > ctx.p1.parsed.y ? value : undefined;

// Setting generic options
const genericOptions = {
  fill: false,
  interaction: {
    intersect: false,
  },
  radius: 0,
};

// Setting options for the second line chart
new Chart(document.getElementById("myChart2"), {
  type: "line",
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"],
    datasets: [
      {
        label: "Beras",
        data: [67, 45, 60, 34, NaN, 70],
        borderColor: "#DAA520",
        backgroundColor: "#DAA520",
        borderWidth: 1,
        pointRadius: 2,
        tension: 0.3,
        segment: {
          borderColor: (ctx) => skipped(ctx, "#DAA520") || down(ctx, "#DAA520"),
          borderDash: (ctx) => skipped(ctx, [3, 3]),
        },
        spanGaps: true,
      },
      {
        label: "Cabe",
        data: [54, 23, 35, 60, NaN, 95],
        borderColor: "#FF0000",
        backgroundColor: "#FF0000",
        borderWidth: 1,
        pointRadius: 2,
        tension: 0.3,

        segment: {
          borderColor: (ctx) => skipped(ctx, "#FF0000") || down(ctx, "#FF0000"),
          borderDash: (ctx) => skipped(ctx, [3, 3]),
        },
        spanGaps: true,
      },
      {
        label: "Bawang",
        data: [21, 34, 45, 55, NaN, 85],
        borderColor: "#9400D3",
        backgroundColor: "#9400D3",
        borderWidth: 1,
        pointRadius: 2,
        tension: 0.3,

        segment: {
          borderColor: (ctx) => skipped(ctx, "#9400D3") || down(ctx, "#9400D3"),
          borderDash: (ctx) => skipped(ctx, [3, 3]),
        },
        spanGaps: true,
      },
    ],
  },

  options: {
    ...genericOptions,
    scales: {
      y: {
        display: true,
        beginAtZero: true,
        ticks: {
          stepSize: 25,
        },
        title: {
          display: true,
          text: "Volume (ton)",
          font: {
            size: 13,
            weight: "bold",
          },
        },
      },
      x: {
        display: true,
        title: {
          display: true,
          text: "Bulan",
          font: {
            size: 12,
            weight: "bold",
          },
        },
      },
    },
    plugins: {
      legend: {
        labels: {
          usePointStyle: true,
          boxWidth: 8,
          generateLabels: (chart) => {
            return chart.data.datasets.map((dataset, index) => {
              return {
                text: dataset.label,
                fillStyle: dataset.backgroundColor,
                strokeStyle: dataset.borderColor,
                pointStyle: "rect",
                hidden: false,
              };
            });
          },
        },
      },
    },
  },
});

// Setting options for the second line chart
new Chart(document.getElementById("myChart3"), {
  type: "line",
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"],
    datasets: [
      {
        label: "Beras Cianjur Kepala",
        data: [67, 45, 60, 34, NaN, 70],
        borderColor: "#DAA520",
        backgroundColor: "#DAA520",
        borderWidth: 1,
        pointRadius: 2,
        tension: 0.3,
        segment: {
          borderColor: (ctx) => skipped(ctx, "#DAA520") || down(ctx, "#DAA520"),
          borderDash: (ctx) => skipped(ctx, [3, 3]),
        },
        spanGaps: true,
      },
      {
        label: "Beras Setra",
        data: [54, 23, 35, 60, NaN, 95],
        borderColor: "#FF0000",
        backgroundColor: "#FF0000",
        borderWidth: 1,
        pointRadius: 2,
        tension: 0.3,
        segment: {
          borderColor: (ctx) => skipped(ctx, "#FF0000") || down(ctx, "#FF0000"),
          borderDash: (ctx) => skipped(ctx, [3, 3]),
        },
        spanGaps: true,
      },
      {
        label: "Cabe Merah Keriting",
        data: [10, 34, 42, 55, NaN, 85],
        borderColor: "#9400D3",
        backgroundColor: "#9400D3",
        borderWidth: 1,
        pointRadius: 2,
        tension: 0.3,
        segment: {
          borderColor: (ctx) => skipped(ctx, "#9400D3") || down(ctx, "#9400D3"),
          borderDash: (ctx) => skipped(ctx, [3, 3]),
        },
        spanGaps: true,
      },

      // Cabe Rawit Merah

      {
        label: "Cabe Rawit Merah",
        data: [10, 15, 21, 19, NaN, 85],
        borderColor: "#FF4500",
        backgroundColor: "#FF4500",
        borderWidth: 1,
        pointRadius: 2,
        tension: 0.3,
        segment: {
          borderColor: (ctx) => skipped(ctx, "#FF4500") || down(ctx, "#FF4500"),
          borderDash: (ctx) => skipped(ctx, [3, 3]),
        },
        spanGaps: true,
      },

      // Bawang Merah

      {
        label: "Bawang Merah",
        data: [21, 34, 45, 55, NaN, 85],
        borderColor: "#FFD700",
        backgroundColor: "#FFD700",
        borderWidth: 1,
        pointRadius: 2,
        tension: 0.3,
        segment: {
          borderColor: (ctx) => skipped(ctx, "#FFD700") || down(ctx, "#FFD700"),
          borderDash: (ctx) => skipped(ctx, [3, 3]),
        },
        spanGaps: true,
      },
    ],
  },
  options: {
    ...genericOptions,
    scales: {
      y: {
        display: true,
        beginAtZero: true,
        ticks: {
          stepSize: 25,
        },
        title: {
          display: true,
          text: "Volume (ton)",
          font: {
            size: 13,
            weight: "bold",
          },
        },
      },
      x: {
        display: true,
        title: {
          display: true,
          text: "Bulan",
          font: {
            size: 12,
            weight: "bold",
          },
        },
      },
    },
    plugins: {
      legend: {
        labels: {
          usePointStyle: true,
          boxWidth: 8,
          font: {
            size: 9, // Menyesuaikan ukuran font untuk legenda
          },

          generateLabels: (chart) => {
            return chart.data.datasets.map((dataset, index) => {
              return {
                text: dataset.label,
                fillStyle: dataset.backgroundColor,
                strokeStyle: dataset.borderColor,
                pointStyle: "rect",
                hidden: false,
              };
            });
          },
        },
      },
    },
  },
});

//
new Chart(document.getElementById("myChart4"), {
  type: "line",
  data: {
    labels: ["13/3", "14/3", "15/3", "16/3", "17/3", "18/3", "19/3"],
    datasets: [
      {
        label: "Beras Cianjur Kepala",
        data: [19.5, 19.3, 19.4, 19.6, 19.7, 19.5, 19.2],
        borderColor: "#DAA520",
        backgroundColor: "#DAA520",
        borderWidth: 1,
        pointRadius: 2,
        spanGaps: true,
        tension: 0.3, // Mengatur kehalusan kurva
      },
      {
        label: "Beras Cianjur Slyp",
        data: [18.1, 18.2, 18.3, 18.1, 18.2, 18.2, 18.1],
        borderColor: "#FF0000",
        backgroundColor: "#FF0000",
        borderWidth: 1,
        pointRadius: 2,
        spanGaps: true,
        tension: 0.3, // Mengatur kehalusan kurva
      },
      {
        label: "Beras Setra",
        data: [16.1, 16.5, 16.3, 16.6, 16.4, 16.5, 16.4],
        borderColor: "#9400D3",
        backgroundColor: "#9400D3",
        borderWidth: 1,
        pointRadius: 2,
        spanGaps: true,
        tension: 0.3, // Mengatur kehalusan kurva
      },
      {
        label: "Beras Saigon",
        data: [16, 15.9, 16, 15.8, 16, 15.9, 16],
        borderColor: "#FFA07A",
        backgroundColor: "#FFA07A",
        borderWidth: 1,
        pointRadius: 2,
        spanGaps: true,
        tension: 0.3, // Mengatur kehalusan kurva
      },
      {
        label: "Beras Muncul 1",
        data: [15.2, 15.4, 15.5, 15.6, 15.4, 15.7, 15.8],
        borderColor: "#20B2AA",
        backgroundColor: "#20B2AA",
        borderWidth: 1,
        pointRadius: 2,
        spanGaps: true,
        tension: 0.3, // Mengatur kehalusan kurva
      },
      {
        label: "Beras Muncul 2",
        data: [15, 15.2, 15.1, 15, 15.2, 15.3, 15.2],
        borderColor: "#778899",
        backgroundColor: "#778899",
        borderWidth: 1,
        pointRadius: 2,
        spanGaps: true,
        tension: 0.3, // Mengatur kehalusan kurva
      },
      {
        label: "Beras Muncul 3",
        data: [14.1, 14.2, 14.4, 14.3, 14.5, 14.3, 14.2],
        borderColor: "#B0C4DE",
        backgroundColor: "#B0C4DE",
        borderWidth: 1,
        pointRadius: 2,
        spanGaps: true,
        tension: 0.3, // Mengatur kehalusan kurva
      },
    ],
  },
  options: {
    scales: {
      y: {
        display: true,
        ticks: {
          callback: function (value, index, values) {
            if (
              value === 0 ||
              value === 14 ||
              value === 16 ||
              value === 18 ||
              value === 20
            ) {
              return value;
            } else {
              return "";
            }
          },
        },
        title: {
          display: true,
          text: "Harga (x Rp 1.000)",
          font: {
            size: 13,
            weight: "bold",
          },
        },
      },
      x: {
        display: true,
        title: {
          display: true,
          text: "Tanggal",
          font: {
            size: 12,
            weight: "bold",
          },
        },
      },
    },
    plugins: {
      legend: {
        labels: {
          usePointStyle: true,
          boxWidth: 8,
          generateLabels: (chart) => {
            return chart.data.datasets.map((dataset, index) => {
              return {
                text: dataset.label,
                fillStyle: dataset.backgroundColor,
                strokeStyle: dataset.borderColor,
                pointStyle: "rect",
                hidden: false,
              };
            });
          },
        },
      },
    },
  },
});

//

const barChartData = {
  labels: ["15-20", "21-25", "26-30", "31-35", "36-40"],
  datasets: [
    {
      label: "Pemilik",
      backgroundColor: "#ffba44",
      data: [31, 32, 37, 21, 45],
      barThickness: 7, // Atur lebar bar menjadi 7 pixel
    },
    {
      label: "Penyewa",
      backgroundColor: "#879fd1",
      data: [17, 20, 25, 20, 23],
      barThickness: 7, // Atur lebar bar menjadi 7 pixel
    },

    {
      label: "Penggarap",
      backgroundColor: "#5dc8f0",
      data: [30, 41, 45, 46, 49],
      barThickness: 7, // Atur lebar bar menjadi 7 pixel
    },
  ],
};

const chartOptions = {
  indexAxis: "x", // Mengatur sumbu x sebagai sumbu kategori
  scales: {
    x: {
      display: true,
      beginAtZero: true,
      ticks: {
        stepSize: 2, // Mengatur jarak antara label pada sumbu x
      },
      title: {
        display: true,
        text: "Usia",
        font: {
          size: 12,
          weight: "bold",
        },
      },
    },
    y: {
      display: true,
      title: {
        display: true,
        text: "Jumlah",
        font: {
          size: 13,
          weight: "bold",
        },
      },
      max: 50, // Mengatur nilai maksimum pada sumbu y
    },
  },
  plugins: {
    legend: {
      labels: {
        usePointStyle: true,
        boxWidth: 8,
        generateLabels: (chart) => {
          return chart.data.datasets.map((dataset, index) => {
            return {
              text: dataset.label,
              fillStyle: dataset.backgroundColor,
              strokeStyle: dataset.borderColor,
              pointStyle: "rect",
              hidden: false,
            };
          });
        },
      },
    },
  },
};

document.addEventListener("DOMContentLoaded", function () {
  const ctx = document.getElementById("canvas1").getContext("2d");
  window.myBar = new Chart(ctx, {
    type: "bar",
    data: barChartData,
    options: chartOptions,
  });
});

// Fungsi Menampilkan Radius Pasar Induk
document
  .getElementById("slider-pindes")
  .addEventListener("input", updateSlider);

function updateSlider() {
  const slider = document.getElementById("slider-pindes");
  const value = parseInt(slider.value, 10); // Mengonversi nilai slider ke integer

  // Mengambil referensi ke setiap elemen radius
  const radius1 = document.querySelector(".radius1");
  const radius2 = document.querySelector(".radius2");
  const radius3 = document.querySelector(".radius3");

  // Menyembunyikan semua elemen radius terlebih dahulu
  radius1.style.display = "none";
  radius2.style.display = "none";
  radius3.style.display = "none";

  // Menampilkan elemen berdasarkan nilai slider
  if (value >= 0) {
    radius1.style.display = "block"; // Selalu tampilkan radius1
  }
  if (value >= 2) {
    radius2.style.display = "block"; // Tampilkan radius2 ketika slider ≥ 50km
  }
  if (value == 4) {
    radius3.style.display = "block"; // Tampilkan radius3 hanya ketika slider = 100km
  }

  // Memperbarui lebar progress dan posisi thumb
  const progressPercentages = [0, 25, 50, 75, 100];
  const percentage = progressPercentages[value];
  const progress = document.getElementById("progress");
  const thumb = document.getElementById("thumb");
  progress.style.width = percentage + "%";
  thumb.style.left = `calc(${percentage}% - ${thumb.offsetWidth / 2}px)`;
}

// Menambahkan event listener pada setiap elemen span untuk mengatur nilai slider
document.querySelectorAll(".clickable").forEach((span) => {
  span.addEventListener("click", function () {
    const slider = document.getElementById("slider-pindes");
    slider.value = this.getAttribute("data-value");
    updateSlider();
  });
});

document.addEventListener("DOMContentLoaded", (event) => {
  document.getElementById("slider-pindes").value = 0;
  updateSlider();
});

// Function Togle Checkbox

window.toggleUsiaTanam = function () {
  const mapContainer = document.querySelector(".box_usia_panen");

  const checkbox = document.getElementById("fertility_map_checkbox");
  if (checkbox.checked) {
    mapContainer.classList.remove("hidden");
  } else {
    mapContainer.classList.add("hidden");
  }
};

window.toggleKesuburan = function () {
  const mapContainer = document.querySelector(".box_kesuburan");
  const checkbox = document.getElementById("fertility_kesuburan_map");

  if (checkbox.checked) {
    mapContainer.classList.remove("hidden");
  } else {
    mapContainer.classList.add("hidden");
  }
};

window.toggleKomoditi = function () {
  const mapContainer = document.querySelector(".ukuran_legend_profit");
  const checkbox = document.getElementById("fertility_komoditi_map");
  if (checkbox.checked) {
    mapContainer.classList.remove("hidden");
  } else {
    mapContainer.classList.add("hidden");
  }
};

window.togglePrediksiCurahHujan = function () {
  const prediksiCurahHujanContainer = document.querySelector(
    ".box_prediksi_hujan"
  );
  const checkbox = document.getElementById("prediksi_curah_hujan_checkbox");
  if (checkbox.checked) {
    prediksiCurahHujanContainer.classList.remove("hidden");
  } else {
    prediksiCurahHujanContainer.classList.add("hidden");
  }
};

//
//
//
//

// Data untuk informasi persil
const dataPersil = [
  {
    tanggal: "19 Maret 2024",
    gambar: `${padi1Img}`,
    catatan: "Hama tikus menyerang persil 1. Sebaiknya segera diatasi.",
  },
  {
    tanggal: "23 Maret 2024",
    gambar: `${padi2Img}`,
    catatan: "Kurang air untuk seminggu ini karena sungai sedang kering.",
  },
  {
    tanggal: "27 Maret 2024",
    gambar: `${padi3Img}`,
    catatan: "Sementara beli air dari tetangga untuk mengairi sawah.",
  },
];

let currentIndex = 0;

$(document).ready(function () {
  // Fungsi untuk memperbarui informasi persil
  function updateInformasiPersil() {
    $("#tgl-update-persil").text(dataPersil[currentIndex].tanggal);
    $("#gambar_persil img").attr("src", dataPersil[currentIndex].gambar);
    $("#catatan_isi").text(dataPersil[currentIndex].catatan);

    // Update status dan gambar tombol prev
    if (currentIndex === 0) {
      $("#prev-informasi-persil").attr("src", leftOffImg);
      $("#prev-wrapper").addClass("border border-gray-300");
    } else {
      $("#prev-informasi-persil").attr("src", leftOnImg);
      $("#prev-wrapper").removeClass("border border-gray-300");
    }

    // Update status dan gambar tombol next
    if (currentIndex === dataPersil.length - 1) {
      $("#next-informasi-persil").attr("src", rightOffImg);
      $("#next-wrapper").addClass("border border-gray-300");
    } else {
      $("#next-informasi-persil").attr("src", rightOnImg);
      $("#next-wrapper").removeClass("border border-gray-500");
    }
  }

  // Memperbarui informasi persil saat dokumen siap
  updateInformasiPersil();

  // Menangani klik pada tombol "next"
  $("#next-informasi-persil").click(function () {
    if (currentIndex < dataPersil.length - 1) {
      currentIndex++;
      updateInformasiPersil();
    }
  });

  // Menangani klik pada tombol "prev"
  $("#prev-informasi-persil").click(function () {
    if (currentIndex > 0) {
      currentIndex--;
      updateInformasiPersil();
    }
  });
});

//
//
//
//

// Fungsi tab untuk informasi persil
document.addEventListener("DOMContentLoaded", function () {
  const tabs = document.querySelectorAll(".tab-item");
  const tabContents = document.querySelectorAll(".tab-content");

  function changeTab(selectedTab) {
    tabs.forEach((tab) => {
      const tabLink = tab.querySelector(".tab-link");
      if (tab.dataset.tab === selectedTab) {
        // tab.classList.add('-mb-px', 'border-l', 'border-t', 'border-r', 'rounded-t-lg');
        tabLink.classList.add("text-blue-700");
        tabLink.classList.remove("text-black");
        tabLink.classList.remove("hover:text-blue-700");
      } else {
        // tab.classList.remove('-mb-px', 'border-l', 'border-t', 'border-r', 'rounded-t-lg');
        tabLink.classList.add("text-black");
        tabLink.classList.remove("text-blue-700");
        tabLink.classList.add("hover:text-blue-700");
      }
    });

    tabContents.forEach((content) => {
      if (content.dataset.content === selectedTab) {
        content.classList.remove("hidden");
      } else {
        content.classList.add("hidden");
      }
    });
  }

  tabs.forEach((tab) => {
    tab.addEventListener("click", function (e) {
      e.preventDefault(); // Prevent the link from redirecting
      const selectedTab = this.dataset.tab;
      changeTab(selectedTab);
    });
  });

  // Initialize the first tab as active
  changeTab("1");
});

function toggleRadioBackground() {
  // Memilih semua radio buttons dengan class 'radio_white'
  const radios = document.querySelectorAll(".radio_white");

  // Iterasi melalui setiap radio button
  radios.forEach((radio) => {
    // Menambahkan event listener untuk event 'change'
    radio.addEventListener("change", function () {
      // Jika radio button ini terpilih, hapus class 'bg-white'
      if (this.checked) {
        this.classList.remove("bg-white");
      }

      // Menambahkan class 'bg-white' kembali ke radio buttons lain yang tidak terpilih
      radios.forEach((otherRadio) => {
        if (otherRadio !== this && !otherRadio.checked) {
          otherRadio.classList.add("bg-white");
        }
      });
    });
  });
}

// Menjalankan fungsi setelah halaman dimuat
document.addEventListener("DOMContentLoaded", toggleRadioBackground);

//
//
//
//

// Fungsi untuk menampilkan konten berdasarkan radio button yang dipilih
document.addEventListener("DOMContentLoaded", function () {
  const radios = document.querySelectorAll(
    'input[type="radio"][name="radio_group"]'
  );

  radios.forEach(function (radio) {
    radio.addEventListener("change", onRadioChange);
  });

  onRadioChange();

  let radio1 = document.getElementById("radio_1");
  if (radio1 && !radio1.checked) {
    radio1.checked = true;
    radio1.dispatchEvent(new Event("change"));
  }

  function onRadioChange() {
    // Menyembunyikan semua konten terlebih dahulu
    document.getElementById("konten_radio_1").classList.add("hidden");
    document.getElementById("konten_radio_2").classList.add("hidden");

    // Menampilkan konten berdasarkan radio button yang dipilih
    if (document.getElementById("radio_1").checked) {
      document.getElementById("konten_radio_1").classList.remove("hidden");
    } else if (document.getElementById("radio_2").checked) {
      document.getElementById("konten_radio_2").classList.remove("hidden");
    }
  }
});

//
//
//
//

// Menutup dropdown jika klik diluar dropdown
$(document).on("click", function (e) {
  var target = $(e.target);
  if (
    !target.closest("#dropdown-button-pencarian").length &&
    !target.closest("#dropdown-menu-pencarian").length
  ) {
    $("#dropdown-menu-pencarian").hide();
    $("#arrow-icon-pencarian").removeClass("rotate-180");
  }
});

$("#dropdown-button-pencarian").click(function (e) {
  $("#dropdown-menu-pencarian").toggle();
  $("#arrow-icon-pencarian").toggleClass("rotate-180");
  e.stopPropagation(); // Mencegah event click menyebar ke dokumen
});

$("#dropdown-menu-pencarian a").click(function () {
  var selectedItemText = $(this).text().trim();
  tampilkanInformasi(selectedItemText);
  $("#dropdown-menu-pencarian").hide();
});

//
//
//
//

// Cetak PDF Finansial
document.addEventListener("DOMContentLoaded", function () {
  const link = document.getElementById("cetakPDF");
  link.href = laporanKeuanganPDF;
});

document.addEventListener("DOMContentLoaded", function () {
  const dataInformasi = {
    "Padi Sawah": {
      g: "4%",
      wacc: "10,00%",
      op: "56,04%",
      cr: "18,44%",
      capital: "500.000.000",
      nowc: "100.000.000",
      netOpCap: "200.000.000",
      sales: "1.000.000.000",
      noi: "150.000.000",
      valueOp: "250.000.000",
      roic: "5%",
      eva: "-50.000.000",
      //
      produksi: {
        utama: {
          nilaiRupiah: 1843765,
          persentase: 9920,
        },
        ikutan: {
          nilaiRupiah: 7719,
          // persentase: 042,
        },
        total: {
          nilaiRupiah: 1851484,
          persentase: 100,
        },
        //
        ongkos_produksi_a: {
          nilaiRupiah: 1355930,
          persentase: 9900,
        },
        benih_a: {
          nilaiRupiah: 51436,
          persentase: 379,
        },

        pupuk_a: {
          nilaiRupiah: 127800,
          persentase: 943,
        },

        pestisida_a: {
          nilaiRupiah: 569550,
          persentase: 420,
        },

        tenagakerja_a: {
          nilaiRupiah: 661519,
          persentase: 4879,
        },

        tenagabayar_a: {
          nilaiRupiah: 228209,
          persentase: 1683,
        },

        tenagatidakdibayar_a: {
          nilaiRupiah: 194697,
          persentase: 1436,
        },

        //
        //

        jasapertanian_a: {
          nilaiRupiah: 238613,
          persentase: 1760,
        },

        sewalahan_a: {
          nilaiRupiah: 347236,
          persentase: 2561,
        },

        pbb_a: {
          nilaiRupiah: 80100,
          // persentase: 059,
        },

        bunga_a: {
          nilaiRupiah: 35480,
          // persentase: 026,
        },

        retribusi_a: {
          nilaiRupiah: 78300,
          // persentase: 058,
        },

        premi_a: {
          nilaiRupiah: 1770,
          // persentase: 001,
        },

        sewaalat_a: {
          nilaiRupiah: 39881,
          persentase: 294,
        },

        penyusutan_a: {
          nilaiRupiah: 21139,
          persentase: 156,
        },

        lainnya_a: {
          nilaiRupiah: 17609,

          persentase: 130,
        },

        pendapatan_a: {
          nilaiRupiah: 495554,
          persentase: 130,
        },
        rasio_a: {
          nilaiRupiah: 1851484,
          // persentase: 037,
        },
      },
    },
    "Padi Ladang": {
      g: "5%",
      wacc: "11,00%",
      op: "57,04%",
      cr: "19,44",
      capital: "600.000.000",
      nowc: "110.000.000",
      netOpCap: "210.000.000",
      sales: "1.100.000.000",
      noi: "160.000.000",
      valueOp: "260.000.000",
      roic: "6%",
      eva: "-60.000.000",
      produksi: {
        utama: {
          nilaiRupiah: 1843765,
          persentase: 99.99,
        },
        ikutan: {
          nilaiRupiah: 7719,
          persentase: 0.42,
        },
        total: {
          nilaiRupiah: 2051484,
          persentase: 100,
        },
        //
        ongkos_produksi_a: {
          nilaiRupiah: 1355930,
          persentase: 99,
        },
        benih_a: {
          nilaiRupiah: 51436,
          persentase: 3.79,
        },

        pupuk_a: {
          nilaiRupiah: 127800,
          persentase: 9.43,
        },

        pestisida_a: {
          nilaiRupiah: 569.55,
          persentase: 4.2,
        },

        tenagakerja_a: {
          nilaiRupiah: 661519,
          persentase: 48.79,
        },

        tenagabayar_a: {
          nilaiRupiah: 228209,
          persentase: 16.83,
        },

        tenagatidakdibayar_a: {
          nilaiRupiah: 194697,
          persentase: 14.36,
        },

        //
        //

        jasapertanian_a: {
          nilaiRupiah: 238613,
          persentase: 17.6,
        },

        sewalahan_a: {
          nilaiRupiah: 347236,
          persentase: 25.61,
        },

        pbb_a: {
          nilaiRupiah: 80.1,
          persentase: 0.59,
        },

        bunga_a: {
          nilaiRupiah: 35.48,
          persentase: 0.26,
        },

        retribusi_a: {
          nilaiRupiah: 78.3,
          persentase: 0.58,
        },

        premi_a: {
          nilaiRupiah: 1.77,
          persentase: 0.01,
        },

        sewaalat_a: {
          nilaiRupiah: 39881,
          persentase: 2.94,
        },

        penyusutan_a: {
          nilaiRupiah: 21139,
          persentase: 1.56,
        },

        lainnya_a: {
          nilaiRupiah: 17609,

          persentase: 1.3,
        },

        pendapatan_a: {
          nilaiRupiah: 495554,
          persentase: 1.3,
        },
        rasio_a: {
          nilaiRupiah: 1851484,
          persentase: 0.37,
        },
      },
    },
  };

  // Kedua
  function tampilkanInformasi(selectedItemText) {
    console.log(selectedItemText);

    $("#selected-item").text(selectedItemText);
    const data = dataInformasi[selectedItemText];
    if (data) {
      $("#distribusi_g").text(data.g);
      $("#distribusi_wacc").text(data.wacc);
      $("#distribusi_op").text(data.op);
      $("#distribusi_cr").text(data.cr);
      $("#distribusi_capital").text(data.capital);
      $("#distribusi_nowc").text(data.nowc);
      $("#distribusi_netOpCap").text(data.netOpCap);
      $("#distribusi_sales").text(data.sales);
      $("#distribusi_noi").text(data.noi);
      $("#distribusi_valueOp").text(data.valueOp);
      $("#distribusi_roic").text(data.roic);
      $("#distribusi_eva").text(data.eva);
      $("#utama_a").text(
        data.produksi.utama.nilaiRupiah.toLocaleString("id-ID")
      );
      let persentaseUtama = (data.produksi.utama.persentase / 100)
        .toFixed(2)
        .replace(".", ",");
      $("#utama_b").text(persentaseUtama);

      $("#ikutan_a").text(
        data.produksi.ikutan.nilaiRupiah.toLocaleString("id-ID")
      );
      let persentaseIkutan = (data.produksi.ikutan.persentase / 100)
        .toFixed(2)
        .replace(".", ",");
      $("#ikutan_b").text(persentaseIkutan);

      $("#total_a").text(
        data.produksi.total.nilaiRupiah.toLocaleString("id-ID")
      );
      $("#total_b").text(
        data.produksi.total.persentase.toFixed(0).replace(",", ",")
      );

      $("#ongkos_produksi_a").text(
        data.produksi.ongkos_produksi_a.nilaiRupiah.toLocaleString("id-ID")
      );
      let persentaseOngkosProduksi = (
        data.produksi.ongkos_produksi_a.persentase / 100
      )
        .toFixed(2)
        .replace(".", ",");
      $("#ongkos_produksi_b").text(persentaseOngkosProduksi);

      $("#benih_a").text(
        data.produksi.benih_a.nilaiRupiah.toLocaleString("id-ID")
      );
      let persentaseBenih = data.produksi.benih_a.persentase / 100;
      $("#benih_b").text(persentaseBenih.toFixed(2).replace(".", ","));

      $("#pupuk_a").text(
        data.produksi.pupuk_a.nilaiRupiah.toLocaleString("id-ID")
      );
      let persentase = data.produksi.pupuk_a.persentase / 100;
      $("#pupuk_b").text(persentase.toFixed(2).replace(".", ","));

      $("#pestisida_a").text(
        data.produksi.pestisida_a.nilaiRupiah.toLocaleString("id-ID")
      );
      $("#pestisida_b").text(
        (data.produksi.pestisida_a.persentase / 100)
          .toFixed(2)
          .replace(".", ",")
      );

      $("#tenagakerja_a").text(
        data.produksi.tenagakerja_a.nilaiRupiah.toLocaleString("id-ID")
      );
      $("#tenagakerja_b").text(
        (data.produksi.tenagakerja_a.persentase / 100)
          .toFixed(2)
          .replace(".", ",")
      );

      $("#tenagabayar_a").text(
        data.produksi.tenagabayar_a.nilaiRupiah.toLocaleString("id-ID")
      );
      $("#tenagabayar_b").text(
        (data.produksi.tenagabayar_a.persentase / 100)
          .toFixed(2)
          .replace(".", ",")
      );

      $("#tenagatidakdibayar_a").text(
        data.produksi.tenagatidakdibayar_a.nilaiRupiah.toLocaleString("id-ID")
      );
      $("#tenagatidakdibayar_b").text(
        (data.produksi.tenagatidakdibayar_a.persentase / 100)
          .toFixed(2)
          .replace(".", ",")
      );

      $("#jasapertanian_a").text(
        data.produksi.jasapertanian_a.nilaiRupiah.toLocaleString("id-ID")
      );
      $("#jasapertanian_b").text(
        (data.produksi.jasapertanian_a.persentase / 100)
          .toFixed(2)
          .replace(".", ",")
      );

      $("#sewalahan_a").text(
        data.produksi.sewalahan_a.nilaiRupiah.toLocaleString("id-ID")
      );
      $("#sewalahan_b").text(
        data.produksi.sewalahan_a.persentase.toFixed(2).replace(",", ",")
      );

      $("#sewalahan_a").text(
        data.produksi.sewalahan_a.nilaiRupiah.toLocaleString("id-ID")
      );
      $("#sewalahan_b").text(
        (data.produksi.sewalahan_a.persentase / 100)
          .toFixed(2)
          .replace(".", ",")
      );

      $("#pbb_a").text(data.produksi.pbb_a.nilaiRupiah.toLocaleString("id-ID"));
      $("#pbb_b").text(
        (data.produksi.pbb_a.persentase / 100).toFixed(2).replace(".", ",")
      );

      $("#bunga_a").text(
        data.produksi.bunga_a.nilaiRupiah.toLocaleString("id-ID")
      );
      $("#bunga_b").text(
        (data.produksi.bunga_a.persentase / 100).toFixed(2).replace(".", ",")
      );

      $("#retribusi_a").text(
        data.produksi.retribusi_a.nilaiRupiah.toLocaleString("id-ID")
      );
      $("#retribusi_b").text(
        (data.produksi.retribusi_a.persentase / 100)
          .toFixed(2)
          .replace(".", ",")
      );

      $("#premi_a").text(
        data.produksi.premi_a.nilaiRupiah.toLocaleString("id-ID")
      );
      $("#premi_b").text(
        (data.produksi.premi_a.persentase / 100).toFixed(2).replace(".", ",")
      );

      $("#sewa_a").text(
        data.produksi.sewaalat_a.nilaiRupiah.toLocaleString("id-ID")
      );
      $("#sewa_b").text(
        (data.produksi.sewaalat_a.persentase / 100).toFixed(2).replace(".", ",")
      );

      $("#penyusutan_a").text(
        data.produksi.penyusutan_a.nilaiRupiah.toLocaleString("id-ID")
      );
      $("#penyusutan_b").text(
        (data.produksi.penyusutan_a.persentase / 100)
          .toFixed(2)
          .replace(".", ",")
      );

      $("#lainnya_a").text(
        data.produksi.lainnya_a.nilaiRupiah.toLocaleString("id-ID")
      );
      $("#lainnya_b").text(
        (data.produksi.lainnya_a.persentase / 100).toFixed(2).replace(".", ",")
      );

      $("#pendapatan_a").text(
        data.produksi.pendapatan_a.nilaiRupiah.toLocaleString("id-ID")
      );
      $("#pendapatan_b").text(
        (data.produksi.pendapatan_a.persentase / 100)
          .toFixed(2)
          .replace(".", ",")
      );

      $("#rasio_a").text(
        (data.produksi.rasio_a.persentase / 100).toFixed(2).replace(".", ",")
      );
    } else {
      console.error("Data untuk", selectedItemText, "tidak ditemukan.");
    }
  }

  // Memuat informasi "Padi Sawah" saat halaman dimuat
  tampilkanInformasi("Padi Sawah");
});

window.ButtonAgregat = function () {
  // Simpan kondisi di localStorage
  localStorage.setItem("komponenDuaUpdated", "true");
  localStorage.setItem("hiddenAgregatsUpdated", "true");
  localStorage.setItem("kontenAgregatsUpdated", "true");

  // Buka tab baru dengan parameter khusus
  window.open(window.location.href + "?updateDOM=true", "_blank");
};

document.addEventListener("DOMContentLoaded", function () {
  var params = new URLSearchParams(window.location.search);
  if (params.get("updateDOM") === "true") {
    // Hanya terapkan perubahan jika URL mengandung parameter yang tepat
    if (localStorage.getItem("komponenDuaUpdated") === "true") {
      var komponenDua = document.querySelector(".komponen_dua_grid_form_layer");
      if (komponenDua) {
        komponenDua.classList.remove("komponen_dua_grid_form_layer");
        komponenDua.classList.add("komponen_satu_grid_form_layer");
      }
    }

    if (localStorage.getItem("hiddenAgregatsUpdated") === "true") {
      var hiddenAgregats = document.querySelectorAll(".hidden_agregat");
      hiddenAgregats.forEach(function (hiddenAgregat) {
        hiddenAgregat.classList.add("hidden");
      });
    }

    if (localStorage.getItem("kontenAgregatsUpdated") === "true") {
      var kontenAgregats = document.querySelectorAll(".konten_agregat");
      kontenAgregats.forEach(function (kontenAgregat) {
        kontenAgregat.classList.remove("hidden");
      });
    }

    // Bersihkan localStorage setelah perubahan diterapkan
    localStorage.removeItem("komponenDuaUpdated");
    localStorage.removeItem("hiddenAgregatsUpdated");
    localStorage.removeItem("kontenAgregatsUpdated");
  }
});

//
//
//
//
//

document
  .querySelector(".btn_dropdown_open_kabupaten_1")
  .addEventListener("click", function () {
    toggleDropdownAndSlide(
      ".btn_dropdown_open_kabupaten_1",
      "data_konten_kelurahan_hidden_1",
      "data_konten_kelurahan_hidden_2",
      "data_konten_kelurahan_hidden_3",
      "data_konten_kelurahan_hidden_4"
    );
  });

document
  .querySelector(".btn_dropdown_open_kabupaten_2")
  .addEventListener("click", function () {
    toggleDropdownAndSlide(
      ".btn_dropdown_open_kabupaten_2",
      "data_konten_kelurahan_hidden_2",
      "data_konten_kelurahan_hidden_1",
      "data_konten_kelurahan_hidden_3",
      "data_konten_kelurahan_hidden_4"
    );
  });

function toggleDropdownAndSlide(
  btnClass,
  contentClass,
  ...otherContentClasses
) {
  let button = document.querySelector(btnClass);
  let svgPlus = button.querySelector(".icon_plus_1, .icon_plus_2");
  let svgMinus = button.querySelector(".icon_minus_1, .icon_minus_2");

  var content = document.querySelector(`.${contentClass}`);
  var otherContents = otherContentClasses.map((className) =>
    document.querySelector(`.${className}`)
  );

  var isHidden = content.classList.contains("hidden");

  if (isHidden) {
    content.classList.remove("hidden");
    slideDown(content);

    // Tampilkan ikon minus dan sembunyikan ikon plus
    svgMinus.classList.remove("hidden");
    svgPlus.classList.add("hidden");

    manageFontBoldClasses(contentClass);

    // Tutup konten lain dan atur ikon mereka
    otherContents.forEach((element) => {
      if (!element.classList.contains("hidden")) {
        element.classList.add("hidden");
        slideUp(element);
        let otherButton = document.querySelector(
          `[data-targets*="${element.className.split(" ")[0]}"]`
        );
        console.log(otherButton);
        if (otherButton) {
          let otherSvgPlus = otherButton.querySelector(
            ".icon_plus_1, .icon_plus_2"
          );
          let otherSvgMinus = otherButton.querySelector(
            ".icon_minus_1, .icon_minus_2"
          );
          if (otherSvgPlus && otherSvgMinus) {
            otherSvgPlus.classList.remove("hidden");
            otherSvgMinus.classList.add("hidden");
          }
        }
      }
    });
  } else {
    slideUp(content);
    setTimeout(() => {
      content.classList.add("hidden");
      content.style.removeProperty("height");
      // Tampilkan ikon plus dan sembunyikan ikon minus
      svgPlus.classList.remove("hidden");
      svgMinus.classList.add("hidden");
      resetFontBoldClasses();
    }, 300);
  }
}

function manageFontBoldClasses(visibleContentClass) {
  const boldClassMap = {
    data_konten_kelurahan_hidden_1: ".judul_tjsiang",
    data_konten_kelurahan_hidden_2: ".judul_binong",
  };

  resetFontBoldClasses();
  if (boldClassMap[visibleContentClass]) {
    document
      .querySelector(boldClassMap[visibleContentClass])
      .classList.add("font-bold");
  }
}

function resetFontBoldClasses() {
  document
    .querySelectorAll(".judul_binong, .judul_tjsiang")
    .forEach((element) => element.classList.remove("font-bold"));
}

function slideUp(element) {
  element.style.transition = "height 0.3s ease";
  element.style.overflow = "hidden";
  element.style.height = "0";
}

function slideDown(element) {
  element.classList.remove("hidden");
  let height = element.scrollHeight + "px";
  element.style.height = height;
}
