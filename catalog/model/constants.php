<?php
class ModelConstants extends Model {

	/*
	* Выбор константы по псевдониму
	*/
	public function getItemByAlias($alias)
	{
		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."constants WHERE alias='".$alias."' LIMIT 1");
		return $result->row;
	}

	/*
	* Выбор константы по id
	*/
	public function getItemById($id)
	{
		$result = $this->db->query("SELECT * FROM ".DB_PREFIX."constants WHERE id='".$id."' LIMIT 1");
		return $result->row;
	}

	/*
	* Выбор значения по алиасу
	*/
	public function getValueByAlias($alias)
	{
		$item = $this->getItemByAlias($alias);
		if(!empty($item['value'])) return $item['value'];
		return '';
	}

	public function getValueById($id)
	{
		$item = $this->getItemById($id);
		if(!empty($item['value'])) return $item['value'];
		return '';
	}
}
?>