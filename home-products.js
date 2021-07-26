import { createTreeCard, removeCards } from "./generate-cards.js";

fetch("/data/treeinfo.json")
  .then(response => response.json())
  .then(data => {
    for (let i=0; i < 3; i++) {
      createTreeCard(data[i]["name"], data[i]["photo"], data[i]["price"], data[i]["measurements"], data[i]["description"], "homeProducts");
    }
  });

