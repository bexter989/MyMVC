<?php

namespace libs;

class Load
{

    public function view($view_name = 'home/home_v', $data = null)
    {
        // Check the $data is an array
        if (is_array($data)) {
            // Make variables from each item in the array
            extract($data);
        }

        // View paths
        $view = config()->views_dir . $view_name . ".php";

        // Check the $view_name file exists
        if (!file_exists($view)) {
            throw new Exception("View {$view_name} dosen't exist");
        }
        require config()->views_dir . 'header.php';
        require $view;
        require config()->views_dir . 'footer.php';
    }
}
