//Global Variable
let url_api = `https://jakarta.pintoinvest.com:3444`;
let iddle_zoning = false;
//Global Variable for Chart
let pie,
    bar,
    radar,
    radar_liveability,
    bar_io_pengadaan_kerja,
    bar_io_tertutup,
    bar_io_leontiff_terbuka,
    bar_io_dampak_pendapatan,
    bar_io_dampak_pendapatan_bruto,
    bar_io_keterkaitan_hulu_hilir;

let kilometer = $("#ControlRange").val() / 1000;
let setAttrClick;
let luasSimulasi;
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
    "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE2OTI5NjE2NjYsIm5hbWUiOiJhZG1pbiJ9.22lpo1DdxrZd_iKS5-yHyEhy5M9mt3QP-cekN65uwFk";

//Initialize the map
mapboxgl.accessToken =
    "pk.eyJ1IjoibWVudGhvZWxzciIsImEiOiJja3M0MDZiMHMwZW83MnVwaDZ6Z2NhY2JxIn0.vQFxEZsM7Vvr-PX3FMOGiQ";
const map = new mapboxgl.Map({
    container: "map",
    style: "mapbox://styles/menthoelsr/ckp6i54ay22u818lrq15ffcnr",
    preserveDrawingBuffer: true,
});

//Add Icon Layer
map.loadImage(`/assets/gambar/ICON.png`, function (error, image) {
    if (error) throw error;
    map.addImage("point", image);
});

//Initialize Select2
$(
    "#kegiatanRuang, #kegiatanRuangNew, #kegiatan, #kegiatanKewenangan, #selectSimulasi, #skala"
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
        "#lokasi-tab, #ketentuan-tab, #poi-tab, #kbli-tab, #cetak-tab, #simulasi-tab, #btnSHP, #simio-tab, #polygonDraw, #index-tab"
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

//     container.appendChild(btn);

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
map.addControl(new MeasureDistance());

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
    getLayerSurveyPerkembangan();

    //Load Layer Izin Lingkungan
    getLayerIzinLingkungan();
});

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
                                    <img class="lazy" width="100px" height="90px" style="object-fit: cover; border-radius:15px" data-src="${APP_URL}/survey/${
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
            layout: {
                "text-field": "test",
            },
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
            layout: {
                "text-field": ["get", "sub_zona"],
                "text-font": ["DIN Offc Pro Medium", "Arial Unicode MS Bold"],
                "text-size": 12,
                visibility: "none",
            },
        });
    } else if (layer == "zoning_old") {
        map.addLayer({
            id: "zoning_old_fill",
            type: "fill",
            source: "zoning_old",
            layout: {
                "text-field": "test",
            },
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
            source: "zoning_old",
            layout: {
                "text-field": ["get", "Sub Zona"],
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
            type: "circle",
            source: "sewa",
            paint: {
                "circle-color": "#ff0000",
                "circle-stroke-color": "#ffffff",
                "circle-stroke-width": 1,
                "circle-radius": 4,
                "circle-opacity": 0.8,
            },
            layout: {
                visibility: "none",
            },
        });
    } else if (layer == "iumk") {
        map.addLayer({
            id: "iumk_fill",
            type: "circle",
            source: "iumk",
            paint: {
                "circle-color": "#4264fb",
                "circle-stroke-color": "#ffff00",
                "circle-stroke-width": 1,
                "circle-radius": 4,
                "circle-opacity": 0.8,
            },
            layout: {
                visibility: "none",
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
            type: "circle",
            source: "budaya",
            paint: {
                "circle-color": "#27ae60",
                "circle-stroke-color": "#ffffff",
                "circle-stroke-width": 1,
                "circle-radius": 4,
                "circle-opacity": 0.8,
            },
            layout: {
                visibility: "none",
            },
        });
    } else if (layer == "urban") {
        map.addLayer({
            id: "urban_fill",
            type: "fill",
            source: "urban",
            paint: {
                "fill-color": ["get", "color"],
                "fill-opacity": 0.5,
            },
            layout: {
                visibility: "none",
            },
        });

        map.addLayer({
            id: "urban_label",
            type: "symbol",
            source: "urban",
            layout: {
                "text-field": ["get", "ubranindex"],
                "text-font": ["DIN Offc Pro Medium", "Arial Unicode MS Bold"],
                "text-size": 12,
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
            type: "circle",
            source: "survey",
            paint: {
                "circle-color": "#4264fb",
                "circle-stroke-color": "#ffff00",
                "circle-stroke-width": 1,
                "circle-radius": 4,
                "circle-opacity": 0.8,
            },
            layout: {
                visibility: "none",
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
                    zoom: 11,
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
                        <div class="item mb-3">
                        <div class="row">
                            <div class="col-4">
                                <img id="imgUsaha-${index}" class="lazy" width="100px" height="90px" style="object-fit: cover; border-radius:15px" src="/assets/gambar/load.svg" data-src="">
                            </div>
                            <div class="col-8">
                                <span style="font-size: 11pt" class="font-weight-bold" class="inf-nama-kantor">${properties["Nama Usaha"]}</span>
                                <label class="w-100" style="font-size: 13px; margin-bottom:-5px">Pemilik Usaha :
                                    <span>${properties["Pemilik Usaha"]}</span></label>
                                <label class="w-100" style="font-size: 13px; margin-bottom:-5px">Jenis Usaha :
                                    <span>${properties["Jenis Usaha"]}</span></label>
                                <label class="w-100" style="font-size: 13px; margin-bottom:-5px">Tenaga Kerja : <span>${properties["Tenaga Kerja"]}
                                        Orang</span></label>
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
            window.stop();

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
                window.stop();

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
                        const { Name, Keterangan } = properties;

                        content += `
                        <li class="item mb-3" style="margin-left:-20px">
                        <span style="font-size: 11pt" class="font-weight-bold">${Name}</span>
                        <label style="font-size: 13px;">${Keterangan}</label>
                    </li>
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
        //Check if layer is on or off
        if ($("#urban_fill").prop("checked") == true) {
            showLayer("urban_fill");

            $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
        } else {
            hideLayer("urban_fill");
        }

        //Urban Index
        $("#urban_fill").change((e) => {
            if ($(e.target).prop("checked") == true) {
                showLayer("urban_fill");
                showLayer("urban_label");
                $("div.mapboxgl-popup.mapboxgl-popup-anchor-bottom").remove();
            } else {
                hideLayer("urban_fill");
                hideLayer("urban_label");
            }
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
};

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
    const noskfix =
        splitsk[0] + "/**/*****************/*/*****/**/" + splitsk[6];
    const content = `<div class="card">
    <div class="imgcard-container">
      <img src="#" class="card-img-top" id="imgCardIUMK" alt="${dt["Nama Usaha"]}" style="height: 160px;object-fit: cover;display:none;">
    </div>
    <div class="card-body p-2">
      <h6 class="mt-0 mb-2 card-title border-bottom">${dt["Nama Usaha"]}</h6>
      <div style="line-height: 1.2;">
        <span class="d-block"><b>Pemilik Usaha :</b> ${dt["Pemilik Usaha"]}</span>
        <span class="d-block"><b>No. SK :</b> ${noskfix}</span>
        <span class="d-block"><b>Jenis Usaha :</b> ${dt["Jenis Usaha"]}</span>
        <span class="d-block"><b>Tenaga Kerja :</b> ${dt["Tenaga Kerja"]} Orang</span></div>
      </div>
    </div>`;

    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }
    popup.setLngLat(coordinates).setHTML(content).addTo(map);
    setTimeout(() => {
        getIumk(e);
    }, 500);
});

map.on("mouseleave", "iumk_fill", () => {
    map.getCanvas().style.cursor = "";
    popup.remove();
});

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
      <span class="d-block" style="width: 300px">${dt["Keterangan"]}</span>
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
    const larea = data["luas-area"] / 10000;
    $(".inf-iumk").html(data.Jumlah);
    $(".inf-omzet").html(separatorNum(data["Total omzet"]));
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
    $(".inf-rasio").html(data.gini);

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
                onComplete: function () {
                    // setTimeout(() => {
                    //     $.post(`${APP_URL}/save_chart_pie`, {
                    //         pie: pie.toBase64Image(),
                    //     }).done(() => {
                    //         // condition.chart_pie = true;
                    //         // enable_print();
                    //     });
                    // }, 1500);
                },
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
                onComplete: function () {
                    // setTimeout(() => {
                    //     $.post(`${APP_URL}/save_chart_bar`, {
                    //         bar: bar.toBase64Image(),
                    //     }).done(() => {
                    //         // condition.chart_bar = true;
                    //         // enable_print();
                    //     });
                    // }, 1500);
                },
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
    getEksisting(e);
    getIndex(e);
    getLiveAbilityIndex(e);
    getUrbanIndex(e);

    //Get Data Simulasi
    if (localStorage.getItem("simulasi") !== "") {
        let simulasi = localStorage.getItem("simulasi");
        getSimulasi(simulasi);
    }

    //show detail layer
    showDetailInfoLayer();
});

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

//Interaction Layer Zoning
map.on("click", "zoning_fill", (e) => {
    const data = e.features[0].properties;

    //Set Global Variable
    sub_zona_any = data.sub_zona;

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
    $(".inf-kode-sub-zona").html(data.sub_zona);
    $(".inf-id-blok").html(data.id_blok);
    $(".inf-id-sub-blok").html(data.id_subblok);

    //Logical Intesity
    let sub_zona = data.sub_zona;
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
            data.luas_lahan.toFixed(2) * 10000 + " m<sup>2</sup>"
        );
        $(".simulasi-r1").hide();
        $(".simulasi-no-r1").show();
        $(".inf-kdb").html(data.kdb);
        $(".inf-klb").html(data.klb);
        $(".inf-simulasi-klb").html(data.klb);
        KLB = data.klb;
        $(".inf-kdh").html(data.kdh);
        $(".inf-simulasi-kdh").html(data.kdh);
        KDH = data.kdh;
        $(".inf-ketinggian-bangunan").html(data.ketinggian_bangunan);
    }

    //Load Jenis Bangunan
    getJenisBangunan();

    //Load Bangunan For KBLI
    getBangunanKBLI(data.sub_zona);

    //Load Ketentuan 2022
    getKetentuanTataBangunan(data.sub_zona);

    //Load Ketentuan KKOP
    getKKOP(data.kkop);

    //Load Ketentuan Hunian
    getKetentuanHunian(data.sub_zona);

    //Load Ketentuan Variansi
    if (data.sub_zona.includes("RTH")) {
        $("#ketentuan-variansi").show();
        getKetentuanVariansi(data.sub_zona);
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
    sub_zona_any = data["Sub Zona"];

    //Show Data Info
    $("#kbli-new").hide();
    $("#kbli-old").show();
    $("#ketentuan-new").hide();
    $("#ketentuan-old").show();

    //Load More Info
    getKetentuanPSL(data["Sub Zona"], data.PSL);
    dropDownKegiatan(data["Sub Zona"]);

    //Fill Ketentuan Khusus
    let value_tpz = ``;
    let option_tpz = ``;
    let data_tpz = data["CD TPZ"];
    let arr_tpz = data_tpz.split(",");
    if (data["CD TPZ"] == "null" || data["CD TPZ"] == 0) {
        value_tpz += `
        <p class="card-title mt-2 mb-2 text-center font-weight-bold judul_utama">Ketentuan TPZ</p>
        <p>Tidak Ada Ketentuan</p>`;
        option_tpz += `
            <option>Tidak Ada CD TPZ</option>
        `;
        // $.post(`${APP_URL}/save_ketentuan_tpz`, {
        //     ketentuan_tpz: [null, null, null, null],
        // }).done(() => {
        //     condition.ketentuan_tpz = true;
        //     enable_print();
        // });
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
        // $.post(`${APP_URL}/save_ketentuan_tpz`, {
        //     ketentuan_tpz: [
        //         0,
        //         database_tpz[saveTPZ[0]].nama,
        //         database_tpz[`${saveTPZ[0]}`].pengertian,
        //         database_tpz[`${saveTPZ[0]}`].ketentuan,
        //     ],
        // }).done(() => {
        //     condition.ketentuan_tpz = true;
        //     enable_print();
        // });
    }
    $("#selectTPZ").html(option_tpz);

    //Fill Data
    $(".inf-zona").html(data.Zona);
    $(".inf-subzona").html(data["Sub Zona"]);
    $(".inf-blok").html(data["Kode Blok"] + "/" + data["Sub Blok"]);
    $(".inf-kdb").html(data.KDB == "null" ? "-" : `${data.KDB}%`);
    $(".inf-kdh").html(data.KDH == "null" ? "-" : `${data.KDH}%`);
    $(".inf-simulasi-kdh").html(data.KDH == "null" ? "-" : `${data.KDH}%`);
    KDH = data.KDH;
    $(".inf-klb").html(data.KLB == "null" ? "-" : data.KLB);
    $(".inf-simulasi-klb").html(data.KLB == "null" ? "-" : data.KLB);
    KLB = data.KLB;
    $(".inf-ktb").html(data.KLB == "null" ? "-" : `${data.KTB}%`);
    $(".inf-kb").html(data.KB == "null" ? "-" : `${data.KB} Lapis`);
    $(".inf-psl").html(data.KLB == "null" ? "-" : data.PSL);
    $(".inf-gsb").html(gsb);
    $(".inf-k-tpz").html(value_tpz);
    $(".inf-tipe-bangunan").html(data.Tipe);
    $(".inf-id-sub-blok").html(data["ID Sub Blok"]);
    $("#idSubblokSurvey").val(
        data["Kode Blok"] + "." + data["Sub Blok"] + "." + data["Sub Zona"]
    );
    $("#textidSubblokSurvey").text(
        data["Kode Blok"] + "." + data["Sub Blok"] + "." + data["Sub Zona"]
    );
    $("#idSubbBlokUsaha").val(
        data["Kode Blok"] + "." + data["Sub Blok"] + "." + data["Sub Zona"]
    );
    $("#textIdSubBlokUsaha").text(
        data["Kode Blok"] + "." + data["Sub Blok"] + "." + data["Sub Zona"]
    );
    $("#textglobalidSurvey").text(data["Global_ID"]);
    $("#textglobalidSurveyBulk").text(data["Global_ID"]);
    $("#globalidSurvey").val(data["Global_ID"]);
    $("#textidSubblokSurveyBulk").text(
        data["Kode Blok"] + "." + data["Sub Blok"] + "." + data["Sub Zona"]
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
        method: "PATCH",
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
        method: "PATCH",
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
                KLB = properties.klb;
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
                // console.log(value_data);
                // $.post(`${APP_URL}/save_itbx`, {
                //     itbx: [
                //         kegiatan,
                //         value_data[index]["Ketentuan Perizinan"],
                //         value_data[index].Substansi,
                //     ],
                // }).done(() => {
                //     condition.itbx = true;
                //     enable_print();
                // });
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
            // $.post(`${APP_URL}/save_ketentuan_khusus`, {
            //     ketentuan_khusus: [
            //         ketentuan,
            //         value_data["KB Maksimal"],
            //         kdb_maksimal,
            //         value_data["KLB Maksimal"],
            //         value_data["Luas Lahan Minimal"],
            //         value_data["Syarat Lainnya"],
            //     ],
            // }).done(() => {
            //     condition.ketentuan_khusus = true;
            //     enable_print();
            // });
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
        url: `${url_api}/ketentuan`,
        method: "PATCH",
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
        const lngLat = marker.getLngLat();
        iddle_zoning = true;
        map.fire("click", {
            lngLat: lngLat,
            point: map.project(lngLat),
        });
    }
};

map.on("idle", "zoning_fill", zoning_loaded);
map.on("idle", "zoning_old_fill", zoning_loaded);

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
                // $.post(`${APP_URL}/save_bpn`, {
                //     bpn: [prop.Tipe, prop.Luas],
                // }).done(() => {
                //     // condition.bpn = true;
                //     // enable_print();
                // });
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
            // $.post(`${APP_URL}/save_sanitasi`, {
            //     sanitasi: data.features[0].properties.Sistem,
            // }).done(() => {
            //     // condition.sanitasi = true;
            //     // enable_print();
            // });
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
            // $.post(`${APP_URL}/save_air_tanah`, { air_tanah: value_data }).done(
            //     () => {
            //         // condition.air_tanah = true;
            //         // enable_print();
            //     }
            // );
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
            // $.post(`${APP_URL}/save_turun`, { turun: fix_jumlah }).done(() => {
            //     // condition.turun = true;
            //     // enable_print();
            // });
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
            // $.post(`${APP_URL}/save_njop`, { njop: [prop.Min, prop.Max] }).done(
            //     () => {
            //         // condition.njop = true;
            //         // enable_print();
            //     }
            // );

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
                // $.post(`${APP_URL}/save_eksisting`, {
                //     eksisting: prop.Kegiatan,
                // }).done(() => {
                //     // condition.eksisting = true;
                //     // enable_print();
                // });
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
                const geo = dtpar.geometry;
                cat.push({
                    name: props.Kategori,
                    fasilitas: props.Name,
                    jarak: geo.Distance,
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
            // $.post(`${APP_URL}/save_poi`, {
            //     poi: [getRadVal / 1000, poi, name_poi],
            // }).done(() => {
            //     // condition.poi = true;
            //     // enable_print();
            // });
            $(".tabListFasilitas").html(htmlContent);
        },
        error: (error) => {
            // console.log(error);
        },
        complete: (e) => {
            // $('.map-loading').hide()
        },
    });
};

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
            const { kategori, detail, score_all, score } =
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
                        "Resiko Penurunan Muka Tanah",
                        "Resiko Banjir",
                        ["Resiko Bencana", "Kebakaran"],
                        ["Bebas Penggunaan", "Air Tanah"],
                        "Penyediaan Air Perpipaan",
                        "Kualitas Vegetasi",
                        "Pengelolaan IPAL",
                    ],
                    datasets: [
                        {
                            label: " ",
                            data: [
                                score[0].bebas_land_subsidence,
                                score[0].bebas_banjir,
                                score[0].kawasan_aman_kebakaran,
                                score[0].bebas_air_tanah,
                                score[0].jarak_pipa_air,
                                score[0].kondisi_hijau,
                                score[0].jaringan_ipal,
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
            $(".inf-index-kelembaban").html(detail[0].kelembaban);
            $(".inf-index-bebas-banjir").html(detail[0].bebas_banjir);
            $(".inf-index-bebas-land-subsidence").html(
                detail[0].bebas_land_subsidence
            );
            $(".inf-index-aman-kebakaran").html(
                detail[0].kawasan_aman_kebakaran
            );
            $(".inf-index-bebas-air-tanah").html(detail[0].bebas_air_tanah);
            $(".inf-index-dekat-pipa-air").html(detail[0].jarak_pipa_air);
            $(".inf-index-jauh-dari-sungai").html(detail[0].jarak_dari_sungai);
            $(".inf-index-kualitas-area-hijau").html(detail[0].kondisi_hijau);
            $(".inf-index-jaringan-ipal").html(detail[0].jaringan_ipal);
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
                        "Indeks Konektivitas Jalan",
                        "Ruang Terbuka dan Publik",
                        "Fasilitas Komunitas",
                        "Aktivitas Budaya Perkotaan",
                        "Employment Capacity",
                        "Pelayanan Kesehatan",
                        "Pendidikan",
                        "Transportasi Publik",
                        "Entropy Index",
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
                const { kbli, itbx } = properties;
                html += `
                    <option value="${kbli}-${itbx}">${kbli}</option>
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
        url: `${url_api}/kbli`,
        method: "PATCH",
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
        `<a href="https://oss.go.id/informasi/kbli-kode?kode=G&kbli=${bangunan[0]}" target="_blank">${bangunan[0]}</a>`
    );
    $(".inf-bangunan").html(bangunan[1]);
    $(".inf-itbx").html(bangunan[2]);
    getListBangunan();
});

//Get Ketentuan
const getKetentuanKBLI = (
    sub_zona = sub_zona_any,
    ketentuan_perizinan = $("#kegiatan").select2("val").split("-")[1],
    bangunan = $("#kegiatan").select2("val").split("-")[0]
) => {
    if (ketentuan_perizinan == "Diizinkan") {
        $(".kbli-ketentuan").html("Diizinkan");
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

                $(".kbli-ketentuan").html(html);
            },
        });
    }
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
    // $.post(`${APP_URL}/save_kbli`, {
    //     kbli: data_kbli[selSektor],
    //     param_kbli: param_kbli,
    // }).done(() => {
    // condition.kbli = true;
    // enable_print();
    // });
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
        zoom: 15,
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

map.on("click", add_marker);

//Load Zoning Layer on Click

map.on("click", (e) => {
    let coordinates = e.lngLat;
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
});

const loadZoning = (lat, lng) => {
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
                //save kelurahan to local storage
                localStorage.setItem("kelurahan", kelurahan);
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
                        data_simulasi.Hujan * (luasSimulasi * (1 - KDH / 100))
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
        },
    });
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
                                    ? "/survey/not_image.png"
                                    : "/favorit/" + e[index].image[0].name
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
                    <img src="/favorit/${e.image[i].name}" class="w-100">
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
                            <img class="lazy" data-src="/survey/${
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
                    <img src="/survey/${e.image[i].name}" class="w-100" style="object-fit:cover">
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
                        <img src="${APP_URL}/survey/not_image.png" class="card-img-top" style="height: 160px;object-fit: cover;">
                    </div>
                    `;
                    carouselControl = ``;
                } else {
                    image.forEach((item, index) => {
                        imageCarousel += `
                        <div class="carousel-item ${
                            index == 0 ? "active" : ""
                        }">
                        <img src="${APP_URL}/survey/${
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
                        <img src="${APP_URL}/survey/not_image.png" class="card-img-top" style="height: 160px;object-fit: cover;">
                    </div>
                    `;
                    carouselControl = ``;
                } else {
                    image.forEach((item, index) => {
                        imageCarousel += `
                        <div class="carousel-item ${
                            index == 0 ? "active" : ""
                        }">
                        <img src="${APP_URL}/survey/${
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
            <img src="${APP_URL}/survey/not_image.png" class="card-img-top" style="height: 160px;object-fit: cover;">
        </div>
        `;
        carouselControl = ``;
    } else {
        image.forEach((item, index) => {
            imageCarousel += `
            <div class="carousel-item ${index == 0 ? "active" : ""}">
                <img src="${APP_URL}/survey/${
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

$("#koordinatKajian").on("focus", () => {
    markerIzin.setLngLat(map.getCenter()).addTo(map);
    map.on("drag", () => {
        markerIzin.setLngLat(map.getCenter());
    });
    map.on("dragend", () => {
        markerIzin.setLngLat(map.getCenter());
        const lngLat = markerIzin.getLngLat();
        $("#koordinatKajian").val(`${lngLat.lat},${lngLat.lng}`);
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
