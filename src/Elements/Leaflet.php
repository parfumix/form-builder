<?php

namespace Parfumix\FormBuilder\Elements;

class Leaflet extends Input {

    /**
     * Render link
     *
     * @return string
     */
    public function render() {
        $result = $this->before;
        $result .= '<div id="map-'.$this->getAttribute('id').'"></div>';
        $result .= '<script type="text/javascript">var map = L.map("map").setView(['.$this->getAttribute('lat').', '.$this->getAttribute('lon').'], '.$this->getAttribute('zoom').');</script>';

        $result .= $this->after;

        return $result;
    }
}
