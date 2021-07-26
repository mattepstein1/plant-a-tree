let titles = [];
let prices = [];
let floatPrices = [];
let totalPrice;

for(let i=0 ; i<sessionStorage.length; i++)// session storage temporary storage takes all elements in that storage to use in the next loop
{
    const key = sessionStorage.key(i);
    titles[i] = key;
    prices[i] = sessionStorage.getItem(key);

    const onePrice = parseFloat(prices[i].slice(1, 7));
    floatPrices[i] = onePrice;
}

const itemsdiv = document.getElementById("items");
let id=0;
for(let i=0; i<titles.length; i++) // adds the titles and price to the html file
{
    id+=1;

    itemsdiv.appendChild(document.createElement("br"));

    const item = document.createElement("div");
    item.id = id;
    item.className = "card";
    item.style = "width: 18em"
    itemsdiv.appendChild(item);

    const title = document.createElement("h5"); // create element will create an h5 element in the document (html file)
    title.className = "card-title"
    title.innerHTML = titles[i];
    item.appendChild(title);

    const price = document.createElement("h6");
    price.innerHTML = prices[i];
    item.appendChild(price);

    const button = document.createElement("button");
    button.innerHTML = "Remove";
    button.className = "btn btn-primary btn-m text-uppercase";
    button.style = "align-content: center";
    item.appendChild(button);

    button.addEventListener("click", () => removeItem(item));
}

// Calculate total price
let sum = 0.0;
for(let i = 0; i < floatPrices.length; i++) {
  sum += floatPrices[i];
}
sum = sum.toFixed(2);

let gstSum = sum*0.15;
gstSum = gstSum.toFixed(2);

// Create bottom display
const line3 = document.createElement("h1");
line3.innerHTML = "-------------";

const deliveryTotal = document.createElement("h5");
deliveryTotal.innerHTML = "Delivery:"

//__________________________________________________________________________________________________ Awaiting quantity to determine delivery
const deliveryTotalPrinted = document.createElement("h6");
deliveryTotalPrinted.innerHTML = "$";

const line1 = document.createElement("h1");
line1.innerHTML = "-------------";

const gstTotal = document.createElement("h5");
gstTotal.innerHTML = "GST:";

const gstTotalPrinted = document.createElement("h6");
gstTotalPrinted.innerHTML = "$"+gstSum;

const line2 = document.createElement("h1");
line2.innerHTML = "-------------";

const totalPriceTitle = document.createElement("h5");
totalPriceTitle.innerHTML = "Total Price: ";

const totalPricePrinted = document.createElement("h6");
totalPricePrinted.innerHTML = "$"+sum;
//__________________________________________________________________________________________________

function removeItem(item) {
  itemID = parseInt(item.id);
  item.parentElement.removeChild(item);
  
  const title = titles[itemID-1];
  sum -= parseFloat(prices[itemID-1].substr(1));
  gstSum = sum * 0.15;
  sum = sum.toFixed(2);
  gstSum = gstSum.toFixed(2);

  sessionStorage.removeItem(title);
  gstTotalPrinted.innerHTML = "$" + gstSum;
  totalPricePrinted.innerHTML = "$" + sum;
}

document.body.appendChild(line3);
document.body.appendChild(deliveryTotal);
document.body.appendChild(deliveryTotalPrinted);
document.body.appendChild(line1);
document.body.appendChild(gstTotal);
document.body.appendChild(gstTotalPrinted);
document.body.appendChild(line2);
document.body.appendChild(totalPriceTitle);
document.body.appendChild(totalPricePrinted);
