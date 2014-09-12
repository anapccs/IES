<?php
App::uses('AppController', 'Controller');
App::uses('AuthComponent', 'Controller/Component');
/**
 * Equipaments Controller
 *
 * @property Equipament $Equipament
 */
class EquipamentsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Equipament->recursive = 0;
		$this->set('equipaments', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Equipament->exists($id)) {
			throw new NotFoundException(__('Equipamento inválido'));
		}
		$options = array('conditions' => array('Equipament.' . $this->Equipament->primaryKey => $id));
		$this->set('equipament', $this->Equipament->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Equipament->create();
			if ($this->Equipament->save($this->request->data)) {
				$this->Session->setFlash(__('Equipamento adicionado com sucesso'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Equipamento não foi adicionado. Por favor, tente novamente.'));
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
		if (!$this->Equipament->exists($id)) {
			throw new NotFoundException(__('Equipamento inválido'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Equipament->save($this->request->data)) {
				$this->Session->setFlash(__('Equipamento editado com sucesso'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('Equipamento não foi editado. Por favor, tente novamente.'));
			}
		} else {
			$options = array('conditions' => array('Equipament.' . $this->Equipament->primaryKey => $id));
			$this->request->data = $this->Equipament->find('first', $options);
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
		$this->Equipament->id = $id;
		if (!$this->Equipament->exists()) {
			throw new NotFoundException(__('Equipamento inválido'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Equipament->delete()) {
			$this->Session->setFlash(__('Equipamento excluído'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Equipamento não foi excluído'));
		$this->redirect(array('action' => 'index'));
	}

    public function get_equipaments()
    {
        $this->autoRender = false;

        $date = str_replace('/', '-', $this->request->data['date']);
        $date = date('Y-m-d', strtotime($date));

        $start = $this->request->data['start'];
        $end = $this->request->data['end'];

        if($this->Auth->user('role_id') != 1){
            $equipaments = $this->Equipament->find('all', array('recursive' => -1, 'group' => array('Equipament.id'),
                                                    'fields' => array('Equipament.*, Booking.start'),
                                                    'joins' => array(
                                                        array(
                                                            'table' => 'bookings',
                                                            'alias' => 'Booking',
                                                            'type' => 'LEFT',
                                                            'conditions' => array('Equipament.id = Booking.equipament_id',
                                                                'date =' => $date,
                                                                'HOUR(start)' => CakeTime::format('H', $start),
                                                                'HOUR(end)' => CakeTime::format('H', $end)
                                                                 )
                                                    ))));
            foreach($equipaments as $k => $v)
                if($v['Booking']['start'] != null)
                    unset($equipaments[$k]);

        }else{
            $equipaments = $this->Equipament->find('all', array('recursive' => -1, 'group' => array('Equipament.id'),
                                                    'fields' => array('Equipament.*'),
                                                    ));
        }
        echo json_encode($equipaments);
    }
}
