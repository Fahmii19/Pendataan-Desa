//Global Variable
let url_api = `https://jakarta.pintoinvest.com:3444`;
let iddle_zoning = false;
let iddle_wilayah = false;
//Global Variable for Chart
let pie,
    pie_investasi,
    pie_sektor,
    pie_tk,
    bar,
    radar,
    radar_liveability,
    bar_io_pengadaan_kerja,
    bar_io_tertutup,
    bar_io_leontiff_terbuka,
    bar_io_dampak_pendapatan,
    bar_io_dampak_pendapatan_bruto,
    bar_io_keterkaitan_hulu_hilir;

let kelurahan_tmp_global;

//Temp Data Potensi
let luas_lahan, luas_bangunan;

// All Data NIB
let nib_data;

let KLB, KDH;

let kilometer = $("#ControlRange").val() / 1000;
let setAttrClick;
let luasSimulasi,
    luasPotensi,
    luasPotensiBangunan,
    totalPenerimaanPenjualan,
    totalPenerimaan,
    totalBiayaPerolahanTanah,
    biayaKonstruksi,
    totalBiayaKonstruksi,
    totalPengeluaran,
    avgNJOP;
let sub_zona_any;
let files = [];
let Newfiles = [];
let filesBulk = [];
let filesUsaha = [];
let database_tpz = {
    a: {
        nama: `TPZ Bonus`,
        pengertian: `<p>Teknik pengaturan zonasi yang memberikan izin kepada Pemilik Lahan untuk meningkatkan intensitas pemanfaatan ruang melebihi aturan dasar (Peningkatan Luas Lantai Atau KLB), dengan memberikan imbalan (kompensasi) antara lain menyediakan sarana publik tertentu, misalnya RTH, terowongan penyeberangan dan sebagainya.</p>`,
        ketentuan: `
        <p>Dimungkinkan peningkatan luas lantai / KLB dengan kompensasi sebagai berikut:</p>
        <ol style="margin-top:-15px">
            <li style="margin-left:-25px">Menyediakan Lahan Dan/Atau Membangun Rth Publik;</li>
            <li style="margin-left:-25px">Menyediakan Lahan Dan/Atau Membangun Rumah Susun Umum;</li>
            <li style="margin-left:-25px">Menyediakan Dan/Atau Membangun Waduk Atau Situ</li>
            <li style="margin-left:-25px">Menyediakan Infrastruktur;</li>
            <li style="margin-left:-25px">Menyediakan Jalur Dan Meningkatkan Kualitas Fasilitas Pejalan Kaki Yang Terintegrasi Dengan Angkutan Umum; <b>Dan/Atau</b></li>
            <li style="margin-left:-25px">Menyediakan Jalur Sepeda Yang Terintegrasi Dengan Angkutan Umum.</li>
        </ol>
    `,
    },
    b: {
        nama: `TPZ Pengalihan Hak Membangun Atau TDR`,
        pengertian: `<p>Teknik pengaturan zonasi yang memungkinkan pemilik tanah untuk mengalihkan haknya untuk membangun kepada pihak lain, sehingga si penerima hak membangun tersebut dapat membangun propertinya dengan intensitas (Luas Lantai atau KLB) lebih tinggi.</p>`,
        ketentuan: `
        <p>Dimungkinkan peningkatan luas lantai bangunan / KLB dengan ketentuan sebagai berikut:</p>
        <ol>
        <li style="margin-left:-25px">Pengalihan hak membangun berupa luas lantai dari satu persil ke persil lain dengan zona yang sama dalam satu batas administrasi kelurahan; </li>
        <li style="margin-left:-25px">Pengalihan hak membangun berupa luas lantai dari satu persil ke persil lain dengan zona yang sama dalam kawasan yang dikembangkan konsep TOD diperkenankan tidak dalam satu blok;</li>
        <li style="margin-left:-25px">Hak membangun yang dapat dialihkan berupa luas lantai dari selisih batasan KLB yang ditetapkan dalam peraturan zonasi dengan KLB yang telah digunakan dalam kaveling;</li>
        <li style="margin-left:-25px">Pengalihan hak membangun berupa luas lantai tidak diperkenankan pada Zona Perumahan Kampung (Sub Zona R.1), Zona Perumahan KDB Sedang - Tinggi (Sub Zona R.2; R.3; R.4; R.5; R.6) dan Zona Perumahan KDB Rendah (R.9).;</li>
        <li style="margin-left:-25px">Penerima pengalihan luas lantai setinggi-tingginya 50% (lima puluh persen) dari KLB yang ditetapkan di lahan perencanaan dimaksud;</li>
        <li style="margin-left:-25px">Pengalihan Luas Lantai  Hanya Dilakukan 1 (Satu) Kali;</li>
        <li style="margin-left:-25px">Terhadap lahan yang telah melakukan pengalihan luas lantai dan menerima pengalihan luas lantai tidak mendapatkan pelampauan KLB;</li>
        <li style="margin-left:-25px">Dalam hal suatu lahan perencanaan telah melakukan pengalihan luas lantai kemudian ditetapkan KLB baru untuk lahan perencanaan tersebut, maka selisih KLB tidak dapat dialihkan; dan</li>
        <li style="margin-left:-25px">Pengalihan luas lantai pada zona dalam suatu lahan perencanaan terpadu dan kompak yang telah memiliki panduan Rancang Kota (UDGL), harus menetapkan kembali Panduan Rancang Kota (UDGL).</li>
    </ol>
`,
    },
    c: {
        nama: `TPZ Pertampalan Aturan Atau Overlay`,
        pengertian: `<p>Teknik Pengaturan zonasi yang memberikan fleksibilitas dalam penerapan peraturan zonasi yang berupa pembatasan intensitas pembangunan melalui penerapan dua atau lebih aturan.</p>`,
        ketentuan: `
        <p>Pembatasan Intensitas dengan ketentuan sebagai berikut:</p>
        <ol>
            <li style="margin-left:-25px">Pembatasan Tinggi Bangunan; Pembatasan Tinggi Bangun Bangunan; dan Pembatasan Jenis Kegiatan sesuai peraturan perundang – undangan.</li>
        </ol>
    `,
    },
    d: {
        nama: `TPZ Permufakatan Pembangunan`,
        pengertian: `<p>Teknik Pengaturan Zonasi yang merupakan Salah satu bentuk opsi penyesuaian pengaturan zonasi yang memperbolehkan adanya Kesepakatan untuk pengadaan lahan/persil untuk infrastruktur.</p>`,
        ketentuan: `
        <p>Perubahan jenis kegiatan dan perubahan luas lantai dengan ketentuan sebagai berikut:</p>
        <ol>
            <li style="margin-left:-25px">Lahan/persil Berada di sepanjang koridor angkutan massal berbasis rel layang.</li>
            <li style="margin-left:-25px">Perubahan kegiatan ruang dalam lahan/persil yang termasuk ke dalam koridor tersebut.</li>
            <li style="margin-left:-25px">Penambahan kegiatan ruang dalam persil yang termasuk ke dalam koridor tersebut.</li>
            <li style="margin-left:-25px">Penambahan luas lantai dari ketentuan KLB yang berlaku sebelumnya.</li>
        </ol>
    `,
    },
    e: {
        nama: `TPZ Khusus`,
        pengertian: `<p>Teknik Pengaturan Zonasi yang merupakan salah satu bentuk opsi penyesuaian pengaturan zonasi yang memperbolehkan adanya fungsi dan tujuan khusus dari suatu kawasan dan/atau persil dalam kawasan yang memiliki karateristik spesifik dan keberadaannya dipertahankan oleh pemerintah. </p>`,
        ketentuan: `
        <p>Pengendalian kawasan yang memiliki karateristik spesifik dengan ketentuan sebagai berikut:</p>
        <ol>
        <li style="margin-left:-25px">Khusus pada Lahan/Persil di kawasan Taman Medan Merdeka (Taman Monas) diperkenankan untuk  memanfaatkan ruang bawah tanah sebagai ruang pamer, pusat informasi, parkir, dan penunjang serta ruang untuk kepentingan pertahanan keamanan.</li>
        <li style="margin-left:-25px">Lahan/persil memiliki dimensi dan ketentuan pembangunan sesuai kebutuhan dan dilaksanakan sesuai ketentuan peraturan perundangan.</li>
        <li style="margin-left:-25px">Lahan/persil yang dikembangkan tidak menimbulkan dampak negatif terhadap kawasan sekitar;dan</li>
        <li style="margin-left:-25px">Khusus pada lahan pertanian sawah tidak diperkenankan pengembangan selain kegiatan pertanian.</li>
    </ol>
        `,
    },
    "f.1": {
        nama: `TPZ Pengendalian Pertumbuhan : Kawasan Sentra Industri Kecil`,
        pengertian: `<p>Teknik Pengaturan Zonasi yang dikendalikan Perkembangannya karena karateristik kawasan sebagai kawasan sentra industri kecil.</p>`,
        ketentuan: `
        <p>Pengendalian perkembangan akibat karateristik sebagai kawasan sentra industri kecil, dengan ketentuan sebagai berikut:</p>
        <ol>
            <li style="margin-left:-25px">Menyediakan Gudang Bahan Baku Bersama;</li>
            <li style="margin-left:-25px">Menyediakan Ipal Komunal;</li>
            <li style="margin-left:-25px">Menyediakan Dapur Dengan Teknologi Ramah Lingkungan;</li>
            <li style="margin-left:-25px">Menyediakan Fasilitas Bongkar Muat Komunal; Dan</li>
            <li style="margin-left:-25px">Menjadi Anggota Wadah Atau Perkumpulan Yang Terdaftar Dan Diakui Oleh Pemerintah.</li>
        </ol>
        `,
    },
    "f.2": {
        nama: `TPZ Pengendalian Pertumbuhan : Kawasan Pembangunan Berpola Pita Di Sepanjang Koridor
        Transportasi Massal Di Luar Kawasan TOD
        `,
        pengertian: `<p>sebagai Kawasan Pembangunan Berpola Pita Di Sepanjang Koridor Transportasi Massal Di Luar Kawasan TOD.</p>`,
        ketentuan: `
            <p>Koridor Transportasi Massal Di Luar Kawasan TOD , dengan ketentuan sebagai berikut:</p>
            <ol>
            <li style="margin-left:-25px">Kegiatan Pemanfaatan Ruang Untuk Fungsi Komersial Dibatasi Paling Tinggi  50% (Lima Puluh Persen) Atau 2 (Dua) Lantai Dari Luas Seluruh Lantai Bangunan;</li>
            <li style="margin-left:-25px">Tipe Bangunan Deret Intensitas Pemanfaatan Ruang Kdb Paling Tinggi 50% (Lima Puluh Persen), Klb Paling Tinggi 2,0 (Dua Koma Nol), Ketinggian Bangunan Paling Tinggi 4 (Empat) Lantai, Kdh Paling Rendah 30% (Tiga Puluh Persen), Dan Ktb Paling Tinggi  55% (Lima Puluh Lima Persen);</li>
            <li style="margin-left:-25px">Pembangunan Harus Sesuai Karakter Lingkungan;</li>
            <li style="margin-left:-25px">Pengaturan Sistem Inlet Outlet Paling Kurang Setiap Jarak 60 M (Enam Puluh Meter) Dan Membuka Pagar Antar Persil;</li>
            <li style="margin-left:-25px">Menyediakan Jalur Pejalan Kaki Menerus Dengan Lebar Paling Kurang 3 M (Tiga Meter);</li>
            <li style="margin-left:-25px">Menyediakan Prasarana Parkir Dalam Persil; Dan</li>
            <li style="margin-left:-25px">Menyerahkan Lahan Yang Terkena Rencana Jalan Dan Saluran Kepada Pemerintah Daerah.</li>
        </ol>
        `,
    },
    g: {
        nama: `TPZ Pelestarian Kawasan Cagar Budaya`,
        pengertian: `Teknik Pengaturan Zonasi Untuk mempertahankan Bangunan dan Situs yang bernilai Sejarah.`,
        ketentuan: `
            <p>Pengendalian untuk mempertahakan bangunan dan situs yang memiliki nilai sejarah, dengan ketentuan sebagai berikut:</p>
            <ol>
            <li style="margin-left:-25px">Kegiatan Hunian Diperkenankan Untuk Dirubah Tanpa Merubah Struktur Dan Bentuk Asli Bangunan Pada Kawasan Yang Dilalui Angkutan Umum Massal;</li>
            <li style="margin-left:-25px">Kegiatan yang diizinkan terbatas (T), bersyarat (B), dan diizinkan terbatas bersyarat (TB) dalam Kawasan Cagar Budaya ditetapkan Gubernur setelah mendapatkan pertimbangan dari BKPRD;</li>
            <li style="margin-left:-25px">Intensitas pemanfaatan ruang Bangunan Cagar Budaya golongan A dan golongan B sesuai kondisi bangunan asli yang ditetapkan; dan</li>
            <li style="margin-left:-25px">Pembangunan baru pada kaveling dalam Kawasan Cagar Budaya   harus menyesuaikan dengan karakter kawasan Cagar Budaya.</li>
        </ol>
        `,
    },
};
let dsc_tpz = `
    <p class="card-title mt-2 mb-2 text-center font-weight-bold judul_utama">Catatan</p>
    <ol>
        <li style="margin-left:-25px">Teknik Pengaturan Zonasi (TPZ) adalah ketentuan lain dari zonasi konvensional yang dikembangkan untuk memberikan fleksibilitas dan pembatasan/pengendalian dalam penerapan aturan zonasi dan ditujukan untuk mengatasi berbagai permasalahan dalam penerapan peraturan zonasi dasar, mempertimbangkan kondisi kontekstual kawasan dan arah penataan ruang.</li>
        <li style="margin-left:-25px">Penerapan teknik aturan zonasi ditetapkan oleh gubernur setelah mendapat pertimbangan dari BKPRD (Badan Koordinasi Penataan Ruang Daerah).</li>
        <li style="margin-left:-25px">Penerapan TPZ dilakukan sesuai dengan kode yang terdapat pada ID Subblok pada lampiran III-3 Perda No 1. Tahun 2014 tentang Rencana Detail dan Peraturan Zonasi Jakarta.</li>
        <li style="margin-left:-25px">Pada beberapa Id Subblok dimungkinkan terdapat lebih dari 1 kode TPZ.</li>
    </ol>
    `;
let desc_pola = {
    PL: "Pengembangan Kawasan Lindung",
    "PB-1": "Pengembangan Terbatas Kawasan budidaya",
    "PB-2": "Pengembangan Terkendali Kawasan budidaya",
    "PB-3": "Pengembangan baru dan terencana kawasan budidaya",
    "PB-4": "Pengembangan kawasan budidaya secara urban regeneration",
    "LP-C": "Pengembangan Kawasan dengan pola lingkungan permukiman cluster",
    "LP-M": "Pengembangan Kawasan dengan pola lingkungan permukiman mandiri (self sufficient neigborhood)",
    "LP-K": "Pengembangan Kawasan dengan pola lingkungan pusat kegiatan ",
    "LP-CR":
        "Pengembangan urban regerneration Kawasan dengan pola lingkungan permukiman cluster",
    "LP-MR":
        "Pengembangan urban regeneration Kawasan dengan pola lingkungan permukiman mandiri (self sufficient neigborhood)",
    "LP-KR":
        "Pengembangan urban regeneration Kawasan dengan pola lingkungan pusat kegiatan ",
    LK: "Lingkungan Khusus",
    "TP-1": "Kawasan alami (tingkat perkembangan 1)",
    "TP-2.1": "Kawasan pedesaan (tingkat perkembangan 2 tipe 1)",
    "TP-2.2": "Kawasan Kampung Kota (tingkat perkembangan 2 tipe 2)",
    "TP-3": "Kawasan sub-urban (tingkat perkembangan 3)",
    "TP-4": "Kawasan urban (tingkat perkembangan 4)",
    "TP-5": "Kawasan Urban Center (tingkat perkembangan 5)",
    "TP-6": "Kawasan Urban Core (tingkat perkembangan 6)",
    KK: "Kawasan khusus 1 (SD1: kaw industry, kaw pariwisata)",
    BP: "Kawasan khusus 2: (CB:civic building)",
    RP: "Kawasan khusus 3: (CS: civic space)",
    "-": "-",
};

//Token
let token =
    "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3MTE0Mzk5OTIsIm5hbWUiOiJhZG1pbiJ9.q0dE4itQi0sJQ3-qABWZyYjYGTx5PRrLTH-tOZ6pTs8";

//Initialize the map
mapboxgl.accessToken =
    "pk.eyJ1IjoibWVudGhvZWxzciIsImEiOiJja3M0MDZiMHMwZW83MnVwaDZ6Z2NhY2JxIn0.vQFxEZsM7Vvr-PX3FMOGiQ";
const map = new mapboxgl.Map({
    container: "map",
    style: "mapbox://styles/menthoelsr/ckp6i54ay22u818lrq15ffcnr",
    zoom: 15,
    center: [106.8245788, -6.2308403],
    preserveDrawingBuffer: true,
});

//Add Icon Layer

// For Iumk fill
map.loadImage(`/assets/gambar/ICON.png`, function (error, image) {
    if (error) throw error;
    map.addImage("point", image);
});

// For poi_dot
let poi_icon = [
    "apartemen.png",
    "bandara.png",
    "certified.png",
    "faskes.png",
    "gereja.png",
    "halte.png",
    "hotel.png",
    "historic.png",
    "jasa.png",
    "kantor.png",
    "klenteng.png",
    "laut.png",
    "mall.png",
    "masjid.png",
    "market.png",
    "office.png",
    "pelabuhan.png",
    "perdagangan.png",
    "perpustakaan.png",
    "pura.png",
    "produksi.png",
    "restoran.png",
    "sekolah.png",
    "spbu.png",
    "stasiun.png",
    "shop.png",
    "tollgate.png",
    "terminal.png",
    "wilayah.png",
];

poi_icon.forEach((icon) => {
    map.loadImage(`assets/gambar/icons/${icon}`, (error, image) => {
        if (error) throw error;
        map.addImage(icon.split(".")[0], image);
    });
});

//Initialize Select2
$(
    "#kegiatanRuang, #kegiatanRuangNew, #kegiatan, #kegiatanKewenangan, #selectSimulasi, #skala, #jenisUsahaAmdal, #indikatorA, #parameterA, #indikatorB, #parameterB"
).select2();

//Change Base Map Function

const switchLayer = (layer) => {
    let layerId = layer.target.id;
    map.setStyle("mapbox://styles/menthoelsr/" + layerId);
};

let layerList = document.getElementById("menu");
let inputs = layerList.getElementsByTagName("input");

for (let i = 0; i < inputs.length; i++) {
    inputs[i].onclick = switchLayer;
}

//Declare Control

//Directions
const directions = new MapboxDirections({
    accessToken: mapboxgl.accessToken,
    steps: false,
    waypointDraggable: true,
    geometries: "polyline",
    controls: { instructions: true },
});

//Draw
const draw = new MapboxDraw({
    displayControlsDefault: false,
    controls: {
        polygon: true,
    },
    defaultMode: "simple_select",
});

//Manage Controll

const andalalinControl = () => {
    //Enable and Disable Layer
    $("#andalalin-tab").on("click", () => {
        if ($("#enable-direction").prop("checked") !== true) {
            $(
                ".inf-titik, .inf-kecepatan-06, .inf-tempuh-06, .inf-kecepatan-09, .inf-tempuh-09, .inf-kecepatan-12, .inf-tempuh-12, .inf-kecepatan-15, .inf-tempuh-15, .inf-kecepatan-18, .inf-tempuh-18"
            ).html("-");
            $(".inf-titika, .inf-titikb").val("");
            $("#enable-direction").prop("disabled", false);
            $("#enable-direction").trigger("click");
        }
    });

    //Hide Panel Control
    $("#enable-direction").change(() => {
        if ($("#enable-direction").prop("checked") == true) {
            map.addControl(directions, "top-left");
            localStorage.setItem("direction", 1);
            $(".mapboxgl-ctrl-directions").css("visibility", "hidden");
            $(".mapboxgl-ctrl-directions").css("z-index", "-9");
        } else {
            map.removeControl(directions);
            localStorage.setItem("direction", 0);
        }
    });

    //Logic for time count
    let hourTime = ["06:00", "09:00", "12:00", "15:00", "18:00"];

    directions.on("route", (e) => {
        let data = e.route[0].legs[0].steps;
        let distance = e.route[0].distance / 1000;
        $(".inf-titik").html(distance.toFixed(2) + " km");
        $(".inf-titika").val(
            data[0].name == ""
                ? data[0].intersections[0].location[1] +
                      "," +
                      data[0].intersections[0].location[0]
                : data[0].name
        );
        $(".inf-titikb").val(
            data[data.length - 1].name == ""
                ? data[data.length - 1].intersections[0].location[1] +
                      "," +
                      data[data.length - 1].intersections[0].location[0]
                : data[data.length - 1].name
        );
        let from =
            data[0].intersections[0].location[0] +
            "," +
            data[0].intersections[0].location[1];
        let to =
            data[data.length - 1].intersections[0].location[0] +
            "," +
            data[data.length - 1].intersections[0].location[1];
        let way = [from, to];
        hourTime.forEach((el) => {
            estimation_direction(el, way);
        });
    });

    const estimation_direction = (time, way) => {
        let date = $('meta[name="datetime"]').attr("content");
        $.get(
            `https://api.mapbox.com/directions/v5/mapbox/driving/${way[0]};${way[1]}?access_token=${mapboxgl.accessToken}&depart_at=${date}T${time}`
        ).done((data) => {
            let data_direction = data.routes[0];
            let duration = data_direction.duration / 60;
            let distance = data_direction.distance / 1000;
            let speed = distance / (data_direction.duration / 3600);

            if (speed.toFixed(2) >= 15) {
                color = "#2ecc71";
            } else if (speed.toFixed(2) >= 5) {
                color = "#f1c40f";
            } else if (speed.toFixed(2) >= 1) {
                color = "#e74c3c";
            } else {
                color = "#c0392b";
            }

            $(`.inf-direction-${time.substring(0, 2)}`).css("color", color);
            $(`.inf-kecepatan-${time.substring(0, 2)}`).html(
                `${speed.toFixed(2)}`
            );
            $(`.inf-tempuh-${time.substring(0, 2)}`).html(
                `${duration.toFixed(0)}`
            );
        });
    };

    $("#andalalin-tab").on("click", () => {
        if ($("#enable-direction").prop("checked") !== true) {
            $(
                ".inf-titik, .inf-kecepatan-06, .inf-tempuh-06, .inf-kecepatan-09, .inf-tempuh-09, .inf-kecepatan-12, .inf-tempuh-12, .inf-kecepatan-15, .inf-tempuh-15, .inf-kecepatan-18, .inf-tempuh-18"
            ).html("-");
            $(".inf-titika, .inf-titikb").val("");
            $("#enable-direction").prop("disabled", false);
            $("#enable-direction").trigger("click");
        }
    });
};

const drawControl = () => {
    //add Control to map
    map.addControl(draw);

    //hide panel control
    $(".mapbox-gl-draw_ctrl-draw-btn.mapbox-gl-draw_polygon").hide();

    //List Layer
    let fillLayerDraw = [
        "gl-draw-polygon-fill-active.cold",
        "gl-draw-polygon-fill-active.hot",
    ];

    let lineLayerDraw = [
        "gl-draw-polygon-stroke-active.cold",
        "gl-draw-line-active.cold",
        "gl-draw-polygon-stroke-active.hot",
        "gl-draw-line-active.hot",
    ];

    //Digitasi Event
    $("#polygonDraw").on("click", () => {
        console.log("draw");
        fillLayerDraw.forEach((e) => {
            map.setPaintProperty(e, "fill-color", "#fff");
            map.setPaintProperty(e, "fill-opacity", 1);
        });
        lineLayerDraw.forEach((e) => {
            map.setPaintProperty(e, "line-color", "#fff");
        });
        $(".mapbox-gl-draw_ctrl-draw-btn.mapbox-gl-draw_polygon").click();
        localStorage.setItem("polygonDraw", 1);
        localStorage.setItem("polygonOptions", "Digitasi");
    });

    //Create SHP Event
    $("#btnSHP").on("click", () => {
        $("#createSHP").addClass("text-primary");
        fillLayerDraw.forEach((e) => {
            if (map.getStyle().sprite.includes("ckp6i54ay22u818lrq15ffcnr")) {
                map.setPaintProperty(e, "fill-color", "#000");
            } else {
                map.setPaintProperty(e, "fill-color", "#fff");
            }
            map.setPaintProperty(e, "fill-opacity", 0);
        });
        lineLayerDraw.forEach((e) => {
            if (map.getStyle().sprite.includes("ckp6i54ay22u818lrq15ffcnr")) {
                map.setPaintProperty(e, "line-color", "#fff");
            } else {
                map.setPaintProperty(e, "line-color", "#000");
            }
            map.setPaintProperty(e, "line-width", 3);
        });
        $(".mapbox-gl-draw_ctrl-draw-btn.mapbox-gl-draw_polygon").click();
        localStorage.setItem("polygonDraw", 1);
        localStorage.setItem("polygonOptions", "SHP");
    });

    //Close Direction on Click More Button
    $(
        "#lokasi-tab, #ketentuan-tab, #poi-tab, #kbli-tab, #cetak-tab, #simulasi-tab, #btnSHP, #simio-tab, #polygonDraw, #index-tab, #filter-tab"
    ).on("click", () => {
        if ($("#enable-direction").prop("checked") == true) {
            $("#enable-direction").trigger("click");
            $("#enable-direction").prop("disabled", true);
        }
    });

    //Remove on Click Escape
    $("body").on("keydown", function (event) {
        if (event.key == "Escape") {
            if (localStorage.getItem("polygonDraw") == 1) {
                $("#closeDigitasi").click();
                $("#createSHP").removeClass("text-primary");
                draw.deleteAll();
                if (localStorage.getItem("polygonOptions") == "Measure") {
                    if (map.getSource("area") !== undefined) {
                        map.removeLayer("area-label");
                        map.removeLayer("area-fill");
                        map.removeSource("area");
                    }
                    setTimeout(() => {
                        localStorage.setItem("polygonDraw", 1);
                        localStorage.setItem("polygonOptions", "Measure");

                        $(
                            ".mapbox-gl-draw_ctrl-draw-btn.mapbox-gl-draw_polygon"
                        ).click();
                    }, 1000);
                } else {
                    localStorage.setItem("polygonDraw", 0);
                }
            }
        }
    });

    //Action Draw
    const actionDraw = (e) => {
        let drawOptions = localStorage.getItem("polygonOptions");
        const data = draw.getAll();
        const area = turf.area(data);
        const rounded_area = Math.round(area * 100) / 100;
        const fixArea = rounded_area / 10000;
        let coordinate = e.features[0].geometry.coordinates[0];
        let fix_coordinate = "";
        coordinate.forEach((el) => {
            fix_coordinate += el[0] + " " + el[1] + ",";
        });

        let coor = fix_coordinate.substring(0, fix_coordinate.length - 1);
        if (drawOptions == "Digitasi") {
            if (fixArea <= 5) {
                getDigitasi(coor);
                $("#coorddigitasi").val(coor);
                $("#luasdigitasi").val(rounded_area);
            } else {
                alert("Batas Luas Area Digitasi Maksimal 5 Ha");
            }
        } else if (drawOptions == "Measure") {
            let data = draw.getAll();
            data.features[0].properties.area = `${area.toFixed(2)} m²`;

            map.addSource(`area`, {
                type: "geojson",
                data: data,
            });

            map.addLayer({
                id: `area-fill`,
                type: "fill",
                source: `area`,
                paint: {
                    "fill-color": "#fff",
                    "fill-opacity": 0.5,
                    "fill-outline-color": "#fff",
                },
            });

            map.addLayer({
                id: `area-label`,
                type: "symbol",
                source: `area`,
                layout: {
                    "text-field": "{area}",
                    "text-font": [
                        "Open Sans Semibold",
                        "Arial Unicode MS Bold",
                    ],
                },
                paint: {
                    "text-color": "#000",
                },
            });

            // Auto Fill Measure in Potensi Feature
            setTimeout(() => {
                $(".inf-potensi-luas-lahan")
                    .val(separatorNum(area.toFixed(0)).replaceAll(",", "."))
                    .trigger("keyup");
            }, 1500);

            // potensi();

            draw.deleteAll();
        } else {
            $("#downloadSHP").modal("show");
        }
    };

    //Event on Draw
    map.on("draw.create", (e) => {
        actionDraw(e);
    });

    map.on("draw.update", (e) => {
        actionDraw(e);
    });

    $("#formSHP").on("submit", (e) => {
        e.preventDefault();
        exportSHP();
    });

    const exportSHP = () => {
        let name = $("#nameFileSHP").val();
        var options = {
            folder: false,
            filename: name,
            types: {
                polygon: name,
            },
        };
        // a GeoJSON bridge for features
        shpwrite.download(draw.getAll(), options);
        $("#downloadSHP").modal("hide");
    };
};

//Measure Area
// const measureArea = () => {
//     let btn = document.createElement("button");
//     btn.className = "mapbox-gl-draw_ctrl-draw-btn mapbox-gl-measure-area";
//     btn.title = "Ukur Luas";

//     let container = document.getElementsByClassName(
//         "mapboxgl-ctrl mapboxgl-ctrl-group"
//     )[0];

//     if (document.getElementsByClassName("mapbox-gl-measure-area").length == 0) {
//         container.appendChild(btn);
//     }

//     $(".mapbox-gl-draw_ctrl-draw-btn.mapbox-gl-measure-area").on(
//         "click",
//         (e) => {
//             if (
//                 $(".mapbox-gl-draw_ctrl-draw-btn.mapbox-gl-measure-area-active")
//                     .length
//             ) {
//                 if (map.getSource("area") !== undefined) {
//                     map.removeLayer("area-label");
//                     map.removeLayer("area-fill");
//                     map.removeSource("area");
//                 }

//                 e.target.className =
//                     "mapbox-gl-draw_ctrl-draw-btn mapbox-gl-measure-area";
//                 draw.deleteAll();
//                 localStorage.setItem("polygonDraw", 0);
//             } else {
//                 localStorage.setItem("polygonDraw", 1);
//                 localStorage.setItem("polygonOptions", "Measure");

//                 e.target.className =
//                     "mapbox-gl-draw_ctrl-draw-btn mapbox-gl-measure-area-active";

//                 $(
//                     ".mapbox-gl-draw_ctrl-draw-btn.mapbox-gl-draw_polygon"
//                 ).click();
//             }
//         }
//     );
// };

//Add More Control for Map
map.addControl(
    new mapboxgl.NavigationControl({
        showCompass: false,
    })
);

map.addControl(new PitchToggle({ minpitchzoom: 15 }));
map.addControl(new PlotSHP());
map.addControl(new MeasureDistance());

// Geolocate
const geolocate = new mapboxgl.GeolocateControl({
    positionOptions: {
        enableHighAccuracy: true,
    },
    // When active the map will receive updates to the device's location as it changes.
    trackUserLocation: true,
    // Draw an arrow next to the location dot to indicate which direction the device is heading.
    showUserHeading: true,
});
map.addControl(geolocate);

geolocate.on("geolocate", (e) => {
    loadZoning(e.coords.latitude, e.coords.longitude);
});

//Initialize Style
map.on("style.load", () => {
    //Add 3D Layer
    const layers = map.getStyle().layers;
    const labelLayerId = layers.find(
        (layer) => layer.type === "symbol" && layer.layout["text-field"]
    ).id;

    map.addLayer(
        {
            id: "add-3d-buildings",
            source: "composite",
            "source-layer": "building",
            filter: ["==", "extrude", "true"],
            type: "fill-extrusion",
            minzoom: 10,
            paint: {
                "fill-extrusion-color": "#aaa",

                // Use an 'interpolate' expression to
                // add a smooth transition effect to
                // the buildings as the user zooms in.
                "fill-extrusion-height": [
                    "interpolate",
                    ["linear"],
                    ["zoom"],
                    10,
                    0,
                    10.05,
                    ["get", "height"],
                ],
                "fill-extrusion-base": [
                    "interpolate",
                    ["linear"],
                    ["zoom"],
                    10,
                    0,
                    10.05,
                    ["get", "min_height"],
                ],
                "fill-extrusion-opacity": 0.6,
            },
        },
        labelLayerId
    );

    //Load Control
    andalalinControl();
    drawControl();
    measureArea();

    //Load Layer Survey Perkembangan
    // getLayerSurveyPerkembangan();

    //Load Layer Izin Lingkungan
    getLayerIzinLingkungan();
});

window.onload = function () {
    // noo1
    // var checkbox = document.getElementById("urban_fill");
    // checkbox.checked = true;
    // getDataSource("urban", localStorage.getItem("kelurahan"));

    // Opsional: Memicu event 'change' jika ada logika tambahan yang tergantung pada ini
    // Ini bisa berguna jika ada event handler yang terpasang pada checkbox ini
    var event = new Event("change");
    checkbox.dispatchEvent(event);
};

map.on("load", () => {
    // Koordinat yang ditentukan
    const lat = -6.227329703717999;
    const lng = 106.83267899475032;

    // Langsung memanggil fungsi loadZoning dengan koordinat tersebut
    loadZoning(lat, lng);

    //Add Source Layer Zoning from Tegola
    SourceZoning();
    if (user_id != 4309) {
        map.addControl(new PrintToggle());
    }
});

const SourceZoning = () => {
    map.addSource("zoning", {
        type: "vector",
        tiles: [
            "https://jakarta.pintoinvest.com:8080/maps/jakpintas/{z}/{x}/{y}.vector.pbf?",
        ],
        tolerance: 0,
    });
};

//Reset Logic on Load
$(window).on("load", () => {
    localStorage.removeItem("kelurahan");
    localStorage.setItem("direction", 0);
    localStorage.setItem("polygonDraw", 0);
    localStorage.setItem("measure_distance", 0);
    localStorage.setItem("koefisien", 0);
    localStorage.setItem("simulasi", "");

    //Load Runing Text
    runingText();

    //Load Data Interactive
    // choro();

    //Load IO data
    IO();
    // getIOBruto();

    // Reset Session Option Print
    resetOptionPrint();
});

//Lazy Load Images
const lazyLoadImages = () => {
    let lazyImages = [].slice.call(document.querySelectorAll("img.lazy"));
    if ("IntersectionObserver" in window) {
        let lazyImageObserver = new IntersectionObserver(
            (entries, observer) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        let lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.classList.remove("lazy");
                        lazyImageObserver.unobserve(lazyImage);
                    }
                });
            }
        );

        lazyImages.forEach((lazyImage) => {
            lazyImageObserver.observe(lazyImage);
        });
    } else {
        lazyImages.forEach((lazyImage) => {
            lazyImage.src = lazyImage.dataset.src;
            lazyImage.classList.remove("lazy");
        });
    }
};

//Runing Text
const runingText = () => {
    $.ajax({
        url: `${url_api}/text`,
        method: "POST",
        dataType: "json",
        beforeSend: function () {
            $(".runing-text").html("");
        },
        headers: {
            Authorization: "Bearer " + token,
        },
        success: function (e) {
            var data = e.features;
            var text = "";
            for (let index = 0; index < data.length; index++) {
                text += data[index].properties.Text + ". ";
            }
            $(".runing-text").html("");
            $(".runing-text").html(text);
            $(".runing-text").marquee({
                direction: "left",
                duration: 20000,
            });
            // console.log(text);
        },
    });
};

//Intance Popup
const popup = new mapboxgl.Popup({
    closeButton: false,
    closeOnClick: false,
});
const popupSurvey = new mapboxgl.Popup({
    closeButton: true,
    closeOnClick: false,
});
const popupIumk = new mapboxgl.Popup({
    closeButton: true,
    closeOnClick: false,
});

const popupNib = new mapboxgl.Popup({
    closeButton: true,
    closeOnClick: false,
});

const popupIprt = new mapboxgl.Popup({
    closeButton: true,
    closeOnClick: false,
});

//Hidden Elements
$(
    "#btn-print, #pesanGagal, #pesanBerhasil, #pesanBerhasilEdit, #pesanBerhasilHapus, #messageNoData, #profile, #pesanFoto, #pesanGagalPrint, #pesanGagalPrintKBLI, #formPinLocationEdit, #pesanGagalPrintDigitasi, #pesanGagalPrintDigitasiOption, #formSurveyLocationEdit, #pesanBerhasilSurvey, #pesanGagalSurvey, #messageNoDataSurvey, #pesanBerhasilEditSurvey, #pesanBerhasilHapusSurvey, #prosesSurvey, #resetSurey, #prosesSurveyBulk, #pesanGagalSurveyBulk, #pesanGagalUsaha, #pesanBerhasilUsaha, #resetUsaha,.container_menu.for_web,.tab-content.for_web,hr.for_web,.btn_hide_side_bar.for_web,.detail_jumlah"
).hide();

$(
    ".mapboxgl-ctrl.mapboxgl-ctrl-attrib, .mapboxgl-ctrl-geocoder.mapboxgl-ctrl, a.mapboxgl-ctrl-logo, .mapboxgl-ctrl-directions"
).css("visibility", "hidden");

//Add Source Layer
const addSourceLayers = (kelurahan) => {
    let kategori = [
        "wilayah",
        "zoning",
        "zoning_old",
        "iumk",
        "sewa",
        "investasi",
        "pipa",
        "tol",
        "sungai",
        "banjir",
        "budaya",
        "urban",
        "transportasi",
        "rw",
        "survey",
        "gsb_nol",
        "kontur",
        "nib",
        "iprt",
        "garis_kepulauan",
        "area_kepulauan",
        "kawasan_khusus",
        "batas_laut",
        "sarana_prasarana",
        "analisa_gis",
    ];

    kategori.forEach((val) => {
        //Load Layer
        getDataSource(val, kelurahan);
    });
};

//Layer Banjir
const banjir = (
    kelurahan = localStorage.getItem("kelurahan"),
    tahun = $("#ControlTahunBanjir").val()
) => {
    if (map.getLayer("banjir_fill")) {
        map.removeLayer("banjir_fill");
        map.removeSource("banjir");
    }
    $.ajax({
        url: `${url_api}/banjir`,
        type: "POST",
        data: {
            kelurahan: kelurahan,
            tahun: tahun,
        },
        headers: {
            Authorization: "Bearer " + token,
        },
        dataType: "json",
        success: (data) => {
            map.addSource("banjir", {
                type: "geojson",
                data: data,
            });

            addLayers("banjir");
            onOffLayer("banjir");
        },
    });
};

const getDataSource = (kategori, kelurahan) => {
    let temp_kategori = [];

    if (kategori == "banjir") {
        if ($("#banjir_fill").is(":checked")) {
            banjir(kelurahan);
        }
    } else if (kategori == "zoning") {
        if (map.getLayer("zoning_fill")) {
            map.removeLayer("zoning_fill");
        }
        if (map.getLayer("zoning_label")) {
            map.removeLayer("zoning_label");
        }

        addLayers("zoning");
        onOffLayer("zoning");
    } else if (kategori == "zoning_old") {
        if (map.getLayer("zoning_old_fill")) {
            map.removeLayer("zoning_old_fill");
        }
        if (map.getLayer("zoning_old_label")) {
            map.removeLayer("zoning_old_label");
        }

        addLayers("zoning_old");
        onOffLayer("zoning_old");
    } else if (kategori == "survey") {
        if ($("#survey_dot").is(":checked")) {
            if (map.getSource("survey")) {
                map.removeLayer("survey_dot");
                map.removeSource("survey");
            }

            $.ajax({
                url: `${APP_URL}/${kategori}/${kelurahan}`,
                type: "get",
                dataType: "json",
                success: (data) => {
                    map.addSource(kategori, {
                        type: "geojson",
                        data: data,
                    });
                    addLayers(kategori);
                    onOffLayer(kategori);
                    let data_layer = data.features;
                    let content = "";
                    // console.log(data_layer);
                    $(".list-item-survey-perkembangan").html("");
                    if (data_layer.length == 0) {
                        content += `
                            <div class="item mb-3">
                                <p>Tidak Ada Lokasi yang di Simpan</p>
                            </div>
                        `;
                    } else {
                        data_layer.forEach(function (item) {
                            let thumbnail = item.properties.image;
                            content += `
                            <div class="item mb-3">
                            <div class="row">
                                <div class="col-4">
                                    <img class="lazy" width="100px" height="90px" style="object-fit: cover; border-radius:15px" data-src="https://jakarta.pintoinvest.com/survey/${
                                        thumbnail.length == 0
                                            ? "not_image.png"
                                            : thumbnail[0].name
                                    }">
                                </div>
                                <div class="col-8">
                                    <span style="font-size: 11pt" class="font-weight-bold">${
                                        item.properties.name
                                    }</span>
                                    <label class="w-100" style="font-size: 13px; margin-bottom:-5px">Pola Regional :
                                        <span>${
                                            item.properties.regional
                                        }</span></label>
                                    <label class="w-100" style="font-size: 13px; margin-bottom:-5px">Pola Lingkungan :
                                        <span>${
                                            item.properties.neighborhood
                                        }</span></label>
                                    <label class="w-100" style="font-size: 13px; margin-bottom:-5px">Pola Ruang : <span>${
                                        item.properties.transect_zone
                                    }</span></label>
                                </div>
                            </div>
                        </div>
                            `;
                        });
                    }

                    $(".list-item-survey-perkembangan").html(content);
                    lazyLoadImages();
                    // if (localStorage.getItem("searching") == 1) {
                },
            });
        }
    } else {
        let list_shape = ["fill", "dot", "line", "multilinestring", "label"];
        list_shape.forEach((val) => {
            if (map.getLayer(`${kategori}_${val}`)) {
                map.removeLayer(`${kategori}_${val}`);
                map.removeSource(kategori);
            }
            if ($(`#${kategori}_${val}`).is(":checked")) {
                if (!temp_kategori.includes(kategori)) {
                    $.ajax({
                        url: `${url_api}/${kategori}`,
                        type: "POST",
                        data: {
                            kelurahan: kelurahan,
                        },
                        headers: {
                            Authorization: "Bearer " + token,
                        },
                        dataType: "json",
                        success: (data) => {
                            map.addSource(kategori, {
                                type: "geojson",
                                data: data,
                            });
                            if (kategori == "nib") {
                                nib_data = data;
                            }
                            addLayers(kategori);
                            onOffLayer(kategori);
                        },
                    });
                }
                temp_kategori.push(kategori);
            }
        });
    }
};

$("#ControlTahunBanjir").change(() => {
    $("#tahunBanjir").text($("#ControlTahunBanjir").val());
    banjir();
});

//Get Image IUMK
const getIumkForInfo = (coor, destination) => {
    $.ajax({
        url: `https://iumk.perizinan-dev.com/api/getWithKoordinat`,
        method: "post",
        headers: {
            AUTHCODE: "9ee2f95d62b9f67f58ec288b1599cf9c",
            Accept: "application/json",
            "Content-Type": "application/x-www-form-urlencoded",
        },
        data: {
            lat: coor[0],
            lng: coor[1],
        },
        beforeSend: () => {},
        success: (dt) => {
            const dtResp = JSON.parse(dt);
            addImageIumkForInfo(dtResp.data[0].file_foto_usaha, destination);
        },
        error: (error) => {
            // console.log(error);
        },
    });
};

const addImageIumkForInfo = (imgSource, destination) => {
    $(destination)
        .on("error", function () {
            $(this).attr(
                "src",
                "https://www.salonlfc.com/wp-content/uploads/2018/01/image-not-found-1-scaled-1150x647.png"
            );
        })
        .attr("data-src", imgSource);

    setTimeout(() => {
        lazyLoadImages();
    }, 100);
};

const getIumk = (e) => {
    const dt = e.features[0].properties;
    $.ajax({
        url: `https://iumk.perizinan-dev.com/api/getWithKoordinat`,
        method: "post",
        headers: {
            AUTHCODE: "9ee2f95d62b9f67f58ec288b1599cf9c",
            Accept: "application/json",
            "Content-Type": "application/x-www-form-urlencoded",
        },
        data: {
            lat: dt.Lat,
            lng: dt.Long,
        },
        beforeSend: function () {},
        success: function (dt) {
            const dtResp = JSON.parse(dt);
            setTimeout(() => {
                // const img = document.getElementById('imgCardIUMK')
                // img.src = dtResp.data[0].file_foto_usaha
                addImageIumk(dtResp.data[0].file_foto_usaha, "#imgCardIUMK");
            }, 500);
        },
        error: function (error) {
            // console.log(error);
        },
    });
};

const addImageIumk = (imgSource, destination) => {
    let img = $(destination).on("error", handleImgError).attr("src", imgSource);
    $(destination).append(img);
    $(destination).show();
};

//Get Detail IUMK
const getDetailIumk = (
    ogc_fid,
    nama_usaha,
    nama_pemilik,
    alamat,
    nik,
    npwp,
    penilaian,
    perizinan,
    omzet_tahunan,
    star,
    no_izin_edar,
    no_nib,
    no_halal
) => {
    $("#ogc_fid_iumk").val(ogc_fid);
    $("#nama_usaha_iumk").val(nama_usaha);
    // $("#nama_pemilik_iumk").val(nama_pemilik);
    $("#alamat_usaha_iumk").val(alamat);
    $("#nik_iumk").val(nik);
    $("#npwp_iumk").val(npwp);
    $("#penilaian_iumk").val(penilaian == "null" ? 0 : penilaian);
    $("#perizinan_iumk").val(perizinan);
    $("#omzet_tahunan_iumk").val(omzet_tahunan);
    $(`input[name='star'][value='${star}']`).prop("checked", true);
    $(`input[name='stars'][value='${penilaian}']`).trigger("click");

    if (perizinan === "NIB") {
        console.log("NIB", no_nib);
        $("#no_izin_iumk").val(no_nib);
    } else if (perizinan === "Halal") {
        console.log("Halal", no_halal);
        $("#no_izin_iumk").val(no_halal);
    } else {
        console.log("Edar", no_izin_edar);
        $("#no_izin_iumk").val(no_izin_edar);
    }

    $(".info-edit-iumk").show();
};

$("#closeEditIUMK").click(() => {
    $(".info-edit-iumk").hide();
    markerIzin.remove();
});

$("input[name='stars']").change((e) => {
    $("#penilaian_iumk").val(e.target.value);
});

$("#formEditIUMK").on("submit", (e) => {
    e.preventDefault();

    // Get All Data Form
    const data = $("#formEditIUMK").serialize();

    $.ajax({
        url: `${APP_URL}/update_iumk`,
        method: "post",
        data: data,
        beforeSend: () => {
            $(".btn-send-iumk").hide();
            $(".spinner-edit-iumk").show();
        },
        success: (dt) => {
            getDataSource("iumk", localStorage.getItem("kelurahan"));
            $(".spinner-edit-iumk").hide();
            $(".btn-send-iumk").show();
        },
        error: (error) => {
            $(".spinner-edit-iumk").hide();
            $(".btn-send-iumk").show();
        },
    });
});

//Add Layer
const addLayers = (layer) => {
    if (layer == "wilayah") {
        map.addLayer({
            id: "wilayah_fill",
            type: "fill",
            source: "wilayah",
            paint: {
                "fill-color": "#00FFFF",
                "fill-opacity": 0.1,
                "fill-outline-color": "red",
            },
            layout: {
                visibility: "visible",
            },
        });
    } else if (layer == "zoning") {
        map.addLayer({
            id: "zoning_fill",
            type: "fill",
            source: "zoning",
            "source-layer": "zoning_new",
            type: "fill",
            filter: ["==", "wadmkd", titleCase(kelurahan_tmp_global)],
            paint: {
                "fill-color": ["get", "fill"],
                "fill-opacity": 1,
                "fill-outline-color": "black",
            },
            layout: {
                visibility: "none",
            },
        });

        map.addLayer({
            id: "zoning_label",
            type: "symbol",
            source: "zoning",
            "source-layer": "zoning_new",
            filter: ["==", "wadmkd", titleCase(kelurahan_tmp_global)],
            layout: {
                "text-field": ["get", "kodszntext"],
                "text-font": ["DIN Offc Pro Medium", "Arial Unicode MS Bold"],
                "text-size": 12,
                visibility: "none",
            },
        });
    } else if (layer == "zoning_old") {
        map.addLayer({
            id: "zoning_old_fill",
            type: "fill",
            source: "zoning",
            "source-layer": "zoning_old",
            filter: ["==", "kelurahan", kelurahan_tmp_global],
            paint: {
                "fill-color": ["get", "fill"],
                "fill-opacity": 1,
                "fill-outline-color": "black",
            },
            layout: {
                visibility: "none",
            },
        });

        map.addLayer({
            id: "zoning_old_label",
            type: "symbol",
            source: "zoning",
            "source-layer": "zoning_old",
            filter: ["==", "kelurahan", kelurahan_tmp_global],
            layout: {
                "text-field": ["get", "sub_zona"],
                "text-font": ["DIN Offc Pro Medium", "Arial Unicode MS Bold"],
                "text-size": 12,
                visibility: "none",
            },
        });
    } else if (layer == "pipa") {
        map.addLayer({
            id: "pipa_multilinestring",
            type: "line",
            source: "pipa",
            paint: {
                "line-color": "#fff",
                "line-width": 3,
            },
            layout: {
                visibility: "none",
            },
        });
    } else if (layer == "tol") {
        map.addLayer({
            id: "tol_multilinestring",
            type: "line",
            source: "tol",
            paint: {
                "line-color": "orange",
                "line-width": 3,
            },
            layout: {
                visibility: "none",
            },
        });
    } else if (layer == "sungai") {
        map.addLayer({
            id: "sungai_multilinestring",
            type: "line",
            source: "sungai",
            paint: {
                "line-color": "blue",
                "line-width": 3,
            },
            layout: {
                visibility: "none",
            },
        });
    } else if (layer == "banjir") {
        map.addLayer({
            id: "banjir_fill",
            type: "fill",
            source: "banjir",
            paint: {
                "fill-color": "#2980b9",
                "fill-opacity": 0.9,
            },
            layout: {
                visibility: "none",
            },
        });
    } else if (layer == "sewa") {
        map.addLayer({
            id: "sewa_fill",
            type: "symbol",
            source: "sewa",
            layout: {
                "icon-image": "office",
                "icon-size": 1,
                visibility: "none",
                "icon-allow-overlap": true,
                "icon-ignore-placement": true,
                "icon-optional": true,
                "icon-rotation-alignment": "map",
                "icon-rotate": 0,
                "icon-padding": 0,
                "icon-keep-upright": false,
                "icon-offset": [0, 0],
                "icon-anchor": "center",
                "icon-pitch-alignment": "map",
            },
        });
    } else if (layer == "iumk") {
        map.addLayer({
            id: "iumk_fill",
            type: "symbol",
            source: "iumk",
            layout: {
                "icon-image": ["get", "kegiatan_usaha"],
                "icon-size": 1,
                visibility: "none",
                "icon-allow-overlap": true,
                "icon-ignore-placement": true,
                "icon-optional": true,
                "icon-rotation-alignment": "map",
                "icon-rotate": 0,
                "icon-padding": 0,
                "icon-keep-upright": false,
                "icon-offset": [0, 0],
                "icon-anchor": "center",
                "icon-pitch-alignment": "map",
            },
        });
    } else if (layer == "investasi") {
        map.addLayer({
            id: "investasi_dot",
            type: "symbol",
            source: "investasi",
            // paint: {
            //   "circle-radius": 6,
            //   "circle-color": "#B42222",
            //   "circle-stroke-color": "#ffffff",
            //   "circle-stroke-width": 2,
            // },
            filter: ["==", "$type", "Point"],
            layout: {
                "icon-image": "point",
                "icon-size": 1,
                visibility: "none",
                "icon-allow-overlap": true,
                "icon-ignore-placement": true,
                "icon-optional": true,
                "icon-rotation-alignment": "map",
                "icon-rotate": 0,
                "icon-padding": 0,
                "icon-keep-upright": false,
                "icon-offset": [0, 0],
                "icon-anchor": "center",
                "icon-pitch-alignment": "map",
            },
        });
    } else if (layer == "budaya") {
        map.addLayer({
            id: "budaya_dot",
            type: "symbol",
            source: "budaya",
            layout: {
                "icon-image": "historic",
                "icon-size": 1,
                visibility: "none",
                "icon-allow-overlap": true,
                "icon-ignore-placement": true,
                "icon-optional": true,
                "icon-rotation-alignment": "map",
                "icon-rotate": 0,
                "icon-padding": 0,
                "icon-keep-upright": false,
                "icon-offset": [0, 0],
                "icon-anchor": "center",
                "icon-pitch-alignment": "map",
            },
        });
    } else if (layer == "urban") {
        let [tpz_year, tpz_color] = $("input[name='transect_zone']")
            .val()
            .split("-");
        map.addLayer({
            id: "urban_fill",
            type: "fill",
            source: "urban",
            paint: {
                "fill-color": ["get", tpz_color],
                "fill-opacity": 0.5,
            },
            layout: {
                visibility: "none",
            },
        });
    } else if (layer == "analisa_gis") {
        let [label, color] = $("input[name='analisa_gis']").val().split("-");
        map.addLayer({
            id: "analisa_gis_fill",
            type: "fill",
            source: "analisa_gis",
            filter: ["!=", label, ""],
            paint: {
                "fill-color": ["get", color],
                "fill-opacity": 0.5,
            },
            layout: {
                visibility: "none",
            },
        });
    } else if (layer == "transportasi") {
        map.addLayer({
            id: "transportasi_multilinestring",
            type: "line",
            source: "transportasi",
            paint: {
                "line-color": ["get", "color"],
                "line-width": 3,
            },
            layout: {
                visibility: "none",
            },
        });
    } else if (layer == "badan_jalan") {
        map.addLayer({
            id: "badan_jalan_fill",
            type: "fill",
            source: "badan_jalan",
            paint: {
                "fill-color": "#e67e22",
                "fill-opacity": 0.9,
            },
            layout: {
                visibility: "none",
            },
        });
    } else if (layer == "rw") {
        map.addLayer({
            id: "rw_fill",
            type: "fill",
            source: "rw",
            paint: {
                "fill-color": "#3498db",
                "fill-opacity": 0.6,
                "fill-outline-color": "white",
            },
            layout: {
                visibility: "none",
            },
        });
    } else if (layer == "survey") {
        map.addLayer({
            id: "survey_dot",
            type: "symbol",
            source: "survey",
            layout: {
                "icon-image": "wilayah",
                "icon-size": 1,
                visibility: "none",
                "icon-allow-overlap": true,
                "icon-ignore-placement": true,
                "icon-optional": true,
                "icon-rotation-alignment": "map",
                "icon-rotate": 0,
                "icon-padding": 0,
                "icon-keep-upright": false,
                "icon-offset": [0, 0],
                "icon-anchor": "center",
                "icon-pitch-alignment": "map",
            },
        });
    } else if (layer == "gsb_nol") {
        map.addLayer({
            id: "gsb_nol_multilinestring",
            type: "line",
            source: "gsb_nol",
            paint: {
                "line-color": "#e67e22",
                "line-width": 3,
            },
            layout: {
                visibility: "none",
            },
        });
    } else if (layer == "kontur") {
        map.addLayer({
            id: "kontur_fill",
            type: "fill",
            source: "kontur",
            paint: {
                "fill-color": ["get", "fill"],
                "fill-opacity": 0.9,
            },
            layout: {
                visibility: "none",
            },
        });
    } else if (layer == "nib") {
        map.addLayer({
            id: "nib_dot",
            type: "symbol",
            source: "nib",
            layout: {
                "icon-image": "certified",
                "icon-size": 1,
                visibility: "none",
                "icon-allow-overlap": true,
                "icon-ignore-placement": true,
                "icon-optional": true,
                "icon-rotation-alignment": "map",
                "icon-rotate": 0,
                "icon-padding": 0,
                "icon-keep-upright": false,
                "icon-offset": [0, 0],
                "icon-anchor": "center",
                "icon-pitch-alignment": "map",
            },
        });
    } else if (layer == "iprt") {
        map.addLayer({
            id: "iprt_dot",
            type: "circle",
            source: "iprt",
            paint: {
                "circle-color": "red",
                "circle-stroke-color": "#ffff00",
                "circle-stroke-width": 1,
                "circle-radius": 4,
                "circle-opacity": 0.8,
            },
            layout: {
                visibility: "none",
            },
        });
    } else if (layer == "garis_kepulauan") {
        map.addLayer({
            id: "garis_kepulauan_multilinestring",
            type: "line",
            source: "garis_kepulauan",
            paint: {
                "line-color": "blue",
                "line-width": 3,
            },
            layout: {
                visibility: "none",
            },
        });
    } else if (layer == "area_kepulauan") {
        map.addLayer({
            id: "area_kepulauan_fill",
            type: "fill",
            source: "area_kepulauan",
            paint: {
                "fill-color": "blue",
                "fill-opacity": 0.9,
            },
            layout: {
                visibility: "none",
            },
        });
    } else if (layer == "kawasan_khusus") {
        map.addLayer({
            id: "kawasan_khusus_fill",
            type: "fill",
            source: "kawasan_khusus",
            paint: {
                "fill-color": "blue",
                "fill-opacity": 0.9,
            },
            layout: {
                visibility: "none",
            },
        });
    } else if (layer == "batas_laut") {
        map.addLayer({
            id: "batas_laut_fill",
            type: "fill",
            source: "batas_laut",
            paint: {
                "fill-color": "blue",
                "fill-opacity": 0.9,
            },
            layout: {
                visibility: "none",
            },
        });
    } else if (layer == "sarana_prasarana") {
        map.addLayer({
            id: "sarana_prasarana_dot",
            type: "symbol",
            source: "sarana_prasarana",
            layout: {
                "icon-image": "laut",
                "icon-size": 1,
                visibility: "none",
                "icon-allow-overlap": true,
                "icon-ignore-placement": true,
                "icon-optional": true,
                "icon-rotation-alignment": "map",
                "icon-rotate": 0,
                "icon-padding": 0,
                "icon-keep-upright": false,
                "icon-offset": [0, 0],
                "icon-anchor": "center",
                "icon-pitch-alignment": "map",
            },
        });
    }
};

//OnOff Layer
const onOffLayer = (layer) => {
    const zonasiLayer = () => {
        $("#rdtr").change((e) => {
            if (e.target.checked) {
                $("#zoning_fill").prop("disabled", false);
                $("#zoning_old_fill").prop("disabled", false);

                //Zonasi New
                if ($("#zoning_fill").prop("checked") == true) {
                    showLayer("zoning_fill");
                    showLayer("zoning_label");
                    map.moveLayer("zoning_fill", "add-3d-buildings");
                }
                //Zonasi Old
                else if ($("#zoning_old_fill").prop("checked") == true) {
                    showLayer("zoning_old_fill");
                    showLayer("zoning_old_label");
                    map.moveLayer("zoning_old_fill", "add-3d-buildings");
                }
            } else {
                $("#zoning_fill").prop("disabled", true);
                $("#zoning_old_fill").prop("disabled", true);

                //Zonasi New
                if ($("#zoning_fill").prop("checked") == true) {
                    hideLayer("zoning_fill");
                    hideLayer("zoning_label");
                    map.moveLayer("zoning_fill", "add-3d-buildings");
                }
                //Zonasi Old
                else if ($("#zoning_old_fill").prop("checked") == true) {
                    hideLayer("zoning_old_fill");
                    hideLayer("zoning_old_label");
                    map.moveLayer("zoning_old_fill", "add-3d-buildings");
                }
            }
        });
    };

    //Trigger Click
    const clickMap = () => {
        let coordinate = marker.getLngLat();
        setTimeout(() => {
            map.fire("click", {
                lngLat: coordinate,
                point: map.project(coordinate),
            });
        }, 500);
    };

    //Wilayah
    if (layer == "wilayahindex") {
        if ($("#wilayahindex_fill").prop("checked") == true) {
            showLayer("wilayahindex_fill");
            $(".detail_jumlah").show();
        } else {
            hideLayer("wilayahindex_fill");
            $(".detail_jumlah").hide();
        }

        $("#wilayahindex_fill").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("wilayahindex_fill");
                $(".detail_omzet").show();
                $(".detail_jumlah").show();
                $("#btnInteractive").addClass("text-primary");
                map.easeTo({
                    zoom: 15,
                    center: {
                        lng: 106.80331075792759,
                        lat: -6.231019525132169,
                    },
                });
            } else {
                hideLayer("wilayahindex_fill");
                if (map.getLayer("wilayahppapp_fill")) {
                    map.removeLayer("wilayahppapp_fill");
                    map.removeSource("wilayahppapp");
                }
                $(".detail_omzet").hide();
                $(".detail_jumlah").hide();
                $("#btnInteractive").removeClass("text-primary");
                localStorage.setItem("filterChoro", 0);
            }
        });
    }

    //Peta Zonasi
    if (layer == "zoning") {
        //Show Layer Zonasi
        zonasiLayer();

        if ($("#rdtr").prop("checked") == true) {
            //Enable Button Zonasi
            $("#zoning_fill").prop("disabled", false);
            $("#zoning_old_fill").prop("disabled", false);

            if ($("#zoning_fill").prop("checked") == true) {
                showLayer("zoning_fill");
                showLayer("zoning_label");
                map.moveLayer("zoning_fill", "add-3d-buildings");
            } else {
                hideLayer("zoning_fill");
                hideLayer("zoning_label");
            }
        } else {
            //Disable Button Zonasi
            $("#zoning_fill").prop("disabled", true);
            $("#zoning_old_fill").prop("disabled", true);
        }

        $("#zoning_fill").change(() => {
            if ($("#rdtr").prop("checked") == true) {
                //Enable Button Zonasi
                $("#zoning_fill").prop("disabled", false);
                $("#zoning_old_fill").prop("disabled", false);
                if ($("#zoning_fill").prop("checked") == true) {
                    showLayer("zoning_fill");
                    showLayer("zoning_label");
                    hideLayer("zoning_old_fill");
                    hideLayer("zoning_old_label");
                    map.moveLayer("zoning_fill", "add-3d-buildings");
                    clickMap();
                } else {
                    hideLayer("zoning_fill");
                    hideLayer("zoning_label");
                }
            } else {
                //Disable Button Zonasi
                $("#zoning_fill").prop("disabled", true);
                $("#zoning_old_fill").prop("disabled", true);
            }
        });
    }

    //Peta Zonasi Lama
    if (layer == "zoning_old") {
        //Show Layer Zonasi
        zonasiLayer();

        if ($("#rdtr").prop("checked") == true) {
            //Enable Button Zonasi
            $("#zoning_fill").prop("disabled", false);
            $("#zoning_old_fill").prop("disabled", false);

            if ($("#zoning_old_fill").prop("checked") == true) {
                showLayer("zoning_old_fill");
                showLayer("zoning_old_label");
                hideLayer("zoning_fill");
                hideLayer("zoning_label");
                map.moveLayer("zoning_old_fill", "add-3d-buildings");
            } else {
                hideLayer("zoning_old_fill");
                hideLayer("zoning_old_label");
            }
        } else {
            //Disable Button Zonasi
            $("#zoning_fill").prop("disabled", true);
            $("#zoning_old_fill").prop("disabled", true);
        }

        $("#zoning_old_fill").change(() => {
            if ($("#rdtr").prop("checked") == true) {
                //Enable Button Zonasi
                $("#zoning_fill").prop("disabled", false);
                $("#zoning_old_fill").prop("disabled", false);

                if ($("#zoning_old_fill").prop("checked") == true) {
                    showLayer("zoning_old_fill");
                    showLayer("zoning_old_label");
                    hideLayer("zoning_fill");
                    hideLayer("zoning_label");
                    map.moveLayer("zoning_old_fill", "add-3d-buildings");
                    clickMap();
                } else {
                    hideLayer("zoning_old_fill");
                    hideLayer("zoning_old_label");
                }
            } else {
                //Disable Button Zonasi
                $("#zoning_fill").prop("disabled", true);
                $("#zoning_old_fill").prop("disabled", true);
            }
        });
    }

    //Layer Pipa
    if (layer == "pipa") {
        if ($("#pipa_multilinestring").prop("checked") == true) {
            showLayer("pipa_multilinestring");
        } else {
            hideLayer("pipa_multilinestring");
        }

        $("#pipa_multilinestring").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("pipa_multilinestring");
            } else {
                hideLayer("pipa_multilinestring");
            }
        });
    }

    //Layer tol
    if (layer == "tol") {
        if ($("#tol_multilinestring").prop("checked") == true) {
            showLayer("tol_multilinestring");
        } else {
            hideLayer("tol_multilinestring");
        }

        $("#tol_multilinestring").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("tol_multilinestring");
            } else {
                hideLayer("tol_multilinestring");
            }
        });
    }

    //Layer Sungai
    if (layer == "sungai") {
        if ($("#sungai_multilinestring").prop("checked") == true) {
            showLayer("sungai_multilinestring");
        } else {
            hideLayer("sungai_multilinestring");
        }

        $("#sungai_multilinestring").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("sungai_multilinestring");
            } else {
                hideLayer("sungai_multilinestring");
            }
        });
    }

    //Layer Banjir
    if (layer == "banjir") {
        if ($("#banjir_fill").prop("checked") == true) {
            showLayer("banjir_fill");
        } else {
            hideLayer("banjir_fill");
        }

        $("#banjir_fill").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("banjir_fill");
            } else {
                hideLayer("banjir_fill");
            }
        });
    }

    //Layer Sewa
    if (layer == "sewa") {
        //Get Data Sewa
        const getDataSewa = () => {
            $(".list-item").html("");
            setTimeout(() => {
                let list_sewa = map.getSource("sewa")._data.features;

                let content = "";

                if (list_sewa.length > 0) {
                    list_sewa.forEach(({ properties }) => {
                        const { Nama, Alamat, Sewa, Lat, Long, Foto } =
                            properties;

                        //Add Popup to Map
                        const pop = new mapboxgl.Popup({
                            closeButton: false,
                        })
                            .setLngLat([Long, Lat])
                            .setHTML(`Rp. ${separatorNum(Sewa)}`)
                            .addTo(map);

                        //Styling Popup
                        $(".mapboxgl-popup-content").css("background", "green");
                        $(".mapboxgl-popup-content").css("color", "white");
                        $(".mapboxgl-popup-tip").css(
                            "border-top-color",
                            "green"
                        );
                        $(".mapboxgl-popup-tip").css(
                            "border-bottom-color",
                            "green"
                        );

                        //List Data Sewa
                        content += `
                        <div class="item mb-3">
                        <div class="row">
                            <div class="col-4">
                                <img class="lazy" width="100px" height="90px" style="object-fit: cover; border-radius:15px"
                                    data-src="https://jakarta.pintoinvest.com/rent/${Foto}">
                            </div>
                            <div class="col-8">
                                <p style="font-size: 11pt;margin-bottom:-1px" class="font-weight-bold" class="inf-nama-kantor">${Nama}</p>
                                <lable style="font-size: 13px; line-height:1; margin-bottom: -13px;" class="inf-alamat-sewa"><span>${Alamat}</span></lable>
                                <p style="font-size: 13px; line-height:0; margin-top:10px !important;" class="inf-harga-sewa"> <span>Rp. ${separatorNum(
                                    Sewa
                                )}</span></p>
                            </div>
                        </div>
                    </div>
                        `;
                    });
                } else {
                    content = `<p style="font-size: 13px;">Tidak Ada Data</p>`;
                }

                $(".list-item").html(content);
                lazyLoadImages();
            }, 500);
        };

        //Check if layer is on or off
        if ($("#sewa_fill").prop("checked") == true) {
            showLayer("sewa_fill");
            getDataSewa();
        } else {
            hideLayer("sewa_fill");
            $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
        }

        //Harga Sewa Kantor
        $("#sewa_fill").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("sewa_fill");
                getDataSewa();
            } else {
                hideLayer("sewa_fill");
                $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
            }
        });
    }

    //Layer IUMK
    if (layer == "iumk") {
        //Get Data IUMK
        const getDataIUMK = () => {
            $(".list-item-usaha").html("");
            setTimeout(() => {
                let list_iumk = map.getSource("iumk")._data.features;

                let content = "";

                if (list_iumk.length > 0) {
                    list_iumk.forEach(({ properties }, index) => {
                        let coord = [properties.Lat, properties.Long];
                        content += `
                        <div class="item mb-3" style="cursor: pointer;" onclick="flyToLocation(${
                            properties.Lat
                        },${properties.Long},'${titleCase(
                            properties.Kelurahan
                        )}')">
                        <div class="row">
                            <div class="col-4">
                                <img id="imgUsaha-${index}" class="lazy" width="100px" height="90px" style="object-fit: cover; border-radius:15px" src="/assets/gambar/load.svg" data-src="">
                            </div>
                            <div class="col-8">
                                <span style="font-size: 11pt" class="font-weight-bold" class="inf-nama-kantor">${
                                    properties["Nama Usaha"]
                                }</span>
                                <label class="w-100" style="font-size: 13px; margin-bottom:-5px"<span>${
                                    properties["Jenis Usaha"]
                                }</span></label>
                                <label class="w-100" style="font-size: 13px; margin-bottom:-5px"><span>${
                                    properties["Alamat"]
                                }</span></label>
                            </div>
                        </div>
                    </div>
                        `;

                        //Add Image to Info
                        getIumkForInfo(coord, `#imgUsaha-${index}`);
                    });
                } else {
                    content = `<p style="font-size: 13px;">Tidak Ada Data</p>`;
                }

                $(".list-item-usaha").html(content);
            }, 500);
        };

        //Check if layer is on or off
        if ($("#iumk_fill").prop("checked") == true) {
            $(".info-layer-usaha").show();
            showLayer("iumk_fill");

            //Stop Load Data IUMK
            // window.stop();

            //Load Data IUMK
            getDataIUMK();

            //Remove Popup Harga
            $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
        } else {
            hideLayer("iumk_fill");
        }

        //Sebaran Usaha mikro kecil
        $("#iumk_fill").change(function () {
            if ($(this).prop("checked") == true) {
                $(".info-layer-usaha").show();
                showLayer("iumk_fill");
                //Stop Load Data IUMK
                // window.stop();

                //Load Data IUMK
                getDataIUMK();
                $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
            } else {
                hideLayer("iumk_fill");
            }
        });
    }

    //Layer Investasi
    if (layer == "investasi") {
        //Get Data Investasi
        const getDataInvestasi = () => {
            $(".list-item-investasi").html("");
            setTimeout(() => {
                let list_investasi = map.getSource("investasi")._data.features;

                let content = "";

                if (list_investasi.length > 0) {
                    list_investasi.forEach(({ properties, geometry }) => {
                        content += `
                        <li class="item mb-3" style="margin-left:-20px">
                            <a href="#" style="font-size: 11pt; cursor:pointer" onclick="flyToLocation(${
                                geometry["coordinates"][1]
                            },${geometry["coordinates"][0]}, '${
                            properties["Kelurahan"]
                        }')" class="font-weight-bold">${properties["Nama"]}</a>
                            <ul style="list-style:none">
                                <li style="font-size:13px;margin-left:-2.4rem">${
                                    properties["Pemilik"] == ""
                                        ? ""
                                        : properties["Pemilik"]
                                }</li>
                                <li style="font-size:13px;margin-left:-2.4rem"><b>Luas Lahan</b> : ${
                                    properties["Luas_Lahan"] == ""
                                        ? ""
                                        : `${separatorNum(
                                              properties["Luas_Lahan"]
                                          )} m<sup>2</sup>`
                                }</li>
                                <li style="font-size:13px;margin-left:-2.4rem"><b>Jenis Sertifikat</b> : ${
                                    properties["Jenis_Sertifikat"] == ""
                                        ? ""
                                        : `${properties["Jenis_Sertifikat"]}`
                                }</li>
                                <li style="font-size:13px;margin-left:-2.4rem"><b>Total Investasi</b> : ${
                                    properties["Total_Investasi"] == ""
                                        ? ""
                                        : `Rp. ${separatorNum(
                                              properties["Total_Investasi"]
                                          )}`
                                }</li>
                            </ul>
                        </li>
                    `;
                    });
                } else {
                    content = `<p style="font-size: 13px;">Tidak Ada Data</p>`;
                }

                $(".list-item-investasi").html(content);
            }, 500);
        };

        //Check if layer is on or off
        if ($("#investasi_dot").prop("checked") == true) {
            showLayer("investasi_dot");

            //Load Data Investasi
            getDataInvestasi();

            $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
        } else {
            hideLayer("investasi_dot");
        }

        //proyek_potensial

        $("#investasi_dot").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("investasi_dot");

                //Load Data Investasi
                getDataInvestasi();

                $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
            } else {
                hideLayer("investasi_dot");
            }
        });
    }

    //Layer Budaya
    if (layer == "budaya") {
        //Get Data Budaya
        const getDataBudaya = () => {
            $(".list-item-budaya").html("");
            setTimeout(() => {
                let list_budaya = map.getSource("budaya")._data.features;

                let content = "";

                if (list_budaya.length > 0) {
                    list_budaya.forEach(({ properties }) => {
                        const { Name, Status, Gol } = properties;

                        content += `
                        <div class="mb-2">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="https://www.salonlfc.com/wp-content/uploads/2018/01/image-not-found-1-scaled-1150x647.png" alt="" style="width:100%;height:100px;object-fit: cover; border-radius:15px">
                                </div>
                                <div class="col-md-8">
                                    <div class="item mb-3" style="margin-left:-20px">
                                        <span style="font-size: 11pt" class="font-weight-bold">${Name}</span>
                                        <label style="font-size: 13px;line-height:0">Status : ${Status}</label>
                                        <label style="font-size: 13px;">Golongan : ${Gol}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        `;
                    });
                } else {
                    content = `<p style="font-size: 13px;">Tidak Ada Data</p>`;
                }

                $(".list-item-budaya").html(content);
            }, 500);
        };

        //Check if layer is on or off
        if ($("#budaya_dot").prop("checked") == true) {
            showLayer("budaya_dot");
            getDataBudaya();

            $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
        } else {
            hideLayer("budaya_dot");
        }

        //Cagar Budaya
        $("#budaya_dot").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("budaya_dot");
                getDataBudaya();

                $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
            } else {
                hideLayer("budaya_dot");
            }
        });
    }

    //Layer Urban Index
    if (layer == "urban") {
        //Urban Index
        let [tpz_year, tpz_color] = $("input[name='transect_zone']:checked")
            .val()
            .split("-");
        //Check if layer is on or off
        if ($("#urban_fill").prop("checked") == true) {
            $("input[name='transect_zone']").prop("disabled", false);
            if ($("input[name='transect_zone']").val() !== "") {
                map.setPaintProperty("urban_fill", "fill-color", [
                    "get",
                    tpz_color,
                ]);
                $(".legend-urban").show();
                showLayer("urban_fill");

                $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
            } else {
                $(".legend-urban").hide();
                hideLayer("urban_fill");
            }
        } else {
            $(".legend-urban").hide();
            hideLayer("urban_fill");
            $("input[name='transect_zone']").prop("disabled", true);
        }

        //Urban Index
        $("#urban_fill").change((e) => {
            if ($("#urban_fill").prop("checked") == true) {
                $("input[name='transect_zone']").prop("disabled", false);
                // $("input[name='transect_zone']").change((e) => {
                if ($(e.target).prop("checked") == true) {
                    map.setPaintProperty("urban_fill", "fill-color", [
                        "get",
                        tpz_color,
                    ]);
                    $(".legend-urban").show();
                    showLayer("urban_fill");
                    $(
                        "div.mapboxgl-popup.mapboxgl-popup-anchor-bottom"
                    ).remove();
                } else {
                    $(".legend-urban").hide();
                    hideLayer("urban_fill");
                }
                // });
            } else {
                $(".legend-urban").hide();
                hideLayer("urban_fill");
                $("input[name='transect_zone']").prop("disabled", true);
            }
        });

        $("input[name='transect_zone']").change((e) => {
            let [tpz_year, tpz_color] = $(e.target).val().split("-");
            map.setPaintProperty("urban_fill", "fill-color", [
                "get",
                tpz_color,
            ]);
        });
    }

    //Layer Analaisa GIS Index
    if (layer == "analisa_gis") {
        //Urban Index
        let [label, color] = $("input[name='analisa_gis']:checked")
            .val()
            .split("-");
        //Check if layer is on or off
        if ($("#analisa_gis_fill").prop("checked") == true) {
            $("input[name='analisa_gis']").prop("disabled", false);
            if ($("input[name='analisa_gis']").val() !== "") {
                map.setFilter("analisa_gis_fill", ["!=", label, ""]);
                map.setPaintProperty("analisa_gis_fill", "fill-color", [
                    "get",
                    color,
                ]);

                if (label == "knvperda1") {
                    $(".legend-analisa-gis-perda").show();
                } else {
                    $(".legend-analisa-gis").show();
                }
                showLayer("analisa_gis_fill");

                $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
            } else {
                if (label == "knvperda1") {
                    $(".legend-analisa-gis-perda").hide();
                } else {
                    $(".legend-analisa-gis").hide();
                }
                hideLayer("analisa_gis_fill");
            }
        } else {
            if (label == "knvperda1") {
                $(".legend-analisa-gis-perda").hide();
            } else {
                $(".legend-analisa-gis").hide();
            }

            hideLayer("analisa_gis_fill");
            $("input[name='analisa_gis']").prop("disabled", true);
        }

        //Analaisa GIS Index
        $("#analisa_gis_fill").change((e) => {
            if ($("#analisa_gis_fill").prop("checked") == true) {
                $("input[name='analisa_gis']").prop("disabled", false);
                // $("input[name='analisa_gis']").change((e) => {
                if ($(e.target).prop("checked") == true) {
                    map.setFilter("analisa_gis_fill", ["!=", label, ""]);
                    map.setPaintProperty("analisa_gis_fill", "fill-color", [
                        "get",
                        color,
                    ]);

                    if (label == "knvperda1") {
                        $(".legend-analisa-gis-perda").show();
                    } else {
                        $(".legend-analisa-gis").show();
                    }

                    showLayer("analisa_gis_fill");
                    $(
                        "div.mapboxgl-popup.mapboxgl-popup-anchor-bottom"
                    ).remove();
                } else {
                    if (label == "knvperda1") {
                        $(".legend-analisa-gis-perda").hide();
                    } else {
                        $(".legend-analisa-gis").hide();
                    }
                    hideLayer("analisa_gis_fill");
                }
                // });
            } else {
                if (label == "knvperda1") {
                    $(".legend-analisa-gis-perda").hide();
                } else {
                    $(".legend-analisa-gis").hide();
                }
                hideLayer("analisa_gis_fill");
                $("input[name='analisa_gis']").prop("disabled", true);
            }
        });

        $("input[name='analisa_gis']").change((e) => {
            let [label, color] = $(e.target).val().split("-");

            if (label == "knvperda1") {
                $(".legend-analisa-gis").hide();
                $(".legend-analisa-gis-perda").show();
            } else {
                $(".legend-analisa-gis-perda").hide();
                $(".legend-analisa-gis").show();
            }

            map.setFilter("analisa_gis_fill", ["!=", label, ""]);
            map.setPaintProperty("analisa_gis_fill", "fill-color", [
                "get",
                color,
            ]);
        });
    }

    //Layer Transportasi
    if (layer == "transportasi") {
        if ($("#transportasi_multilinestring").prop("checked") == true) {
            showLayer("transportasi_multilinestring");
        } else {
            hideLayer("transportasi_multilinestring");
        }

        $("#transportasi_multilinestring").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("transportasi_multilinestring");
            } else {
                hideLayer("transportasi_multilinestring");
            }
        });
    }

    //Layer Badan Jalan
    //Layer tol
    if (layer == "badan_jalan") {
        if ($("#badan_jalan_fill").prop("checked") == true) {
            showLayer("badan_jalan_fill");
        } else {
            hideLayer("badan_jalan_fill");
        }

        $("#badan_jalan_fill").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("badan_jalan_fill");
            } else {
                hideLayer("badan_jalan_fill");
            }
        });
    }

    //Layer Batas RW
    //Layer Pipa
    if (layer == "rw") {
        if ($("#rw_fill").prop("checked") == true) {
            showLayer("rw_fill");
        } else {
            hideLayer("rw_fill");
        }

        $("#rw_fill").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("rw_fill");
            } else {
                hideLayer("rw_fill");
            }
        });
    }

    //Layer Survey

    if (layer == "survey") {
        if ($("#survey_dot").prop("checked") == true) {
            $(".info-layer-survey-perkembangan").show();
            showLayer("survey_dot");
            $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
        } else {
            hideLayer("survey_dot");
        }

        $("#survey_dot").change(function () {
            if ($(this).prop("checked") == true) {
                $(".info-layer-survey-perkembangan").show();
                showLayer("survey_dot");
                $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
            } else {
                hideLayer("survey_dot");
            }
        });
    }

    // Layer GSB Nol
    if (layer == "gsb_nol") {
        const get_availability_gsb = () => {
            setTimeout(() => {
                let gsb_nol = map.getSource("gsb_nol")._data.features;

                if (gsb_nol !== null) {
                    $(".inf-gsb-availibility").html("Ada");
                } else {
                    $(".inf-gsb-availibility").html("Tidak Ada");
                }
            }, 500);
        };

        if ($("#gsb_nol_multilinestring").prop("checked") == true) {
            showLayer("gsb_nol_multilinestring");
            get_availability_gsb();
            $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
        } else {
            hideLayer("gsb_nol_multilinestring");
        }

        $("#gsb_nol_multilinestring").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("gsb_nol_multilinestring");
                get_availability_gsb();
                $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
            } else {
                hideLayer("gsb_nol_multilinestring");
            }
        });
    }

    // Layer Kontur Tanah
    if (layer == "kontur") {
        if ($("#kontur_fill").prop("checked") == true) {
            showLayer("kontur_fill");
            $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
        } else {
            hideLayer("kontur_fill");
        }

        $("#kontur_fill").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("kontur_fill");
                $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
            } else {
                hideLayer("kontur_fill");
            }
        });
    }

    //Layer NIB
    if (layer == "nib") {
        // Assign Filter NIB
        const assignFilterNIB = (elem, data, default_option) => {
            let html = "";

            html += `<option value="">${default_option}</option>`;

            data.forEach((item) => {
                html += `<option value="${item}">${item}</option>`;
            });

            $(`#${elem}`).html(html);
        };

        // list of Investasi
        const listInvestasi = {
            "<= 1 milyar": [0, 1000000000],
            "1 milyar s/d 5 milyar": [1000000000, 5000000000],
            "5 milyar s/d 10 milyar": [5000000000, 10000000000],
            "> 10 milyar": [10000000000, null],
        };

        // Filter Data NIB
        const filterDataNIB = () => {
            let list_nib = nib_data.features;
            let param = {
                "properties.jenis_perusahaan": $(
                    "#field_filter_jenis_perusahaan_value"
                ).val(),
                "properties.uraian_skala_usaha": $(
                    "#field_filter_skala_value"
                ).val(),
                "properties.uraian_resiko_proyek": $(
                    "#field_filter_resiko_value"
                ).val(),
                "properties.status_usaha": $(
                    "#field_filter_status_value"
                ).val(),
                "properties.kbli": `${
                    $("#field_filter_kbli_value").val() == ""
                        ? ""
                        : $("#field_filter_kbli_value").val() + "*"
                }`,
                "properties.bintang": $("#field_filter_bintang_value").val(),
                "properties.jumlah_investasi_lain": listInvestasi[
                    $("#field_filter_investasi_value").val()
                ] || [null, null],
            };

            console.log(list_nib, param);

            return filterObjectsByNestedParams(list_nib, param);
        };

        // Render Data
        const renderDataNIB = (data) => {
            $(".list-item-nib").html("");
            let html = "";

            if (data.length > 0) {
                data.forEach(({ properties, geometry }) => {
                    const {
                        jenis_perusahaan,
                        nib,
                        uraian_skala_usaha,
                        uraian_resiko_proyek,
                        kbli,
                        uraian_kbli,
                        jumlah_investasi_lain,
                        status_usaha,
                        bintang,
                    } = properties;
                    const { coordinates } = geometry;
                    const [longitude, latitude] = coordinates;

                    html += `
                    <li class="mb-2" style="margin-left:-1.5rem;line-height:1; cursor:pointer;" onclick="flyToLocation(${latitude},${longitude},'${kelurahan_tmp_global}')">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="item mb-2">
                                    <label style="font-size: 10pt" class="font-weight-bold w-100">${nib}</label>
                                    <label style="font-size: 13px;" class="w-100">Jenis Perusahaan : ${jenis_perusahaan}</label>
                                    <label style="font-size: 13px;" class="w-100">Skala : ${uraian_skala_usaha}</label>
                                    <label style="font-size: 13px;" class="w-100">Resiko Proyek : ${uraian_resiko_proyek}</label>
                                    <label style="font-size: 13px;" class="w-100">KBLI : ${kbli}</label>
                                    <label style="font-size: 13px;" class="w-100">Bintang : ${bintang}</label>
                                    <label style="font-size: 13px;" class="w-100">${uraian_kbli}</label>
                                    <label style="font-size: 13px;" class="w-100">Jumlah Investasi : Rp ${separatorNum(
                                        jumlah_investasi_lain
                                    )}</label>
                                </div>
                            </div>
                        </div>
                    </li>

                    `;
                });
            } else {
                html += `<p style="font-size: 13px;">Tidak Ada Data</p>`;
            }

            $(".inf-nib-total").html(data.length);
            $(".list-item-nib").html(html);

            let geojson = {
                type: "FeatureCollection",
                features: data,
            };

            map.getSource("nib").setData(geojson);
        };

        //Get Data NIB
        const getDataNIB = () => {
            setTimeout(() => {
                let list_nib = nib_data.features;

                if (list_nib.length > 0) {
                    assignFilterNIB(
                        "field_filter_jenis_perusahaan_value",
                        distinctValuesByNestedKey(
                            list_nib,
                            "properties.jenis_perusahaan"
                        ),
                        "Pilih Jenis Perusahaan"
                    );

                    assignFilterNIB(
                        "field_filter_skala_value",
                        distinctValuesByNestedKey(
                            list_nib,
                            "properties.uraian_skala_usaha"
                        ),
                        "Pilih Skala Usaha"
                    );

                    assignFilterNIB(
                        "field_filter_resiko_value",
                        distinctValuesByNestedKey(
                            list_nib,
                            "properties.uraian_resiko_proyek"
                        ),
                        "Pilih Resiko Proyek"
                    );

                    assignFilterNIB(
                        "field_filter_status_value",
                        distinctValuesByNestedKey(
                            list_nib,
                            "properties.status_usaha"
                        ),
                        "Pilih Status Usaha"
                    );
                }

                renderDataNIB(list_nib);
            }, 500);
        };

        $(
            "#field_filter_jenis_perusahaan_value, #field_filter_skala_value, #field_filter_resiko_value, #field_filter_status_value, #field_filter_bintang_value, #field_filter_investasi_value"
        ).on("change", () => {
            let data = nib_data.features;
            let filtered_data = filterDataNIB(data);

            renderDataNIB(filtered_data);
        });

        $("#field_filter_kbli_value").on("keyup", () => {
            let data = nib_data.features;
            let filtered_data = filterDataNIB(data);

            renderDataNIB(filtered_data);
        });

        //Check if layer is on or off
        if ($("#nib_dot").prop("checked") == true) {
            showLayer("nib_dot");
            getDataNIB();

            $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
        } else {
            hideLayer("nib_dot");
        }

        //Cagar Budaya
        $("#nib_dot").change(function () {
            console.log("nib");
            if ($(this).prop("checked") == true) {
                showLayer("nib_dot");
                getDataNIB();

                $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
            } else {
                hideLayer("nib_dot");
            }
        });
    }

    //Layer IPRT
    if (layer == "iprt") {
        //Get Data IPRT
        const getDataIPRT = () => {
            $(".list-item-iprt").html("");

            setTimeout(() => {
                let list_iprt = map.getSource("iprt")._data.features;

                let content = "";

                if (list_iprt.length > 0) {
                    list_iprt.forEach(({ properties, geometry }) => {
                        const { nama_perusahaan, nib, kbli, luas_lahan } =
                            properties;
                        const { coordinates } = geometry;
                        const [longitude, latitude] = coordinates;

                        content += `
                        <li class="mb-2" style="margin-left:-1.5rem;line-height:1; cursor:pointer;" onclick="flyToLocation(${latitude},${longitude},'${kelurahan_tmp_global}')">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="item mb-2">
                                        <label style="font-size: 10pt" class="font-weight-bold w-100">Nama : ${nama_perusahaan}</label>
                                        <label style="font-size: 13px;" class="w-100">NIB : ${nib}</label>
                                        <label style="font-size: 13px;" class="w-100">KBLI : ${kbli}</label>
                                        <label style="font-size: 13px;" class="w-100">Luas Lahan : ${separatorNum(
                                            luas_lahan
                                        )} m<sup>2</sup></label>
                                    </div>
                                </div>
                            </div>
                        </li>
                        `;
                    });

                    $(".list-item-iprt").html(content);
                }
            }, 500);
        };

        //Check if layer is on or off
        if ($("#iprt_dot").prop("checked") == true) {
            showLayer("iprt_dot");
            getDataIPRT();

            $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
        } else {
            hideLayer("iprt_dot");

            $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();

            $(".list-item-iprt").html("");
        }

        //IPRT
        $("#iprt_dot").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("iprt_dot");
                getDataIPRT();

                $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
            } else {
                hideLayer("iprt_dot");

                $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();

                $(".list-item-iprt").html("");
            }
        });
    }

    //Layer Garis Kepulauan
    if (layer == "garis_kepulauan") {
        //Check if layer is on or off
        if ($("#garis_kepulauan_multilinestring").prop("checked") == true) {
            showLayer("garis_kepulauan_multilinestring");

            $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
        } else {
            hideLayer("garis_kepulauan_multilinestring");
        }

        //Garis Kepulauan
        $("#garis_kepulauan_multilinestring").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("garis_kepulauan_multilinestring");
            } else {
                hideLayer("garis_kepulauan_multilinestring");
            }
        });
    }

    //Layer Area Kepulauan
    if (layer == "area_kepulauan") {
        //Check if layer is on or off
        if ($("#area_kepulauan_fill").prop("checked") == true) {
            showLayer("area_kepulauan_fill");
            map.moveLayer("area_kepulauan_fill", "zoning_fill");
        } else {
            hideLayer("area_kepulauan_fill");
        }

        //Area Kepulauan
        $("#area_kepulauan_fill").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("area_kepulauan_fill");
                map.moveLayer("area_kepulauan_fill", "zoning_fill");
            } else {
                hideLayer("area_kepulauan_fill");
            }
        });
    }

    //Layer Kawasan Khusus
    if (layer == "kawasan_khusus") {
        //Check if layer is on or off
        if ($("#kawasan_khusus_fill").prop("checked") == true) {
            showLayer("kawasan_khusus_fill");
        } else {
            hideLayer("kawasan_khusus_fill");
        }

        //Kawasan Khusus
        $("#kawasan_khusus_fill").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("kawasan_khusus_fill");
            } else {
                hideLayer("kawasan_khusus_fill");
            }
        });
    }

    //Layer Batas Laut
    if (layer == "batas_laut") {
        //Check if layer is on or off
        if ($("#batas_laut_fill").prop("checked") == true) {
            showLayer("batas_laut_fill");
        } else {
            hideLayer("batas_laut_fill");
        }

        //Batas Laut
        $("#batas_laut_fill").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("batas_laut_fill");
            } else {
                hideLayer("batas_laut_fill");
            }
        });
    }

    //Layer Sarana Prasarana
    if (layer == "sarana_prasarana") {
        //Check if layer is on or off
        if ($("#sarana_prasarana_dot").prop("checked") == true) {
            showLayer("sarana_prasarana_dot");
        } else {
            hideLayer("sarana_prasarana_dot");
        }

        //Sarana Prasarana
        $("#sarana_prasarana_dot").change(function () {
            if ($(this).prop("checked") == true) {
                showLayer("sarana_prasarana_dot");
            } else {
                hideLayer("sarana_prasarana_dot");
            }
        });
    }
};

// Interaction Layer IPRT
map.on("mouseenter", "iprt_dot", (e) => {
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.lngLat;
    const dt = e.features[0].properties;
    const content = `<div class="card">

    <div class="card-body p-2">
    <div style="line-height: 1.2;">
        <h6 style="width:95%">${dt["nama_perusahaan"]}</h6>
        <span class="d-block">NIB : ${dt["nib"]}</span>
        <span class="d-block">KBLI : ${dt["kbli"]}</span>
        <span class="d-block">Luas Lahan : ${separatorNum(
            dt["luas_lahan"]
        )} m<sup>2</sup></span>
        <span class="d-block"><a href="pdf_file/CONTOH_SK_IRK Pengawasan.pdf" target="_blank">Buka File</a></span>
      </div>
    </div>`;

    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }

    popupIprt.setLngLat(coordinates).setHTML(content).addTo(map);
});

map.on("mouseleave", "iprt_dot", () => {
    map.getCanvas().style.cursor = "";
    // popup.remove();
});

// Interaction Layer Urban
map.on("mousemove", "urban_fill", (e) => {
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.lngLat;
    const dt = e.features[0].properties;
    let content;
    if ($("input[name='transect_zone']:checked").val() == "tp2010-color2010") {
        content = `<div class="card">

        <div class="card-body p-2">
            <div style="line-height: 1.2;">
                <span>${dt.tp2010}</span>
            </div>
        </div>`;
    } else if (
        $("input[name='transect_zone']:checked").val() == "tp2021-color2021"
    ) {
        content = `<div class="card">

        <div class="card-body w-[35vw] grid grid-cols-[270px,1fr] text-xs" style="padding: 0.7rem 0.7rem 0.2rem 0.7rem!important;">


                <div class="grid grid-cols-2 mr-2">

                                        <div class="flex flex-col ">

                                            <div class="flex flex-col mb-1 mr-2.5">
                                                <div class="font-semibold">Luas (m<sup>2</sup>)</div>
                                                <div>3.000</div>
                                            </div>




                                            <div class="flex flex-col mb-1 mr-2.5">
                                                <div class="font-semibold">pH</div>
                                                <div>6.3</div>
                                            </div>
                                            <div class="flex flex-col mb-1 mr-2.5">
                                                <div class="font-semibold">Pemilik lahan

                                                </div>
                                                <div>
                                                    Dedi


                                                </div>
                                            </div>
                                            <div class="flex flex-col mb-1 mr-2.5">
                                                <div class="font-semibold">Penyewa

                                                </div>
                                                <div>Koko

                                                </div>
                                            </div>
                                            <div class="flex flex-col mb-1 mr-2.5">
                                                <div class="font-semibold">Jumlah Penggarap

                                                </div>
                                                <div>5</div>
                                            </div>


                                            <div class="flex flex-col mb-1 mr-2.5">
                                                <div class="font-semibold">Sumber Pembiayaan
                                                </div>
                                                <div>Modal Sendiri

                                                </div>
                                            </div>






                                        </div>

                                        <div class="flex flex-col ">

                                            <div class="flex flex-col mb-1 mr-2.5">
                                                <div class="font-semibold">Komoditi Tanam</div>
                                                <div>Beras Setra</div>
                                            </div>


                                            <div class="flex flex-col mb-1 mr-2.5">
                                                <div class="font-semibold">Periode Tanam</div>
                                                <div>1 Maret - 30 Juni 2024</div>
                                            </div>

                                            <div class="flex flex-col mb-1 mr-2.5">
                                                <div class="font-semibold">Tahap Tanam</div>
                                                <div class="inline-flex items-center">
                                                    <img src=/assets/check.png alt="" class="w-2.5 h-2.5 object-contain mr-1">
                                                    Pembajakan</div>
                                                <div class="inline-flex items-center">
                                                    <img src=/assets/check.png alt="" class="w-2.5 h-2.5 object-contain mr-1">
                                                    Pembenihan</div>
                                                <div class="inline-flex items-center">
                                                    <img src=/assets/check.png alt="" class="w-2.5 h-2.5 object-contain mr-1">
                                                    Pembajakan 1</div>
                                                <div class="ml-[0.9rem]">Pemupukan 2</div>
                                                <div class="ml-[0.9rem]">Pemupukan 3</div>

                                            </div>

                                            <div class="flex flex-col mb-1 mr-2.5">
                                                <div class="font-semibold">Perkiraan Panen</div>
                                                <div>7.000 kg</div>
                                            </div>

                                            <div class="flex flex-col mb-1 mr-2.5">
                                                <div class="font-semibold">Valuasi</div>
                                                <div>Rp 400.000.000

                                                </div>
                                            </div>


                                        </div>

                                    </div>



                                        <div class="w-full flex flex-col">
                                            <div class="w-full flex justify-center mb-2">
                                                <img src=/assets/tanam_padi.png alt="" class="w-full h-full object-contain">
                                            </div>

                                            <div class="w-full h-full flex flex-col">
                                                    <div class="font-semibold">Catatan</div>
                                                    <div>
                                                    memerlukan sekitar 4-5 bulan untuk mencapai panen setelah ditanam. Prosesnya dimulai dengan persiapan lahan</div>
                                            </div>
                                        </div>

                                    </div>



        `;
    } else if (
        $("input[name='transect_zone']:checked").val() == "tp2032-color2032"
    ) {
        content = `<div class="card">

        <div class="card-body p-2">
            <div style="line-height: 1.2;">
                <span class="d-block font-weight-bold">Prediksi Urban Index 2032</span>
                <span class="d-block">${dt.desc2032}</span><br>
                <span class="d-block font-weight-bold">Keterangan</span>
                <span class="d-block">${dt.f2021_2032}</span><br>
                <span class="d-block font-weight-bold">Urban Index 2021</span>
                <span class="d-block">${dt.tp2021}</span><br>
                <span class="d-block font-weight-bold">Urban Index 2010</span>
                <span class="d-block">${dt.tp2010}</span><br>
                <span class="d-block font-weight-bold">Parameter Prediksi</span>
                <span class="d-block">Pola Ruang :  ${dt.pola_ruang}</span>
                <span class="d-block">Livability :  ${dt.livability}</span>
                <span class="d-block">Daya Dukung Lingkungan :  ${dt.ddl}</span>
                <span class="d-block">NJOP : Rp${separatorNum(
                    dt.njop_min
                )} - Rp.${separatorNum(dt.njop_max)}</span>
            </div>
        </div>`;
    }

    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }

    popup.setLngLat(coordinates).setHTML(content).addTo(map);
});

map.on("mouseleave", "urban_fill", () => {
    map.getCanvas().style.cursor = "";

    popup.remove();
});

// Interaction Layer Sarana Prasarana
map.on("mouseenter", "sarana_prasarana_dot", (e) => {
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.lngLat;
    const dt = e.features[0].properties;
    const content = `<div class="card">

    <div class="card-body p-2">
    <div style="line-height: 1.2;">
        <h6 style="width:95%">${dt["nama"]}</h6>
        <span class="d-block">${dt["klasifikasi"]}</span>
        <span class="d-block">${dt["keterangan"]}</span>
      </div>
    </div>`;

    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }

    popup.setLngLat(coordinates).setHTML(content).addTo(map);
});

map.on("mouseleave", "sarana_prasarana_dot", () => {
    map.getCanvas().style.cursor = "";
    popup.remove();
});

// Interaction Layer Batas Laut
map.on("mouseenter", "batas_laut_fill", (e) => {
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.lngLat;
    const dt = e.features[0].properties;
    const content = `<div class="card">

    <div class="card-body p-2">
    <div style="line-height: 1.2;">
        <h6 style="width:95%">${dt["objek"]}</h6>
        <span class="d-block">${dt["keterangan"]}</span>
      </div>
    </div>`;

    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }

    popup.setLngLat(coordinates).setHTML(content).addTo(map);
});

map.on("mouseleave", "batas_laut_fill", () => {
    map.getCanvas().style.cursor = "";
    popup.remove();
});

// Interaction Layer Kawasan Khusus
map.on("mouseenter", "kawasan_khusus_fill", (e) => {
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.lngLat;
    const dt = e.features[0].properties;
    const content = `<div class="card">

    <div class="card-body p-2">
    <div style="line-height: 1.2;">
        <h6 style="width:95%">${dt["nama"]}</h6>
        <span class="d-block">${dt["keterangan"]}</span>
      </div>
    </div>`;

    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }

    popup.setLngLat(coordinates).setHTML(content).addTo(map);
});

map.on("mouseleave", "kawasan_khusus_fill", () => {
    map.getCanvas().style.cursor = "";
    popup.remove();
});

// Interaction Layer Kawasan Khusus
map.on("mouseenter", "area_kepulauan_fill", (e) => {
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.lngLat;
    const dt = e.features[0].properties;
    const content = `<div class="card">

    <div class="card-body p-2">
    <div style="line-height: 1.2;">
        <h6 style="width:95%">${dt["klasifikasi"]}</h6>
        <span class="d-block">${dt["keterangan"]}</span>
      </div>
    </div>`;

    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }

    popup.setLngLat(coordinates).setHTML(content).addTo(map);
});

map.on("mouseleave", "area_kepulauan_fill", () => {
    map.getCanvas().style.cursor = "";
    popup.remove();
});

// Interaction Layer Garis Kepulauan
map.on("mouseenter", "garis_kepulauan_multilinestring", (e) => {
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.lngLat;
    const dt = e.features[0].properties;
    const content = `<div class="card">

    <div class="card-body p-2">
    <div style="line-height: 1.2;">
        <h6 style="width:95%">${dt["klasifikasi"]}</h6>
        <span class="d-block">${dt["keterangan"]}</span>
      </div>
    </div>`;

    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }

    popup.setLngLat(coordinates).setHTML(content).addTo(map);
});

map.on("mouseleave", "garis_kepulauan_multilinestring", () => {
    map.getCanvas().style.cursor = "";
    popup.remove();
});

//Interaction Layer Sewa
map.on("mouseenter", "sewa_fill", (e) => {
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.features[0].geometry.coordinates.slice();
    const dt = e.features[0].properties;
    const content = `<div class="card">
    <div class="imgcard-container">
      <img src="http://jakarta.pintoinvest.com/rent/${
          dt["Foto"]
      }" class="card-img-top" style="height: 160px;object-fit: cover;">
    </div>
    <div class="card-body p-2">
      <h6 class="mt-0 mb-2 card-title border-bottom">${dt["Nama"]}</h6>
      <div style="line-height: 1.2;">
        <span class="d-block"><b>Harga Sewa :</b> Rp ${separatorNum(
            dt["Sewa"]
        )}/m&sup2; per tahun</span>
        <span class="d-block"><b>Alamat :</b> ${dt["Alamat"]}</span>
        <span class="d-block"><b>Koordinat :</b> <a href="" target="_blank" title="Klik disini untuk lihat di Google Maps">${
            dt["Lat"]
        }, ${dt["Long"]}</a></span>
      </div>
    </div>`;

    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }
    popup.setLngLat(coordinates).setHTML(content).addTo(map);
});

map.on("mouseleave", "sewa_fill", () => {
    map.getCanvas().style.cursor = "";
    popup.remove();
});

//Interaction Layer IUMK
map.on("mouseenter", "iumk_fill", (e) => {
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.features[0].geometry.coordinates.slice();
    const dt = e.features[0].properties;
    const nosk = dt["Nomor SK"];
    const splitsk = nosk.split("/");
    const edit_button =
        user_id !== 4309
            ? `<a href="javascript:void(0)" onclick="getDetailIumk(${
                  dt.ogc_fid
              }, '${dt["Nama Usaha"]}', '${dt["Pemilik Usaha"]}', '${
                  dt["Alamat"]
              }','${dt.NIK}', '${dt.NPWP}', '${dt["Penilaian"]}', '${
                  dt["Perizinan"]
              }', ${dt.Omzet_Tahunan}, '${dt.Star}', '${dt.no_izin_edar}', '${
                  dt.no_nib
              }', '${dt.no_halal}');flyToLocation(${dt.Lat},${
                  dt.Long
              },'${titleCase(dt.Kelurahan)}')">Edit</a>`
            : ``;
    const noskfix =
        splitsk[0] + "/**/*****************/*/*****/**/" + splitsk[6];
    const content = `<div class="card">
    <div class="imgcard-container">
      <img src="#" class="card-img-top" id="imgCardIUMK" alt="${dt["Nama Usaha"]}" style="height: 160px;object-fit: cover;display:none;">
    </div>
    <div class="card-body p-2">
      <h6 class="mt-0 mb-2 card-title border-bottom">${dt["Nama Usaha"]}</h6>
      <div style="line-height: 1.2;">
        <span class="d-block"><b>No. SK :</b> ${noskfix}</span>
        <span class="d-block"><b>Jenis Usaha :</b> ${dt["Jenis Usaha"]}</span>
        <span class="d-block"><b>Tenaga Kerja :</b> ${dt["Tenaga Kerja"]} Orang</span></div>
        <span class="d-block"><b>Alamat :</b> ${dt["Alamat"]}</span>
        <span class="d-block"><b>${edit_button}</div>
      </div>
      </div>
    </div>`;

    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }
    popupIumk.setLngLat(coordinates).setHTML(content).addTo(map);
    setTimeout(() => {
        getIumk(e);
    }, 500);
});

// Interaction Layer gsb_nol
map.on("mouseenter", "gsb_nol_multilinestring", (e) => {
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.lngLat;
    const dt = e.features[0].properties;
    const content = `<div class="card">
    <div class="card-body p-2">
      <div style="line-height: 1.2;">
        <span class="d-block">${dt["nama"]}</span>
      </div>
    </div>`;

    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }

    popup.setLngLat(coordinates).setHTML(content).addTo(map);
});

map.on("mouseleave", "gsb_nol_multilinestring", () => {
    map.getCanvas().style.cursor = "";
    popup.remove();
});

//Get Detail NIB
const getDetailNIB = (
    ogc_fid,
    nama,
    nib,
    uraian_skala_usaha,
    kbli,
    jumlah_investasi_lain,
    uraian_resiko_proyek,
    lat,
    lng
) => {
    $(".info-edit-nib").show();

    $("#ogc_fid_nib").val(ogc_fid);
    $("#nama_perusahaan_nib").val(nama);
    $("#nib_nib").val(nib);
    $("#uraian_skala_usaha_nib").val(uraian_skala_usaha);
    $("#kbli_nib").val(kbli);
    $("#jumlah_investasi_lain_nib").val(jumlah_investasi_lain);
    $("#uraian_resiko_proyek_nib").val(uraian_resiko_proyek);
    $("#location_nib").val(`${lat},${lng}`);
};

// Close Detail NIB
$("#closeEditNIB").click(() => {
    $(".info-edit-nib").hide();
    markerIzin.remove();
});

// Save NIB
$("#formEditNIB").on("submit", function (e) {
    e.preventDefault();

    const data = new FormData(this);

    $(".spinner-edit-nib").show();
    $(".btn-send-nib").hide();

    $.ajax({
        url: `${APP_URL}/saveNIB`,
        type: "POST",
        data: data,
        contentType: false,
        processData: false,
        success: function (res) {
            getDataSource("nib", kelurahan_tmp_global);

            $(".spinner-edit-nib").hide();
            $(".btn-send-nib").show();

            $("#alertNIB").show();

            setTimeout(() => {
                $("#alertNIB").hide();
            }, 3000);
        },
        error: function (err) {
            getDataSource("nib", kelurahan_tmp_global);

            $(".spinner-edit-nib").hide();
            $(".btn-send-nib").show();
        },
    });
});

// Chart Distribusi NIB
const getChartDistribusiNIB = (kelurahan) => {
    let chart_nib = $("#pie-chart-investasi").get(0).getContext("2d");
    let chart_sektor = $("#pie-chart-distribusi").get(0).getContext("2d");
    let chart_tk = $("#pie-chart-serapan-tk").get(0).getContext("2d");
    $.ajax({
        url: `${url_api}/distribusi_nib`,
        type: "POST",
        data: {
            kelurahan: kelurahan,
        },
        headers: {
            Authorization: "Bearer " + token,
        },
        dataType: "json",
        success: (res) => {
            let data = {
                sektor: [],
                color: [],
                jumlah: [],
                jumlah_investasi: [],
                tenaga_kerja: [],
            };
            res.features.forEach((item) => {
                const {
                    sektor,
                    color,
                    jumlah,
                    jumlah_investasi,
                    tenaga_kerja,
                } = item.properties;
                data.sektor.push(sektor);
                data.color.push(color);
                data.jumlah.push(jumlah);
                data.jumlah_investasi.push(jumlah_investasi);
                data.tenaga_kerja.push(tenaga_kerja);
            });

            if (pie_investasi) {
                pie_investasi.destroy();
            }

            pie_investasi = new Chart(chart_nib, {
                type: "pie",
                data: {
                    labels: data.sektor,
                    datasets: [
                        {
                            backgroundColor: data.color,
                            data: data.jumlah_investasi,
                        },
                    ],
                },
                options: {
                    title: {
                        display: true,
                    },
                    legend: {
                        position: "bottom",
                        align: "start",
                        display: false,
                    },
                    legendCallback: (chart) => {
                        const renderLabels = (chart) => {
                            const { data } = chart;
                            return data.datasets[0].data
                                .map(
                                    (_, i) =>
                                        `<li>
                                    <div id="legend-${i}-item" class="legend-item">
                                      <span style="background-color:
                                        ${data.datasets[0].backgroundColor[i]}">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                      </span>
                                      ${
                                          data.labels[i] &&
                                          `<span class="label">${data.labels[i]}</span>`
                                      }
                                    </div>
                                </li>
                              `
                                )
                                .join("");
                        };
                        return `
                          <ul class="chartjs-legend">
                            ${renderLabels(chart)}
                          </ul>`;
                    },
                    tooltips: {
                        callbacks: {
                            label: (tooltipItem, data) => {
                                let value =
                                    data.datasets[tooltipItem.datasetIndex]
                                        .data[tooltipItem.index];
                                return ": Rp " + value.toLocaleString("id-ID");
                            },
                        },
                    },
                    bezierCurve: false,
                    animation: {
                        // duration: 0,
                        onComplete: function () {},
                    },
                },
            });

            $("#pie-chart-investasi-legend").html(
                pie_investasi.generateLegend()
            );
            // bindChartEvents(pie_investasi, $("#pie-chart-investasi-legend")[0]);

            if (pie_sektor) {
                pie_sektor.destroy();
            }

            pie_sektor = new Chart(chart_sektor, {
                type: "pie",
                data: {
                    labels: data.sektor,
                    datasets: [
                        {
                            backgroundColor: data.color,
                            data: data.jumlah,
                        },
                    ],
                },
                options: {
                    title: {
                        display: true,
                    },
                    legend: {
                        position: "bottom",
                        align: "start",
                        display: false,
                    },
                    legendCallback: (chart) => {
                        const renderLabels = (chart) => {
                            const { data } = chart;
                            return data.datasets[0].data
                                .map(
                                    (_, i) =>
                                        `<li>
                                    <div id="legend-${i}-item" class="legend-item">
                                      <span style="background-color:
                                        ${data.datasets[0].backgroundColor[i]}">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                      </span>
                                      ${
                                          data.labels[i] &&
                                          `<span class="label">${data.labels[i]}</span>`
                                      }
                                    </div>
                                </li>
                              `
                                )
                                .join("");
                        };
                        return `
                          <ul class="chartjs-legend">
                            ${renderLabels(chart)}
                          </ul>`;
                    },
                    bezierCurve: false,
                    animation: {
                        // duration: 0,
                        onComplete: function () {},
                    },
                },
            });

            $("#pie-chart-distribusi-legend").html(pie_sektor.generateLegend());
            // bindChartEvents(pie_sektor, $("#pie-chart-distribusi-legend")[0]);

            if (pie_tk) {
                pie_tk.destroy();
            }

            pie_tk = new Chart(chart_tk, {
                type: "pie",
                data: {
                    labels: data.sektor,
                    datasets: [
                        {
                            backgroundColor: data.color,
                            data: data.tenaga_kerja,
                        },
                    ],
                },
                options: {
                    title: {
                        display: true,
                    },
                    legend: {
                        position: "bottom",
                        align: "start",
                        display: false,
                    },
                    legendCallback: (chart) => {
                        const renderLabels = (chart) => {
                            const { data } = chart;
                            return data.datasets[0].data
                                .map(
                                    (_, i) =>
                                        `<li>
                                    <div id="legend-${i}-item" class="legend-item">
                                      <span style="background-color:
                                        ${data.datasets[0].backgroundColor[i]}">
                                        &nbsp;&nbsp;&nbsp;&nbsp;
                                      </span>
                                      ${
                                          data.labels[i] &&
                                          `<span class="label">${data.labels[i]}</span>`
                                      }
                                    </div>
                                </li>
                              `
                                )
                                .join("");
                        };
                        return `
                          <ul class="chartjs-legend">
                            ${renderLabels(chart)}
                          </ul>`;
                    },
                    bezierCurve: false,
                    animation: {
                        // duration: 0,
                        onComplete: function () {},
                    },
                },
            });

            $("#pie-chart-serapan-tk-legend").html(pie_tk.generateLegend());
            // bindChartEvents(pie_tk, $("#pie-chart-serapan-tk-legend")[0]);
        },
    });
};

const bindChartEvents = (myChart, containerElement) => {
    const legendItemSelector = ".legend-item";
    const labelSeletor = ".label";

    const legendItems = [
        ...containerElement.querySelectorAll(legendItemSelector),
    ];
    legendItems.forEach((item, i) => {
        item.addEventListener("click", (e) =>
            updateDataset(e.target.parentNode, i)
        );
    });

    const updateDataset = (currentEl, index) => {
        const meta = myChart.getDatasetMeta(0);
        const labelEl = currentEl.querySelector(labelSeletor);
        const result = meta.data[index].hidden === true ? false : true;
        if (result === true) {
            meta.data[index].hidden = true;
            labelEl.style.textDecoration = "line-through";
        } else {
            labelEl.style.textDecoration = "none";
            meta.data[index].hidden = false;
        }
        myChart.update();
    };
};

// Interaction Layer NIB
map.on("mouseenter", "nib_dot", (e) => {
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.lngLat;
    const dt = e.features[0].properties;
    const edit_button =
        user_id != 4309
            ? `<span class="d-block"><a href="javascript:void(0)" onclick="getDetailNIB(${dt.id}, '${dt.nama_perusahaan}', '${dt.nib}', '${dt.uraian_skala_usaha}', '${dt.kbli}', '${dt.jumlah_investasi_lain}', '${dt.uraian_resiko_proyek}', '${coordinates.lat}', '${coordinates.lng}')">Edit</a></span>`
            : "";
    const content = `<div class="card">

    <div class="card-body p-2">
    <div style="line-height: 1.2;">
        <h6 style="width:95%">${dt["nib"]}</h6>
        <span class="d-block">KBLI : ${dt["kbli"]}</span>
        <span class="d-block">Jumlah Investasi : Rp ${separatorNum(
            dt["jumlah_investasi_lain"]
        )}</span>
        ${edit_button}
      </div>
    </div>`;

    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }

    popupNib.setLngLat(coordinates).setHTML(content).addTo(map);
});

map.on("mouseleave", "nib_dot", () => {
    map.getCanvas().style.cursor = "";
    // popup.remove();
});

// Show Filter NIB
const showFilterNib = () => {
    let field = $("#field_filter_nib").val();

    if (field == "jenis_perusahaan") {
        $("#filter_jenis_perusahaan").show();
    } else if (field == "uraian_skala_usahala") {
        $("#filter_skala").show();
    } else if (field == "uraian_skala_usaha") {
        $("#filter_skala").show();
    } else if (field == "uraian_resiko_proyek") {
        $("#filter_resiko").show();
    } else if (field == "status_usaha") {
        $("#filter_status").show();
    } else if (field == "kbli") {
        $("#filter_kbli").show();
    } else if (field == "bintang") {
        $("#filter_bintang").show();
    } else if (field == "jumlah_investasi_lain") {
        $("#filter_investasi").show();
    }
};

// hide Filter NIB
const hideFilterNib = (id) => {
    if (id == "field_filter_bintang_value") {
        $("input[name='bintang_filter']").prop("checked", false);
    }

    $(`#${id}`)
        .val("")
        .trigger("change")
        .trigger("keyup")
        .parent()
        .parent()
        .hide();
};

// map.on("mouseleave", "iumk_fill", () => {
//     map.getCanvas().style.cursor = "";
//     popup.remove();
// });

//Interaction Layer Lebar Jalan
map.on("mouseenter", "badan_jalan_fill", (e) => {
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.lngLat;
    const dt = e.features[0].properties;
    const content = `<div class="card">
    <div class="card-body p-2">
      <div style="line-height: 1.2;">
        <span class="d-block">${dt["kodunk"]}</span>
        <span class="d-block">${dt["lebar_jalan"]} m</span>
      </div>
    </div>`;

    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }
    popup.setLngLat(coordinates).setHTML(content).addTo(map);
});

map.on("mouseleave", "badan_jalan_fill", (e) => {
    map.getCanvas().style.cursor = "";
    popup.remove();
});

//Interaction Layer Batas RW
map.on("mousemove", "rw_fill", (e) => {
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.lngLat;
    const dt = e.features[0].properties;
    const content = `<div class="card">
    <div class="card-body p-2">
      <div style="line-height: 1.2;">
        <span class="d-block">${dt["kelurahan"]}</span>
        <span class="d-block">${dt["RW"]}</span>
      </div>
    </div>`;

    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }
    popup.setLngLat(coordinates).setHTML(content).addTo(map);
});

map.on("mouseleave", "rw_fill", (e) => {
    map.getCanvas().style.cursor = "";
    popup.remove();
});

//Interaction Layer Proyek Potensial
map.on("mouseenter", "investasi_dot", (e) => {
    // console.log(e);
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.features[0].geometry.coordinates.slice();
    const dt = e.features[0].properties;
    const content = `<div class="card">
    <div class="card-body p-2">
    <h6 class="mt-0 mb-2 card-title border-bottom">${dt["Nama"]}</h6>
    <span class="d-block" style="width: 300px"><b>Pemilik Proyek :</b> ${
        dt["Pemilik"]
    }</span>
    <span class="d-block" style="width: 300px"><b>Luas Lahan :</b> ${
        dt["Luas_Lahan"] == ""
            ? ""
            : `${separatorNum(dt["Luas_Lahan"])} m<sup>2</sup>`
    }</span>
    <span class="d-block" style="width: 300px"><b>Jenis Sertifikat :</b> ${
        dt["Jenis_Sertifikat"]
    }</span>
    <span class="d-block" style="width: 300px"><b>Total Investasi :</b> ${
        dt["Total_Investasi"] == ""
            ? ""
            : `Rp. ${separatorNum(dt["Total_Investasi"])}`
    }</span>
    </div>`;

    // while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
    //   coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    // }
    popup.setLngLat(coordinates).setHTML(content).addTo(map);

    $(".mapboxgl-popup-content").addClass("inves");
    $(this).css("width", "300px");
});

map.on("mouseleave", "investasi_dot", () => {
    map.getCanvas().style.cursor = "";
    popup.remove();
    $(".inves").css("width", "");
});

//Interaction Layer Cagar Budaya
map.on("mouseenter", "budaya_dot", (e) => {
    // console.log(e);
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.features[0].geometry.coordinates.slice();
    const dt = e.features[0].properties;
    const content = `<div class="card">
    <div class="card-body p-2">
      <h6 class="mt-0 mb-2 card-title border-bottom">${dt["Name"]}</h6>
      <div style="line-height: 1.2;">
      <span class="d-block" style="width: 300px">Status : ${dt["Status"]}</span>
      <span class="d-block" style="width: 300px">Golongan : ${dt["Gol"]}</span>
    </div>`;

    // while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
    //   coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    // }
    popup.setLngLat(coordinates).setHTML(content).addTo(map);

    $(".mapboxgl-popup-content").addClass("inves");
    $(this).css("width", "300px");
});

map.on("mouseleave", "budaya_dot", () => {
    map.getCanvas().style.cursor = "";
    popup.remove();
    $(".inves").css("width", "");
});

//Interaction Layer Wilayah
map.on("click", "wilayah_fill", (e) => {
    const data = e.features[0].properties;

    //Set Attribute for Get Radius
    setAttrClick = e;

    //fill data profil
    const larea = parseInt(data["Luas"]) / 10000;
    $(".inf-iumk").html(data.Jumlah);
    $(".inf-omzet").html(separatorNum(data["Total Omzet"]));
    $(".inf-pen-05").html(data.P1 + " %");
    $(".inf-pen-610").html(data.P2 + " %");
    $(".inf-pen-1115").html(data.P3 + " %");
    $(".inf-pen-1620").html(data.P4 + " %");
    $(".inf-pen-20").html(data.P5 + " %");
    $(".inf-pen-na").html(data.P6 + " %");
    $(".inf-kelurahan").html(titleCase(data.Kelurahan));
    $(".inf-kecamatan").html(titleCase(data.Kecamatan));
    $(".inf-kota").html(titleCase(data.Kota));
    $(".inf-luasarea").html(larea.toFixed(2) + " ha");
    $(".inf-kepadatan").html(
        separatorNum(data["Kepadatan-Penduduk"]) + " jiwa/km2"
    );
    $(".inf-rasio").html(data.Gini);

    $("#kelurahanSurvey").val(data.Kelurahan);
    $("#kecamatanSurvey").val(data.Kecamatan);
    $("#kelurahanUsaha").val(data.Kelurahan);
    $("#kecamatanUsaha").val(data.Kecamatan);
    $("#textkelurahanSurvey").text(titleCase(data.Kelurahan));
    $("#textKelurahanUsaha").text(titleCase(data.Kelurahan));
    $("#textkelurahanSurveyBulk").text(titleCase(data.Kelurahan));
    $("#textkecamatanSurvey").text(titleCase(data.Kecamatan));
    $("#textKecamatanUsaha").text(titleCase(data.Kecamatan));
    $("#textkecamatanSurveyBulk").text(titleCase(data.Kecamatan));

    $("#kelurahan_pesan_ajib").val(titleCase(data.Kelurahan));
    $("#kecamatan_pesan_ajib").val(titleCase(data.Kecamatan));
    $("#kota_pesan_ajib").val(titleCase(data.Kota));

    // Chart Profile
    let chart_pie = $("#pie-chart").get(0).getContext("2d");
    let chart_bar = $("#bar-chart-grouped").get(0).getContext("2d");

    if (pie !== undefined) {
        pie.destroy();
    }

    pie = new Chart(chart_pie, {
        type: "pie",
        data: {
            labels: ["Produksi", "Perdagangan", "Jasa"],
            datasets: [
                {
                    label: "Kelurahan",
                    backgroundColor: ["#ed403c", "#f8a51b", "#a3218e"],
                    data: [data.Produksi, data.Perdagangan, data.Jasa],
                },
            ],
        },
        options: {
            title: {
                display: true,
            },
            legend: {
                align: "start",
            },
            bezierCurve: false,
            animation: {
                // duration: 0,
                onComplete: function () {},
            },
        },
    });

    if (bar !== undefined) {
        bar.destroy();
    }

    bar = new Chart(chart_bar, {
        type: "bar",
        data: {
            labels: ["20-29", "30-39", "40-49", "50-59", "60-69"],
            datasets: [
                {
                    backgroundColor: "#03a45e",
                    data: [data.U1, data.U2, data.U3, data.U4, data.U5],
                },
            ],
        },
        options: {
            // title: {
            //     display: true,
            //     text: ["Usia", "Jumlah"],
            //     position: ["bottom", "left"],
            // },
            legend: {
                display: false,
            },
            scales: {
                yAxes: [
                    {
                        scaleLabel: {
                            display: true,
                            labelString: "Jumlah",
                            padding: 20,
                        },
                    },
                ],
                xAxes: [
                    {
                        scaleLabel: {
                            display: true,
                            labelString: "Usia",
                            padding: 20,
                            barPercentage: 0.2,
                            categoryPercentage: 0.2,
                        },
                    },
                ],
            },
            bezierCurve: false,
            animation: {
                // duration: 0,
                onComplete: function () {},
            },
        },
    });

    //Load More Info
    getRadius(e);
    getRTRW(e);
    getPersilBPN(e);
    getSanitasi(e);
    getAirTanah(e);
    getPenuruanAirTanah(e);
    getNJOP(e);
    getKRB(e);
    getKetentuanKRB(e);
    getEksisting(e);
    getIndex(e);
    getLiveAbilityIndex(e);
    getUrbanIndex(e);
    getKKOPDetail(e);
    getPotensiRTHRTB(e);
    getTPZ(e);
    getTPZDetail(e);
    getKonturTanah(e);
    getSempadan(e);
    getRthRtb(e);

    //Get Data Simulasi
    if (localStorage.getItem("simulasi") !== "") {
        let simulasi = localStorage.getItem("simulasi");
        getSimulasi(simulasi);
    }

    //show detail layer
    if (titleCase(data.Kota) !== "Kepulauan Seribu") {
        showDetailInfoLayer();
    } else {
        hideDetailInfoLayer();
    }

    // Save Koordinat to Session
    $.ajax({
        url: `${APP_URL}/save_kordinat`,
        method: "POST",
        data: {
            kordinat: [e.lngLat.lat, e.lngLat.lng],
        },
        success: () => {
            console.log("Coordinates Saved");
        },
    });

    // Save Map Image to Session
    // map.resize();
    // let img = map.getCanvas().toDataURL("image/png");
    // $.ajax({
    //     type: "POST",
    //     url: `${APP_URL}/save_image`,
    //     data: {
    //         img: img,
    //     },
    //     success: () => {
    //         console.log("Images Saved");
    //     },
    // });
});

const getDistribusiWilayah = (kelurahan) => {
    $.ajax({
        url: `${url_api}/distribusi_wilayah`,
        method: "POST",
        data: {
            kelurahan: kelurahan,
        },
        dataType: "json",
        headers: {
            Authorization: "Bearer " + token,
        },
        success: (data) => {
            const { features } = data;

            const distribusi_2014 = features.filter((item) => {
                return item.properties.tahun === 2014;
            });

            console.log(distribusi_2014);

            let distribusi_2014_content = "";
            distribusi_2014.forEach((item) => {
                distribusi_2014_content += `
                <div class="text_all">
                    <label>${item.properties.sub_zona}</label>
                </div>
                <div class="text_all text-right col_info">
                    <label>${parseInt(
                        Math.round(item.properties.luas)
                    ).toLocaleString("id-ID")} m<sup>2</sup></label>
                </div>
                <div class="text_all text-right col_info">
                    <label>${parseFloat(
                        Math.round(
                            (item.properties.percent + Number.EPSILON) * 100
                        ) / 100
                    ).toLocaleString("id-ID")} %</label>
                </div>
                `;
            });

            $("#distribusi_wilayah_2014").html(distribusi_2014_content);

            const distribusi_2022 = features.filter((item) => {
                return item.properties.tahun === 2022;
            });

            console.log(distribusi_2022);

            let distribusi_2022_content = "";
            let option_filter = "";
            option_filter += `<option value="">Pilih Sub Zona</option>`;
            distribusi_2022.forEach((item) => {
                option_filter += `<option value="${item.properties.sub_zona}">${item.properties.sub_zona}</option>`;
                distribusi_2022_content += `
                <div class="text_all">
                    <label>${item.properties.sub_zona}</label>
                </div>
                <div class="text_all text-right col_info">
                    <label>${parseInt(
                        Math.round(item.properties.luas)
                    ).toLocaleString("id-ID")} m<sup>2</sup></label>
                </div>
                <div class="text_all text-right col_info">
                    <label>${parseFloat(
                        Math.round(
                            (item.properties.percent + Number.EPSILON) * 100
                        ) / 100
                    ).toLocaleString("id-ID")} %</label>
                </div>
                `;
            });

            $("#sub_zona_filter").html(option_filter);
            $("#distribusi_wilayah_2022").html(distribusi_2022_content);
        },
    });
};

const getLuasTransectZone = (kelurahan) => {
    $.ajax({
        url: `${url_api}/urban_luas`,
        method: "POST",
        data: {
            kelurahan: kelurahan,
        },
        dataType: "json",
        headers: {
            Authorization: "Bearer " + token,
        },
        success: (data) => {
            const { features } = data;

            const luas_transect_zone = features;

            let luas_transect_zone_content = "";
            luas_transect_zone.forEach((item) => {
                luas_transect_zone_content += `
                <div class="text_all">
                    <label>${item.properties.transect_zone}</label>
                </div>
                <div class="text_all text-right col_info">
                    <label>${parseInt(
                        Math.round(item.properties.luas)
                    ).toLocaleString("id-ID")} m<sup>2</sup></label>
                </div>
                <div class="text_all text-right col_info">
                    <label>${parseFloat(item.properties.presentase * 100)
                        .toFixed(2)
                        .toLocaleString("id-ID")} %</label>
                </div>
                `;
            });

            $("#distribusi_luas_transect_zone_2021").html(
                luas_transect_zone_content
            );
        },
    });
};

const getDistribusiLuasWilayah = (kelurahan) => {
    $.ajax({
        url: `${url_api}/distribusi_luas`,
        method: "POST",
        data: {
            kelurahan: kelurahan,
        },
        dataType: "json",
        headers: {
            Authorization: "Bearer " + token,
        },
        success: (data) => {
            const {
                tz_tp1,
                tz_tp2,
                tz_tp3,
                tz_tp4,
                tz_tp5,
                tz_tp6a,
                tz_tp6b,
                luas_tz_tp1,
                luas_tz_tp2,
                luas_tz_tp3,
                luas_tz_tp4,
                luas_tz_tp5,
                luas_tz_tp6a,
                luas_tz_tp6b,
                li_sangat_rendah,
                li_rendah,
                li_sedang,
                li_tinggi,
                li_sangat_tinggi,
                luas_li_sangat_rendah,
                luas_li_rendah,
                luas_li_sedang,
                luas_li_tinggi,
                luas_li_sangat_tinggi,
                eci_sangat_rendah,
                eci_rendah,
                eci_sedang,
                eci_tinggi,
                eci_sangat_tinggi,
                luas_eci_sangat_rendah,
                luas_eci_rendah,
                luas_eci_sedang,
                luas_eci_tinggi,
                luas_eci_sangat_tinggi,
            } = data.features[0].properties;

            $(".inf-distribusi-wilayah-tp-1").html(
                `${tz_tp1 == null ? "0 %" : tz_tp1}`
            );
            $(".inf-distribusi-wilayah-luas-tp-1").html(
                `${
                    luas_tz_tp1 == null
                        ? "0 m<sup>2</sup>"
                        : luas_tz_tp1.toLocaleString("id-ID") + " m<sup>2</sup>"
                }`
            );
            $(".inf-distribusi-wilayah-tp-2").html(
                `${tz_tp2 == null ? "0 %" : tz_tp2}`
            );
            $(".inf-distribusi-wilayah-luas-tp-2").html(
                `${
                    luas_tz_tp2 == null
                        ? "0 m<sup>2</sup>"
                        : luas_tz_tp2.toLocaleString("id-ID") + " m<sup>2</sup>"
                }`
            );
            $(".inf-distribusi-wilayah-tp-3").html(
                `${tz_tp3 == null ? "0 %" : tz_tp3}`
            );
            $(".inf-distribusi-wilayah-luas-tp-3").html(
                `${
                    luas_tz_tp3 == null
                        ? "0 m<sup>2</sup>"
                        : luas_tz_tp3.toLocaleString("id-ID") + " m<sup>2</sup>"
                }`
            );
            $(".inf-distribusi-wilayah-tp-4").html(
                `${tz_tp4 == null ? "0 %" : tz_tp4}`
            );
            $(".inf-distribusi-wilayah-luas-tp-4").html(
                `${
                    luas_tz_tp4 == null
                        ? "0 m<sup>2</sup>"
                        : luas_tz_tp4.toLocaleString("id-ID") + " m<sup>2</sup>"
                }`
            );
            $(".inf-distribusi-wilayah-tp-5").html(
                `${tz_tp5 == null ? "0 %" : tz_tp5}`
            );
            $(".inf-distribusi-wilayah-luas-tp-5").html(
                `${
                    luas_tz_tp5 == null
                        ? "0 m<sup>2</sup>"
                        : luas_tz_tp5.toLocaleString("id-ID") + " m<sup>2</sup>"
                }`
            );
            $(".inf-distribusi-wilayah-tp-6a").html(
                `${tz_tp6a == null ? "0 %" : tz_tp6a}`
            );
            $(".inf-distribusi-wilayah-luas-tp-6a").html(
                `${
                    luas_tz_tp6a == null
                        ? "0 m<sup>2</sup>"
                        : luas_tz_tp6a.toLocaleString("id-ID") +
                          " m<sup>2</sup>"
                }`
            );
            $(".inf-distribusi-wilayah-tp-6b").html(
                `${tz_tp6b == null ? "0 %" : tz_tp6b}`
            );
            $(".inf-distribusi-wilayah-luas-tp-6b").html(
                `${
                    luas_tz_tp6b == null
                        ? "0 m<sup>2</sup>"
                        : luas_tz_tp6b.toLocaleString("id-ID") +
                          " m<sup>2</sup>"
                }`
            );

            $(".inf-distribusi-wilayah-livability-sangat-rendah").html(
                `${li_sangat_rendah == null ? "0 %" : li_sangat_rendah}`
            );
            $(".inf-distribusi-wilayah-livability-luas-sangat-rendah").html(
                `${
                    luas_li_sangat_rendah == null
                        ? "0 m<sup>2</sup>"
                        : luas_li_sangat_rendah.toLocaleString("id-ID") +
                          " m<sup>2</sup>"
                }`
            );
            $(".inf-distribusi-wilayah-livability-rendah").html(
                `${li_rendah == null ? "0 %" : li_rendah}`
            );
            $(".inf-distribusi-wilayah-livability-luas-rendah").html(
                `${
                    luas_li_rendah == null
                        ? "0 m<sup>2</sup>"
                        : luas_li_rendah.toLocaleString("id-ID") +
                          " m<sup>2</sup>"
                }`
            );
            $(".inf-distribusi-wilayah-livability-sedang").html(
                `${li_sedang == null ? "0 %" : li_sedang}`
            );
            $(".inf-distribusi-wilayah-livability-luas-sedang").html(
                `${
                    luas_li_sedang == null
                        ? "0 m<sup>2</sup>"
                        : luas_li_sedang.toLocaleString("id-ID") +
                          " m<sup>2</sup>"
                }`
            );
            $(".inf-distribusi-wilayah-livability-tinggi").html(
                `${li_tinggi == null ? "0 %" : li_tinggi}`
            );
            $(".inf-distribusi-wilayah-livability-luas-tinggi").html(
                `${
                    luas_li_tinggi == null
                        ? "0 m<sup>2</sup>"
                        : luas_li_tinggi.toLocaleString("id-ID") +
                          " m<sup>2</sup>"
                }`
            );
            $(".inf-distribusi-wilayah-livability-sangat-tinggi").html(
                `${li_sangat_tinggi == null ? "0 %" : li_sangat_tinggi}`
            );
            $(".inf-distribusi-wilayah-livability-luas-sangat-tinggi").html(
                `${
                    luas_li_sangat_tinggi == null
                        ? "0 m<sup>2</sup>"
                        : luas_li_sangat_tinggi.toLocaleString("id-ID") +
                          " m<sup>2</sup>"
                }`
            );

            $(".inf-distribusi-wilayah-eci-sangat-rendah").html(
                `${eci_sangat_rendah == null ? "0 %" : eci_sangat_rendah}`
            );
            $(".inf-distribusi-wilayah-eci-luas-sangat-rendah").html(
                `${
                    luas_eci_sangat_rendah == null
                        ? "0 m<sup>2</sup>"
                        : luas_eci_sangat_rendah.toLocaleString("id-ID") +
                          " m<sup>2</sup>"
                }`
            );
            $(".inf-distribusi-wilayah-eci-rendah").html(
                `${eci_rendah == null ? "0 %" : eci_rendah}`
            );
            $(".inf-distribusi-wilayah-eci-luas-rendah").html(
                `${
                    luas_eci_rendah == null
                        ? "0 m<sup>2</sup>"
                        : luas_eci_rendah.toLocaleString("id-ID") +
                          " m<sup>2</sup>"
                }`
            );
            $(".inf-distribusi-wilayah-eci-sedang").html(
                `${eci_sedang == null ? "0 %" : eci_sedang}`
            );
            $(".inf-distribusi-wilayah-eci-luas-sedang").html(
                `${
                    luas_eci_sedang == null
                        ? "0 m<sup>2</sup>"
                        : luas_eci_sedang.toLocaleString("id-ID") +
                          " m<sup>2</sup>"
                }`
            );
            $(".inf-distribusi-wilayah-eci-tinggi").html(
                `${eci_tinggi == null ? "0 %" : eci_tinggi}`
            );
            $(".inf-distribusi-wilayah-eci-luas-tinggi").html(
                `${
                    luas_eci_tinggi == null
                        ? "0 m<sup>2</sup>"
                        : luas_eci_tinggi.toLocaleString("id-ID") +
                          " m<sup>2</sup>"
                }`
            );
            $(".inf-distribusi-wilayah-eci-sangat-tinggi").html(
                `${eci_sangat_tinggi == null ? "0 %" : eci_sangat_tinggi}`
            );
            $(".inf-distribusi-wilayah-eci-luas-sangat-tinggi").html(
                `${
                    luas_eci_sangat_tinggi == null
                        ? "0 m<sup>2</sup>"
                        : luas_eci_sangat_tinggi.toLocaleString("id-ID") +
                          " m<sup>2</sup>"
                }`
            );
        },
    });
};

//Interaction Layer Transportasi
map.on("mouseenter", "transportasi_multilinestring", (e) => {
    // console.log(e);
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.lngLat;
    const { jenis, keterangan, panjang } = e.features[0].properties;
    const content = `<div class="card">
    <div class="card-body p-0">
      <span class="mx-2 card-title">${jenis}</span><br>
      <span class="mx-2 card-title">${keterangan}</span><br>
      <span class="mx-2 card-title">${panjang} km</span>
    </div>`;

    popup.setLngLat(coordinates).setHTML(content).addTo(map);
});

map.on("mouseleave", "transportasi_multilinestring", () => {
    map.getCanvas().style.cursor = "";
    popup.remove();
});

// Interaction Layer Kontur
map.on("mousemove", "kontur_fill", (e) => {
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.lngLat;
    const { kontur } = e.features[0].properties;
    const content = `<div class="card">
    <div class="card-body p-0">
        <span class="mx-2 card-title">${kontur} mdpl</span>

    </div>`;
    popup.setLngLat(coordinates).setHTML(content).addTo(map);
});

map.on("mouseleave", "kontur_fill", () => {
    popup.remove();
});

//Interaction Layer Zoning
map.on("click", "zoning_fill", (e) => {
    const data = e.features[0].properties;

    //Set Global Variable
    sub_zona_any = data.kodszntext;

    //Show Data Info
    $("#kbli-old").hide();
    $("#kbli-new").show();
    $("#ketentuan-old").hide();
    $("#ketentuan-new").show();

    //Reset Content
    $(".inf-zona").html("-");
    $(".inf-subzona").html("-");
    $(".inf-kode-sub-zona").html("-");
    $(".inf-id-blok").html("-");
    $(".inf-id-sub-blok").html("-");
    $(".inf-luas-lahan").html("-");
    $(".inf-kdb").html("-");
    $(".inf-klb").html("-");
    $(".inf-kdh").html("-");
    $(".inf-ketinggian-bangunan").html("-");
    $(".inf-jenis-bangunan").html(`
        <option>Pilih Jenis Bangunan...</option>
    `);
    $(".inf-definisi-bangunan").html("-");
    $(".inf-ketentuan-perizinan").html("-");
    $(".inf-keterangan").html("-");
    $("#list-kbli").html("-");
    $("#kegiatanRuangNew").html(
        '<option value="">Pilih KBLI atau Kegiatan.</option>'
    );
    $("#kegiatan").html("");
    $(".inf-bangunan").html("-");
    $(".inf-itbx").html("-");
    $(".kbli-ketentuan").html("-");
    $(".inf-besaran-gsj").html("-");
    $(".inf-keterangan-gsj").html("-");
    $(".list-fungsi-bangunan").html(
        "<option value=''>Pilih Fungsi Bangunan</option>"
    );
    $(".inf-besaran-gss").html("-");
    $(".inf-keterangan-gss").html("-");
    $("#list-tipikal").html("<option>Pilih Tipikal</option>");
    $("#list-luas-lahan").html("<option>Pilih Luas Lahan</option>");
    $(".inf-hunian-kdb").html("-");
    $(".inf-hunian-kdh").html("-");
    $(".inf-hunian-klb").html("-");
    $(".inf-hunian-ktb").html("-");
    $(".inf-hunian-ketinggian-bangunan").html("-");
    $(".inf-hunian-list-ketentuan").html("");
    $(".inf-variansi-list-ketentuan").html("");
    $(".inf-variansi-jenis-variansi").html("-");
    $(".inf-variansi-fungsi-bangunan").html("-");
    $(".inf-variansi-ketentuan-perizinan").html("-");

    //Load Info
    $(".inf-zona").html(data.nama_zona);
    $(".inf-subzona").html(data.namobj);
    $(".inf-kode-sub-zona").html(data.kodszntext);
    $(".inf-id-blok").html(data.id_blok);
    $(".inf-id-sub-blok").html(data.id_subblok);

    //Logical Intesity
    let sub_zona = data.kodszntext;
    if (sub_zona == "R-1" || sub_zona == "R-2") {
        $(".inf-luas-lahan").html(`
            <select id="option_intensitas_luas" class="w-100">
                <option>Pilih Luas...</option>
            </select>
        `);
        $(".inf-kdb").html(`
            <select id="option_intensitas_kdb" class="w-100">
                <option>Pilih KDB...</option>
            </select>
        `);
        $(".inf-simulasi-luas-lahan").html(`
            <select id="option_simulasi_intensitas_luas" class="w-100">
                <option>Pilih Luas...</option>
            </select>
        `);
        $(".inf-simulasi-kdb").html(`
            <select id="option_simulasi_intensitas_kdb" class="w-100">
                <option>Pilih KDB...</option>
            </select>
        `);
        $(".simulasi-r1").show();
        $(".simulasi-no-r1").hide();
        //Get Luas Lahan
        getLuasIntensitas();
    } else {
        $(".inf-luas-lahan").html(
            data.luasha.toFixed(2) * 10000 + " m<sup>2</sup>"
        );
        $(".simulasi-r1").hide();
        $(".simulasi-no-r1").show();
        $(".inf-kdb").html(data.kdb);
        $(".inf-klb").html(data.klb);
        $(".inf-simulasi-klb").html(data.klb);
        KLB = data.klb;
        // $(".inf-potensi-klb").val(data.klb);
        potensi();
        $(".inf-kdh").html(data.kdh);
        $(".inf-simulasi-kdh").html(data.kdh);
        KDH = data.kdh;
        $(".inf-ketinggian-bangunan").html(data.ting_bgn);
    }

    // Reset Option Print
    let optionPrint = ["kbli"];

    optionPrint.forEach((item) => {
        $.post(`${APP_URL}/check_print`, {
            kategeori: item,
            status: 0,
        });
    });

    //Load Jenis Bangunan
    getJenisBangunan();

    //Load Bangunan For KBLI
    getBangunanKBLI(data.kodszntext);

    //Load Ketentuan 2022
    getKetentuanTataBangunan(data.kodszntext);

    //Load Ketentuan KKOP
    // getKKOP(data.kkop_1);

    //Load Ketentuan Hunian
    getKetentuanHunian(data.kodszntext);

    //Load Ketentuan Variansi
    if (data.kodszntext.includes("RTH")) {
        $("#ketentuan-variansi").show();
        getKetentuanVariansi(data.kodszntext);
    } else {
        $("#ketentuan-variansi").hide();
    }

    //Fill Data Pendataan Usaha
    $("#idSubbBlokUsaha").val(data.id_subblok);
    $("#textIdSubBlokUsaha").text(data.id_subblok);
});

map.on("click", "zoning_old_fill", (e) => {
    const data = e.features[0].properties;

    //Set Global Variable
    sub_zona_any = data.sub_zona;

    //Show Data Info
    $("#kbli-new").hide();
    $("#kbli-old").show();
    $("#ketentuan-new").hide();
    $("#ketentuan-old").show();

    //Load More Info
    getKetentuanPSL(data.sub_zona, data.psl);
    dropDownKegiatan(data.sub_zona);

    //Fill Ketentuan Khusus
    let value_tpz = ``;
    let option_tpz = ``;
    let data_tpz = data.cd_tpz;
    let arr_tpz = data_tpz.split(",");
    if (data.cd_tpz == "null" || data.cd_tpz == 0) {
        value_tpz += `
        <p class="card-title mt-2 mb-2 text-center font-weight-bold judul_utama">Ketentuan TPZ</p>
        <p>Tidak Ada Ketentuan</p>`;
        option_tpz += `
            <option>Tidak Ada CD TPZ</option>
        `;
    } else {
        value_tpz += dsc_tpz;
        value_tpz += `<p class="card-title mt-2 mb-2 text-center font-weight-bold judul_utama">Ketentuan TPZ</p>`;
        value_tpz += `
        <p class="card-title mt-2 mb-2 text-center font-weight-bold judul_utama">${
            database_tpz[arr_tpz[0]].nama
        }</p>
        `;
        value_tpz += database_tpz[`${arr_tpz[0]}`].pengertian;
        value_tpz += database_tpz[`${arr_tpz[0]}`].ketentuan;
        for (let index = 0; index < arr_tpz.length; index++) {
            option_tpz += `
                <option value="${index}">${arr_tpz[index]}</option>
            `;
        }
    }
    $("#selectTPZ").html(option_tpz);

    //Fill Data
    $(".inf-zona").html(data.zona);
    $(".inf-subzona").html(data.sub_zona);
    $(".inf-blok").html(data.kode_blok + "/" + data.sub_blok);
    $(".inf-kdb").html(data.kdb == "null" ? "-" : `${data.kdb}%`);
    $(".inf-kdh").html(data.kdh == "null" ? "-" : `${data.kdh}%`);
    $(".inf-simulasi-kdh").html(data.kdh == "null" ? "-" : `${data.kdh}%`);
    KDH = data.kdh;
    $(".inf-klb").html(data.klb == "null" ? "-" : data.klb);
    $(".inf-simulasi-klb").html(data.klb == "null" ? "-" : data.klb);
    KLB = data.klb;
    // $(".inf-potensi-klb").val(data.klb);
    potensi();
    $(".inf-ktb").html(data.ktb == "null" ? "-" : `${data.ktb}%`);
    $(".inf-kb").html(data.kb == "null" ? "-" : `${data.kb} Lapis`);
    $(".inf-psl").html(data.kdb == "null" ? "-" : data.psl);
    $(".inf-gsb").html(gsb);
    $(".inf-k-tpz").html(value_tpz);
    $(".inf-tipe-bangunan").html(data.tipe);
    $(".inf-id-sub-blok").html(data["ID Sub Blok"]);
    $("#idSubblokSurvey").val(
        data.kode_blok + "." + data.sub_blok + "." + data.sub_zona
    );
    $("#textidSubblokSurvey").text(
        data.kode_blok + "." + data.sub_blok + "." + data.sub_zona
    );
    $("#idSubbBlokUsaha").val(
        data.kode_blok + "." + data.sub_blok + "." + data.sub_zona
    );
    $("#textIdSubBlokUsaha").text(
        data.kode_blok + "." + data.sub_blok + "." + data.sub_zona
    );
    $("#textglobalidSurvey").text(data.global_id);
    $("#textglobalidSurveyBulk").text(data.global_id);
    $("#globalidSurvey").val(data.global_id);
    $("#textidSubblokSurveyBulk").text(
        data.kode_blok + "." + data.sub_blok + "." + data.sub_zona
    );
});

// --- Intensitas New --- //
//Get Luas Intensitas Zoning
const getLuasIntensitas = (sub_zona = sub_zona_any) => {
    $.ajax({
        url: `${url_api}/intensitas`,
        method: "POST",
        headers: {
            Authorization: "Bearer " + token,
        },
        data: { sub_zona: sub_zona },
        dataType: "json",
        success: (res) => {
            const { features } = res;
            features.forEach(({ properties }) => {
                $("#option_intensitas_luas").append(`
                <option value="${properties.luas_lahan}">${properties.luas_lahan}</option>
            `);
                $("#option_simulasi_intensitas_luas").append(`
                <option value="${properties.luas_lahan}">${properties.luas_lahan}</option>
            `);
            });
        },
    });
};

$(document).on("change", "#option_intensitas_luas", (e) => {
    let luas = $(e.target).val();
    let sub_zona = sub_zona_any;

    //Reset Content
    $("#option_intensitas_kdb").html(`
                <option>Pilih KDB...</option>
            `);
    $(".inf-klb").html("-");
    $(".inf-kdh").html("-");
    $(".inf-ketinggian-bangunan").html("-");

    //Get KDB
    $.ajax({
        url: `${url_api}/intensitas`,
        method: "PUT",
        headers: {
            Authorization: "Bearer " + token,
        },
        data: {
            luas: luas,
            sub_zona: sub_zona,
        },
        dataType: "json",
        success: (res) => {
            const { features } = res;

            features.forEach(({ properties }) => {
                $("#option_intensitas_kdb").append(
                    `<option value="${properties.kdb}">${properties.kdb}</option>`
                );
            });
        },
    });
});

$(document).on("change", "#option_simulasi_intensitas_luas", (e) => {
    let luas = $(e.target).val();
    let sub_zona = sub_zona_any;

    //Reset Content
    $("#option_simulasi_intensitas_kdb").html(`
                <option>Pilih KDB...</option>
            `);
    $(".inf-simulasi-klb").html("-");
    $(".inf-simulasi-kdh").html("-");
    $(".inf-ketinggian-bangunan").html("-");

    //Get KDB
    $.ajax({
        url: `${url_api}/intensitas`,
        method: "PUT",
        headers: {
            Authorization: "Bearer " + token,
        },
        data: {
            luas: luas,
            sub_zona: sub_zona,
        },
        dataType: "json",
        success: (res) => {
            const { features } = res;

            features.forEach(({ properties }) => {
                $("#option_intensitas_kdb").append(
                    `<option value="${properties.kdb}">${properties.kdb}</option>`
                );
                $("#option_simulasi_intensitas_kdb").append(
                    `<option value="${properties.kdb}">${properties.kdb}</option>`
                );
            });
        },
    });
});

//Get More Info Intensity
$(document).on("change", "#option_intensitas_kdb", (e) => {
    let kdb = $(e.target).val();
    let sub_zona = sub_zona_any;
    let luas = $("#option_intensitas_luas").val();

    //Get Intensity
    $.ajax({
        url: `${url_api}/intensitas`,
        method: "GET",
        headers: {
            Authorization: "Bearer " + token,
        },
        data: {
            kdb: kdb,
            sub_zona: sub_zona,
            luas: luas,
        },
        dataType: "json",
        success: (res) => {
            const { features } = res;
            features.forEach(({ properties }) => {
                KLB = properties.klb;
                // $(".inf-potensi-klb").val(properties.klb);
                // console.log(
                //     "Isi dari form potensi KLB",
                //     $(".inf-potensi-klb").val()
                // );
                // potensi();
                $(".inf-klb").html(properties.klb);
                $(".inf-kdh").html(properties.kdh);
                $(".inf-ketinggian-bangunan").html(properties.tinggi_bangunan);
            });
        },
    });
});

$(document).on("change", "#option_simulasi_intensitas_kdb", (e) => {
    let kdb = $(e.target).val();
    let sub_zona = sub_zona_any;
    let luas = $("#option_simulasi_intensitas_luas").val();

    //Get Intensity
    $.ajax({
        url: `${url_api}/intensitas`,
        method: "GET",
        headers: {
            Authorization: "Bearer " + token,
        },
        data: {
            kdb: kdb,
            sub_zona: sub_zona,
            luas: luas,
        },
        dataType: "json",
        success: (res) => {
            const { features } = res;
            features.forEach(({ properties }) => {
                $(".inf-simulasi-klb").html(properties.klb);
                KLB = properties.klb.replaceAll(",", ".");
                $(".inf-simulasi-kdh").html(properties.kdh);
                KDH = properties.kdh;
                $(".inf-ketinggian-bangunan").html(properties.tinggi_bangunan);
            });
        },
    });
});

//Get Ketentuan Jenis Bangunan
const getJenisBangunan = (sub_zona = sub_zona_any) => {
    $.ajax({
        url: `${url_api}/ketentuan`,
        method: "PUT",
        headers: {
            Authorization: "Bearer " + token,
        },
        data: { sub_zona: sub_zona },
        dataType: "json",
        success: (res) => {
            const { features } = res;
            features.forEach(({ properties }) => {
                $(".inf-jenis-bangunan").append(`
                    <option value="${properties.jenis_bangunan}">${properties.jenis_bangunan}</option>
                `);
            });
        },
    });
};

//Get Info Ketentuan Bangunan
$(document).on("change", ".inf-jenis-bangunan", (e) => {
    let jenis_bangunan = $(e.target).val();
    let sub_zona = sub_zona_any;
    if (jenis_bangunan == "Pilih Jenis Bangunan...") {
        $(".inf-keterangan").html("-");
        $(".inf-definisi-bangunan").html("-");
        $(".inf-ketentuan-perizinan").html("-");
    } else {
        $.ajax({
            url: `${url_api}/ketentuan`,
            method: "post",
            headers: {
                Authorization: "Bearer " + token,
            },
            data: {
                jenis_bangunan: jenis_bangunan,
                sub_zona: sub_zona,
            },
            dataType: "json",
            success: (res) => {
                const { features } = res;
                features.forEach(({ properties }) => {
                    let ketentuan = [
                        properties.ketentuan_1,
                        properties.ketentuan_2,
                        properties.ketentuan_3,
                    ];

                    let el_ketentuan = "";

                    $(".inf-definisi-bangunan").html(
                        properties.definisi_bangunan
                    );
                    $(".inf-ketentuan-perizinan").html(
                        properties.ketentuan_perizinan
                    );

                    ketentuan.forEach((val, index) => {
                        if (val !== "") {
                            el_ketentuan += `${index + 1}. ${val} <br>`;
                        }
                    });

                    $(".inf-keterangan").html(el_ketentuan);
                });
            },
        });
    }
});

//Get Info Ketentuan KKOP
const getKKOP = (kode) => {
    $.ajax({
        url: `${url_api}/kkop`,
        method: "POST",
        headers: {
            Authorization: "Bearer " + token,
        },
        data: { kode: kode },
        dataType: "json",
        success: (res) => {
            const { features } = res;
            features.forEach(({ properties }) => {
                $(".inf-kode-kkop").html(properties.kode);
                $(".inf-keterangan-kkop").html(properties.keterangan);
            });
        },
    });
};

//Get Info Ketentuan KKOP Detail
const getKKOPDetail = (e) => {
    $.ajax({
        url: `${url_api}/kkop`,
        method: "PUT",
        headers: {
            Authorization: "Bearer " + token,
        },
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        dataType: "json",
        success: (res) => {
            const { features } = res;
            let html = ``;
            features.forEach(({ properties }) => {
                html += `
                    <option value="${properties.ketentuan}">${properties.nama}</option>
                `;
            });

            $(".inf-ketentuan-kkop-list").html(html);
            $(".inf-kkop").show();

            $(".inf-ketentuan-kkop-list").on("change", (e) => {
                let ketentuan = $(e.target).val();

                $(".inf-ketentuan-kkop-jenis").html(ketentuan);
            });

            $(".inf-ketentuan-kkop-list").trigger("change");
        },
        error: (err) => {
            $(".inf-kkop").hide();
        },
    });
};

//Get Ketentuan TPZ
const getTPZ = (e) => {
    //reset html
    $(".inf-ketentuan-tpz-jumlah").html(0);
    $(".inf-ketentuan-tpz-list").html("");
    $(".inf-ketentuan-tpz-nama").html(`-`);
    $(".inf-ketentuan-tpz-jenis-kawasan").html("-");
    $(".inf-ketentuan-tpz-nama-kawasan").html("-");
    $(".inf-ketentuan-tpz-skala-kawasan").html("-");

    $.ajax({
        url: `${url_api}/ketentuan_tpz`,
        method: "PUT",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        dataType: "json",
        success: (res) => {
            console.log(res.features !== null);
            if (res.features !== null) {
                const { features } = res;
                let html = ``;

                //Show Section
                $(".section_ketentuan_tpz").show();

                features.forEach(({ properties }) => {
                    const { kode_tpz } = properties;

                    let code_tpz = kode_tpz;
                    if (kode_tpz == "d") {
                        code_tpz = "(d) performa";
                    } else if (kode_tpz == "l") {
                        code_tpz = "(l) cagar budaya";
                    } else if (kode_tpz == "h") {
                        code_tpz = "(h) ambang";
                    } else if (kode_tpz == "k1") {
                        code_tpz = "(k1) pengendalian pertumbuhan";
                    } else if (kode_tpz == "k2") {
                        code_tpz = "(k2) pengendalian pertumbuhan";
                    } else if (kode_tpz == "b") {
                        code_tpz = "(b) bonus";
                    } else if (kode_tpz.includes("m1")) {
                        code_tpz = "(m1) intensitas sangat tinggi";
                    } else if (kode_tpz.includes("m2")) {
                        code_tpz = "(m2) intensitas sangat tinggi";
                    } else {
                        code_tpz = `(${kode_tpz})`;
                    }
                    html += `
                        <option value="${btoa(
                            JSON.stringify(properties)
                        )}">${code_tpz}</option>
                    `;
                });
                $(".inf-ketentuan-tpz-jumlah").html(res.features.length);

                $(".inf-ketentuan-tpz-list").html("");
                $(".inf-ketentuan-tpz-list").html(html);

                $(".inf-ketentuan-tpz-list").on("change", (e) => {
                    const {
                        kode_tpz,
                        tipe_kawasan,
                        nama_kawasan,
                        skala_kawasan,
                        arah_pengembangan,
                        index_pengendali,
                        max_kdb,
                        max_ktb,
                        max_klb,
                    } = JSON.parse(atob($(e.target).val()));
                    if (kode_tpz == "d") {
                        $(".inf-ketentuan-tpz-jenis-kawasan")
                            .parent()
                            .parent()
                            .addClass("d-flex")
                            .show();
                        $(".inf-ketentuan-tpz-jenis-kawasan").html(
                            tipe_kawasan
                        );
                        $(".inf-ketentuan-tpz-nama").html("performa");
                        $(".inf-ketentuan-tpz-nama-kawasan")
                            .parent()
                            .parent()
                            .addClass("d-flex")
                            .show();
                        $(".inf-ketentuan-tpz-nama-kawasan").html(nama_kawasan);
                        $(".inf-ketentuan-tpz-skala-kawasan")
                            .parent()
                            .parent()
                            .addClass("d-flex")
                            .show();
                        $(".inf-ketentuan-tpz-skala-kawasan").html(
                            skala_kawasan == null ? "-" : skala_kawasan
                        );

                        $(".inf-ketentuan-tpz-arah-pengembangan")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-index-pengendali")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-kdb-bonus")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-ktb-bonus")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-klb-bonus")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        let list_link_pdf = ``;
                        if (tipe_kawasan == "Kawasan Kompak") {
                            list_link_pdf = ` <div class="d-flex space_text row_mid_text mb-2">
                                <div class="col-lg-12 text_all">
                                    <a href="/pdf_file/ketentuan_tpz/performa_kompak_1.pdf" class="text_all_mobile w-100" target="_blank">Kriteria Perencanaan Kawasan Kompak </a><br>
                                    <a href="/pdf_file/ketentuan_tpz/performa_kompak_2.pdf" class="text_all_mobile w-100" target="_blank">Detail Rencana Kawasan Kompak</a><br>
                                    <a href="/pdf_file/ketentuan_tpz/performa_kompak_3.pdf" class="text_all_mobile w-100" target="_blank">Pengelolaan Kawasan Kompak</a><br>
                                    <a href="/pdf_file/ketentuan_tpz/performa_kompak_4.pdf" class="text_all_mobile w-100" target="_blank">Dokumen Rancang Bangun Pada Kawasan Kompak</a><br>
                                    <a href="/pdf_file/ketentuan_tpz/performa_kompak_5.pdf" class="text_all_mobile w-100" target="_blank">Pengajuan Dokumen Rancang Bangun Untuk Kawasan Kompak</a><br>
                                </div>
                            </div>
                            `;
                        } else {
                            list_link_pdf = ` <div class="d-flex space_text row_mid_text mb-2">
                                <div class="col-lg-12 text_all">
                                    <a href="/pdf_file/ketentuan_tpz/performa_transit_1.pdf" class="text_all_mobile w-100" target="_blank">Kriteria Perencanaan Kawasan Transit</a><br>
                                    <a href="/pdf_file/ketentuan_tpz/performa_transit_2.pdf" class="text_all_mobile w-100" target="_blank">Detail Rencana Kawasan Transit</a><br>
                                    <a href="/pdf_file/ketentuan_tpz/performa_transit_3.pdf" class="text_all_mobile w-100" target="_blank">Pengelolaan Kawasan Transit</a><br>
                                    <a href="/pdf_file/ketentuan_tpz/performa_transit_4.pdf" class="text_all_mobile w-100" target="_blank">Dokumen Rancang Bangun Pada Kawasan Transit</a><br>
                                    <a href="/pdf_file/ketentuan_tpz/performa_transit_5.pdf" class="text_all_mobile w-100" target="_blank">Pengajuan Dokumen Rancang Bangun Untuk Kawasan Transit</a><br>
                                </div>
                            </div>
                            `;
                        }
                        $(".inf-ketentuan-tpz-list-link")
                            .show()
                            .html(list_link_pdf);
                    } else if (kode_tpz == "l") {
                        $(".inf-ketentuan-tpz-jenis-kawasan")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();
                        $(".inf-ketentuan-tpz-nama-kawasan")
                            .parent()
                            .parent()
                            .addClass("d-flex")
                            .show();
                        $(".inf-ketentuan-tpz-nama-kawasan").html(nama_kawasan);
                        $(".inf-ketentuan-tpz-skala-kawasan")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-index-pengendali")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-kdb-bonus")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-ktb-bonus")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-klb-bonus")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-nama").html("Cagar Budaya");
                        $(".inf-ketentuan-tpz-list-link").show().html(`
                        <div class="d-flex space_text row_mid_text mb-2">
                        <div class="col-lg-12 text_all">
                            <a href="/pdf_file/ketentuan_tpz/cagar_budaya_1.pdf" class="text_all_mobile w-100" target="_blank">Ketentuan Pelestarian	</a><br>
                            <a href="/pdf_file/ketentuan_tpz/cagar_budaya_2.pdf" class="text_all_mobile w-100" target="_blank">Ketentuan Pembangunan Baru</a><br>
                        </div>
                    </div>
                        `);

                        $(".inf-ketentuan-tpz-arah-pengembangan")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();
                    } else if (kode_tpz == "h") {
                        $(".inf-ketentuan-tpz-jenis-kawasan").parent().parent();
                        css("display", "none !important");
                        $(".inf-ketentuan-tpz-nama-kawasan")
                            .parent()
                            .parent()
                            .show();

                        $(".inf-ketentuan-tpz-nama-kawasan").html(nama_kawasan);
                        $(".inf-ketentuan-tpz-skala-kawasan").parent().parent();
                        css("display", "none !important");
                        $(".inf-ketentuan-tpz-arah-pengembangan")
                            .parent()
                            .parent();
                        css("display", "none !important");
                        $(".inf-ketentuan-tpz-arah-pengembangan").html(
                            arah_pengembangan
                        );

                        $(".inf-ketentuan-tpz-index-pengendali")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-kdb-bonus")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-ktb-bonus")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-klb-bonus")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-nama").html("Ambang");
                        $(".inf-ketentuan-tpz-list-link").show().html(`
                        <div class="d-flex space_text row_mid_text mb-2">
                        <div class="col-lg-12 text_all">
                            <a href="/pdf_file/ketentuan_tpz/ambang_1.pdf" class="text_all_mobile w-100" target="_blank">Ketentuan Umum TPZ Ambang</a><br>
                            <a href="/pdf_file/ketentuan_tpz/ambang_2.pdf" class="text_all_mobile w-100" target="_blank">Proposal Dokumen Pengembangan Kawasan Pada Zona Ambang</a><br>
                            <a href="/pdf_file/ketentuan_tpz/ambang_3.pdf" class="text_all_mobile w-100" target="_blank">Pengajuan Dokumen Pengembangan Kawasan Untuk Kawasan Zona Ambang </a><br>
                        </div>
                    </div>
                        `);
                    } else if (kode_tpz == "k1" || kode_tpz == "k2") {
                        $(".inf-ketentuan-tpz-jenis-kawasan")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();
                        $(".inf-ketentuan-tpz-nama-kawasan")
                            .parent()
                            .parent()
                            .addClass("d-flex")
                            .show();
                        $(".inf-ketentuan-tpz-nama-kawasan").html(nama_kawasan);
                        $(".inf-ketentuan-tpz-skala-kawasan")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-index-pengendali")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-kdb-bonus")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-ktb-bonus")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-klb-bonus")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-nama").html(
                            "Pengedalian Pertumbuhan"
                        );
                        if (kode_tpz == "k1") {
                            $(".inf-ketentuan-tpz-list-link").show().html(`
                                <div class="d-flex space_text row_mid_text mb-2">
                                <div class="col-lg-12 text_all">
                                    <a href="/pdf_file/ketentuan_tpz/pengendalian_k1.pdf" class="text_all_mobile w-100" target="_blank">Ketentuan Umum TPZ Zona Pengendalian Pertumbuhan Kawasan sapi perah di Kawasan Pondok Ranggon 	</a><br>
                                </div>
                            </div>
                                `);
                        } else {
                            $(".inf-ketentuan-tpz-list-link").show().html(`
                                <div class="d-flex space_text row_mid_text mb-2">
                                <div class="col-lg-12 text_all">
                                    <a href="/pdf_file/ketentuan_tpz/pengendalian_k2.pdf" class="text_all_mobile w-100" target="_blank">Zona Pengendalian Pertumbuhan untuk kegiatan industri menengah dan besar yang berada di luar Sub-Zona KPI </a><br>
                                </div>
                            </div>
                                `);
                        }

                        $(".inf-ketentuan-tpz-arah-pengembangan")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();
                    } else if (kode_tpz == "b") {
                        $(".inf-ketentuan-tpz-jenis-kawasan")
                            .parent()
                            .parent()
                            .addClass("d-flex")
                            .show();

                        $(".inf-ketentuan-tpz-nama-kawasan")
                            .parent()
                            .parent()
                            .addClass("d-flex")
                            .show();

                        $(".inf-ketentuan-tpz-skala-kawasan")
                            .parent()
                            .parent()
                            .addClass("d-flex")
                            .show();

                        $(".inf-ketentuan-tpz-index-pengendali")
                            .parent()
                            .parent()
                            .addClass("d-flex")
                            .show();

                        $(".inf-ketentuan-tpz-kdb-bonus")
                            .parent()
                            .parent()
                            .addClass("d-flex")
                            .show();

                        $(".inf-ketentuan-tpz-ktb-bonus")
                            .parent()
                            .parent()
                            .addClass("d-flex")
                            .show();

                        $(".inf-ketentuan-tpz-klb-bonus")
                            .parent()
                            .parent()
                            .addClass("d-flex")
                            .show();

                        $(".inf-ketentuan-tpz-jenis-kawasan").html(
                            tipe_kawasan
                        );
                        $(".inf-ketentuan-tpz-nama-kawasan").html(nama_kawasan);
                        $(".inf-ketentuan-tpz-skala-kawasan").html(
                            skala_kawasan
                        );
                        $(".inf-ketentuan-tpz-index-pengendali").html(
                            index_pengendali
                        );
                        $(".inf-ketentuan-tpz-kdb-bonus").html(
                            `${max_kdb * 100}%`
                        );
                        $(".inf-ketentuan-tpz-ktb-bonus").html(
                            `${max_ktb * 100}%`
                        );

                        let klb_parse = parseFloat(KLB);
                        if (
                            max_klb ==
                            "Rumus : KLB Dasar x (2-Indeks Pengendali)"
                        ) {
                            let result = klb_parse * (2 - index_pengendali);
                            $(".inf-ketentuan-tpz-klb-bonus").html(
                                `${result.toFixed(2)}`
                            );
                        } else if (
                            max_klb ==
                            "Rumus : [KLB Dasar x (2-Indeks Pengendali)] x (1+5%)"
                        ) {
                            let result =
                                klb_parse *
                                (2 - index_pengendali) *
                                (1 + 5 / 100);
                            $(".inf-ketentuan-tpz-klb-bonus").html(
                                `${result.toFixed(2)}`
                            );
                        } else if (
                            max_klb ==
                            "Rumus : [KLB Dasar x (2-Indeks Pengendali)] x (1+30%)"
                        ) {
                            let result =
                                klb_parse *
                                (2 - index_pengendali) *
                                (1 + 30 / 100);
                            $(".inf-ketentuan-tpz-klb-bonus").html(
                                `${result.toFixed(2)}`
                            );
                        } else if (
                            max_klb ==
                            "Rumus : [KLB Dasar x (2-Indeks Pengendali)] x (1+20%)"
                        ) {
                            let result =
                                klb_parse *
                                (2 - index_pengendali) *
                                (1 + 20 / 100);
                            $(".inf-ketentuan-tpz-klb-bonus").html(
                                `${result.toFixed(2)}`
                            );
                        } else if (
                            max_klb ==
                            "Rumus : [KLB Dasar x (2-Indeks Pengendali)] x (1+15%)"
                        ) {
                            let result =
                                klb_parse *
                                (2 - index_pengendali) *
                                (1 + 15 / 100);
                            $(".inf-ketentuan-tpz-klb-bonus").html(
                                `${result.toFixed(2)}`
                            );
                        }

                        $(".inf-ketentuan-tpz-nama").html("Bonus");

                        $(".inf-ketentuan-tpz-list-link").show().html(`
                                <div class="d-flex space_text row_mid_text mb-2">
                                <div class="col-lg-12 text_all">
                                    <a href="/pdf_file/ketentuan_tpz/bonus_1.pdf" class="text_all_mobile w-100" target="_blank">Ketentuan Umum TPZ Bonus</a><br>
                                    <a href="/pdf_file/ketentuan_tpz/bonus_2.pdf" class="text_all_mobile w-100" target="_blank">Lahan Perencanaan yang Tidak Dikenakan Kontribusi pada Zona Bonus </a><br>
                                    <a href="/pdf_file/ketentuan_tpz/bonus_3.pdf" class="text_all_mobile w-100" target="_blank">Pengajuan Peningkatan Besaran Intensitas di Zona Bonus </a><br>
                                    <a href="/pdf_file/ketentuan_tpz/bonus_4.pdf" class="text_all_mobile w-100" target="_blank">Pelanggaran Peningkatan Besaran Intensitas di Zona Bonus </a><br>
                                </div>
                            </div>
                                `);
                    } else if (
                        kode_tpz.includes("m1") ||
                        kode_tpz.includes("m2")
                    ) {
                        let ketentuan = "";
                        let bonus = kode_tpz.includes("b")
                            ? "Terdapat zona bonus : Ya"
                            : "Terdapat zona bonus : Tidak";
                        let pdf = "";
                        if (kode_tpz.includes("m1")) {
                            $(".inf-ketentuan-tpz-nama").html(
                                "Lahan Perencanaan dengan Intensitas Pemanfaatan Ruang melebihi batasan Intensitas Pemanfaatan Ruang yang didasarkan pada ketentuan peraturan perundang-undangan sebelum Peraturan Gubernur ini ditetapkan"
                            );
                            ketentuan =
                                "Lahan Perencanaan dengan Intensitas Pemanfaatan Ruang melebihi batasan Intensitas Pemanfaatan Ruang yang didasarkan pada ketentuan peraturan perundang-undangan sebelum Peraturan Gubernur ini ditetapkan.";
                            if (kode_tpz.includes("b")) {
                                pdf = `
                                <div class="d-flex space_text row_mid_text mb-2">
                                    <div class="col-lg-12 text_all">
                                        <a href="/pdf_file/ketentuan_tpz/intensitas_1.pdf" class="text_all_mobile w-100" target="_blank">Ketentuan TPZ m1 di dalam zona bonus </a><br>
                                    </div>
                                </div>
                                `;
                            } else {
                                pdf = `
                                <div class="d-flex space_text row_mid_text mb-2">
                                    <div class="col-lg-12 text_all">
                                        <a href="/pdf_file/ketentuan_tpz/intensitas_2.pdf" class="text_all_mobile w-100" target="_blank">Ketentuan TPZ m1 di luar zona bonus </a><br>
                                    </div>
                                </div>
                                `;
                            }
                        } else {
                            $(".inf-ketentuan-tpz-nama").html(
                                "Lahan Perencanaan yang memperoleh pelampauan KLB dari Intensitas Pemanfaatan Ruang berdasarkan ketentuan peraturan perundang-undangan sebelum Peraturan Gubernur ini ditetapkan "
                            );
                            ketentuan =
                                " Lahan Perencanaan yang memperoleh pelampauan KLB dari Intensitas Pemanfaatan Ruang berdasarkan ketentuan peraturan perundang-undangan sebelum Peraturan Gubernur ini ditetapkan";

                            pdf = `
                                <div class="d-flex space_text row_mid_text mb-2">
                                    <div class="col-lg-12 text_all">
                                        <a href="/pdf_file/ketentuan_tpz/intensitas_3.pdf" class="text_all_mobile w-100" target="_blank">Ketentuan TPZ m2 </a><br>
                                    </div>
                                </div>
                                `;
                        }

                        $(".inf-ketentuan-tpz-jenis-kawasan")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-nama-kawasan")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-arah-pengembangan")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-skala-kawasan")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-index-pengendali")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-kdb-bonus")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-ktb-bonus")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-klb-bonus")
                            .parent()
                            .parent()
                            .removeClass("d-flex")
                            .hide();

                        $(".inf-ketentuan-tpz-list-link").show().html(`
                        <div class='d-flex space_text row_mid_text'>
                            <div class="col-lg-12 text_all">
                                Ketentuan TPZ Zona Intensitas Sangat Tinggi: ${ketentuan}<br>
                                ${bonus}
                            </div>
                        </div>
                        <br>
                        ${pdf}
                        `);
                    } else {
                        $(".inf-ketentuan-tpz-nama")
                            .parent()
                            .parent()
                            .addClass("d-flex")
                            .show();
                        $("inf-ketentuan-tpz-nama").html(`(${tpz})`);
                        $(".inf-ketentuan-tpz-jenis-kawasan")
                            .parent()
                            .parent()
                            .addClass("d-flex")
                            .show();
                        $(".inf-ketentuan-tpz-jenis-kawasan").html("-");
                        $(".inf-ketentuan-tpz-nama-kawasan")
                            .parent()
                            .parent()
                            .addClass("d-flex")
                            .show();
                        $(".inf-ketentuan-tpz-nama-kawasan").html("-");
                        $(".inf-ketentuan-tpz-skala-kawasan")
                            .parent()
                            .parent()
                            .addClass("d-flex")
                            .show();
                        $(".inf-ketentuan-tpz-skala-kawasan").html("-");
                        $(".inf-ketentuan-tpz-list-link").html("");
                        ".inf-ketentuan-tpz-nama".html(`-`);
                        //Show Section
                        $(".section_ketentuan_tpz").hide();
                    }
                });

                $(".inf-ketentuan-tpz-list").trigger("change");
            } else {
                $(".inf-ketentuan-tpz-jumlah").html(0);
                $(".inf-ketentuan-tpz-list").html("");
                $(".inf-ketentuan-tpz-nama").html(`-`);
                $(".inf-ketentuan-tpz-jenis-kawasan").html("-");
                $(".inf-ketentuan-tpz-nama-kawasan").html("-");
                $(".inf-ketentuan-tpz-skala-kawasan").html("-");
                $(".inf-ketentuan-tpz-list-link").html("");
                $(".inf-ketentuan-tpz-nama").html(`-`);
                //Show Section
                $(".section_ketentuan_tpz").hide();
            }
        },
    });
};

//Get Ketentuan Sempadan
const getSempadan = (e) => {
    $.ajax({
        url: `${url_api}/sempadan`,
        method: "PUT",
        headers: {
            Authorization: "Bearer " + token,
        },
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        dataType: "json",
        success: (res) => {
            const { features } = res;

            if (features !== null) {
                $(".inf-sempadan").show();
                features.forEach(({ properties }) => {
                    const { kawasan_sempadan } = properties;
                    let jenis_sempadan;
                    let option_sempadan = "";
                    let data_sempadan = {
                        K09A: [
                            "Kegiatan rekreasi pantai",
                            "RTH",
                            "Mangrove",
                            "Pengamanan pesisir seperti pengembangan struktur alami dan struktur buatan pencegah abrasi",
                            "Kegiatan Pelabuhan atau kegiatan dermaga",
                            "Pipa bawah laut",
                            "Pengendalian kualitas perairan dan konversi lingkungan pesisir",
                            "Kegiatan pengamatan cuaca dan iklim",
                            "Bangunan untuk kepentingan pemantauan ancaman banjir rob",
                            "Jalur Evakuasi Bencana",
                            "SPBU atau SPBG untuk kapal",
                            "Kepentingan pertahanan dan keamanan negara",
                            "Bangunan instalasi pengolahan air bersih, instalasi pengolahan air minum, IPAL dan Prasarana Umum lainnya",
                            "dengan tidak memperluas, menaikkan Intensitas Pemanfaatan Ruang dan/atau menambah bangunan baru",
                        ],
                        K09B: [
                            "RTH",
                            "Bangunan Prasarana dan jaringan perpipaan air",
                            "Jaringan listrik dan telekomunikasi",
                            "Jalur inspeksi",
                            "Jalur Evakuasi Bencana",
                            "Bangunan pengambilan dan pembuangan air",
                            "Bangunan untuk kepentingan pemantauan ancaman bencana",
                            "Prasarana Umum",
                            "Bangunan yang telah terbangun sebelum Peraturan Gubernur ini ditetapkan dengan tidak memperluas, menaikkan Intensitas Pemanfaatan Ruang dan/atau menambah bangunan baru",
                        ],
                    };

                    let ketentuan_sempadan = {
                        K09A: [
                            "Tidak mengganggu fungsi Sempadan Pantai sebagai Kawasan perlindungan setempat",
                            "Tidak menghalangi dan/atau menutup Ruang dan Jalur Evakuasi Bencana",
                            "Tidak menimbulkan pencemaran",
                        ],
                        K09B: [
                            "Tidak mengganggu fungsi Sempadan Sungai, dan SDEW sebagai Kawasan perlindungan setempat",
                            "Tidak menghalangi dan/atau menutup Ruang dan Jalur Evakuasi Bencana",
                            "Tidak menimbulkan pencemaran",
                        ],
                    };

                    if (kawasan_sempadan == "K09A") {
                        jenis_sempadan = "Sempadan Pantai";
                    } else if (kawasan_sempadan == "K09B") {
                        jenis_sempadan = "Sempadan Sungai";
                    }

                    data_sempadan[kawasan_sempadan].forEach((item) => {
                        option_sempadan += `<option value="${kawasan_sempadan}">${item}</option>`;
                    });

                    $(".inf-ketentuan-sempadan-jenis").html(jenis_sempadan);
                    $(".inf-ketentuan-sempadan-list")
                        .html(option_sempadan)
                        .on("change", () => {
                            let val = $(".inf-ketentuan-sempadan-list").val();

                            let html = "";

                            ketentuan_sempadan[val].forEach((item) => {
                                html += `<li style="margin-left:-1.5rem;">${item}</li>`;
                            });

                            $(".inf-ketentuan-sempadan").html(html);
                        });

                    $(".inf-ketentuan-sempadan-list").trigger("change");
                });
            } else {
                $(".inf-sempadan").hide();
            }
        },
        error: (err) => {
            $(".inf-sempadan").hide();
        },
    });
};

//Get Ketentuan RTH dan RTB
const getRthRtb = (e) => {
    $.ajax({
        url: `${url_api}/rthrtb`,
        method: "PUT",
        headers: {
            Authorization: "Bearer " + token,
        },
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        dataType: "json",
        success: (res) => {
            const { features } = res;

            if (features !== null) {
                $(".inf-rthrtb").show();
                const { nama } = features[0].properties;

                $(".inf-ketentuan-rthrtb-jenis").html(nama);
                $(".inf-ketentuan-rthrtb-sub-zona").html(sub_zona_any);
            } else {
                $(".inf-rthrtb").hide();
            }
        },
        error: (err) => {
            $(".inf-rthrtb").hide();
        },
    });
};
//Get Info Ketentuan TPZ Detail
const getTPZDetail = (e) => {
    $.ajax({
        url: `${url_api}/tpz`,
        method: "POST",
        headers: {
            Authorization: "Bearer " + token,
        },
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        dataType: "json",
        success: (res) => {
            const { features } = res;
            if (features !== null) {
                $(".inf-tpz-profile").hide();
            } else {
                let html = ``;
                features.forEach(({ properties }) => {
                    html += `
                    <div class="d-flex space_text row_mid_text mb-2">
                    <div class="col-lg-5 text_all">
                        <label class="text_all_mobile">${properties.kawasan}</label>
                    </div>
                    <div class="col-lg-7 text_all">
                        <p>${properties.keterangan}</p>
                    </div>
                </div>
                    `;
                });

                $(".inf-tpz-profile").show();

                $(".list-tpz-profile").html("");
                $(".list-tpz-profile").html(html);
            }
        },
        error: (err) => {
            $(".inf-tpz-profile").hide();
        },
    });
};

//Get Info Potensi RTH & RTB
const getPotensiRTHRTB = (e) => {
    $.ajax({
        url: `${url_api}/potensi_rth_rtb`,
        method: "POST",
        headers: {
            Authorization: "Bearer " + token,
        },
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        dataType: "json",
        success: (res) => {
            const { features } = res;
            let html = ``;
            features.forEach(({ properties }) => {
                html += `
                <div class="d-flex space_text row_mid_text">
                <div class="col-lg-5 text_all">
                    <label class="text_all_mobile">${properties.kawasan}</label>
                </div>
                <div class="col-lg-7 text_all">
                    <p>${properties.keterangan}</p>
                </div>
            </div>
                `;
            });

            $(".inf-potensi-rth-rtb").show();

            $(".list-potensi-rth-rtb").html("");
            $(".list-potensi-rth-rtb").html(html);
        },
        error: (err) => {
            $(".inf-potensi-rth-rtb").hide();
        },
    });
};

// Get Kontur Tanah
const getKonturTanah = (e) => {
    $.ajax({
        url: `${url_api}/kontur`,
        method: "PUT",
        headers: {
            Authorization: "Bearer " + token,
        },
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        dataType: "json",
        success: (res) => {
            const { features } = res;
            features.forEach(({ properties }) => {
                $(".inf-detail-kontur-tanah").html(
                    `${properties.kontur} meter di atas permukaan laut`
                );
            });

            $(".inf-kontur-tanah").show();
        },
        error: (err) => {
            $(".inf-kontur-tanah").hide();
        },
    });
};

// --- Intensitas Old --- //
const getKetentuanPSL = (subzona, psl) => {
    $.ajax({
        url: `${url_api}/khusus1`,
        method: "POST",
        data: {
            subzona: subzona,
            psl: psl,
        },
        headers: {
            Authorization: `Bearer ${token}`,
        },
        success: (e) => {
            let data = JSON.parse(e);
            let value_data = data.features[0].properties;
            let html = "";
            let htmlKetentuan = "";
            if (value_data !== null) {
                html += `<option>Pilih...</option>`;
                for (let index = 0; index < value_data.length; index++) {
                    html += `<option value="${value_data[index].Kegiatan}" data-id="${index}">${value_data[index].Kegiatan}</option>`;
                }
                //     htmlKetentuan += `
                // <p class="card-title mb-4 text-center font-weight-bold judul_utama" style="margin-top:-12px">${value_data[0].properties.Kegiatan}</p>
                // <div class="d-flex space_text row_mid_text">
                //     <div class="col-lg-5 text_all">
                //         <label class="text_all_mobile">Luas Lahan</label>
                //     </div>
                //     <div class="col-lg-7 text_all">
                //         <p>${value_data[0].properties["Luas Lahan"]}</p>
                //     </div>
                // </div>

                // <div class="d-flex space_text row_mid_text">
                //     <div class="col-lg-5 text_all">
                //         <label class="text_all_mobile">Lebar Muka</label>
                //     </div>
                //     <div class="col-lg-7 text_all">
                //         <p>${value_data[0].properties["Lebar Muka"]}</p>
                //     </div>
                // </div>

                // <div class="d-flex space_text row_mid_text">
                //     <div class="col-lg-5 text_all">
                //         <label class="text_all_mobile">Jarak Rencana</label>
                //     </div>
                //     <div class="col-lg-7 text_all">
                //         <p>${value_data[0].properties["Jarak Rencana"]}</p>
                //     </div>
                // </div>

                // <div class="d-flex space_text row_mid_text">
                //     <div class="col-lg-5 text_all">
                //         <label class="text_all_mobile">Jarak Eksisting</label>
                //     </div>
                //     <div class="col-lg-7 text_all">
                //         <p>${value_data[0].properties["Jarak Eksisting"]}</p>
                //     </div>
                // </div>

                // <div class="d-flex space_text row_mid_text">
                //     <div class="col-lg-5 text_all">
                //         <label class="text_all_mobile">Jarak Samping</label>
                //     </div>
                //     <div class="col-lg-7 text_all">
                //         <p>${value_data[0].properties["Jarak Samping"]}</p>
                //     </div>
                // </div>

                // <div class="d-flex space_text row_mid_text">
                //     <div class="col-lg-5 text_all">
                //         <label class="text_all_mobile">Jarak Belakang</label>
                //     </div>
                //     <div class="col-lg-7 text_all">
                //         <p>${value_data[0].properties["Jarak Belakang"]}</p>
                //     </div>
                // </div>

                // <div class="d-flex space_text row_mid_text">
                //     <div class="col-lg-5 text_all">
                //         <label class="text_all_mobile">KDB</label>
                //     </div>
                //     <div class="col-lg-7 text_all">
                //         <p>${value_data[0].properties["KDB"]}</p>
                //     </div>
                // </div>

                // <div class="d-flex space_text row_mid_text">
                //     <div class="col-lg-5 text_all">
                //         <label class="text_all_mobile">KTB</label>
                //     </div>
                //     <div class="col-lg-7 text_all">
                //         <p>${value_data[0].properties["KTB"]}</p>
                //     </div>
                // </div>

                // <div class="d-flex space_text row_mid_text">
                //     <div class="col-lg-5 text_all">
                //         <label class="text_all_mobile">KLB</label>
                //     </div>
                //     <div class="col-lg-7 text_all">
                //         <p>${value_data[0].properties["KLB"]}</p>
                //     </div>
                // </div>

                // <div class="d-flex space_text row_mid_text">
                //     <div class="col-lg-12 text_all">
                //         <p>${value_data[0].properties["Keterangan"]}</p>
                //     </div>
                // </div>
                // `;
            } else {
                // htmlKetentuan += `<p>Tidak Ketentuan Khusus</p>`;
                html += "<option>Tidak Ada Kegiatan</option>";
            }

            // $(".inf-khusus").html("");
            // $(".inf-khusus").html(htmlKetentuan);

            $("#selectPSL").html("");
            $("#selectPSL").html(html);
            $("#selectPSL").on("change", function () {
                const kegiatan = $(this).val();
                let index = $(this).find(":selected").data("id");
                $(".inf-status-ketentuan").html("");
                $(".inf-status-ketentuan").html(
                    value_data[index]["Ketentuan Perizinan"]
                );
                $(".inf-keterangan-ketentuan").html("");
                $(".inf-keterangan-ketentuan").html(
                    value_data[index].Substansi
                );
                $("#selectKhusus").html("");
                $(".isi-ketentuan-khusus").html("");

                getKegiatanKhusus(subzona, psl, kegiatan);
            });
            // if (param_kajian.itbx !== undefined) {
            //     setTimeout(function () {
            //         $("#selectPSL").val(param_kajian.itbx).trigger("change");
            //         setTimeout(function () {
            //             $("#selectKhusus")
            //                 .val(param_kajian.ketentuan_khusus)
            //                 .trigger("change");
            //         }, 1000);
            //     }, 2000);
            // }
        },
    });
};

const getKegiatanKhusus = (subzona, psl, kegiatan) => {
    $.ajax({
        url: `${url_api}/khusus2`,
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            subzona: subzona,
            psl: psl,
            kegiatan: kegiatan,
        },
        success: (e) => {
            let data = JSON.parse(e);
            let value_data = data.features[0];
            let html = "";
            // console.log(value_data[0].Kegiatan);
            html += `<option>Pilih...</option>`;
            if (value_data !== null) {
                for (
                    let index = 0;
                    index < value_data.properties.length;
                    index++
                ) {
                    html += `<option value="${value_data.properties[index]["Jenis Ketentuan Khusus"]}" data-id="${index}">${value_data.properties[index]["Jenis Ketentuan Khusus"]}</option>`;
                }
            } else {
                // htmlKetentuan += `<p>Tidak Ketentuan Khusus</p>`;
                html += "<option>Tidak Ada Ketentuan</option>";
            }
            $("#selectKhusus").html("");
            $("#selectKhusus").html(html);
            $("#selectKhusus").on("change", function () {
                var ketentuan = $(this).val();
                let index = $(this).find(":selected").data("id");
                if (
                    value_data.properties[index]["Ketentuan Perizinan"] !==
                    "TIDAK BERLAKU"
                ) {
                    getKetentuanKhusus(subzona, psl, kegiatan, ketentuan);
                }
            });
            if (
                value_data.properties[0]["Ketentuan Perizinan"] !==
                "TIDAK BERLAKU"
            ) {
                $("#selectKhusus")
                    .val(value_data.properties[0]["Jenis Ketentuan Khusus"])
                    .trigger("change");
            }
        },
    });
};

const getKetentuanKhusus = (subzona, psl, kegiatan, ketentuan) => {
    $.ajax({
        url: `${url_api}/khusus3`,
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            subzona: subzona,
            psl: psl,
            kegiatan: kegiatan,
            ketentuan: ketentuan,
        },
        success: (e) => {
            let data = JSON.parse(e);
            let value_data = data.features[0].properties[0];
            let html = "";
            // console.log(value_data);
            let kdb_maksimal =
                value_data["KDB Maksimal"] !== "TIDAK DIATUR"
                    ? `${value_data["KDB Maksimal"] * 100}%`
                    : value_data["KDB Maksimal"];
            html += `

            <div class="d-flex space_text row_mid_text">
                <div class="col-lg-5 text_all">
                    <label class="text_all_mobile">KB Maksimal</label>
                </div>
                <div class="col-lg-7 text_all">
                    <p>${value_data["KB Maksimal"]}</p>
                </div>
            </div>

            <div class="d-flex space_text row_mid_text">
                <div class="col-lg-5 text_all">
                    <label class="text_all_mobile">KDB Maksimal</label>
                </div>
                <div class="col-lg-7 text_all">
                    <p>${kdb_maksimal}</p>
                </div>
            </div>

            <div class="d-flex space_text row_mid_text">
                <div class="col-lg-5 text_all">
                    <label class="text_all_mobile">KLB Maksimal</label>
                </div>
                <div class="col-lg-7 text_all">
                    <p>${value_data["KLB Maksimal"]}</p>
                </div>
            </div>

            <div class="d-flex space_text row_mid_text">
                <div class="col-lg-5 text_all">
                    <label class="text_all_mobile">Luas Lahan Minimal</label>
                </div>
                <div class="col-lg-7 text_all">
                    <p>${value_data["Luas Lahan Minimal"]}</p>
                </div>
            </div>

            <div class="d-flex space_text row_mid_text">
                <div class="col-lg-5 text_all">
                    <label class="text_all_mobile">Syarat Lainnya</label>
                </div>
                <div class="col-lg-7 text_all">
                    <p>${value_data["Syarat Lainnya"]}</p>
                </div>
            </div>
                `;
            $(".isi-ketentuan-khusus").html("");
            $(".isi-ketentuan-khusus").html(html);
            // if (value_data !== null) {
            //     for (let index = 0; index < value_data.length; index++) {
            //         html += `<option value="${value_data[index]["Ketentuan Khusus"]}">${value_data[index]["Ketentuan Khusus"]}</option>`;
            //     }
            // } else {
            //     // htmlKetentuan += `<p>Tidak Ketentuan Khusus</p>`;
            //     html += "<option>Tidak Ada Ketentuan</option>";
            // }
            // $("#selectKhususKetentuan").html("");
            // $("#selectKhususKetentuan").html(html);
            // $("#selectKhususKetentuan").on("change", function () {
            //     var ketentuan = $(this).val();
            //     getKetentuanKhusus(subzona, psl, kegiatan, ketentuan);
            // });
        },
    });
};

// --- Intensitas New (Tata Bangunan) ---//
const getKetentuanTataBangunan = (subzona = sub_zona_any) => {
    $.ajax({
        url: `${url_api}/ketentuan_tata_bangunan`,
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            subzona: subzona,
        },
        dataType: "json",
        success: (e) => {
            const { gsj, gsp, gss, gska } = e.features[0].properties;

            // --- GSP --- //
            $(".inf-besaran-gsp").html(gsp[0].gsp_besaran_gsb);
            $(".inf-keterangan-gsp").html(gsp[0].gsp_keterangan);

            // --- GSKA --- //
            $(".inf-besaran-gska").html(gska[0].gska_besaran_gsb);
            $(".inf-keterangan-gska").html(gska[0].gska_keterangan);

            // --- GSS --- //
            let htmlGSS = "";
            htmlGSS += `<option value="">Pilih Lebar Jalan GSS</option>`;
            gss.forEach(({ gss_lebar_sungai, gss_fungsi_bangunan }) => {
                htmlGSS += `<option value="${btoa(
                    JSON.stringify(gss_fungsi_bangunan)
                )}">${gss_lebar_sungai} Meter</option>`;
            });

            $(".list-lebar-sungai").html("");
            $(".list-lebar-sungai").html(htmlGSS);

            $(".list-lebar-sungai").on("change", (e) => {
                if (e.target.value == "") {
                    $(".list-fungsi-bangunan").html(
                        "<option value=''>Pilih Fungsi Bangunan</option>"
                    );
                    $(".inf-besaran-gss").html("-");
                    $(".inf-keterangan-gss").html("-");
                } else {
                    let value = JSON.parse(atob($(e.target).val()));
                    let html = "";
                    html += `<option value="">Pilih Fungsi Bangunan</option>`;
                    value.forEach(({ detail, fungsi_bangunan }) => {
                        html += `<option value="${btoa(
                            JSON.stringify(detail[0])
                        )}">${fungsi_bangunan}</option>`;
                    });

                    $(".list-fungsi-bangunan").html("");
                    $(".list-fungsi-bangunan").html(html);
                }

                $(".list-fungsi-bangunan").on("change", (e) => {
                    if (e.target.value == "") {
                        $(".inf-besaran-gss").html("-");
                        $(".inf-keterangan-gss").html("-");
                    } else {
                        const { gss_besaran_gsb, gss_keterangan } = JSON.parse(
                            atob($(e.target).val())
                        );

                        $(".inf-besaran-gss").html(gss_besaran_gsb);
                        $(".inf-keterangan-gss").html(gss_keterangan);
                    }
                });
            });

            // --- GSJ --- //
            let htmlGSJ = "";
            htmlGSJ += `<option value="">Pilih Lebar Jalan GSJ</option>`;
            gsj.forEach(
                ({ gsj_lebar_jalan, gsj_besaran_gsb, gsj_keterangan }) => {
                    htmlGSJ += `<option value="${
                        btoa(gsj_lebar_jalan) +
                        "-" +
                        btoa(gsj_besaran_gsb) +
                        "-" +
                        btoa(gsj_keterangan)
                    }">${gsj_lebar_jalan}</option>`;
                }
            );

            $(".list-lebar-jalan").html("");
            $(".list-lebar-jalan").html(htmlGSJ);

            $(".list-lebar-jalan").on("change", (e) => {
                if (e.target.value == "") {
                    $(".inf-besaran-gsj").html("-");
                    $(".inf-keterangan-gsj").html("-");
                } else {
                    let value = $(e.target).val().split("-");
                    $(".inf-besaran-gsj").html(atob(value[1]));
                    $(".inf-keterangan-gsj").html(atob(value[2]));
                }
            });
        },
    });
};

// --- Intensitas New (Ketentuan Hunian) ---//
const getKetentuanHunian = (subzona = sub_zona_any) => {
    $.ajax({
        url: `${url_api}/hunian`,
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            sub_zona: subzona,
        },
        dataType: "json",
        success: (e) => {
            const { jenis_bangunan } = e.features[0].properties;

            let html = "";
            html += `<option>Pilih Jenis Bangunan</option>`;
            jenis_bangunan.forEach(({ bangunan, detail }) => {
                html += `<option value="${btoa(
                    JSON.stringify(detail)
                )}">${bangunan}</option>`;
            });

            $("#list-jenis-bangunan").html("");
            $("#list-jenis-bangunan").html(html);

            // --- Get List Tipikal --- //
            $("#list-jenis-bangunan").on("change", (e) => {
                if (e.target.value == "Pilih Jenis Bangunan") {
                    $("#list-tipikal").html("<option>Pilih Tipikal</option>");
                    $("#list-luas-lahan").html(
                        "<option>Pilih Luas Lahan</option>"
                    );
                    $(".inf-hunian-kdb").html("-");
                    $(".inf-hunian-kdh").html("-");
                    $(".inf-hunian-klb").html("-");
                    $(".inf-hunian-ktb").html("-");
                    $(".inf-hunian-ketinggian-bangunan").html("-");
                    $(".inf-hunian-list-ketentuan").html("");
                } else {
                    const { tipikal } = JSON.parse(atob($(e.target).val()));
                    let html = "";

                    html += `<option>Pilih Tipikal</option>`;
                    tipikal.forEach(({ jenis }) => {
                        html += `<option ="${jenis}">${jenis}</option>`;
                    });

                    $("#list-tipikal").html("");
                    $("#list-tipikal").html(html);

                    // --- Get List Luas Lahan --- //
                    $("#list-tipikal").on("change", (e) => {
                        if (e.target.value == "Pilih Tipikal") {
                            $("#list-luas-lahan").html(
                                "<option>Pilih Luas Lahan</option>"
                            );
                            $(".inf-hunian-kdb").html("-");
                            $(".inf-hunian-kdh").html("-");
                            $(".inf-hunian-klb").html("-");
                            $(".inf-hunian-ktb").html("-");
                            $(".inf-hunian-ketinggian-bangunan").html("-");
                            $(".inf-hunian-list-ketentuan").html("");
                        } else {
                            getDetailKetentuanHunian();
                        }
                    });
                }
            });
        },
    });
};

// --- Intensitas New (Ketentuan Variansi) ---//
const getKetentuanVariansi = (subzona = sub_zona_any) => {
    $.ajax({
        url: `${url_api}/variansi`,
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            sub_zona: subzona,
        },
        dataType: "json",
        success: (e) => {
            const { jenis_bangunan } = e.features[0].properties;

            let html = "";
            html += `<option>Pilih Jenis Bangunan</option>`;
            jenis_bangunan.forEach(({ bangunan, detail }) => {
                html += `<option value="${btoa(
                    JSON.stringify(detail)
                )}">${bangunan}</option>`;
            });

            $("#list-jenis-bangunan-variansi").html("");
            $("#list-jenis-bangunan-variansi").html(html);

            // --- Get List Tipikal --- //
            $("#list-jenis-bangunan-variansi").on("change", (e) => {
                if (e.target.value == "Pilih Jenis Bangunan") {
                    $(".inf-variansi-list-ketentuan").html("");
                    $(".inf-variansi-jenis-variansi").html("-");
                    $(".inf-variansi-fungsi-bangunan").html("-");
                    $(".inf-variansi-ketentuan-perizinan").html("-");
                } else {
                    const {
                        jenis_variansi,
                        fungsi_bangunan,
                        ketentuan_perizinan,
                    } = JSON.parse(atob($(e.target).val()));
                    let list_ketentuan = JSON.parse(atob($(e.target).val()));
                    let element_list_ketentuan = "";

                    $(".inf-variansi-jenis-variansi").html(jenis_variansi);
                    $(".inf-variansi-fungsi-bangunan").html(fungsi_bangunan);
                    $(".inf-variansi-ketentuan-perizinan").html(
                        ketentuan_perizinan
                    );

                    for (let index = 1; index <= 9; index++) {
                        if (list_ketentuan[`ketentuan_${index}`] !== null) {
                            element_list_ketentuan += `<li style="margin-left:-25px;">${
                                list_ketentuan[`ketentuan_${index}`]
                            }</li>`;
                        }
                    }

                    $(".inf-variansi-list-ketentuan").html("");
                    $(".inf-variansi-list-ketentuan").html(
                        element_list_ketentuan
                    );
                }
            });
        },
    });
};

const getDetailKetentuanHunian = () => {
    let bangunan = $("#list-jenis-bangunan").find(":selected").text();
    let tipikal = $("#list-tipikal").val();
    const { lngLat } = setAttrClick;

    $.ajax({
        url: `${url_api}/hunian`,
        method: "PUT",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            jenis_bangunan: bangunan,
            tipikal: tipikal,
            sub_zona: sub_zona_any,
            lng: lngLat.lng,
            lat: lngLat.lat,
        },
        dataType: "json",
        success: (e) => {
            const { luas_lahan_perencanaan } = e.features[0].properties;

            let html = "";
            html += `<option>Pilih Luas Lahan</option>`;
            luas_lahan_perencanaan.forEach(({ luas_lahan, detail }) => {
                html += `<option value="${btoa(
                    JSON.stringify(detail)
                )}">${luas_lahan}</option>`;
            });

            $("#list-luas-lahan").html("");
            $("#list-luas-lahan").html(html);

            // --- Get List Luas Lahan --- //
            $("#list-luas-lahan").on("change", (e) => {
                if (e.target.value == "Pilih Luas Lahan") {
                    $(".inf-hunian-kdb").html("-");
                    $(".inf-hunian-kdh").html("-");
                    $(".inf-hunian-klb").html("-");
                    $(".inf-hunian-ktb").html("-");
                    $(".inf-hunian-ketinggian-bangunan").html("-");
                    $(".inf-hunian-list-ketentuan").html("");
                } else {
                    const { kdb, kdh, klb, ktb, ketinggian_bangunan } =
                        JSON.parse(atob($(e.target).val()));
                    let list_ketentuan = JSON.parse(atob($(e.target).val()));
                    $(".inf-hunian-kdb").html(kdb);
                    $(".inf-hunian-kdh").html(kdh);
                    $(".inf-hunian-klb").html(klb);
                    $(".inf-hunian-ktb").html(ktb);
                    $(".inf-hunian-ketinggian-bangunan").html(
                        ketinggian_bangunan
                    );

                    let list_ketentuan_component = "";

                    for (let index = 1; index <= 15; index++) {
                        const element = list_ketentuan[`ketentuan_${index}`];

                        if (element !== "-") {
                            list_ketentuan_component += `<li style="margin-left:-25px;">${element}</li>`;
                        }
                    }

                    $(".inf-hunian-list-ketentuan").html("");
                    $(".inf-hunian-list-ketentuan").html(
                        list_ketentuan_component
                    );
                }
            });
        },
    });
};

//Check Zoning Loaded
const zoning_loaded = (e) => {
    if (iddle_zoning == false) {
        let lngLat;
        if ($(".mapboxgl-ctrl-geolocate-active").length) {
            lngLat = map.getCenter();
        } else {
            lngLat = marker.getLngLat();
        }
        iddle_zoning = true;
        map.fire("click", {
            lngLat: lngLat,
            point: map.project(lngLat),
        });
    }
};

map.on("idle", "zoning_fill", zoning_loaded);
map.on("idle", "zoning_old_fill", zoning_loaded);

//Check Wilayah Loaded
const wilayah_loaded = (e) => {
    if (iddle_wilayah == false && $("#rdtr").prop("checked") == false) {
        let lngLat;
        if ($(".mapboxgl-ctrl-geolocate-active").length) {
            lngLat = map.getCenter();
        } else {
            lngLat = marker.getLngLat();
        }

        iddle_wilayah = true;
        map.fire("click", {
            lngLat: lngLat,
            point: map.project(lngLat),
        });
    }
};

map.on("idle", "wilayah_fill", wilayah_loaded);

//Detail Info Layer Attribute

//Get Data RT/RW
const getRTRW = (e) => {
    $.ajax({
        url: `${url_api}/rtrw`,
        method: "PUT",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        dataType: "json",
        success: function (e) {
            $(".inf-rtrw").html(
                e.features[0].properties.RT + "/" + e.features[0].properties.RW
            );
        },
    });
};

//Get Data Persil BPN
const getPersilBPN = (e) => {
    $.ajax({
        url: `${url_api}/bpn`,
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        beforeSend: () => {
            // $('.map-loading').show()
        },
        success: (dt) => {
            const dtResp = JSON.parse(dt);
            if (dtResp.features != null) {
                const prop = dtResp.features[0].properties;
                luasSimulasi = prop.Luas;
                $(".inf-tipehak").html(prop.Tipe);
                $(".inf-luasbpn").html(separatorNum(prop.Luas) + " m&sup2;");
                $(".inf-simulasi-luaslahan").html(
                    separatorNum(prop.Luas) + " m&sup2;"
                );

                //Potensi
                luasPotensi = prop.Luas;

                //Check From Measure Area
                // if (!map.getSource("area")) {
                //     $(".inf-potensi-luas-lahan").val(
                //         separatorNum(luasPotensi).replaceAll(",", ".")
                //     );
                //     potensi();
                // }
            } else {
                $(".inf-tipehak").html("-");
                $(".inf-luasbpn").html("-");
            }
        },
        error: (error) => {
            console.log(error);
        },
        complete: (e) => {
            // $('.map-loading').hide()
        },
    });
};

//Get Data Sanitasi
const getSanitasi = (e) => {
    $.ajax({
        url: `${url_api}/sanitasi`,
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        success: (dt) => {
            const data = JSON.parse(dt);
            $(".inf-sanitasi").html("");
            $(".inf-sanitasi").html(data.features[0].properties.Sistem);
        },
    });
};

//Get Data Air Tanah
const getAirTanah = (e) => {
    $.ajax({
        url: `${url_api}/air`,
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            lng: e.lngLat.lng,
            lat: e.lngLat.lat,
        },
        success: (e) => {
            const data = JSON.parse(e);
            let value_data = data.features;
            let html = "";

            for (let index = 0; index < value_data.length; index++) {
                html += `
                <p class="card-title mt-2 mb-4 text-center font-weight-bold judul_utama">Air Tanah Kedalaman ${value_data[
                    index
                ].properties.Kedalaman.slice(0, -5)} meter MBT
                </p>
                <div class="d-flex space_text row_mid_text">
                    <div class="col-lg-5 text_all">
                        <label class="text_all_mobile">Air Tanah</label>
                    </div>
                    <div class="col-lg-7 text_all">
                        <p>${value_data[index].properties["Air Tanah"]}</p>
                    </div>
                </div>

                <div class="d-flex space_text row_mid_text">
                    <div class="col-lg-5 text_all">
                        <label class="text_all_mobile">Penggunaan</label>
                    </div>
                    <div class="col-lg-7 text_all">
                        <p>${value_data[index].properties.Penggunaan}</p>
                    </div>
                </div>
                `;
            }

            $(".inf-air-tanah").html("");
            $(".inf-air-tanah").html(html);
        },
    });
};

//Get Penurunan Tanah
const getPenuruanAirTanah = (e) => {
    $.ajax({
        url: `${url_api}/turun`,
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        success: (dt) => {
            const data = JSON.parse(dt);
            let jumlah = data.features[0].properties.Elevation;
            let fix_jumlah = jumlah * -100;
            $(".inf-p-air-tanah").html("");
            $(".inf-p-air-tanah").html(`${fix_jumlah} cm/tahun`);
        },
    });
};

//Get Data NJOP
const getNJOP = (e) => {
    $.ajax({
        url: `${url_api}/njop`,
        method: "POST",
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        headers: {
            Authorization: `Bearer ${token}`,
        },
        success: function (dt) {
            const dtResp = JSON.parse(dt);
            const prop = dtResp.features[0].properties;
            NJOP = prop.Max;
            avgNJOP = (parseInt(prop.Min) + parseInt(prop.Max)) / 2;
            $(".inf-potensi-perkiraan-njop").val(
                separatorNum(avgNJOP).replaceAll(",", ".")
            );
            potensi();

            if (dtResp.features != null) {
                $(".inf-harganjop").html(
                    `Rp ${separatorNum(prop.Min)} - Rp ${separatorNum(
                        prop.Max
                    )} per m&sup2;`
                );
                $(".inf-simulasi-njop").html(
                    `Rp ${separatorNum(prop.Min)} - Rp ${separatorNum(
                        prop.Max
                    )} per m&sup2;`
                );
            }

            hrg_min = separatorNum(prop.Min);
            hrg_max = separatorNum(prop.Max);

            harga = `
            <div class="col-sm-8">Rp. ${hrg_min} - Rp. ${hrg_max} per meter persegi</div>
            </div>
          </div>
            `;
        },
        error: function (error) {
            console.log(error);
        },
        complete: function (e) {
            // $('.map-loading').hide()
        },
    });
};

const getMeanNJOP = (kelurahan) => {
    $.ajax({
        url: `${url_api}/njop`,
        method: "PUT",
        data: {
            kelurahan: kelurahan,
        },
        headers: {
            Authorization: `Bearer ${token}`,
        },
        dataType: "json",
        success: (res) => {
            const { Mean } = res.features[0].properties;

            $(".inf-reratanjop").html(`Rp ${separatorNum(Mean)} per m&sup2`);
        },
    });
};

//Get Kawasan Rawan Bencana
const getKRB = (e) => {
    $.ajax({
        url: `${url_api}/kawasan_rawan_bencana`,
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        success: function (dt) {
            const dtResp = JSON.parse(dt);
            if (dtResp.features != null) {
                $(".inf-kawasan-rawan-bencana").show();
                const prop = dtResp.features[0].properties;
                $(".inf-jenis-kawasan-rawan-bencana").html(
                    prop.kawasan_rawan_bencana
                );
            } else {
                $(".inf-kawasan-rawan-bencana").hide();
            }
        },
        error: function (error) {
            $(".inf-kawasan-rawan-bencana").hide();
        },
    });
};

//Get Ketentuan Kawasan Rawan Bencana
const getKetentuanKRB = (e) => {
    $.ajax({
        url: `${url_api}/rawan_bencana`,
        method: "PUT",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        success: (res) => {
            const { features } = JSON.parse(res);
            if (features != null) {
                $(".section_ketentuan_rawan_bencana").show();

                let option = "";

                let ketentuan = {
                    kawasan_rawan_banjir: [
                        "pemanfaatan ground level pada Lahan tidak dijadikan aktivitas utama dan tidak berdinding dikecualikan untuk fungsi mekanikal elektrikal",
                        "untuk bangunan yang sudah terbangun dapat melakukan modifikasi seperti kolam retensi, kolam detensi dan lainnya agar tidak terdampak banjir dengan tetap memperhatikan keandalan bangunan",
                        "menerapkan sistem dan teknologi yang handal terhadap banjir pada Lahan dan bangunan",
                        "pelarangan penggunaan air tanah",
                        "pelarangan peninggian pekarangan",
                        "tidak diperbolehkan melakukan pengurukan pekarangan melebihi 1,2 (satu koma dua) meter terhadap Jalan",
                        "penggunaan bahan penutup Lahan yang menyerap air",
                        "pembuatan sumur resapan dengan kapasitas volume berdasarkan luas tutupan Lahan",
                        "menerapkan prinsip Zero delta Q atau Zero run off",
                    ],
                    kawasan_penurunan_muka_tanah: [
                        "Ketentuan berlaku untuk Bangunan dengan  luas lantai 5.000 (lima ribu) meter persegi atau lebih; dan /atau jumlah lantai lebih dari 4 lantai",
                        "membuat sumur resapan atau kolam resapan dua kali ketentuan yang dipersyaratkan",
                        "perkerasan dalam LP terbuat dari bahan yang dapat meresap air",
                        "pelarangan pengambilan air tanah untuk kebutuhan sehari - hari",
                        "mempertimbangkan kajian geologi teknik dalam pembangunan",
                        "menerapkan prinsip ZC713 delta Q atau Zero run off",
                    ],
                };

                features.forEach(({ properties }) => {
                    option += `
                        <option value="${btoa(JSON.stringify(properties))}">${
                        properties.bencana
                    }</option>
                    `;
                });

                $(".inf-ketentuan-rawan-bencana-list").html(option);

                $(".inf-ketentuan-rawan-bencana-list").on("change", () => {
                    const { bencana, resiko } = JSON.parse(
                        atob($(".inf-ketentuan-rawan-bencana-list").val())
                    );

                    $(".inf-ketentuan-rawan-bencana-nama-kawasan").html(
                        bencana
                    );
                    $(".inf-ketentuan-rawan-bencana-resiko-kawasan").html(
                        resiko
                    );

                    let list = "";
                    ketentuan[
                        bencana.toLowerCase().replaceAll(" ", "_")
                    ].forEach((item) => {
                        list += `<li style="margin-left: -1.5rem;">${item}</li>`;
                    });

                    $(".inf-ketentuan-rawan-bencana-list-ketentuan").html(`
                    <div class="d-flex space_text row_mid_text mb-2">
                        <div class="col-lg-12 text_all">
                            <ol class="list-ketentuan-rawan-bencana">
                                ${list}
                            </ol>
                        </div>
                    </div>
                    `);
                });

                $(".inf-ketentuan-rawan-bencana-list").trigger("change");
            } else {
                $(".section_ketentuan_rawan_bencana").hide();
                $(".inf-ketentuan-rawan-bencana-nama-kawasan").html("-");
                $(".inf-ketentuan-rawan-bencana-resiko-kawasan").html("-");
                $(".inf-ketentuan-rawan-bencana-list").html("-");
            }
        },
        error: (error) => {
            $(".section_ketentuan_rawan_bencana").hide();
            $(".inf-ketentuan-rawan-bencana-nama-kawasan").html("-");
            $(".inf-ketentuan-rawan-bencana-resiko-kawasan").html("-");
            $(".inf-ketentuan-rawan-bencana-list").html("-");
        },
    });
};

//Get Data Eksisting
const getEksisting = (e) => {
    $.ajax({
        url: `${url_api}/eksisting`,
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        success: function (dt) {
            const dtResp = JSON.parse(dt);
            if (dtResp.features != null) {
                const prop = dtResp.features[0].properties;
                $(".inf-eksisting").html(titleCase(prop.Kegiatan));

                eksisting = `
                  <div class="col-sm-12">
                  <div class="row">
                        <div class="col-sm-12 font-weight-bold">Persil Tanah</div>
                        <div class="col-sm-4">Lahan Eksisting</div>
                        <div class="col-sm-8">${titleCase(prop.Kegiatan)}</div>
                      </div>
                    </div>
                    </tbody>
                  </table>
                  `;
            }
        },
        error: function (error) {
            // console.log(error);
        },
        complete: function (e) {
            // $('.map-loading').hide()
        },
    });
};

//Get Data Radius
const getRadius = (e) => {
    let getRadVal = $("#ControlRange").val();
    $.ajax({
        url: `${url_api}/poi`,
        method: "PUT",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
            rad: getRadVal,
        },
        success: (dt) => {
            let dtResp = JSON.parse(dt);
            let htmlContent = "";

            fasilitas = `
            <div class="col-sm-12 mt-4 mb-5">
            <div class="row">
                <div class="col-sm-12 font-weight-bold">Fasilitas Dalam Radius ${
                    getRadVal / 1000
                } Km
                </div>
            `;

            cat = [];

            for (let i in dtResp.features) {
                const dtpar = dtResp.features[i];
                const props = dtpar.properties;
                cat.push({
                    name: props.Kategori,
                    fasilitas: props.Name,
                    jarak: props.Distance,
                });
            }

            const groupBy = (collection, property) => {
                let i = 0,
                    val,
                    index,
                    values = [],
                    result = [];
                for (let i = 0; i < collection.length; i++) {
                    val = collection[i][property];
                    index = values.indexOf(val);
                    if (index > -1) result[index].push(collection[i]);
                    else {
                        values.push(val);
                        result.push([collection[i]]);
                    }
                }
                return result;
            };

            let obj = groupBy(cat, "name");
            let poi = {};
            let name_poi = [];
            for (let as in obj) {
                const dt = obj[as];
                // console.log(dt);
                htmlContent += `
                    <div class="row row_mid_judul2">
                    <div class="col-md-12 flex-column">
                        <button type="button"
                            class="btn btn-md btn-block text-left text_all text_poi1 tombol_search"
                            data-toggle="collapse" data-target="#${dt[0].name}" aria-expanded="true"
                            aria-controls="collapsePoiOne">
                            <b class="text_all_mobile">${dt[0].name}</b>
                        </button>
                    </div>
                    </div>
                    <div id="${dt[0].name}" class="collapse show" aria-labelledby="headingOne" data-parent="#PoiCollabse">
                        <div class="card-body text_poi2 row_mid_judul">
                            <ul class="list-group list-group-flush PoiCollabse_mobile">
                `;
                fasilitas += `
                <div class="col-sm-4">${dt[0].name}</div>
                <div class="col-sm-8">
                `;

                Object.assign(poi, { [dt[0].name]: [] });
                name_poi.push(dt[0].name);

                for (let az in dt) {
                    const dta = dt[az];
                    poi[dt[0].name].push({
                        fasilitas: dta.fasilitas,
                        jarak: Math.round(dta.jarak) / 1000,
                    });
                    htmlContent += `
                    <li style="list-style:none" class="listgroup-cust align-items-center text_all">
                        <div class="row">
                            <div class="col-md-8 text_all">
                            ${dta.fasilitas}
                            </div>
                            <div class="col-md-4 text-right">
                            <span>${Math.round(dta.jarak) / 1000} km</span>
                            </div>
                        </div>
                    </li>
                    `;

                    fasilitas += `
                    <div class="row">
                        <div class="col-sm-8">${dta.fasilitas}</div>
                        <div class="col-sm-4">${
                            Math.round(dta.jarak) / 1000
                        } km</div>
                    </div>
          `;
                    // console.log(dta.fasilitas, dta.jarak);
                }

                htmlContent += `</ul>
                </div>
            </div>`;
                fasilitas += `</div>`;
            }
            // console.log(poi);
            $.post(`${APP_URL}/save_poi`, {
                poi: getRadVal,
            }).done(() => {
                console.log("Radius Poi Saved");
            });

            $(".tabListFasilitas").html(htmlContent);

            if ($("#poi-tab.active").length) {
                if (map.getLayer("poi-dot")) {
                    map.removeLayer("poi-dot");
                    map.removeSource("poi");
                }

                map.addSource("poi", {
                    type: "geojson",
                    data: dtResp,
                });

                map.addLayer({
                    id: "poi-dot",
                    type: "symbol",
                    source: "poi",
                    layout: {
                        "icon-image": ["get", "Icon"],
                        "icon-size": 1,
                        "icon-allow-overlap": true,
                        "icon-ignore-placement": true,
                        "icon-optional": true,
                        "icon-rotation-alignment": "map",
                        "icon-rotate": 0,
                        "icon-padding": 0,
                        "icon-keep-upright": false,
                        "icon-offset": [0, 0],
                        "icon-anchor": "center",
                        "icon-pitch-alignment": "map",
                    },
                });
            }
        },
        error: (error) => {
            // console.log(error);
        },
        complete: (e) => {
            // $('.map-loading').hide()
        },
    });
};

$(
    "#lokasi-tab, #ketentuan-tab, #kbli-tab, #cetak-tab, #simulasi-tab, #btnSHP, #simio-tab, #polygonDraw, #index-tab, #andalalin-tab"
).on("click", () => {
    if (map.getLayer("poi-dot")) {
        map.removeLayer("poi-dot");
        map.removeSource("poi");
    }
});

$("#poi-tab").on("click", () => {
    getRadius(setAttrClick);
});

// Interactive Layer POI
map.on("mouseenter", "poi-dot", (e) => {
    map.getCanvas().style.cursor = "pointer";
    let dt = e.features[0].properties;
    let coordinates = e.features[0].geometry.coordinates.slice();
    let html = `
    <div class="card">
    <div class="card-body p-2">
      <h6 class="mt-0 mb-2">${dt["Name"]}</h6>
      <span class="d-block" style="width: 300px">${
          Math.round(dt["Distance"]) / 1000
      } km</span>
    </div>
    `;

    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }

    popup.setLngLat(coordinates).setHTML(html).addTo(map);
});

map.on("mouseleave", "poi-dot", () => {
    map.getCanvas().style.cursor = "";
    popup.remove();
});

//Get Data Index
const getIndex = (e) => {
    $.ajax({
        url: `${url_api}/ddl`,
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        dataType: "json",
        success: (dt) => {
            const { detail, score_all, score, kategori } =
                dt.features[0].properties;

            //Create Radar Chart
            let chart_radar = $("#radar-chart").get(0).getContext("2d");

            if (radar !== undefined) {
                radar.destroy();
            }

            radar = new Chart(chart_radar, {
                type: "radar",
                data: {
                    labels: [
                        "Topografi",
                        "Kebencanaan",
                        "Ketersediaan Air",
                        "Kualitas Vegetasi",
                        "Pengelolaan Limbah",
                    ],
                    datasets: [
                        {
                            label: " ",
                            data: [
                                score[0].topografi,
                                score[0].kebencanaan,
                                score[0].ketersediaan_air,
                                score[0].kualitas_vegetasi,
                                score[0].pengolahan_limbah,
                            ],
                            fill: true,
                            backgroundColor: "rgba(255, 99, 132, 0.2)",
                            borderColor: "rgb(255, 99, 132)",
                            pointBackgroundColor: "rgb(255, 99, 132)",
                            pointBorderColor: "#fff",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "rgb(255, 99, 132)",
                        },
                    ],
                },
                options: {
                    elements: {
                        line: {
                            borderWidth: 3,
                        },
                    },
                    legend: {
                        display: false,
                    },
                },
            });

            //Show Info
            $(".inf-index-eci").html(kategori);
            $(".inf-index-score").html(`<b>${score_all.toFixed(2)}</b> / 5.00`);
            $(".inf-index-topografi").html(detail[0].topografi);
            $(".inf-index-risk-banjir").html(detail[0].risk_banjir);
            $(".inf-index-risk-landsub").html(detail[0].risk_landsub);
            $(".inf-index-risk-kebakaran").html(detail[0].risk_kebakaran);
            $(".inf-index-air-tanah").html(detail[0].air_tanah);
            $(".inf-index-pipa-air").html(detail[0].pipa_air);
            $(".inf-index-kualitas-vegetasi").html(detail[0].kualitas_vegetasi);
            $(".inf-index-jaringan-ipal").html(detail[0].jaringan_ipal);
            $(".inf-index-ket-tps").html(detail[0].ket_tps);
        },
    });
};

//Get Live Ability Index
const getLiveAbilityIndex = (e) => {
    $.ajax({
        url: `${url_api}/liveability`,
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        dataType: "json",
        success: (dt) => {
            const {
                livability,
                budaya,
                fasilitas,
                indeks_kon,
                pekerjaan,
                entropy,
                pelayanan,
                pendidikan,
                ruang_terbuka,
                transportasi,
                deskripsi,
            } = dt.features[0].properties;

            //Create Radar Chart
            let chart_radar_liveability = $("#radar-chart-liveability")
                .get(0)
                .getContext("2d");

            if (radar_liveability !== undefined) {
                radar_liveability.destroy();
            }

            radar_liveability = new Chart(chart_radar_liveability, {
                type: "radar",
                data: {
                    labels: [
                        ["Konektivitas", "Pejalan Kaki"],
                        "Ruang Terbuka dan Publik",
                        "Fasilitas Komunitas",
                        "Aktivitas Budaya Perkotaan",
                        "Lokasi Bekerja",
                        "Pelayanan Kesehatan",
                        "Pendidikan",
                        "Transportasi Publik",
                        "Campuran Guna Lahan",
                    ],
                    datasets: [
                        {
                            data: [
                                indeks_kon,
                                ruang_terbuka,
                                fasilitas,
                                budaya,
                                pekerjaan,
                                pelayanan,
                                pendidikan,
                                transportasi,
                                entropy,
                            ],
                            fill: true,
                            backgroundColor: "rgba(133, 99, 255, 0.2)",
                            borderColor: "rgb(133, 99, 255)",
                            pointBackgroundColor: "rgb(133, 99, 255)",
                            pointBorderColor: "#fff",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "rgb(133, 99, 255)",
                        },
                    ],
                },
                options: {
                    elements: {
                        line: {
                            borderWidth: 3,
                        },
                    },
                    legend: {
                        display: false,
                    },
                    scale: {
                        ticks: {
                            beginAtZero: true,
                            max: 5,
                            min: 0,
                            stepSize: 1,
                        },
                    },
                },
            });

            //Show Info
            $(".inf-liveability-index").html(
                `<b>${Math.round(livability * 100) / 100}</b> / 9.00`
            );
            deskripsi.forEach(
                ({
                    indeks_kon,
                    ruang_terbuka,
                    fasilitas,
                    budaya,
                    pekerjaan,
                    pelayanan,
                    pendidikan,
                    transportasi,
                    entropy,
                    livability,
                }) => {
                    $(".inf-index-indeks_kon").html(indeks_kon);
                    $(".inf-index-ruang_terbuka").html(ruang_terbuka);
                    $(".inf-index-fasilitas").html(fasilitas);
                    $(".inf-index-budaya").html(budaya);
                    $(".inf-index-pekerjaan").html(pekerjaan);
                    $(".inf-index-pelayanan").html(pelayanan);
                    $(".inf-index-pendidikan").html(pendidikan);
                    $(".inf-index-transportasi").html(transportasi);
                    $(".inf-index-entropy").html(entropy);
                    $(".inf-index-livability-desc").html(livability);
                }
            );
        },
    });
};

//Get Urban Index
const getUrbanIndex = (e) => {
    $.ajax({
        url: `${url_api}/urban`,
        method: "PUT",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        dataType: "json",
        success: (dt) => {
            const { deskripsi_khusus, urbanindex, kategori_desk_umum } =
                dt.features[0].properties;

            //Split Deskripsi Khusus
            const split_deskripsi_khusus = deskripsi_khusus.split(", ");
            let html_deskripsi_khusus = "";
            split_deskripsi_khusus.forEach((v) => {
                html_deskripsi_khusus += `<li style="margin-left:-25px;">${v}</li>`;
            });

            //Fill Data
            $(".inf-urban-index").html(urbanindex);
            $(".inf-urban-deskripsi-khusus").html(html_deskripsi_khusus);
            $(".inf-urban-kategori-umum").html(kategori_desk_umum);
            // $(".inf-urban-j_jlnarter").html(j_jlnarter);
            // $(".inf-urban-j_jlnkolek").html(j_jlnkolek);
            // $(".inf-urban-j_jlnling").html(j_jlnling);
            // $(".inf-urban-j_ttktrnst").html(j_ttktrnst);
            // $(".inf-urban-jrk_mall").html(jrk_mall);
            // $(".inf-urban-jrk_mnmrkt").html(jrk_mnmrkt);
            // $(".inf-urban-jrk_pasar").html(jrk_pasar);
            // $(".inf-urban-mixed_use").html(mixed_use);
        },
    });

    $.ajax({
        url: `${url_api}/urban_ml`,
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            transect_zone: $("input[name='transect_zone']:checked")
                .val()
                .split("-")[0],
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        dataType: "json",
        success: (dt) => {
            const { label, kategori } = dt.features[0].properties;

            // Fill Data
            $(".inf-urban-index-ml").html(label);
            $(".inf-urban-kategori-umum-ml").html(`Kategori ${kategori}`);
        },
    });
};

// ---- KBLI NEW -----
//Get Bangunan KBLI
const getBangunanKBLI = (sub_zona) => {
    let html = "";
    $.ajax({
        url: `${url_api}/kbli`,
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            sub_zona: sub_zona,
        },
        dataType: "json",
        success: (dt) => {
            //Reset Dropdown
            $("#kegiatanRuangNew").html("");
            html += `<option>Pilih KBLI atau Kegiatan</option>`;

            const { features } = dt;
            features.forEach(({ properties }) => {
                const { kbli, itbx, link } = properties;
                html += `
                    <option value="${kbli}-${itbx}-${btoa(
                    link
                )}">${kbli}</option>
                `;
            });

            //Set Dropdown
            $("#kegiatanRuangNew").html(html);
        },
    });
};

//Get List KBLI
const getListBangunan = (
    sub_zona = sub_zona_any,
    kbli = $("#kegiatanRuangNew").select2("val").split("-")[0] +
        "-" +
        $("#kegiatanRuangNew").select2("val").split("-")[1]
) => {
    let html = "";
    $.ajax({
        url: `${url_api}/kbli_bangunan`,
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            sub_zona: sub_zona,
            kbli: kbli,
        },
        dataType: "json",
        success: (dt) => {
            //Reset Dropdown
            $("#kegiatan").html("");
            html += `<option>Pilih Bangunan</option>`;

            const { features } = dt;
            features.forEach(({ properties }) => {
                const { bangunan, itbx } = properties;
                html += `
                    <option value="${bangunan}-${itbx}">${bangunan}</option>
                `;
            });

            //Set Dropdown
            $("#kegiatan").html(html);
        },
    });
};

//Get List Kegiatan On Change Dropdown
$("#kegiatanRuangNew").on("change", (e) => {
    //reset ketentuan
    $(".kbli-ketentuan").html("-");

    let bangunan = $(e.target).select2("val").split("-");
    $(".inf-kbli").html(
        `<a href="${atob(bangunan[3])}" target="_blank">${bangunan[0]}</a>`
    );
    $(".inf-bangunan").html(bangunan[1]);
    $(".inf-itbx").html(bangunan[2]);
    getListBangunan();
    getJenisUsahaAmdal(bangunan[0]);
    resetAmdal();
});

//Get Ketentuan
const getKetentuanKBLI = (
    sub_zona = sub_zona_any,
    ketentuan_perizinan = $("#kegiatan").select2("val").split("-")[1],
    bangunan = $("#kegiatan").select2("val").split("-")[0]
) => {
    let kbli_properties = {
        kode: $(".inf-kbli").text(),
        kegiatan: $(".inf-bangunan").text(),
        rekomendasi_bangunan: $("#kegiatan").select2("val").split("-")[0],
        ketentuan: $("#kegiatan").select2("val").split("-")[1],
        link: atob($("#kegiatanRuangNew").select2("val").split("-")[3]),
    };
    if (ketentuan_perizinan == "Diizinkan") {
        $(".kbli-ketentuan").html("Diizinkan");

        //Save KBLI
        $.post(`${APP_URL}/save_kbli`, kbli_properties).done(() => {
            console.log("KBLI Saved");
        });
    } else {
        $.ajax({
            url: `${url_api}/kbli`,
            method: "PUT",
            headers: {
                Authorization: `Bearer ${token}`,
            },
            data: {
                sub_zona: sub_zona,
                ketentuan_perizinan: ketentuan_perizinan,
                bangunan: bangunan,
            },
            dataType: "json",
            success: (dt) => {
                //Reset Dropdown
                const data = dt.features[0].properties;

                let ketentuan = [
                    data.ketentuan_1,
                    data.ketentuan_2,
                    data.ketentuan_3,
                ];

                let html = "";
                ketentuan.forEach((v, i) => {
                    if (v !== "") {
                        html += `${i + 1}.${v}<br>`;
                    }
                });

                kbli_properties.ketentuan = html;

                $.post(`${APP_URL}/save_kbli`, kbli_properties).done(() => {
                    console.log("KBLI Saved");
                });

                $(".kbli-ketentuan").html(html);
            },
        });
    }
};

const kbliProperties = () => {
    let kbli_properties = {
        kode: $(".inf-kbli").text(),
        kegiatan: $(".inf-bangunan").text(),
        rekomendasi_bangunan:
            $("#kegiatan").select2("val") == null
                ? "-"
                : $("#kegiatan").select2("val").split("-")[0],
        ketentuan: $(".kbli-ketentuan").html(),
        link:
            $("#kegiatanRuangNew").select2("val").split("-")[3] == undefined
                ? "-"
                : atob($("#kegiatanRuangNew").select2("val").split("-")[3]),
    };

    return kbli_properties;
};
//Get List Kegiatan On Change Dropdown
$("#kegiatan").on("change", () => {
    getKetentuanKBLI();
});

// ---- KBLI OLD ----
const dropDownKegiatan = (subzona) => {
    $.ajax({
        url: `${url_api}/kbli1`,
        method: "POST",
        data: {
            subzona: subzona,
        },
        headers: {
            Authorization: `Bearer ${token}`,
        },
        dataType: "json",
        success: (e) => {
            $("#kegiatanRuang").html("");
            $("#skala").html("");
            $("#kegiatanKewenangan").html("");
            let htmlContent = "";
            $("#btn-print").hide();
            htmlContent += `<option>Pilih...</option>`;
            let data = e.features[0].properties;
            for (i in data) {
                // console.log(data[i]["Kegiatan Ruang"]);
                htmlContent += `<option class="text_all" value="${data[i]["Kegiatan Ruang"]}">${data[i]["Kegiatan Ruang"]}</option>`;
            }
            $("#kegiatanRuang").html(htmlContent);
        },
    });
};

const DropdownSkala = (zonasi, sel) => {
    let resHTML = "";
    $("#kegiatanKewenangan").html("");
    $.ajax({
        url: `${url_api}/kbli2`,
        method: "POST",
        headers: {
            Authorization: `Bearer ${token}`,
        },
        data: {
            subzona: zonasi,
            kegiatan: sel,
        },
        dataType: "json",
        success: (res) => {
            $("#btn-print").hide();
            if (res != null) {
                const prop = res.features[0].properties;
                let jmlh = [];
                resHTML += "<option>Pilih....</option>";
                resHTML += "<optgroup label='Modal'>";
                for (let i in prop) {
                    if (prop[i]["Skala"] == "MIKRO") {
                        jmlh[0] = {
                            skala: "MIKRO",
                            jmlh_modal: "< Rp 1 Milyar",
                            jml_omzet: "< Rp 2 Miliyar",
                        };
                    } else if (prop[i]["Skala"] == "KECIL") {
                        jmlh[1] = {
                            skala: "KECIL",
                            jmlh_modal: "Rp 1-5 Milyar",
                            jml_omzet: "Rp 2-15 Miliyar",
                        };
                    } else if (prop[i]["Skala"] == "MENENGAH") {
                        jmlh[2] = {
                            skala: "MENENGAH",
                            jmlh_modal: "Rp 5-10 Milyar",
                            jml_omzet: "Rp 15-50 Miliyar",
                        };
                    } else {
                        jmlh[3] = {
                            skala: "BESAR",
                            jmlh_modal: "> Rp 10 Milyar",
                            jml_omzet: "> Rp 50 Miliyar",
                        };
                    }
                    // resHTML += `<option value="${prop[i]["Skala"]}">${jmlh}</option>`;
                }

                for (let i in jmlh) {
                    resHTML += `<option value="${jmlh[i].skala}">${jmlh[i].jmlh_modal}</option>`;
                }
                resHTML += "</optgroup><optgroup label='Omzet'>";

                for (let i in jmlh) {
                    resHTML += `<option value="${jmlh[i].skala}">${jmlh[i].jml_omzet}</option>`;
                }

                resHTML += "</optgroup>";

                // console.log(jmlh);

                $("#skala").html(resHTML);
            }
        },
        error: (error) => {
            console.log(error);
            // alert('data tidak ada')
        },
    });
};

const dropDownKegiatanKewenangan = (zonasi, sel, skala) => {
    $.ajax({
        url: `${url_api}/kbli3`,
        method: "post",
        data: {
            subzona: zonasi,
            kegiatan: sel,
            skala: skala,
        },
        headers: {
            Authorization: `Bearer ${token}`,
        },
        dataType: "json",
        success: (res) => {
            let resHTML = "";
            if (res != null) {
                const prop = res.features[0].properties;
                data_kbli = res.features[0].properties;
                resHTML += "<option>Pilih....</option>";
                for (let i in prop) {
                    resHTML += `<option value="${i}" data-index="${i}">${prop[i]["Kegiatan"]}-${prop[i]["Kewenangan"]}</option>`;
                }

                $("#kegiatanKewenangan").html(resHTML);
            }
        },
        error: (error) => {
            console.log(error);
            // alert('data tidak ada')
        },
    });
};

const getJenisUsahaAmdal = (kbli) => {
    $.ajax({
        url: `${url_api}/jenis_usaha_klhk`,
        method: "post",
        data: {
            kbli: kbli,
        },
        headers: {
            Authorization: `Bearer ${token}`,
        },
        dataType: "json",
        success: (res) => {
            let resHTML = "";

            if (res.features[0].properties != null) {
                $("#amdal-section").show();
                const prop = res.features[0].properties;

                resHTML += "<option>Pilih....</option>";

                prop.forEach(({ jenis_usaha }) => {
                    resHTML += `<option value="${jenis_usaha}">${jenis_usaha}</option>`;
                });

                $("#jenisUsahaAmdal").html("");
                $("#jenisUsahaAmdal").html(resHTML);
            } else {
                $("#amdal-section").hide();
            }
        },
    });
};

$("#jenisUsahaAmdal").on("change", (e) => {
    let jenis_usaha = $(e.target).select2("val");
    let kbli = $("#kegiatanRuangNew").select2("val").split("-")[0];

    // Reset
    $("#indikatorA").html("");
    $("#parameterA").html("");
    $("#indikatorB").html("");
    $("#parameterB").html("");
    $(".inf-amdal-jenis-izin").html("-");
    $(".inf-amdal-kategori").html("-");
    $(".inf-amdal-alasan").html("-");

    getIndikatorAAmdal(kbli, jenis_usaha);
});

const getIndikatorAAmdal = (kbli, jenis_usaha) => {
    $.ajax({
        url: `${url_api}/indikator_a_klhk`,
        method: "post",
        data: {
            jenis_usaha: jenis_usaha,
            kbli: kbli,
        },
        headers: {
            Authorization: `Bearer ${token}`,
        },
        dataType: "json",
        success: (res) => {
            let indikator = "";

            if (res.features != null) {
                let prop = res.features[0].properties;
                console.log(prop);

                indikator += "<option>Pilih....</option>";

                for (let key in prop) {
                    indikator += `<option value="${btoa(
                        encodeURIComponent(JSON.stringify(prop[key]))
                    )}">${key}</option>`;
                }

                $("#indikatorA").html("");
                $("#indikatorA").html(indikator);
            }
        },
    });
};

$("#indikatorA").on("change", (e) => {
    // Reset
    $("#parameterA").html("");
    $("#indikatorB").html("");
    $("#parameterB").html("");
    $(".inf-amdal-jenis-izin").html("-");
    $(".inf-amdal-kategori").html("-");
    $(".inf-amdal-alasan").html("-");

    let value = JSON.parse(
        decodeURIComponent(atob($(e.target).select2("val")))
    );
    let html = "";

    html += "<option>Pilih....</option>";

    value.forEach((item) => {
        html += `<option value="${item}">${item}</option>`;
    });

    $("#parameterA").html("");
    $("#parameterA").html(html);
});

$("#parameterA").on("change", (e) => {
    // Reset
    $("#indikatorB").html("");
    $("#parameterB").html("");
    $(".inf-amdal-jenis-izin").html("-");
    $(".inf-amdal-kategori").html("-");
    $(".inf-amdal-alasan").html("-");

    let parameter_value = $(e.target).select2("val");
    let indikator_value = $("#indikatorA").select2("data")[0].text;
    let kbli = $("#kegiatanRuangNew").select2("val").split("-")[0];
    let jenis_usaha = $("#jenisUsahaAmdal").select2("val");

    getIndikatorBAmdal(kbli, jenis_usaha, indikator_value, parameter_value);
});

const getIndikatorBAmdal = (kbli, jenis_usaha, indikator_a, parameter_a) => {
    $.ajax({
        url: `${url_api}/indikator_b_klhk`,
        method: "post",
        data: {
            jenis_usaha: jenis_usaha,
            kbli: kbli,
            indikator_a: indikator_a,
            parameter_a: parameter_a,
        },
        headers: {
            Authorization: `Bearer ${token}`,
        },
        dataType: "json",
        success: (res) => {
            let prop = res.features[0].properties;
            let indikator = "";

            indikator += "<option>Pilih....</option>";

            for (let key in prop) {
                indikator += `<option value="${btoa(
                    encodeURIComponent(JSON.stringify(prop[key]))
                )}">${key}</option>`;
            }

            $("#indikatorB").html("");
            $("#indikatorB").html(indikator);
        },
    });
};

$("#indikatorB").on("change", (e) => {
    // Reset
    $("#parameterB").html("");
    $(".inf-amdal-jenis-izin").html("-");
    $(".inf-amdal-kategori").html("-");
    $(".inf-amdal-alasan").html("-");

    let indikator = JSON.parse(
        decodeURIComponent(atob($(e.target).select2("val")))
    );
    let html = "";

    html += "<option>Pilih....</option>";

    indikator.forEach((item) => {
        html += `<option value="${item}">${item}</option>`;
    });

    $("#parameterB").html("");
    $("#parameterB").html(html);
});

$("#parameterB").on("change", (e) => {
    // Reset
    $(".inf-amdal-jenis-izin").html("-");
    $(".inf-amdal-kategori").html("-");
    $(".inf-amdal-alasan").html("-");

    let parameter = $(e.target).select2("val");
    let indikator = $("#indikatorB").select2("data")[0].text;
    let parameter_a = $("#parameterA").select2("val");
    let indikator_a = $("#indikatorA").select2("data")[0].text;
    let kbli = $("#kegiatanRuangNew").select2("val").split("-")[0];
    let jenis_usaha = $("#jenisUsahaAmdal").select2("val");

    getKetentuanKLHK(
        kbli,
        jenis_usaha,
        indikator_a,
        parameter_a,
        indikator,
        parameter
    );
});

const getKetentuanKLHK = (
    kbli,
    jenis_usaha,
    indikator_a,
    parameter_a,
    indikator_b,
    parameter_b
) => {
    $.ajax({
        url: `${url_api}/klhk`,
        method: "post",
        data: {
            jenis_usaha: jenis_usaha,
            kbli: kbli,
            indikator_a: indikator_a,
            parameter_a: parameter_a,
            indikator_b: indikator_b,
            parameter_b: parameter_b,
        },
        headers: {
            Authorization: `Bearer ${token}`,
        },
        dataType: "json",
        success: (res) => {
            const {
                alasan_amdal,
                jenis_izin_lingkungan,
                kategori_amdal_ukl_upl,
            } = res.features[0].properties;

            $(".inf-amdal-jenis-izin").html(jenis_izin_lingkungan);
            $(".inf-amdal-kategori").html(kategori_amdal_ukl_upl);
            $(".inf-amdal-alasan").html(alasan_amdal);
        },
    });
};

const resetAmdal = () => {
    $("#indikatorA").html("");
    $("#parameterA").html("");
    $("#indikatorB").html("");
    $("#parameterB").html("");
    $(".inf-amdal-jenis-izin").html("-");
    $(".inf-amdal-kategori").html("-");
    $(".inf-amdal-alasan").html("-");
};

//Get List Kegiatan On Change Dropdown
$("#kegiatanRuang").change((e) => {
    $("#skala").html("");
    $(".dtKBLI").html("");
    let sel = $(e.target).select2("val");
    DropdownSkala(sub_zona_any, sel);
    $("#skala").change((e) => {
        $(".dtKBLI").html("");
        let skala = $(e.target).select2("val");
        dropDownKegiatanKewenangan(sub_zona_any, sel, skala);
        $("#btn-print").hide();
    });
});

//Get Detail Data KBLI
$(document).on("change", "#kegiatanKewenangan", (e) => {
    const dis = $(e.target);
    selSektor = dis.val();
    let index = dis.data("index");
    $(".dtKBLI").html("");
    $("#btn-print").show();
    let param_kbli = {
        kegiatan: $("#kegiatanRuang").select2("val"),
        skala: $("#skala").select2("val"),
        kewenangan: $("#kegiatanKewenangan").select2("val"),
    };
    // console.log(param_kbli);
    $.post(`${APP_URL}/save_kbli`, {
        kbli: data_kbli[selSektor],
        param_kbli: param_kbli,
    }).done(() => {
        condition.kbli = true;
        enable_print();
    });
    let tblSel = "";
    tblSel += `
      <tr>
        <td class="text_all" style="vertical-align: top;"><a href="https://oss.go.id/informasi/kbli-kode?kode=G&kbli=${data_kbli[selSektor]["Kode KBLI"]}" target="_blank">${data_kbli[selSektor]["Kode KBLI"]}</a></td>
        <td class="text_all" style="vertical-align: top;">${data_kbli[selSektor]["Kegiatan"]}</td>
        <td class="text_all" style="vertical-align: top;">${data_kbli[selSektor]["Resiko"]}</td>
        <td class="text_all" style="vertical-align: top;">${data_kbli[selSektor]["Status"]}</td>
      </tr>
      <br>
      <tr>
        <td class="text_all font-weight-bold" colspan="4"><br>Ketentuan ITBX</td>
      </tr>
      <tr>
        <td class="text_all" class="bg-white" colspan="4">${data_kbli[selSektor]["Substansi"]}</td>
      </tr>
      `;
    $(".dtKBLI").html(tblSel);

    kbli_data = `
            <div class="col-sm-12 mt-5">
              <div class="row">
                <div class="col-sm-12 font-weight-bold">KBLI</div>
                <div class="col-sm-4">Kode</div>
                <div class="col-sm-8">${data_kbli[selSektor]["Kode KBLI"]}</div>
                <div class="col-sm-4">Kegiatan</div>
                <div class="col-sm-8">${data_kbli[selSektor]["Kegiatan"]}</div>
                <div class="col-sm-4">Resiko</div>
                <div class="col-sm-8">${data_kbli[selSektor]["Resiko"]}</div>
                <div class="col-sm-4">Status</div>
                <div class="col-sm-8">${data_kbli[selSektor]["Status"]}</div>
                <div class="col-sm-4">Ketentuan ITBX</div>
                <div class="col-sm-8">${data_kbli[selSektor]["Substansi"]}</div>
              </div>
            </div>
          `;
    // getPermenLHK(data_kbli[selSektor]["Kode KBLI"]);
});

//Get Data Radius on Change
$(document).on("input change", "#ControlRange", () => {
    let kilometer = $("#ControlRange").val() / 1000;
    $("#OutputControlRange").html(kilometer + " Km");
    getRadius(setAttrClick);
});

//Set Default Radius Text
$("#OutputControlRange").html(kilometer + " Km");

//Search Wilayah
$("#cari_wilayah,#cari_wilayah_survey, #cari_wilayah_usaha").bindWithDelay(
    "keyup",
    (e) => {
        let query = $(e.target).val();
        let resHTML = "";

        if (query != "" && query.length >= 3) {
            if (query.indexOf("-") > -1) {
                const koor = query.split(",");
                $.ajax({
                    url: `${url_api}/wilayah`,
                    method: "PUT",
                    data: {
                        lat: koor[0],
                        lng: koor[1],
                    },
                    headers: {
                        Authorization: "Bearer " + token,
                    },
                    dataType: "json",
                    beforeSend: () => {
                        // ('.map-loading').show()
                    },
                    success: (res) => {
                        if (res.features != null) {
                            const dt = res.features;
                            for (let i in dt) {
                                let prop = dt[i].properties;
                                resHTML += `<li class="wm-li-result wilayah-select" onclick="flyToLocation(${
                                    koor[0]
                                },${koor[1]},'${titleCase(
                                    prop["Kelurahan"]
                                )}')"><i class="fa fa-map-marker" style="font-size: 15px;"></i> ${
                                    prop["Kelurahan"]
                                }</li>`;
                            }

                            $(".wm-search__dropdown").fadeIn();
                            $(".wm-search__dropdown").html(resHTML);
                        } else {
                            $(".wm-search__dropdown").fadeOut();
                            $(".wm-search__dropdown").html("");
                        }
                    },
                    error: (error) => {
                        $(".wm-search__dropdown").html(
                            `<li class="wm-li-result">Data tidak ditemukan</li>`
                        );
                    },
                    complete: () => {
                        // $('.map-loading').hide()
                    },
                });
            } else {
                $.ajax({
                    url: `${url_api}/search`,
                    method: "PUT",
                    data: {
                        keyword: query,
                    },
                    headers: {
                        Authorization: "Bearer " + token,
                    },
                    dataType: "json",
                    beforeSend: () => {
                        // $('.map-loading').show()
                    },
                    success: (res) => {
                        if (res.features != null) {
                            const dt = res.features;
                            for (let i in dt) {
                                let prop = dt[i].properties;
                                let name = "";
                                if (prop["Name"] == undefined) {
                                    name = prop["Nama"];
                                } else if (prop["Nama"] == undefined) {
                                    name = prop["Name"];
                                }
                                let koor = dt[i].geometry.coordinates;
                                resHTML += `<li class="wm-li-result text_all wilayah-select" onclick="flyToLocation(${koor[1]},${koor[0]},'${prop["Kelurahan"]}', '${name}, ${prop["Kelurahan"]}, ${prop["Kecamatan"]}, ${prop["Kota"]}')"><i class="fa fa-map-marker" style="font-size: 15px;"></i> ${name}, ${prop["Kelurahan"]}, ${prop["Kecamatan"]}, ${prop["Kota"]}</li>`;
                            }

                            $(".wm-search__dropdown").fadeIn();
                            $(".wm-search__dropdown").html(resHTML);
                        } else {
                            $(".wm-search__dropdown").fadeOut();
                            $(".wm-search__dropdown").html("");
                        }
                    },
                    error: (error) => {
                        $(".wm-search__dropdown").html(
                            `<li class="wm-li-result text_all">Data tidak ditemukan</li>`
                        );
                    },
                    complete: () => {
                        // $('.map-loading').hide()
                    },
                });
            }
        } else {
            $(".wm-search__dropdown").fadeOut();
            $(".wm-search__dropdown").html("");
        }
    },
    500
);

//Fly to Location
const flyToLocation = (lat, lng, kelurahan, keyword) => {
    map.flyTo({
        center: [lng, lat],
        zoom: 15.5,
        curve: 1,
    });

    //Save Kelurahan to LocalStorage
    // localStorage.setItem("kelurahan", kelurahan);

    if (kelurahan != "") {
        setTimeout(() => {
            map.fire("click", {
                lngLat: { lat: lat, lng: lng },
                point: map.project([lng, lat]),
            });
        }, 2000);
    }

    //After Click Option
    $("#cari_wilayah").val(keyword);
    $(".wm-search__dropdown").fadeOut();
};

//Show and Hide Layer
const showLayer = (layer) => {
    map.setLayoutProperty(layer, "visibility", "visible");
};

const hideLayer = (layer) => {
    map.setLayoutProperty(layer, "visibility", "none");
};

//Add Marker On Click
let marker = new mapboxgl.Marker({ color: "skyblue" });

const add_marker = (event) => {
    let coordinates = event.lngLat;

    //Check Control Mode
    if (
        localStorage.getItem("direction") == 0 &&
        localStorage.getItem("polygonDraw") == 0 &&
        localStorage.getItem("measure_distance") == 0
    ) {
        marker.setLngLat(coordinates).addTo(map);
    }
};

// map.on("click", add_marker);

//Load Zoning Layer on Click

map.on("click", (e) => {
    // let coordinates = e.lngLat;
    loadZoning(coordinates.lat, coordinates.lng);

    //Add Info Coordinate
    $(".inf-kordinat").html(
        `<a class="font-weight-bold" href="https://www.google.com/maps/search/%09${coordinates.lat},${coordinates.lng}" target="_blank">${coordinates.lat}, ${coordinates.lng}</a>`
    );

    //Fill Field Form Survey Perkembangan
    $("#kordinatSurvey").val(`${coordinates.lat},${coordinates.lng}`);
    $("#refrensiGoogleMaps").text(
        `${coordinates.lat.toString().slice(0, -2)},${coordinates.lng
            .toString()
            .slice(0, -2)}`
    );
    $("#refrensiGoogleMaps").attr(
        "href",
        `https://www.google.com/maps/search/%09${coordinates.lat},${coordinates.lng}`
    );
    $("#refrensiGoogleMapsBulk").attr(
        "href",
        `https://www.google.com/maps/search/%09${coordinates.lat},${coordinates.lng}`
    );
    $("#refrensiGoogleMapsBulk").text(
        `${coordinates.lat.toString().slice(0, -2)},${coordinates.lng
            .toString()
            .slice(0, -2)}`
    );

    //Fill Field Form Laporan/Pengawasan
    $("#kordinatPin").val(`${coordinates.lat},${coordinates.lng}`);

    $("#kordinatUsaha").val(`${coordinates.lat},${coordinates.lng}`);
    $("#refrensikordinatUsaha").text(
        `${coordinates.lat.toString().slice(0, -2)},${coordinates.lng
            .toString()
            .slice(0, -5)}`
    );

    // Fill Field Pesan AJib
    $("#koordinat_pesan_ajib").val(`${coordinates.lat},${coordinates.lng}`);
    $("#lat_pesan_ajib").val(coordinates.lat);
    $("#lng_pesan_ajib").val(coordinates.lng);

    // Enable Button Print
    $(".mapbox-gl-print-disabled")
        .attr("disabled", false)
        .removeClass("mapbox-gl-print-disabled")
        .addClass("mapbox-gl-print");

    // Reset Amdal
    $("#jenisUsahaAmdal").html("");
    resetAmdal();

    // Unclicked My Location
    if ($(".mapboxgl-ctrl-geolocate-active").length) {
        $(".mapboxgl-ctrl-geolocate").click();
    }
});

const loadZoning = (lat, lng) => {
    // console.log(lat, lng);
    $.ajax({
        url: `${url_api}/wilayah`,
        method: "PUT",
        data: {
            lat: lat,
            lng: lng,
        },
        headers: {
            Authorization: "Bearer " + token,
        },
        dataType: "json",
        success: (res) => {
            let kelurahan =
                res.features[0].properties["Kelurahan"] == null
                    ? null
                    : res.features[0].properties["Kelurahan"].toUpperCase();
            let kelurahan_tmp =
                localStorage.getItem("kelurahan") == null
                    ? null
                    : localStorage.getItem("kelurahan").toUpperCase();

            //Assign For Filter Layer
            kelurahan_tmp_global = kelurahan;

            // console.log(kelurahan, kelurahan_tmp);
            //load zoning layer
            if (kelurahan !== kelurahan_tmp) {
                //check control mode
                if (
                    localStorage.getItem("direction") == 0 &&
                    localStorage.getItem("polygonDraw") == 0 &&
                    localStorage.getItem("measure_distance") == 0
                ) {
                    addSourceLayers(kelurahan);
                }

                //change status mode zoning
                iddle_zoning = false;
                iddle_wilayah = false;
                //save kelurahan to local storage
                localStorage.setItem("kelurahan", kelurahan);
                // Renew Data Pesan Ajib
                get_ajib_kelurahan()
                    .then((message) => {
                        list_ajib_kelurahan(message);
                    })
                    .catch((err) => {
                        console.log(err);
                    });
                getChartDistribusiNIB(kelurahan);
                getDistribusiWilayah(kelurahan);
                getDistribusiLuasWilayah(kelurahan);
                getMeanNJOP(kelurahan);
                resetFilterGeo();
            }
        },
    });
};

//Chip Option
const chipOption = (name, slide = 4) => {
    $(`#${name}`).slick({
        infinite: false,
        slidesToShow: slide,
        slidesToScroll: slide,
        variableWidth: true,
        prevArrow: null,
        nextArrow: null,
    });
};

//Slider Option
const sliderOption = (name) => {
    $(`#${name}`).slick({
        infinite: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
    });
};

//Filter Data Layer
const filterLayerButton = () => {
    //Create Chip option
    chipOption("btn-titik", 1);

    //Active Button Layer
    const activeButtonLayer = (header, id) => {
        let header_element = $(`#${header}`);

        //remove all active class
        header_element.find("button").removeClass("active-chip");

        //add active class to button
        header_element.find(`#${id}`).addClass("active-chip");
    };

    let info_layer = [
        {
            info: "info-layer",
            removel: "closeSewa",
            button: "sewa_kantor",
            layer: "sewa_fill",
        },
        {
            info: "info-layer-usaha",
            removel: "closeUsaha",
            button: "iumk",
            layer: "iumk_fill",
        },
        {
            info: "info-layer-investasi",
            removel: "closeInvestasi",
            button: "proyek",
            layer: "investasi_dot",
        },
        {
            info: "info-layer-budaya",
            removel: "closeBudaya",
            button: "cagar",
            layer: "budaya_dot",
        },
        {
            info: "info-layer-survey-perkembangan",
            removel: "closeSurveyPerekmbangan",
            button: "survey",
            layer: "survey_dot",
        },
        {
            info: "info-layer-nib",
            removel: "closeNib",
            button: "nib",
            layer: "nib_dot",
        },
        {
            info: "info-layer-iprt",
            removel: "closeIprt",
            button: "iprt",
            layer: "iprt_dot",
        },
    ];

    //Hide and Show Layer On Right Button
    $("#closePin").on("click", () => {
        $(".info-pin-location").hide();
    });

    $("#closeUsahaLocation").on("click", () => {
        $(".info-usaha-location").hide();
    });

    $("#closeSurvey").on("click", () => {
        $(".info-survey-location").hide();
    });

    $("#closeKajian").on("click", () => {
        $(".info-layer-kajian-lingkungan").hide();
    });

    $("#closeNib").on("click", () => {
        $(".info-layer-nib").hide();
    });

    $("#closeIprt").on("click", () => {
        $(".info-layer-iprt").hide();
    });

    //Show Info Layer
    const showInfoLayer = (id) => {
        info_layer.forEach((item) => {
            if (item.info === id) {
                $(`.${item.info}`).show();
            } else {
                $(`.${item.info}`).hide();
            }
        });
    };

    //On Off Layer
    const onOffLayerFilter = (layer) => {
        info_layer.forEach((item) => {
            if (item.layer === layer) {
                if (map.getLayer(item.layer)) {
                    showLayer(item.layer);
                }
            } else {
                if (map.getLayer(item.layer)) {
                    hideLayer(item.layer);
                }
            }
        });
    };

    info_layer.forEach((el) => {
        //Active Button Layer
        $(`#${el.button}`).click(() => {
            activeButtonLayer("btn-titik", el.button);
            //Show Info Layer
            showInfoLayer(el.info);

            //Logical On Off Layer
            $(`#${el.layer}`).trigger("click");
            //On Off Layer
            onOffLayerFilter(el.layer);
        });

        //Remove Info Layer
        $(`#${el.removel}`).click(() => {
            $(`.${el.info}`).hide();
            //Remove Active Button Layer
            $(`#${el.button}`).removeClass("active-chip");

            //Logical Click
            $(`#${el.layer}`).prop("checked", false).trigger("change");
            window.stop();
        });
    });
};

filterLayerButton();

//Formating Function
const separatorNum = (val) => {
    let parts = val.toString().split(",");
    const numberPart = parts[0];
    const decimalPart = parts[1];
    const thousands = /\B(?=(\d{3})+(?!\d))/g;
    return (
        numberPart.replace(thousands, ",") +
        (decimalPart ? "." + decimalPart : "")
    );
};

const titleCase = (str) => {
    str = str.toLowerCase().split(" ");
    for (let i = 0; i < str.length; i++) {
        str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1);
    }
    return str.join(" ");
};

//Show Detail Info Layer
const showDetailInfoLayer = () => {
    $(".pembungkus").css("height", "100%");
    $("#btn-titik").show();
    $(".container_menu.for_web").show();
    $(".tab-content.for_web").show();
    $("hr.for_web").show();
    $(".btn_hide_side_bar.for_web").show();
};

//Hide Detail Info Layer
const hideDetailInfoLayer = () => {
    $("#btn-titik").hide();
    $(".container_menu.for_web").hide();
    $(".tab-content.for_web").hide();
    $("hr.for_web").hide();
    $(".btn_hide_side_bar.for_web").hide();
};

//Get Data Simulasi
const getSimulasi = (e) => {
    $.ajax({
        url: `${url_api}/simulasi`,
        type: "POST",
        data: {
            peruntukan: e,
        },
        headers: {
            Authorization: `Bearer ${token}`,
        },
        dataType: "JSON",
        success: (data) => {
            let jumlah_orang = 0;
            let data_simulasi = data.features[0].properties;
            if (e == "Rumah Mewah" || e == "Rumah Biasa") {
                jumlah_orang = 5;
                $("#stdluasbangunan").removeClass("d-flex");
                $("#stdluasbangunan").addClass("d-none");
            } else {
                jumlah_orang = Math.ceil(
                    (luasSimulasi * parseFloat(KLB.replace(",", "."))) / 9
                );
                $("#stdluasbangunan").removeClass("d-none");
                $("#stdluasbangunan").addClass("d-flex");
            }
            $(".inf-simulasi-pmkair").html(
                data_simulasi.Air + " lt/penghuni/hari"
            );
            $(".inf-simulasi-dbtairlimbah").html(
                data_simulasi.Limbah + " lt/penghuni/hari"
            );
            $(".inf-simulasi-sampah").html(
                data_simulasi.Sampah + " kg/Orang/Hari"
            );
            $(".inf-simulasi-stdluasbangunan").html(
                separatorNum(9) + " m<sup>2</sup>"
            );
            $(".inf-simulasi-luaslimpahan").html(
                `${separatorNum(
                    Math.ceil(luasSimulasi * (1 - KDH / 100))
                )} m<sup>2</sup>/Hari`
            );
            $(".inf-simulasi-luasbangunan").html(
                `${separatorNum(
                    Math.ceil(luasSimulasi * parseFloat(KLB.replace(",", ".")))
                )} m<sup>2</sup>`
            );

            $(".inf-simulasi-jmlorang").html(
                `${separatorNum(jumlah_orang)} Orang`
            );
            $(".inf-simulasi-kebutuhanairbersih").html(
                `${separatorNum(
                    Math.ceil(data_simulasi.Air * jumlah_orang)
                )} lt/Hari`
            );
            $(".inf-simulasi-produksilimbah").html(
                `${separatorNum(
                    Math.ceil(data_simulasi.Air * jumlah_orang * (80 / 100))
                )} lt/Hari`
            );
            $(".inf-simulasi-produksisampah").html(
                `${separatorNum(
                    Math.ceil(data_simulasi.Sampah * jumlah_orang)
                )} kg/Hari`
            );
            $(".inf-simulasi-volumlimpasanairhujan").html(
                `${separatorNum(
                    Math.ceil(
                        parseFloat(data_simulasi.Hujan) *
                            (luasSimulasi * (1 - KDH / 100))
                    )
                )} m<sup>3</sup>/Hari`
            );
            $(".inf-simulasi-nilaitanah").html(
                `Rp. ${separatorNum(luasSimulasi * NJOP)}`
            );
            $(".inf-simulasi-nilaibangunan").html(
                `Rp. ${separatorNum(
                    Math.ceil(
                        luasSimulasi * parseFloat(KLB.replace(",", "."))
                    ) * $("#biayaBangunan").val().replaceAll(".", "")
                )}`
            );

            $(".inf-simulasi-totalnilai").html(
                `Rp. ${separatorNum(
                    luasSimulasi * NJOP +
                        Math.ceil(
                            luasSimulasi * parseFloat(KLB.replace(",", "."))
                        ) *
                            $("#biayaBangunan").val().replaceAll(".", "")
                )}`
            );

            $("#biayaBangunan").on("keyup", () => {
                console.log($("#biayaBangunan").val().replaceAll(".", ""));
                $(".inf-simulasi-nilaibangunan").html(
                    `Rp. ${separatorNum(
                        Math.ceil(
                            luasSimulasi * parseFloat(KLB.replace(",", "."))
                        ) * $("#biayaBangunan").val().replaceAll(".", "")
                    )}`
                );

                $(".inf-simulasi-totalnilai").html(
                    `Rp. ${separatorNum(
                        luasSimulasi * NJOP +
                            Math.ceil(
                                luasSimulasi * parseFloat(KLB.replace(",", "."))
                            ) *
                                $("#biayaBangunan").val().replaceAll(".", "")
                    )}`
                );
            });
            // console.log(data_simulasi);

            $.post(`${APP_URL}/save_lingkungan`, {
                lingkungan: getResultSimulasi(),
            });
        },
    });
};

const getResultSimulasi = () => {
    const data = {
        peruntukan_bangunan: $("#selectSimulasi").select2("val"),
        luas_lahan: $(".inf-simulasi-luaslahan").text(),
        kdh: $(".inf-simulasi-kdh").text(),
        klb: $(".inf-simulasi-klb").text(),
        pemakaian_air: $(".inf-simulasi-pmkair").text(),
        debit_air_limbah: $(".inf-simulasi-dbtairlimbah").text(),
        sampah: $(".inf-simulasi-sampah").text(),
        standar_luas_bangunan: $(".inf-simulasi-stdluasbangunan").text(),
        kebutuhan_air_bersih: $(".inf-simulasi-kebutuhanairbersih").text(),
        volume_limpasan_air_hujan: $(
            ".inf-simulasi-volumlimpasanairhujan"
        ).text(),
        jumlah_orang: $(".inf-simulasi-jmlorang").text(),
        luas_limpahan_air_hujan: $(".inf-simulasi-luaslimpahan").text(),
        luas_bangunan: $(".inf-simulasi-luasbangunan").text(),
        produksi_limbah_cair: $(".inf-simulasi-produksilimbah").text(),
        produksi_sampah: $(".inf-simulasi-produksisampah").text(),
    };
    return data;
};

//Trigger Change Data Simulasi
$("#selectSimulasi").on("change", () => {
    let value = $("#selectSimulasi").select2("val");
    localStorage.setItem("simulasi", value);
    getSimulasi(value);
});

//Login Logic
$.ajax({
    url: `${APP_URL}/cekLoginChat`,
    method: "GET",
    dataType: "json",
    success: (e) => {
        if (e.status == 1) {
            let img = `${APP_URL}/profile/${e.id}.jpg`;
            $("#btnLogout")
                .on("error", (e) => {
                    $(e.target).attr(
                        "src",
                        `${APP_URL}/assets/gambar/default.png`
                    );
                })
                .attr("src", img);
            $("#profile").show();
            $("#btnLogin").hide();
        }
    },
});

//Laporan dan Pengawasan
const pinLocation = () => {
    $(".info-pin-location").show();
    getDataPin(user_id);
};

const getDataPin = (id_user) => {
    $.ajax({
        url: `${APP_URL}/getDataPin/${id_user}`,
        method: "GET",
        success: (e) => {
            let html = "";
            if (e != "") {
                $("#messageNoData").hide();
                for (let index = 0; index < e.length; index++) {
                    html += `<div class="mb-3" style="font-size:10pt;">
                    <div class="row">
                        <div class="col-sm-3 text-center">
                            <img src="${
                                e[index].image.length == 0
                                    ? "/https://jakarta.pintoinvest.com/survey/not_image.png"
                                    : "favorit/" + e[index].image[0].name
                            }" class="w-100" style="border-radius: 10px; height:40px; cursor: pointer" onclick="detailDataPin(${
                        e[index].id
                    })">
                        </div>
                        <div class="col-sm-6">
                            <a style="font-weight: bold;word-break: break-all;
                            white-space: normal; cursor: pointer;" onclick="flyToLocation(${
                                e[index].kordinat.split(",")[0]
                            },${e[index].kordinat.split(",")[1]},'${
                        e[index].kelurahan
                    }');">${e[index].judul} (${
                        e[index].tipe
                    })</a><br><span style="width:70%;word-break: break-all;
                            white-space: normal;">${e[index].catatan}</span>
                        </div>
                        <div class="col-sm-3 d-flex align-items-center">
                        <div class="row">
                            <div class="col-6 p-1">
                                <a onclick="deleteDataPin(
                                    ${e[index].id},
                                    ${id_user}
                                )" style="cursor:pointer;color:red;font-size: 18px;"><i class="fa fa-trash"></i></a>
                            </div>
                            <div class="col-6 p-1">
                                <a class="mt-1" onclick="editDataPin(
                                    ${e[index].id},
                                    ${id_user}
                                )" style="cursor:pointer;color:blue;font-size: 18px;"><i style="margin-top:6px" class="fa fa-edit"></i></a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>`;
                }
                $(".list-item-info-location").html("");
                $(".list-item-info-location").html(html);
            } else {
                $(".list-item-info-location").html("");
                $("#messageNoData").show();
            }
        },
    });
};

const deleteDataPin = (id_data, id_user) => {
    $.ajax({
        url: `${APP_URL}/deleteDataPin`,
        method: "POST",
        data: {
            id_data: id_data,
        },
        success: (e) => {
            getDataPin(id_user);
            $("#pesanBerhasilHapus").show();
            setTimeout(() => {
                $("#pesanBerhasilHapus").hide();
            }, 3000);
        },
    });
};

const deleteImage = (id, id_gambar) => {
    if (id_gambar == 0) {
        $(`.image-${id}`).remove();
    } else {
        $(`.image-${id}`).remove();
        $.ajax({
            url: `${APP_URL}/deleteImage`,
            method: "POST",
            data: {
                id: id_gambar,
            },
            success: (e) => {},
        });
    }
};

const detailDataPin = (id) => {
    $.ajax({
        url: `${APP_URL}/detailDataPin`,
        method: "POST",
        data: {
            id: id,
        },
        success: (e) => {
            // console.log(e);
            $(".info-lokasi-detail").html("");
            let html = ``;
            html += `
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <button type="button" class="close" id="closeDetail" aria-label="Close"
                style="position: absolute; z-index: 9; right: 1rem;">
                <span aria-hidden="true">&times;</span>
            </button>
            <ol class="carousel-indicators">`;

            for (let index = 0; index < e.image.length; index++) {
                html += `
                    <li data-target="#carouselExampleIndicators" data-slide-to="${index}" ${
                    index == 0 ? "class='active'" : ""
                }></li>
                    `;
            }

            html += `
            </ol>
            <div class="carousel-inner">
            `;
            for (let index = 0; index < e.image.length; index++) {
                html += `
                <div class="carousel-item ${index == 0 ? "active" : ""}">
                    <img class="d-block w-100"
                        src="/favorit/${e.image[index].name}">
                </div>
                `;
            }

            html += `
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="container p-4">
            <div class="mt-3">
                <h4>${e.judul}</h4>
                <p style="font-size: 10pt">${e.catatan}</p>
            </div>
        </div>
            `;
            $(".info-lokasi-detail").html(html);
            $(".info-lokasi-detail").show();

            $("#closeDetail").on("click", (e) => {
                $(".info-lokasi-detail").hide();
            });
        },
    });
};

const preview_image = () => {
    let gambarLokasi = $("#gambarLokasi").get(0).files.length;
    $("#previewFoto").html("");
    if (gambarLokasi > 3) {
        $("#pesanFoto").show();
        $("#gambarLokasi").val("");
        setTimeout(() => {
            $("#pesanFoto").hide();
        }, 3000);
    } else {
        for (let i = 0; i < gambarLokasi; i++) {
            $("#previewFoto").append(`
            <div class="col-md-4">
                <img src="${URL.createObjectURL(
                    event.target.files[i]
                )}" class="w-100">
            </div>
            `);
        }
    }
};

$("#formPinLocation").on("submit", function (e) {
    e.preventDefault();
    let coor = $("#kordinatPin").val();
    let judul = $("#judulPin").val();
    let catatan = $("#catatanPin").val();
    let gambarLokasi = $("#gambarLokasi").get(0).files;
    let formData = new FormData(this);

    if (
        coor !== "" &&
        judul !== "" &&
        catatan !== "" &&
        gambarLokasi.length <= 3
    ) {
        let id_user = user_id;
        formData.append("id_user", id_user);
        formData.append("kelurahan", localStorage.getItem("kelurahan"));
        $.ajax({
            url: `${APP_URL}/saveDataPin`,
            method: "POST",
            contentType: false,
            processData: false,
            data: formData,
            success: (e) => {
                $("#kordinatPin").val("");
                $("#judulPin").val("");
                $("#catatanPin").val("");
                $("#gambarLokasi").val("");
                $("#previewFoto").html("");
                $("#pesanBerhasil").show();
                getDataPin(id_user);
                setTimeout(() => {
                    $("#pesanBerhasil").hide();
                }, 3000);
            },
        });
    } else {
        $("#pesanGagal").show();
        setTimeout(() => {
            $("#pesanGagal").hide();
        }, 3000);
    }
});

const editDataPin = (id, id_user) => {
    $("#previewFotoEdit").html("");
    $.ajax({
        url: `${APP_URL}/editDataPin`,
        method: "POST",
        data: {
            id: id,
            id_user: id_user,
        },
        success: (e) => {
            for (let i = 0; i < e.image.length; i++) {
                $("#previewFotoEdit").append(`
                <div class="col-md-4 image-edit image-${i}">
                    <img src="favorit/${e.image[i].name}" class="w-100">
                    <button type="button" onclick="deleteImage(${i}, ${e.image[i].id})" class="close" style="position: absolute;color: red;right:1rem;top: -0.4rem;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                `);
            }
            $("#formPinLocation").hide();
            $("#formPinLocationEdit").show();
            $("#idPinEdit").val(e.id);
            $("#kordinatPinEdit").val(e.kordinat);
            $("#judulPinEdit").val(e.judul);
            $("#judulPinEdit").val(e.judul);
            $("#tipePinEdit").val(e.tipe);
            $("#catatanPinEdit").val(e.catatan);
            // console.log(e);
        },
    });
};

$("#formPinLocationEdit").on("submit", function (e) {
    e.preventDefault();
    let coor = $("#kordinatPinEdit").val();
    let judul = $("#judulPinEdit").val();
    let catatan = $("#catatanPinEdit").val();
    let formData = new FormData(this);

    if (coor !== "" && judul !== "" && catatan !== "") {
        $.ajax({
            url: `${APP_URL}/getIdUser`,
            method: "GET",
            success: (e) => {
                let id_user = e;
                // console.log(formData.get("foto"));
                $.ajax({
                    url: `${APP_URL}/saveEditDataPin`,
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    success: (e) => {
                        console.log(e);
                        $("#kordinatPinEdit").val("");
                        $("#judulPinEdit").val("");
                        $("#catatanPinEdit").val("");
                        $("#gambarLokasiEdit").val("");
                        $("#previewFotoEdit").html("");
                        $("#formPinLocationEdit").hide();
                        $("#formPinLocation").show();
                        getDataPin(id_user);
                        $("#pesanBerhasilEdit").show();
                        setTimeout(() => {
                            $("#pesanBerhasilEdit").hide();
                        }, 3000);
                    },
                });
            },
        });
    } else {
        $("#pesanGagal").show();
        setTimeout(() => {
            $("#pesanGagal").hide();
        }, 3000);
    }
});

//--- Survey Perkembangan Wilayah ---//
const surveyLocation = () => {
    resetSurvey();
    getDataSurvey(user_id);
    $(".info-survey-location").show();
};

//Singel Input
const focusSurey = () => {
    location.href = "#infoSurveyLocation";
};

const resetSurvey = () => {
    files = [];
    localStorage.setItem("url_survey", `${APP_URL}/saveDataSurvey`);
    $("#idSurvey").val("");
    $("#nameSurvey").val("");
    $("#kordinatSurvey").val("");
    $("#idSubblokSurvey").val("");
    $("#globalidSurvey").val("");
    $("#kelurahanSurvey").val("");
    $("#kecamatanSurvey").val("");
    $("#regionalSurvey").val("");
    $("#deskripsiRegionalSurvey").val("");
    $("#neighborhoodSurvey").val("");
    $("#deskripsiNeighborhoodSurvey").val("");
    $("#transectZoneSurvey").val("");
    $("#deskripsiTransectZoneSurvey").val("");
    $("#gambarLokasiSurvey").val("");
    $("#refrensiGoogleMaps").text("-");
    $("#refrensiGoogleMapsBulk").text("-");
    $("#refrensiGoogleMaps").attr("href", "#");
    $("#refrensiGoogleMapsBulk").attr("href", "#");
    $("#textidSubblokSurvey").text("-");
    $("#textidSubblokSurveyBulk").text("-");
    $("#textglobalidSurvey").text("-");
    $("#textglobalidSurveyBulk").text("-");
    $("#textkelurahanSurvey").text("-");
    $("#textkelurahanSurveyBulk").text("-");
    $("#textkecamatanSurvey").text("-");
    $("#textkecamatanSurveyBulk").text("-");
    if (
        $("div#previewFotoSurvey.slick-initialized.slick-slider").length !== 0
    ) {
        $("#previewFotoSurvey").slick("unslick");
        $("#previewFotoSurvey").html("");
        sliderOption("previewFotoSurvey");
    }
    $("#resetSurey").hide();
};

let list_kelurahan = [];
const getListKelurahanSurvey = () => {
    $.ajax({
        url: `${APP_URL}/getListKelurahanSurvey`,
        method: "GET",
        success: (e) => {
            let html = "";
            html += `<option value="*">Seluruh Kelurahan</option>`;
            e.forEach((e) => {
                html += `<option value="${e.kelurahan}">${e.kelurahan}</option>`;
                list_kelurahan.push(e.kelurahan);
            });
            $("#opsiKelurahanSurvey").html("");
            $("#opsiKelurahanSurvey").html(html);
        },
    });
};

getListKelurahanSurvey();

const getDataSurvey = (id_user, kelurahan = "*") => {
    $.ajax({
        url: `${APP_URL}/getDataSurvey/${id_user}/${kelurahan}`,
        method: "GET",
        success: (e) => {
            let html = "";
            if (e != "") {
                $("#messageNoDataSurvey").hide();
                e.forEach((e) => {
                    html += `<div class="mb-3" style="font-size:10pt;">
                    <div class="row">
                        <div class="col-sm-3 text-center">
                            <img class="lazy" data-src="https://jakarta.pintoinvest.com/survey/${
                                e.image[0] == undefined
                                    ? "not_image.png"
                                    : e.image[0].name
                            }" class="w-100" style="border-radius: 10px; height:75px; cursor: pointer; border:1px #ccc solid; object-fit:cover;" onclick="focusSurey();localStorage.setItem('kordinat','${
                        e.kordinat
                    }');flyToLocation(${e.kordinat.split(",")[0]},${
                        e.kordinat.split(",")[1]
                    },'${titleCase(kelurahan)}');editDataSurvey(
                        ${e.id_baru},
                        ${id_user}
                    )">
                        </div>
                        <div class="col-sm-7" onclick="focusSurey();localStorage.setItem('kordinat','${
                            e.kordinat
                        }');flyToLocation(${e.kordinat.split(",")[0]},${
                        e.kordinat.split(",")[1]
                    },'${titleCase(kelurahan)}');editDataSurvey(
                    ${e.id_baru},
                    ${id_user}
                )" style="cursor: pointer;">
                            <a style="font-weight: bold;word-break: break-all;
                            white-space: normal; cursor: pointer;">${
                                e.name
                            }</a><br>
                            <span>Pola Regional : ${e.regional}</span><br>
                            <span>Pola Lingk. : ${e.neighborhood}</span><br>
                            <span>Pola Ruang: ${e.transect_zone}</span>
                        </div>
                        <div class="col-sm-2 d-flex align-items-center pl-5">
                        <div class="row">
                            <div class="col-12 p-1">
                                <a onclick="deleteDataSurvey(
                                    ${e.id_baru},
                                    ${id_user}
                                )" style="cursor:pointer;color:red;font-size: 18px;"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>`;
                });

                $("#JumlahTitikSurvey").text(e.length);
                $(".list-item-info-location-survey").html("");
                $(".list-item-info-location-survey").html(html);
                lazyLoadImages();
            } else {
                $("#JumlahTitikSurvey").text(e.length);
                $(".list-item-info-location-survey").html("");
                $("#messageNoDataSurvey").show();
            }
        },
    });
};

const deleteDataSurvey = (id_data, id_user) => {
    $.ajax({
        url: `${APP_URL}/deleteDataSurvey`,
        method: "POST",
        data: {
            id: id_data,
        },
        success: (e) => {
            getDataSurvey(id_user);
            getLayerSurveyPerkembangan();
            if (e.message == "Anda tidak memiliki akses") {
                $("#pesanGagalSurvey").html(
                    `<strong>Gagal!</strong> Anda tidak memiliki akses.`
                );
                $("#pesanGagalSurvey").show();
                setTimeout(function () {
                    $("#pesanGagalSurvey").hide();
                    $("#pesanGagalSurvey").html(
                        `<strong>Gagal!</strong> Periksa kembali semua kolom yang wajib diisi.`
                    );
                }, 3000);
            } else {
                $("#pesanBerhasilHapusSurvey").show();
                setTimeout(function () {
                    $("#pesanBerhasilHapusSurvey").hide();
                }, 3000);
            }
        },
    });
};

const editDataSurvey = (id, id_user) => {
    $("#previewFotoEdit").html("");
    $.ajax({
        url: `${APP_URL}/editDataSurvey`,
        method: "POST",
        data: {
            id: id,
            id_user: id_user,
        },
        dataType: "json",
        success: (e) => {
            $("#resetSurey").show();
            let html = "";
            if (e.image.length !== 0) {
                for (var i = 0; i < e.image.length; i++) {
                    html += `
                <div class="mr-1 slide slide-survey">
                    <button type="button" class="close btn-remove-item" onclick="removeImageSurvey(${e.image[i].id})" style="position: relative;
                    color: red;margin-bottom:-1rem;">
                            <span aria-hidden="true">&times;</span>
                    </button>
                    <img src="https://jakarta.pintoinvest.com/survey/${e.image[i].name}" class="w-100" style="object-fit:cover">
                </div>
                `;
                }
            }
            if (
                $("div#previewFotoSurvey.slick-initialized.slick-slider")
                    .length == 0
            ) {
                $("#previewFotoSurvey").html("");
                $("#previewFotoSurvey").html(html);
                sliderOption("previewFotoSurvey");
                removeItem();
            } else {
                $("#previewFotoSurvey").slick("unslick");
                $("#previewFotoSurvey").html("");
                $("#previewFotoSurvey").html(html);
                sliderOption("previewFotoSurvey");
                removeItem();
            }
            localStorage.setItem("url_survey", `${APP_URL}/saveEditDataSurvey`);
            // $("#formSurveyLocationEdit").show();
            $("#idSurvey").val(e.id_baru);
            $("#nameSurvey").val(e.name);
            $("#kordinatSurvey").val(e.kordinat);
            $("#idSubblokSurvey").val(e.id_sub_blok);
            $("#kelurahanSurvey").val(e.kelurahan);
            $("#kecamatanSurvey").val(e.kecamatan);
            $("#regionalSurvey").val(e.regional);
            $("#deskripsiRegionalSurvey").val(e.deskripsi_regional);
            $("#neighborhoodSurvey").val(e.neighborhood);
            $("#deskripsiNeighborhoodSurvey").val(e.deskripsi_neighborhood);
            $("#transectZoneSurvey").val(e.transect_zone);
            $("#deskripsiTransectZoneSurvey").val(e.deskripsi_transect_zone);
            // console.log(e);
        },
    });
};

const removeImageSurvey = (id) => {
    $.ajax({
        url: `${APP_URL}/deleteImageSurvey`,
        method: "POST",
        data: {
            id: id,
        },
        success: (e) => {},
    });
};

const removeItem = () => {
    $(".btn-remove-item").on("click", function (e) {
        let index = $(this).data("index");
        if (index !== undefined) {
            files.splice(files.indexOf(Newfiles[index]), 1);
        }
        $("#previewFotoSurvey").slick(
            "slickRemove",
            $(".btn-remove-item").index(this)
        );
    });
};

const preview_foto_survey = () => {
    let gambarLokasi = $("#gambarLokasiSurvey").get(0).files.length;
    let countArray = Newfiles.length;
    if ($("div#previewFotoSurvey.slick-initialized.slick-slider").length == 0) {
        sliderOption("previewFotoSurvey");
    }
    if (localStorage.getItem("url_survey") == `${APP_URL}/saveEditDataSurvey`) {
        $("#previewFotoSurvey").slick(
            "slickSetOption",
            "slidesToShow",
            1,
            true
        );
    } else {
        $("#previewFotoSurvey").slick(
            "slickSetOption",
            "slidesToShow",
            3,
            true
        );
    }
    for (let i = 0; i < gambarLokasi; i++) {
        let file = $("#gambarLokasiSurvey").get(0).files[i];
        let element = $(`
            <div class="slide slide-survey mr-1">
                <button type="button" class="close btn-remove-item" data-index="${countArray++}" style="position: relative;
                color: red;margin-bottom:-1rem;">
                        <span aria-hidden="true">&times;</span>
                </button>
                <img src="${URL.createObjectURL(
                    event.target.files[i]
                )}" class="w-100">
            </div>
            `);
        if ($(".slide-survey").length == 0) {
            $("#previewFotoSurvey").slick("slickAdd", element);
            console.log("add first");
        } else {
            $("#previewFotoSurvey").slick("slickAdd", element, 0, true);
            console.log("add second");
        }
        new Compressor(file, {
            quality: 0.3,
            convertSize: 1000000,
            success(result) {
                files.push(result);
                Newfiles.push(result);
            },
            error(err) {
                console.log(err.message);
            },
        });
    }
    $("#gambarLokasiSurvey").val("");
    removeItem();
};

$("#formSurveyLocation").on("submit", function (e) {
    e.preventDefault();
    let name = $("#nameSurvey").val();
    let coor = $("#kordinatSurvey").val();
    let id_subblok = $("#idSubblokSurvey").val();
    let kelurahan = $("#kelurahanSurvey").val();
    let kecamatan = $("#kecamatanSurvey").val();
    let regional = $("#regionalSurvey").val();
    let deskripsi_regional = $("#deskripsiRegionalSurvey").val();
    let neighborhood = $("#neighborhoodSurvey").val();
    let deskripsi_neighborhood = $("#deskripsiNeighborhoodSurvey").val();
    let transect_zone = $("#transectZoneSurvey").val();
    let deskripsi_transect_zone = $("#deskripsiTransectZoneSurvey").val();
    let gambarLokasi = $("#gambarLokasiSurvey").get(0).files;
    let formData = new FormData(this);

    if (
        name !== "" &&
        coor !== "" &&
        id_subblok !== "" &&
        kelurahan !== "" &&
        kecamatan !== "" &&
        regional !== "" &&
        deskripsi_regional !== "" &&
        neighborhood !== "" &&
        deskripsi_neighborhood !== "" &&
        transect_zone !== "" &&
        deskripsi_transect_zone !== ""
    ) {
        $("#prosesSurvey").show();
        $("#submitSurveyLocation").hide();

        formData.append("id_user", user_id);

        files.forEach((file) => {
            formData.append("foto_survey[]", file);
        });

        $.ajax({
            url: localStorage.getItem("url_survey"),
            method: "POST",
            contentType: false,
            processData: false,
            data: formData,
            success: (e) => {
                let message = e;
                if (message.message == "Anda tidak memiliki akses") {
                    $("#pesanGagalSurvey").html(
                        `<strong>Gagal!</strong> Anda tidak memiliki akses.`
                    );
                    $("#pesanGagalSurvey").show();
                    setTimeout(() => {
                        $("#pesanGagalSurvey").hide();
                        $("#pesanGagalSurvey").html(
                            `<strong>Gagal!</strong> Periksa kembali semua kolom yang wajib diisi.`
                        );
                    }, 3000);
                } else {
                    $("#pesanBerhasilSurvey").show();
                    setTimeout(() => {
                        $("#pesanBerhasilSurvey").hide();
                    }, 3000);
                }
                $("#prosesSurvey").hide();
                $("#submitSurveyLocation").show();
                if (
                    localStorage.getItem("url_survey") ==
                    `${APP_URL}/saveDataSurvey`
                ) {
                    resetSurvey();
                }
                getDataSurvey(user_id);
                getLayerSurveyPerkembangan();
                getListKelurahanSurvey();
            },
            error: (e) => {
                $("#prosesSurvey").hide();
                $("#submitSurveyLocation").show();
                getLayerSurveyPerkembangan();
                if (
                    localStorage.getItem("url_survey") ==
                    `${APP_URL}/saveDataSurvey`
                ) {
                    resetSurvey();
                }
                $("#pesanGagalSurvey").show();
                setTimeout(() => {
                    $("#pesanGagalSurvey").hide();
                }, 3000);
            },
        });
    } else {
        $("#pesanGagalSurvey").show();
        setTimeout(() => {
            $("#pesanGagalSurvey").hide();
        }, 3000);
    }
});

$("#deskripsiRegionalSurvey").on("keyup", () => {
    let length = $("#deskripsiRegionalSurvey").val().length;
    $("#countTextRegional").text(length);
});

$("#deskripsiNeighborhoodSurvey").on("keyup", () => {
    let length = $("#deskripsiNeighborhoodSurvey").val().length;
    $("#countTextLingkungan").text(length);
});

$("#deskripsiTransectZoneSurvey").on("keyup", () => {
    let length = $("#deskripsiTransectZoneSurvey").val().length;
    $("#countTextRuang").text(length);
});

//Bulk Insert
Dropzone.autoDiscover = false;

function setup(id) {
    let options = {
        init: function () {
            var self = this;
            //New file added
            self.on("addedfile", function (file) {
                // filesBulk.push(file);
                console.log(file);
                new Compressor(file, {
                    quality: 0.3,
                    convertSize: 1000000,
                    success(result) {
                        filesBulk.push(result);
                    },
                    error(err) {
                        console.log(err.message);
                    },
                });
                console.log(file.name);
            });
            //Remove File Added
            self.on("removedfile", function (file) {
                console.log(file.name);
                filesBulk.splice(file, 1);
            });
        },

        previewTemplate: `
        <div class="dz-preview dz-processing dz-image-preview dz-error dz-complete m-0 mt-1" style="margin-right:17px !important;">
        <div class="dz-image border" style="width:80px;height:80px;border-radius:10px;">
            <img data-dz-thumbnail="" alt="">
        </div>
        <div class="dz-details" style="font-size:6pt">
            <div class="dz-size" style="font-size:5pt">
                <span data-dz-size=""></span>
            </div>
            <div class="dz-filename"><span data-dz-name=""></span>
            </div>
        </div>
        <div class="dz-progress">
            <span class="dz-upload" data-dz-uploadprogress=""></span>
        </div>
        <div class="dz-success-mark">

        </div>
        <div class="dz-remove" style="z-index: 99999;position: absolute;top: 0px;right: 5px;">
        <a href="javascript:undefined;" data-dz-remove="" class="text-danger font-weight-bold"><i class="fa fa-close"></i></div>
    </div>
        `,
    };

    var myDropzone = new Dropzone(`#${id}`, options);
}
setup("fotoSurvey");

$("#fileExcel").on("change", function (e) {
    var file = e.target.files[0];
    $("#nameFileExcel").text(file.name);
});

$("#formSurveyBulkLocation").on("submit", function (e) {
    e.preventDefault();
    var form_data = new FormData(this);
    filesBulk.forEach((file) => {
        form_data.append("foto[]", file, file.name);
    });
    $("#btnSubmitBulk").hide();
    $("#prosesSurveyBulk").show();

    $.ajax({
        url: `${APP_URL}/getIdUser`,
        method: "GET",
        success: (e) => {
            let id_user = e;
            $.ajax({
                url: `${APP_URL}/importSurvey`,
                method: "POST",
                contentType: false,
                processData: false,
                data: form_data,
                success: (e) => {
                    filesBulk = [];
                    $("#btnSubmitBulk").show();
                    $("#prosesSurveyBulk").hide();
                    $(".dz-preview").remove();
                    $(".dz-message").show();
                    $("#nameFileExcel").text("");
                    $("#fileExcel").val("");
                    getDataSurvey(id_user);
                    getLayerSurveyPerkembangan();
                    if (
                        e.error != "Data Tidak Lengkap" &&
                        e.error != "The given data was invalid."
                    ) {
                        let message = e.error.substring(71, 79);
                        $("#messageErrorBulk").text(
                            `Data duplikat dengan no ID ${message}`
                        );
                        $("#pesanGagalSurveyBulk").show();
                        setTimeout(function () {
                            $("#pesanGagalSurveyBulk").hide();
                        }, 3000);
                    } else if (e.error == "Anda tidak memiliki akses") {
                        $("#messageErrorBulk").text(
                            "Anda tidak memiliki akses"
                        );
                        $("#pesanGagalSurveyBulk").show();
                        setTimeout(function () {
                            $("#pesanGagalSurveyBulk").hide();
                        }, 3000);
                    } else {
                        $("#messageErrorBulk").text("Data Tidak Lengkap");
                        $("#pesanGagalSurveyBulk").show();
                        setTimeout(function () {
                            $("#pesanGagalSurveyBulk").hide();
                        }, 3000);
                    }
                },
            });
        },
    });
});

//Get Detail NJOP

const getNJOPSurvey = (e) => {
    $.ajax({
        url: `${url_api}/njop`,
        method: "POST",
        data: {
            lat: e.lngLat.lat,
            lng: e.lngLat.lng,
        },
        headers: {
            Authorization: `Bearer ${token}`,
        },
        success: (dt) => {
            const dtResp = JSON.parse(dt);
            const prop = dtResp.features[0].properties;
            $("#njopSurvey").html("-");
            if (dtResp.features != null) {
                $("#njopSurvey").html(
                    `${separatorNum(prop.Min / 1000000)} - ${separatorNum(
                        prop.Max / 1000000
                    )}`
                );
            }
        },
        error: (error) => {
            console.log(error);
        },
        complete: (e) => {},
    });
};

const getLayerSurveyPerkembangan = () => {
    if (map.getLayer("survey_perkembangan")) {
        console.log("loaded layer");
        map.removeLayer("survey_perkembangan");
        map.removeSource("survey_perkembangan_wilayah");
    }
    if (map.getLayer("survey_perkembangan_partner")) {
        console.log("loaded layer");
        map.removeLayer("survey_perkembangan_partner");
        map.removeSource("survey_perkembangan_wilayah_partner");
    }

    $.ajax({
        url: `${APP_URL}/layerSurveyPerkembangan`,
        method: "GET",
        dataType: "json",
        success: (res) => {
            let data = res;
            // console.log(data);
            map.addSource("survey_perkembangan_wilayah", {
                type: "geojson",
                data: data,
            });

            map.addLayer({
                id: "survey_perkembangan",
                type: "circle",
                source: "survey_perkembangan_wilayah",
                paint: {
                    "circle-color": "#4264fb",
                    "circle-stroke-color": "#ffff00",
                    "circle-stroke-width": 1,
                    "circle-radius": 4,
                    "circle-opacity": 0.8,
                },
            });

            map.on("mouseenter", "survey_perkembangan", (e) => {
                map.getCanvas().style.cursor = "pointer";
            });

            map.on("mouseleave", "survey_perkembangan", () => {
                map.getCanvas().style.cursor = "";
                // popupSurvey.remove();
            });

            map.on("click", "survey_perkembangan", (e) => {
                getNJOPSurvey(e);
                const coordinates = e.features[0].geometry.coordinates.slice();
                const dt = e.features[0].properties;
                // console.log(dt);
                // editDataSurvey(dt.id_baru, dt.id_user);
                let imageCarousel = ``;
                let carouselControl = ``;
                let image = JSON.parse(dt.image);
                if (image.length == 0) {
                    imageCarousel = `
                    <div class="carousel-item active">
                        <img src="https://jakarta.pintoinvest.com/survey/not_image.png" class="card-img-top" style="height: 160px;object-fit: cover;">
                    </div>
                    `;
                    carouselControl = ``;
                } else {
                    image.forEach((item, index) => {
                        imageCarousel += `
                        <div class="carousel-item ${
                            index == 0 ? "active" : ""
                        }">
                        <img src="https://jakarta.pintoinvest.com/survey/${
                            item.name
                        }" class="card-img-top" style="height: 160px;object-fit: cover;">
                        </div>
                        `;
                    });
                    if (image.length >= 2) {
                        console.log("carousel enabled");
                        carouselControl = `
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>`;
                    }
                }
                const content = `<div style="width:350px;">
                <div class="imgcard-container">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                ${imageCarousel}
                </div>
               ${carouselControl}
            </div>

                </div>
                <div class="card-body p-2">
                  <h6 class="mt-0 mb-1 card-title border-bottom font-weight-bold" style="font-size:14px;">${
                      dt.name
                  }</h6>
                    <div class="row">
                        <div class="col-sm-4">
                            ID Sub Blok
                        </div>
                        <div class="col-sm-8">
                            ${dt.id_sub_blok}
                        </div>
                        <div class="col-sm-4">
                            Kelurahan
                        </div>
                        <div class="col-sm-8">
                            ${dt.kelurahan}
                        </div>
                        <div class="col-sm-4">
                            Kecamatan
                        </div>
                        <div class="col-sm-8">
                            ${dt.kecamatan}
                        </div>
                        <div class="col-sm-4">
                            Pola Regional
                        </div>
                        <div class="col-sm-8">
                            ${dt.regional}<br>
                            ${desc_pola[dt.regional]}
                        </div>
                        <div class="col-sm-4">
                            Pola Lingkungan
                        </div>
                        <div class="col-sm-8">
                            ${dt.neighborhood}<br>
                            ${desc_pola[dt.neighborhood]}
                        </div>
                        <div class="col-sm-4">
                            Pola Ruang
                        </div>
                        <div class="col-sm-8">
                            ${dt.transect_zone}<br>
                            ${desc_pola[dt.transect_zone]}
                        </div>
                        <div class="col-sm-4">
                        Perkiraan NJOP (Rp. juta per m&sup2)
                        </div>
                        <div class="col-sm-8">
                            <span id="njopSurvey"></span>
                        </div>
                    </div>
                </div>`;

                while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                    coordinates[0] +=
                        e.lngLat.lng > coordinates[0] ? 360 : -360;
                }
                popupSurvey.setLngLat(coordinates).setHTML(content).addTo(map);
            });
        },
    });

    $.ajax({
        url: `${APP_URL}/layerSurveyPerkembanganPartner`,
        method: "GET",
        dataType: "json",
        success: (res) => {
            let data = res;
            // console.log(data);
            map.addSource("survey_perkembangan_wilayah_partner", {
                type: "geojson",
                data: data,
            });

            map.addLayer({
                id: "survey_perkembangan_partner",
                type: "circle",
                source: "survey_perkembangan_wilayah_partner",
                paint: {
                    "circle-color": "#e67e22",
                    "circle-stroke-color": "#ffff00",
                    "circle-stroke-width": 1,
                    "circle-radius": 4,
                    "circle-opacity": 0.8,
                },
            });

            map.on("mouseenter", "survey_perkembangan_partner", (e) => {
                map.getCanvas().style.cursor = "pointer";
            });

            map.on("mouseleave", "survey_perkembangan_partner", () => {
                map.getCanvas().style.cursor = "";
                // popupSurvey.remove();
            });

            map.on("click", "survey_perkembangan_partner", (e) => {
                getNJOPSurvey(e);
                const coordinates = e.features[0].geometry.coordinates.slice();
                const dt = e.features[0].properties;
                // console.log(dt);
                // editDataSurvey(dt.id_baru, dt.id_user);
                let imageCarousel = ``;
                let carouselControl = ``;
                let image = JSON.parse(dt.image);
                if (image.length == 0) {
                    imageCarousel = `
                    <div class="carousel-item active">
                        <img src="https://jakarta.pintoinvest.com/survey/not_image.png" class="card-img-top" style="height: 160px;object-fit: cover;">
                    </div>
                    `;
                    carouselControl = ``;
                } else {
                    image.forEach((item, index) => {
                        imageCarousel += `
                        <div class="carousel-item ${
                            index == 0 ? "active" : ""
                        }">
                        <img src="https://jakarta.pintoinvest.com/survey/${
                            item.name
                        }" class="card-img-top" style="height: 160px;object-fit: cover;">
                        </div>
                        `;
                    });
                    if (image.length >= 2) {
                        console.log("carousel enabled");
                        carouselControl = `
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>`;
                    }
                }
                const content = `<div style="width:350px;">
                <div class="imgcard-container">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                ${imageCarousel}
                </div>
               ${carouselControl}
            </div>

                </div>
                <div class="card-body p-2">
                  <h6 class="mt-0 mb-1 card-title border-bottom font-weight-bold" style="font-size:14px;">${
                      dt.name
                  }</h6>
                    <div class="row">
                        <div class="col-sm-4">
                            ID Sub Blok
                        </div>
                        <div class="col-sm-8">
                            ${dt.id_sub_blok}
                        </div>
                        <div class="col-sm-4">
                            Kelurahan
                        </div>
                        <div class="col-sm-8">
                            ${dt.kelurahan}
                        </div>
                        <div class="col-sm-4">
                            Kecamatan
                        </div>
                        <div class="col-sm-8">
                            ${dt.kecamatan}
                        </div>
                        <div class="col-sm-4">
                            Pola Regional
                        </div>
                        <div class="col-sm-8">
                            ${dt.regional}<br>
                            ${desc_pola[dt.regional]}
                        </div>
                        <div class="col-sm-4">
                            Pola Lingkungan
                        </div>
                        <div class="col-sm-8">
                            ${dt.neighborhood}<br>
                            ${desc_pola[dt.neighborhood]}
                        </div>
                        <div class="col-sm-4">
                            Pola Ruang
                        </div>
                        <div class="col-sm-8">
                            ${dt.transect_zone}<br>
                            ${desc_pola[dt.transect_zone]}
                        </div>
                        <div class="col-sm-4">
                        Perkiraan NJOP (Rp. juta per m&sup2)
                        </div>
                        <div class="col-sm-8">
                            <span id="njopSurvey"></span>
                        </div>
                    </div>
                </div>`;

                while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
                    coordinates[0] +=
                        e.lngLat.lng > coordinates[0] ? 360 : -360;
                }
                popupSurvey.setLngLat(coordinates).setHTML(content).addTo(map);
            });
        },
    });
};

map.on("mouseenter", "survey_dot", (e) => {
    getNJOPSurvey(e);
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.features[0].geometry.coordinates.slice();
    const dt = e.features[0].properties;
    console.log(dt);
    let imageCarousel = ``;
    let carouselControl = ``;
    let image = JSON.parse(dt.image);
    if (image.length == 0) {
        imageCarousel += `
        <div class="carousel-item active">
            <img src="https://jakarta.pintoinvest.com/survey/not_image.png" class="card-img-top" style="height: 160px;object-fit: cover;">
        </div>
        `;
        carouselControl = ``;
    } else {
        image.forEach((item, index) => {
            imageCarousel += `
            <div class="carousel-item ${index == 0 ? "active" : ""}">
                <img src="https://jakarta.pintoinvest.com/survey/${
                    item.name
                }" class="card-img-top" style="height: 160px;object-fit: cover;">
            </div>
            `;
        });

        if (image.length >= 2) {
            carouselControl = `
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>`;
            console.log("carousel enabled");
        }
    }
    const content = `<div style="width:350px;">
    <div class="imgcard-container">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
    ${imageCarousel}
    </div>
    ${carouselControl}
</div>

    </div>
    <div class="card-body p-2">
      <h6 class="mt-0 mb-1 card-title border-bottom font-weight-bold" style="font-size:14px;">${
          dt.name
      }</h6>
        <div class="row">
            <div class="col-sm-4">
                ID Sub Blok
            </div>
            <div class="col-sm-8">
                ${dt.id_sub_blok}
            </div>
            <div class="col-sm-4">
                Kelurahan
            </div>
            <div class="col-sm-8">
                ${dt.kelurahan}
            </div>
            <div class="col-sm-4">
                Kecamatan
            </div>
            <div class="col-sm-8">
                ${dt.kecamatan}
            </div>
            <div class="col-sm-4">
            Pola Regional
        </div>
        <div class="col-sm-8">
            ${dt.regional}<br>
            ${desc_pola[dt.regional]}
        </div>
        <div class="col-sm-4">
            Pola Lingkungan
        </div>
        <div class="col-sm-8">
            ${dt.neighborhood}<br>
            ${desc_pola[dt.neighborhood]}
        </div>
        <div class="col-sm-4">
            Pola Ruang
        </div>
        <div class="col-sm-8">
            ${dt.transect_zone}<br>
            ${desc_pola[dt.transect_zone]}
        </div>
            <div class="col-sm-4">
            Perkiraan NJOP (Rp. juta per m&sup2)
            </div>
            <div class="col-sm-8">
                <span id="njopSurvey"></span>
            </div>
        </div>
    </div>`;

    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }
    popupSurvey.setLngLat(coordinates).setHTML(content).addTo(map);
});

map.on("mouseleave", "survey_dot", () => {
    map.getCanvas().style.cursor = "";
});

// --- Pendataan Usaha --- //
const usahaLocation = () => {
    $(".info-usaha-location").show();
    getDataUsaha(user_id);
};

const getDataUsaha = (id_user) => {
    $.ajax({
        url: `${APP_URL}/getPendataanUsaha`,
        method: "POST",
        data: {
            id_user: id_user,
        },
        dataType: "json",
        success: (e) => {
            if (e != "") {
                $(".list-item-usaha-location").html("");
                $("#messageNoDataUsaha").hide();
                let html = "";
                e.forEach((e) => {
                    html += `
                    <div class="col-sm-3">
                        <img class="w-100" src="/usaha/${
                            e.image[0] == undefined
                                ? "not_image.png"
                                : e.image[0].name
                        }" style="border-radius: 10px; height:75px; cursor: pointer; border:1px #ccc solid; object-fit:cover;">
                    </div>
                    <div class="col-sm-7"
                    onclick="flyToLocation(${e.kordinat.split(",")[0]},${
                        e.kordinat.split(",")[1]
                    }, '${e.kelurahan}')"
                    style="cursor: pointer; font-size:10pt">
                    <a class="w-100 usaha-title"
                        style="font-weight: bold;word-break: break-all;
                    white-space: normal; cursor: pointer;font-size:11pt;">${
                        e.nama_usaha
                    }</a><br>
                    <p class="mt-3" style="line-height:0;">Nama Pemilik : ${
                        e.pelaku
                    }</p>
                    <p style="line-height:0;">No izin: ${e.no_perjanjian}</p>
                </div>
                <div class="col-sm-2 d-flex align-items-center pl-5">
                    <div class="row">
                        <div class="col-12 p-1">
                            <a onclick="deleteDataUsaha(${e.id},${e.id_user})"
                                style="cursor:pointer;color:red;font-size: 18px;"><i
                                    class="fa fa-trash"></i></a>
                        </div>
                    </div>
                </div>
                    `;
                });
                $(".list-item-usaha-location").html(html);
            } else {
                $(".list-item-usaha-location").html("");
                $("#messageNoDataUsaha").show();
            }
        },
    });
};

const editDataUsaha = (id) => {
    $("#resetUsaha").show();
    $.ajax({
        url: `${APP_URL}/getPendataanUsaha/${id}`,
        method: "GET",
        dataType: "json",
        success: (e) => {
            let image = e.image;
            // console.log(e);
            $("#idUsaha").val(e.id);
            $("#namaUsaha").val(e.nama_usaha);
            $("#nikUsaha").val(e.nik);
            $("#npwpUsaha").val(e.npwp);
            $("#pelakuUsaha").val(e.pelaku);
            $("#noPerjanjianUsaha").val(e.no_perjanjian);
            $("#kordinatUsaha").val(e.kordinat);
            $("#sektorUsaha").val(e.sektor);
            $("#modalUsaha").val(e.modal);
            $("#jumlahTenagaUsaha").val(e.jumlah_tenaga);
            $("#alamatUsaha").val(e.alamat);
            if (
                e.badan_usaha !== "Binaan Jakpreneur" &&
                e.badan_usaha !== "Binaan Kementerian" &&
                e.badan_usaha !== "Non Binaan"
            ) {
                $("#opsiBadanUsaha").val("Binaan OPD Teknis").trigger("change");
                $("#badanUsaha").val(e.badan_usaha);
            } else {
                $("#opsiBadanUsaha").val(e.badan_usaha).trigger("change");
            }
            $("#refrensikordinatUsaha").text(
                `${e.kordinat
                    .split(",")[0]
                    .toString()
                    .slice(0, -4)},${e.kordinat
                    .split(",")[1]
                    .toString()
                    .slice(0, -5)}`
            );
            $("#previewFotoUsaha").html("");
            image.forEach((el) => {
                let element = ``;
                element += `
                    <div style="width:33.3%;float:left">
                    <button type="button" class="close btn-remove-usaha" onclick="deleteImageUsaha(${el.id})" style="position: relative;
                    color: red;margin-bottom:-1rem;">
                            <span aria-hidden="true">&times;</span>
                    </button>
                    <img src="/usaha/${el.name}" class="w-100" style="height:100px;object-fit:cover;">
                    </div>
                `;
                $("#previewFotoUsaha").append(element);
            });
            removeItemUsaha();
        },
    });
};

const deleteDataUsaha = (id, id_user) => {
    $.ajax({
        url: `${APP_URL}/deletePendataanUsaha`,
        method: "POST",
        data: {
            id: id,
        },
        success: function (e) {
            $("#pesanBerhasilUsaha").html(
                ` <strong>Berhasil!</strong> Data Berhasil di Hapus.`
            );
            $("#pesanBerhasilUsaha").show();
            setTimeout(function () {
                $("#pesanBerhasilUsaha").hide();
                $("#pesanBerhasilUsaha").html(
                    ` <strong>Berhasil!</strong> Data Berhasil di Simpan.`
                );
            });
            getDataUsaha(id_user);
        },
    });
};

const deleteImageUsaha = (id) => {
    $.ajax({
        url: `${APP_URL}/deleteImageUsaha`,
        method: "POST",
        data: {
            id: id,
        },
        success: (e) => {
            // console.log(e);
        },
    });
};

const removeItemUsaha = (event) => {
    $(".btn-remove-usaha").on("click", function (e) {
        let index = $(this).data("index");
        if (index !== undefined) {
            filesUsaha.splice(filesUsaha.indexOf(Newfiles[index]), 1);
        }
        $(this).parent().remove();
    });
};

const resetUsaha = () => {
    $("#idUsaha").val("");
    $("#namaUsaha").val("");
    $("#nikUsaha").val("");
    $("#npwpUsaha").val("");
    $("#pelakuUsaha").val("");
    $("#noPerjanjianUsaha").val("");
    $("#kordinatUsaha").val("");
    $("#sektorUsaha").val("");
    $("#modalUsaha").val("");
    $("#jumlahTenagaUsaha").val("");
    $("#alamatUsaha").val("");
    $("#idSubbBlokUsaha").val("");
    $("#kelurahanUsaha").val("");
    $("#kecamatanUsaha").val("");
    $("#opsiBadanUsaha").val("Binaan OPD Teknis").trigger("change");
    // $("#badanUsaha").val("")
    $("#refrensikordinatUsaha").text("-");
    $("#textIdSubBlokUsaha").text("-");
    $("#textKelurahanUsaha").text("-");
    $("#textKecamatanUsaha").text("-");
    $("#resetUsaha").hide();
    filesUsaha = [];
    $("#previewFotoUsaha").html("");
};

const preview_foto_usaha = () => {
    let gambarLokasi = $("#gambarLokasiUsaha").get(0).files.length;
    let countArray = Newfiles.length;
    if (gambarLokasi > 3) {
        $("#pesanGagalUsaha").html(
            `<strong>Gagal!</strong> Foto Tidak Boleh Dari Tiga.`
        );
        $("#pesanGagalUsaha").show();
        $("#gambarLokasiUsaha").val("");
        setTimeout(() => {
            $("#pesanGagalUsaha").hide();
            $("#pesanGagalUsaha").html(
                `<strong>Gagal!</strong> Anda Harus Mengisi Semua Form.`
            );
        }, 3000);
    } else {
        for (let i = 0; i < gambarLokasi; i++) {
            let file = $("#gambarLokasiUsaha").get(0).files[i];
            new Compressor(file, {
                quality: 0.3,
                convertSize: 1000000,
                success(result) {
                    filesUsaha.push(result);
                    Newfiles.push(result);
                },
                error(err) {
                    console.log(err.message);
                },
            });
            let element = ``;
            element += `
                <div style="width:33.3%;float:left">
                <button type="button" class="close btn-remove-usaha" data-index="${countArray++}" style="position: relative;
                color: red;margin-bottom:-1rem;">
                        <span aria-hidden="true">&times;</span>
                </button>
                <img src="${URL.createObjectURL(
                    event.target.files[i]
                )}" class="w-100" style="height:100px;object-fit:cover;">
                </div>
            `;
            $("#previewFotoUsaha").append(element);
        }
    }
    removeItemUsaha();
};

$("#formUsahaLocation").on("submit", function (e) {
    e.preventDefault();
    var form_data = new FormData(this);
    let kordinat = $("#kordinatUsaha").val();
    let pelaku = $("#pelakuUsaha").val();
    let namaUsaha = $("#namaUsaha").val();
    let nikUsaha = $("#nikUsaha").val();
    let alamatUsaha = $("#alamatUsaha").val();
    let no_perjanjian = $("#noPerjanjianUsaha").val();
    let sektor = $("#sektorUsaha").val();
    let modal = $("#modalUsaha").val();
    let jumlah_tenaga = $("#jumlahTenagaUsaha").val();
    let id_sub_blok = $("#idSubbBlokUsaha").val();
    let kelurahan = $("#kelurahanUsaha").val();
    let kecamatan = $("#kecamatanUsaha").val();

    if (
        kordinat !== "" &&
        pelaku !== "" &&
        namaUsaha !== "" &&
        nikUsaha !== "" &&
        alamatUsaha !== "" &&
        no_perjanjian !== "" &&
        sektor !== "" &&
        modal !== "" &&
        jumlah_tenaga !== "" &&
        id_sub_blok !== "" &&
        kelurahan !== "" &&
        kecamatan !== ""
    ) {
        $("#submitUsahaLocation").hide();
        $("#prosesUsaha").show();
        $.ajax({
            url: `${APP_URL}/getIdUser`,
            method: "GET",
            success: function (e) {
                var id_user = e;
                form_data.append("id_user", id_user);
                filesUsaha.forEach((file) => {
                    form_data.append("foto[]", file, file.name);
                });
                $.ajax({
                    url: `${APP_URL}/savePendataanUsaha`,
                    method: "POST",
                    contentType: false,
                    processData: false,
                    data: form_data,
                    success: function (e) {
                        $("#submitUsahaLocation").show();
                        $("#prosesUsaha").hide();
                        console.log(e);
                        if ($("#idUsaha").val() == "") {
                            resetUsaha();
                        }
                        getDataUsaha(id_user);
                        $("#pesanBerhasilUsaha").show();
                        setTimeout(function () {
                            $("#pesanBerhasilUsaha").hide();
                        }, 3000);
                    },
                });
            },
        });
    } else {
        $("#submitUsahaLocation").show();
        $("#prosesUsaha").hide();
        $("#pesanGagalUsaha").show();
        setTimeout(function () {
            $("#pesanGagalUsaha").hide();
        }, 3000);
    }
});

// --- Izin Lingkungan --- //
//Get Data Kajian
const getDataKajian = () => {
    $.ajax({
        url: `${APP_URL}/getKajian`,
        method: "GET",
        dataType: "json",
        success: (e) => {
            if (e.data.length == 0) {
                $("#messageNoDataKajian").show();
            } else {
                $("#messageNoDataKajian").hide();
                let html = "";
                e.data.forEach((el) => {
                    let coordinate = JSON.parse(el.kordinat);
                    html += `
                    <div class="col-md-11 my-1" style="cursor:pointer" onclick="referKajian(${coordinate.lat},${coordinate.lng});setParamKajian('${el.itbx}', '${el.ketentuan_khusus}')">
                        <span style="font-size:13px"><b>${el.judul}</b></span><br>
                        <span style="font-size:13px">${el.opini}</span>
                    </div>
                    `;
                });

                $(".list-data-kajian").html("");
                $(".list-data-kajian").html(html);
            }
        },
    });
};

const referKajian = (lat, lng) => {
    map.flyTo({
        center: { lat: lat, lng: lng },
        zoom: 15,
        curve: 1,
    });
    setTimeout(() => {
        map.fire("click", {
            lngLat: { lat: lat, lng: lng },
            point: map.project([lng, lat]),
        });
    }, 2000);
};

const setParamKajian = (itbx, ketentuan_khusus) => {
    param_kajian.itbx = itbx;
    param_kajian.ketentuan_khusus = ketentuan_khusus;
};

$("#cari_permohonan").bindWithDelay(
    "keyup",
    function () {
        let keyword = $(this).val();
        if (keyword == "") {
            $(".wm-search__dropdown").fadeOut();
            $(".wm-search__dropdown").html("");
        } else {
            $.ajax({
                url: `${APP_URL}/searchIzin`,
                method: "POST",
                data: {
                    keyword: keyword,
                },
                dataType: "json",
                success: (e) => {
                    let data = e.data;
                    let html = "";

                    data.forEach((el) => {
                        html += `
                        <li class="wm-li-result" style="font-size: 10pt;" onclick="referIzinPermohonan(${
                            el.lat
                        }, ${el.long}, '${el.wilayah_kewenangan}', '${
                            el.up_kewenangan
                        }', '${el.nomor_permohonan}', '${
                            el.tipe_pengajuan
                        }', '${el.tipe_permohonan}', '${el.kode_izin}', '${
                            el.nama_izin
                        }', '${el.nama_penanggung_jawab}', '${
                            el.nama_perusahaan
                        }', '${el.alamat_kegiatan_izin}', '${
                            el.kelurahan_kegiatan
                        }', '${el.kecamatan_kegiatan}', '${
                            el.tanggal_pengajuan_izin
                        }', '${el.status_terakhir}', '${
                            el.posisi_terakhir
                        }', '${el.komentar_terakhir}', '${el.eta_izin}', '${
                            el.status_waktu_permohonan
                        }', '${el.status_terbaru}', '${
                            el.komentar_terbaru
                        }', '${btoa(
                            JSON.stringify(el.arsip_file)
                        )}')"><i class="fa fa-book"></i> ${
                            el.nomor_permohonan
                        }</li>
                        `;
                    });

                    if (data.length !== 0) {
                        $(".wm-search__dropdown").fadeIn();
                        $(".wm-search__dropdown").html(html);
                    } else {
                        $(".wm-search__dropdown").fadeOut();
                        $(".wm-search__dropdown").html("");
                    }
                },
            });
        }
    },
    500
);

const referIzinPermohonan = (
    lat,
    lng,
    wilayah_kewenangan,
    up_kewenangan,
    nomor_permohonan,
    tipe_pengajuan,
    tipe_permohonan,
    kode_izin,
    nama_izin,
    nama_penanggung_jawab,
    nama_perusahaan,
    alamat,
    kelurahan,
    kecamatan,
    tanggal,
    status_terakhir,
    posisi_terakhir,
    komentar_terakhir,
    eta_izin,
    status_waktu,
    status_terbaru,
    komentar_terbaru,
    arsip
) => {
    $(".wm-search__dropdown").fadeOut();
    $(".wm-search__dropdown").html("");
    map.flyTo({
        center: { lat: lat, lng: lng },
        zoom: 15,
        curve: 1,
    });
    setTimeout(() => {
        map.fire("click", {
            lngLat: { lat: lat, lng: lng },
            point: map.project([lng, lat]),
        });
    }, 2000);

    // $("#koordinatKajian")
    //     .find("a")
    //     .attr("href", `https://www.google.com/maps/search/%09${lat},${lng}`)
    //     .text(`${lat}, ${lng}`);
    $("#koordinatKajian").val(`${lat},${lng}`);
    $("#wilayahKewenanganKajian").text(wilayah_kewenangan);
    $("#upKewenanganKajian").text(up_kewenangan);
    $("#noPermohonanKajian").text(nomor_permohonan);
    $("#tipePengajuanKajian").text(tipe_pengajuan);
    $("#tipePermohonanKajian").text(tipe_permohonan);
    $("#kodeIzinKajian").text(kode_izin);
    $("#namaIzinKajian").text(nama_izin);
    $("#penanggungJawabKajian").text(nama_penanggung_jawab);
    $("#perusahaanKajian").text(nama_perusahaan);
    $("#fieldNomorPermohonan").val(nomor_permohonan);
    $("#alamatKajian").text(alamat);
    $("#kelurhanKajian").text(kelurahan);
    $("#kecamatanKajian").text(kecamatan);
    $("#tanggalKajian").text(tanggal);
    $("#statusTerakhirKajian").text(status_terakhir);
    $("#posisiTerakhirKajian").text(posisi_terakhir);
    $("#komentarTerakhirKajian").text(komentar_terakhir);
    $("#etaIzinKajian").text(eta_izin);
    $("#statusWaktuPermohonanKajian").text(
        status_waktu + " (Terhitung Tanggal 3 Agustus 2022)"
    );
    $("#statusTerbaruKajian").val(status_terbaru);
    $("#komentarTerbaruKajian").val(
        komentar_terbaru == "null" ? "" : komentar_terbaru
    );

    let arsip_file = JSON.parse(atob(arsip));
    let html = "";

    arsip_file.forEach((el) => {
        html += `
        <div clas="w-100">
        <div class="row">
            <div class="col-10">
                <a href="/arsip_izin_lingkungan/${el.file}" target="_blank">${el.file}</a>
            </div>
            <div class="col-2">
                <span onclick="deleteFileArsip(${el.id}, $(this))" class="text-danger" style="cursor:pointer;"><i
                        class="fa fa-close"></i></span>
            </div>
        </div>
    </div>
        `;
    });

    $(".list-arsip-file").html("");
    $(".list-arsip-file").html(html);
};

const deleteFileArsip = (id, element) => {
    $("#prosesIzin").show();
    $("#btnProsesIzin").hide();
    $.ajax({
        url: `${APP_URL}/deleteFileArsip`,
        method: "POST",
        data: {
            id: id,
        },
        success: (e) => {
            let message = e.message;
            $("#prosesIzin").hide();
            $("#btnProsesIzin").show();
            $("#messageSuccessIzin").find("span").text(message);
            $("#messageSuccessIzin").show();
            setTimeout(() => {
                $("#messageSuccessIzin").hide();
            }, 3000);
            element.parent().parent().parent().remove();
        },
    });
};

const getKelurahanIzin = () => {
    $.ajax({
        url: `${APP_URL}/get_list_kelurahan`,
        method: "GET",
        success: (e) => {
            let data = e.data;
            let html = "";
            html += `<option value="">Pilih Kelurahan</option>`;
            data.forEach((el) => {
                html += `
                <option value="${el.kelurahan_kegiatan}">${el.kelurahan_kegiatan}</option>
            `;
            });
            $("#kelurahanIzin").html("");
            $("#kelurahanIzin").html(html);
        },
    });
};

getKelurahanIzin();

const getNamaIzin = (kelurahan) => {
    $.ajax({
        url: `${APP_URL}/get_list_nama_izin/${kelurahan}`,
        method: "GET",
        success: (e) => {
            let data = e.data;
            let html = "";
            html += `<option value="">Pilih Nama Izin</option>`;
            data.forEach((el) => {
                html += `
                <option value="${el.nama_izin}">${el.nama_izin}</option>
            `;
            });
            $("#namaIzin").html("");
            $("#namaIzin").html(html);
        },
    });
};

const getListNomorPermohonan = (kelurahan, nama_izin) => {
    $.ajax({
        url: `${APP_URL}/get_nomor_permohonan/${kelurahan}/${nama_izin}`,
        method: "GET",
        success: (e) => {
            let data = e.data;
            let html = "";
            html += `<option value="">Pilih Nomor Permohonan</option>`;
            data.forEach((el) => {
                html += `
                <option data-lat="${el.lat}" data-long="${
                    el.long
                }" data-wilayah-kewenangan='${
                    el.wilayah_kewenangan
                }' data-up-kewenangan='${
                    el.up_kewenangan
                }' data-nomor-permohonan='${
                    el.nomor_permohonan
                }' data-tipe-pengajuan='${
                    el.tipe_pengajuan
                }' data-tipe-permohonan='${
                    el.tipe_permohonan
                }' data-kode-izin='${el.kode_izin}' data-nama-izin='${
                    el.nama_izin
                }' data-nama-penanggung-jawab='${
                    el.nama_penanggung_jawab
                }' data-nama-perusahaan='${
                    el.nama_perusahaan
                }' data-alamat-kegiatan-izin='${
                    el.alamat_kegiatan_izin
                }' data-kelurahan-kegiatan='${
                    el.kelurahan_kegiatan
                }' data-kecamatan-kegiatan='${
                    el.kecamatan_kegiatan
                }' data-tanggal-pengajuan-izin='${
                    el.tanggal_pengajuan_izin
                }' data-status-terakhir='${
                    el.status_terakhir
                }' data-posisi-terakhir='${
                    el.posisi_terakhir
                }' data-komentar-terakhir='${
                    el.komentar_terakhir
                }' data-eta-izin='${
                    el.eta_izin
                }' data-status-waktu-permohonan='${
                    el.status_waktu_permohonan
                }' data-status-terbaru='${
                    el.status_terbaru
                }' data-komentar-terbaru='${
                    el.komentar_terbaru
                }' data-arsip-file="${btoa(JSON.stringify(el.arsip_file))}">${
                    el.nomor_permohonan
                }</option>
                `;
            });

            $("#nomorPermohonanIzin").html("");
            $("#nomorPermohonanIzin").html(html);
        },
    });
};

const getDetailIzin = (el) => {
    let lat = el.find(":selected").data("lat");
    let long = el.find(":selected").data("long");
    let wilayah_kewenangan = el.find(":selected").data("wilayah-kewenangan");
    let up_kewenangan = el.find(":selected").data("up-kewenangan");
    let nomor_permohonan = el.find(":selected").data("nomor-permohonan");
    let tipe_pengajuan = el.find(":selected").data("tipe-pengajuan");
    let tipe_permohonan = el.find(":selected").data("tipe-permohonan");
    let kode_izin = el.find(":selected").data("kode-izin");
    let nama_izin = el.find(":selected").data("nama-izin");
    let nama_penanggung_jawab = el
        .find(":selected")
        .data("nama-penanggung-jawab");
    let nama_perusahaan = el.find(":selected").data("nama-perusahaan");
    let alamat_kegiatan_izin = el
        .find(":selected")
        .data("alamat-kegiatan-izin");
    let kelurahan_kegiatan = el.find(":selected").data("kelurahan-kegiatan");
    let kecamatan_kegiatan = el.find(":selected").data("kecamatan-kegiatan");
    let tanggal_pengajuan_izin = el
        .find(":selected")
        .data("tanggal-pengajuan-izin");
    let status_terakhir = el.find(":selected").data("status-terakhir");
    let posisi_terakhir = el.find(":selected").data("posisi-terakhir");
    let komentar_terakhir = el.find(":selected").data("komentar-terakhir");
    let eta_izin = el.find(":selected").data("eta-izin");
    let status_waktu_permohonan = el
        .find(":selected")
        .data("status-waktu-permohonan");
    let status_terbaru = el.find(":selected").data("status-terbaru");
    let komentar_terbaru = el.find(":selected").data("komentar-terbaru");
    let arsip_file = el.find(":selected").data("arsip-file");

    referIzinPermohonan(
        lat,
        long,
        wilayah_kewenangan,
        up_kewenangan,
        nomor_permohonan,
        tipe_pengajuan,
        tipe_permohonan,
        kode_izin,
        nama_izin,
        nama_penanggung_jawab,
        nama_perusahaan,
        alamat_kegiatan_izin,
        kelurahan_kegiatan,
        kecamatan_kegiatan,
        tanggal_pengajuan_izin,
        status_terakhir,
        posisi_terakhir,
        komentar_terakhir,
        eta_izin,
        status_waktu_permohonan,
        status_terbaru,
        komentar_terbaru,
        arsip_file
    );
};

$("#formIzinLingkungan").on("submit", function (e) {
    e.preventDefault();
    if ($("#fieldNomorPermohonan").val() == "") {
        $("#messageFailedIzin").show();
        setTimeout(() => {
            $("#messageFailedIzin").hide();
        }, 3000);
    } else {
        let formData = new FormData(this);
        formData.append("koordinat", $("#koordinatKajian").val());
        $("#prosesIzin").show();
        $("#btnProsesIzin").hide();
        $.ajax({
            url: `${APP_URL}/saveIzinLingkungan`,
            method: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: (e) => {
                getDataIzin();
                $("#prosesIzin").hide();
                $("#btnProsesIzin").show();
                // $("#formIzinLingkungan")[0].reset();
                $("#fileIzinArsip").val("");
                $("#messageSuccessIzin").find("span").text(e.message);
                $("#messageSuccessIzin").show();
                setTimeout(() => {
                    $("#messageSuccessIzin").hide();
                }, 3000);
                let html = "";
                e.data.forEach((el) => {
                    html += `
                    <div clas="w-100">
                    <div class="row">
                        <div class="col-10">
                            <a href="/arsip_izin_lingkungan/${el.file}" target="_blank">${el.file}</a>
                        </div>
                        <div class="col-2">
                            <span onclick="deleteFileArsip(${el.id}, $(this))" class="text-danger" style="cursor:pointer;"><i
                                    class="fa fa-close"></i></span>
                        </div>
                    </div>
                </div>
                    `;
                });

                $(".list-arsip-file").html("");
                $(".list-arsip-file").html(html);
                markerIzin.remove();
            },
            error: (e) => {
                let message = e.responseJSON.message;
                console.log(message);
                $("#prosesIzin").hide();
                $("#btnProsesIzin").show();
                $("#messageFailedIzin").find("span").text(message);
                $("#messageFailedIzin").show();
                setTimeout(() => {
                    $("#messageFailedIzin").hide();
                }, 3000);
                getDataIzin();
                markerIzin.remove();
            },
        });
    }
});

const markerIzin = new mapboxgl.Marker({ color: "orange" });

$("#koordinatKajian, #location_nib, #location_iumk").on("focus", () => {
    markerIzin.setLngLat(map.getCenter()).addTo(map);
    map.on("drag", () => {
        markerIzin.setLngLat(map.getCenter());
    });
    map.on("dragend", () => {
        markerIzin.setLngLat(map.getCenter());
        const lngLat = markerIzin.getLngLat();
        $("#koordinatKajian").val(`${lngLat.lat},${lngLat.lng}`);
        $("#location_nib").val(`${lngLat.lat},${lngLat.lng}`);
        $("#location_iumk").val(`${lngLat.lat},${lngLat.lng}`);
    });
});

//Get Layer Izin Lingkungan
const getLayerIzinLingkungan = () => {
    map.addSource("layerIzinLingkungan", {
        type: "geojson",
        data: `${APP_URL}/layer_izin_lingkungan`,
    });
    map.addLayer({
        id: "layerIzinLingkungan",
        source: "layerIzinLingkungan",
        type: "circle",
        paint: {
            "circle-stroke-color": "#ffffff",
            "circle-stroke-width": 1,
            "circle-radius": 4,
            "circle-opacity": 0.8,
            "circle-color": [
                "interpolate",
                ["linear"],
                ["get", "status"],
                0,
                "gray",
                1,
                "green",
                2,
                "red",
                4,
                "yellow",
                5,
                "orange",
            ],
        },
        layout: {
            visibility: "none",
        },
    });
};

const getDataIzin = () => {
    $(".info-layer-izin-lingkungan").show();
    $("#legend-izin-lingkungan").show();
    showLayer("layerIzinLingkungan");
    $.ajax({
        url: `${APP_URL}/get_data_izin`,
        method: "GET",
        dataType: "json",
        success: (e) => {
            let data = e.data;
            let html = "";
            let file_list = "";
            if (data.length > 0) {
                $("#messageNoDataIzin").hide();

                data.forEach((el) => {
                    el.arsip_file.forEach((f) => {
                        file_list += `
                            <a href="/arsip_izin_lingkungan/${f.file}" target="_blank" style="font-size:12px">${f.file}</a><br>
                        `;
                    });
                    html += `
                        <div class="col-12 my-2">
                            <span style="font-size:12px"><b>${el.nomor_permohonan}</b></span><br>
                            ${file_list}
                        </div>
                    `;
                    file_list = "";
                });
                $(".list-data-izin").html("");
                $(".list-data-izin").html(html);
            } else {
                $("#messageNoDataIzin").hide();
                $(".list-data-izin").html("");
            }
        },
    });
};

$("#closeIzinLingkungan").on("click", function () {
    $(".info-layer-izin-lingkungan").hide();
    hideLayer("layerIzinLingkungan");
    $("#legend-izin-lingkungan").hide();
    $("#izin_lingkungan").css("background", "white");
});

// Potensi
const replaceSeparator = (number) => {
    let data = number.replaceAll(".", "").replaceAll(",", ".");

    return parseFloat(data);
};

const potensi = () => {
    let harga_jual = replaceSeparator($(".inf-potensi-harga-jual").val());
    let luas_lahan_efektif = replaceSeparator(
        $(".inf-potensi-luas-lahan-efektif").val()
    );
    let perkiraan_njop = replaceSeparator(
        $(".inf-potensi-perkiraan-njop").val()
    );
    let potensi_luas = replaceSeparator($(".inf-potensi-luas-lahan").val());
    let faktor_pengali = replaceSeparator(
        $(".inf-potensi-faktor-pengali").val()
    );
    let harga_tanah = perkiraan_njop * (faktor_pengali / 100);
    $(".inf-potensi-harga-tanah").val(
        separatorNum(harga_tanah).replaceAll(",", ".")
    );
    let perolehan_tanah = harga_tanah * potensi_luas;

    let klb = replaceSeparator($(".inf-potensi-klb").val());
    let potensi_biaya_konstruksi = replaceSeparator(
        $(".inf-potensi-biaya-konstruksi").val()
    );
    let durasi_proyek = replaceSeparator($(".inf-potensi-durasi-proyek").val());
    let cost_of_capital = replaceSeparator(
        $(".inf-potensi-cost-of-capital").val()
    );
    let property_market_index = replaceSeparator(
        $(".inf-potensi-property-market-index").val()
    );
    let biaya_maintenance = replaceSeparator(
        $(".inf-potensi-biaya-maintenance").val()
    );
    let setara_harga_jual =
        ((harga_jual - harga_jual * (biaya_maintenance / 100)) * 12) /
        (cost_of_capital / 100 - property_market_index / 100);

    $(".inf-potensi-setara-harga-jual").val(
        separatorNum(setara_harga_jual.toFixed(0)).replaceAll(",", ".")
    );

    let setara_harga_jual_final = replaceSeparator(
        $(".inf-potensi-setara-harga-jual").val()
    );

    luasPotensiBangunan = potensi_luas * klb;
    // if ($("#list-potensi-bangunan option:selected").text() == "Perkantoran") {
    //     totalPenerimaanPenjualan =
    //         0 +
    //         (luas_lahan_efektif / 100) *
    //             luasPotensiBangunan *
    //             harga_jual *
    //             12 *
    //             durasi_proyek;
    // }
    if (
        $("#list-potensi-bangunan option:selected").text() ==
            "Perbelanjaan Sewa" ||
        $("#list-potensi-bangunan option:selected").text() ==
            "Perkantoran Sewa" ||
        $("#list-potensi-bangunan option:selected").text() == "Apartemen Sewa"
    ) {
        totalPenerimaanPenjualan =
            0 +
            (luas_lahan_efektif / 100) *
                luasPotensiBangunan *
                setara_harga_jual_final;
    } else {
        totalPenerimaanPenjualan =
            0 + (luas_lahan_efektif / 100) * luasPotensiBangunan * harga_jual;
    }
    let biaya_konstruksi = luasPotensiBangunan * potensi_biaya_konstruksi;
    let biaya_perencanaan =
        ($(".inf-potensi-biaya-perencanaan").val() / 100) * biaya_konstruksi;
    let sub_jumlah_pengeluaran =
        biaya_konstruksi + biaya_perencanaan + perolehan_tanah;
    let kewajiban_lingkungan_pengeluaran =
        ($(".inf-potensi-kewajiban-lingkungan").val() / 100) *
        (70 / 100) *
        perkiraan_njop *
        potensi_luas;
    let estimasi_laba =
        totalPenerimaanPenjualan -
        sub_jumlah_pengeluaran -
        kewajiban_lingkungan_pengeluaran;
    let roi = (estimasi_laba / sub_jumlah_pengeluaran) * 100;
    let irr = (Math.pow(roi / 100 + 1, 1 / durasi_proyek) - 1) * 100;
    $(".inf-potensi-luas-bangunan").val(
        separatorNum(luasPotensiBangunan).replaceAll(",", ".")
    );
    $(".inf-potensi-penerimaan-penjualan").html(
        `${separatorNum(totalPenerimaanPenjualan.toFixed(0))}`
    );
    $(".inf-potensi-sub-jumlah-penjualan").html(
        `${separatorNum(totalPenerimaanPenjualan.toFixed(0))}`
    );
    $(".inf-potensi-perolehan-tanah").html(`${separatorNum(perolehan_tanah)}`);
    $(".inf-potensi-biaya-konstruksi-pengeluaran").html(
        `${separatorNum(biaya_konstruksi.toFixed(0))}`
    );
    $(".inf-potensi-biaya-perencanaan-pengeluaran").html(
        `${separatorNum(biaya_perencanaan.toFixed(0))}`
    );
    $(".inf-potensi-sub-jumlah-pengeluaran").html(
        `${separatorNum(sub_jumlah_pengeluaran.toFixed(0))}`
    );
    $(".inf-potensi-kewajiban-lingkungan-pengeluaran").html(`
        ${separatorNum(kewajiban_lingkungan_pengeluaran.toFixed(0))}
        `);
    $(".inf-potensi-estimasi-laba").html(
        `${separatorNum(estimasi_laba.toFixed(0))}`
    );
    $(".inf-potensi-return-of-invesment").html(
        `${separatorNum(roi.toFixed(2))}%`
    );
    $(".inf-potensi-irr").html(`${separatorNum(irr.toFixed(2))}%`);

    // Save Data Potensi to Session
    let dataPotensi = potensiResult();
    $.post(`${APP_URL}/save_potensi`, { potensi: dataPotensi }).done(() => {
        console.log("Data Potensi Saved");
    });
};

$("#list-potensi-bangunan").on("change", (e) => {
    biayaKonstruksi = parseInt($("#list-potensi-bangunan").val());
    $(".inf-potensi-biaya-konstruksi").val(
        separatorNum(biayaKonstruksi).replaceAll(",", ".")
    );

    if (
        $(`#list-potensi-bangunan option:selected`).text() == "Apartemen Sewa"
    ) {
        $(".inf-potensi-durasi-proyek").val(5);
        $(".inf-potensi-harga-jual").val(
            separatorNum(200000).replaceAll(",", ".")
        );
        $(".inf-potensi-kewajiban-lingkungan").val(20);

        $(".inf-potensi-harga-jual")
            .parent()
            .parent()
            .find("label")
            .html("Harga Sewa (Rp/m<sup>2</sup>/bulan)");
        $(".inf-potensi-cost-of-capital").val("15");
        $(".inf-potensi-cost-of-capital")
            .parent()
            .parent()
            .removeClass("d-none")
            .addClass("d-flex");
        $(".inf-potensi-property-market-index")
            .parent()
            .parent()
            .removeClass("d-none")
            .addClass("d-flex");
        $(".inf-potensi-biaya-maintenance").val("20");
        $(".inf-potensi-biaya-maintenance")
            .parent()
            .parent()
            .removeClass("d-none")
            .addClass("d-flex");
        $(".inf-potensi-faktor-pengali").val("150");

        $(".inf-potensi-setara-harga-jual")
            .parent()
            .parent()
            .removeClass("d-none")
            .addClass("d-flex");
    } else if (
        $(`#list-potensi-bangunan option:selected`).text() == "Perkantoran Sewa"
    ) {
        $(".inf-potensi-harga-jual")
            .parent()
            .parent()
            .find("label")
            .html("Harga Sewa (Rp/m<sup>2</sup>/bulan)");
        $(".inf-potensi-durasi-proyek").val(5);
        $(".inf-potensi-harga-jual").val(
            separatorNum(200000).replaceAll(",", ".")
        );
        $(".inf-potensi-kewajiban-lingkungan").val(20);

        $(".inf-potensi-cost-of-capital").val("15");
        $(".inf-potensi-cost-of-capital")
            .parent()
            .parent()
            .removeClass("d-none")
            .addClass("d-flex");
        $(".inf-potensi-property-market-index")
            .parent()
            .parent()
            .removeClass("d-none")
            .addClass("d-flex");
        $(".inf-potensi-biaya-maintenance").val("20");
        $(".inf-potensi-biaya-maintenance")
            .parent()
            .parent()
            .removeClass("d-none")
            .addClass("d-flex");
        $(".inf-potensi-faktor-pengali").val("150");

        $(".inf-potensi-setara-harga-jual")
            .parent()
            .parent()
            .removeClass("d-none")
            .addClass("d-flex");
    } else if (
        $(`#list-potensi-bangunan option:selected`).text() ==
        "Perbelanjaan Sewa"
    ) {
        $(".inf-potensi-harga-jual")
            .parent()
            .parent()
            .find("label")
            .html("Harga Sewa (Rp/m<sup>2</sup>/bulan)");
        $(".inf-potensi-durasi-proyek").val(5);
        $(".inf-potensi-harga-jual").val(
            separatorNum(743738).replaceAll(",", ".")
        );
        $(".inf-potensi-kewajiban-lingkungan").val(20);

        $(".inf-potensi-cost-of-capital").val("15");
        $(".inf-potensi-cost-of-capital")
            .parent()
            .parent()
            .removeClass("d-none")
            .addClass("d-flex");
        $(".inf-potensi-property-market-index")
            .parent()
            .parent()
            .removeClass("d-none")
            .addClass("d-flex");
        $(".inf-potensi-biaya-maintenance").val("20");
        $(".inf-potensi-biaya-maintenance")
            .parent()
            .parent()
            .removeClass("d-none")
            .addClass("d-flex");
        $(".inf-potensi-faktor-pengali").val("150");

        $(".inf-potensi-setara-harga-jual")
            .parent()
            .parent()
            .removeClass("d-none")
            .addClass("d-flex");
    } else if (
        $(`#list-potensi-bangunan option:selected`).text() == "Apartemen Dijual"
    ) {
        $(".inf-potensi-durasi-proyek").val(5);
        $(".inf-potensi-harga-jual").val(
            separatorNum(20000000).replaceAll(",", ".")
        );
        $(".inf-potensi-kewajiban-lingkungan").val(20);

        $(".inf-potensi-harga-jual")
            .parent()
            .parent()
            .find("label")
            .html("Harga Jual (Rp/m<sup>2</sup>)");
        $(".inf-potensi-cost-of-capital").val("15");
        $(".inf-potensi-cost-of-capital")
            .parent()
            .parent()
            .removeClass("d-flex")
            .addClass("d-none");
        $(".inf-potensi-property-market-index")
            .parent()
            .parent()
            .removeClass("d-flex")
            .addClass("d-none");
        $(".inf-potensi-biaya-maintenance").val("20");
        $(".inf-potensi-biaya-maintenance")
            .parent()
            .parent()
            .removeClass("d-flex")
            .addClass("d-none");
        $(".inf-potensi-faktor-pengali").val("150");
        $(".inf-potensi-setara-harga-jual")
            .parent()
            .parent()
            .removeClass("d-flex")
            .addClass("d-none");
    } else if (
        $(`#list-potensi-bangunan option:selected`).text() ==
        "Rumah Susun Dijual"
    ) {
        $(".inf-potensi-durasi-proyek").val(5);
        $(".inf-potensi-harga-jual").val(
            separatorNum(8750000).replaceAll(",", ".")
        );
        $(".inf-potensi-kewajiban-lingkungan").val(0);
        $(".inf-potensi-durasi-proyek").val(1);

        $(".inf-potensi-harga-jual")
            .parent()
            .parent()
            .find("label")
            .html("Harga Jual (Rp/m<sup>2</sup>)");
        $(".inf-potensi-cost-of-capital").val("15");
        $(".inf-potensi-cost-of-capital")
            .parent()
            .parent()
            .removeClass("d-flex")
            .addClass("d-none");
        $(".inf-potensi-property-market-index")
            .parent()
            .parent()
            .removeClass("d-flex")
            .addClass("d-none");
        $(".inf-potensi-biaya-maintenance").val("20");
        $(".inf-potensi-biaya-maintenance")
            .parent()
            .parent()
            .removeClass("d-flex")
            .addClass("d-none");
        $(".inf-potensi-faktor-pengali").val("150");
        $(".inf-potensi-setara-harga-jual")
            .parent()
            .parent()
            .removeClass("d-flex")
            .addClass("d-none");
    } else if (
        $(`#list-potensi-bangunan option:selected`).text() ==
        "Rumah Tapak Dijual"
    ) {
        $(".inf-potensi-luas-lahan").val(separatorNum(75).replaceAll(",", "."));
        $(".inf-potensi-durasi-proyek").val(2);
        $(".inf-potensi-harga-jual").val(
            separatorNum(40000000).replaceAll(",", ".")
        );
        $(".inf-potensi-kewajiban-lingkungan").val(0);
        $(".inf-potensi-durasi-proyek").val(3);
        $(".inf-potensi-klb").val(4);

        $(".inf-potensi-harga-jual")
            .parent()
            .parent()
            .find("label")
            .html("Harga Jual (Rp/m<sup>2</sup>)");
        $(".inf-potensi-cost-of-capital").val("15");
        $(".inf-potensi-cost-of-capital")
            .parent()
            .parent()
            .removeClass("d-flex")
            .addClass("d-none");
        $(".inf-potensi-property-market-index")
            .parent()
            .parent()
            .removeClass("d-flex")
            .addClass("d-none");
        $(".inf-potensi-biaya-maintenance").val("20");
        $(".inf-potensi-biaya-maintenance")
            .parent()
            .parent()
            .removeClass("d-flex")
            .addClass("d-none");
        $(".inf-potensi-faktor-pengali").val("150");
        $(".inf-potensi-setara-harga-jual")
            .parent()
            .parent()
            .removeClass("d-flex")
            .addClass("d-none");
    } else {
        $(".inf-potensi-harga-jual")
            .parent()
            .parent()
            .find("label")
            .html("Harga Sewa (Rp/m<sup>2</sup>/bulan)");
        $(".inf-potensi-harga-jual").val(
            separatorNum(16000).replaceAll(",", ".")
        );
        $(".inf-potensi-kewajiban-lingkungan").val(0);

        $(".inf-potensi-cost-of-capital").val("15");
        $(".inf-potensi-cost-of-capital")
            .parent()
            .parent()
            .removeClass("d-none")
            .addClass("d-flex");
        $(".inf-potensi-biaya-maintenance").val("20");
        $(".inf-potensi-biaya-maintenance")
            .parent()
            .parent()
            .removeClass("d-none")
            .addClass("d-flex");
        $(".inf-potensi-faktor-pengali").val("150");
        $(".inf-potensi-setara-harga-jual")
            .parent()
            .parent()
            .removeClass("d-none")
            .addClass("d-flex");
    }

    $(".inf-potensi-harga-jual").val();
    potensi();
});

const potensiResult = () => {
    const data = {
        fungsi_bangunan: $("#list-potensi-bangunan option:selected").text(),
        luas_lahan: $(".inf-potensi-luas-lahan").val(),
        luas_lahan_efektif: $(".inf-potensi-luas-lahan-efektif").val(),
        klb: $(".inf-potensi-klb").val(),
        luas_bangunan: $(".inf-potensi-luas-bangunan").val(),
        perkiraan_njop: $(".inf-potensi-perkiraan-njop").val(),
        faktor_pengali: $(".inf-potensi-faktor-pengali").val(),
        harga_tanah: $(".inf-potensi-harga-tanah").val(),
        harga_sewa: $(".inf-potensi-harga-jual").val(),
        biaya_maintenance: $(".inf-potensi-biaya-maintenance").val(),
        cost_of_capital: $(".inf-potensi-cost-of-capital").val(),
        property_market_index: $(".inf-potensi-property-market-index").val(),
        setara_harga_jual: $(".inf-potensi-setara-harga-jual").val(),
        durasi_proyek: $(".inf-potensi-durasi-proyek").val(),
        biaya_konstruksi: $(".inf-potensi-biaya-konstruksi").val(),
        biaya_perencanaan: $(".inf-potensi-biaya-perencanaan").val(),
        kewajiban_lingkungan: $(".inf-potensi-kewajiban-lingkungan").val(),
        pendapatan_penjualan: $(".inf-potensi-penerimaan-penjualan").text(),
        total_pendapatan: $(".inf-potensi-sub-jumlah-penjualan").text(),
        perolehan_tanah: $(".inf-potensi-perolehan-tanah").text(),
        biaya_konstruksi_pengeluaran: $(
            ".inf-potensi-biaya-konstruksi-pengeluaran"
        ).text(),
        biaya_perencanaan_pengeluaran: $(
            ".inf-potensi-biaya-perencanaan-pengeluaran"
        ).text(),
        total_pengeluaran: $(".inf-potensi-sub-jumlah-pengeluaran").text(),
        kewajiban_lingkungan_pengeluaran: $(
            ".inf-potensi-kewajiban-lingkungan-pengeluaran"
        )
            .text()
            .replace(/[^0-9,]/g, ""),
        estimasi_laba: $(".inf-potensi-estimasi-laba").text(),
        roi: $(".inf-potensi-return-of-invesment").text(),
        irr: $(".inf-potensi-irr").text(),
    };

    return data;
};

$("input[type=number]").on("focus", function (e) {
    $(this).on("wheel.disableScroll", function (e) {
        e.preventDefault();
    });
});
$("input[type=number]").on("blur", function (e) {
    $(this).off("wheel.disableScroll");
});

// Fixing Active Tab
$("#pills-tab-1 > li a").on("click", (e) => {
    $("#pills-tab-2").find(".active").length > 0
        ? $("#pills-tab-2").find(".active").removeClass("active")
        : null;
});

$("#pills-tab-2 > li a").on("click", (e) => {
    $("#pills-tab-1").find(".active").length > 0
        ? $("#pills-tab-1").find(".active").removeClass("active")
        : null;
});

// Print PDF
const checkBoxPrint = (type, element) => {
    if (element.prop("checked") == true) {
        // Check Option KBLI
        if (
            type == "kbli" &&
            ($("#kegiatan").select2("val") == null ||
                $("#kegiatan").select2("val") == "Pilih Bangunan")
        ) {
            $("#pesanGagalPrint")
                .html(
                    "<strong>Gagal!</strong> Anda Harus Memilih Opsi Dropdown di KBLI."
                )
                .show();

            setTimeout(() => {
                $("#pesanGagalPrint").hide();
            }, 3000);

            element.prop("checked", false);
        } else if (
            type == "lingkungan" &&
            ($("#selectSimulasi").select2("val") == null ||
                $("#selectSimulasi").select2("val") == "")
        ) {
            $("#pesanGagalPrint")
                .html(
                    "<strong>Gagal!</strong> Anda Harus Memilih Peruntukan Bangunan."
                )
                .show();

            setTimeout(() => {
                $("#pesanGagalPrint").hide();
            }, 3000);

            element.prop("checked", false);
        } else if (type == "ketentuan") {
            let ketentuan_properties = ketentuanProperties();
            $.post(`${APP_URL}/save_ketentuan`, {
                ketentuan: ketentuan_properties,
            }).done(() => {
                console.log("Ketentuan Saved");
            });
        }
    }
};

$("#printAll").on("click", (e) => {
    if (
        $("#checkboxProfil").prop("checked") == true ||
        $("#checkboxAkses").prop("checked") == true ||
        $("#checkboxIndikator").prop("checked") == true ||
        $("#checkboxKBLI").prop("checked") == true ||
        $("#checkboxLingkungan").prop("checked") == true ||
        $("#checkboxPotensi").prop("checked") == true ||
        $("#checkboxKetentuan").prop("checked") == true
    ) {
        // Save Coordinates
        $("#formPrint input[name='coordinates_print']").val(
            `${marker.getLngLat().lat},${marker.getLngLat().lng}`
        );

        // Save Radius
        $("#formPrint input[name='radius']").val($("#ControlRange").val());

        // Save Image
        map.resize();
        $("#formPrint input[name='image_map']").val(
            map.getCanvas().toDataURL("image/png")
        );

        // Save KBLI
        $("#formPrint input[name='kbli_properties']").val(
            btoa(JSON.stringify(kbliProperties()))
        );

        // Save Lingkungan
        $("#formPrint input[name='lingkungan_properties']").val(
            btoa(JSON.stringify(getResultSimulasi()))
        );

        // Save Potensi
        $("#formPrint input[name='potensi_properties']").val(
            btoa(JSON.stringify(potensiResult()))
        );

        // Save Ketentuan
        $("#formPrint input[name='ketentuan_properties']").val(
            btoa(JSON.stringify(ketentuanProperties()))
        );

        $("#formPrint").submit();
    } else {
        $("#pesanGagalPrint")
            .html("<strong>Gagal!</strong> Anda Harus Memilih Salah Satu.")
            .show();
        setTimeout(() => {
            $("#pesanGagalPrint").hide();
        }, 3000);
    }
});

// Reset Option Print
const resetOptionPrint = () => {
    $.ajax({
        url: `${APP_URL}/reset_check_print`,
        type: "GET",
    });
};

// Close Print
const close_print = () => {
    $(".info-print-data").hide();
};

// --- Ketentuan TPZ Properties --- //
const ketentuanTPZProperties = () => {
    let list_tpz = $(".inf-ketentuan-tpz-list > option").length;

    let tpz_properties = [];

    const get_list_file = (docs) => {
        let list_file = [];
        const pattern = /href="(.+?\.pdf)"/g;
        const matches = docs.matchAll(pattern);

        for (const match of matches) {
            const url = match[1];
            list_file.push(url);
        }

        return list_file;
    };

    for (let i = 0; i < list_tpz; i++) {
        const {
            kode_tpz,
            tipe_kawasan,
            nama_kawasan,
            skala_kawasan,
            arah_pengembangan,
            index_pengendali,
            max_kdb,
            max_ktb,
            max_klb,
        } = JSON.parse(
            atob($(`.inf-ketentuan-tpz-list > option:eq(${i})`).val())
        );

        if (kode_tpz == "d") {
            let properties = {};
            properties.Jenis_TPZ = "(d) Performa";
            properties.Nama_TPZ = "Performa";
            properties.Tipe_Kawansan = tipe_kawasan;
            properties.Nama_Kawasan = nama_kawasan;
            properties.Skala_Kawasan =
                skala_kawasan == null ? "-" : skala_kawasan;

            let list_link_pdf = ``;
            if (tipe_kawasan == "Kawasan Kompak") {
                list_link_pdf = `
                        <a href="/pdf_file/ketentuan_tpz/performa_kompak_1.pdf" class="text_all_mobile w-100" target="_blank">Kriteria Perencanaan Kawasan Kompak </a><br>
                        <a href="/pdf_file/ketentuan_tpz/performa_kompak_2.pdf" class="text_all_mobile w-100" target="_blank">Detail Rencana Kawasan Kompak</a><br>
                        <a href="/pdf_file/ketentuan_tpz/performa_kompak_3.pdf" class="text_all_mobile w-100" target="_blank">Pengelolaan Kawasan Kompak</a><br>
                        <a href="/pdf_file/ketentuan_tpz/performa_kompak_4.pdf" class="text_all_mobile w-100" target="_blank">Dokumen Rancang Bangun Pada Kawasan Kompak</a><br>
                        <a href="/pdf_file/ketentuan_tpz/performa_kompak_5.pdf" class="text_all_mobile w-100" target="_blank">Pengajuan Dokumen Rancang Bangun Untuk Kawasan Kompak</a><br>
                `;
            } else {
                list_link_pdf = `
                        <a href="/pdf_file/ketentuan_tpz/performa_transit_1.pdf" class="text_all_mobile w-100" target="_blank">Kriteria Perencanaan Kawasan Transit</a><br>
                        <a href="/pdf_file/ketentuan_tpz/performa_transit_2.pdf" class="text_all_mobile w-100" target="_blank">Detail Rencana Kawasan Transit</a><br>
                        <a href="/pdf_file/ketentuan_tpz/performa_transit_3.pdf" class="text_all_mobile w-100" target="_blank">Pengelolaan Kawasan Transit</a><br>
                        <a href="/pdf_file/ketentuan_tpz/performa_transit_4.pdf" class="text_all_mobile w-100" target="_blank">Dokumen Rancang Bangun Pada Kawasan Transit</a><br>
                        <a href="/pdf_file/ketentuan_tpz/performa_transit_5.pdf" class="text_all_mobile w-100" target="_blank">Pengajuan Dokumen Rancang Bangun Untuk Kawasan Transit</a><br>
                `;
            }

            properties.Link_PDF = list_link_pdf;

            properties.List_File = get_list_file(properties.Link_PDF);
            tpz_properties.push(properties);
        } else if (kode_tpz == "l") {
            let properties = {};
            properties.Jenis_TPZ = "(l) Cagar Budaya";
            properties.Nama_TPZ = "Cagar Budaya";
            properties.Jenis_Kawansan = tipe_kawasan;
            properties.Nama_Kawasan = nama_kawasan;

            let list_link_pdf = `
                <a href="/pdf_file/ketentuan_tpz/cagar_budaya_1.pdf" class="text_all_mobile w-100" target="_blank">Ketentuan Pelestarian	</a><br>
                <a href="/pdf_file/ketentuan_tpz/cagar_budaya_2.pdf" class="text_all_mobile w-100" target="_blank">Ketentuan Pembangunan Baru</a><br>`;

            properties.Link_PDF = list_link_pdf;

            properties.List_File = get_list_file(properties.Link_PDF);
            tpz_properties.push(properties);
        } else if (kode_tpz == "h") {
            let properties = {};

            properties.Jenis_TPZ = "(h) Ambang";
            properties.Nama_TPZ = "Ambang";
            properties.Jenis_Kawansan = tipe_kawasan;
            properties.Nama_Kawasan = nama_kawasan;
            properties.Arah_Pengembangan = arah_pengembangan;

            let list_link_pdf = `
                <a href="/pdf_file/ketentuan_tpz/ambang_1.pdf" class="text_all_mobile w-100" target="_blank">Ketentuan Umum TPZ Ambang</a><br>
                <a href="/pdf_file/ketentuan_tpz/ambang_2.pdf" class="text_all_mobile w-100" target="_blank">Proposal Dokumen Pengembangan Kawasan Pada Zona Ambang</a><br>
                <a href="/pdf_file/ketentuan_tpz/ambang_3.pdf" class="text_all_mobile w-100" target="_blank">Pengajuan Dokumen Pengembangan Kawasan Untuk Kawasan Zona Ambang </a><br>
            `;

            properties.Link_PDF = list_link_pdf;

            properties.List_File = get_list_file(properties.Link_PDF);
            tpz_properties.push(properties);
        } else if (kode_tpz == "k1" || kode_tpz == "k2") {
            let properties = {};

            properties.Jenis_TPZ = `(${kode_tpz}) Pengendalian Pertumbuhan`;
            properties.Nama_TPZ = "Pengendalian Pertumbuhan";

            $(".inf-ketentuan-tpz-nama-kawasan").html(nama_kawasan);

            let list_link_pdf = ``;

            if (kode_tpz == "k1") {
                list_link_pdf = `
                        <a href="/pdf_file/ketentuan_tpz/pengendalian_k1.pdf" class="text_all_mobile w-100" target="_blank">Ketentuan Umum TPZ Zona Pengendalian Pertumbuhan Kawasan sapi perah di Kawasan Pondok Ranggon 	</a><br>
                    `;
            } else {
                list_link_pdf = `
                        <a href="/pdf_file/ketentuan_tpz/pengendalian_k2.pdf" class="text_all_mobile w-100" target="_blank">Zona Pengendalian Pertumbuhan untuk kegiatan industri menengah dan besar yang berada di luar Sub-Zona KPI </a><br>
                    `;
            }

            properties.Link_PDF = list_link_pdf;

            properties.List_File = get_list_file(properties.Link_PDF);
            tpz_properties.push(properties);
        } else if (kode_tpz == "b") {
            let properties = {};

            properties.Jenis_TPZ = "(b) Bonus";
            properties.Nama_TPZ = "Bonus";
            properties.Jenis_Kawansan = tipe_kawasan;
            properties.Nama_Kawasan = nama_kawasan;
            properties.Skala_Kawasan =
                skala_kawasan == null ? "-" : skala_kawasan;
            properties.KDB_Bonus = `${max_kdb * 100}%`;
            properties.KTB_Bonus = `${max_ktb * 100}%`;

            let klb_parse = parseInt(KLB);
            if (max_klb == "Rumus : KLB Dasar x (2-Indeks Pengendali)") {
                let result = klb_parse * (2 - index_pengendali);
                properties.KLB_Bonus = `${result.toFixed(2)}`;
            } else if (
                max_klb ==
                "Rumus : [KLB Dasar x (2-Indeks Pengendali)] x (1+5%)"
            ) {
                let result = klb_parse * (2 - index_pengendali) * (1 + 5 / 100);
                properties.KLB_Bonus = `${result.toFixed(2)}`;
            } else if (
                max_klb ==
                "Rumus : [KLB Dasar x (2-Indeks Pengendali)] x (1+30%)"
            ) {
                let result =
                    klb_parse * (2 - index_pengendali) * (1 + 30 / 100);
                properties.KLB_Bonus = `${result.toFixed(2)}`;
            } else if (
                max_klb ==
                "Rumus : [KLB Dasar x (2-Indeks Pengendali)] x (1+20%)"
            ) {
                let result =
                    klb_parse * (2 - index_pengendali) * (1 + 20 / 100);
                properties.KLB_Bonus = `${result.toFixed(2)}`;
            } else if (
                max_klb ==
                "Rumus : [KLB Dasar x (2-Indeks Pengendali)] x (1+15%)"
            ) {
                let result =
                    klb_parse * (2 - index_pengendali) * (1 + 15 / 100);
                properties.KLB_Bonus = `${result.toFixed(2)}`;
            }

            let list_link_pdf = `
                        <a href="/pdf_file/ketentuan_tpz/bonus_1.pdf" class="text_all_mobile w-100" target="_blank">Ketentuan Umum TPZ Bonus</a><br>
                        <a href="/pdf_file/ketentuan_tpz/bonus_2.pdf" class="text_all_mobile w-100" target="_blank">Lahan Perencanaan yang Tidak Dikenakan Kontribusi pada Zona Bonus </a><br>
                        <a href="/pdf_file/ketentuan_tpz/bonus_3.pdf" class="text_all_mobile w-100" target="_blank">Pengajuan Peningkatan Besaran Intensitas di Zona Bonus </a><br>
                        <a href="/pdf_file/ketentuan_tpz/bonus_4.pdf" class="text_all_mobile w-100" target="_blank">Pelanggaran Peningkatan Besaran Intensitas di Zona Bonus </a><br>
                    `;

            properties.Link_PDF = list_link_pdf;

            properties.List_File = get_list_file(properties.Link_PDF);
            tpz_properties.push(properties);
        } else if (kode_tpz.includes("m1") || kode_tpz.includes("m2")) {
            let properties = {};
            let bonus = kode_tpz.includes("b")
                ? "Terdapat zona bonus : Ya"
                : "Terdapat zona bonus : Tidak";
            let pdf = "";
            if (kode_tpz.includes("m1")) {
                properties.Jenis_TPZ = `(m1) Intensitas Sangat Tinggi`;
                properties.Nama_TPZ =
                    "Lahan Perencanaan dengan Intensitas Pemanfaatan Ruang melebihi batasan Intensitas Pemanfaatan Ruang yang didasarkan pada ketentuan peraturan perundang-undangan sebelum Peraturan Gubernur ini ditetapkan";
                properties.Ketentuan = `Ketentuan TPZ Zona Intensitas Sangat Tinggi: Lahan Perencanaan dengan Intensitas Pemanfaatan Ruang melebihi batasan Intensitas Pemanfaatan Ruang yang didasarkan pada ketentuan peraturan perundang-undangan sebelum Peraturan Gubernur ini ditetapkan.<br>
                    ${bonus}
                    `;
                if (kode_tpz.includes("b")) {
                    pdf = `
                            <a href="/pdf_file/ketentuan_tpz/intensitas_1.pdf" class="text_all_mobile w-100" target="_blank">Ketentuan TPZ m1 di dalam zona bonus </a><br>
                    `;
                } else {
                    pdf = `
                            <a href="/pdf_file/ketentuan_tpz/intensitas_2.pdf" class="text_all_mobile w-100" target="_blank">Ketentuan TPZ m1 di luar zona bonus </a><br>
                    `;
                }
            } else {
                properties.Jenis_TPZ = `(m2) Intensitas Sangat Tinggi`;
                properties.Nama_TPZ =
                    "Lahan Perencanaan yang memperoleh pelampauan KLB dari Intensitas Pemanfaatan Ruang berdasarkan ketentuan peraturan perundang-undangan sebelum Peraturan Gubernur ini ditetapkan ";
                properties.Ketentuan = `Ketentuan TPZ Zona Intensitas Sangat Tinggi: Lahan Perencanaan yang memperoleh pelampauan KLB dari Intensitas Pemanfaatan Ruang berdasarkan ketentuan peraturan perundang-undangan sebelum Peraturan Gubernur ini ditetapkan<br>
                    ${bonus}`;

                pdf = `
                            <a href="/pdf_file/ketentuan_tpz/intensitas_3.pdf" class="text_all_mobile w-100" target="_blank">Ketentuan TPZ m2 </a><br>
                    `;
            }

            properties.Link_PDF = pdf;

            properties.List_File = get_list_file(properties.Link_PDF);
            tpz_properties.push(properties);
        }
    }

    return tpz_properties;
};

// --- Mapping Data Ketentuan --- //
const ketentuanProperties = (e) => {
    let list_gsb = $(".list-ketentuan-gsb")
        .html()
        .replaceAll(/[\r\n]+/gm, "")
        .trim();
    const regex_1 =
        /<select class="list-lebar-jalan" style="width:160px;"[^>]*>(.*?)<\/select>/g;
    const regex_2 =
        /<select class="list-lebar-sungai" style="width:160px;"[^>]*>(.*?)<\/select>/g;
    const regex_3 =
        /<select class="list-fungsi-bangunan" style="width:160px;"[^>]*>(.*?)<\/select>/g;
    const data = {
        identitas_zonasi: {
            zona: $(".inf-zona").eq(0).text(),
            sub_zona: $(".inf-subzona").eq(0).text(),
            kode_sub_zona: $(".inf-kode-sub-zona").text(),
            id_blok: $(".inf-id-blok").text(),
            id_sub_blok: $(".inf-id-sub-blok").eq(0).text(),
        },
        intensitas_pemanfaatan_ruang: {
            luas_lahan:
                $("#option_intensitas_luas").val() == undefined
                    ? $(".inf-luas-lahan").text()
                    : $("#option_intensitas_luas").val(),
            kdb:
                $("#option_intensitas_kdb").val() == undefined
                    ? $(".inf-kdb").eq(0).text()
                    : $("#option_intensitas_kdb").val(),
            klb: $(".inf-klb").eq(0).text(),
            kdh: $(".inf-kdh").eq(0).text(),
            ketinggian_bangunan: $(".inf-ketinggian-bangunan").text(),
        },
        ketentuan_penggunaan_lahan: {
            jenis_bangunan:
                $(".inf-jenis-bangunan").val() == "Pilih Jenis Bangunan..."
                    ? "-"
                    : $(".inf-jenis-bangunan").val(),
            definisi_bangunan: $(".inf-definisi-bangunan").text(),
            perizinan: $(".inf-ketentuan-perizinan").text(),
            keterangan: $(".inf-keterangan").text(),
        },
        ketentuan_hunian: {
            jenis_hunian: $("#list-jenis-bangunan option:selected").text(),
            tipikal: $("#list-tipikal option:selected").text(),
            luas_lahan: $("#list-luas-lahan option:selected").text(),
            etc:
                $("#list-luas-lahan").val() == "Pilih Luas Lahan"
                    ? null
                    : JSON.parse(atob($("#list-luas-lahan").val())),
        },
        ketentuan_kkop: {
            nama_bandara: $(".inf-ketentuan-kkop-list option:selected").text(),
            jenis: $(".inf-ketentuan-kkop-list").val(),
        },
        ketentuan_tata_bangunan: {
            gsnb: $(".list-ketentuan-gsnb").html(),
            gsb: list_gsb
                .replace(
                    regex_1,
                    `<span>${$(
                        ".list-lebar-jalan option:selected"
                    ).text()}</span>`
                )
                .replace(
                    /<span style="float:right;"[^>]*>(.*?)<\/span>/g,
                    `<span>$1</span>`
                )
                .replace(
                    regex_2,
                    `<span>${$(
                        ".list-lebar-sungai option:selected"
                    ).text()}</span>`
                )
                .replace(
                    /<span style="float:right;"[^>]*>(.*?)<\/span>/g,
                    `<span>$1</span>`
                )
                .replace(
                    regex_3,
                    `<span>${$(
                        ".list-fungsi-bangunan option:selected"
                    ).text()}</span>`
                )
                .replace(
                    /<span style="float:right;"[^>]*>(.*?)<\/span>/g,
                    `<span>$1</span>`
                ),
        },
    };

    if ($(".inf-rthrtb").css("display") !== "none") {
        data.ketentuan_potensi_rthrtb = {
            jenis: $(".inf-ketentuan-rthrtb-jenis").text(),
            sub_zona: $(".inf-ketentuan-rthrtb-sub-zona").text(),
        };
    }

    if ($("#ketentuan-variansi").css("display") !== "none") {
        data.ketentuan_variansi = {
            jenis_bangunan: $(
                "#list-jenis-bangunan-variansi option:selected"
            ).text(),
            etc:
                $("#list-jenis-bangunan-variansi").val() ==
                "Pilih Jenis Bangunan"
                    ? ""
                    : JSON.parse(
                          atob($("#list-jenis-bangunan-variansi").val())
                      ),
        };
    }

    if ($(".section_ketentuan_rawan_bencana").css("display") !== "none") {
        data.ketentuan_rawan_bencana = {
            nama_kawasan: $(".inf-ketentuan-rawan-bencana-nama-kawasan").text(),
            resiko: $(".inf-ketentuan-rawan-bencana-resiko-kawasan").text(),
            ketentuan: $(".list-ketentuan-rawan-bencana").html(),
        };
    }

    if ($(".section_ketentuan_tpz").css("display") !== "none") {
        data.ketentuan_tpz = ketentuanTPZProperties();
    }

    return data;
};

const distinctValuesByNestedKey = (objects, nestedKey) => {
    // Use a Set to store distinct values
    const distinctSet = new Set();

    for (const obj of objects) {
        let nestedValue = obj;
        const keys = nestedKey.split(".");

        // Access the nested value
        for (const key of keys) {
            nestedValue = nestedValue[key];
            if (nestedValue === undefined) {
                break;
            }
        }

        // Add the value to the set
        if (nestedValue !== undefined) {
            distinctSet.add(nestedValue);
        }
    }

    // Return an array of distinct values
    return Array.from(distinctSet);
};

const filterObjectsByNestedParams = (objects, params) => {
    return objects.filter((obj) => {
        for (const key in params) {
            if (
                !params.hasOwnProperty(key) ||
                params[key] === null ||
                params[key] === ""
            ) {
                continue; // Ignore the parameter if key is empty or null
            }
            const nestedKeys = key.split(".");
            let nestedValue = obj;
            for (const nestedKey of nestedKeys) {
                if (
                    !nestedValue.hasOwnProperty(nestedKey) ||
                    nestedValue[nestedKey] === null ||
                    nestedValue[nestedKey] === ""
                ) {
                    return false; // Ignore the object if nested key is empty or null
                }
                nestedValue = nestedValue[nestedKey];
            }
            const paramValue = params[key];
            if (typeof paramValue === "string") {
                // Check if the parameter value is a string
                if (paramValue.endsWith("*")) {
                    // Support for "like" operator with starting character pattern
                    const pattern = paramValue.substring(
                        0,
                        paramValue.length - 1
                    );
                    if (!nestedValue.startsWith(pattern)) {
                        return false;
                    }
                } else if (nestedValue !== paramValue) {
                    // Support for equal (=) operator
                    return false;
                }
            } else if (Array.isArray(paramValue) && paramValue.length === 2) {
                // Check if the parameter value is an array with two elements
                const [minValue, maxValue] = paramValue;
                if (minValue !== null && nestedValue < minValue) {
                    return false;
                }
                if (maxValue !== null && nestedValue > maxValue) {
                    return false;
                }
            } else if (nestedValue !== paramValue) {
                // Support for equal (=) operator for non-string values
                return false;
            }
        }
        return true;
    });
};

// Hide and Show Sidebar content
$("#hide_side_bar").click((e) => {
    $("#hide_side_bar").hide();
    $("#sidebar-content").hide();
    $("#show_side_bar").show();
});

$("#show_side_bar").click((e) => {
    $("#show_side_bar").hide();
    $("#sidebar-content").show();
    $("#hide_side_bar").show();
});

// Filter Geo

$("input[name='option_filter']").change((e) => {
    // if (e.target.checked) {
    //     $("#njop_filter").attr("disabled", false);
    // } else {
    //     $("#njop_filter").attr("disabled", true);
    // }

    if ($("input[name='option_filter'][value='njop']:checked").length) {
        $("#njop_filter").attr("disabled", false);
    } else {
        $("#njop_filter").attr("disabled", true);
    }

    if ($("input[name='option_filter'][value='sub_zona']:checked").length) {
        $("#sub_zona_filter").attr("disabled", false);
    } else {
        $("#sub_zona_filter").attr("disabled", true);
    }

    if (
        $("input[name='option_filter'][value='transect_zone']:checked").length
    ) {
        $("#transect_zone_filter").attr("disabled", false);
        $("#transect_zone_year_filter").attr("disabled", false);
    } else {
        $("#transect_zone_filter").attr("disabled", true);
        $("#transect_zone_year_filter").attr("disabled", true);
    }

    if ($("input[name='option_filter'][value='ecci']:checked").length) {
        $("#ecci_filter").attr("disabled", false);
    } else {
        $("#ecci_filter").attr("disabled", true);
    }

    if ($("input[name='option_filter'][value='livability']:checked").length) {
        $("#livability_filter").attr("disabled", false);
    } else {
        $("#livability_filter").attr("disabled", true);
    }

    filterGeo();
});

$(
    "#njop_filter, #sub_zona_filter, #ecci_filter, #transect_zone_filter, #transect_zone_year_filter, #livability_filter"
).change((e) => {
    filterGeo();
});

$(
    "#njop_filter, #sub_zona_filter, #ecci_filter, #transect_zone_filter, #transect_zone_year_filter, #livability_filter"
).keyup((e) => {
    filterGeo();
});

const resetFilterGeo = () => {
    $("input[name='option_filter']").each((index, element) => {
        element.checked = false;
    });

    $("#njop_filter").val("").attr("disabled", true);
    $("#sub_zona_filter").val("").attr("disabled", true);
    $("#ecci_filter").val("").attr("disabled", true);
    $("#transect_zone_filter").val("").attr("disabled", true);
    $("#transect_zone_year_filter").val("").attr("disabled", true);
    $("#livability_filter").val("").attr("disabled", true);

    if (map.getLayer("geo_filter")) {
        map.removeLayer("geo_filter");
        map.removeSource("filter");
    }
};

const filterGeo = () => {
    let request = {};

    request.kelurahan = localStorage.getItem("kelurahan");
    request.option = $("input[name='option_filter']:checked").val();
    request.njop = $("#njop_filter").val();
    request.sub_zona = $("#sub_zona_filter").val();
    request.ecci = $("#ecci_filter").val();
    request.transect_zone = $("#transect_zone_filter").val();
    request.transect_zone_year = $("#transect_zone_year_filter").val();
    request.livability = $("#livability_filter").val();

    $.ajax({
        url: `${url_api}/filter_geo`,
        type: "POST",
        data: request,
        headers: {
            Authorization: "Bearer " + token,
        },
        dataType: "json",
        success: (response) => {
            if (map.getLayer("geo_filter")) {
                map.removeLayer("geo_filter");
                map.removeSource("filter");
            }

            map.addSource("filter", {
                type: "geojson",
                data: response,
            });

            map.addLayer({
                id: "geo_filter",
                type: "fill",
                source: "filter",
                layout: {},
                paint: {
                    "fill-color": "#fff",
                    "fill-opacity": 0.8,
                    "fill-outline-color": "#000",
                },
            });
        },
    });
};

// Hide and Show Ketentuan Tab
$("input[name='rdtr']").change((e) => {
    let id = e.target.id;

    if (id == "zoning_fill") {
        $("#ketentuan-tab").parent().show();
        $("#pills-ketentuan").show();
    } else {
        $("#ketentuan-tab").parent().hide();
        $("#pills-ketentuan").hide();
    }
});
