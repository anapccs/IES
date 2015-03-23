<?php
App::uses('AppController', 'Controller');
/**
 * Configs Controller
 *
 * @property Config $Config
 */
class ConfigsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Config->recursive = 0;
		$this->set('configs', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Config->exists($id)) {
			throw new NotFoundException(__('Configuração inválida'));
		}
		$options = array('conditions' => array('Config.' . $this->Config->primaryKey => $id));
		$this->set('config', $this->Config->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Config->create();
			if ($this->Config->save($this->request->data)) {
				$this->Session->setFlash(__('The config has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The config could not be saved. Please, try again.'));
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
		if (!$this->Config->exists($id)) {
			throw new NotFoundException(__('Configuração inválida'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Config->save($this->request->data)) {
				$this->Session->setFlash(__('Configuração alterada com sucesso'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Configuração não foi alterada. Por favor, tente novamente'));
			}
		} else {
			$options = array('conditions' => array('Config.' . $this->Config->primaryKey => $id));
			$this->request->data = $this->Config->find('first', $options);
		}
	}

    public function getTotalTime()
    {
        $this->autoRender = false;
        $start=  new DateTime($this->request->data['start']);
        $end = new DateTime($this->request->data['end']);
        $result = $start->diff($end)->format("%H:%i");
        //var_dump($result);
        $limit = $this->Config->find('first', array('fields' => array('total_time')));
        //var_dump($limit);
        if (strtotime($result) > strtotime($limit['Config']['total_time']))
            echo json_encode(date('H\hi', strtotime($limit['Config']['total_time'])));
    }


    public function getMinMaxDate()
    {
        $this->autoRender = false;

        $config = $this->Config->find('first', array('fields' => array('check_in', 'total_days')));

        $maxDays = $config['Config']['total_days'];
        $minHours = $config['Config']['check_in'];

        $now = new DateTime();
        $checkin = new DateTime(date('Y-m-d') . ' ' . $minHours);

        $minDate = array('year' => $now->format('Y'),
                         'month' => $now->format('n'),
                         'day' => $now->format('d'),
        );

        if (strtotime($now->format('Y-m-d H:i:s')) > strtotime($checkin->format('Y-m-d H:i:s'))) {

            $now->add(new DateInterval('P01D'));

            $minDate = array('year' => $now->format('Y'),
                            'month' => $now->format('n'),
                            'day' => $now->format('d'),
            );
        }

        $now = new DateTime();
        $now->add(new DateInterval('P' . $maxDays . 'D'));

        $maxDate =  array('year' => $now->format('Y'),
                            'month' => $now->format('n'),
                            'day' => $now->format('d'),
                        );

        echo json_encode(array('minDate' => $minDate, 'maxDate' => $maxDate));
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	/*public function delete($id = null) {
		$this->Config->id = $id;
		if (!$this->Config->exists()) {
			throw new NotFoundException(__('Configuração inválida'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Config->delete()) {
			$this->Session->setFlash(__('Config deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Config was not deleted'));
		$this->redirect(array('action' => 'index'));
	}*/
}
