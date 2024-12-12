// Typing Animation for Your Name
const nameElement = document.getElementById('name');
const nameText = "Your Name Here"; // Change this to your name
let index = 0;

function typeEffect() {
  if (index < nameText.length) {
    nameElement.textContent += nameText.charAt(index);
    index++;
    setTimeout(typeEffect, 150);
  } else {
    nameElement.textContent += ' '; // Add space at the end
  }
}

typeEffect();
