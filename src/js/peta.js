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
map.addControl(new mapboxgl.NavigationControl());

var controlGroup = document.querySelector(
  ".mapboxgl-ctrl-top-right .mapboxgl-ctrl-group"
);

var compass = controlGroup.querySelector(".mapboxgl-ctrl-compass");
if (compass) {
  compass.style.setProperty("display", "none", "important");
}

function makeActive(event) {
  var currentButton = event.currentTarget;

  // Toggle the 'active-button' class based on its presence
  if (currentButton.classList.contains("active-button")) {
    // If it's already active, remove the class to deactivate it
    currentButton.classList.remove("active-button");
  } else {
    // If it's not active, first deactivate all buttons
    var buttons = document.querySelectorAll(".custom-control-button");
    buttons.forEach(function (button) {
      button.classList.remove("active-button");
    });
    // Then activate the clicked button
    currentButton.classList.add("active-button");
  }
}

if (controlGroup) {
  // My Location Button

  var myLocationButton = document.createElement("button");
  myLocationButton.className =
    "mapboxgl-ctrl-icon custom-control-button btn-location";
  myLocationButton.setAttribute("type", "button");
  myLocationButton.setAttribute("aria-label", "My Location");

  // Menambahkan atribut untuk tooltips
  myLocationButton.setAttribute("data-tooltip-target", "control-map-location");
  myLocationButton.setAttribute("data-tooltip-placement", "left");

  myLocationButton.addEventListener("click", function (event) {
    makeActive(event);
  });

  // Menambahkan event listener untuk menampilkan tooltip
  myLocationButton.addEventListener("mouseenter", function (event) {
    var tooltip = document.getElementById("control-map-location");
    tooltip.classList.remove("invisible", "opacity-0");
    tooltip.classList.add("visible", "opacity-100");
  });

  myLocationButton.addEventListener("mouseleave", function (event) {
    var tooltip = document.getElementById("control-map-location");
    tooltip.classList.add("invisible", "opacity-0");
    tooltip.classList.remove("visible", "opacity-100");
  });

  // Menambahkan button ke DOM
  document.body.appendChild(myLocationButton);

  // Tooltip HTML
  var tooltipHTML = `
  <div
    id="control-map-location"
    role="tooltip"
    class="absolute z-10 invisible inline-block px-2 py-1 text-sm font-medium text-black bg-white rounded-lg shadow-sm opacity-0 tooltip"
  >
    My Location
    <div class="tooltip-arrow" data-popper-arrow></div>
  </div>
`;

  // Menambahkan tooltip ke DOM
  document.body.insertAdjacentHTML("beforeend", tooltipHTML);

  //

  // Tooltip HTML
  var tooltipHTML = `
  <div
    id="control-map-detector"
    role="tooltip"
    class="absolute z-10 invisible inline-block px-2 py-1 text-sm font-medium text-black bg-white rounded-lg shadow-sm opacity-0 tooltip"
  >
    Detector
    <div class="tooltip-arrow" data-popper-arrow></div>
  </div>
`;

  // Menambahkan tooltip ke DOM
  document.body.insertAdjacentHTML("beforeend", tooltipHTML);

  // Tooltip HTML
  var tooltipHTML = `
  <div
    id="control-map-radius"
    role="tooltip"
    class="absolute z-10 invisible inline-block px-2 py-1 text-sm font-medium text-black bg-white rounded-lg shadow-sm opacity-0 tooltip"
  >
    Radius
    <div class="tooltip-arrow" data-popper-arrow></div>
  </div>
`;

  // Menambahkan tooltip ke DOM
  document.body.insertAdjacentHTML("beforeend", tooltipHTML);

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

  // Tooltip HTML
  var tooltipHTML = `
  <div
    id="control-map-poligon"
    role="tooltip"
    class="absolute z-10 invisible inline-block px-2 py-1 text-sm font-medium text-black bg-white rounded-lg shadow-sm opacity-0 tooltip"
  >
    Poligon
    <div class="tooltip-arrow" data-popper-arrow></div>
  </div>
`;

  // Menambahkan tooltip ke DOM
  document.body.insertAdjacentHTML("beforeend", tooltipHTML);

  // Get Zoom In and Zoom Out buttons
  // Mengasumsikan controlGroup adalah elemen yang sudah ada di DOM
  var zoomInButton = controlGroup.querySelector(".mapboxgl-ctrl-zoom-in");

  // Menambahkan kelas untuk styling (jika diperlukan)
  zoomInButton.classList.add("custom-control-button", "btn-zoom-in");

  // Menambahkan atribut untuk tooltips
  zoomInButton.setAttribute("data-tooltip-target", "tooltip-zoom-in");
  zoomInButton.setAttribute("data-tooltip-placement", "left");

  // Menambahkan event listener untuk menampilkan tooltip
  zoomInButton.addEventListener("mouseenter", function (event) {
    var tooltip = document.getElementById("tooltip-zoom-in");
    tooltip.classList.remove("invisible", "opacity-0");
    tooltip.classList.add("visible", "opacity-100");
  });

  // Menambahkan event listener untuk menyembunyikan tooltip
  zoomInButton.addEventListener("mouseleave", function (event) {
    var tooltip = document.getElementById("tooltip-zoom-in");
    tooltip.classList.add("invisible", "opacity-0");
    tooltip.classList.remove("visible", "opacity-100");
  });

  // Tooltip HTML untuk zoomInButton
  var tooltipHTMLZoomIn = `
<div
  id="tooltip-zoom-in"
  role="tooltip"
  class="absolute z-10 invisible inline-block px-2 py-1 text-sm font-medium text-black bg-white rounded-lg shadow-sm opacity-0 tooltip"
>
  Zoom In
  <div class="tooltip-arrow" data-popper-arrow></div>
</div>
`;

  // Menambahkan tooltip untuk zoomInButton ke DOM
  document.body.insertAdjacentHTML("beforeend", tooltipHTMLZoomIn);

  // Mengasumsikan controlGroup adalah elemen yang sudah ada di DOM
  var zoomOutButton = controlGroup.querySelector(".mapboxgl-ctrl-zoom-out");

  // Menambahkan kelas untuk styling (jika diperlukan)
  zoomOutButton.classList.add("custom-control-button", "btn-zoom-out");

  // Menambahkan atribut untuk tooltips
  zoomOutButton.setAttribute("data-tooltip-target", "tooltip-zoom-out");
  zoomOutButton.setAttribute("data-tooltip-placement", "left");

  // Menambahkan event listener untuk menampilkan tooltip
  zoomOutButton.addEventListener("mouseenter", function (event) {
    var tooltip = document.getElementById("tooltip-zoom-out");
    tooltip.classList.remove("invisible", "opacity-0");
    tooltip.classList.add("visible", "opacity-100");
  });

  // Menambahkan event listener untuk menyembunyikan tooltip
  zoomOutButton.addEventListener("mouseleave", function (event) {
    var tooltip = document.getElementById("tooltip-zoom-out");
    tooltip.classList.add("invisible", "opacity-0");
    tooltip.classList.remove("visible", "opacity-100");
  });

  // Tooltip HTML untuk zoomOutButton
  var tooltipHTMLZoomOut = `
<div
  id="tooltip-zoom-out"
  role="tooltip"
  class="absolute z-10 invisible inline-block px-2 py-1 text-sm font-medium text-black bg-white rounded-lg shadow-sm opacity-0 tooltip"
>
  Zoom Out
  <div class="tooltip-arrow" data-popper-arrow></div>
</div>
`;

  // Menambahkan tooltip untuk zoomOutButton ke DOM
  document.body.insertAdjacentHTML("beforeend", tooltipHTMLZoomOut);

  // Remove zoom buttons from the DOM
  controlGroup.removeChild(zoomInButton);
  controlGroup.removeChild(zoomOutButton);

  // Membuat dan menambahkan tombol layer setelah tombol my location
  var layerButton = document.createElement("button");
  layerButton.className =
    "mapboxgl-ctrl-icon custom-control-button layer-button";
  layerButton.setAttribute("type", "button");
  layerButton.setAttribute("aria-label", "Layer");
  layerButton.innerHTML =
    '<span class="mapboxgl-ctrl-icon" aria-hidden="true" title="Layer"></span>';

  var customButtonMapboxDua = document.createElement("button");
  customButtonMapboxDua.className =
    "mapboxgl-ctrl-icon custom-control-button custom-button-mapbox-dua";
  customButtonMapboxDua.setAttribute("type", "button");
  customButtonMapboxDua.setAttribute("aria-label", "Custom Button Mapbox Dua");
  customButtonMapboxDua.innerHTML =
    '<span class="mapboxgl-ctrl-icon" aria-hidden="true" title="Custom Button Mapbox Dua"></span>';

  customButtonMapboxDua.addEventListener("click", function () {
    alert("Custom Button Mapbox Dua clicked!");
  });

  //

  // Custom Button

  var customButton = document.createElement("button");
  customButton.className = "mapboxgl-ctrl-icon custom-control-button btn-layer";
  customButton.setAttribute("type", "button");
  customButton.setAttribute("aria-label", "Layer");

  // Menambahkan atribut untuk tooltips
  customButton.setAttribute("data-tooltip-target", "control-layer");
  customButton.setAttribute("data-tooltip-placement", "left");

  // Menambahkan event listener untuk menampilkan tooltip
  customButton.addEventListener("mouseenter", function (event) {
    if (!dropdown.classList.contains("show")) {
      var tooltip = document.getElementById("control-layer");
      tooltip.classList.remove("invisible", "opacity-0");
      tooltip.classList.add("visible", "opacity-100");
    }
  });

  customButton.addEventListener("mouseleave", function (event) {
    var tooltip = document.getElementById("control-layer");
    tooltip.classList.add("invisible", "opacity-0");
    tooltip.classList.remove("visible", "opacity-100");
  });

  // Menambahkan button ke DOM
  document.body.appendChild(customButton);

  // Stick Button 3
  var stickButton3 = document.createElement("button");
  stickButton3.className =
    "mapboxgl-ctrl-icon custom-control-button btn-stick3";
  stickButton3.setAttribute("type", "button");
  stickButton3.setAttribute("aria-label", "Stick Action 3");

  // Menambahkan atribut untuk tooltips
  stickButton3.setAttribute("data-tooltip-target", "control-map-poligon");
  stickButton3.setAttribute("data-tooltip-placement", "left");

  stickButton3.addEventListener("click", function (event) {
    makeActive(event);
  });

  // Menambahkan event listener untuk menampilkan tooltip
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

  // Menambahkan button ke DOM
  document.body.appendChild(stickButton3);

  // Tooltip HTML
  var tooltipHTML = `
<div
  id="control-layer"
  role="tooltip"
  class="absolute z-10 invisible inline-block px-2 py-1 text-sm font-medium text-black bg-white rounded-lg shadow-sm opacity-0 tooltip"
>
  Layer
  <div class="tooltip-arrow" data-popper-arrow></div>
</div>
`;

  // Menambahkan tooltip ke DOM
  document.body.insertAdjacentHTML("beforeend", tooltipHTML);

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
  stickButton3.className =
    "mapboxgl-ctrl-icon custom-control-button btn-stick3";
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

  // Create dropdown
  var dropdown = document.createElement("div");
  dropdown.id = "dropdownDelay";
  dropdown.className =
    "z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-40 dark:bg-gray-700 absolute";
  dropdown.style.right = "100%"; // mengatur posisi ke kanan
  dropdown.style.marginRight = "10px"; // memberikan margin ke kanan
  dropdown.style.marginTop = "-3.5rem";
  dropdown.innerHTML = `
<div class="py-1">
  <div class="flex items-center mb-3 px-2 cursor-pointer" style="padding-top:0.55rem;">
    <input checked id="radio-default" type="radio" value="Default" name="map-layer" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-0">
    <label for="radio-default" class="ml-2 text-sm font-medium cursor-pointer text-gray-900 dark:text-gray-300">Default</label>
  </div>
  <div class="flex items-center mb-2 mt-2 px-2 cursor-pointer">
    <input id="radio-satellite" type="radio" value="Satellite" name="map-layer" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-0">
    <label for="radio-satellite" class="ml-2 text-sm font-medium cursor-pointer text-gray-900 dark:text-gray-300">Satellite</label>
  </div>
  <div class="flex items-center px-2 pb-3 cursor-pointer">
    <input id="radio-street" type="radio" value="Street" name="map-layer" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-0">
    <label for="radio-street" class="ml-2 text-sm font-medium cursor-pointer text-gray-900 dark:text-gray-300">Street</label>
  </div>
</div>
`;

  // Append dropdown to the body or to a specific container
  document.body.appendChild(dropdown);

  customButton.addEventListener("click", function (event) {
    // Show or hide dropdown
    dropdown.classList.toggle("hidden");
    // Prevent tooltip from showing when dropdown is visible
    event.stopPropagation();
  });

  // Close dropdown when clicking outside of it
  document.addEventListener("click", function (event) {
    if (
      !dropdown.contains(event.target) &&
      !customButton.contains(event.target)
    ) {
      dropdown.classList.add("hidden");
    }
  });

  controlGroup.appendChild(zoomInButton);
  controlGroup.appendChild(zoomOutButton);
  controlGroup.appendChild(customButton);
  controlGroup.appendChild(myLocationButton);
  controlGroup.appendChild(dropdown);
  controlGroup.appendChild(stickButton3);
}

//
//
