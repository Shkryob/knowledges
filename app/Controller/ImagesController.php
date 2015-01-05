<?php

App::uses('AppController', 'Controller');

/**
 * Images Controller
 *
 * @property Image $Image
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
        $data = array();
        if(isset($_FILES['file'])) {
            $tempPath = $_FILES['file']['tmp_name'];
            $fileInfo = pathinfo($_FILES['file']['name']);
            $fname = sha1_file($tempPath) . $fileInfo['extension'];
            $thumbURL = $this->ImageResize->resize($tempPath, $this->thumbResizeOtions, $fname);
            $mediumURL = $this->ImageResize->resize($tempPath, $this->fullResizeOtions, $fname);
            $fullURL = '/img/uploaded/' . $fname;
            $fullPath = WWW_ROOT . DS . 'img' . DS . 'uploaded' . DS . $fname;
            copy($tempPath, $fullPath);
        }
        if (isset($fullURL)) {
            $imageData = array(
                'name' => $fileInfo['basename'],
                'full' => $fullURL,
                'medium' => $mediumURL,
                'thumb' => $thumbURL
            );
            $this->Image->save($imageData);
            $id = $this->Image->getLastInsertID();
            $options = array('conditions' => array('Image.' . $this->Image->primaryKey => $id));
            $image = $this->Image->find('first', $options);
            $data['message'] = __('Image was uploaded.');
            $data['image'] = $image['Image'];
        } else {
            $data['message'] = __('Can not upload image.');
        }
        $this->jsonResponse($data);
    }
}
