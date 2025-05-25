<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
* {
    margin: 0;
    box-sizing: border-box;
    color: white;
}

body {
    background-image: url('../img/ECABG.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    position: relative;
    height: 100dvh;
    width: 100dvw;
    font-family: Arial, Helvetica, sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.loginCard {
    width: 50rem;
    background: rgba(0, 0, 0, 0.45);
    border-radius: 2rem;
    z-index: 10;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 1rem 1rem;
    min-height: fit-content;
    position: relative;
}


label {
    font-weight: bold;
    margin-top: 1rem;
}


.title {
    font-weight: bold;
    font-size: 3.5rem;
    color: rgb(255, 255, 255);
    text-align: center;
    text-shadow: 2px 2px 4px rgb(0, 0, 0);
    margin-top: 20px;
    /* Added or increased */
    margin-bottom: 10px;
}


.subtitle {
    text-align: center;
    font-weight: bold;
    font-size: 2.5rem;
    color: white;
    margin-top: 2rem;
    text-shadow: 2px 2px 4px rgb(0, 0, 0);
}

.field {
    width: 20rem;
}

.user.field {
    margin-top: 2rem;
}

.pass.field {
    margin-top: 2rem;
}


.handle {
    color: #FFFFFF;
    display: flex;
    justify-content: center;
    gap: 4px;
    margin-bottom: 4px;
    /* background-color: red; */
}

.passwordField {
    position: relative;
    /* background-color: red; */
}

.eyeIcon {
    height: 1.5rem;
    width: 1.5rem;
    position: absolute;
    top: 0.5rem;
    right: 1rem;
    cursor: pointer;
}

.passwordField[data-isVisible="false"] .eyeIcon.open {
    display: none;
}

.passwordField[data-isVisible="false"] .eyeIcon.close {
    display: block;
}

.passwordField[data-isVisible="true"] .eyeIcon.close {
    display: none;
}

.passwordField[data-isVisible="true"] .eyeIcon.open {
    display: block;
}


input {
    background-color: rgb(255, 255, 255);
    /* Keep background color */
    color: black;
    /* Set text color to white */
    border: none;
    outline: none;
    width: 100%;
    height: 2.5rem;
    border-radius: 1rem;
    padding-inline: 1rem;
    font-size: 1rem;
    /* Ensure readability */
}

/* Remove number input spinner */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type=number] {
    appearance: textfield;
    -moz-appearance: textfield;
}

/* Placeholder color adjustment */
input::placeholder {
    color: rgb(0, 0, 0);
    /* Light white for readability */
}


button[type='submit'] {
    transition: 0.3s;
    background-color: black;
    height: 2.5rem;
    width: 43%;
    color: white;
    border-radius: 1rem;
    outline: none;
    border: none;
    margin-top: 1rem;
    /* reduce this to move it closer to the top */
    margin-bottom: 2.5rem;
    cursor: pointer;
}

button[type='submit']:hover {
    transform: scale(1.02);
    background-color: rgba(7, 42, 168, 0.68);
}


form {
    display: flex;
    flex-direction: column;
    /* justify-content: center; */
    align-items: center;
}

.logoContainer {
    height: 10rem;
    width: 10rem;
    max-width: 55%;
    max-height: 55%;
    margin-bottom: 0rem;
    /* Move it closer to the top */
    background: url('../img/ECALOGO.png');
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
}

.forgot-password {
    margin-top: 0.5rem;
    text-align: right;
    width: 100%;
}

.forgot-password {
    text-align: center;
    margin-top: 1rem;
    /* optional spacing */
}

.forgot-password a {
    color: #ffffff;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s;
}


.forgot-password a:hover {
    color: #4dabf7;
    text-decoration: underline;
}

@media screen and (max-width:801px) {}

@media screen and (max-width:920px) {
    .loginCard {
        width: 90%;
        padding-inline: 2rem;

    }
}

@media screen and (max-width:550px) {
    .title {
        font-size: 3rem;
    }

    .subtitle {
        text-align: center;
        font-weight: bold;
        font-size: 1.5rem;
        color: white;
        margin-top: 2rem;
    }

    .input {
        width: 80%;
    }
}

.field {
    width: 15rem;
}

.user.field {
    margin-top: 2rem;
}

.pass.field {
    margin-top: 2rem;
}

.error-message {
    color: white;
    font-size: 1rem;
    margin-top: 5px;
    margin-bottom: -20px;
    text-align: center;
    background-color: rgba(250, 0, 0, 0.2);
    padding: 10px;
    border-radius: 5px;
    border: 3px darkred solid;
    opacity: 0;
    /* Initial opacity */
    transition: opacity 1s ease-in-out;
    /* Transition for fade-in and fade-out */
    visibility: hidden;
    /* Hidden by default */
}

.error-message.show {
    opacity: 1;
    /* Fully visible */
    visibility: visible;
    /* Ensure visibility */
}

@media (max-width: 768px) {

    input {
        background-color: rgb(255, 255, 255);
        /* Keep background color */
        color: black;
        /* Set text color to white */
        border: none;
        outline: none;
        width: 100%;
        height: 2.5rem;
        border-radius: 1rem;
        padding-inline: 1rem;
        font-size: 1rem;
        /* Ensure readability */
    }
}

@media (max-width: 549px) {
    .title {
        font-size: 1.5rem;
    }

    .logoContainer {
        height: 10rem;
        width: 20rem;
        max-width: 55%;
        max-height: 55%;
    }

}

@media (max-width: 480px) {
    .book {
        padding: 1rem;
    }

    .title {
        font-size: 1.5rem;
    }

    .page {
        padding: 1rem;
    }

    label {
        font-size: 0.9rem;
    }

    .logoContainer {
        height: 10rem;
        width: 20rem;
        max-width: 55%;
        max-height: 55%;
    }
}

@media screen and (max-width:465px) {
    .title {
        font-size: 1.8rem;
    }

    .subtitle {
        text-align: center;
        font-weight: bold;
        font-size: 1.3rem;
        color: white;
        margin-top: 2rem;
    }

    .error-message {

        font-size: 1rem;
        margin-bottom: -20px;
        text-align: center;
        padding: 10px;
        border-radius: 15px;

    }

    .loginCard {
        justify-content: flex-start;
        height: 85vh;
        padding-block: 0.5rem;

    }

    .logoContainer {
        height: 10rem;
        width: 20rem;
        max-width: 55%;
        max-height: 55%;

    }

    .field {
        width: 15rem;
    }

    .user.field {
        margin-top: 2rem;
    }

    .pass.field {
        margin-top: 2rem;
    }

}

@media screen and (max-width:375px) {
    .logoContainer {
        height: 10rem;
        width: 20rem;
        max-width: 55%;
        max-height: 55%;

    }
}
</style>

<body>
    <div class="loginCard">
        <?php if (!empty($error_message)): ?>
        <div id="error-message" class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <p class="title">DIGITAL YEAR BOOK</p>
            <p class="subtitle">STUDENT LOGIN</p>
            <div class="user field">
                <div class="handle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <g fill="none">
                            <path
                                d="M24 0v24H0V0zM12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036q-.016-.004-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z" />
                            <path fill="#ffffff"
                                d="M11 2a5 5 0 1 0 0 10a5 5 0 0 0 0-10m0 11c-2.395 0-4.575.694-6.178 1.672c-.8.488-1.484 1.064-1.978 1.69C2.358 16.976 2 17.713 2 18.5c0 .845.411 1.511 1.003 1.986c.56.45 1.299.748 2.084.956C6.665 21.859 8.771 22 11 22l.685-.005a1 1 0 0 0 .89-1.428A6 6 0 0 1 12 18c0-1.252.383-2.412 1.037-3.373a1 1 0 0 0-.72-1.557Q11.671 13 11 13m9.616 2.469a1 1 0 1 0-1.732-1l-.336.582a3 3 0 0 0-1.097-.001l-.335-.581a1 1 0 1 0-1.732 1l.335.58a3 3 0 0 0-.547.951H14.5a1 1 0 0 0 0 2h.671a3 3 0 0 0 .549.95l-.336.581a1 1 0 1 0 1.732 1l.336-.581c.359.066.73.068 1.097 0l.335.581a1 1 0 1 0 1.732-1l-.335-.58c.242-.284.426-.607.547-.951h.672a1 1 0 1 0 0-2h-.671a3 3 0 0 0-.549-.95z" />
                        </g>
                    </svg>
                    <p>Student ID:</p>
                </div>
                <input name="studentId" id="idInput" type="number" placeholder="Student ID" maxlength="4"
                    autocomplete="off" required oninput="limitID()">
            </div>
            <div class="pass field">
                <div class="handle">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <g fill="none" fill-rule="evenodd">
                            <path
                                d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                            <path fill="#ffffff"
                                d="M6 8a6 6 0 1 1 12 0h1a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V10a2 2 0 0 1 2-2zm6-4a4 4 0 0 1 4 4H8a4 4 0 0 1 4-4m2 10a2 2 0 0 1-1 1.732V17a1 1 0 1 1-2 0v-1.268A2 2 0 0 1 12 12a2 2 0 0 1 2 2" />
                        </g>
                    </svg>
                    <p>Password:</p>
                </div>
                <div class="passwordField" data-isvisible="false">
                    <input name="password" id="loginPass" type="password" placeholder="Password" maxlength="8"
                        autocomplete="off" required>
                    <div class="eyeIcon open" onclick="togglePass()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="none">
                                <path
                                    d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                <path fill="#000000"
                                    d="M12 5c3.679 0 8.162 2.417 9.73 5.901c.146.328.27.71.27 1.099c0 .388-.123.771-.27 1.099C20.161 16.583 15.678 19 12 19s-8.162-2.417-9.73-5.901C2.124 12.77 2 12.389 2 12c0-.388.123-.771.27-1.099C3.839 7.417 8.322 5 12 5m0 3a4 4 0 1 0 0 8a4 4 0 0 0 0-8m0 2a2 2 0 1 1 0 4a2 2 0 0 1 0-4" />
                            </g>
                        </svg>
                    </div>
                    <div class="eyeIcon close" onclick="togglePass()">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="none" fill-rule="evenodd">
                                <path
                                    d="M24 0v24H0V0zM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                <path fill="#000000"
                                    d="M2.5 9a1.5 1.5 0 0 1 2.945-.404c1.947 6.502 11.158 6.503 13.109.005a1.5 1.5 0 1 1 2.877.85a10.1 10.1 0 0 1-1.623 3.236l.96.96a1.5 1.5 0 1 1-2.122 2.12l-1.01-1.01a9.6 9.6 0 0 1-1.67.915l.243.906a1.5 1.5 0 0 1-2.897.776l-.251-.935c-.705.073-1.417.073-2.122 0l-.25.935a1.5 1.5 0 0 1-2.898-.776l.242-.907a9.6 9.6 0 0 1-1.669-.914l-1.01 1.01a1.5 1.5 0 1 1-2.122-2.12l.96-.96a10.1 10.1 0 0 1-1.62-3.23A1.5 1.5 0 0 1 2.5 9" />
                            </g>
                        </svg>
                    </div>
                </div>
                <div class="forgot-password">
                    <a href="#">Forgot Password?</a>
                </div>
            </div>
            <button type="submit">Login</button>
            <div class="logoContainer">
            </div>
        </form>
    </div>
</body>
<script>
function togglePass() {
    const passField = document.querySelector('.passwordField');
    const input = document.getElementById('loginPass');
    const isVisible = passField.getAttribute('data-isvisible') === 'true';

    passField.setAttribute('data-isvisible', !isVisible);
    input.type = isVisible ? 'password' : 'text';
}

function limitID() {
    const input = document.getElementById('idInput');
    const maxLength = parseInt(input.getAttribute('maxlength'), 10);
    if (input.value.length > maxLength) {
        input.value = input.value.slice(0, maxLength);
    }
}

// Optional: Automatically fade out error message after a few seconds
window.addEventListener('DOMContentLoaded', () => {
    const errorMessage = document.getElementById('error-message');
    if (errorMessage && errorMessage.classList.contains('show')) {
        setTimeout(() => {
            errorMessage.classList.remove('show');
        }, 4000); // Hide after 4 seconds
    }
});
</script>

</html>