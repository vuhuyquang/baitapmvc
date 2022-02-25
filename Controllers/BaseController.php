<?php

class BaseController
{
    const VIEW_FOLDER_NAME = 'Views';
    const MODEL_FOLDER_NAME = 'Models';

    protected function view($path, array $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        require (self::VIEW_FOLDER_NAME . '/' . str_replace('.', '/', $path) . '.php');
    }

    protected function loadModel($path)
    {
        require (self::MODEL_FOLDER_NAME . '/' . $path . '.php');
    }
}

?>