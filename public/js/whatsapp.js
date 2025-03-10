document.addEventListener("DOMContentLoaded", function () {
    // Whatsapp call
    var link = document.getElementById("whatsapp-link");
    var phone = link.getAttribute("data-phone");
    var message = encodeURIComponent(link.getAttribute("data-message"));

    if (/Mobi|Android|iPhone/i.test(navigator.userAgent)) {
        // Mobile devices
        link.href = "whatsapp://send?phone=" + phone + "&text=" + message;
    } else {
        // Desktop or tablet
        link.href = "https://web.whatsapp.com/send?phone=" + phone + "&text=" + message;
    }
});