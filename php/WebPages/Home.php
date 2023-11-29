<?php include "Navigation_Bar.php" ?>
<html>
<head>
    <!--Links Home_Page.html to CSS File-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/homestyle.css">
    <link rel="stylesheet" href="/PeaceOfHeavenWebPage/css/homestyle_Mobile.css">

    <title>Peace of Heaven</title>
</head>
<body>
    <!--Headers for the Home Page-->
    <div class ="Header-container">
         <h1 class="header">Peace of Heaven Pet Care, LLC</h1>
    </div>
    <h2 class="subheader1">Peace, Love, and Pawprints</h2>

    <!--Paragrah One includes description and mission statements--> 
    <div class="intro-paragraph">
        <p>Whether you are looking for a place for your dog to play all day or stay while your away, Peace of Heaven Pet Care promises a commitment to peace & love for all.  Peace of mind for you and a peaceful, calm environment full of love for your canine family members.
        <ul> 
            <li>POH Day Care provides individualized play through either one on one with our team members or social play with other furry clients…or both!</li>
            <li>POH Boarding provides private, climate-controlled, sound reducing kennels with outdoor fenced areas and individualized daily exercise & play.</li>
        </ul>
        Our goal is to provide a safe and relaxing space to meet the needs of dogs of all kinds from super social to more reserved & shy. We have created a one-of-a-kind dog care facility and can’t wait to share it with you!
        <br>
        <br>We will love your pets so much they are sure to leave pawprints on our hearts!
        <br>
        </p>
    </div>

    <section class="announcement-section">
        <h2>Create an Account and Reserve with us Today!</h2>
        <p>Offering Services for Daycare, Boarding and Grooming</p><br>
        <a  class="cta-button" href="/PeaceOfHeavenWebPage/php/UserHandling/login.php">Reserve Now</a>
    </section><br><br>

    <!--Boarding Box with Link to Service Page-->
    <section class="box-sections">
        <div class="service-box">
            <img src="/PeaceOfHeavenWebPage/Img/Paw-print.jpg" alt="Image" class="paw-print-img">
            <p>Overnight Dog Watching</p>
            <a class="button" href="/PeaceOfHeavenWebPage/php/WebPagesBoarding.php">Boarding</a>
        </div>

        <!-- Day Care Box with Link to Service Page-->
        <div class="service-box">
            <img src="/PeaceOfHeavenWebPage/Img/Paw-print.jpg" alt="Image" class="paw-print-img">
            <p>Monday-Friday Dog Watching </p>
            <a class="button" href="/PeaceOfHeavenWebPage/php/WebPages/Day_Care.php">Day Care</a>
        </div>

        <!--Grooming Box with Link to Service Page-->
        <div class="service-box">
    <img src="/PeaceOfHeavenWebPage/Img/Paw-print.jpg" alt="Image" class="paw-print-img">
            <p>Grooming Services with Cleaning</p>
            <a class="button" href="/PeaceOfHeavenWebPage/php/WebPages/Grooming.php">Grooming</a>
        </div>
    </section>

    <!--Image and Description of the Kennel Concept Section of the Page-->
    <div class="Kennel-container">
        <img src="/PeaceOfHeavenWebPage/Img/Kennel_Image.jpg" alt="Kennel" class="Kennel-image">
        <div class="Kennel-description">
            <h2>Our Kennel Concept</h2>
            <p>At Peace of Heaven, we promote peace by keeping our numbers small, our spaces large, and our dedication strong. We understand the hesitancy of leaving your pets in unfamiliar surroundings with unfamiliar faces (& tails!) and disrupted routines. We recognize these challenges and strive to overcome them. Our kennels are each their own individual tiny building, we have multiple areas for play & exercise, and a lower max capacity allows us to individualize care & keep up normal routines. We offer superior services & care in a serene atmosphere.</p>
            <a href="/PeaceOfHeavenWebPage/php/WebPages/About_Us.php" class="Kennel-button">Our Facilities</a>
        </div>
    </div>

    <!--Formats Space in the Web design-->
    <p><br></p>

    <!--Image and Description of the Our Reason Section of the Page-->
    <div class="Our-Reason-container">
        <!--Description & Link Section-->
        <div class="Our-Reason-description">
            <h2 class="Reason-Header">Our Reason</h2>
            <p>Meet Beau & Bronx, two awesome German Shepherd Dogs and the reasons behind building Peace of Heaven. Beau was rescued as a small puppy and the story of his first few months of life is unknown. He is loyal, obedient, & full of love but also sensitive and easily stressed. Bronx, on the other hand, is independent, outgoing, stubborn, & sweet all at the same time! Each dog has a unique personality and unique needs. Finding somewhere (or someone) to leave them while we went away was a struggle.</p>
            <a href="/PeaceOfHeavenWebPage/php/WebPages/About_Us.php" class="Our-Reason-button">Our Story</a>
        </div>

        <!--Image Section--> 
    <div class="Our-Reason-image-container">
        <div class="Our-Reason-image">
            <img src="/PeaceOfHeavenWebPage/Img/Dogs-In-Field.jpg" alt="Dogs-In-Field">
        </div>
        <div class="Our-Reason-image">
            <img src="/PeaceOfHeavenWebPage/Img/Dogs-In-Snow.jpg" alt="Dogs-In-Snow">
        </div>
        <div class="Our-Reason-image">
            <img src="/PeaceOfHeavenWebPage/Img/Sunflower-Dog.jpg" alt="Sunflower-Dog">
        </div>
        <div class="Our-Reason-image">
            <img src="/PeaceOfHeavenWebPage/Img/Dogs-in-Snow2.jpg" alt="Dogs-in-Snow2">
        </div>
    </div>
</div>

    <!--Location Container with Link to directions-->
    <div class="Location-container">
        <h1>Located at 30614 E. 200 North Rd. Le Roy, IL 61752</h1>
        <a href="https://www.google.com/maps/place/30614+E+200+North+Rd,+Le+Roy,+IL+61752/@40.4818192,-88.8353999,9z/data=!4m6!3m5!1s0x880c9888abf5cd97:0xc2f74d5073502376!8m2!3d40.311845!4d-88.676935!16s%2Fg%2F11cs94rygn?entry=ttu" >
        <button class="Location-button">Click for Directions</button>
    </div>
        
</html>
<?php include "Footer.php" ?>