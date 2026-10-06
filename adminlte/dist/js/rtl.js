$(document).ready(function () {
    $('.clickable').click(function () {
        // Toggle the 'clicked' class when this element is clicked
        $(this).toggleClass('clicked');
    });
});