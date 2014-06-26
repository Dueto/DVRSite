$(document).ready(function()
{
	$("#textboxTelephone").mask("+7 (999) 999-99-99");
	$('#submit').click(function()
	{
		var name = $("#textboxName").val();
		if(name === "")
		{
			alert('Пожайлуйста введите имя.'); // встраиваться в хтмл
			return;
		}			
		var telephone = $("#textboxTelephone").val();
		if(telephone === "")
		{
			alert('Пожайлуйста введите номер телефона.'); // встраиваться в хтмл
			return;
		}
		$.ajax({
			url: './services/sendmail.php?name=' + name + '&telephone=' + telephone,
			complete: function(data)
			{
				var response = data.responseText;
				switch(response)
				{
					case 'success': alert('Ваша заявка успешно обработана, спасибо!'); // встраиваться в хтмл
					break;
					case 'unsuccess': alert('Ваша заявка не была обработана, повторите, пожалуйста запрос позже, спасибо!'); // тоэе самое
					break;
					case 'wronginput': alert('Данные введены не правильно, попробуйте снова.'); //тоже самое
				}
			}
			})
	});	
});