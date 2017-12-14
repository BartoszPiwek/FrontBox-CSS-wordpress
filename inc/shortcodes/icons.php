<?php

function add_icon($icon) {
  echo file_get_contents( get_template_directory_uri() . '/assets/images/svg/' . $icon . '.svg');
};

?>

