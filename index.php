<?php session_start();

if (isset($_SESSION['UserData']['Username'])) {
    echo '<a href="edit.php" class="float-edit">';
    echo '<i class="fa fa-pencil my-float"></i>';
    echo '</a>';
    echo '<a href="logout.php" class="float-exit">';
    echo '<i class="fa fa-sign-out my-float"></i>';
    echo '</a>';
    echo '<a href="" onclick="downloadPage()" class="float-download">';
    echo '<i class="fa fa-download my-float"></i>';
    echo '</a>';
} else {
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!--Browser tab title-->
    <title>
        <?php
        $version = (file_exists("text/titolo_pagina.txt")) ? file_get_contents("text/titolo_pagina.txt") : "Insert tab title";
        echo $version;
        ?>
    </title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="text/custom.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body style="padding: 0px;">

    <div class="container-fluid" style="--bs-gutter-x:0px;">
        <!-- <div class="container">
            <div class="row">
                <div class="col-xl-10 offset-xl-1">-->
        <!--Hide profile image-->
        <?php
        $filename = 'text/immagine.txt';
        $file_content = file_get_contents($filename);
        if (empty($file_content)) {
        } else {
            //Hide profile image
            echo '<div style="text-align: center;">';
            echo '<a href="index.php"><img src="';
            $version = (file_exists("text/immagine.txt")) ? file_get_contents("text/immagine.txt") : "Insert url";
            echo $version;
            echo '" style="max-width:150px; border-radius: 50px;margin: 20px;"></a>';
            echo '</div>';
        }
        ?>
        <!--Page top title-->
        <?php
        $filename = 'text/titolo.html';
        $file_content = file_get_contents($filename);
        if (empty($file_content)) {
        } else {
            // Page top title
            $version = (file_exists("text/titolo.html")) ? file_get_contents("text/titolo.html") : "Insert page title";
            echo '<h1 style="text-align: center;">' . $version . '</h1>';
        }
        ?>

        <!--Body content-->
        <?php
        $version = (file_exists("text/corpo.html")) ? file_get_contents("text/corpo.html") : "Insert body text";
        echo '<p>' . $version . '</p>';
        ?>
    </div>

    <!--Credits - Thank you if you choose to leave them here! :) -->
    <p style="text-align: center; font-size:10px; color:#757575; margin-top:30px;"> Thank you for using mypage ❤️</p>
</body>

</html>

<script>
    function downloadPage() {
        // Create a link with download attribute and file name
        var link = document.createElement('a');
        link.download = 'page.html';

        // Get the HTML code of the current page
        var html = document.documentElement.outerHTML;

        // Create a temporary element to manipulate the HTML code
        var temp = document.createElement('div');
        temp.innerHTML = html;

        // Get all elements with class "float-edit"
        var floatedits = temp.getElementsByClassName('float-edit');

        // Remove all elements with class "float-edit"
        for (var i = floatedits.length - 1; i >= 0; i--) {
            floatedits[i].parentNode.removeChild(floatedits[i]);
        }

        // Get all elements with class "float-exit"
        var floatexits = temp.getElementsByClassName('float-exit');

        // Remove all elements with class "float-exit"
        for (var i = floatexits.length - 1; i >= 0; i--) {
            floatexits[i].parentNode.removeChild(floatexits[i]);
        }

        // Get all elements with class "float-download"
        var floatdownload = temp.getElementsByClassName('float-download');

        // Remove all elements with class "float-download"
        for (var i = floatdownload.length - 1; i >= 0; i--) {
            floatdownload[i].parentNode.removeChild(floatdownload[i]);
        }

        // Get all elements with class "btn_download"
        var btn_downloads = temp.getElementsByClassName('btn_download');

        // Remove all elements with class "btn_download"
        for (var i = btn_downloads.length - 1; i >= 0; i--) {
            btn_downloads[i].parentNode.removeChild(btn_downloads[i]);
        }

        // Get the modified HTML code
        var newhtml = temp.innerHTML;

        // Encode the HTML code in base64
        var base64 = btoa(unescape(encodeURIComponent(newhtml)));

        // Set the link's href with the prefix data: and the base64 code
        link.href = 'data:text/html;base64,' + base64;

        // Add the link to the document
        document.body.appendChild(link);

        // Simulate a click on the link to download the file
        link.click();

        // Remove link from the document
        document.body.removeChild(link);
    }
</script>