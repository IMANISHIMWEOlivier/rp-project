document.addEventListener("DOMContentLoaded", function () {
    const chatBox = document.getElementById("chat-box");
    const chatForm = document.getElementById("chat-form");

    // Function to load messages
    function loadMessages() {
        const senderId = document.getElementById("sender_id").value;
        const receiverId = document.getElementById("receiver_id").value;

        fetch(`chat.php?sender_id=${senderId}&receiver_id=${receiverId}`)
            .then(response => response.json())
            .then(data => {
                chatBox.innerHTML = ""; // Clear chat box before loading new messages
                data.forEach(chat => {
                    const messageDiv = document.createElement("div");
                    messageDiv.classList.add("message");

                    if (chat.sender_id == senderId) {
                        messageDiv.classList.add("sender");
                    }

                    messageDiv.textContent = chat.message;
                    chatBox.appendChild(messageDiv);
                });

                // Scroll to the bottom of the chat box
                chatBox.scrollTop = chatBox.scrollHeight;
            });
    }

    // Load messages every 3 seconds
    setInterval(loadMessages, 3000);

    // Send new message
    chatForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const senderId = document.getElementById("sender_id").value;
        const receiverId = document.getElementById("receiver_id").value;
        const message = document.getElementById("message").value;

        fetch("chat.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `sender_id=${senderId}&receiver_id=${receiverId}&message=${encodeURIComponent(message)}`
        })
        .then(response => response.text())
        .then(data => {
            console.log(data); // Optional: log response
            document.getElementById("message").value = ""; // Clear the input field
            loadMessages(); // Reload messages
        });
    });

    // Initial load of messages
    loadMessages();
});
