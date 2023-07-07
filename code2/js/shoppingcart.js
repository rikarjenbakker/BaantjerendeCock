const _SHOPPING_CART = 'wittekip_shoppingcart';

let shoppingcart_icon = null;

window.onload = function () {
   shoppingcart_icon = document.querySelector('#shoppingcart-icon');

   updateCartIcon();
};


/**
 * getCookie
 * ---------
 * Leest de waarde in een cookie.
 * 
 * @param {*} name  Naam van de cookie
 * 
 * @returns {string}    De waarde in de cookie
 */
function getCookie(name)
{
   let nameEQ = name + "=";
   let ca = document.cookie.split(';');
   for(let i=0;i < ca.length;i++) {
      let c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
   }
   return null;
}

function updateCartIcon()
{
   if (JSON.parse(getCookie(_SHOPPING_CART)).length > 0) {
      shoppingcart_icon.classList.add('has-cart-items');
   } else {
      shoppingcart_icon.classList.remove('has-cart-items');
   }
}
