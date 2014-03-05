<?php 
class Message extends AppModel{
	public $primaryKey = 'messageID';
	public $validate = array(
        'content' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A roomname is required'
            )
        )
    );
	public function viewMessages($roomID)
	{
        $conditions = array(
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.userID = Message.userID',
                    )
                ),
				array(
                    'table' => 'rooms',
                    'alias' => 'Room',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Message.roomID = Room.roomID',
                    )
                ),
            ),
					
            'fields' => array('Room.*', 'User.*','Message.*'),
            'conditions' => array("Room.roomID = $roomID AND User.userID = Message.userID"),
			'order' => array('Message.messageID' => 'DESC')
        );

        return $this->find('all', $conditions);
    }
	
	public function beforeSave($options = array()) {
        parent::beforeSave($options);
            $this->data['Message']['userID'] = AuthComponent::user('userID');
    }
	
	 public function getMessageById($messageID) {
        $option = array(
            'conditions' => array('Message.messageID=' . $messageID)
        );
        return $this->find('first', $option);
    }

    public function deleteMessage($messageID) {
        $this->data['Message']['messageID'] = $messageID;
        $this->data['Message']['status'] = 1;
        return $this->save($this->data);
    }
	
    public function editMessage($content, $messageID){
        $this->data['Message']['messageID'] = $messageID;
        $this->data['Message']['status'] = 2;
        $this->data['Message']['content'] = $content['Message']['content'];
//        var_dump($this->data);die;
        return $this->save($this->data);
    }
}
?>