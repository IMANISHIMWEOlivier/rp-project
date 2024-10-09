<?php
// Simple example for using PHP in the index page
// $greeting = "Welcome to My Website";

// if (date("H") < 12) {
//     $greeting = "Good Morning!";
// } else if (date("H") < 18) {
//     $greeting = "Good Afternoon!";
// } else {
//     $greeting = "Good Evening!";
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home </title>
    <link rel="stylesheet" href="indexstyle.css">
</head>
<body>
<!-- <h1><?//php echo"<script>alert('". $greeting ."');</script>"; ?></h1> -->


    <!-- Navigation Bar -->
    <nav class="navbar">
    <div class="logo">
        <a href="index.php"><img src="uploads/g0000.png" alt="Logo"></a>
    </div>
    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="#about-section">About</a></li>
        <li><a href="#privacy">Privacy</a></li>
        <li><a href="#how-it-works">How It Works</a></li>
        <li><a href="request-ride.php">Request Ride</a></li>
        <li><a href="#contact">Contact & support</a></li>
        <li><a href="login.php" class="login-btn">Login</a></li>
    </ul>
    <div class="hamburger">&#9776;</div>
</nav>
      <!-- Hero 1 Section -->
  


    <!-- Hero 1 Section -->
    <section class="hero">
        <div class="hero-text">
            <h1>Welcome To Real-Time Motorcycle Ride-Hailing System</h1>
            
            <a href="register.php" class="cta-button">Get Started</a>
        </div>
        </section>
          <br><br><br><br>
<!--- service section --->
<?php
include"motorcyclistdecription.php";
?>
<!--- about section --->

       <section id="about-section">
        <div class="about">
            <!-- Unique h1 -->
            <h1 id="main-title">About Our Ride-Hailing System</h1>
            
            <!-- First paragraph -->
            <p id="intro-paragraph">Welcome to the Real-time Motorcycle Ride-Hailing System. Our platform is designed to connect passengers and motorcycle drivers efficiently and safely, ensuring quick, reliable transportation across Rwanda.</p>
            
            <!-- Unique h2 for mission -->
            <h2 id="mission-title">Our Mission</h2>
            
            <!-- Paragraph for mission statement -->
            <p id="mission-paragraph">To provide a user-friendly platform that enhances transportation services in Rwanda, reducing missed connections and improving road safety through real-time tracking and efficient communication.</p>
            
            <!-- Button to toggle mission section -->
            <button id="toggle-mission">Hide Mission</button>

            <!-- Unique h2 for key features -->
            <h2 id="features-title">Key Features</h2>
            <ul id="features-list">
                <li>Real-time GPS tracking</li>
                <li>In-app communication between passengers and motorists</li>
                <li>Emergency contact and safety features</li>
                <li>Feedback system to ensure service quality</li>
            </ul>
        </div>
    </section>

        <!-- privacy --->
<section id="privacy">
        <h1>Privacy Policy</h1>
        <p>We are committed to protecting your personal information while you use our real-time motorcycle ride-hailing service. This Privacy Policy explains how we collect, use, and protect your data.</p>

        <h2>Information We Collect</h2>
        <ul>
            <li><strong>Personal Information:</strong> Full name, phone number, and payment details (for ride payments).</li>
            <li><strong>Location Data:</strong> We collect real-time location data from both riders and motorists to facilitate the matching process and route optimization.</li>
            <li><strong>Ride History:</strong> Details of past rides, including start and end locations, timestamps, and fare amounts.</li>
        </ul>

        <h2>How We Use Your Information</h2>
        <ul>
            <li>To match riders with nearby motorists in real-time.</li>
            <li>To calculate ride fares and process payments.</li>
            <li>To ensure the safety of both riders and motorists through real-time tracking.</li>
            <li>To provide customer support and resolve disputes.</li>
            <li>To improve our services through data analysis and feedback.</li>
        </ul>

        <h2>Sharing of Information</h2>
        <p>We only share your personal data with trusted third parties when necessary:</p>
        <ul>
            <li>With payment processors to handle ride payments.</li>
            <li>With law enforcement agencies when required by law or for safety reasons.</li>
            <li>With ride analytics tools to improve service performance and user experience.</li>
        </ul>

        <h2>Data Protection and Security</h2>
        <p>Your data is stored securely on our servers with industry-standard encryption. We ensure that your location data is only shared with authorized personnel and is protected against unauthorized access.</p>

        <h2>Your Rights</h2>
        <ul>
            <li>You can request to view or delete your personal data at any time.</li>
            <li>You can opt out of location tracking if you decide to stop using the service.</li>
            <li>You have the right to update your account information or withdraw consent for data collection.</li>
        </ul>

        <h2>Changes to This Privacy Policy</h2>
        <p>We may update this Privacy Policy from time to time. If there are significant changes, you will be notified via email or through the app. The last update to this policy was made on <span id="last-updated"></span>.</p>

        <h2>Contact Us</h2>
        <p>If you have any questions or concerns about this Privacy Policy, feel free to contact us at support@ridehailing.com.</p>
   
        </section>
        


   
    

   
     <!-- How It Works Section -->
     <section id="how-it-works">
        <div class="container">
            <h3>How It Works</h3>
            <div class="steps">
                <div class="step">
                    <h4>1. Request a Ride</h4>
                    <p>Open the app and request a ride. We'll match you with the nearest motorcyclist.</p>
                </div>
                <div class="step">
                    <h4>2. Track Your Ride</h4>
                    <p>Watch in real-time as your motorcyclist makes their way to your location.</p>
                    
                </div>
                <div class="step">
                    <h4>3. Enjoy Your Ride</h4>
                    <p>Hop on and enjoy your safe and quick trip to your destination.</p>
                </div>
            </div>
        </div>
 <div class="hd"><a href="#">back to top</a></div>





    </section>



   <!-- contact and support -->
<section id="contact">
    <div class="container">
        <h1>Contact and Support</h1>

        <div class="row">
            <!-- Support Form -->
            <div class="column support-form">
                <form id="contactForm" action="" method="POST">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit">Submit</button>
                    </div>
                </form>

                <div id="response"></div>
            </div>

            <!-- Emergency Contacts -->
            <div class="column emergency-contacts">
                <h2>Emergency Contacts</h2>
                <ul>
                    <li><strong>Company Email:</strong> support@motorcycleapp.com</li>
                    <li><strong>Police Emergency Contact:</strong> 112</li>
                    <li><strong>RURA Contact:</strong> +250 788 155 100</li>
                </ul>
            </div>
        </div>
    </div>
</section>
    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            
        
        <p>&copy; 2024 Real-time Motorcycle Ride-Hailing System. All rights reserved.</p>
    
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<ul class="social-icons">
    <li><a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a></li>

    <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>

    <li><a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a></li>
</ul>

        </div>
    </footer>

    <script src="indexscript.js"></script>
</body>
</html>




