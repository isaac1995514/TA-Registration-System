function addClass(table) {
    var currentIndex = table.rows.length;
    var row = table.insertRow(currentIndex - 1);

    // Course Name
    var courseInput = document.createElement("input");
    courseInput.setAttribute("type", "text");
    courseInput.setAttribute("id", "added-course" + (currentIndex - 1));
    // Been a TA
    var beenTA = document.createElement("input");
    beenTA.setAttribute("type", "checkbox");
    // Issa TA
    var isTA = document.createElement("input");
    isTA.setAttribute("type", "checkbox");

    // Button
    var addButton = document.createElement("button");
    addButton.setAttribute("type", "button");
    addButton.setAttribute("onclick", "changeRow(this.parentNode.parentNode);");
    var text = document.createTextNode("ADD");
    addButton.appendChild(text);

    var firstCell = row.insertCell(0);
    firstCell.appendChild(courseInput);
    var secondCell = row.insertCell(1);
    secondCell.appendChild(beenTA);
    var thirdCell = row.insertCell(2);
    thirdCell.appendChild(isTA);
    var fourthCell = row.insertCell(3);
    fourthCell.appendChild(addButton);
}

function changeRow(row) {
    var courseName = (document.getElementById("added-course" + row.rowIndex)).value;
    alert(courseName);
    var cells = row.cells;
    cells[0].innerHTML = "<td>" + courseName + "</td>";
    cells[1].setAttribute("name", courseName + "-past");
    cells[2].setAttribute("name", courseName + "-current");
    cells[2].innertHTML = "<input type='checkbox' name='" + courseName + "-current'/>";
    row.deleteCell(3);
    alert(row.innerHTML);
} 