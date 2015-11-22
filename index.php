<?php
/**
 * Created by PhpStorm.
 * User: rDx.LoRD
 * Date: 11/18/2015
 * Time: 11:09 PM
 */
if(isset($_POST['submit'])) {
    require("ask.php");
    $ask = new askFm();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $ask_user = $_POST['askuser'];
    $count = $_POST['count'];
    $content = $_POST['content'];
    $ask->login($username, $password);
    for($i=0;$i<$count;$i++) {
        $ask->ask($ask_user, $content);
    }

    if (!$questions = $ask->fetchQuestions())
        echo $ask->lastError . "\n";
    else
        print_r($questions);

    foreach ($questions as $key => $value) {
        echo $ask->checkQuestion($key) ? "Question $key exists\n" : "Question $key doesn't exits\n";
        if ($value['text'] == 'do not answer this question')
            $ask->delete($key);
        else
            $ask->answer($key, 'your default answer');
    }

    echo $ask->checkQuestion('15670201') ? "Question 15670201 exists\n" : "Question 15670201 doesn't exits\n";

    $ask->logout();
}
?>
<html>
<head>
    <title>Ask FM </title>
</head>
<body>
<center>
    <form action="" method="post">
        <label>Username: </label>
        <input type="text" name="username" placeholder="Username">
        <label>Password: </label>
        <input type="password" name="password" placeholder="********">
        <label>Askfm Username to Flood</label>
        <input type="text" name="askuser" placeholder="najafbihari">
        <label>Question to Ask</label>
        <input type="text" name="content" placeholder="Fuck You \m/">
        <label>Count</label>
        <input type="number" maxlength="3" name="count" placeholder="1">
        <input type="submit" name="submit" value="Fuck">
    </form>
</center>
</body>
</html>
