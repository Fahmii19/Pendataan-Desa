//Token
let token =
    "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJleHAiOjE3MTE0Mzk5OTIsIm5hbWUiOiJhZG1pbiJ9.q0dE4itQi0sJQ3-qABWZyYjYGTx5PRrLTH-tOZ6pTs8";

mapboxgl.accessToken =
    "pk.eyJ1IjoibWVudGhvZWxzciIsImEiOiJja3M0MDZiMHMwZW83MnVwaDZ6Z2NhY2JxIn0.vQFxEZsM7Vvr-PX3FMOGiQ";
const map = new mapboxgl.Map({
    container: "mapAksesibilitas",
    style: "mapbox://styles/menthoelsr/ckp6i54ay22u818lrq15ffcnr",
    zoom: 14,
    center: [106.8295257, -6.210588],
    preserveDrawingBuffer: true,
});

let url_api = `https://jakarta.pintoinvest.com:3444`;
let iddle_zoning = false;
let kelurahan_tmp_global = "";

const titleCase = (str) => {
    if (!str) return "";
    str = str.toLowerCase().split(" ");
    for (let i = 0; i < str.length; i++) {
        str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1);
    }
    return str.join(" ");
};

// Navigator
map.addControl(new mapboxgl.NavigationControl());

// disable map zoom when using scroll
map.scrollZoom.disable();

const popup = new mapboxgl.Popup({
    closeButton: true,
    closeOnClick: true,
});

map.on("style.load", () => {
    if (!map.getSource("titik-survey-rekap")) {
        map.addSource("titik-survey-rekap", {
            type: "geojson",
            data: `${APP_URL}/dashboard/get-data-peta-aksesibilitas`,
        });
    }

    if (!map.getSource("zoning")) {
        map.addSource("zoning", {
            type: "vector",
            tiles: [
                "https://jakarta.pintoinvest.com:8080/maps/jakpintas/{z}/{x}/{y}.vector.pbf",
            ],
            tolerance: 0,
        });
    }

    addLayers("zoning");
    addLayers("titik-survey-rekap");
    map.moveLayer("titik-survey-rekap");
});

// Event listener untuk perubahan checkbox
document.getElementById("rdtr").addEventListener("change", function () {
    if (this.checked) {
        showLayer("zoning_fill");
        hideLayer("wilayah");
        map.getCanvas().style.cursor = "";
        popup.remove();
    } else {
        hideLayer("zoning_fill");
        showLayer("wilayah");
    }
});

// Pada saat halaman dimuat, jika kotak centang dicek, tampilkan layer
const checkbox = document.getElementById("rdtr");
if (checkbox.checked) {
    showLayer("zoning_fill");
}

map.on("click", (e) => {
    let coordinates = e.lngLat;
    loadZoning(coordinates.lat, coordinates.lng);

    const isRdtrChecked = $("#rdtr").prop("checked");

    if (isRdtrChecked) {
        showLayer("zoning_fill");
        hideLayer("wilayah");
    } else {
        hideLayer("zoning_fill");
        showLayer("wilayah");
    }

    // Otomatis menceklis kotak centang jika belum dicek
    // if (!checkbox.checked) {
    //     checkbox.checked = true;
    // }
});

//

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

map.on("click", "zoning_fill", (e) => {
    console.log(e.features);
});

const updateZoningFilter = (kelurahan) => {
    map.setFilter("zoning_fill", ["==", "wadmkd", titleCase(kelurahan)]);
};

const updateWilayahFilter = (kelurahan) => {
    map.setFilter("wilayah", ["==", "wadmkd", titleCase(kelurahan)]);
};

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

            //Assign For Filter Layer
            kelurahan_tmp_global = kelurahan;

            //Update the zoning_fill filter
            updateZoningFilter(kelurahan_tmp_global);
            SearchWilayah(kelurahan_tmp_global);

            //load zoning layer
            if (kelurahan !== kelurahan_tmp) {
                iddle_zoning = false;
                //save kelurahan to local storage
                localStorage.setItem("kelurahan", kelurahan);
            }
        },
    });
};

// Konstanta untuk elemen yang sering digunakan
const $searchDropdown = $("#searchDropdown");
const $cariWilayah = $("#cari_wilayah");

// Fungsi untuk melakukan pencarian berdasarkan koordinat
function searchByCoordinates(coordinates) {
    let resHTML = "";

    $.ajax({
        url: `${url_api}/wilayah`,
        method: "PUT",
        data: {
            lat: coordinates[0].trim(),
            lng: coordinates[1].trim(),
        },
        headers: {
            Authorization: "Bearer " + token,
        },
        dataType: "json",
        beforeSend: () => {
            // $('.map-loading').show();
        },
        success: (res) => {
            if (res.features != null) {
                const dt = res.features;
                for (let i in dt) {
                    let prop = dt[i].properties;

                    resHTML += `
                                <a class="dropdown-item py-1 FixedSizeItem" onclick="flyToLocation(${
                                    coordinates[0]
                                },${coordinates[1]},'${titleCase(
                        prop["Kelurahan"]
                    )}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 1vh;">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                        <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
                                    </svg>
                                ${prop["Kelurahan"]}
                                </a>`;
                }

                $("#searchDropdown").html(resHTML);
            } else {
                $("#searchDropdown").html(
                    '<a class="dropdown-item py-1 FixedSizeItem" href="#">Data tidak ditemukan</a>'
                );
            }
        },
        error: (error) => {
            $("#searchDropdown").html(
                '<a class="dropdown-item py-1 FixedSizeItem" href="#">Data tidak ditemukan</a>'
            );
        },
        complete: () => {
            // $('.map-loading').hide();
        },
    });
}

// Fungsi untuk melakukan pencarian berdasarkan kata kunci
function searchByKeyword(keyword) {
    let resHTML = "";
    $.ajax({
        url: `${url_api}/search`,
        method: "PUT",
        data: {
            keyword: keyword,
        },
        headers: {
            Authorization: "Bearer " + token,
        },
        dataType: "json",
        beforeSend: () => {
            // Show loading spinner if needed
        },
        success: (res) => {
            if (res.features != null) {
                const dt = res.features;
                for (let i in dt) {
                    let prop = dt[i].properties;
                    let name = "";
                    if (prop["Name"] === undefined) {
                        name = prop["Nama"];
                    } else if (prop["Nama"] === undefined) {
                        name = prop["Name"];
                    }
                    let koor = dt[i].geometry.coordinates;

                    // Menggunakan format yang baru
                    resHTML += `
                                <a class="dropdown-item py-1 FixedSizeItem" onclick="flyToLocation(${koor[1]},${koor[0]},'${prop["Kelurahan"]}', '${name}, ${prop["Kelurahan"]}, ${prop["Kecamatan"]}, ${prop["Kota"]}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-pin" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 1vh;">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
                                        <path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z"></path>
                                    </svg>
                                    ${name}, ${prop["Kelurahan"]}, ${prop["Kecamatan"]}, ${prop["Kota"]}
                                </a>`;

                    if (i < dt.length - 1) {
                        resHTML += '<div class="dropdown-divider"></div>'; // Menambahkan pemisah antar item
                    }
                }

                $("#searchDropdown").html(resHTML);
            } else {
                $("#searchDropdown").html(
                    '<a class="dropdown-item py-1 FixedSizeItem" href="#">Data tidak ditemukan</a>'
                );
            }
        },
        error: (error) => {
            $searchDropdown.html(
                '<a class="dropdown-item py-1 FixedSizeItem" href="#">Data tidak ditemukan</a>'
            );
        },
        complete: () => {
            // $('.map-loading').hide()
        },
    });
}

$searchDropdown.hide();

$cariWilayah.on("focus", () => {
    $searchDropdown.show();
});

$cariWilayah.bindWithDelay(
    "keyup",
    (e) => {
        $searchDropdown.show();

        const query = $(e.target).val();

        if (query !== "" && query.length >= 3) {
            if (query.includes("-")) {
                // Use includes for readability
                const coordinates = query.split(",");
                searchByCoordinates(coordinates);
            } else {
                searchByKeyword(query);
            }
        } else {
            $searchDropdown.html("");
        }
    },
    200
);

const SearchWilayah = (kelurahan_tmp_global) => {
    $.ajax({
        url: `${url_api}/wilayah`,
        method: "POST",
        data: {
            kelurahan: kelurahan_tmp_global, // Menggunakan data kelurahan yang diberikan
        },
        headers: {
            Authorization: "Bearer " + token,
        },
        dataType: "json",
        success: (res) => {
            let data = res;
            if (data) {
                if (!map.getSource("wilayah")) {
                    map.addSource("wilayah", {
                        type: "geojson",
                        data: data,
                    });

                    // Add the "wilayah" layer here after adding the source
                    addLayers("wilayah");
                } else {
                    // If the source already exists, you can update its data
                    map.getSource("wilayah").setData(res);
                }
            }
        },
    });
};

//Fly to Location
const flyToLocation = (lat, lng, kelurahan, keyword) => {
    map.flyTo({
        center: [lng, lat],
        zoom: 14,
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
    // $("#cari_wilayah").val(keyword);
    $searchDropdown.hide();
};

// untuk menghapus inputan
function clearInput() {
    document.getElementById("cari_wilayah").value = "";
    $searchDropdown.hide();
    $("#searchDropdown").html("");
}

// Add Layer
function addLayers(layer) {
    if (layer === "titik-survey-rekap" && !map.getLayer("titik-survey-rekap")) {
        map.addLayer({
            id: "titik-survey-rekap",
            type: "circle",
            source: "titik-survey-rekap",
            paint: {
                "circle-color": "#4264fb",
                "circle-stroke-color": "#ffff00",
                "circle-stroke-width": 1,
                "circle-radius": 4,
                "circle-opacity": 0.8,
            },
            layout: {
                visibility: "visible",
            },
        });
    } else if (layer === "zoning" && !map.getLayer("zoning_fill")) {
        map.addLayer({
            id: "zoning_fill",
            type: "fill",
            source: "zoning",
            "source-layer": "zoning_new",
            filter: ["==", "wadmkd", titleCase(kelurahan_tmp_global)],
            // filter: ["==", "wadmkd", "Bendungan Hilir"],
            paint: {
                "fill-color": ["get", "fill"],
                "fill-opacity": 1,
                "fill-outline-color": "black",
            },
            layout: { visibility: "none" },
        });
    } else if (layer === "wilayah" && !map.getLayer("wilayah")) {
        map.addLayer({
            id: "wilayah",
            type: "fill",
            source: "wilayah",
            paint: {
                "fill-color": "#00FFFF",
                "fill-opacity": 0.2,
                "fill-outline-color": "red",
            },
            layout: {
                visibility: "visible",
            },
        });
    }
}

function showLayer(layer) {
    if (map.getLayer(layer)) {
        map.setLayoutProperty(layer, "visibility", "visible");
    }
}

function hideLayer(layer) {
    if (map.getLayer(layer)) {
        map.setLayoutProperty(layer, "visibility", "none");
    }
}

$(
    ".mapboxgl-ctrl.mapboxgl-ctrl-attrib, .mapboxgl-ctrl-geocoder.mapboxgl-ctrl, a.mapboxgl-ctrl-logo"
).css("visibility", "hidden");

// All
map.on("mouseenter", "titik-survey-rekap", (e) => {
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.features[0].geometry.coordinates.slice();

    const id = e.features[0].properties.id;

    $.ajax({
        url: `/dashboard/get-peta-aksesibilitas/${id}`,
        method: "GET",
        dataType: "json",
        success: (e) => {
            // console.log(e.data[0]);
            const data = e.data;
            // console.log(e.data);

            let lebar_jalan = data.lebar_jalan;
            let jenis_jalan = data.jenis_jalan;
            let kelas_jalan = data.kelas_jalan;
            let pedestrian = data.pedestrian;

            let kelurahan = data.kelurahan;
            let kecamatan = data.kecamatan;
            let kota = data.kota;

            let hasil_kec = capitalizeWords(String(data.kecamatan));
            let hasil_kel = capitalizeWords(String(data.kelurahan));
            let hasil_kota = capitalizeWords(String(data.kota));

            array = data.foto;

            // console.log(array);

            var datagambar = "";
            if (array.length == 0) {
                datagambar += `<img class="card-img-top" style="width:490px !important;height: 160px; object-fit: cover;" src="https://jakarta.pintoinvest.com/v1/survey/not_image.png" >`;
            } else {
                array.forEach((dataimage) => {
                    datagambar += `<img src="https://jakarta.pintoinvest.com:9000/aksesibilitas/${dataimage.photo}" class="card-img-top" style="width: 100%;height: 150px;object-fit: cover;">`;
                });
            }

            const content = `
                <div class="p-0">
                    <div class="imgcard-container">
                        <div class="gambar_peta_aksesibilitas peta_btn_aksesibilitas btn_slider_peta">
                        ${datagambar}
                        </div>
                    </div>

                    <div class="card-body p-2">
                        <div class="border-bottom"></div>
                        <div style="line-height: 1.2; margin-top:7px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <span>Lebar Jalan (m)</span>
                                </div>
                                <div class="col-md-6">
                                    <span class="d-block"> ${lebar_jalan}</span>
                                </div>
                            </div>
                        </div>
                        <div style="line-height: 1.2;">
                            <div class="row">
                                <div class="col-md-6">
                                    <span>Jenis Jalan</span>
                                </div>
                                <div class="col-md-6">
                                    <span class="d-block"> ${jenis_jalan}</span>
                                </div>
                            </div>
                        </div>
                        <div style="line-height: 1.2;">
                                <div class="row">
                                <div class="col-md-6">
                                    <span>Kelas Jalan</span>
                                </div>
                                <div class="col-md-6">
                                    <span class="d-block"> ${kelas_jalan}</span>
                                </div>
                            </div>
                        </div>
                        <div style="line-height: 1.2;">
                                <div class="row">
                                <div class="col-md-6">
                                    <span>Pedestrian</span>
                                </div>
                                <div class="col-md-6">
                                    <span class="d-block"> ${pedestrian}</span>
                                </div>
                            </div>
                        </div>
                        <div style="line-height: 1.2;">
                                <div class="row">
                                <div class="col-md-6">
                                    <span>Kelurahan</span>
                                </div>
                                <div class="col-md-6">
                                    <span class="d-block">${hasil_kel}</span>
                                </div>
                            </div>
                        </div>
                        <div style="line-height: 1.2;">
                                <div class="row">
                                <div class="col-md-6">
                                    <span>Kecamatan</span>
                                </div>
                                <div class="col-md-6">
                                    <span class="d-block">${hasil_kec}</span>

                                </div>
                            </div>
                        </div>
                        <div style="line-height: 1.2;">
                                <div class="row">
                                <div class="col-md-6">
                                    <span>Kota</span>
                                </div>
                                <div class="col-md-6">
                                    <span class="d-block">${hasil_kota}</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
            popup.setLngLat(coordinates).setHTML(content).addTo(map);
            gambarPetaAksesibilitas(".gambar_peta_aksesibilitas");
        },
    });

    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }
});

// revisi peta

const gambarPetaAksesibilitas = (name) => {
    $(name).slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        arrows: true,
        dots: true,
    });
};

// Mengubah tulisan menjadi huruf kapital
function capitalizeWords(str) {
    return str.replace(/\w\S*/g, function (txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
}

// Show Data Slider
function SliderAksesibilitas(name) {
    $(name).slick({
        slidesToShow: 1,
        variableWidth: true,
        slidesToScroll: 1,
        infinite: false,
        arrows: true,
    });
}

// Update data aksesibilitas
function updateAccessibilityElements(data) {
    // console.log(data);
    $("#name_aksesibilitas").html(data.user.name);

    $("#lebar_jalan_aksesibilitas").html(
        "<div' >" + data.lebar_jalan + "</div>"
    );
    $("#jenis_jalan_aksesibilitas").html(
        "<div' >" + data.jenis_jalan + "</div>"
    );
    $("#kelas_jalan_aksesibilitas").html(
        "<div' >" + data.kelas_jalan + "</div>"
    );
    $("#pendestrian_aksesibilitas").html(
        "<div' >" + data.pedestrian + "</div>"
    );

    let hasil_kec = capitalizeWords(String(data.kecamatan));
    let hasil_kel = capitalizeWords(String(data.kelurahan));
    let hasil_kota = capitalizeWords(String(data.kota));

    $("#kelurahan_aksesibilitas").html("<div' >" + hasil_kel + "</div>");

    $("#kecamatan_aksesibilitas").html("<div' >" + hasil_kec + "</div>");

    $("#kota_aksesibilitas").html("<div' >" + hasil_kota + "</div>");

    $("#penempatan_aksesibilitas").html(
        "<div'>" + data.user.penempatan + "</div>"
    );

    $("#photo_aksesibilitas").html(
        '<span><img style="width: 9rem; height:10rem; border-radius: 5px; object-fit:cover;" src="https://jakarta.pintoinvest.com/v1/photo_ajib/' +
            data.user.avatar +
            '") }}" alt="Petugas Ajib" /></span>'
    );

    let dataimage = "";
    if (data.image.length === 0) {
        dataimage += `<div><img style="width: 15rem; height:9rem; border-radius: 5px;" class="" src="https://jakarta.pintoinvest.com/v1/survey/not_image.png" alt="First slide"></div>`;
    } else {
        data.image.forEach((imageItem) => {
            dataimage += `<div class=""><img class="" src="https://jakarta.pintoinvest.com:9000/aksesibilitas/${imageItem.photo}" alt="First slide"></div>`;
        });
    }

    if (
        $("div.gambar_aksesibilitas.slick-initialized.slick-slider").length == 0
    ) {
        $(".gambar_aksesibilitas").html("");

        $(".gambar_aksesibilitas").html(dataimage);

        SliderAksesibilitas(".gambar_aksesibilitas");
    } else {
        $(".gambar_aksesibilitas").slick("unslick");
        $(".gambar_aksesibilitas").html("");
        $(".gambar_aksesibilitas").html(dataimage);
        SliderAksesibilitas(".gambar_aksesibilitas");
    }
}

// Data Aksesibilitas
function dataAksesibilitas() {
    $(".atur_margin_gambar_utama").removeClass("atur_margin_gambar_utama2");

    $.ajax({
        url: `/v1/dashboard/data-aksesibilitas`,
        method: "GET",
        dataType: "json",
        beforeSend: function () {
            // data ajib
            $("#photo_aksesibilitas").html(
                '<div style="height:21.5vh; width:9vw;" class="skeleton-image">'
            );
            $("#name_aksesibilitas").html(
                '<div class="skeleton-heading"></div>'
            );

            $("#penempatan_aksesibilitas").html(
                '<div class="skeleton-heading"></div>'
            );

            //LABEL
            $("#label_kelas_jalan_aksesibilitas").html(
                '<div class="skeleton-heading" style="margin-bottom:0 !important;"></div>'
            );
            //lebar
            $("#label_lebar_jalan_aksesibilitas").html(
                '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
            );

            // jenis
            $("#label_jenis_jalan_aksesibilitas").html(
                '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
            );

            // kelas
            $("#label_kelas_jalan_aksesibilitas").html(
                '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
            );

            // pedestrian
            $("#label_pendestrian_aksesibilitas").html(
                '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
            );

            // kelurahan
            $("#label_kelurahan_aksesibilitas").html(
                '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
            );

            // kecamatan
            $("#label_kecamatan_aksesibilitas").html(
                '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
            );

            // kota
            $("#label_kota_aksesibilitas").html(
                '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
            );

            // DATA

            $("#lebar_jalan_aksesibilitas").html(
                '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
            );
            $("#jenis_jalan_aksesibilitas").html(
                '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
            );
            $("#kelas_jalan_aksesibilitas").html(
                '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
            );
            $("#pendestrian_aksesibilitas").html(
                '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
            );
            $("#kelurahan_aksesibilitas").html(
                '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
            );
            $("#kecamatan_aksesibilitas").html(
                '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
            );
            $("#kota_aksesibilitas").html(
                '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
            );

            $(".add_style_custom").removeClass("custom_position");
        },
        success: function (e) {
            let data = e.aksesibilitas;

            $(".add_style_custom").addClass("custom_position");

            $("#label_lebar_jalan_aksesibilitas").html("Lebar Jalan");
            $("#label_kelas_jalan_aksesibilitas").html("Kelas Jalan");
            $("#label_jenis_jalan_aksesibilitas").html("Jenis Jalan");
            $("#label_pendestrian_aksesibilitas").html("Pedestrian");
            $("#label_kelurahan_aksesibilitas").html("Kelurahan");
            $("#label_kecamatan_aksesibilitas").html("Kecamatan");
            $("#label_kota_aksesibilitas").html("Kota");

            if (data.length === 0) {
                //LABEL
                $("#label_kelas_jalan_aksesibilitas").html(
                    '<div class="skeleton-heading" style="margin-bottom:0 !important;"></div>'
                );
                //lebar
                $("#label_lebar_jalan_aksesibilitas").html(
                    '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
                );

                // jenis
                $("#label_jenis_jalan_aksesibilitas").html(
                    '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
                );

                // kelas
                $("#label_kelas_jalan_aksesibilitas").html(
                    '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
                );

                // pedestrian
                $("#label_pendestrian_aksesibilitas").html(
                    '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
                );

                // kelurahan
                $("#label_kelurahan_aksesibilitas").html(
                    '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
                );

                // kecamatan
                $("#label_kecamatan_aksesibilitas").html(
                    '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
                );

                $("#label_kota_aksesibilitas").html(
                    '<div class="skeleton-heading" style="margin-bottom:0 !important;" ></div>'
                );
            } else {
                $(".add_style_custom").addClass("custom_position");

                $("#label_lebar_jalan_aksesibilitas").html("Lebar Jalan");
                $("#label_kelas_jalan_aksesibilitas").html("Kelas Jalan");
                $("#label_jenis_jalan_aksesibilitas").html("Jenis Jalan");
                $("#label_pendestrian_aksesibilitas").html("Pedestrian");
                $("#label_kelurahan_aksesibilitas").html("Kelurahan");
                $("#label_kecamatan_aksesibilitas").html("Kecamatan");
                $("#label_kota_aksesibilitas").html("kota");

                updateAccessibilityElements(data[0]);
            }
        },
    });
}

// Data Slider Aksesibilitas
$(document).ready(function () {
    $(".img_child_id_aksesibilitas").on("click", function () {
        let id = $(this).attr("data-id");

        $.ajax({
            url: `/v1/dashboard/data-slider-aksesibilitas/${id}`,
            type: "get",
            dataType: "json",
            beforeSend: function () {
                // data ajib
                $("#photo_aksesibilitas").html(
                    '<div style="height:25vh; width:9vw;" class="skeleton-image">'
                );
                $("#name_aksesibilitas").html(
                    '<div class="skeleton-heading"></div>'
                );

                $("#penempatan_aksesibilitas").html(
                    '<div class="skeleton-heading"></div>'
                );

                //data
                $("#lebar_jalan_aksesibilitas").html(
                    '<div class="skeleton-heading"></div>'
                );
                $("#jenis_jalan_aksesibilitas").html(
                    '<div class="skeleton-heading"></div>'
                );
                $("#kelas_jalan_aksesibilitas").html(
                    '<div class="skeleton-heading"></div>'
                );
                $("#pendestrian_aksesibilitas").html(
                    '<div class="skeleton-heading"></div>'
                );
                $("#kelurahan_aksesibilitas").html(
                    '<div class="skeleton-heading"></div>'
                );
                $("#kecamatan_aksesibilitas").html(
                    '<div class="skeleton-heading"></div>'
                );
                $("#kota_aksesibilitas").html(
                    '<div class="skeleton-heading"></div>'
                );
            },
            success: function (e) {
                let data = e.aksesibilitas;
                updateAccessibilityElements(data, data.image);
            },
        });
    });
});

// Export Data Aksesibilitas
let dataTable;

// Functions
const select2Init = function () {
    $("#selectAksesibilitas").select2();
    const selectedOptionValue = $("#selectAksesibilitas").val();
    localStorage.setItem("getKelurahanAksesibilitas", selectedOptionValue);
    $("#PrintAksesibilitas").attr(
        "href",
        `/v1/dashboard/export-aksesibilitas/${selectedOptionValue}`
    );
};

const dataTableInit = function () {
    dataTable = $(".data-aksesibilitas").dataTable({
        retrieve: true,
        columnDefs: [{ targets: 1, type: "num" }],
    });
};

const dtSearchInit = function () {
    $("#selectAksesibilitas").change(function () {
        const kelurahanValue = $(this).val();

        if (kelurahanValue === "") {
            // untuk mengganti per kelurahan
            dataTable.api().column(5).search("", true, false).draw();
        } else {
            dtSearchAction($(this), 5);
        }

        $("#PrintAksesibilitas").attr(
            "href",
            `/v1/dashboard/export-aksesibilitas/${kelurahanValue}`
        );
    });
};

const dtSearchAction = function (selector, columnId) {
    const filterValue = selector.val();
    const searchTerm = filterValue ? filterValue : "";
    dataTable.api().column(columnId).search(searchTerm, true, false).draw();
};

// Initialization
$(document).ready(function () {
    select2Init();
    dataTableInit();
    dtSearchInit();
});
