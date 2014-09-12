<?php
App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');
/**
 * Classrooms Controller
 *
 * @property Classroom $Classroom
 */
class ClassroomsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Classroom->recursive = 0;
		$this->set('classrooms', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Classroom->exists($id)) {
			throw new NotFoundException(__('Sala inválida'));
		}
		$options = array('conditions' => array('Classroom.' . $this->Classroom->primaryKey => $id));
		$this->set('classroom', $this->Classroom->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Classroom->create();
			if ($this->Classroom->save($this->request->data)) {
				$this->Session->setFlash(__('Sala adicionada com sucesso'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sala não foi adicionada. Por favor, tente novamente.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Classroom->exists($id)) {
			throw new NotFoundException(__('Sala inválida'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Classroom->save($this->request->data)) {
				$this->Session->setFlash(__('Sala editada com sucesso'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sala não foi editada. Por favor, tente novamente.'));
			}
		} else {
			$options = array('conditions' => array('Classroom.' . $this->Classroom->primaryKey => $id));
			$this->request->data = $this->Classroom->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Classroom->id = $id;
		if (!$this->Classroom->exists()) {
			throw new NotFoundException(__('Sala inválida'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Classroom->delete()) {
			$this->Session->setFlash(__('Sala excluída'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Sala não foi excluída'));
		$this->redirect(array('action' => 'index'));
	}

    public function get_classrooms()
    {
        $this->autoRender = false;

        $date = str_replace('/', '-', $this->request->data['date']);
        $date = date('Y-m-d', strtotime($date));

        $start = $this->request->data['start'];
        $end = $this->request->data['end'];

        $start_date = new DateTime($start);
        $end_date = new DateTime($end);
        $since_start = $start_date->diff($end_date);

        $this->loadModel('Config');
        $configs = $this->Config->find('first');

        $this->loadModel('Booking');

        if($this->Auth->user('role_id') != 1){
            $hasBooking = $this->Booking->find('all', array('conditions' => array('user_id' => $this->Auth->user('id'), 'date =' => $date,
                                                                                    'HOUR(start) !=' => CakeTime::format('H', $start),
                                                                                    'HOUR(end) !=' => CakeTime::format('H', $end),
                                                                                    )
                                                ));

            if ( !$hasBooking )
            {
                $bookings = array();
                $bookings = $this->Booking->find('list', array('fields' => array('classroom_id', 'classroom_id'), 'conditions' => array('user_id' => $this->Auth->user('id'), 'date =' => $date,
                                                                                'ADDTIME(TIMEDIFF(end, start), "' . $since_start->format('%H:%i') . '") >' => $configs['Config']['total_time']
                                                                                )
                                                                )
                                                );
                if (count($bookings) == 1)
                {
                    $bookings = reset($bookings);
                    $bookings = $bookings[0];
                }
                $classrooms = $this->Classroom->find('all', array('recursive' => -1, 'group' => array('Classroom.id'),
                                                                  'fields' => array('Classroom.*, Booking.start'),
                                                                  'conditions' => array('Classroom.id !=' => $bookings,
                                                                                        'Classroom.status' => 1),
                                                                  'joins' => array(
                                                                    array(
                                                                        'table' => 'bookings',
                                                                        'alias' => 'Booking',
                                                                        'type' => 'LEFT',
                                                                        'conditions' => array('Classroom.id = Booking.classroom_id',
                                                                                              'date =' => $date,
                                                                                              'HOUR(start) !=' => CakeTime::format('H', $start),
                                                                                              'HOUR(end) !=' => CakeTime::format('H', $end)
                                                                                            )
                                                                         ))));
            }

            if ( isset($classrooms))
            {
                foreach($classrooms as $k => $v)
                    if($v['Booking']['start'] != null)
                        unset($classrooms[$k]);
                echo json_encode($classrooms);
            }
            else
            {
                echo json_encode('');
            }
        }else{
            $classrooms = $this->Classroom->find('all', array('conditions' => array('Classroom.status' => 1)));
            echo json_encode($classrooms);
        }

    }
}
