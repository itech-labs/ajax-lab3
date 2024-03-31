const ajax = new XMLHttpRequest();

const proccesTextData = () => {
    if (ajax.readyState === 4 && ajax.status === 200) {
        document.getElementById("table").style.visibility = "visible";

        document.getElementById("dataTable").innerHTML = ajax.response;
    }
};

const getByGenre = (event) => {
    event.preventDefault();
    const genre = document.getElementById("genre").value;

    const url = "get_by_genre.php?genre=" + genre;

    ajax.open("GET", url);
    ajax.onreadystatechange = proccesTextData;
    ajax.send();
};

const proccesJSONData = () => {
    if (ajax.readyState === 4 && ajax.status === 200) {
        document.getElementById("table").style.visibility = "visible";

        const data = JSON.parse(ajax.response);

        const dataStr = data.reduce((acc, item) => {
            acc += "<tr>";

            acc += `<td>${item.name}</td>`;
            acc += `<td>${item.date}</td>`;
            acc += `<td>${item.country}</td>`;
            acc += `<td>${item.director}</td>`;
            acc += `<td>${item.genres}</td>`;

            acc += "</tr>";

            return acc;
        }, "");

        document.getElementById("dataTable").innerHTML = dataStr;
    }
};

const getByActor = (event) => {
    event.preventDefault();
    const actor = document.getElementById("actor").value;

    const url = "get_by_actor.php?actor=" + actor;

    ajax.open("GET", url);
    ajax.onreadystatechange = proccesJSONData;
    ajax.send();
};

const proccesXMLData = () => {
    if (ajax.readyState === 4 && ajax.status === 200) {
        document.getElementById("table").style.visibility = "visible";

        const xmlDoc = ajax.responseXML;

        const films = xmlDoc.getElementsByTagName("film");

        let dataStr = "";

        for (let i = 0; i < films.length; i++) {
            const film = films[i];
            const name = film.getElementsByTagName("name")[0].textContent;
            const date = film.getElementsByTagName("date")[0].textContent;
            const country = film.getElementsByTagName("country")[0].textContent;
            const director = film.getElementsByTagName("director")[0].textContent;
            const genres = film.getElementsByTagName("genres")[0].textContent;

            dataStr += "<tr>";
            dataStr += `<td>${name}</td>`;
            dataStr += `<td>${date}</td>`;
            dataStr += `<td>${country}</td>`;
            dataStr += `<td>${director}</td>`;
            dataStr += `<td>${genres}</td>`;
            dataStr += "</tr>";
        }

        document.getElementById("dataTable").innerHTML = dataStr;
    }
};

const getByPeriod = (event) => {
    event.preventDefault();
    const startDate = document.getElementById("start_date").value;
    const endDate = document.getElementById("end_date").value;

    const url = "get_by_period.php?start_date=" + startDate + "&end_date=" + endDate;

    ajax.open("GET", url, true);
    ajax.onreadystatechange = proccesXMLData;
    ajax.send();
};
