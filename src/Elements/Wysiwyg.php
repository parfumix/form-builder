<?php

namespace Parfumix\FormBuilder\Elements;

class Wysiwyg extends TextArea {

    /**
     * Render
     *
     * @return string
     */
    public function render() {
        $html = parent::render();
        $html .= $this->getJs();

        return $html;
    }

    /**
     * Get js code .
     *
     * @param $title
     * @return string
     */
    public function getJs() {
        return <<<HTML
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
HTML;
    }
}
