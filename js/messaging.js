const messagesDiv = document.getElementById('messages');
const messageInput = document.getElementById('messageInput');
const sendButton = document.getElementById('sendButton');

// Event listener for the send button
sendButton.addEventListener('click', () => {
    const content = messageInput.value.trim();
    if (content) {
        sendMessage(content);
    }
});


// Function to send a message
async function sendMessage(content) {
    try {
        fetch('send-message.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ text: content, id: message_id })
          }
        ).then(response => response.text())
        .then(data => {
            if(data.includes("success")){
                messagesDiv.innerHTML += `<div class="message sent">${content}</div>`;
                let div = document.getElementById("messages");
                div.scrollTo({
                    top: div.scrollHeight,
                    behavior: "smooth"
                });
            }
        });
        messageInput.value = ''; // Clear the input
    } catch (error) {
        alert('Error sending message: check connection');
    }
}


// Function to fetch messages from the server
async function fetchMessages() {
    let obj;
    if (user_type == 'staff'){
        obj = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: message_id })
          }
    } else {
        obj = {
            method: "POST"
        }
    }
    try {
        fetch('fetch-message.php', obj )
        .then(response => response.json()).then(messages => {   
            messagesDiv.innerHTML = messages.map(msg => {
                let msg_type;
                let msg_id;
                if (user_type == "staff"){
                    msg_id = 1000000000;
                } else {
                    msg_id = message_id;
                }
                if (msg_id == msg.sender_id){
                    msg_type = "sent";
                }else{
                    msg_type = "received";
                }
                return `<div class="message ${msg_type}">${msg.content}</div>`;
           }).join('');
            messagesDiv.scrollTop = messagesDiv.scrollHeight; // Scroll to the bottom
        });
    } catch (error) {
        alert('Error fetching messages:', error);
    }
}
