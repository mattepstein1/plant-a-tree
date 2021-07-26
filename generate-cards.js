function createTreeCard(tree_name, tree_image_src, tree_price, tree_measurements, tree_description, parent) { // TODO: Add an average rating parameter.
  const tree_col = document.createElement("div");
  tree_col.className = "col-lg-4 col-md-6 mb-4";
  document.getElementById(parent).appendChild(tree_col);

  const tree_card = document.createElement("div");
  tree_card.className = "card h-100";
  tree_col.appendChild(tree_card);

  addTreeImage(tree_card, tree_image_src, tree_name);
  addCardBody(tree_card, tree_name, tree_price, tree_measurements, tree_description);
  addCardFooter(tree_card);
}

// Last two parameters are from JSON.
function addTreeImage(tree_card, image_src, tree_name) {
  const anchor = document.createElement("a");
  anchor.href = "productdetails.html?name=" + tree_name;
  tree_card.appendChild(anchor);

  const image = document.createElement("img");
  image.className = "card-img-top";
  image.src = image_src;
  image.alt = tree_name;
  anchor.appendChild(image);
}

function addCardBody(tree_card, tree_name, tree_price, tree_measurements, tree_description) {
  const body = document.createElement("div");
  body.className = "card-body";
  tree_card.appendChild(body);

  const title = document.createElement("h4");
  //title.innerHTML = tree_name;
  title.className = "card-title";
  body.appendChild(title);

  var link = document.createElement("a");
  var ref = document.createAttribute("href");
  ref.value = "productdetails.html?name=" + tree_name;
  link.innerHTML = tree_name;
  link.setAttributeNode(ref);
  title.appendChild(link);

  // TODO: To add a data-toggle attribute, you need to use jQuery or PHP.
  // Preferrably using jQuery.
  // const anchor = document.createElement("a");
  // anchor.dataToggle

  // TODO: Modal function here...

  const price = document.createElement("h5");
  price.innerHTML = "$" + tree_price;
  body.appendChild(price);

  const measurement = document.createElement("h5");
  measurement.innerHTML = tree_measurements + "m";
  body.appendChild(measurement);

  const description = document.createElement("p");
  description.className = "card-text";
  description.innerHTML = tree_description;
  body.appendChild(description);
}

function addModalDialog(title_tag, tree_name, tree_description) {
  // TODO: Add in later!
}

function addCardFooter(tree_card) {
  const footer = document.createElement("div");
  footer.className = "card-footer";
  tree_card.appendChild(footer);

  const stars = document.createElement("small");
  stars.className = "text-muted";
  // TODO: Dynamically calculate a star rating.
  // FIXME: Underneath is a static rating of 4 stars.
  stars.innerHTML = "&#9733; &#9733; &#9733; &#9733; &#9734;";
  footer.appendChild(stars);
}

function calculateStarRating(average_rating) {
  // TODO: Calculate the average rating from the dataset.
}

function removeCards() {
  // Removes an element from the document
  var elements = document.getElementsByClassName("col-lg-4 col-md-6 mb-4");
  for (var i = elements.length - 1; i >= 0; --i) {
    elements[i].remove();
  }
}

export { createTreeCard, removeCards };
