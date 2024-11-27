let program_td = document.getElementById("program-td")
async function fetchProgram(school_id) {
  program_td.innerHTML =  "<select id='program' name='program' required>\
  <option value=''>Select Program</option>\
  </select>";
    programSelect = document.getElementById("program");
    try {
      fetch('fetch-program.php', {
        method: "POST",
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ ID: school_id })
      }).then(response => response.json()).then(programs => {
        programSelect.innerHTML += programs.map(program => {
             return `<option class="list-option" value="${program.id}">${program.name}</div>`;
           }).join('');
        });
    } catch (error) {
        alert('Error fetching messages:', error);
    }
}
