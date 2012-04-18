<?php
include 'module.php';
?>
<html>
    <body>
            <form method="POST">
                <fieldset style="border: outset 4px">
                    <label for="pseudo">Pseudo: </label><input type="text" id="pseudo" name="pseudo" maxlength="30" value="<?php  echo $_SESSION['pseudo']; ?>" /><br />
                    <label id="lblMsg" for="msg">Message</label><br />
                    <textarea id="msg" name="msg" rows="10" cols="50" onkeyup="document.getElementById('lblMsg').firstChild.nodeValue = 'Message '+ this.value.length +'/400';"></textarea><br />
                    <input type="submit" name="msgSend" value="Envoyer" style="border: outset 4px" />
<?php
$bdd = new myBdd();
$bdd->connect();

$date = null;
if($_POST['msgSend'])
{
	$pseudo = $_POST['pseudo'];
	$msg = $_POST['msg'];
	$_SESSION['pseudo'] = $pseudo;
	
	if (! trim($pseudo) || ! trim($msg))
		echo '<h3 style="color: red;">Veuillez remplir tous les  champs !</h3>';
	else
	{
		$date = date('Y-m-d H:i:s');
		mysql_query('INSERT INTO messages (pseudo, msgDate, message) VALUES ("'. $pseudo .'", "'. $date .'", "'. $msg .'")');
	}
}

$result = mysql_query('SELECT * FROM messages ORDER BY msgDate DESC');
$days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
$months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
while($msgs = mysql_fetch_assoc($result))
{
	$date = new DateTime($msgs['msgDate']);
	$dDay = $days[date_format($date, 'N') - 1];
	$dMonth = $months[date_format($date, 'n') - 1];
	$dHour = date_format($date, 'H\hi');
	$sDate =  $dDay .' '. date_format($date, 'd') .' '. $dMonth .' '. date_format($date, 'Y') .' à '. $dHour;
	$msg = preg_replace('/\n/', '<br />', htmlentities($msgs['message']));
	echo '<fieldset><legend style="font-style: italic;"><b>'. $msgs['pseudo'] .'</b> '. $sDate .'</legend>'. $msg .'</fieldset>'. chr(10);
}
?>
                    </fieldset>
                </form>
        </body>
    </html>