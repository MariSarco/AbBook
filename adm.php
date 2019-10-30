<!DOCTYPE html>
<html lang="ru">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>AbBook</title>
		<link type="text/css" href="templ/style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-wight, initial-scalle=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="css\style.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
		<script src="templ/jquery-3.2.0.min.js"></script>
		<script src="templ/notify.min.js"></script>

</head>

<body>
  <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm"; style="background: url(jpg/1.jpg)">
    <h5 class="my-0 mr-md-auto font-weight-normal" style="color:#FFFFFF">Абонентская книга</h5>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-white" href="/adm.php">Главная</a>
      <a class="p-2 text-white" href="/about.php">Связь с разработчиком</a>
    </nav>

<?php require "blocks/cookie.php" ?>
</div>
<script>

function gi(name)
{
	return document.getElementById(name);
}

function escapeHtml(text) {
  return text
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
}


function f_delete(ev)
{
	var id = ev.target.parentNode.parentNode.dataset.id;
	$.get("pb.php", {'action': 'delete', 'id': id },
		function(el)
		{
			return function(data)
			{
				$.notify(data.message, data.code?"error":"success");
				if(!data.code)
				{
					var row = el.parentNode.parentNode;
					row.parentNode.removeChild(row);

				}
			}
		}(ev.target),
		'json'
	)
	.fail(
		function()
		{
			$.notify("Failed AJAX request", "error");
		}
	)
};

function f_save()
{
	$.post("pb.php?action=save&id="+gi('edit_id').value,
		{
			'firstname': gi('firstname').value,
			'lastname': gi('lastname').value,
			'password': gi('password').value,
			'password2': gi('password2').value,
			'phone': gi('phone').value,
			'mail': gi('mail').value
		},
		function(data)
		{
			$.notify(data.message, data.code?"error":"success");
			if(!data.code)
			{
				gi('edit-container').style.display='none';
				f_update_row(data.id);
			}
		},
		'json'
	)
	.fail(
		function()
		{
			$.notify("Failed AJAX request", "error");
		}
	)
}

function f_update_row(id)
{
	$.get("pb.php", {'action': 'get', 'id': id },
		function(val)
		{
			return function(data)
			{
				if(data.code)
				{
					$.notify(data.message, "error");
				}
				else
				{
					var row = gi('row'+data.id);
					if(!row)
					{
						row = gi("table-data").insertRow(0);
						row.insertCell(0);
						row.insertCell(1);
						row.insertCell(2);

					}

					row.id = 'row'+data.id;
					row.setAttribute("data-id", data.id);
					row.setAttribute("data-x", data.x);
					row.setAttribute("data-y", data.y);
					row.cells[0].textContent = data.firstname + ' ' + data.lastname;
					row.cells[1].textContent = data.phone;

					if(data.visible)
					{
						row.cells[2].innerHTML = '<span class="command" onclick="f_edit(event);">Edit</span> <span class="command" onclick="f_delete(event);">Delete</span> <span class="command" onclick="f_photo(event);">Photo</span> <span class="command" data-map="1" onclick="f_map_set(event);">Map&nbsp;1</span> <span class="command" data-map="2" onclick="f_map_set(event);">2</span> <span class="command" data-map="3" onclick="f_map_set(event);">3</span> <span class="command" data-map="4" onclick="f_map_set(event);">4</span> <span class="command" data-map="5" onclick="f_map_set(event);">5</span> <span class="command" onclick="f_hide(event);">Hide</span>';
					}
					else
					{
						row.cells[2].innerHTML = '<span class="command" onclick="f_edit(event);">Edit</span> <span class="command" onclick="f_delete(event);">Delete</span> <span class="command" data-map="1" onclick="f_map_set(event);">Map&nbsp;1</span> <span class="command" data-map="2" onclick="f_map_set(event);">2</span> <span class="command" data-map="3" onclick="f_map_set(event);">3</span> <span class="command" data-map="4" onclick="f_map_set(event);">4</span> <span class="command" data-map="5" onclick="f_map_set(event);">5</span> <span class="command" onclick="f_show(event);">Show</span>';
					}
				}
			}
		}(0),
		'json'
	)
	.fail(
		function()
		{
			$.notify("Failed AJAX request", "error");
		}
	)
}

function f_edit(ev)
{
	var id = 0;
	if(ev)
	{
		id = ev.target.parentNode.parentNode.dataset.id;
	}
	gi('edit_id').value = id;
	if(!id)
	{
		gi('firstname').value = '';
		gi('lastname').value = '';
		gi('phone').value = '';
		gi('edit-container').style.display='block';
	}
	else
	{
		$.get("pb.php", {'action': 'get', 'id': id },
			function(el)
			{
				return function(data)
				{
					if(data.code)
					{
						$.notify(data.message, "error");
					}
					else
					{
						gi('firstname').value = data.firstname;
						gi('lastname').value = data.lastname;
						gi('phone').value = data.phone;
						gi('edit-container').style.display='block';
					}
				}
			}(ev.target),
			'json'
		)
		.fail(
			function()
			{
				$.notify("Failed AJAX request", "error");
			}
		)
	}
}


function f_adm(ev)
{
	var id = 0;
	if(ev)
	{
		id = ev.target.parentNode.parentNode.dataset.id;
	}
	gi('new_adm').value = id;
	if(!id)
	{
		gi('mail').value = '';
		gi('password').value = '';
		gi('password2').value = '';
		gi('add-adm').style.display='block';
	}
	else
	{
		$.get("pb.php", {'action': 'get', 'id': id },
			function(el)
			{
				return function(data)
				{
					if(data.code)
					{
						$.notify(data.message, "error");
					}
					else
					{
						gi('mail').value = data.mail;
						gi('password').value = data.password;
						gi('password2').value = data.password2;
						gi('add-adm').style.display='block';
					}
				}
			}(ev.target),
			'json'
		)
		.fail(
			function()
			{
				$.notify("Failed AJAX request", "error");
			}
		)
	}
}

function f_upload(id)
{
	var fd = new FormData(gi("photo-upload"));
	$.ajax(
		{
			url: "pb.php?action=setphoto&id="+id,
			type: "POST",
			data: fd,
			processData: false,
			contentType: false,
			dataType: "json"
		}
	).done(function(data)
	{
		$.notify(data.message, data.code?"error":"success");
		if(!data.code)
		{
			f_update_row(data.id);
		}
	});
	return false;
}



function filter_table() {
  var input, filter, table, tr, td, i;
  input = gi("search");
  filter = input.value.toLowerCase();
  table = gi("table-data");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    tds = tr[i].getElementsByTagName("td");
	var sh = "none";
	var j;
	for(j = 0; j < tds.length; j++)
	{
		if(tds[j])
		{
		  if (tds[j].textContent.toLowerCase().indexOf(filter) > -1)
		  {
			sh = "";
			break;
		  }
		}
	}
	tr[i].style.display = sh;
  }
}

function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = gi("table");
  switching = true;
  dir = "asc";
  while (switching) {
    switching = false;
    rows = table.getElementsByTagName("TR");
	if(rows.length > 300) return;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if (dir == "asc") {
        if (x.textContent.toLowerCase() > y.textContent.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.textContent.toLowerCase() < y.textContent.toLowerCase()) {
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
		<h3 align="center">Кабинет администратора</h3>
    <div class="container">
		<input  type="text" id="search"  onkeyup="filter_table()" placeholder="Поиск..." class="form-control"  >
</div>

     <button type="button" class="my-2 mx-2 btn btn-primary" onclick="f_edit(null);">Добавить абонента</button>
		 <button type="button" class="my-2 mx-2 btn btn-secondary" onclick="f_adm(null);" style="float: right; margin-right: 5px;">Добавить администратора</button>
     <table class="table table-hover" >
      <thead class="thead-dark">
			<tr>
        <th width="10%" onclick="sortTable(0)">Имя Фамилия</th>
				<th width="10%" onclick="sortTable(1)">Номер телефона</th>
				<th width="10%" onclick="sortTable(2)">Категория	<button class=" btn btn-outline-success btn-sm"  type="button">+</button></th>

								<th width="15%">Операции</th>
							</tr>
			</thead>
			<tbody id="table-data">
					<tr id="row1" data-id="1" data-map="0" data-x="0" data-y="0" data-photo="0">
				<td onclick="f_sw_map(event);" onmouseenter="f_sw_img(event);" onmouseleave="gi('imgblock').style.display = 'none'" onmousemove="f_mv_img(event);" style="cursor: pointer;" class="">Кирилл Подвойский</td>
        <td>+7 913 589 01 44</td>
				<td>
          <select style="position: absolute;">
            <option>None</option>
           <option>Калининский р-н</option>
           <option>Ленинский р-н</option>
           <option>Центральный р-н</option>
           <option>Октябрьский р-н</option>
           <option>Кировский р-н</option>
           <option>Железнодорожный р-н</option>
           <option>Дзержинский р-н</option>
           <option>Первомайский р-н</option>
           <option>Советский р-н</option>
           <option>Заельцовский р-н</option>
        </select>
      </td>

								<td>
											<span class="command" onclick="f_edit(event);">Изменить</span>
						<span class="command" onclick="f_delete(event);">Удалить</span>
									</td>
							</tr>
					<tr id="row2" data-id="2" data-map="2" data-x="404" data-y="99" data-photo="0">
				<td onclick="f_sw_map(event);" onmouseenter="f_sw_img(event);" onmouseleave="gi('imgblock').style.display = 'none'" onmousemove="f_mv_img(event);" style="cursor: pointer;" class="">Артем Татаринцев</td>
        <td>+7 952 179 09 89</td>
        <td>
          <select style="position: absolute;">
            <option>None</option>
           <option>Калининский р-н</option>
           <option>Ленинский р-н</option>
           <option>Центральный р-н</option>
           <option>Октябрьский р-н</option>
           <option>Кировский р-н</option>
           <option>Железнодорожный р-н</option>
           <option>Дзержинский р-н</option>
           <option>Первомайский р-н</option>
           <option>Советский р-н</option>
           <option>Заельцовский р-н</option>
        </select>
      </td>
								<td>
                  <span class="command" onclick="f_edit(event);">Изменить</span>
        <span class="command" onclick="f_delete(event);">Удалить</span>
									</td>
							</tr>
					<tr id="row3" data-id="3" data-map="2" data-x="309" data-y="244" data-photo="0">
				<td onclick="f_sw_map(event);" onmouseenter="f_sw_img(event);" onmouseleave="gi('imgblock').style.display = 'none'" onmousemove="f_mv_img(event);" style="cursor: pointer;" class="">Олег Смолин</td>
        <td>+7 999 925 48 68</td>
        <td>
          <select style="position: absolute;">
            <option>None</option>
           <option>Калининский р-н</option>
           <option>Ленинский р-н</option>
           <option>Центральный р-н</option>
           <option>Октябрьский р-н</option>
           <option>Кировский р-н</option>
           <option>Железнодорожный р-н</option>
           <option>Дзержинский р-н</option>
           <option>Первомайский р-н</option>
           <option>Советский р-н</option>
           <option>Заельцовский р-н</option>
        </select>
      </td>
								<td>
                  <span class="command" onclick="f_edit(event);">Изменить</span>
        <span class="command" onclick="f_delete(event);">Удалить</span>
									</td>
							</tr>
					<tr id="row4" data-id="4" data-map="1" data-x="492" data-y="68" data-photo="0">
				<td onclick="f_sw_map(event);" onmouseenter="f_sw_img(event);" onmouseleave="gi('imgblock').style.display = 'none'" onmousemove="f_mv_img(event);" style="cursor: pointer;" class="">Марина Лагунова</td>
        <td>+7 952 563 47 13</td>
        <td>
          <select style="position: absolute;">
            <option>None</option>
           <option>Калининский р-н</option>
           <option>Ленинский р-н</option>
           <option>Центральный р-н</option>
           <option>Октябрьский р-н</option>
           <option>Кировский р-н</option>
           <option>Железнодорожный р-н</option>
           <option>Дзержинский р-н</option>
           <option>Первомайский р-н</option>
           <option>Советский р-н</option>
           <option>Заельцовский р-н</option>
        </select>

      </td>
								<td>
                  <span class="command" onclick="f_edit(event);">Изменить</span>
        <span class="command" onclick="f_delete(event);">Удалить</span>

									</td>
							</tr>

					</tbody>
		</table>
		<div id="edit-container" class="container" style="display: none; margin-left: 5px;">
			<div class="container ">
				<h4>Новый абонент</h4>
				<input id="edit_id" type="hidden" value="">
				<div class="form-title"><label for="firstname">Имя:</label></div>
				<input class="form-field" id="firstname" type="edit" value="">
				<div class="form-title"><label for="lastname">Фамилия:</label></div>
				<input class="form-field" id="lastname" type="edit" value="">
				<div class="form-title"><label for="phone">Номер телефона:</label></div>
				<input class="form-field" id="phone" type="edit" value=""><br>
				<button class="my-2  btn btn-primary btn-sm" type="button" onclick="f_save();">Сохранить</button>
			</div>
		<button class="btn btn-outline-danger btn-sm" class="close" type="button" onclick="this.parentNode.style.display='none'" style=" margin-left: 125px; margin-top: -75px;" >Отмена</button>
		</div>

		<div id="add-adm" class="container" style="display: none; margin-left: 5px;">
			<div class="container ">
				<h4>Новый администратор</h4>
				<input id="new_adm" type="hidden" value="">
				<div class="form-title"><label for="mail">E-mail:</label></div>
				<input class="form-field" id="mail" type="edit" value="">
				<div class="form-title"><label for="password">Пароль:</label></div>
				<input class="form-field" id="password" type="edit" value="">
				<div class="form-title"><label for="password2">Повторите пароль:</label></div>
				<input class="form-field" id="password2" type="edit" value=""><br>
				<button class="my-2  btn btn-primary btn-sm" type="button" onclick="f_save();">Сохранить</button>
			</div>
  	<button class="btn btn-outline-danger btn-sm" class="close" type="button" onclick="this.parentNode.style.display='none'" style=" margin-left: 125px; margin-top: -75px;" >Отмена</button>
		</div>

			</body>




<?php require "blocks/footer.php" ?>

</html>
