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
      <a class="p-2 text-white" href="/">Главная</a>
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
		<h3 align="center">Поиск абонента</h3>
    <div class="container">
		<input  type="text" id="search"  onkeyup="filter_table()" placeholder="Поиск..." class="form-control"  ><br>
</div>

	<table class="table table-hover" >
			<thead class="thead-dark">
			<tr>
				<th width="10%" onclick="sortTable(0)">Имя Фамилия</th>
				<th width="10%" onclick="sortTable(1)">Номер телефона</th>
				<th width="10%" onclick="sortTable(2)">Категория</th>

							</tr>
			</thead>
			<tbody id="table-data">

					<tr id="row1" data-id="1"  data-x="332" data-y="193"  style="">
				<td onclick="f_sw_map(event);" onmouseenter="f_sw_img(event);" onmouseleave="gi('imgblock').style.display = 'none'" onmousemove="f_mv_img(event);" style="cursor: pointer;" class="">Кирилл Подвойский</td>
				<td>+7 913 589 01 44</td>
				<td>Калининский</td>

							</tr>
					<tr id="row2" data-id="2"  data-x="356" data-y="209"  style="">
				<td onclick="f_sw_map(event);" onmouseenter="f_sw_img(event);" onmouseleave="gi('imgblock').style.display = 'none'" onmousemove="f_mv_img(event);" style="cursor: pointer;" class="">Татаринцев Артем</td>
				<td>+7 952 179 09 89</td>
				<td>Калининский</td>

							</tr>
					<tr id="row3" data-id="3" data-x="321" data-y="274"  style="">
				<td onclick="f_sw_map(event);" onmouseenter="f_sw_img(event);" onmouseleave="gi('imgblock').style.display = 'none'" onmousemove="f_mv_img(event);" style="cursor: pointer;" class="">Смолин Олег</td>
				<td>+7 999 925 48 68</td>
				<td>Заельцовский</td>

							</tr>
					<tr id="row4" data-id="4"  data-x="439" data-y="42" style="">
				<td onclick="f_sw_map(event);" onmouseenter="f_sw_img(event);" onmouseleave="gi('imgblock').style.display = 'none'" onmousemove="f_mv_img(event);" style="cursor: pointer;" class="">Марина Лагунова</td>
				<td>+7 952 563 47 13</td>
				<td>Ленинский</td>

							</tr>

					</tbody>
		</table>
		<div id="edit-container" class="modal-container" style="display: none">
			<span class="close" onclick="this.parentNode.style.display='none'">×</span>
			<div class="modal-content">
				<h3>Contact</h3>
				<input id="edit_id" type="hidden" value="">
				<div class="form-title"><label for="firstname">First name:</label></div>
				<input class="form-field" id="firstname" type="edit" value="">
				<div class="form-title"><label for="lastname">Last name:</label></div>
				<input class="form-field" id="lastname" type="edit" value="">
				<div class="form-title"><label for="company">Company:</label></div>
				<input class="form-field" id="company" type="edit" value="">
				<div class="form-title"><label for="department">Department:</label></div>
				<input class="form-field" id="department" type="edit" value="">
				<div class="form-title"><label for="position">Position:</label></div>
				<input class="form-field" id="position" type="edit" value="">
				<div class="form-title"><label for="phone">Phone:</label></div>
				<input class="form-field" id="phone" type="edit" value="">
				<div class="form-title"><label for="mobile">Mobile:</label></div>
				<input class="form-field" id="mobile" type="edit" value="">
				<div class="form-title"><label for="mail">E-mail:</label></div>
				<input class="form-field" id="mail" type="edit" value=""><br>
				<button class="form-button" type="button" onclick="f_save();">Save</button>
			</div>
		</div>
		<div id="map-container" class="modal-container" style="display:none">
			<span class="close" onclick="this.parentNode.style.display='none'">×</span>
			<img id="map-image" class="map-image" src="templ/map1.png">
			<img id="map-marker" class="map-marker" src="templ/marker.gif">
		</div>
		<form method="post" id="photo-upload" name="photo-upload">
			<input id="upload" type="file" name="photo" style="display: none">
		</form>
    <?php require "blocks/footer.php" ?>
</body>
</html>
