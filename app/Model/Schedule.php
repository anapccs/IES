<?php
App::uses('AppModel', 'Model');
/**
 * Classroom Model
 *
 */
class Schedule extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	/*public $validate = array(
		'name' => array(
            'notempty' => array(
                'rule' => array('notempty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
		),
		'status' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);*/

    public $virtualFields = array(
        'schedules' => 'CONCAT(TIME_FORMAT(start, "%Hh%i"), " - ", TIME_FORMAT(end, "%Hh%i"))'
        //'schedules' => 'TIME_FORMAT(start, "%H")'
    );
}
