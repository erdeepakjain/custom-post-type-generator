<?php
// Function to sanitize input data
function cpt_generator_sanitize_input( $data ) {
    return sanitize_text_field( $data );
}
