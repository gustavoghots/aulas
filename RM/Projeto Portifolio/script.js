$(document).ready(function () {
    let lastScrollTop = 0;
    const navbar = $('#mainNavbar');
    const scrollThreshold = 50; // Pixels to scroll before hiding the navbar

    $(window).on('scroll', function () {
        let scrollTop = $(this).scrollTop();

        if (scrollTop > lastScrollTop && scrollTop > scrollThreshold) {
            // Scrolling down
            navbar.css('top', '-100px'); // Adjust to hide the navbar (negative value)
        } else if (scrollTop <= lastScrollTop || scrollTop < scrollThreshold) {
            // Scrolling up or near the top
            navbar.css('top', '0');
        }
        lastScrollTop = scrollTop;
    });

    // Show navbar when hovering near the top of the page
    $(window).on('mousemove', function (e) {
        if (e.clientY < 50) { // Mouse near the top
            navbar.css('top', '0');
        }
    });
});