<?php
class MessagesController extends AppController
{
	public function add()
	{
		//var_dump($this->data);die;
		 if ($this->request->is('post')) {
            $this->Message->create();
            if ($this->Message->save($this->data)) {
            //    $this->Session->setFlash(__('The room has been saved'));
                return $this->redirect(array('action' => 'content', 'controller' => 'rooms', $this->data['Message']['roomID']));
            } 
			else
            $this->Session->setFlash(
                __('The room could not be saved. Please, try again.')
            );
        }
	}
	
	
    public function delete($messageID) {
        $this->Message->deleteMessage($messageID);
        $messageInfo = $this->Message->getMessageById($messageID);
        return $this->redirect(
								array(
									'controller' => 'rooms', 
									'action' => 'content', 
									$messageInfo['Message']['roomID']
									)
								);
    }
	
    public function edit($messageID) {
		//var_dump($messageID); die;
        $this->Message->editMessage($this->data,$messageID);
        $messageInfo = $this->Message->getMessageById($messageID);
        return $this->redirect(
								array(
									'controller' => 'rooms', 
									'action' => 'content', 
									$messageInfo['Message']['roomID']
									)
							   );
    }

    public function show(){
        $messages = $this->viewMessages($roomID);
        $this->set('messages', $messages);

        $roomInfo = $this->Room->getRoomById($roomID);
        $this->set('roomInfo', $roomInfo);

        $userLoginInfo = $this->Auth->user();
        $this->set('userLoginInfo', $userLoginInfo);
}}
?>