<?php $conn = new mysqli("localhost", "u265142733_admin", "8JS+@mo$", "u265142733_afaq"); ?>

<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="Picture/tabIcon.svg">
    <title>مدونة أفـــــاق</title>

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
                    <li><a href="profile.php" target="_blank_">حسابي</a></li> <!--  هنا صفحة شادن-->
                    <li><a href="#contact">تواصل معنا</a></li>
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

    <!-- --------midmenu----- -->
    <section class="midmenush">
        <div class="rowsh">
            <div class="midmenu-colsh">
                <img src="Picture/image3.png" width="150px" height="160px">
                <div class="Layer">
                    <a href="Blog.php">
                        <h4>التـدونات</h4>
                    </a>
                </div>
            </div>
            <div class="midmenu-colsh">
                <img src="Picture/image2.png" width="140px" height="150px">
                <div class="Layer">
                    <a href="photopage.php">
                        <h4>الصــور</h4>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <br> <br> <br>

    <!--------------------الــــتــدويــنــات--------------------------->
    <div class="blogsh">
        <div class="center-columnsh">

            <?php if($conn) {
                $blogsQ = 'SELECT * FROM blogs';
                $blogsC = mysqli_query($conn, $blogsQ);

                while($blogsR = mysqli_fetch_array($blogsC, MYSQLI_ASSOC)) { 
                    $usernameQ = 'SELECT username from users where email = "'.$blogsR["email"].'"';
                    $usernameC = mysqli_query($conn, $usernameQ);  
                    $usernameR = mysqli_fetch_array($usernameC, MYSQLI_ASSOC);

                    $idQ = 'SELECT id from blogs where title = "'.$blogsR["title"].'"';
                    $idC = mysqli_query($conn, $idQ);  
                    $idR = mysqli_fetch_array($idC, MYSQLI_ASSOC);

                    $imgQ = "SELECT img from imgs where id ='".$usernameR["username"]."".$idR["id"]."'";
                    $imgC = mysqli_query($conn, $imgQ);

                    echo '
                        <div> <article class="article" data-city="i'.$idR["id"].'" id="i'.$idR["id"].'">
                        <h2>'.$blogsR["title"].'</h2>
                        <h5>كُتبَ بواسطة: '.$usernameR["username"].'@</h5>
                        <div class="post-header" style="background-image: url(\'blogsImgs/headerImgs/'.$blogsR["header"].'\');"></div>
                        <pre class="desc" style="display: inline;">'.$blogsR["descr"].'</pre>
                        <div class="dots" style="display: inline;">...</div>
                        <div class="more" style="display: none;">'.$blogsR["content"].'<br><br>
                    ';
                    while($imgR = mysqli_fetch_array($imgC, MYSQLI_ASSOC)) 
                        echo '<img src="blogsImgs/'.$imgR["img"].'">';
                    echo ' </div>
                        <button onclick="readMore(\'i'.$idR["id"].'\')" class="myBtn"> أقرأ المزيد </button> 
                        <img class="myImage" onclick="changeHeart(\'i'.$idR["id"].'\')" src="Picture/unlike.png">
                        </article> </div>'
                    ;
                }
            }


                ?>
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
</body>
</html>