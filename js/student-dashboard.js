
async function studentInfo(){
    document.querySelector("main>h2").innerHTML = "STUDENT INFORMATION";
    document.querySelector("#complaint-sub").style.display = "none";
    document.querySelector("#messaging-sub").style.display = "none";
    document.querySelector("#student-detail-sub").style.display = "block";
}

async function complaint(){
    document.querySelector("main>h2").innerHTML = "SEND ANONYMOUS COMPLAINT";
    document.querySelector("#student-detail-sub").style.display = "none";
    document.querySelector("#messaging-sub").style.display = "none";
    document.querySelector("#complaint-sub").style.display = "block";

}

async function message(){
    document.querySelector("main>h2").innerHTML = "MESSAGING";
    document.querySelector("#complaint-sub").style.display = "none";
    document.querySelector("#student-detail-sub").style.display = "none";
    document.querySelector("#messaging-sub").style.display = "block";
    
    //Fetch messages on click
    fetchMessages();  
    //Optionally, set an interval to fetch messages periodically
    //setInterval(fetchMessages, 5000); // Fetch every 5 seconds
}
