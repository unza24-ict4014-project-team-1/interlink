async function viewComplaint(){
    document.querySelector("main>h2").innerHTML = "ANONYMOUS COMPLAINTS";
 
    document.querySelector("#student-list-sub").style.display = "none";
    document.querySelector("#messaging-sub").style.display = "none";
    document.querySelector("#add-student-sub").style.display = "none";
    document.querySelector("#complaint-sub").style.display = "block";
    try {
        const complaintDiv = document.getElementById('complaint-sub');
        fetch('fetch-complaint.php')
        .then(response => response.json()).then(comps => {   
            complaintDiv.innerHTML = comps.map(comp => {
                return `<div class="complaint">${comp.content}</div>`;
            }).join('');
            complaintDiv.scrollTop = complaintDiv.scrollHeight; // Scroll to the bottom
        });
    } catch (error) {
        alert('Error fetching messages:', error);
    }
}

async function addStudent(){
    document.querySelector("main>h2").innerHTML = "ADD STUDENT";
    
    document.querySelector("#student-list-sub").style.display = "none";
    document.querySelector("#messaging-sub").style.display = "none";
    document.querySelector("#complaint-sub").style.display = "none";
    document.querySelector("#verification-form").style.display = "block";
    document.querySelector("#add-student-sub").style.display = "block";
}

async function message(){
    document.querySelector("main>h2").innerHTML = "SELECT STUDENT TO MESSAGE";
    
    document.querySelector("#add-student-sub").style.display = "none";
    document.querySelector("#complaint-sub").style.display = "none";
    document.querySelector("#messaging-sub").style.display = "none";
    document.querySelector("#student-list-sub").style.display = "block";
    
    //Fetch messages on click
    //Optionally, set an interval to fetch messages periodically
    //setInterval(fetchMessages, 5000); // Fetch every 5 seconds
}
async function chooseStudent(sId) {
    message_id = sId;
    document.querySelector("main>h2").innerHTML = "MESSAGING " + studentList[sId].name;
    
    document.querySelector("#add-student-sub").style.display = "none";
    document.querySelector("#complaint-sub").style.display = "none";
    document.querySelector("#student-list-sub").style.display = "none";
    document.querySelector("#messaging-sub").style.display = "block";
    fetchMessages();
}
