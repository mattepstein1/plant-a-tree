import { createTreeCard, removeCards } from "./generate-cards.js";

// Generate all the cards when the shop has loaded. TODO Should be in a separate script.
fetch("/data/treeinfo.json")
  .then(response => response.json())
  .then(data => {
    for (let i=0; i < data.length; i++) {
      createTreeCard(data[i]["name"], data[i]["photo"], data[i]["price"], data[i]["measurements"], data[i]["description"], "tree-cards");
    }
});

// Updating the price slider.
const slider = document.getElementById("price");
const slabel = document.getElementById("slider_label");

// Display the default slider value.
slabel.innerHTML = slider.value;

// Update the current slider value (each time you drag the slider handle).
slider.oninput = function() {
  slabel.innerHTML = this.value;
}

const condition_filters = document.getElementsByTagName("select");
for (const dropdown of condition_filters) {
  dropdown.addEventListener("change", filter)
}

// Add the event listener when the slider value is changed.
slider.addEventListener("change", filter);

function filter() {
  fetch("/data/treeinfo.json")
    .then(response => response.json())
    .then(data => selectData(data))
    .then(list => displayFilteredProducts(list));
}

function selectData(data) {
  const matching_list = [];
  for (let i=0; i < data.length; i++) {
    let matching = true;

    // Go through all the dropdown menus and compare their values against the JSON data.
    for (const dropdown of condition_filters) {
      if (dropdown.value != "" && data[i][dropdown.id] != dropdown.value) {
        matching = false;
        break;
      }
    }
      
    if (parseFloat(data[i]['price']) > parseFloat(slider.value)) {
      matching = false;
    }

    if (matching) {
      matching_list.push(data[i]);
    }
  }
  return matching_list;
}

function displayFilteredProducts(list) {
  removeCards();
  for (const tree of list) {
    createTreeCard(tree["name"], tree["photo"], tree["price"], tree["measurements"], tree["description"], "tree-cards");
  }
}

