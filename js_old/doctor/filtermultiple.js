//For filtering multiple columns in a single table 
document.addEventListener('DOMContentLoaded', function() {

	function filterTable(event) {
		var filter = event.target.value.toUpperCase();
		var rows = document.querySelector("#mrecords tbody").rows;

		for (var i = 0; i < rows.length; i++) {
			var firstCol = rows[i].cells[0].textContent.toUpperCase();
			var secondCol = rows[i].cells[1].textContent.toUpperCase();
			var thirdCol = rows[i].cells[2].textContent.toUpperCase();
			var fourthCol = rows[i].cells[3].textContent.toUpperCase();
			var fifthCol = rows[i].cells[4].textContent.toUpperCase();
			if (firstCol.indexOf(filter) > -1 || secondCol.indexOf(filter) > -1
					|| thirdCol.indexOf(filter) > -1
					|| fourthCol.indexOf(filter) > -1
					|| fifthCol.indexOf(filter) > -1) {
				rows[i].style.display = "";
			} else {
				rows[i].style.display = "none";
			}
		}
	}

	document.querySelector('#mrecordsInput').addEventListener('keyup',filterTable, false);

})
