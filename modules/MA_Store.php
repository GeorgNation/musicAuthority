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
		
		$files = glob (WORK_DIR . "*.msg", GLOB_NOSORT);
		foreach ($files as $message)
		{
			$messageContent = json_decode (file_get_contents ($message));
			
			$threads[$messageContent->messageId] = $messageContent;
			
			unlink ($message);
		}
		
		#print_r ($threads);
		#print_r ($messageContent);
		#print_r ($message);
		#print_r ($files);
		
		file_put_contents (THREAD_FILE, serialize ($threads));
		
	}
	
	public function run ($uploadCallback, $editCallback, $takedownCallback)
	{
		$threads = unserialize (file_get_contents (THREAD_FILE));
		$count = -1;
		foreach ($threads as $thread)
		{
			++$count;
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
				$takedownCallback ($thread);
				$threads[$count] = NULL;
			}
		}
		
		file_put_contents (THREAD_FILE, serialize ($threads));
	}
}