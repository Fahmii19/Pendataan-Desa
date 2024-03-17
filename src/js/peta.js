mapboxgl.accessToken =
  "pk.eyJ1IjoibWVudGhvZWxzciIsImEiOiJja3M0MDZiMHMwZW83MnVwaDZ6Z2NhY2JxIn0.vQFxEZsM7Vvr-PX3FMOGiQ";

const map = new mapboxgl.Map({
  container: "mapSoaraja",
  style: "mapbox://styles/menthoelsr/ckp6i54ay22u818lrq15ffcnr",
  zoom: 14,
  center: [106.8271, -6.2307], // Koordinat Kuningan Barat, Jakarta
  preserveDrawingBuffer: true,
});

map.on("load", function () {
  // Fungsi untuk menambahkan fill layer
  function addFillLayer() {
    map.addLayer({
      id: "custom-fill-layer",
      type: "fill",
      source: {
        type: "geojson",
        data: {
          type: "Feature",
          geometry: {
            type: "Polygon",
            coordinates: [
              [
                [106.8243, -6.2283],
                [106.8303, -6.2283],
                [106.8303, -6.2329],
                [106.8243, -6.2329],
                [106.8243, -6.2283],
              ],
            ],
          },
        },
      },
      paint: {
        "fill-color": "#888888", // Ganti dengan warna yang diinginkan
        "fill-opacity": 0.5,
        "fill-outline-color": "black",
      },
      layout: {
        visibility: "visible",
      },
    });
  }

  // Panggil fungsi untuk menambahkan fill layer
  addFillLayer();

  // Menghapus watermark Mapbox (harus dijalankan setelah map diload)
  $(
    ".mapboxgl-ctrl.mapboxgl-ctrl-attrib, .mapboxgl-ctrl-geocoder.mapboxgl-ctrl, a.mapboxgl-ctrl-logo"
  ).css("visibility", "hidden");
});
