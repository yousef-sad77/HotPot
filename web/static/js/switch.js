const toggle = document.getElementById("myToggle");
toggle.addEventListener("change", function () {
  if (this.checked) {
    console.log("Switch is ON");
  } else {
    console.log("Switch is OFF");
  }
});