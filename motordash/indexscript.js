// You can add some interactivity like handling forms, showing pop-ups, or managing dynamic content
console.log("Index page loaded successfully.");
// for smooth scrolling 
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});
//

//<!-- JavaScript for Smooth Scroll -->

    // Smooth scroll to top
    document.querySelector('.hd a').addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'  // Smooth scrolling
        });
    });


    
// Wait until the document is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    const missionParagraph = document.querySelector('#mission-paragraph'); // Target the mission paragraph
    const toggleButton = document.querySelector('#toggle-mission');

    // Toggle the visibility of the mission section
    toggleButton.addEventListener('click', function() {
        if (missionParagraph.style.display === 'none' || missionParagraph.style.display === '') {
            missionParagraph.style.display = 'block';
            toggleButton.textContent = 'Hide Mission';
        } else {
            missionParagraph.style.display = 'none';
            toggleButton.textContent = 'Show Mission';
        }
    });
});

// how it works  

    function adjustColumns() {
        const steps = document.querySelectorAll('.step');
        const screenWidth = window.innerWidth;

        // Remove any existing column classes
        steps.forEach(step => {
            step.classList.remove('column');
        });

        // Apply column class based on screen width
        if (screenWidth < 600) {
            steps.forEach(step => step.style.flex = '1 1 100%'); // Stack on small screens
        } else if (screenWidth < 900) {
            steps.forEach(step => step.style.flex = '1 1 calc(50% - 20px)'); // Two columns on medium screens
        } else {
            steps.forEach(step => step.style.flex = '1 1 calc(33.333% - 20px)'); // Three columns on large screens
        }
    }

    // Adjust columns on load and resize
    window.addEventListener('load', adjustColumns);
    window.addEventListener('resize', adjustColumns);
// footer

    document.addEventListener("DOMContentLoaded", function() {
        const socialLinks = document.querySelectorAll('.social-icons a');

        socialLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent default action

                // Smooth scroll to top (or another section, if specified)
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    });
 // links
    // JavaScript to toggle the mobile menu
const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');

hamburger.addEventListener('click', () => {
    navLinks.classList.toggle('active');
});

