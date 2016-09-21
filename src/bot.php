<?php
	class Bot {
		protected $key = null;
		protected $session = null;
		private $salt = 'some very-very long string without any non-latin characters due to different string representations inside of variable programming languages';

		/**
		* @param $key - The session key of the row address.
		*/
		public function __construct($key) {
			$this->key = $key;
		}

		/**
		* The function of creating the session.
		* @param $session - Session ID.
		* @return string - The ID of the current session.
		*/
		public function session($session = null) {
			if ($session === null) {
				$response = file_get_contents('http://iii.ru/api/2.0/json/Chat.init/'.$this->key.'/');
				$this->session = $this->decode($response)->result->cuid;
			} else {
				$this->session = $session;
			}
			// We issue results
			return $this->session;
		}

		/**
		* Function send a message to the bot.
		* @param $message - Message text.
		* @return string - Returns a response from a bot.
		*/
		public function say($message) {
			$request = '["'.$this->session.'","'.$message.'"]';
			$myCurl = curl_init();
			curl_setopt_array($myCurl, array(
				CURLOPT_URL => 'http://iii.ru/api/2.0/json/Chat.request',
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => $this->encode($request)
			));
			$response = curl_exec($myCurl);
			curl_close($myCurl);
			// We issue results
			return $this->decode($response)->result->text->tts;
		}

		/**
		* Encode message before sending it.
		* @param $message - The response from the bot.
		* @return string - A coded message.
		*/
		private function encode($message) {
			$message = base64_encode($message);
			$ml = strlen($message);
			$kl = strlen($this->salt);
			for ($i = 0; $i < $ml; $i++) {
				$encoded = $encoded . ($message[$i] ^ $this->salt[$i % $kl]);
			}
			// We issue results
			return base64_encode($encoded);
		}

		/**
		* The function of decoding the received message.
		* @param $message - The response from the bot.
		* @return mixed|null
		*/
		private function decode($message) {
			$msg = base64_decode($message);
			$ml = strlen($msg);
			$kl = strlen($this->salt);
			for ($i = 0; $i < $ml; $i++) {
				$decoded.= ($msg[$i] ^ $this->salt[$i % $kl]);
			}
			// We issue results
			return json_decode(base64_decode($decoded));
		}
	}
