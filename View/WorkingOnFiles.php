<!DOCTYPE html>
<html>
<body>

<?php

// @TODO Read file function. The readfile() function returns the number of bytes read on success)
//echo readfile("../fopen/file.txt");
//die();

// @TODO creates a new file if file does'nt exist
// $myfile = fopen("../fopen/newfile.txt", "a") or die("Unable to open file!");
// die();

// @TODO The filesize() function returns the number of bytes read on success
//echo filesize("../fopen/file.txt");

// @TODO The first parameter of fread() contains the name of the file to read from and the second parameter specifies the maximum number of bytes to read.
// echo fread($myfile,filesize("../fopen/file.txt"));

// @TODO Read a file
//$myfile = fopen("../fopen/file.txt", "r") or die("Unable to open file!");
//echo fread($myfile,filesize("../fopen/file.txt"))."<br><";
//echo filesize("../fopen/file.txt");
//fclose($myfile);

// @TODO fget() function read a single line form a file
//$myfile = fopen("../fopen/file.txt", "r") or die("Unable to open file!");
//echo fgets($myfile);
//fclose($myfile);

// @TODO The feof() function checks if the "end-of-file" (EOF) has been reached.
// @TODO The feof() function is useful for looping through data of unknown length.
// @TODO The example below reads the "../fopen/file.txt" file line by line, until end-of-file is reached:
//$myfile = fopen("../fopen/file.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
//while(!feof($myfile)) {
//    echo fgets($myfile) . "<br>";
//}
//fclose($myfile);


// @TODO PHP Read Single Character - fgetc()
// @TODO The fgetc() function is used to read a single character from a file.
// @TODO The example below reads the "webdictionary.txt" file character by character, until end-of-file is reached:

$myfile = fopen("../fopen/file.txt", "r") or die("Unable to open file!");
// Output one character until end-of-file
while(!feof($myfile)) {
    echo fgetc($myfile);die();
}
fclose($myfile);


// @TODO fwrite function used to write a text into file
//$myfiles = fopen('testfile.txt','w');
//$array = array("Nazir","Hamza","Taha","Onais","Sadiq","Abdullah","Affan");
//foreach($array as $value){
//    fwrite($myfiles,$value." ");
//}
//echo filesize('testfile.txt');
//fclose($myfiles);

echo readfile('../fopen/newfile.txt');

?>

</body>
</html>