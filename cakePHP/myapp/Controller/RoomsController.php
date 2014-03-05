<?php
App::uses('AppController', 'Controller');
class RoomsController extends AppController {

	public $uses = array('Room', 'Message');
	
	public function index() {
		$this->set('roomlist',$this->Room->getAllRooms());
    }
	
	public function addroom()
	{
		 if ($this->request->is('post')) {
            $this->Room->create();
            if ($this->Room->save($this->data)) {
                $this->Session->setFlash(__('The room has been saved'));
                return $this->redirect(array('action' => 'index', 'controller' => 'rooms'));
            } 
			else
            $this->Session->setFlash(
                __('The room could not be saved. Please, try again.')
            );
        }
	}
	
	public function content($roomID)
	{
		$this->set('roomlist',$this->Room->getAllRooms());
		$this->set('roomInfo',$this->Room->getRoomById($roomID));
		$this->set('content',$this->Message->viewMessages($roomID));
	}

}
?>