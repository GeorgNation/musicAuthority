<?php

class MA_Registry
{
	public $localRegistry;
	public $webRegistry;
	
	public function getSslPage($url) # https://stackoverflow.com/questions/1975461/how-to-get-file-get-contents-to-work-with-https
	{
		$ch = curl_init ();
		curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt ($ch, CURLOPT_HEADER, false);
		curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt ($ch, CURLOPT_URL, $url);
		curl_setopt ($ch, CURLOPT_REFERER, $url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec ($ch);
		curl_close ($ch);
		return $result;
	}
	
	public function __construct ()
	{
		$this->webRegistry = json_decode ($this->getSslPage ("https://raw.githubusercontent.com/GeorgNation/musicAuthorityRegistry/master/registry.json"));
		
		if (!file_exists (REGISTRY_FILE))
		{
			file_put_contents (REGISTRY_FILE, serialize (array ()));
		}
		
		$this->localRegistry = unserialize (file_get_contents (REGISTRY_FILE));
	}
	
	public function add ($id) # Добавить пользователя в реестр
	{
		$this->localRegistry[$id] = $id;
		mkdir (WORK_DIR . "/$id");
		
		file_put_contents (REGISTRY_FILE, serialize ($this->localRegistry));
	}
	
	public function del ($id) # Удалить пользователя из реестра
	{
		unset ($this->localRegistry[$id]);
		rmdir (WORK_DIR . "/$id");
		
		file_put_contents (REGISTRY_FILE, serialize ($this->localRegistry));
	}
	
	public function isHere ($id)
	{
		if (in_array ($id, $this->localRegistry))
		{
			foreach ($this->webRegistry as $record)
			{
				if ($record->id = $id)
					return true;
			}
		}
		else
		{
			return false;
		}
	}
}
