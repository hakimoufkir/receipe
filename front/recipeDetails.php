

<div id="MAP_DATA_SINGLE_RECIPE"></div>

<!-- Baked Pumpkin Tagine Chicken Wings -->
<script>

    const REACT_APP_EDAMAM_APP_ID2 = "48c05a0e";
    const REACT_APP_EDAMAM_API_KEY2 = "3b38ddc0ed4fbcf6d5533d5f23354377";

    const urlParams = new URLSearchParams(window.location.search);
    let recipeIDValue = urlParams.has('recipeLabel') ? urlParams.get('recipeLabel') : null;
    recipeIDValue ? console.log("THE ID OF RECIPE IS =" + recipeIDValue) : console.log("NO recipeLabel");


    function fetchRecipesONE(recipeIDValue) {
  let query = recipeIDValue;
  const url = `https://api.edamam.com/search?q=${query}&app_id=${REACT_APP_EDAMAM_APP_ID2}&app_key=${REACT_APP_EDAMAM_API_KEY2}&from=0&to=1&`;

  fetch(url)
    .then(response => response.json())
    .then(data => {
      const recipe = data?.hits;
      console.log(recipe);

      let recipeCardsHTML = `
      <div class="w-100 h-100vh">
      <div class="position-relative w-100" style="height: 740px;" >
  <img src="${recipe[0]?.recipe.image ?? images[Math.floor(Math.random() * images.length)]}" alt="Hero Image" class="w-100 h-100 object-cover">
</div>


<div class="position-absolute w-100 h-100 top-0 z-8 d-flex flex-column align-items-center justify-content-center pt-44 px-4"
  style="background: linear-gradient(to top, black, transparent);margin-top: 82px;">
  <h1 class="text-white text-4xl md-text-5xl font-bold text-center">
  ${recipeIDValue}
  </h1>
</div>
</div>

<div class="d-flex gap-10 align-items-center justify-content-center px-4">
  <div class="d-flex flex-column justify-content-between">
    <span class="text-black text-center border border-gray-500 py-1.5 px-2 rounded-full mb-2 mx-2">
    ${recipe[0]?.recipe.calories.toFixed(2)}F
    </span>
    <p class="text-muted text-sm md:text-md mx-2">CALORIES</p>
  </div>

  <div class="d-flex flex-column justify-content-center">
    <span class="text-black text-center border border-gray-500 py-1.5 rounded-full mb-2 mx-2">
    ${recipe[0]?.recipe.totalTime}
    </span>
    <p class="text-muted text-sm md:text-md mx-2">TOTAL TIME</p>
  </div>

  <div class="d-flex flex-column justify-content-center">
    <span class="text-black text-center border border-gray-500 py-1.5 rounded-full mb-2 mx-2">
    ${recipe[0]?.recipe.yield}
    </span>
    <p class="text-muted text-sm md:text-md mx-2">SERVINGS</p>
  </div>
</div>



<div class="container-fluid"></div>

    <div class="row gap-5 py-20 px-4 md-px-10">
      <div class="col-md-6">
        <div class="gap-5">
          <h2 class="font-weight-bold underline">Ingredients</h2>
          ${recipe[0]?.recipe.ingredientLines?.map((ingredient, index) => `
            <p class="d-flex align-items-center gap-2">${ingredient}</p>
          `).join('')}
        </div>

        <div class="gap-3 pt-5 pb-2">
          <h2 class="font-weight-bold underline">Health Labels :</h2>
          <div class="d-flex flex-wrap gap-4">
            ${recipe[0]?.recipe.healthLabels.map((item, index) => `
              <p class="d-flex align-items-center gap-2 bg-light px-4 py-1 rounded-full">${item}</p>
            `).join('')}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

      `;
      const div = document.getElementById("MAP_DATA_SINGLE_RECIPE");
      div.innerHTML = recipeCardsHTML;
    });
}

fetchRecipesONE(recipeIDValue);

</script>