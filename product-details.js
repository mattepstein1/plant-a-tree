//import { asarray } from "./filter.js";
//console.log(array);
var url = new URL(window.location.href);
var name = url.searchParams.get("name");
var mydata = JSON.parse(data);
for(var i=0; i<=mydata.length-1; i++)
{
  if(name == mydata[i]['name'])
  {
    document.getElementById("product-name").innerHTML = mydata[i]['name'];
    document.getElementById("product-price").innerHTML = "$" + mydata[i]['price'];
    document.getElementById("product-measurement").innerHTML = mydata[i]['measurements'] + "m";
    document.getElementById("product-description").innerHTML = mydata[i]['description'];

    var b = document.getElementById("treeimage");
    b.setAttribute("src", mydata[i]['photo']);
  }
}

var itemname = document.getElementById("product-name").innerHTML;
var itemprice = document.getElementById("product-price").innerHTML;

document.getElementById("buy").addEventListener("click", function() {
  sessionStorage.setItem(itemname, itemprice);
  window.location = "/cart.html"
});
