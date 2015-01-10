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
    private $width = 960;
    private $height = 700;

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
        if (!isset($lesson['Lesson']['full_image_url'])
                || empty($lesson['Lesson']['full_image_url'])) {
            return;
        }
        $currentSlide = $objPHPPowerPoint->getActiveSlide();
        $shape = $currentSlide->createDrawingShape();
        $image = WWW_ROOT . $lesson['Lesson']['full_image_url'];
        $shape->setName($lesson['Lesson']['name'])
                ->setPath($image)
                ->setHeight($this->height)
                ->setWidth($this->width);
    }
    
    private function addTitleText($objPHPPowerPoint, $lesson) {
        $currentSlide = $objPHPPowerPoint->getActiveSlide();
        $shape = $currentSlide->createRichTextShape()
                ->setHeight($this->height)
                ->setWidth($this->width);
        $shape->getActiveParagraph()
                ->getAlignment()
                ->setHorizontal(Powerpoin\Style\Alignment::HORIZONTAL_CENTER);
        $shape->getActiveParagraph()
                ->getAlignment()
                ->setVertical(Powerpoin\Style\Alignment::VERTICAL_CENTER);
        $textRun = $shape->createTextRun($lesson['Lesson']['name']);
        $textRun->getFont()->setBold(true)
                ->setSize(30)
                ->setColor(new Powerpoin\Style\Color('FFFFFF0'));
    }
    
    private function addSlde($objPHPPowerPoint, $question) {
        $currentSlide = $objPHPPowerPoint->createSlide();
        $answer = $this->getBestAnswer($question);
        $shape = $currentSlide->createRichTextShape()
                ->setHeight($this->height)
                ->setWidth($this->width);
        $shape->getActiveParagraph()
                ->getAlignment()
                ->setHorizontal(Powerpoin\Style\Alignment::HORIZONTAL_CENTER);
        $shape->getActiveParagraph()
                ->getAlignment()
                ->setVertical(Powerpoin\Style\Alignment::VERTICAL_CENTER);
        $textRun = $shape->createTextRun($answer['text']);
        $textRun->getFont()->setBold(true)
                ->setSize(30)
                ->setColor(new Powerpoin\Style\Color('FFFFFF0'));
    }
    
    private function getBestAnswer($question) {
        $options = array('conditions' => array('Answer.question_id' => $question['id']),
            'order' => array('Answer.mark' => 'desc'));
        $answers = $this->Answer->find('first', $options);
        return $answers['Answer'];
    }
}
