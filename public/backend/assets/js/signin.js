// Password visibility toggle
function togglePasswordVisibility(inputId) {
  const input = document.getElementById(inputId);
  const icon = input.parentElement.querySelector("button i");

  if (input.type === "password") {
    input.type = "text";
    icon.className = "fas fa-eye-slash";
  } else {
    input.type = "password";
    icon.className = "fas fa-eye";
  }
}

// Password strength indicator
function updatePasswordStrength(password) {
  const strengthBar = document.getElementById("strengthBar");
  if (!strengthBar) return;

  let strength = 0;
  if (password.length >= 8) strength++;
  if (/[a-z]/.test(password)) strength++;
  if (/[A-Z]/.test(password)) strength++;
  if (/[0-9]/.test(password)) strength++;
  if (/[^A-Za-z0-9]/.test(password)) strength++;

  strengthBar.className = "strength-bar";
  if (strength <= 1) {
    strengthBar.classList.add("strength-weak");
  } else if (strength <= 2) {
    strengthBar.classList.add("strength-medium");
  } else if (strength <= 3) {
    strengthBar.classList.add("strength-strong");
  } else {
    strengthBar.classList.add("strength-very-strong");
  }
}

// Verification code navigation
function moveToNext(current, nextId) {
  if (current.value.length === 1) {
    document.getElementById(nextId).focus();
  }
}

function moveToPrevious(event, current) {
  if (event.key === "Backspace" && current.value.length === 0) {
    const prev = current.previousElementSibling;
    if (prev) {
      prev.focus();
    }
  }
}

// Show page function with advanced animations
function showPage(pageId) {
  const pages = document.querySelectorAll(".page");
  const tabs = document.querySelectorAll(".tab-item");

  // Update tab states
  tabs.forEach((tab) => {
    tab.classList.remove("active");
  });

  if (pageId === "loginPage") {
    tabs[0].classList.add("active");
  } else if (pageId === "signupPage") {
    tabs[1].classList.add("active");
  }

  // Hide all pages with animation
  pages.forEach((page) => {
    page.style.opacity = "0";
    page.style.transform = "translateY(20px)";
    setTimeout(() => {
      page.classList.add("hidden");
    }, 200);
  });

  // Show target page with animation
  setTimeout(() => {
    const targetPage = document.getElementById(pageId);
    targetPage.classList.remove("hidden");
    setTimeout(() => {
      targetPage.style.opacity = "1";
      targetPage.style.transform = "translateY(0)";
    }, 50);
  }, 200);
}

// DOM Elements
const loginPage = document.getElementById("loginPage");
const signupPage = document.getElementById("signupPage");
const forgotPasswordPage = document.getElementById("forgotPasswordPage");
const verificationPage = document.getElementById("verificationPage");
const successMessage = document.getElementById("successMessage");
const loadingState = document.getElementById("loadingState");
const mainContent = document.getElementById("mainContent");

// Button event listeners
document.getElementById("loginBtn").addEventListener("click", () => {
  const email = document.getElementById("loginEmail").value;
  const password = document.getElementById("loginPassword").value;

  if (validateLoginForm(email, password)) {
    showLoading();
    simulateServerRequest(() => {
      hideLoading();
      document.getElementById("verificationEmail").textContent = email;
      showPage("verificationPage");
    });
  }
});

document.getElementById("signupBtn").addEventListener("click", () => {
  const name = document.getElementById("signupName").value;
  const username = document.getElementById("signupUsername").value;
  const email = document.getElementById("signupEmail").value;
  const password = document.getElementById("signupPassword").value;
  const agreeTerms = document.getElementById("agreeTerms").checked;

  if (
    validateSignupForm(name, username, email, password, confirm, agreeTerms)
  ) {
    showLoading();
    simulateServerRequest(() => {
      hideLoading();

      // Set success message
      document.getElementById("successTitle").textContent = "Account Created!";
      document.getElementById("successText").textContent =
        "A confirmation email has been sent to " +
        email +
        ". Please check your email.";
      document.getElementById("successActionBtn").innerHTML =
        '<i class="fas fa-sign-in-alt mr-2"></i>Sign In';

      // Set success button action
      document.getElementById("successActionBtn").onclick = () => {
        document.getElementById("loginEmail").value = email;
        showPage("loginPage");
      };

      showSuccess();
    });
  }
});

document.getElementById("sendResetLinkBtn").addEventListener("click", () => {
  const email = document.getElementById("forgotEmail").value;

  if (validateEmail(email, "forgotEmailError")) {
    showLoading();
    simulateServerRequest(() => {
      hideLoading();

      // Set success message
      document.getElementById("successTitle").textContent = "Reset Link Sent!";
      document.getElementById("successText").textContent =
        "A password reset link has been sent to " +
        email +
        ". Please check your email.";
      document.getElementById("successActionBtn").innerHTML =
        '<i class="fas fa-arrow-left mr-2"></i>Back to Login';

      // Set success button action
      document.getElementById("successActionBtn").onclick = () => {
        showPage("loginPage");
      };

      showSuccess();
    });
  }
});

document.getElementById("verifyBtn").addEventListener("click", () => {
  showLoading();
  simulateServerRequest(() => {
    hideLoading();

    // Set success message
    document.getElementById("successTitle").textContent = "Welcome!";
    document.getElementById("successText").textContent =
      "You have successfully logged in to the system.";
    document.getElementById("successActionBtn").innerHTML =
      '<i class="fas fa-tachometer-alt mr-2"></i>Go to Dashboard';

    // Set success button action
    document.getElementById("successActionBtn").onclick = () => {
      alert("Welcome to the dashboard! 🎉");
      showPage("loginPage");
    };

    showSuccess();
  });
});

document.getElementById("resendCodeBtn").addEventListener("click", () => {
  showLoading();
  simulateServerRequest(() => {
    hideLoading();
    alert("Verification code has been resent to your email. 📧");
  });
});

// Validation functions
function validateEmail(email, errorElementId) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const errorElement = document.getElementById(errorElementId);

  if (!email || !emailRegex.test(email)) {
    errorElement.classList.remove("hidden");
    errorElement.parentElement.classList.add("error-shake");
    setTimeout(() => {
      errorElement.parentElement.classList.remove("error-shake");
    }, 500);
    return false;
  } else {
    errorElement.classList.add("hidden");
    return true;
  }
}

function validatePassword(password, errorElementId) {
  const errorElement = document.getElementById(errorElementId);

  if (!password || password.length < 8) {
    errorElement.classList.remove("hidden");
    errorElement.parentElement.classList.add("error-shake");
    setTimeout(() => {
      errorElement.parentElement.classList.remove("error-shake");
    }, 500);
    return false;
  } else {
    errorElement.classList.add("hidden");
    return true;
  }
}

function validateName(name, errorElementId) {
  const errorElement = document.getElementById(errorElementId);

  if (!name || name.length < 3) {
    errorElement.classList.remove("hidden");
    errorElement.parentElement.classList.add("error-shake");
    setTimeout(() => {
      errorElement.parentElement.classList.remove("error-shake");
    }, 500);
    return false;
  } else {
    errorElement.classList.add("hidden");
    return true;
  }
}

function validateUsername(username, errorElementId) {
  const errorElement = document.getElementById(errorElementId);

  if (!username || username.length < 3) {
    errorElement.classList.remove("hidden");
    errorElement.parentElement.classList.add("error-shake");
    setTimeout(() => {
      errorElement.parentElement.classList.remove("error-shake");
    }, 500);
    return false;
  } else {
    errorElement.classList.add("hidden");
    return true;
  }
}

function validateLoginForm(email, password) {
  const emailValid = validateEmail(email, "loginEmailError");
  const passwordValid = validatePassword(password, "loginPasswordError");
  return emailValid && passwordValid;
}

function validateSignupForm(name, username, email, password, agreeTerms) {
  const nameValid = validateName(name, "signupNameError");
  const usernameValid = validateUsername(username, "signupUsernameError");
  const emailValid = validateEmail(email, "signupEmailError");
  const passwordValid = validatePassword(password, "signupPasswordError");

  // Check terms agreement
  const termsErrorElement = document.getElementById("agreeTermsError");
  if (!agreeTerms) {
    termsErrorElement.classList.remove("hidden");
    return false;
  } else {
    termsErrorElement.classList.add("hidden");
  }

  return nameValid && usernameValid && emailValid && passwordValid;
}

// UI state management functions
function showLoading() {
  mainContent.style.opacity = "0";
  mainContent.style.transform = "translateY(20px)";
  setTimeout(() => {
    mainContent.classList.add("hidden");
    loadingState.classList.remove("hidden");
  }, 200);
}

function hideLoading() {
  loadingState.classList.add("hidden");
  mainContent.classList.remove("hidden");
  setTimeout(() => {
    mainContent.style.opacity = "1";
    mainContent.style.transform = "translateY(0)";
  }, 50);
}

function showSuccess() {
  mainContent.style.opacity = "0";
  mainContent.style.transform = "translateY(20px)";
  setTimeout(() => {
    mainContent.classList.add("hidden");
    successMessage.classList.remove("hidden");
  }, 200);
}

// Simulate server request
function simulateServerRequest(callback) {
  setTimeout(() => {
    callback();
  }, 2000);
}

// Initialize page
document.addEventListener("DOMContentLoaded", () => {
  // Add password strength monitoring
  document.getElementById("signupPassword").addEventListener("input", (e) => {
    updatePasswordStrength(e.target.value);
  });

  // Add input validation on blur
  document.getElementById("loginEmail").addEventListener("blur", () => {
    validateEmail(
      document.getElementById("loginEmail").value,
      "loginEmailError"
    );
  });

  document.getElementById("loginPassword").addEventListener("blur", () => {
    validatePassword(
      document.getElementById("loginPassword").value,
      "loginPasswordError"
    );
  });

  document.getElementById("signupName").addEventListener("blur", () => {
    validateName(
      document.getElementById("signupName").value,
      "signupNameError"
    );
  });

  document.getElementById("signupUsername").addEventListener("blur", () => {
    validateUsername(
      document.getElementById("signupUsername").value,
      "signupUsernameError"
    );
  });

  document.getElementById("signupEmail").addEventListener("blur", () => {
    validateEmail(
      document.getElementById("signupEmail").value,
      "signupEmailError"
    );
  });

  document.getElementById("signupPassword").addEventListener("blur", () => {
    validatePassword(
      document.getElementById("signupPassword").value,
      "signupPasswordError"
    );
  });

  document.getElementById("forgotEmail").addEventListener("blur", () => {
    validateEmail(
      document.getElementById("forgotEmail").value,
      "forgotEmailError"
    );
  });

  // Initialize with login page
  showPage("loginPage");
});

// <!-- auto type script -->

const textEl = document.getElementById("text");
const words = ["Tawana Exam Center"];
let wordIndex = 0;
let charIndex = 0;
let deleting = false;

function typeEffect() {
  const currentWord = words[wordIndex];
  if (!deleting) {
    textEl.textContent = currentWord.slice(0, ++charIndex);
    if (charIndex === currentWord.length) {
      deleting = true;
      setTimeout(typeEffect, 1500); // wait before deleting
      return;
    }
  } else {
    textEl.textContent = currentWord.slice(0, --charIndex);
    if (charIndex === 0) {
      deleting = false;
      wordIndex = (wordIndex + 1) % words.length;
    }
  }
  setTimeout(typeEffect, deleting ? 70 : 100);
}

typeEffect();

// <!-- body animation datted script start -->

function createParticles(count = 50) {
  const container = document.getElementById("particles");
  container.innerHTML = ""; // Clear existing particles

  for (let i = 0; i < count; i++) {
    const p = document.createElement("div");
    p.className = "particle";
    p.style.left = Math.random() * 100 + "%";
    p.style.animationDelay = Math.random() * 5 + "s";
    p.style.animationDuration = Math.random() * 3 + 3 + "s";
    container.appendChild(p);
  }
}

// Run after DOM is ready
document.addEventListener("DOMContentLoaded", () => {
  createParticles(20); // </script>// You can change number of particles
});

// <!-- body animation datted script end -->
