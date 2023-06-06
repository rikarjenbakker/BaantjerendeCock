let shopping_cart = [];

let increase_buttons = document.querySelectorAll('button[aria-label=increase-amount]');

window.onload = function(event) {
  if(getCookie('baantjer_ws_cart')) {
    shopping_cart = JSON.parse(getCookie('baantjer_ws_cart'));
  }
  
  add_to_cart_btn = document.querySelector('#add-to-cart');

  if(add_to_cart_btn != null && add_to_cart_btn != undefined)
    add_to_cart_btn.addEventListener('click', addToCart);

  increase_buttons = document.querySelectorAll('button[aria-label=increase-amount]');

  increase_buttons.forEach(inc_button => {
    inc_button.innerText = '+';
    inc_button.addEventListener('click', increaseAmount);
  });

  decrease_buttons = document.querySelectorAll('button[aria-label=decrease-amount]');

  decrease_buttons.forEach(inc_button => {
    inc_button.innerText = '-';
    inc_button.addEventListener('click', decreaseAmount);
  });

  remove_buttons = document.querySelectorAll('button[aria-label=remove-amount]');

  remove_buttons.forEach(inc_button => {
    inc_button.innerText = 'Verwijderen';
    inc_button.addEventListener('click', removeAmount);
  });

  shopping_cart.forEach( item => {
    showProductAmount(item);
  });

};

function setCookie(name,value,days) {
  var expires = "";
  if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days*24*60*60*1000));
      expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

function getCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
  }
  return null;
}

function showProductAmount(item)
{
  let amount_element = document.querySelector(`span[aria-label=product-amount${item.id}]`);
  amount_element.innerText = 'Aantal: ' + item.amount;
}

function increaseAmount(event)
{
  let data_id = parseInt(event.target.dataset.product_id);
  
  let product_index = shopping_cart.findIndex(item => item.id == data_id);

  if(product_index >= 0) {
    shopping_cart[product_index].amount++;
    showProductAmount(shopping_cart[product_index]);
    setCookie('baantjer_ws_cart', JSON.stringify(shopping_cart), 30);
  }
}

function decreaseAmount(event)
{
  let data_id = parseInt(event.target.dataset.product_id);
  
  let product_index = shopping_cart.findIndex(item => item.id == data_id);

  if(product_index >= 0 && shopping_cart[product_index].amount >= 1) {
    shopping_cart[product_index].amount--;
    showProductAmount(shopping_cart[product_index]);
    setCookie('baantjer_ws_cart', JSON.stringify(shopping_cart), 30);
  }
}

function removeAmount(event) {
  let data_id = parseInt(event.target.dataset.product_id);
  
  let product_index = shopping_cart.findIndex(item => item.id == data_id);

  if (product_index !== -1) {
    shopping_cart.splice(product_index, 1); // Remove the product from the array
    setCookie('baantjer_ws_cart', JSON.stringify(shopping_cart), 30);
    // Update the cart display or perform any other necessary actions
    location.reload();
  }
  
}

function addToCart(event) {
  let product_id = 0;
  // Controleren of het product met deze ID al in de winkelwagen zit
  if(event.target.nodeName == 'I')
    product_id = parseInt(event.target.parentElement.dataset.product_id);
  else
    product_id = parseInt(event.target.dataset.product_id);
  let cart_index = shopping_cart.findIndex(item => item.id == product_id);
  if(cart_index < 0) {
    // Nog niet gevonden in de shopping cart
    let product = {
      id: product_id,
      amount: 1
    };
    shopping_cart.push(product);
  } else {
    // Wel gevonden. Dan aantal verhogen
    shopping_cart[cart_index].amount++;
  }

  setCookie('baantjer_ws_cart', JSON.stringify(shopping_cart), 30);

}

