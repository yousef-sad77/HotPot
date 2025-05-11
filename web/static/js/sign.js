const toggleBtn = document.getElementById('toggle-btn');
const signinForm = document.getElementById('signin-form');
const signupForm = document.getElementById('signup-form');
const forgetPass = document.getElementById('forget-pass');
const submitBtn = document.getElementById('submit-btn');

let currentForm = signupForm;
submitBtn.setAttribute('form', currentForm.id); // Set initial form attribute

// Check URL param on load to toggle form
const params = new URLSearchParams(window.location.search);
const formParam = params.get('form');

if (formParam === 'signin') {
  toggleBtn.checked = true; // Ensure checkbox is checked for signin
  toggleForms(true); // Manually sync UI for signin
} else if (formParam === 'signup') {
  toggleBtn.checked = false; // Ensure checkbox is unchecked for signup
  toggleForms(false); // Manually sync UI for signup
}

function toggleForms(isSignin) {
  forgetPass.classList.toggle('active', isSignin);
  signinForm.classList.toggle('active', isSignin);
  signupForm.classList.toggle('active', !isSignin);

  currentForm = isSignin ? signinForm : signupForm;
  submitBtn.setAttribute('form', currentForm.id);
}

toggleBtn.addEventListener('click', () => {
  toggleForms(toggleBtn.checked); // Use checkbox state to determine which form to show
});

const resetBtn = document.getElementById('reset-btn');

resetBtn.addEventListener('click', () => {
  // Reset only the currently active form
  const activeForm = document.querySelector('.auth-form.active');
  if (activeForm) {
    activeForm.reset();
  }
});
