<?php
class ControllerModuleConstants extends Controller{

	private $error = array();

	public function __construct($registry)
	{
		parent::__construct($registry);

		$this->load->language('module/constants');
		$this->load->model('constants');

		$this->document->setTitle($this->language->get('heading_title'));
		$this->data['heading_title'] = $this->language->get('heading_title');
	
				
		$this->data['breadcrumbs'] = array();

 		$this->data['breadcrumbs'][] = array(
     		'text'      => $this->language->get('text_home'),
				'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
    		'separator' => false
 		);

 		$this->data['breadcrumbs'][] = array(
     		'text'      => $this->language->get('text_module'),
				'href'   => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
    		'separator' => ' :: '
 		);
	
 		$this->data['breadcrumbs'][] = array(
     		'text'      => $this->language->get('heading_title'),
				'href'      => $this->url->link('module/constants', 'token=' . $this->session->data['token'], 'SSL'),
    		'separator' => ' :: '
 		);
		
				
	}

	public function index() {   

		$this->data['items'] = $this->model_constants->getAll();
			
		$this->template = 'module/constants/index.tpl';
		$this->children = array(
			'common/header',
			'common/footer'
		);
				
		$this->response->setOutput($this->render());
	}

	public function add()
	{
		if($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateAdd()){
			$this->model_constants->addItem($this->request->post);
			$this->redirect($this->url->link('module/constants','token='.$this->session->data['token'],'SSL'));
		}

		$this->set_form_data('title');
		$this->set_form_data('alias');
		$this->set_form_data('value');

		$this->data['action'] = $this->url->link('module/constants/add', 'token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('module/constants', 'token=' . $this->session->data['token'], 'SSL');


		$this->template = 'module/constants/form.tpl';
		$this->children = array('common/header','common/footer');
		$this->response->setOutput($this->render());
	}

	public function edit()
	{

		$itemId = $this->request->get['itemId'];
		$item = $this->model_constants->getItem($itemId);

		if($this->request->server['REQUEST_METHOD'] == 'POST' && $this->validateEdit($item)){
			$this->model_constants->editItem($itemId,$this->request->post);
			$this->redirect($this->url->link('module/constants','token='.$this->session->data['token'],'SSL'));
		}		

		if(empty($item)) $this->redirect($this->url->link('module/constants','token='.$this->session->data['token'],'SSL'));


		$this->set_form_data('title',$item);
		$this->set_form_data('alias',$item);
		$this->set_form_data('value',$item);

		$this->data['action'] = $this->url->link('module/constants/edit', 'itemId='.$itemId.'&token=' . $this->session->data['token'], 'SSL');
		$this->data['cancel'] = $this->url->link('module/constants', 'token=' . $this->session->data['token'], 'SSL');

		$this->template = 'module/constants/form.tpl';
		$this->children = array('common/header','common/footer');
		$this->response->setOutput($this->render());
	}

	public function del()
	{

		$itemId = $this->request->get['itemId'];

		if(!empty($itemId)){
			$this->model_constants->delItem($itemId);
		}
		$this->redirect($this->url->link('module/constants','token='.$this->session->data['token'],'SSL'));
	}

	public function install(){
		$this->model_constants->install();
	}

	public function uninstall(){
		$this->model_constants->uninstall();
	}

	/*
	* Хелперы
	*/
	private function set_form_data($field,$item='')
	{
		if(isset($this->request->post[$field])){
			$this->data[$field] = $this->request->post[$field];
		}else if(!empty($item) && isset($item[$field])){
			$this->data[$field] = $item[$field];
		}else{
			$this->data[$field] = '';
		}

		/*
		* Считывание ошибок, если они есть
		*/
		if(isset($this->error[$field])){
			$this->data['error_'.$field] = $this->error[$field];
		}else{
			$this->data['error_'.$field] = '';
		}
	}

	/*
	* Валидация данных
	*/
	private function validate(){

		if(empty($this->request->post['title']) or strlen($this->request->post['title']) > 128){
			$this->error['title'] = $this->language->get('error_title');
		}

		$regex_alias = "/^[A-Za-z0-9_]+$/";
		if(empty($this->request->post['alias']) or !preg_match($regex_alias,$this->request->post['alias']) or strlen($this->request->post['alias']) > 128){
			$this->error['alias'] = $this->language->get('error_alias');
		}

		if(!empty($this->request->post['alias']) && !$this->model_constants->isAliasFree($this->request->post['alias'])){
			if(!empty($this->error['alias'])) $this->error['alias'] = $this->error['alias'].'<br/>'.$this->language->get('error_alias_used');
			else $this->error['alias'] = $this->language->get('error_alias_used');
		}

		if(!empty($this->request->post['value']))
			$this->request->post['value'] = htmlspecialchars_decode($this->request->post['value']);

		if(!empty($this->error))
			return false;
		return true;
	}

	public function validateAdd()
	{
		return $this->validate();
	}

	private function validateEdit($item)
	{
		$this->validate();
		/*
		* пользователь пытается поменять alias на тот-же самый, то удаляем предупреждение если он было, т.к по правилу alias'ы не должы совпадать.
		*/
		if(isset($this->error['alias']) && $this->request->post['alias'] == $item['alias']) unset($this->error['alias']);
		if(!empty($this->error))
			return false;
		return true;
	}
}