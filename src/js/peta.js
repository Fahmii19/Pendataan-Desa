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

// Custom Control Button
// Navigator
// map.addControl(new mapboxgl.NavigationControl());

var controlGroup = document.querySelector(
  ".mapboxgl-ctrl-top-right .mapboxgl-ctrl-group"
);

var compass = controlGroup.querySelector(".mapboxgl-ctrl-compass");
if (compass) {
  compass.style.setProperty("display", "none", "important");
}

//
//

// Tooltip HTML
var tooltipHTML = `
  <div
    id="control-map-penggaris"
    role="tooltip"
    class="absolute z-10 invisible inline-block px-2 py-1 text-sm font-medium text-black bg-white rounded-lg shadow-sm opacity-0 tooltip"
  >
    Penggaris
    <div class="tooltip-arrow" data-popper-arrow></div>
  </div>
`;

// Menambahkan tooltip ke DOM
document.body.insertAdjacentHTML("beforeend", tooltipHTML);

// Stick Button 3
var stickButton3 = document.createElement("button");
stickButton3.className = "mapboxgl-ctrl-icon custom-control-button btn-stick3";
stickButton3.setAttribute("type", "button");
stickButton3.setAttribute("aria-label", "Stick Action 3");

// Menambahkan atribut untuk tooltips
stickButton3.setAttribute("data-tooltip-target", "control-map-poligon");
stickButton3.setAttribute("data-tooltip-placement", "left");

stickButton3.addEventListener("click", function (event) {
  makeActive(event);
});

stickButton3.addEventListener("mouseenter", function (event) {
  var tooltip = document.getElementById("control-map-poligon");
  tooltip.classList.remove("invisible", "opacity-0");
  tooltip.classList.add("visible", "opacity-100");
});

stickButton3.addEventListener("mouseleave", function (event) {
  var tooltip = document.getElementById("control-map-poligon");
  tooltip.classList.add("invisible", "opacity-0");
  tooltip.classList.remove("visible", "opacity-100");
});

document.body.appendChild(stickButton3);
