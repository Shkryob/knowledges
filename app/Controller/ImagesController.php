<?php

App::uses('AppController', 'Controller');

/**
 * Roles Controller
 *
 * @property Role $Role
 * @property PaginatorComponent $Paginator
 */
class ImagesController extends AppController {
    private $thumbResizeOtions = array(
        'width' => 250,
        'height' => 250,
        'urlOnly' => true
    );
    
    private $fullResizeOtions = array(
        'width' => 900,
        'height' => 900,
        'urlOnly' => true
    );

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if(isset($_FILES['file'])) {
            $tempPath = $_FILES['file']['tmp_name'];
            $thumbURL = $this->Image->resize($tempPath, $this->thumbResizeOtions);
            $fullURL = $this->Image->resize($tempPath, $this->fullResizeOtions);
        }
        if (isset($thumbURL)) {
            $data['thumbURL'] = $thumbURL;
        }
        if (isset($fullURL)) {
            $data['fullURL'] = $fullURL;
            $message['message'] = __('Image was uploaded.');
        } else {
            $message['message'] = __('Can not upload image.');
        }
        $this->jsonResponse($data);
    }
}
