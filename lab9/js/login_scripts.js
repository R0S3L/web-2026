const loginBtn = document.getElementById("loginBtn");
const errorBlock = document.getElementById("errorBlock");

const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");

loginBtn.addEventListener("click", () => {

    errorBlock.style.display = "none";
    console.log(emailInput);
    console.log(passwordInput);
    emailInput.classList.remove("error");
    passwordInput.classList.remove("error");

    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();

    const emailRegex =
        /^[a-zA-Z0-9._%+-]+@$/;

    let hasError = false;

    if (!email || !emailRegex.test(email)) {
        emailInput.classList.add("error");
        hasError = true;
    }

    if (!password) {
        passwordInput.classList.add("error");
        hasError = true;
    }

    if (hasError) {
        errorBlock.style.display = "block";
        return;
    }

    alert("Успешная авторизация");
});