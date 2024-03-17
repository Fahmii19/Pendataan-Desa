class MeasureDistance {
    // onAdd(map) {
    //     this._map = map;
    //     let _this = this;

    //     // GeoJSON object to hold our measurement features
    //     const geojson = {
    //         type: "FeatureCollection",
    //         features: [],
    //     };

    //     // Used to draw a line between points
    //     // const linestring = {
    //     //     type: "Feature",
    //     //     geometry: {
    //     //         type: "LineString",
    //     //         coordinates: [],
    //     //     },
    //     // };

    //     this._btn = document.createElement("button");
    //     this._btn.className =
    //         "mapboxgl-ctrl-icon mapboxgl-ctrl-measure-distance";
    //     this._btn.type = "button";
    //     this._btn.title = "Ukur Jarak";
    //     this._btn["aria-label"] = "Measure Distance";
    //     this._btn.onclick = () => {
    //         if (
    //             document.getElementsByClassName(
    //                 "mapboxgl-ctrl-measure-distance-active"
    //             ).length == 0
    //         ) {
    //             // Set State Active
    //             localStorage.setItem("measure_distance", 1);

    //             // Set Cursor to Crosshair
    //             map.getCanvas().style.cursor = "crosshair";

    //             // Set Button Active
    //             this._btn.className =
    //                 "mapboxgl-ctrl-icon mapboxgl-ctrl-measure-distance-active";

    //             if (map.getSource("geojson") == undefined) {
    //                 map.addSource("geojson", {
    //                     type: "geojson",
    //                     data: geojson,
    //                 });

    //                 // Add styles to the map
    //                 map.addLayer({
    //                     id: "measure-points",
    //                     type: "circle",
    //                     source: "geojson",
    //                     paint: {
    //                         "circle-radius": 5,
    //                         "circle-color": "white",
    //                         "circle-stroke-width": 2,
    //                         "circle-stroke-color": "#000",
    //                     },
    //                     filter: ["in", "$type", "Point"],
    //                 });
    //                 map.addLayer({
    //                     id: "measure-lines",
    //                     type: "line",
    //                     source: "geojson",
    //                     layout: {
    //                         "line-cap": "round",
    //                         "line-join": "round",
    //                     },
    //                     paint: {
    //                         "line-color": "white",
    //                         "line-width": 2.5,
    //                     },
    //                     filter: ["in", "$type", "LineString"],
    //                 });

    //                 // Label Layer for Distance
    //                 map.addLayer({
    //                     id: "measure-labels",
    //                     type: "symbol",
    //                     source: "geojson",
    //                     layout: {
    //                         "symbol-placement": "line",
    //                         "text-field": "{distance}",
    //                         "text-font": [
    //                             "Open Sans Semibold",
    //                             "Arial Unicode MS Bold",
    //                         ],
    //                         "text-size": 18,
    //                         "text-keep-upright": true,
    //                         "text-offset": [0, 0.8],
    //                         "text-allow-overlap": false,
    //                         "text-ignore-placement": true,
    //                         "text-justify": "auto",
    //                         "text-anchor": "center",
    //                     },
    //                     paint: {
    //                         "text-color": "white",
    //                     },
    //                     filter: ["in", "$type", "LineString"],
    //                 });
    //             }

    //             map.on("click", (e) => {
    //                 // linestring.geometry.coordinates = [];

    //                 // const features = map.queryRenderedFeatures(e.point, {
    //                 //     layers: ["measure-points"],
    //                 // });

    //                 // Remove the linestring from the group
    //                 // so we can redraw it based on the points collection.
    //                 if (geojson.features.length > 1) {
    //                     geojson.features.pop();
    //                 }

    //                 // Clear the distance container to populate it with a new value.
    //                 // distanceContainer.innerHTML = "";

    //                 // If a feature was clicked, remove it from the map.
    //                 // if (features.length) {
    //                 //     const id = features[0].properties.id;
    //                 //     geojson.features = geojson.features.filter(
    //                 //         (point) => point.properties.id !== id
    //                 //     );
    //                 // } else {
    //                 const point = {
    //                     type: "Feature",
    //                     geometry: {
    //                         type: "Point",
    //                         coordinates: [e.lngLat.lng, e.lngLat.lat],
    //                     },
    //                     properties: {
    //                         id: String(new Date().getTime()),
    //                         distance: "0 m",
    //                     },
    //                 };

    //                 geojson.features.push(point);
    //                 // }

    //                 if (geojson.features.length > 0) {
    //                     // linestring.geometry.coordinates = [];
    //                     // linestring.geometry.coordinates = geojson.features.map(
    //                     //     (point) => point.geometry.coordinates
    //                     // );

    //                     // geojson.features.push(linestring);

    //                     // Filter GeoJSON to only contain point features
    //                     let list_point = geojson.features.filter(
    //                         (point) => point.geometry.type == "Point"
    //                     );

    //                     for (
    //                         let index = 0;
    //                         index < list_point.length - 1;
    //                         index++
    //                     ) {
    //                         const point1 = list_point[index];
    //                         const point2 = list_point[index + 1];

    //                         // Calculate the distance in kilometers between points.
    //                         const distance = turf.distance(point1, point2, {
    //                             units: "meters",
    //                         });

    //                         // Update the LineString with calculated distance
    //                         geojson.features.push({
    //                             type: "Feature",
    //                             geometry: {
    //                                 type: "LineString",
    //                                 coordinates: [
    //                                     point1.geometry.coordinates,
    //                                     point2.geometry.coordinates,
    //                                 ],
    //                             },
    //                             properties: {
    //                                 distance: distance.toFixed(2) + " m",
    //                             },
    //                         });
    //                     }

    //                     // linestring.geometry.coordinates.forEach((point, i) => {
    //                     //     let temp_length = {
    //                     //         type: "Feature",
    //                     //         geometry: {
    //                     //             type: "LineString",
    //                     //             coordinates: [],
    //                     //         },
    //                     //     };

    //                     //     temp_length.geometry.coordinates =
    //                     //         linestring.geometry.coordinates.slice(0, i + 1);
    //                     //     let distance = turf.length(temp_length, {
    //                     //         units: "meters",
    //                     //     });
    //                     //     let rounded_distance =
    //                     //         distance == 0
    //                     //             ? "0 m"
    //                     //             : `${distance.toFixed(2)} m`;
    //                     //     geojson.features.forEach(({ geometry }) => {
    //                     //         const { type } = geometry;
    //                     //         if (type === "Point") {
    //                     //             geojson.features[i].properties.distance =
    //                     //                 rounded_distance;
    //                     //         }
    //                     //     });
    //                     // });
    //                 }

    //                 map.on("mouseenter", "measure-points", () => {
    //                     map.getCanvas().style.cursor = "pointer";
    //                 });

    //                 map.on("mouseleave", "measure-points", () => {
    //                     map.getCanvas().style.cursor = "crosshair";
    //                 });
    //                 if (map.getSource("geojson")) {
    //                     map.getSource("geojson").setData(geojson);
    //                 }
    //             });
    //         } else {
    //             // Set State Inactive
    //             localStorage.setItem("measure_distance", 0);

    //             geojson.features = [];

    //             // linestring.geometry.coordinates = [];

    //             // Set Cursor to Default
    //             map.getCanvas().style.cursor = "";

    //             // Set Button Inactive
    //             this._btn.className =
    //                 "mapboxgl-ctrl-icon mapboxgl-ctrl-measure-distance";

    //             // Clear Map
    //             if (map.getSource("geojson")) {
    //                 map.removeLayer("measure-points");
    //                 map.removeLayer("measure-lines");
    //                 map.removeLayer("measure-labels");
    //                 map.removeSource("geojson");
    //             }
    //         }

    //         // If Press Esc
    //         document.addEventListener("keydown", (e) => {
    //             if (e.key === "Escape") {
    //                 // Set State Inactive
    //                 localStorage.setItem("measure_distance", 0);

    //                 geojson.features = [];

    //                 // linestring.geometry.coordinates = [];

    //                 // Set Cursor to Default
    //                 map.getCanvas().style.cursor = "";

    //                 // Set Button Inactive
    //                 this._btn.className =
    //                     "mapboxgl-ctrl-icon mapboxgl-ctrl-measure-distance";

    //                 // Clear Map
    //                 if (map.getSource("geojson")) {
    //                     map.removeLayer("measure-points");
    //                     map.removeLayer("measure-lines");
    //                     map.removeLayer("measure-labels");
    //                     map.removeSource("geojson");
    //                 }
    //             }
    //         });
    //     };

    //     this._container = document.getElementsByClassName(
    //         "mapboxgl-ctrl mapboxgl-ctrl-group"
    //     )[0];
    //     this._container.appendChild(this._btn);

    //     return this._container;
    // }

    onRemove() {
        this._container.parentNode.removeChild(this._container);
        this._map = undefined;
    }
}
