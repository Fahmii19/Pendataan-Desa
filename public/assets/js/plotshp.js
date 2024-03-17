class PlotSHP {
    // onAdd(map) {
    //     this._map = map;
    //     let _this = this;

    //     this._btn = document.createElement("button");
    //     this._btn.className = "mapboxgl-ctrl-icon mapbox-gl-plot-shp";
    //     this._btn.type = "button";
    //     this._btn["title"] = "Plot SHP";
    //     this._btn.onclick = function () {
    //         document.getElementById("btnSHP").click();
    //     };

    //     this._container = document.getElementsByClassName(
    //         "mapboxgl-ctrl mapboxgl-ctrl-group"
    //     )[0];
    //     this._container.appendChild(this._btn);

    //     return this._container;
    // }

    onRemove() {
        this._map = undefined;
    }
}
