<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="C:\Users\hp\Desktop\Studyspace\projecttwo\Assets\CSS\form.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="icon" type="image/x-icon" href="../Images/logo project.png">
</head>
<body >
    <!-- logo code -->
    <center>
        <div class="main">
        </div>
        <video id="logo" autoplay muted loop>
            <source src="C:\Users\hp\Desktop\Studyspace\projecttwo\Assets\Images\WhatsApp Video 2023-05-04 at 9.31.08 PM.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </center>
<!-- Start Home Page -->
    <div  class="fonts flex-home">
        <div  class="col-lg-4 margin-home ">
            <div class="single-blog">
                <div class="image margin-homee">
                    <a href="{{ url('How_it_works') }}" class="d-block">
                        <img width="500" height="500" src="C:\Users\hp\Desktop\Studyspace\projecttwo\Assets\Images\hiw.jpg" alt="How it Works"></noscript>
                    </a>
                </div>
                <div class="homecont">
                    <ul class="meta">
                        <li>
                            <i class="ri-user-line"></i>
                        </li>
                    </ul>
                    <!-- <h2 style="text-decoration: underline; text-align: center;"><a href="C:\Users\hp\Desktop\Studyspace\projecttwo\Assets\HTML\How_it_works.html">How it Works</a></h2> -->
                </div>
            </div>
        </div>
        <div class="col-lg-4 ">
            <div class="single-blog">
            <div  class="image margin-homet">
                <a href="{{ url('Arduino') }}" class="d-block">
                    <img width="500" height="500" src="C:\Users\hp\Desktop\Studyspace\projecttwo\Assets\Images\ardcomp.jpg" alt="Arduino Components"></noscript>
                </a>
            </div>
            <div class="blog-content">
                <ul class="meta">
                    <li>
                        <i class="ri-user-line"></i>
                    </li>
                </ul>
                <!-- <h2 style="text-decoration: underline; text-align: center;"><a href="C:\Users\hp\Desktop\Studyspace\projecttwo\Assets\HTML\Arduino.html">Arduino Components</a></h2> -->
            </div>
        </div>
    </div>
    </div>
    <div  class="flex-home fonts">
        <div class="col-lg-4  margin-flex ">
            <div class="single-blog">
                <div class="image margin-homet">
                    <a href="{{ url('blog') }}" class="d-block">
                        <img width="500" height="500" src="C:\Users\hp\Desktop\Studyspace\projecttwo\Assets\Images\blog.jpg" alt="Blog"></noscript>
                    </a>
                </div>
            <div class="blog-content">
                <ul class="meta">
                    <li>
                        <i class="ri-user-line"></i>
                    </li>
                </ul>
                <!-- <h2 style="text-decoration: underline; text-align: center;"><a href="C:\Users\hp\Desktop\Studyspace\projecttwo\Assets\HTML\blog.html">Blog</a></h2> -->
            </div>
        </div>
    </div>
    <div  class="col-lg-4 ">
        <div class="single-blog">
            <div  class="image">
                <a href="{{ url('aboutus') }}" class="d-block">
                    <img width="500" height="500" src="C:\Users\hp\Desktop\Studyspace\projecttwo\Assets\Images\aboutus.jpg" alt="About Us"></noscript>
                </a>
            </div>
            <div  class="blog-content ">
                <ul class="meta">
                    <li>
                        <i class="ri-user-line"></i>
                    </li>
                </ul>
                <!-- <h2 style="text-decoration: underline; text-align: center;"><a  href="C:\Users\hp\Desktop\Studyspace\projecttwo\Assets\HTML\aboutus.html">About Us</a></h2> -->
            </div>
        </div>
    </div>
</div>
<br><br><br>
<button class="open-button" onclick="openForm()">You can Order an Arduino from here</button>
    <script data-src="C:\Users\hp\Desktop\Studyspace\projecttwo\Assets\javascript\form.js">
    function openForm() {
    document.getElementById("myForm").style.display = "block";
  }

  function closeForm() {
    document.getElementById("myForm").style.display = "none";
  }
    </script>
<!-- The form -->
<div class="form-popup" id="myForm">
  <form method="POST" action="/Order" class="form-container">
    <br>
    @csrf
    <h1 style="color: black; font-size:large; text-align:center;">"Please enter your data and we will contact with you later"</h1>
    <br>
    <label for=" Name"><b>Full Name:</b></label>
    <input type="text" placeholder="Full Name"  name="name" required>

    <label for="Phone Number"><b>Phone Number:</b></label>
    <input type="text" placeholder="Enter your Phone Number"  name="Phone_NO" required>

    <label for="Address"><b>Address:</b></label>
    <input type="text" placeholder="Enter your Address" name="Address" required>
<!--
    <label for="email"><b>Email:</b></label>
    <input type="text" placeholder="Enter your Email" name="email" required> -->

    <button type="submit" class="btn" style="font-size: 18px; font-weight: bold;">Submit</button>
    <button type="button" class="btn cancel" style="font-size: 18px; font-weight: bold;" onclick="closeForm()">Exit</button>
</form>
</div>
<br><br><br><br><br>


    <!--start footer code-->
    <footer  class="footer-area footer-style-two pt-100">
        <div class="container">
            <div class="row justify-content-cente">
                <div class="single-footer-widget col-lg-3 widget_kiedo_contact_info">
                    <h3>SafelyApp</h3>
                    <p>
                        Safely is an Application with accident detection arduino and helping in detecting the accident
                        and easily communicating with the driver's emergency contact to rescue the driver.
                    </p>
                </div>
                <div class="single-footer-widget col-lg-3 widget_nav_menu">
                    <h3>Website links</h3>
                    <div class="menu-useful-links-container">
                        <ul id="menu-useful-links" class="menu">
                            <li id="menu-item-28893"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-28893">
                                <a href="">About Safely</a>
                            </li>
                            <li id="menu-item-21351"
                                class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21351">
                                <a href="">How It Works</a>
                            </li>
                            <li id="menu-item-20643"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20643">
                                <a href="tel:+201153677730">(+20) 1153677730</a>
                            </li>
                            <li id="menu-item-20642"
                                class="menu-item menu-item-type-custom menu-item-object-custom menu-item-20642">
                                <a href="Safely.com">Safely@gmail.com</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="single-footer-widget col-lg-3 widget_kiedo_newsletter">
                    <h3>Feedback</h3>
                    <div class="widget-newsletter">
                        <div class="newsletter-content">
                            <p>Write your Feedback to improve our performance</p>
                        </div>
                        <form class="mailchimp newsletter-form" method="post">
                            <input type="text" class="input-newsletter memail" placeholder="Enter your Feedback"
                                name="Enter your Feedback" required>
                            <button type="submit">
                                Submit
                            </button>
                            <div class="mchimp-errmessage alert alert-danger" style="display: none;"></div>
                            <div class="mchimp-sucmessage alert alert-primary" style="display: none;"></div>
                        </form>
                    </div>
               </div>
            </div>
        </div>
    </footer>
    <script src="../JS/home.js"></script>
</body>
</html>
