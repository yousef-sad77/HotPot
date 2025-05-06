const toggleBtn = document.getElementById('toggle-btn');
const signinForm = document.getElementById('signin-form');
const signupForm = document.getElementById('signup-form');
const forgetPass = document.getElementById('forget-pass');

toggleBtn.addEventListener('click', () => {
  forgetPass.classList.toggle('active')
  signinForm.classList.toggle('active');
  signupForm.classList.toggle('active');
});