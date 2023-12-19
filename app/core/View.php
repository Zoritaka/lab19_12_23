<?php
class View {
    public function generate($view, $template, $data = null) {
        if(is_array($data)) {
            extract($data);
        }
        include "app/views/$template";
    }
}