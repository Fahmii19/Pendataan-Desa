class PitchToggle {
    constructor({ bearing = 0, pitch = 90, minpitchzoom = 15 }) {
        this._bearing = bearing;
        this._pitch = pitch;
        this._minpitchzoom = minpitchzoom;
    }

    // onAdd(map) {
    //     this._map = map;
    //     let _this = this;

    //     this._btn = document.createElement("button");
    //     this._btn.className = "mapboxgl-ctrl-icon mapboxgl-ctrl-pitchtoggle-3d";
    //     this._btn.type = "button";
    //     this._btn["aria-label"] = "Toggle Pitch";
    //     this._btn.onclick = function () {
    //         if (map.getPitch() === 0) {
    //             let options = {
    //                 pitch: _this._pitch,
    //                 bearing: _this._bearing,
    //                 zoom: _this._minpitchzoom,
    //             };
    //             if (
    //                 _this._minpitchzoom &&
    //                 map.getZoom() > _this._minpitchzoom
    //             ) {
    //                 options.zoom = _this._minpitchzoom;
    //             }
    //             map.setStyle(
    //                 "mapbox://styles/menthoelsr/ckp4wrapq11m117pf2lr49l5t"
    //             );
    //             map.easeTo(options);
    //             map.on("style.load", () => {
    //                 SourceZoning();
    //                 addSourceLayers(localStorage.getItem("kelurahan"));
    //             });
    //             _this._btn.className =
    //                 "mapboxgl-ctrl-icon mapboxgl-ctrl-pitchtoggle-2d";

    //             poi_icon.forEach((icon) => {
    //                 map.loadImage(
    //                     `assets/gambar/icons/${icon}`,
    //                     (error, image) => {
    //                         if (error) throw error;
    //                         map.addImage(icon.split(".")[0], image);
    //                     }
    //                 );
    //             });
    //         } else {
    //             map.setStyle(
    //                 "mapbox://styles/menthoelsr/ckp6i54ay22u818lrq15ffcnr"
    //             );
    //             map.easeTo({ pitch: 0, bearing: 0 });
    //             map.on("style.load", () => {
    //                 SourceZoning();
    //                 addSourceLayers(localStorage.getItem("kelurahan"));
    //             });
    //             _this._btn.className =
    //                 "mapboxgl-ctrl-icon mapboxgl-ctrl-pitchtoggle-3d";

    //             poi_icon.forEach((icon) => {
    //                 map.loadImage(
    //                     `assets/gambar/icons/${icon}`,
    //                     (error, image) => {
    //                         if (error) throw error;
    //                         map.addImage(icon.split(".")[0], image);
    //                     }
    //                 );
    //             });
    //         }
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
