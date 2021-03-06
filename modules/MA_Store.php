<?php

class MA_Store
{
	public function work ()
	{
		
		if (!file_exists (THREAD_FILE))
		{
			file_put_contents (THREAD_FILE, serialize (array ()));
		}
		
		$threads = unserialize (file_get_contents (THREAD_FILE));
		
		$registry = new MA_Registry;
		
		foreach ($registry->localRegistry as $records)
		{
		
			$files = glob (WORK_DIR . "{$records}/*.msg", GLOB_NOSORT);
			foreach ($files as $message)
			{
				$messageContent = json_decode (file_get_contents ($message));
				
				print_r ($messageContent->recipient->id);
				
				if ($messageContent->recipient->id == RECIPIENT_ID && $messageContent->recipient->name == RECIPIENT_NAME)
				{
					$threads[$messageContent->messageId] = $messageContent;
				}
				
				unlink ($message);
			}
		
		}
		
		file_put_contents (THREAD_FILE, serialize ($threads));
		
	}
	
	public function run ($uploadCallback, $editCallback, $takedownCallback)
	{
		$threads = unserialize (file_get_contents (THREAD_FILE));
		foreach ($threads as $thread)
		{
			if ($thread->messageType == "OriginalMessage" && $thread->releaseList->takeDown == false)
			{
				$uploadCallback ($thread);
			}
			if ($thread->messageType == "EditMessage" && $thread->releaseList->takeDown == false)
			{
				$editCallback ($thread);
			}
			if ($thread->messageType == "EditMessage" && $thread->releaseList->takeDown == true)
			{
				$mid = $thread->messageId;
				$takedownCallback ($thread);
				unset ($threads[$mid]);
			}
		}
		
		file_put_contents (THREAD_FILE, serialize ($threads));
	}
}
