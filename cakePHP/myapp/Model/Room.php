<?php 
App::uses('AuthComponent', 'Controller/Component');
class Room extends AppModel {
	/*public function isOwnedBy($post, $user) {
    return $this->field('id', array('id' => $post, 'user_id' => $user)) === $post;
}*/
	public $primaryKey = 'roomID';
	public $validate = array(
        'name' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A roomname is required'
            )
        )
    );
	
	public function beforeSave($options = array()) {
        parent::beforeSave($options);
            $this->data['Room']['owner'] = AuthComponent::user('userID');
    }
	
	
    public function getAllRooms() {
        $conditions = array(
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.userID = Room.owner',
                    )
                ),
            ),
            'fields' => array('Room.*', 'User.username'),
            'order' => array('Room.roomID' => 'DESC'),
        );

        // foreach ($filters as $key => $value) {
            // $conditions[$key] = $value;
        // }

        return $this->find('all', $conditions);
    }

    public function getRoomById($room_id) {
        $room_id = intval($room_id);
        $conditions = array(
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.userID = Room.owner',
                    )
                ),
            ),
            'fields' => array('Room.*', 'User.username'),
            'conditions' => "Room.roomID = $room_id",
        );

        return $this->find('first', $conditions);
    }
}
?>