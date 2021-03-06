<?php
	/*
		Copyright (c) 2009 Anant Garg (anantgarg.com | inscripts.com)
		
		This script may be used for non-commercial purposes only. For any
		commercial purposes, please contact the author at 
		anant.garg@inscripts.com
		
		THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
		EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
		OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
		NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
		HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
		WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
		FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
		OTHER DEALINGS IN THE SOFTWARE.

	*/
class CChat extends CI_Model {

	public $lstUsr;

	public $usuario;

	public function __construct() {
	}

	function chatHeartbeat() {
	
		$sql = "SELECT * FROM t_chat WHERE (t_chat.to = '".mysql_real_escape_string($_SESSION['usuario'])."' AND recd = 0) ORDER BY id ASC";
		$query = $this->db->query($sql);
		$items = '';

		$chatBoxes = array();

		foreach ($query->result_array() as $chat){
			if (!isset($_SESSION['openChatBoxes'][$chat['from']]) && isset($_SESSION['chatHistory'][$chat['from']])) {
				$items = $_SESSION['chatHistory'][$chat['from']];
			}

			$chat['message'] = $this->sanitize($chat['message']);

			$items .= <<<EOD
					   {
			"s": "0",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;

			if (!isset($_SESSION['chatHistory'][$chat['from']])) {
				$_SESSION['chatHistory'][$chat['from']] = '';
			}

			$_SESSION['chatHistory'][$chat['from']] .= <<<EOD
						   {
			"s": "0",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;
		
			unset($_SESSION['tsChatBoxes'][$chat['from']]);
			$_SESSION['openChatBoxes'][$chat['from']] = $chat['sent'];
		}

		if (!empty($_SESSION['openChatBoxes'])) {
			foreach ($_SESSION['openChatBoxes'] as $chatbox => $time) {
				if (!isset($_SESSION['tsChatBoxes'][$chatbox])) {
					$now = time()-strtotime($time);
					$time = date('g:iA M dS', strtotime($time));

					$message = "Enviado el $time";
					if ($now > 180) {
						$items .= <<<EOD
{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;

						if (!isset($_SESSION['chatHistory'][$chatbox])) {
							$_SESSION['chatHistory'][$chatbox] = '';
						}

						$_SESSION['chatHistory'][$chatbox] .= <<<EOD
		{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;
						$_SESSION['tsChatBoxes'][$chatbox] = 1;
					}
				}
			}
		}

		$sql = "UPDATE t_chat SET recd = 1 WHERE t_chat.to = '".mysql_real_escape_string($_SESSION['usuario'])."' and recd = 0";
		$query = $this->db->query($sql);
		if ($items != '') {
			$items = substr($items, 0, -1);
		}
//header('Content-type: application/json');
?>
{
"items": [
<?php echo $items; ?>
]
}

<?php
exit(0);
}

function chatBoxSession($chatbox) {

$items = '';

if (isset($_SESSION['chatHistory'][$chatbox])) {
$items = $_SESSION['chatHistory'][$chatbox];
}

return $items;
}

function startChatSession() {
$items = '';
if (!empty($_SESSION['openChatBoxes'])) {
foreach ($_SESSION['openChatBoxes'] as $chatbox => $void) {
$items .= $this->chatBoxSession($chatbox);
}
}

if ($items != '') {
$items = substr($items, 0, -1);
}

/*$arreglo['username'] = $_SESSION['usuario'];
$arreglo['items'] = array($items);
return json_encode($arreglo);*/

//header('Content-type: application/json');
?>
{
"username": "<?php echo $_SESSION['usuario']; ?>",
"items": [
<?php echo $items; ?>
]
}

<?php

exit(0);

}

function sendChat() {
$from = $_SESSION['usuario'];
$to = $_POST['to'];
$message = $_POST['message'];

$_SESSION['openChatBoxes'][$_POST['to']] = date('Y-m-d H:i:s', time());

$messagesan = $this->sanitize($message);

if (!isset($_SESSION['chatHistory'][$_POST['to']])) {
$_SESSION['chatHistory'][$_POST['to']] = '';
}

$_SESSION['chatHistory'][$_POST['to']] .= <<<EOD
{
"s": "1",
"f": "{$to}",
"m": "{$messagesan}"
},
EOD;

unset($_SESSION['tsChatBoxes'][$_POST['to']]);

$sql = "INSERT INTO t_chat (t_chat.from,t_chat.to,message,sent) values ('".mysql_real_escape_string($from)."', '".mysql_real_escape_string($to)."','".mysql_real_escape_string($message)."',NOW())";
$query = $this->db->query($sql);
echo "1";
exit(0);
}

function closeChat() {

unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);

echo "1";
exit(0);
}

function sanitize($text) {
$text = htmlspecialchars($text, ENT_QUOTES);
$text = str_replace("\n\r","\n",$text);
$text = str_replace("\r\n","\n",$text);
$text = str_replace("\n","<br>",$text);
return $text;
}
}
