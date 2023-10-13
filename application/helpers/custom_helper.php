<?php

function flashdata($msg, $error = false)
{
    if ($error) {
        return
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">' .
            $msg .
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
            '</div>';
    }
    return
        '<div class="alert alert-success alert-dismissible fade show" role="alert">' .
        $msg .
        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
        '</div>';
}

function json_output($statusHeader, $response)
{
    $ci = &get_instance();
    $ci->output->set_content_type('application/json');
    $ci->output->set_status_header($statusHeader);
    $ci->output->set_output(json_encode($response));
}
