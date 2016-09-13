<?php
	class Bot {
		protected $key = null;
		protected $session = null;
		private $salt = 'some very-very long string without any non-latin characters due to different string representations inside of variable programming languages';

		/**
		* @param $key - Ключ из урла после создания инфа
		*/
		public function __construct($key) {
			$this->key = $key;
		}

		/**
		* @param null $session - Идентификатор сессии существующей, если нет то создается новая
		* @return string Идентификатор текущей сессии
		*/
		public function session($session = null) {
			if ($session === null) {
				$response = file_get_contents('http://iii.ru/api/2.0/json/Chat.init/'.$this->key.'/');
				$this->session = $this->decode($response)->result->cuid;
			} else {
				$this->session = $session;
			}

			return $this->session;
		}

		/**
		* ОТправить сообщение боту
		* @param string $message Сообщение
		* @return string Ответ
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

			return $this->decode($response)->result->text->tts;
		}

		/**
		* Кодирование сообщения
		* @param $message
		* @return string
		*/
		private function encode($message) {
			$message = base64_encode($message);
			$ml = strlen($message);
			$kl = strlen($this->salt);
			$encoded = "";
			for ($i = 0; $i < $ml; $i++) {
				$encoded = $encoded . ($message[$i] ^ $this->salt[$i % $kl]);
			}

			return base64_encode($encoded);
		}

		/**
		* Декодирование сообщения
		* @param $message
		* @return mixed|null
		*/
		private function decode($message) {
			$msg = base64_decode($message);
			$ml = strlen($msg);
			$kl = strlen($this->salt);
			$decoded = "";
			for ($i = 0; $i < $ml; $i++) {
				$decoded.= ($msg[$i] ^ $this->salt[$i % $kl]);
			}

			return json_decode(base64_decode($decoded));
		}
	}
