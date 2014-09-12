<?php
App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
/**
 * Bookings Controller
 *
 * @property Booking $Booking
 */
class BookingsController extends AppController {

    var $date;

    public function beforeFilter()
    {
        $conditions = array();

        $this->setDate();

        if($this->request->query('from')){
            $from = str_replace('/', '-', $this->request->query['from']);
            $from = date('Y-m-d', strtotime($from));

            $to = str_replace('/', '-', $this->request->query['to']);
            $to = date('Y-m-d', strtotime($to));
        }else{
            $to = $this->date;
            $dateStart = new DateTime();
            $from = $dateStart->format('Y-m-d');

        }

        $conditions['Booking.date <='] = $to;
        $conditions['Booking.date >='] = $from;

        $this->paginate['conditions'] = array($conditions);
    }

    public function setDate()
    {
        $date = new DateTime();
        $date->add(new DateInterval('P7D'));
        $this->date = $date->format('Y-m-d');
    }

    public $paginate = array('limit' => 10);

/**
 * index method
 *
 * @return void
 */
	public function index() {

        if ( $this->Auth->user('role_id') == 3 )
        {
            $this->paginate['conditions'] = array('User.id' => $this->Auth->user('id'));
        }

		$this->Booking->recursive = 0;

        $results = $this->paginate();

        $this->loadModel('Schedule');
        $schedules = $this->Schedule->find('all', array('conditions' => array('status' => 1)));

        $bookings = array();
        foreach($schedules as $schedule){
            foreach($results as $key => $value){

                if(strtotime(date('H:i:s', strtotime($value['Booking']['start']))) >= strtotime($schedule['Schedule']['start'])
                    AND strtotime(date('H:i:s', strtotime($value['Booking']['end']))) <= strtotime($schedule['Schedule']['end'])){

                    $bookings[$schedule['Schedule']['id']]['schedule'] = $schedule['Schedule']['schedules'];
                    $bookings[$schedule['Schedule']['id']]['bookings'][] = $results[$key];

                    unset($results[$key]);
                }
            }
        }

        if(count($results) > 0){
            $bookings[] = array('schedule' => 'Fora de Horário',
                                'bookings' => $results);
        }

        $this->set(compact('bookings'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Booking->exists($id)) {
			throw new NotFoundException(__('Reserva inválida'));
		}
		$options = array('conditions' => array('Booking.' . $this->Booking->primaryKey => $id));
		$this->set('booking', $this->Booking->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Booking->create();

            $date = str_replace('/', '-', $this->request->data['Booking']['date']);
            $date = date('Y-m-d', strtotime($date));
            $this->request->data['Booking']['date'] = $date;

			if ($this->Booking->save($this->request->data)) {
				$this->Session->setFlash(__('Reserva adicionada com sucesso'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Reserva não foi adicionada. Por favor, tente novamente.'));
			}
		}

        if ( $this->Auth->user('role_id') != 3 )
        {
		    $users = $this->Booking->User->find('list', array('conditions' => array('status' => 1)));
    		$this->set(compact('users'));
        }

        $this->loadModel('Schedule');
        $opts = array('fields' => array('id', 'schedules'), 'conditions' => array('status' => 1));
        $schedules = $this->Schedule->find('list', $opts);
        $this->set(compact('schedules'));
        /*$equipaments = $this->Booking->Equipament->find('list');
        $classrooms = $this->Booking->Classroom->find('list');
        $this->set(compact('equipaments', 'classrooms'));*/
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Booking->exists($id)) {
			throw new NotFoundException(__('Reserva inválida'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
            $date = str_replace('/', '-', $this->request->data['Booking']['date']);
            $date = date('Y-m-d', strtotime($date));
            $this->request->data['Booking']['date'] = $date;
			if ($this->Booking->save($this->request->data)) {
				$this->Session->setFlash(__('Reserva alterada com sucesso'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Reserva não foi alterada. Por favor, tente novamente.'));
			}
		} else {
			$options = array('conditions' => array('Booking.' . $this->Booking->primaryKey => $id));
			$this->request->data = $this->Booking->find('first', $options);

            $this->loadModel('Config');
            $config = $this->Config->find('first');

            $equipaments = $this->Booking->Equipament->find('list');
            $users = $this->Booking->User->find('list');
            $classrooms = $this->Booking->Classroom->find('list');

            $this->set(compact('equipaments', 'users', 'classrooms', 'config'));
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
		$this->Booking->id = $id;
		if (!$this->Booking->exists()) {
			throw new NotFoundException(__('Reserva inválida'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Booking->delete()) {
			$this->Session->setFlash(__('Reserva excluída'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Reserva não foi excluída'));
		$this->redirect(array('action' => 'index'));
	}

    /*public function get_list()
    {
        $this->autoRender = false;

        $date = str_replace('/', '-', $this->request->data['date']);
        $date = date('Y-m-d', strtotime($date));

        $bookings = $this->Booking->find('all', array('fields' => array('HOUR(start) AS hour'), 'conditions' => array('date' => $date)));
        echo json_encode($bookings);

    }*/
}
