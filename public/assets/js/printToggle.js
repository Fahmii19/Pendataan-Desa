class PrintToggle {
    onAdd(map) {
        this._map = map;
        let _this = this;

        this._btn = document.createElement("button");
        this._btn.className = "mapboxgl-ctrl-icon mapbox-gl-print-disabled";
        this._btn.type = "button";
        this._btn.disabled = true;
        this._btn["title"] = "Cetak";
        this._btn.onclick = function () {
            document.getElementsByClassName(
                "info-print-data"
            )[0].style.display = "block";
        };

        this._container = document.getElementsByClassName(
            "mapboxgl-ctrl mapboxgl-ctrl-group"
        )[0];
        this._container.appendChild(this._btn);

        return this._container;
    }

    onRemove() {
        this._map = undefined;
    }
}
