const base_url = "https://desa.pintoinvest.com/server/api/v1";
const list_layers = ["persil"];

mapboxgl.accessToken =
  "pk.eyJ1IjoibWVudGhvZWxzciIsImEiOiJja3M0MDZiMHMwZW83MnVwaDZ6Z2NhY2JxIn0.vQFxEZsM7Vvr-PX3FMOGiQ";

const map = new mapboxgl.Map({
  container: "mapSoaraja",
  style: "mapbox://styles/mapbox/streets-v11",
  zoom: 16.5,
  center: { lng: 107.82534697045242, lat: -6.742200615984984 },
  preserveDrawingBuffer: true,
});

map.on("style.load", () => {
  map.on("load", () => {
    list_layers.forEach((source) => {
      AddSource(source);
    });
  });
});

const AddLayers = (source) => {
  switch (source) {
    case "persil":
      map.addLayer({
        id: "persil-fill",
        type: "fill",
        source: source,
        layout: {
          visibility: "visible",
        },
        paint: {
          "fill-color": "#088",
          "fill-opacity": 0.8,
        },
      });
      break;

    default:
      break;
  }
};

const AddSource = async (source) => {
  const data = await fetch(`${base_url}/${source}`, {
    method: "POST",
  });
  const json = await data.json();
  map.addSource(source, {
    type: "geojson",
    data: json,
  });

  AddLayers(source);
};

window.OnOffLayer = (layer) => {
  console.log(map.getLayoutProperty(layer, "visibility"));
  if (map.getLayoutProperty(layer, "visibility") === "visible") {
    map.setLayoutProperty(layer, "visibility", "none");
  } else {
    map.setLayoutProperty(layer, "visibility", "visible");
  }
};

map.on("dragend", () => {
  console.log(map.getCenter());
});
