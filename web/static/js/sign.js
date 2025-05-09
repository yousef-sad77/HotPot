const toggleBtn = document.getElementById('toggle-btn');
const signinForm = document.getElementById('signin-form');
const signupForm = document.getElementById('signup-form');
const forgetPass = document.getElementById('forget-pass');
const submitBtn = document.getElementById('submit-btn');

let currentForm = signupForm;
submitBtn.setAttribute('form', currentForm.id); // Set initial form attribute

toggleBtn.addEventListener('click', () => {
  forgetPass.classList.toggle('active');
  signinForm.classList.toggle('active');
  signupForm.classList.toggle('active');

  currentForm = signinForm.classList.contains('active') ? signinForm : signupForm;

  // Update form attribute on submit button
  submitBtn.setAttribute('form', currentForm.id);
});


const resetBtn = document.getElementById('reset-btn');

resetBtn.addEventListener('click', () => {
  // Reset only the currently active form
  const activeForm = document.querySelector('.auth-form.active');
  if (activeForm) {
    activeForm.reset();
  }
});
