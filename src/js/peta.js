import PasarIcon from "../images/icons/pasar.png";
import LumbungIcon from "../images/icons/lumbung.png";
import PenggilinganIcon from "../images/icons/penggilingan.png";

const base_url = "https://desa.pintoinvest.com/server/api/v1";
const list_layers = ["persil"];
const list_layers_default = ["persil"];

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
    // Load Image Icon
    const iconMap = {
      pasar: PasarIcon,
      lumbung: LumbungIcon,
      penggilingan: PenggilinganIcon,
    };

    Object.keys(iconMap).forEach((key) => {
      map.loadImage(iconMap[key], (error, image) => {
        if (error) throw error;
        map.addImage(key, image);
      });
    });

    // Add Layer Default
    list_layers_default.forEach((source) => {
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
          "fill-color": [
            "interpolate",
            ["linear"],
            ["get", "ph"],
            2,
            "#D7CCC8",
            4,
            "#BCAAA4",
            6,
            "#A1887F",
            8,
            "#8D6E63",
            10,
            "#795548",
          ],
          "fill-opacity": 1,
        },
      });
      break;
    case "sungai":
      map.addLayer({
        id: "sungai-line",
        type: "line",
        source: source,
        layout: {
          visibility: "visible",
        },
        paint: {
          "line-color": "#2196F3",
          "line-width": 2,
        },
      });
      break;
    case "hujan":
      const day =
        document.querySelector("input[name='curah_hujan']:checked")?.value ??
        30;
      map.addLayer({
        id: "hujan-fill",
        type: "fill",
        source: source,
        layout: {
          visibility: "visible",
        },
        paint: {
          "fill-color": ["get", `color_${day}`],
          "fill-opacity": 0.5,
          "fill-outline-color": "#fff",
        },
      });
      break;
    case "fasilitas":
      const category = document
        .querySelector("[id^='chip-'].text-blue-500")
        .id.split("-")[1];
      map.addLayer({
        id: "fasilitas-point",
        type: "symbol",
        source: source,
        layout: {
          "icon-image": category,
          "icon-size": 0.05,
          "icon-allow-overlap": true,
          visibility: "visible",
        },
        filter: ["==", "jenis", category],
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
  if (map.getLayer(layer)) {
    HideAndShow(layer);
  } else {
    AddSource(layer.split("-")[0]);
  }
};

const HideAndShow = (layer) => {
  if (map.getLayoutProperty(layer, "visibility") === "visible") {
    map.setLayoutProperty(layer, "visibility", "none");
  } else {
    map.setLayoutProperty(layer, "visibility", "visible");
  }
};

// Disabled radio button if checkbox is not checked
document
  .getElementById("prediksi_curah_hujan_checkbox")
  .addEventListener("change", (e) => {
    const radios = document.querySelectorAll("input[name='curah_hujan']");
    radios.forEach((radio) => {
      radio.disabled = !e.target.checked;
    });
  });

// Change Color Layer hujan-fill By Param
document.querySelectorAll("input[name='curah_hujan']").forEach((input) => {
  input.addEventListener("change", (e) => {
    const day = e.target.value;
    if (map.getLayer("hujan-fill")) {
      map.setPaintProperty("hujan-fill", "fill-color", ["get", `color_${day}`]);
    }
  });
});

// Set Filter Fasilitas
const filterFasilitas = (category) => {
  const filter = ["==", "jenis", category];
  if (map.getLayer("fasilitas-point")) {
    map.setFilter("fasilitas-point", filter);
    map.setLayoutProperty("fasilitas-point", "icon-image", category);
  }
};

// Add Active Class if chip is clicked
document.querySelectorAll("[id^='chip-']").forEach((chip) => {
  chip.addEventListener("click", (e) => {
    const id = chip.id;
    const category = id.split("-")[1];
    const id_clicked = document.querySelector(
      "[id^='chip-'].text-blue-500"
    )?.id;
    document.querySelectorAll("[id^='chip-']").forEach((chip) => {
      chip.classList.remove("text-blue-500");
    });

    // Remove Active Class
    if (id === id_clicked) {
      if (map.getLayer("fasilitas-point")) {
        map.setLayoutProperty("fasilitas-point", "visibility", "none");
      }
    } else {
      // Add Active Class
      document.getElementById(id).classList.add("text-blue-500");
      if (!map.getLayer("fasilitas-point")) {
        AddSource("fasilitas");
      } else {
        map.setLayoutProperty("fasilitas-point", "visibility", "visible");
        filterFasilitas(category);
      }
    }
  });
});
