const gambarPeta = (name) => {
    $(name).slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: false,
        arrows: true,
        dots: true,
    });
};

mapboxgl.accessToken =
    "pk.eyJ1IjoibWVudGhvZWxzciIsImEiOiJja3M0MDZiMHMwZW83MnVwaDZ6Z2NhY2JxIn0.vQFxEZsM7Vvr-PX3FMOGiQ";
const map = new mapboxgl.Map({
    container: "map",
    style: "mapbox://styles/menthoelsr/ckp6i54ay22u818lrq15ffcnr",
    zoom: 10.5,
    center: [106.8295257, -6.210588],
    preserveDrawingBuffer: true,
});

// Navigator
map.addControl(new mapboxgl.NavigationControl());

// disable map zoom when using scroll
map.scrollZoom.disable();

const popup = new mapboxgl.Popup({
    closeButton: true,
    closeOnClick: true,
});

$(
    ".mapboxgl-ctrl.mapboxgl-ctrl-attrib, .mapboxgl-ctrl-geocoder.mapboxgl-ctrl, a.mapboxgl-ctrl-logo"
).css("visibility", "hidden");

map.on("style.load", () => {
    map.addSource("layerIzinLingkungan", {
        type: "geojson",
        data: `https://jakarta.pintoinvest.com/v1/layer_izin_lingkungan`,
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
    });
});

function showLayer(layer) {
    map.setLayoutProperty(layer, "visibility", "visible");
}

function hideLayer(layer) {
    map.setLayoutProperty(layer, "visibility", "none");
}

// map.on("mouseenter", "layerIzinLingkungan", (e) => {
//     console.log(e.features[0].properties);

//     map.getCanvas().style.cursor = "pointer";
//     const coordinates = e.features[0].geometry.coordinates.slice();
//     const data = e.features[0].properties;
//     const content = ``;

//     while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
//         coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
//     }
//     popup.setLngLat(coordinates).setHTML(content).addTo(map);
// });

map.on("click", "layerIzinLingkungan", (e) => {
    map.getCanvas().style.cursor = "pointer";
    const coordinates = e.features[0].geometry.coordinates.slice();

    lng = coordinates[0];
    lat = coordinates[1];

    const data = e.features[0].properties;

    // console.log(data);

    $("#koordinatKajian_MapAdmin")
        .find("a")
        .attr("href", `https://www.google.com/maps/search/%09${lat},${lng}`)
        .text(`${lat}, ${lng}`);

    $("#wilayahKewenanganKajian_MapAdmin").html(data.wilayah_kewenangan);
    $("#upKewenanganKajian_MapAdmin").html(data.up_kewenangan);
    $("#noPermohonanKajian_MapAdmin").html(data.nomor_permohonan);
    $("#tipePengajuanKajian_MapAdmin").html(data.tipe_permohonan);
    $("#tipePermohonanKajian_MapAdmin").html(data.tipe_pengajuan);

    $("#kelurhanKajian_MapAdmin").html(data.kelurahan_kegiatan);
    $("#kecamatanKajian_MapAdmin").html(data.kecamatan_kegiatan);
    $("#tanggalKajian_MapAdmin").html(data.tanggal_pengajuan_izin);
    $("#etaIzinKajian_MapAdmin").html(data.eta_izin);
    $("#statusWaktuPermohonanKajian_MapAdmin").html(
        data.status_waktu_permohonan
    );
    $("#posisiTerakhirKajian_MapAdmin").html(data.posisi_terakhir);
    $("#statusTerakhirKajian_MapAdmin").html(data.status_terakhir);
    $("#komentarTerakhirKajian_MapAdmin").html(data.komentar_terakhir);

    // $.ajax({
    //     url: `/dashboard/peta-survey/${id}`,
    //     method: "GET",
    //     dataType: "json",
    //     success: (e) => {
    //         const data = e.data;

    //         console.log(lok);

    //         popup.setLngLat(coordinates).setHTML(content).addTo(map);
    //         gambarPeta(".gambar_peta");
    //     },
    // });

    while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
        coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
    }
});

// map.on("mouseleave", "titik-survey-rekap", () => {
//     map.getCanvas().style.cursor = "";
//     popup.remove();
// });
