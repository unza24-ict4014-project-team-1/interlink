document.write('<div id="login-container" style="display: none;">\
	<button id="close-login">x</button>\
	<h1 id="type"></h1><br>\
	<h2 class="text-center">\
		<img src="images/login-banner.png" class="img-responsive" width="70%" title="Moodle @ UNZA" alt="Moodle @ UNZA">\
	</h2><br/>\
		<form id="login">\
		<input type="text" name="user-type" id="user-type" hidden>\
		<div class="form-group">\
			<label for="username" class="sr-only">Username / email</label><br/>\
			<input type="text" name="username" id="username" class="form-control" placeholder="Username / email" required>\
		</div>\
		<div class="form-group">\
			<label for="password" class="sr-only">Password</label><br/>\
			<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>\
		</div>\
		<div class="text-center mb-2">\
			<button type="submit" class="btn" id="loginbtn">Log in</button>\
		</div>\
	</form>\
	<div class="text-center">\
		Cookies must be enabled in your browser\
	</div>\
</div>');

let loginAction = 'login.php';
let user_type;
let loginDIV =  document.getElementById("login-container")
let toBlur =  document.getElementById("to-blur")
function login(type){
	loginDIV.style.display = "block";
	toBlur.classList.add('blurred');
	document.getElementById("type").innerHTML = type.toUpperCase() + " LOGIN";
	document.getElementById('user-type').value = type;
	user_type = type;
}

document.getElementById('login').onsubmit = function(event){
	event.preventDefault();
	const formData = new FormData(this);
	fetch(loginAction, {
		method: 'POST',
		body: formData
	  }
	).then(response => response.text()).then(data => {
		if(data.includes('success')){
			window.location.href = user_type + '-dashboard.php';	
		}else{
			alert("Wrong Username or Password, TRY AGAIN");
		}
	  }
	)
}

//close the login and unblur the backgroud
document.getElementById('close-login').onclick = function(event){
	toBlur.classList.remove('blurred');
	loginDIV.style.display = "none";

}