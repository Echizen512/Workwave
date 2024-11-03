const form = document.querySelector(".typing-area"),
    incoming_id = form.querySelector("input[name='incoming_id']").value,
    incoming_role = form.querySelector("input[name='incoming_role']").value,
    inputField = form.querySelector(".input-field"),
    sendBtn = form.querySelector("button"),
    chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
    e.preventDefault(); // Evitar el envío por defecto del formulario
};

inputField.focus();
inputField.onkeyup = () => {
    if (inputField.value !== "") {
        sendBtn.classList.add("active");
    } else {
        sendBtn.classList.remove("active");
    }
};

sendBtn.onclick = () => {
    // Solo proceder si hay un mensaje que enviar
    if (inputField.value !== "") {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php/insert-chat.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    inputField.value = ""; // Limpiar el campo de entrada
                    scrollToBottom(); // Desplazar hacia abajo
                }
            }
        };
        let formData = new FormData(form);
        xhr.send(formData);
    }
};

chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
};

chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
};

// Actualizar los mensajes cada 500 ms
setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data; // Actualizar el chat
                if (!chatBox.classList.contains("active")) {
                    scrollToBottom(); // Desplazar hacia abajo
                }
            }
        }
    };
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(`incoming_id=${incoming_id}&incoming_role=${incoming_role}`); // Enviar también el rol
}, 500);

function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight; // Desplazar hacia abajo al último mensaje
}
