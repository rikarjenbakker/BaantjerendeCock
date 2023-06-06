// console.log(shopping_cart);  
// shopping_cart.forEach(element => {
//   if(element.amount <= 0){
//       shopping_cart.splice(element);
//       setCookie('baantjer_ws_cart', JSON.stringify(shopping_cart), 30);
//   }
// });
// let add_to_cart_btn = document.querySelector('#add-to-cart');

// shopping_cart.forEach(checkNegativeShoppingcart());

// function checkNegativeShoppingcart(name)
// {
//   if(shopping_cart.indexOf(name).amount <= 0){  document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
//   }
// }

// function eraseCookie(name) {   
//   document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
// }


// window.onload = function()
// {
//   const removeButtons = document.querySelectorAll('button[aria-label="remove-amount"]');
//   removeButtons.forEach(button => {
//     button.addEventListener('click', removeAmount);
//   });
// }

// function removeAmount(event)
// {
//   let data_id = parseInt(event.target.dataset.product_id);
  
//   let product_index = shopping_cart.findIndex(item => item.id == data_id);

//   if(product_index >= 0 && shopping_cart[product_index].amount >= 1) {
//     shopping_cart[product_index].remove();
//     showProductAmount(shopping_cart[product_index]);
//     setCookie('baantjer_ws_cart', JSON.stringify(shopping_cart), 30);
//   }
// }


// let data = getElementById("product").target;
  // console.log(data);
  

  // fetch("../product.php", {
  //   method: "POST",
  //   body: JSON.stringify(data),
  //   headers: {
  //       "Content-Type": "application/json",
  //   },
  // })

  // .then((Response) => (Response.text))
  // .then((clicked_product[0]) => alert(clicked_product[0]));

  // // let file =  "../product.php";
  // // fetch (file) 
  // // .then(a =>  a.clicked_product[0])
  // // .then(b => document.getElementById("product").innerHTML = b);

  <?php 

  // $mysqli = new mysqli($servername, $user, $password, $database);

// if (!$mysqli){
//   echo "Connection Unsuccesful";
// }
  