<?php include "Navigation_Bar.php" ?>
<html>
<head>
    <!--Links Home_Page.html to CSS File-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/homestyle.css">

    <title>Peace of Heaven</title>
</head>
<body>
    <!--Headers for the Home Page-->
    <h1 class="header">Peace of Heaven Pet Care, LLC</h1>
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

    <!--Boarding Box with Link to Service Page-->
    <div class="service-box">
        <img src="POH-Logo.png" alt="Image">
        <p>Description of Service</p>
        <a class="button" href="Boarding.html">Boarding</a>
    </div>

     <!-- Day Care Box with Link to Service Page-->
    <div class="service-box">
        <img src="POH-Logo.png" alt="Image">
        <p>Description of Service</p>
        <a class="button" href="Day_Care.html">Day Care</a>
    </div>

     <!--Grooming Box with Link to Service Page-->
    <div class="service-box">
        <img src="POH-Logo.png" alt="Image">
        <p>Description of Service</p>
        <a class="button" href="Grooming.html">Grooming</a>
    </div>

    <!--Image and Description of the Kennel Concept Section of the Page-->
    <div class="Kennel-container">
        <img src="/img/Kennel_Image.jpg" alt="Kennel" class="Kennel-image">
        <div class="Kennel-description">
            <h2>Our Kennel Concept</h2>
            <p>At Peace of Heaven, we promote peace by keeping our numbers small, our spaces large, and our dedication strong. We understand the hesitancy of leaving your pets in unfamiliar surroundings with unfamiliar faces (& tails!) and disrupted routines. We recognize these challenges and strive to overcome them. Our kennels are each their own individual tiny building, we have multiple areas for play & exercise, and a lower max capacity allows us to individualize care & keep up normal routines. We offer superior services & care in a serene atmosphere.</p>
            <a href="About_Us.html" class="Kennel-button">Our Facilities</a>
        </div>
    </div>

    <!--Formats Space in the Web design-->
    <p><br></p>

    <!--Image and Description of the Our Reason Section of the Page-->
    <div class="Our-Reason-container">
        <!--Description & Link Section-->
        <div class="Our-Reason-description">
            <h2>Our Reason</h2>
            <p>Text Description</p>
            <a href="About_Us.html" class="Our-Reason-button">Our Story</a>
        </div>

        <!--Image Section--> 
    <div class="Our-Reason-image-container">
        <div class="Our-Reason-image">
            <img src="/img/Dogs-In-Field.jpg" alt="Dogs-In-Field">
        </div>
        <div class="Our-Reason-image">
            <img src="/img/Dogs-In-Snow.jpg" alt="Dogs-In-Snow">
        </div>
        <div class="Our-Reason-image">
            <img src="/img/Sunflower-Dog.jpg" alt="Sunflower-Dog">
        </div>
        <div class="Our-Reason-image">
            <img src="/img/Dogs-in-Snow2.jpg" alt="Dogs-in-Snow2">
        </div>
    </div>
</div>

    <!--Location Container with Link to directions-->
    <div class="Location-container">
        <h1>Located at INSERT LOCATION</h1>
        <button class="Location-button">Click for Directions</button>
    </div>
        
</html>
<?php include "PoHPC Footer.html" ?>