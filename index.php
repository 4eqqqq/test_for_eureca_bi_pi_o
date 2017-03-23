<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- style -->
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<div id="block_reg">
		<form action="registration.php" method="post" id="registration_frm" >
			<h2 class="reg_head">Регистрация</h3>
			
			<div class="reg_elem">
				<label for="lastName">Фамилия: </label>
				<input id="lastName" type="text" name="lastName"  />
			</div>
			<div class="reg_elem">
				<label for="firstName">Имя: </label> 
				<input id="firstName" type="text" name="firstName" />
			</div>
			<div class="reg_elem">
				<label for="fatherName">Отчество: </label>
				<input id="fatherName" type="text" name="fatherName" />
			</div>
			<div class="reg_elem">
				<label for="dateBorn">Дата рождения: </label>
				<input type="text" id="dateBorn" name="dateBorn" placeholder="ДД.ММ.ГГГГ" />

			</div>
			<div class="reg_elem">
				<label for="passNum">Номер паспорта: </label>
				<input type="text" maxlength=10 name="passNum" id="passNum"/>
			</div>
			<div class="reg_elem">
				<label for="login"><span class="warn">*</span>Логин: </label>
				<input type="text" name="login" id="login">
			</div>
			<div class="reg_elem">
				<label for="pass"><span class="warn">*</span>Пароль: </label>
				<input id="pass" type="password" name="pass" />
			</div>
			<span class="warning"><span class="warn">*</span> - обязательные поля</span>
			<div class="reg_elem">
				<button type="submit">Зарегистрироваться</button>
			</div>
		</form>
	</div>

	<div id="reg_result">
		
	</div>
<script>

	document.getElementById('registration_frm').onsubmit = function(){
		if ( this.login.value!='' && this.pass.value!='' ){
			var http = new XMLHttpRequest();
			http.open("POST", "/registration.php", true);
			http.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			http.send("&lastName=" + this.lastName.value + "&firstName=" + this.firstName.value + "&fatherName=" + this.fatherName.value + "&dateBorn=" + this.dateBorn.value + "&login=" + 
				this.login.value + "&passNum=" + this.passNum.value + "&pass=" + this.pass.value);
			http.onreadystatechange = function() {
				if (http.readyState == 4 && http.status == 200) {


					document.getElementById('reg_result').innerHTML = http.responseText;
					}
			}
			http.onerror = function() {
			// alert(http.responseText);
		}
		} else {
			document.getElementById('reg_result').innerHTML = 'Заполните обязательные поля';
		}
			return false;
		}

</script> 

</body>

</html>