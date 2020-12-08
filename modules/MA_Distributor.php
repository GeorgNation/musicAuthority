<?php

class MA_Distributor
{
	public $sender; # Отправитель
	public $recipient; # Получатель
	public $resources; # Ресурсы
	public $album; # Альбом
	
	protected $generator = "MusicAuthority"; # Генератор сообщения
	
	public $messageType; # Тип сообщения. OriginalMessage - оригинальное сообщение (только загрузка), EditMessage - изменение сообщения (изменение и удаление)
	
	public function generateMessage ($messageId)
	{
		if ($this->sender instanceof Sender_Recipient)
		{
			if ($this->recipient instanceof Sender_Recipient)
			{
				if ($this->messageType == "OriginalMessage" or $this->messageType == "EditMessage")
				{
					$message = json_encode (array (
						"messageId" => $messageId,
						"sender" => $this->sender,
						"recipient" => $this->recipient,
						"generator" => $this->generator,
						"timestamp" => date ("Y-m-d H:i:s"),
						"messageType" => $this->messageType,
						"resourceList" => $this->resources,
						"releaseList" => $this->album
					), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
					
					return $message;
				}
				else
				{
					throw new Exception ("Только два типа сообщений может быть доставлено.");
				}
			}
			else
			{
				throw new Exception ("Получатель должен реализоваться через класс Sender_Recipient");
			}
		}
		else
		{
			throw new Exception ("Отправитель должен реализоваться через класс Sender_Recipient");
		}
	}
}