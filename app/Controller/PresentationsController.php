<?php
use PhpOffice\PhpPowerpoint as Powerpoin;

App::uses('AppController', 'Controller');


/**
 * Presentation Controller
 *
 * @property Role $Role
 * @property PaginatorComponent $Paginator
 */
class PresentationsController extends AppController {
    /**
     * List of used models
     *
     * @var type 
     */
    public $uses = array(
        'Lesson',
        'Answer',
    );

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $id = $this->request->data['id'];
        $options = array('conditions' => array('Lesson.' . $this->Lesson->primaryKey => $id));
        $lesson = $this->Lesson->find('first', $options);

        $objPHPPowerPoint = new Powerpoin\PhpPowerpoint();
        $this->addTitlteImage($objPHPPowerPoint, $lesson);
        $this->addTitleText($objPHPPowerPoint, $lesson);

        foreach ($lesson['Question'] as $question) {
            $this->addSlde($objPHPPowerPoint, $question);
        }

        $oWriterPPTX = Powerpoin\IOFactory::createWriter($objPHPPowerPoint, 'PowerPoint2007');
        $oWriterPPTX->save(WWW_ROOT . '/presentations/' . $id . '.pptx');
        $data = array('url' => '/presentations/' . $id . '.pptx');
        $this->jsonResponse($data);
    }
    
    private function addTitlteImage($objPHPPowerPoint, $lesson) {
        // Create a shape (drawing)
        $currentSlide = $objPHPPowerPoint->getActiveSlide();
        $shape = $currentSlide->createDrawingShape();
        $image = WWW_ROOT . $lesson['Lesson']['full_image_url'];
        $shape->setName($lesson['Lesson']['name'])
                ->setPath($image)
                ->setHeight(400)
                ->setWidth(400)
                ->setOffsetX(10)
                ->setOffsetY(10);
        $shape->getShadow()
                ->setVisible(true)
                ->setDirection(45)
                ->setDistance(10);
    }
    
    private function addTitleText($objPHPPowerPoint, $lesson) {
        $currentSlide = $objPHPPowerPoint->getActiveSlide();
        $shape = $currentSlide->createRichTextShape()
                ->setHeight(300)
                ->setWidth(600)
                ->setOffsetX(170)
                ->setOffsetY(450);
        $shape->getActiveParagraph()
                ->getAlignment()
                ->setHorizontal(Powerpoin\Style\Alignment::HORIZONTAL_CENTER);
        $textRun = $shape->createTextRun($lesson['Lesson']['name']);
        $textRun->getFont()->setBold(true)
                ->setSize(60)
                ->setColor(new Powerpoin\Style\Color('FFE06B20'));
    }
    
    private function addSlde($objPHPPowerPoint, $question) {
        $currentSlide = $objPHPPowerPoint->createSlide();
        $shape = $currentSlide->createRichTextShape()
                ->setHeight(300)
                ->setWidth(600)
                ->setOffsetX(170)
                ->setOffsetY(450);
        $shape->getActiveParagraph()
                ->getAlignment()
                ->setHorizontal(Powerpoin\Style\Alignment::HORIZONTAL_CENTER);
        $textRun = $shape->createTextRun($question['question']);
        $textRun->getFont()->setBold(true)
                ->setSize(60)
                ->setColor(new Powerpoin\Style\Color('FFE06B20'));
    }
}
