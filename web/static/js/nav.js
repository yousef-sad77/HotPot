
document.addEventListener('DOMContentLoaded', function () {
    isSignedIn = true;
    if (isSignedIn) {
        const sign = document.getElementById("sign");
        const profile = document.getElementById("profile");

        sign.classList.toggle("d-none");
        profile.classList.toggle("d-none");
    }
});