//Funkcija koja za parametar ima ID odabranog korisnika, te koja šalje taj ID kako bi se dobila lista opreme koju je taj korisnik zadužio, te prikazao modal za zaduživanje/razduživanje opreme korisniku
function equipEmployee(id){
    if(window.XMLHttpRequest){
        http = new XMLHttpRequest();
    }else{
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    http.onreadystatechange = function(){
        if (this.readyState = 4 && this.status == 200){
            var mod = document.getElementById("mod");
            mod.innerHTML = http.responseText;
            mod.style.display = "block";
        } 
    }
    http.open("POST","inc/equipmentEmployee.html.php",true);
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    http.send("id=" + id);
}

//Funkcija za zatvaranje modala
function Cancel(modal){
    var modal = document.getElementById(modal);
    modal.style.display = "none";
}

//Funkcija za brisanje podataka
function Del(id,modal,message,location,url){
    var modDelete = document.getElementById(modal);
    var div1 = document.createElement("div");
    div1.className  = "modal";
    div1.id = "modaldel";
    var div2 = document.createElement("div");
    div2.className= "modal-content modsize";
    div1.appendChild(div2);
    var div3 = document.createElement("div");
    div2.appendChild(div3);
    var p1 = document.createElement("p");
    p1.textContent = "Brisanje podataka";
    p1.className = "section-title bottom";
    div3.appendChild(p1);
    var p2 = document.createElement("p");
    p2.textContent = "Da li stvarno želite da izbrišete ove podatke?";
    p2.className = "pmodal";
    div2.appendChild(p2);
    var button1 = document.createElement("button");
    button1.className = "button red";
    button1.id = "del";
    button1.textContent = "Obriši";
    div2.appendChild(button1);
    var button2 = document.createElement("button");
    button2.className = "button";
    button2.id = "cancel";
    button2.textContent = "Odustani";
    div2.appendChild(button2);
    modDelete.appendChild(div1);
    div1.style.display = "block";
    button2.onclick = function(){
        div1.style.display = "none";
    }
    button1.onclick = function(){
        if(window.XMLHttpRequest){
            http = new XMLHttpRequest();
        }else{
            http = new ActiveXObject("Microsoft.XMLHTTP");
        }
        http.onreadystatechange = function(){
            if (this.readyState = 4 && this.status == 200){
                var x = document.getElementById(message);
                x.className = "show";
                x.innerHTML = http.responseText;
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                setTimeout(function(){window.location.href=location;},1000);
            } 
        }
        http.open("POST",url,true);
        http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        http.send("id=" + id);
    }
}

//Funkcija za ažuriranje podataka
function Change(id,modal,url){
    if(window.XMLHttpRequest){
        http = new XMLHttpRequest();
    }else{
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }
    http.onreadystatechange = function(){
        if (this.readyState = 4 && this.status == 200){
            var modChange = document.getElementById(modal);
            modChange.innerHTML = http.responseText;
            modChange.style.display = "block";
        } 
    }
    http.open("POST",url,true);
    http.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    http.send("id=" + id);
}

//Funkcija za pretragu slobodne opreme po svim kolonama
function QuickSearch() {
    var filter, table, tr, td, i, occurrence;
    filter = document.getElementById("myInput").value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 1; i < tr.length; i++) {
        occurrence = false; 
        td = tr[i].getElementsByTagName("td");
        for(var j=0; j< td.length; j++){                
            currentTd = td[j];
            if (currentTd) {
                if (currentTd.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    occurrence = true;
                } 
            }
        }
        if(!occurrence){
            tr[i].style.display = "none";
        } 
    }
}

//Funkcija za prikaz rezultata po stranicama
function RequestPage(pn){
    var perPage = document.getElementById("perPage").value;
    var total = document.getElementById("empTotal").value;
    var page = document.getElementById("page").value;
    var search = document.getElementById("search").value;
    var results = document.getElementById("results");
	var paginationControls = document.getElementById("paginationControls");
	var http = new XMLHttpRequest();
    http.onreadystatechange = function() {
	    if(http.readyState == 4 && http.status == 200) {
            results.innerHTML = http.responseText;
	    }
    }
    http.open("POST",page, true);
    http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http.send("perPage="+perPage+"&total="+total+"&pn="+pn+"&search="+search);
	var pagination = "";
    if(total != 1){
		if (pn > 1) {
			pagination += '<button class="btnPage" onclick="RequestPage('+(pn-1)+')">&lt;</button>';
    	}
		pagination += ' Strana '+pn+' od '+total + ' ';
    	if (pn != total) {
        	pagination += '<button class="btnPage" onclick="RequestPage('+(pn+1)+')">&gt;</button>';
    	}
    }
	paginationControls.innerHTML = pagination;
}

//Funkcija za dobijanje id brojeva opreme
function getSelectedCheckboxValues(name) {
    checkboxes = document.querySelectorAll("input[name=" + name + "]:checked");
    values = [];
    checkboxes.forEach((checkbox) => {
        values.push(checkbox.value);
    });
    return values;
}

//Funkcija za dobijanje id brojeva opreme koja se zadužuje na korisnika
function Obligate(){
    document.getElementById("equipChecked").value = getSelectedCheckboxValues('checkEquip');
}

//Funkcija za dobijanje id brojeva opreme koja je zadužena/koja se razdužuje, reversi
function ObligateEquipEmp(){
    document.getElementById("equipEmpChecked").value = getSelectedCheckboxValues('checkEmpEquip');
    window.location.href='index.php?page=employees';
}


