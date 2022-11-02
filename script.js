let weather= {
    createRecord : function(city) {
        fetch("http://localhost/weatherAPI/api/create.php",
        {
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            method: "POST",
            body: JSON.stringify(city)
        })
      //  .then(function(res){ console.log(res) })
       // .then((response) => {if(response.ok){alert("the call works ok")}})
        
    },

    fetchWeather : function(city)  {
        fetch(
            "http://localhost/weatherAPI/api/single_read.php/?name="
            +city
        )
        .then((response) => {
            if (!response.ok) {
              alert("New Record just created\nRefresh your page.")
             this.createRecord(city)
            .then(response)
            }
            return response.json();
          }
          )
          .then((data) => this.displayWeather(data));
    },
     
    displayWeather : function (data)
    {
        const {name}=data;
        const {temp}=data;
        const {wind}=data;
        const {icon}=data;
        const {description}=data;
        const {humidity}=data;
        const {atmp}=data;
      //  console.log(name,temp,wind);
        document.querySelector(".city").innerText="Weather in "+name;
        document.querySelector(".temp").innerText=temp+"°C";
        document.querySelector(".wind").innerText="Wind speed: "+wind+"km/h";
        document.querySelector(".icon").src=
        "https://openweathermap.org/img/wn/" + icon + ".png";
        document.querySelector(".description").innerText=description;
        document.querySelector(".humidity").innerText=
        "Humidity: "+humidity+ "%";
        document.querySelector(".atmp").innerText=
        "Pressure= "+atmp;
        document.body.style.backgroundImage="url('https://source.unsplash.com/1600x900/?"+name+"')"
    },
    search: function () {
        this.fetchWeather(document.querySelector(".search-bar").value);
      },
};

document.querySelector(".search button").addEventListener("click", function () {
    weather.search();
  });
  document.querySelector(".search-bar")
  .addEventListener("keyup", function (event) {
    if (event.key == "Enter") {
      weather.search();
    }
  });
