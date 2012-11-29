<?php
class ModelConstants extends Model {

	/*
	* Добавление новой константы
	*/
	public function addItem($data)
	{
		$this->db->query("INSERT INTO ".DB_PREFIX."constants(title,value,alias)VALUES('".$this->db->escape($data['title'])."','".$this->db->escape($data['value'])."','".$this->db->escape($data['alias'])."')");
	}

	/*
	* Выбор всех констант
	*/
	public function getAll()
	{
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "constants ORDER BY id");
		return $query->rows;
	}

	/*
	* Выбор конкретной константы
	*/
	public function getItem($id)
	{
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "constants WHERE id = ".(int)$id);
		return $query->row;
	}

	/*
	* Редкатирование константы
	*/
	public function editItem($id,$data)
	{
		$this->db->query("UPDATE ". DB_PREFIX ."constants SET alias='".$this->db->escape($data['alias'])."',title='".$this->db->escape($data['title'])."',value='".$this->db->escape($data['value'])."' WHERE id=".(int)$id);
	}

	/*
	* Удаление константы
	*/
	public function delItem($id)
	{
		$this->db->query("DELETE FROM ".DB_PREFIX."constants WHERE id=".(int)$id);
	}

	/*
	* Проверка того, является ли псевдоним свободным
	*/
	public function isAliasFree($alias)
	{
		$query = $this->db->query("SELECT * FROM ".DB_PREFIX."constants WHERE alias='".$alias."' LIMIT 1");
		return empty($query->row);
	}

	/*
	* Создание таблицы `constants`
	*/
	public function install()
	{
		$this->db->query("CREATE TABLE IF NOT EXISTS `".DB_PREFIX."constants` ( `id` int(11) NOT NULL AUTO_INCREMENT, `title` varchar(128) NOT NULL,`alias` varchar(128) NOT NULL,`value` blob NOT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");
	}

	/*
	* Удаление таблицы constants
	*/
	public function uninstall()
	{
		$this->db->query("DROP TABLE ".DB_PREFIX."constants");
	}
}
?>