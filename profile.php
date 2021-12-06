<?php
    session_start();$em = $_SESSION["em"];
    $conn = new mysqli("localhost", "u265142733_admin", "8JS+@mo$", "u265142733_afaq");
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="Picture/tabIcon.svg">
    <title>حســــابي</title>

    <!-- style links -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--font links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@100;200;400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
</head>

<body>
    <script src="Js.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
    // php line doesn't read js file, need wifi conn,dont chanage his place
    function success() {
        swal("نشكرك", "تم ارسال ملاحظتك بنجاح", "success");
    }
    </script>
    <!------Header------>
    <section class="header">
        <nav class="navBar">
            <a href=""><img src="Picture/logo2.svg"> </a>
            <div class="nav-links">
                <ol>
                    <li><a href="#connect">تواصل معنا</a></li>
                    <li><a href="#us">عنّا</a></li>
                    <li><a href="Main.php">الرئيسية</a></li>
                </ol>
            </div>

        </nav>
        <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1"
                d="M0,192L60,202.7C120,213,240,235,360,229.3C480,224,600,192,720,192C840,192,960,224,1080,213.3C1200,203,1320,149,1380,122.7L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
            </path>
        </svg>
    </section>
    <div id="allPage">
        <div class="profile" id="profile">
            <div class="pInfo">
                <h3>
                    <?php 
                        $usernameQ = "SELECT username from users where email = '".$em."'";
                        $usernameC = mysqli_query($conn, $usernameQ);
                        $usernameR = mysqli_fetch_array($usernameC, MYSQLI_ASSOC);

                        echo'@'.$usernameR["username"];
                    ?>
                </h3>
                <p>
                    <?php 
                        $bioQ = "SELECT bio from users where email = '".$em."'";
                        $bioC = mysqli_query($conn, $bioQ);
                        $bioR = mysqli_fetch_array($bioC, MYSQLI_ASSOC);
                        print ($bioR["bio"]);
                    ?>
                </p>
            </div>
            <div class="infoRec">

                <div class="infoNum" id="tripNum" onclick="showHide('blogs', 'imgs')">
                    <h1 class="Num">
                        <?php 
                        $countQ = "SELECT count(title) from blogs where email = '".$em."'";
                        $countC = mysqli_query($conn, $countQ);
                        $countR = mysqli_fetch_array($countC, MYSQLI_ASSOC);
                        echo $countR["count(title)"];
                    ?>
                    </h1>
                    <h4 class="infoTitle" id="tripT">الرحلات</h4>
                </div>
                <div class="infoNum" id="tripNum" onclick="showHide('imgs', 'blogs')">
                    <h4 class="infoTitle" id="imgT">الصور</h4>
                </div>
                <div class="insertNew">
                    <input class="inserBlog" type="button" value="إضافة تدوينة جديدة"
                        onclick="blurr('insertBlog', 'allPage')">
                </div>
            </div>
            <div class="profileImg"></div>
            <div class="blogs" id="blogs">
                <?php 
                    $blogsQ = 'SELECT * FROM blogs where email = "'.$em.'"';
                    $blogsC = mysqli_query($conn, $blogsQ);

                    $usernameQ = 'SELECT username from users where email = "'.$em.'"';
                    $usernameC = mysqli_query($conn, $usernameQ);  
                    $usernameR = mysqli_fetch_array($usernameC, MYSQLI_ASSOC);

                    while($blogsR = mysqli_fetch_array($blogsC, MYSQLI_ASSOC)) { 
                        $idQ = 'SELECT id from blogs where title = "'.$blogsR["title"].'"';
                        $idC = mysqli_query($conn, $idQ);  
                        $idR = mysqli_fetch_array($idC, MYSQLI_ASSOC);

                        $imgQ = "SELECT img from imgs where id ='".$usernameR["username"]."".$idR["id"]."'";
                        $imgC = mysqli_query($conn, $imgQ);
                        echo '
                        <div class="blog">
                        <details>
                            <summary>
                                <h2 class="blogTitle">'.$blogsR["title"].'</h2>
                            </summary>
                            <p class="blogBody"> <br> '.$blogsR["content"].
                            '<br> <br> <div class = "blogimgs">'
                            ;

                            
                            while($imgR = mysqli_fetch_array($imgC, MYSQLI_ASSOC)){
                                echo '<div style="background-image: url(\'blogsImgs/'.$imgR["img"].'\');"></div>';
                            }
                            echo'
                            </div>
                            </p>
                            
                        </details>
                        </div>';
                    }
                ?>
            </div>
            <div class="imgs" id="imgs">
                <div class="allimgs">
                    <?php 
                        $usernameQ = 'SELECT username from users where email = "'.$em.'"';
                        $usernameC = mysqli_query($conn, $usernameQ);  
                        $usernameR = mysqli_fetch_array($usernameC, MYSQLI_ASSOC);

                        $imgQ = "SELECT img from imgs where id LIKE '".$usernameR["username"]."%'";
                        $imgC = mysqli_query($conn, $imgQ);
                        while($imgR = mysqli_fetch_array($imgC, MYSQLI_ASSOC))
                            echo'<div style="background-image: url(\'blogsImgs/'.$imgR["img"].'\');"></div>';
                    ?>
                </div>
            </div>
        </div>


        <!---------- Footer  ---------------->
        <section class="footer">
            <div class="row2">
                <div id="contact" class="contactSection ">

                    <form action="contact.php" method="post">
                        <h3>للملاحظات والإستفسارات</h3>
                        <?php 
                    if(isset($_SESSION['status'])){            
                       echo' <script>success();</script>';            
                        unset( $_SESSION['status']);
                    }
                     ?>
                        <label for="name">
                            <p>الإسم:</p>
                        </label>
                        <input type="text" id="name" name="name"><br>

                        <label for="email">
                            <p>الإيميل</p>
                        </label>
                        <input type="email" id="email" name="email" placeholder="example@example.com"><br>

                        <label for="subject">
                            <p>اختر الموضوع</p>
                        </label>
                        <select id="subject" name="subject">
                            <option value="NOTE">ملاحظة</option>
                            <option value="PROBLEM">مشكلة</option>
                            <option value="OTHER">آخر</option>
                        </select>
                        <label for="content">
                            <p>المحتوى</p>
                        </label>
                        <textarea class="content" name="content" rows="3" cols="32" placeholder="هنا"></textarea><br>

                        <input type="submit" name="submit" value="إرسال">
                    </form>
                </div>
                <div id="us" class="footer-content">
                    <h3>أفــــــــاق</h3>
                    <p>صفحة عربية تساعدك على إكستشاف الوطن العربي
                        وتحديد وجهتك القادمة ومشاركة رحلاتك السابقة</p>

                    <ul class="socials">
                        <p>تابعنا على</p>
                        <li><a href="https://twitter.com/sauditourism"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="Mailto:affaqhelpcenter@gmail.com"><i class="fa fa-google-plus"></i></a>
                        </li>
                        <li><a href="https://www.youtube.com/channel/UCWR3kKXx2yi7Jnr85GqxVdA/featured"><i
                                    class="fa fa-youtube"></i></a></li>
                    </ul>
                    <div class="Download">
                        <p>حمل التطبيق </p>
                        <a href="#" onclick="info(); return false;"><img src="Picture/App-store-desktop.png"></a>
                        <a href="#" onclick="info(); return false;"><img src="Picture/google-play-blanco-desktop.png"></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>copyright &copy;2021 .Affaq designed by <span>Anhar Shatha Shaden Dai Daniah </span></p>
            </div>
        </section>
    </div>

    <div class="insertBlog" id="insertBlog">
        <form class="newBlog" method="post" action="profile.php" enctype="multipart/form-data">
            <label for="blogTitle">عنوان المدونة</label>
            <input type="text" id="blogTitle" required name="bt"> <br>

            <input type="text" placeholder="وصف التدوينة" required id="blogDes" name="bdes"> <br><br>
            <textarea placeholder="اكتب تدوينتك هنا" required name="bc"></textarea>

            <button class="bt1" for="header"><label for="header" >تعيين ترويسة </label></button>
            <input type="file" visibility: hidden  name="bheader" id="header"> 

            <button class="bt2" for="imgs" ><label for="imgsin" >إرفاق صور</label></button>
            <input type="file" name="bimg[]" visibility: hidden id="imgsin" multiple><br><br>

            <h1><a href="#" onclick="hideBlog(insertBlog, allPage);" class="bi bi-x" id="blogx"></a></h1>
            <input type="submit" value="نشـــر" class="blogSubmit" name="share"> <input type="reset" value="مســح"
                class="blogReset">
        </form>
    </div>



    <?php
        if(isset($_POST['share'])) {
            $fileNameh = basename($_FILES['bheader']['name']); 
            $tempnameh = $_FILES["bheader"]["tmp_name"];    
            $folderh = "blogsImgs/headerImgs/".$fileNameh;
            move_uploaded_file($tempnameh, $folderh);

            $bt = $_POST['bt']; $bc = $_POST['bc']; $bd = $_POST['bdes'];
            $insertQ = 'INSERT into blogs (email, title, content, descr, header) values ("'.$em.'", "'.$bt.'", "'.$bc.'", "'.$bd.'", "'.$fileNameh.'")';
            $insertC = mysqli_query($conn, $insertQ);  
            if($insertC) {
                $idQ = 'SELECT id from blogs where title = "'.$bt.'"';
                $idC = mysqli_query($conn, $idQ);  
                $idR = mysqli_fetch_array($idC, MYSQLI_ASSOC);

                $usernameQ = 'SELECT username from users where email = "'.$em.'"';
                $usernameC = mysqli_query($conn, $usernameQ);  
                $usernameR = mysqli_fetch_array($usernameC, MYSQLI_ASSOC);
                
                foreach($_FILES['bimg']['name'] as $key=>$val){ 
                    $fileName = basename($_FILES['bimg']['name'][$key]); 
                    $tempname = $_FILES["bimg"]["tmp_name"];    
                    $folder = "blogsImgs/".$fileName;

                    if(move_uploaded_file($_FILES["bimg"]["tmp_name"][$key], $folder)) {
                        $insertQ = 'INSERT into imgs (id, img) values ("'.$usernameR["username"].''.$idR["id"].'", "'.$fileName.'")';
                        $insertC = mysqli_query($conn, $insertQ);  
                    }
                }
            } 
        }
    ?>
</body>
</html>