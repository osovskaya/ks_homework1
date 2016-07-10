<?php require_once(__DIR__.'/layouts/header.php');?>

<h2>Enter information about you</h2>

<form action="/form" method="post" enctype="multipart/form-data">
    <label for="name">Name</label>
    <input type="text" name="name"><br>

    <label for="secret">Secret word</label>
    <input type="password" name="secret"><br>

    <label for="gender">Gender</label>
    <input type="radio" name="gender" value="male" checked> Male
    <input type="radio" name="gender" value="female"> Female<br>

    <label for="occupation">What do you do?</label>
    <select name="occupation">
        <option value="I'm a student">student</option>
        <option value="I'm a worker">worker</option>
        <option value="I'm a businesman">busines man</option>
        <option value="I'm a free person">a free person</option>
    </select><br>

    <label for="euro2016">What do you think about final play of Euro-2016?</label>
    <textarea name="euro2016" rows="5" cols="30">We appreciate your opinion.</textarea><br>

    <label for="avatar">Your photo</label>
    <input type="file" name="avatar" accept="image/*"><br>

    <label for="about">Information about yourself</label>
    <input type="file" name="about" accept="file_extension"><br>

    <label for="notRobotr">I am not a robot</label>
    <input type="checkbox" name="notRobot" value="yes"><br>

    <input id="submit" type="submit" value="Submit">

</form>

<?php require_once(__DIR__.'/layouts/footer.php');?>
