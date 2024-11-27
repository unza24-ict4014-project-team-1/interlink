<?php
	echo "
	<form class='hidden' id='verification-form'>
       <table id='student-detail-view' class='student-table'>
           <thead>
             <tr>
                 <th style='width: 150px;'></th>
                 <th></th>
             </tr>
           </thead>
         <tbody>
             <tr>
                 <td>Id</td>
                 <td data-label='Id'>";
                 if($_SESSION['USER_TYPE'] == 'student'){
                    echo $user_id;
                 }else{
                    echo "<input type='text' name='student-id' required>";
                 }
                 echo "</td>
             </tr>
             <tr>
                 <td>First Name</td>
                 <td data-label='fName'><input type='text' name='first-name' required></td>
             </tr>
             <tr>
                 <td>Last Name</td>
                 <td data-label='lName'><input type='text' name='last-name' required></td>
             </tr>
             <tr>
                 <td>Sex</td>
                 <td data-label='Sex'>
                 <select id='sex' name='sex' required>
                       <option value=$dbPass selected>Select sex</option>
                       <option value='Male'>Male</option>
                       <option value='Female'>Female</option>
                 </select>
                 </td>
             </tr>
             <tr>
                 <td>School</td>
                 <td data-label='School'>
                    <select id='school' name='school' onchange='fetchProgram(this.value)' required>
                    <div class='student-options'>
                       <option value=$dbPass>Select School</option>";
                       //select schools from DB
                       $result = $conn->query("SELECT id, name FROM school");
                       while($row = $result->fetch_assoc()){
                           echo "<option value=\"{$row['id']}\"> {$row['name']} </option>";
                       }
                echo "
                     </div>
                   </select>
                </td>
             </tr>
             <tr>
                 <td>Program</td>
                 <td data-label='Program' id='program-td'></td>
             </tr>
             <tr>
                 <td>Country</td>
                 <td data-label='Country'>
                 <select id='country' name='country' onchange='fetchCountry(this.value)' required>
                       <option value=$dbPass>Select Country</option>";
                    //select schools from DB
                    $result = $conn->query("SELECT id, name FROM country");
                    while($row = $result->fetch_assoc()){
                        echo "<option value=\"{$row['id']}\"> {$row['name']} </option>";
                    }
                    echo "</select></td>
             </tr>
         </tbody>
     </table>
     <button type='submit' id='submit-details-btn'>submit</button>
     </form>";
    //this file needs the above form defined
    echo "<script src='js/fetch-program.js'></script>";

    echo "<script>
    document.getElementById('verification-form').onsubmit = (event) => {
        event.preventDefault();
        const form = document.getElementById('verification-form')
        
        const formData = new FormData(form);
        try {
            fetch('update-student.php', {
                method: 'POST',
                body: formData
               }
            ).then(response => response.text())
            .then(data => {
                if( data.includes('success') ){
                    if (user_type === 'staff'){
						form.reset();
						document.querySelector('main>h2').innerHTML = 'SUCCESS: ADD MORE';
					}else{
						document.querySelector('main>h2').innerHTML = 'SUCCESS: Details Updated';
						form.remove();
					}
					
                }else if(data.includes('Duplicate')){
					alert('The user id provided already exists');
				}else{
                    alert('error on server, try again')
                }
            });
        } catch (error) {
            alert('Error cennecting server');
        }
      }
    </script>
    ";
?>
