let today = new Date();
let currentMonth = today.getMonth();
let currentYear = today.getFullYear();
let selectYear = document.getElementById("year");
let selectMonth = document.getElementById("month");

let months = ["Leden", "Únor", "Březen", "Duben", "Květen", "Červen", "Červenec", "Srpen", "Září", "Říjen", "Listopad", "Prosinec"];

let monthAndYear = document.getElementById("monthAndYear");
showCalendar(currentMonth, currentYear);
var eventList = document.getElementsByClassName('current-day-events-list');
var eventAdd = document.getElementsByClassName('add-event-day-field-btn');
var eventField = document.getElementsByClassName('add-event-day-field');

function next() {
    currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
    currentMonth = (currentMonth + 1) % 12;
    showCalendar(currentMonth, currentYear);
}



function previous() {
    currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
    currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
    showCalendar(currentMonth, currentYear);
}

function jump() {
    currentYear = parseInt(selectYear.value);
    currentMonth = parseInt(selectMonth.value);
    showCalendar(currentMonth, currentYear);
}

function showCalendar(month, year) {
    let firstDay = (new Date(year, month)).getDay();
    let daysInMonth = new Date(year, month, 0).getDate();

    let tbl = document.getElementById("calendar-body");

    tbl.innerHTML = "";

    monthAndYear.innerHTML = months[month] + " " + year;
    selectYear.value = year;
    selectMonth.value = month;

    let date = 1;
    for (let i = 0; i < 6; i++) {
        let row = document.createElement("tr");

        for (let j = 0; j < 7; j++) {
            if (i === 0 && j < firstDay) {
                let cell = document.createElement("td");
                let cellText = document.createTextNode("");
                cell.appendChild(cellText);
                row.appendChild(cell);
            } else if (date > daysInMonth) {
                break;
            } else {
                let cell = document.createElement("td");
                let btn = document.createElement('input');
                btn.type = "button";
                btn.id = date;
                btn.className = "block w-100";

                let dateWithZero = date >= 10 ? date : '0' + date;
                let monthWithZero = month >= 10 ? (parseInt(month)+1) : '0' + (parseInt(month)+1);
                let zaznam = `zaznam_datum_${year}-${monthWithZero}-${dateWithZero}`;

                if(document.getElementsByClassName(zaznam)[0]) {
                    btn.classList.add('event');
                    btn.dataset.zaznam = zaznam;
                    console.log('ano');
                }

                btn.setAttribute('onclick', 'clickZaznam(this)');

                btn.value = date;

                cell.appendChild(btn);
                row.appendChild(cell);
                date++;
            }


        }

        tbl.appendChild(row);
    }
}

function clickZaznam(element) {
    if(element.classList.contains('event')) {
        let zaznamy = [];
        let msg = '<div class="accordion" id="accordionExample">';

        [...document.getElementsByClassName(element.dataset.zaznam)].forEach((el) => {
            zaznamy.push(JSON.parse(el.innerHTML));
        });

        zaznamy.forEach((zaznam, i) => {
            msg += `
  <div class="card">
    <div class="card-header" id="heading${i}">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse${i}" aria-expanded="true" aria-controls="collapse${i}">
          ${i+1}. ${zaznam.jmeno}
        </button>
      </h2>
    </div>

    <div id="collapse${i}" class="collapse" aria-labelledby="heading${i}" data-parent="#accordionExample">
      <div class="card-body">
        <li>Datum akce: ${zaznam.datum}</li><br><li>Učitel: ${zaznam.ucitel}</li>` +
                `<br><li>Garant: ${zaznam.garant}</li><br><li>Místo konání: ${zaznam.konani}</li><br><li>Třída: ${zaznam.trida}</li><br><li>Sraz: ${zaznam.sraz}</li>` +
                `<br><li>Od: ${zaznam.cas}</li><br><li>Do: ${zaznam.cas}</li><br><li>Typ akce: ${zaznam.typ}</li><br><li>Cena akce: ${zaznam.cena}</li><br><br>
      </div>
    </div>
  </div>`;});

        msg += '</div>';

        bootbox.alert({
            title: 'Události ke dni: ' + zaznamy[0].datum,
            size: 'large',
            backdrop: true,
            message: msg,
        })
    } else {
        alert('V tento den se žádná událost nekoná!');
    }
}





var modal = document.getElementById("modal-pridat");

var btn = document.getElementById("myBtn");

var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
    modal.style.display = "block";
}

span.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
};