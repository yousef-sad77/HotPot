document.addEventListener('DOMContentLoaded', function () {
    // Get the data-signed-in attribute from the body
    const isSignedIn = document.body.getAttribute('data-signed-in') === 'true';

    if (isSignedIn) {
        const sign = document.getElementById("sign");
        const profile = document.getElementById("profile");

        sign.classList.add("d-none");
        profile.classList.remove("d-none");
    } else {
        // Optionally handle when the user is not signed in
        console.log("User is not signed in.");
    }
});
