<?php session_start(); /* Starts the session */

if (!isset($_SESSION['UserData']['Username'])) {
    header("location:login.php");
    exit;
}
?>

<?php
include "folder.php";
folder();
?>



<!--Save and get data-->
<?php
$url = 'edit.php';

$file = 'text/titolo.html';
$file2 = 'text/corpo.html';
$file3 = 'text/immagine.txt';
$file4 = 'text/titolo_pagina.txt';
$file5 = 'text/custom.css';

// check if form has been submitted
if (isset($_POST['titolo'])) {
    // save the text contents
    file_put_contents($file, $_POST['titolo']);
}

if (isset($_POST['corpo'])) {
    // save the text contents
    file_put_contents($file2, $_POST['corpo']);
}

if (isset($_POST['immagine'])) {
    // save the text contents
    file_put_contents($file3, $_POST['immagine']);
}

if (isset($_POST['titolo_pagina'])) {
    // save the text contents
    file_put_contents($file4, $_POST['titolo_pagina']);
}

if (isset($_POST['custom'])) {
    // save the text contents
    file_put_contents($file5, $_POST['custom']);
}

// read the textfile
$text = file_get_contents($file);
$text2 = file_get_contents($file2);
$text3 = file_get_contents($file3);
$text4 = file_get_contents($file4);
$text5 = file_get_contents($file5);
?>

<!--Html page-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Modifica profilo</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>

<body style="padding: 10px; padding-bottom: 30px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12" style="text-align: center;">
                <img style="border-radius: 50px;margin: 20px;">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xl-8 offset-xl-2">


                <h1 style="text-align: center;"><a style="text-decoration: none;
   color: #212529;" href="index.php">Your page 😎</a></h1>


                <form name="form" action="" method="POST">
                    <h1 style="font-size:16px; font-weight:500;">Tab title</h1>
                    <input name="titolo_pagina" class="form-control" type="text" value="<?php echo htmlspecialchars($text4); ?>" style="width: 100%; margin-bottom:10px;">
                    <h1 style="font-size:16px; font-weight:500;">Profile picture</h1>
                    <input name="immagine" class="form-control" type="text" value="<?php echo htmlspecialchars($text3); ?>" style="width: 100%; margin-bottom:10px;">
                    <h1 style="font-size:16px; font-weight:500;">Page title</h1>
                    <input name="titolo" class="form-control" type="text" value="<?php echo htmlspecialchars($text); ?>" style="width: 100%; margin-bottom:10px;">
                    <h1 style="font-size:16px; font-weight:500;">Body text</h1>
                    <textarea id="mytextarea" rows="12" name="corpo" class="form-control" style="width: 100%;"><?php echo htmlspecialchars($text2); ?></textarea>
                    </br>
                    <h1 style="font-size:16px; font-weight:500;">Custom CSS</h1>
                    <textarea rows="8" name="custom" class="form-control" style="width: 100%;"><?php echo htmlspecialchars($text5); ?></textarea>
                    <input class="btn btn-dark" type="submit" value="Save page" style="margin-top:10px; border-radius:0px;" />
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <a href="index.php" class="float-edit">
            <i class="fa fa-eye my-float"></i>
        </a>
        <a href="logout.php" class="float-exit">
            <i class="fa fa-sign-out my-float"></i>
        </a>
        <a href="" onclick="downloadPage()" class="float-download">
            <i class="fa fa-download my-float"></i>
        </a>
    </div>
    <!--Import script-->
    <script src="js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea', //Set this id
            plugins: 'fullscreen codeeditor emoticons image anchor visualblocks importcss link wordcount table textcolor', //Add my plugins
            paste_data_images: true,
            promotion: false, //Hide logo
            branding: false, //Hide name
            language: 'it', //Item lang
            height: 800, //Default height
            content_css: "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css,text/custom.css", //Import css inside his area to render bootstrap element
            toolbar: ["undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | codeeditor | fullscreen | anchor"],
            codeeditor_themes_pack: "twilight merbivore dawn kuroir",
            codeeditor_wrap_mode: true,
            codeeditor_font_size: 14,
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="js/tinymce.min.js"></script>

    <!--Credits - Thank you if you choose to leave them here! :) -->
    <p style="text-align: center; font-size:10px; color:#757575; margin-top:30px;"> Thank you for using mypage ❤️</p>

</body>

</html>

<script>
    function downloadPage() {
        // Create a link with the download attribute and the file name
        var link = document.createElement('a');
        link.download = 'index.html';

        // Make an HTTP GET request to get the HTML code of the index.php page
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Create a temporary element to manipulate the HTML code
                var temp = document.createElement('div');
                temp.innerHTML = this.responseText;

                // Remove elements with specific classes
                var classesToRemove = ['float-edit', 'float-exit', 'float-download', 'btn_download'];
                classesToRemove.forEach(function(className) {
                    var elements = temp.getElementsByClassName(className);
                    for (var i = elements.length - 1; i >= 0; i--) {
                        elements[i].parentNode.removeChild(elements[i]);
                    }
                });

                // Get the modified HTML code
                var newhtml = temp.innerHTML;

                // Encode the HTML code in base64
                var base64 = btoa(unescape(encodeURIComponent(newhtml)));

                // Set the link's href attribute with the data: prefix and the base64 code
                link.href = 'data:text/html;base64,' + base64;

                // Add the link to the document
                document.body.appendChild(link);

                // Simulate a click on the link to download the file
                link.click();

                // Remove the link from the document
                document.body.removeChild(link);
            }
        };
        xhr.open('GET', 'index.php', true);
        xhr.send();
    }
</script>