
<!DOCTYPE html>
<html>
<head>
    <title><?=ucfirst(App::$page)?>- <?=APPNAME?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/index.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/fontawesome-free-6.4.0-web/css/all.min.css">
</head>
<body style="margin:0px">
<div class="header" id="section1">
    <img src="<?= ROOT ?>/assets/img/logo_name.png" class="logoname">
    <div class="nav">
        <a class="a" href="#section1" >Home</a>
        <a class="a" href="#section2" >Services</a>
        <a class="a" href="#section3" >Contact</a>
        <a class="a" href="#section4" >About</a>
        <a href="http://localhost/FAREFLEX/public/login"  class="login">Log in</a>
        <a href="http://localhost/FAREFLEX/public/signup" class="signup">Sign up </a>
    </div>
</div>
<div class="banner">
    <img src="<?= ROOT ?>/assets/img/2.jpg"  class="bannerimage" >
    <div class="bannerbox">
        <div class="bannerboxtop">
            <div class="Driver" id="icon1">
                <i class="fa-solid fa-signal" ></i>
                <h4>Driver</h4>
            </div>
            <div class="Ride" id="icon2">
                <i class="fa-solid fa-car" ></i>
                <h4>Ride</h4>
            </div>
            <div class="aboutus" id="icon3">
                <i class="fa-solid fa-circle-exclamation" ></i>
                <h4>Feature </h4>
            </div>
        </div>

        <div>
            <div id="driver">
                <h1>
                    Drivers!
                </h1>
                <div>
                    <p>
                        Passionate about urban exploration and adventure? Consider joining us as a city travel
                        system driver. Lead participants through captivating routes, showcasing the heart of our city.
                        Your expertise will shape memorable journeys.
                    </p>
                    <a href="<?=ROOT?>/signup"><button>Join us</button></a>
                    <p>Be part of creating remarkable experiences and a strong sense of camaraderie.
                        Become a driver and propel the spirit of adventure forward!</p>
                </div>
            </div>
            <div id="ride">

                <h1>Request a ride now</h1>
                <div>
                    <input type="text" placeholder="Enter pickup location">
                    <input type="text" placeholder="Enter destination">
                    <a href="<?=ROOT?>/signup"><button>Register now</button></a>
                    <p> Embark on an unforgettable journey with us! Join our exciting ride event and experience breathtaking
                        landscapes, thrilling adventures, and memories that will last a lifetime. Register now to secure your spot!</p>
                </div>
            </div>
            <div id="aboutus">A taxi management system, where customers select their drivers, boasts key features for a superior experience. Customers access driver profiles with ratings, photos, and reviews, ensuring informed choices. Real-time GPS tracking enhances safety, while in-app messaging facilitates easy communication. A driver rating system allows customers to provide feedback. These features empower customers, ensuring transparency, convenience, and satisfaction in the taxi booking process.</div>
            <script>

            //home box 
                const icon1 = document.getElementById('icon1');
                const icon2 = document.getElementById('icon2');
                const icon3 = document.getElementById('icon3');
                const driver = document.getElementById('driver');
                const ride = document.getElementById('ride');
                const aboutus = document.getElementById('aboutus');

                icon1.addEventListener('click', () => {
                    driver.style.display = 'block';
                    ride.style.display = 'none';
                    aboutus.style.display = 'none';
                    icon1.style.backgroundColor="#D9D9D9";
                    icon2.style.backgroundColor="#b5b5b5";
                    icon3.style.backgroundColor="#b5b5b5";
                });

                icon2.addEventListener('click', () => {
                    driver.style.display = 'none';
                    ride.style.display = 'block';
                    aboutus.style.display = 'none';
                    icon2.style.backgroundColor='#D9D9D9';
                    icon1.style.backgroundColor="#b5b5b5";
                    icon3.style.backgroundColor="#b5b5b5";
                });

                icon3.addEventListener('click', () => {
                    driver.style.display = 'none';
                    ride.style.display = 'none';
                    aboutus.style.display = 'block';
                    icon3.style.backgroundColor="#D9D9D9";
                    icon2.style.backgroundColor="#b5b5b5";
                    icon1.style.backgroundColor="#b5b5b5";


                });

                //scroll target

                document.addEventListener("DOMContentLoaded", function () {
                        const navLinks = document.querySelectorAll(".nav .a");

                        navLinks.forEach((link) => {
                            link.addEventListener("click", (e) => {
                               e.preventDefault();

                               const targetId = link.getAttribute("href");
                               const targetSection = document.querySelector(targetId);

                                if (targetSection) {
                                    window.scrollTo({
                                       top: targetSection.offsetTop -50, // Adjust for fixed navigation bar
                                       behavior: "smooth",
                                    });
                                }
                             });
                        });
                    });
            </script>
        </div>

    </div>

</div>

<div class="contant" id="section2">

    <div class="contant1">
        <div class="align">
            <img src="<?= ROOT ?>/assets/img/contant1.jpg" class="contant_image">
        </div>
        <div class="align1">
            <h1 class="contant_title">Ride</h1>
            <p class="contant_text">
                FlexFare Ride-Hailing includes the largest fleet of vehicles in Sri Lanka
                offering both on-demand and pre-booking features at the best rates,
                including TUK-TUKs Flex, Minis, Cars, Minivans, and Vans offering you comfort,
                convenience and safety, covering the entire island nation.
            </p>
            <button class="contant_button">Learn more</button>
        </div>
    </div>
    <div class="contant1">
        <div class="align1">
            <h1 class="contant_title">Our commitment to your safety</h1>
            <p class="contant_text">
                With every safety feature and every standard in our Community
                Guidelines, we're committed to helping to create a safe environment
                for our users.
            </p>
            <button class="contant_button">Learn more</button>
        </div>
        <div class="align">
            <img src="<?= ROOT ?>/assets/img/contant2.jpg" class="contant_image">
        </div>
    </div>
    <div class="contant1">

        <div class="align">
            <img src="<?= ROOT ?>/assets/img/contan3.jpg" class="contant_image">
        </div>
        <div class="align1">
            <h1 class="contant_title">Safety</h1>
            <p class="contant_text">
                FlexFare Ride-Hailing includes the largest fleet of vehicles in Sri Lanka
                offering both on-demand and pre-booking features at the best rates,
                including TUK-TUKs Flex, Minis, Cars, Minivans, and Vans offering you comfort,
                convenience and safety, covering the entire island nation.
            </p>
            <button class="contant_button">Learn more</button>
        </div>
    </div>
</div>

<div class="contact" id="section3">
    <h1>CONTACT US</h1>
    <div class="contact_way">
        <div>
            <i class="fa-solid fa-comment-dots"></i>
            <p>Text us</p>
            <h3>077-301-6416</h3>
        </div>
        <div>
            <i class="fa-solid fa-phone-volume"></i>
            <p>Call us</p>
            <h3>070-136-0797</h3>
        </div>
        <div>
            <i class="fa-brands fa-facebook-messenger"></i>
            <p>Message us</p>
            <h3>FACEBOOK Message</h3>
        </div>
        <div>
            <i class="fa-solid fa-envelope"></i>
            <p>Email us</p>
            <h3>FAREFLEX2023<br>@gmail.com</h3>
        </div>
    </div>
</div>

<div class="about" id="section4">
    <!-- <img src="./img/TAXI.jpg" alt=""> -->

    <h1>ABOUT US</h1>
    <div class="fpara">
        <h2>We reimagine the way the world moves for the better</h2>
        <p>Movement is what we power. It’s our lifeblood. It runs through our veins. It’s what gets us out of bed each morning. It pushes us to constantly reimagine how we can move better. For you. For all the places you want to go. For all the things you want to get. For all the ways you want to earn. Across the entire world. In real time. At the incredible speed of now.</p>
    </div>
    <div class="spara">
        <!-- <div class="para_part1">
            <h1>Our System</h1>
            <p></p>
        </div> -->
        <div class="para_part1">
            <h1>Our System</h1>
            <p>At FAREFLEX, our enduring aim is to be at the forefront of positive change in the driving education landscape. We are unwavering in our commitment to road safety and the transformation of the driving experience. Our vision encompasses the delivery of comprehensive, tailored driving education that transcends the boundaries of standard test preparation. We aspire to nurture a generation of responsible, confident, and exceptionally skilled drivers, equipping them not only with the knowledge to pass their tests but with a deep-seated commitment to safety, courtesy, and respect for all road users. Our ultimate goal is to actively contribute to the creation of a world where our roads are not just safer, but where they become hubs of community, shared experiences, and the sheer joy of driving, enriching the lives of all those we serve.</p>
            <button >Learn more</button>
        </div>
    </div>
</div>

<div class="footer">
    <div class="footer_text">
        <p class="footerp">T & C </p>
        <p class="footerp"> | </p>
        <p class="footerp"> Privacy Policy </p>
        <p class="footerp"> | </p>
        <p class="footerp"> Careers </p>
        <p class="footerp"> | </p>
        <p class="footerp">  Contact Us</p>
    </div>
    <div class="footer_icon">
        <i class="fa-brands fa-facebook-f"></i>
        <i class="fa-brands fa-twitter"></i>
        <i class="fa-brands fa-youtube"></i>
        <i class="fa-brands fa-instagram"></i>

    </div>



</div>
</body>
</html>



