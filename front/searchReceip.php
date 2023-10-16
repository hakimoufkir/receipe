
<div class="w-100 h-100vh">
  <div class="position-relative w-100" style="height: 740px;">
    <img src="https://c4.wallpaperflare.com/wallpaper/373/952/839/wooden-spoon-condiments-background-wallpaper-preview.jpg" alt="Hero Image" class="w-100 h-100 object-cover">
  </div>
</div>

<div class="position-absolute w-100 h-100 top-0 z-8 d-flex flex-column align-items-center justify-content-center pt-40 px-4"
  style="background: linear-gradient(to top, black, transparent); margin-top: 72px;">
  <h1 class="text-white text-4xl md-text-5xl font-bold text-center">
  <h1 class="text-center text-white mt-2">Search For Receipe</h1>
<div class="d-flex justify-content-center mt-2">
    <form class="form-inline md-form mr-auto mb-4 d-flex align-items-center" id="searchFormReceipe">
        <input class="form-control mr-sm-2" type="text" placeholder="Search" id="searchNameReceipeValue"
            name="searchNameReceipe" aria-label="Search">
        <button class="btn btn-primary" id="searchBtnReceipe" type="submit">Search</button>
    </form>
</div>
  </h1>
</div>
</div>

<div id="MAP_DATA">
    <script>
        //////////////////////////REDACODE//////////////////////////
        const REACT_APP_EDAMAM_APP_ID = "48c05a0e";
        const REACT_APP_EDAMAM_API_KEY = "3b38ddc0ed4fbcf6d5533d5f23354377";

        document.getElementById("searchFormReceipe").addEventListener("submit", function (event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            const serializedData = Object.fromEntries(formData.entries());
            // console.log(serializedData.searchNameReceipe);
            fetchRecipes(serializedData.searchNameReceipe);
        });

        function fetchRecipes(serializedData) {
            let query = serializedData;
            const url = `https://api.edamam.com/search?q=${query}&app_id=${REACT_APP_EDAMAM_APP_ID}&app_key=${REACT_APP_EDAMAM_API_KEY}&from=0&to=9&`;

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const dataToMap = data?.hits;

                    let recipeCardsHTML = '';

                    dataToMap.forEach((item, index) => { // Add index as a parameter in the forEach loop
                        const { recipe } = item;
                        const { label, image, url } = recipe;

                        recipeCardsHTML += `
          <div class="card mb-4 shadow-sm m-5">
            <a href="index.php?recipeLabel=${label}"><img src="${image}" class="bd-placeholder-img card-img-top" width="100%" height="225" /></a>
            <div class="card-body">
              <p class="card-text">${label}</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a href="${url}" target="_blank" class="btn btn-sm btn-outline-secondary">View</a>
                </div>
              </div>
            </div>
          </div>
        `;
                    });

                    const div = document.getElementById("MAP_DATA");
                    div.innerHTML = recipeCardsHTML;
                    div.classList.add("d-flex", "flex-wrap", "justify-content-center", "align-items-center");
                });

            document.getElementById("searchNameReceipeValue").value = "";
        }

    </script>
</div>

