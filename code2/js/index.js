const _SHOPPING_CART = 'wittekip_shoppingcart';

let shoppingcart_icon = null;    // Wijst naar het element op de pagina waar we
                                 // met een rode stip willen aangeven of er items
                                 // in de winkelwagen zitten.
let shoppingcart = [];           // Hierin houden we de winkelwagen bij
                                 // Dit zal een array zijn met objecten
                                 // Ieder object bevat dan informatie over
                                 // het product voor de winkelwagen

/**
 * De window.onload gebruiken we om JavaScript code uit te laten voeren
 * door de browser nadat de browser klaar is met het verwerken van de HTML en CSS
 */
window.onload = function () {

   // We halen het element binnen om de rode stip weer te kunnen geven later
   shoppingcart_icon = document.querySelector('#shoppingcart-icon');

   /**
    * We halen nu alle buttons binnen om er een event handler aan te hangen
    * Deze event handler zal dan betreffend product aan de winkelwagen
    * toevoegen
    */
   document.querySelectorAll('.product-buy-btn').forEach(button => {
      button.addEventListener('click', addToCart);
   });

   /**
    * We controleren eerst of er al items in de winkelwagen zitten.
    * Zo ja, dan gaan we deze gelijk laden vanuit de cookie in de globale
    * variabel shopping_cart, want dit is de variabele waarmee we de winkelwagen
    * bijhouden in JavaScript. We kunnen namelijk niet rechtstreeks in de cookie
    * werken.
    */
   if (getCookie(_SHOPPING_CART) != null) {
      /**
       * De inhoud van een cookie is altijd een string (dus gewoon tekst).
       * Daar kunnen we in JavaScript niet mee werken zoals wij dat willen.
       * Dus moeten we de string eerst laten omzetten naar een array met objecten,
       * dit doen we door gebruik te maken van de standaard JavaScript functionaliteit
       * JSON.parse. En aan deze functionaliteit geven we dan de inhoud van de cookie, 
       * want dit is de string die moet worden omgezet.
       */
      shoppingcart = JSON.parse(getCookie(_SHOPPING_CART));
   }

   // We updaten de icoon met een rode stip als er items in de winkelwagen zitten
   updateCartIcon();
};

/**
 * setCookie
 * ---------
 * Legt een cookie vast. Dit is een helper function om het werken met
 * cookies in JavaScript makkelijker te maken.
 * 
 * @param {*} name  Naam van de cookie
 * @param {*} value Waarde in de cookie
 * @param {*} days  Hoeveel dagen mag de cookie bestaan
 * 
 * @returns {void}
 */
function setCookie(name, value, days)
{
   let expires = "";    // Variabele waarin we de expire datum en tijd samenstellen
   if (days) {          // Als we hebben aangegeven hoeveel dagen de cookie mag blijven bestaan
      // Dan doen we onderstaande
      let date = new Date();
      date.setTime(date.getTime() + (days*24*60*60*1000));
      expires = "; expires=" + date.toUTCString();
   }
   // Nu slaan we de cookie echt op
   document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}

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
   // De onderstaande code filtert dat deel tekst uit de cookie
   // waarin de gegevens staan.
   let nameEQ = name + "=";
   let ca = document.cookie.split(';');
   for(let i=0;i < ca.length;i++) {
      let c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) 
         // De gegevens in de cookie returnen we nu
         return c.substring(nameEQ.length,c.length);
   }

   // Als er geen cookie is gevonden returned deze functie de waarde NULL
   return null;
}

/**
 * eraseCookie
 * -----------
 * Verwijdert een cookie.
 * 
 * @param {*} name  Naam van de te verwijderen cookie
 * 
 * @returns {void}
 */
function eraseCookie(name)
{
   // Een cookie kunnen we alleen LATEN verwijderen door de browser
   // Dit doen we door de datum en tijd te wijzigen naar een datum en tijd
   // die voor vandaag ligt   
   document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}


/**
 * updateCartIcon
 * --------------
 * Deze functie gebruiken we om de winkelwagen icoon op de pagina
 * te voorzien van een rode stip wanneer er items in de winkelwagen zitten
 */
function updateCartIcon()
{
   // Zit er iets in de variabele shoppinccart?
    if (shoppingcart.length > 0) {
      // Ja dan voegen we de CSS-class has-cart-items toe
      // Met deze CSS-class laten we een rode stip zien
        shoppingcart_icon.classList.add('has-cart-items');
    } else {
      // Geen items, dan verwijderen we de CSS-class weer
        shoppingcart_icon.classList.remove('has-cart-items');
    }
}

/**
 * addToCart
 * ---------
 * Dit is de event handler function voor de buttons. Een event handler function
 * krijgt van de browser altijd heel veel data over de gebeurtenis (event). In ons 
 * geval wordt de data in de parameter event gestopt.
 */
function addToCart(event)
{
   /**
    * De volgende variabele is een tijdelijke en lokale variabele.
    * Deze is nodig, omdat in de parameter event kan zijn vastgelegd dat 
    * we op de I-tag in de button hebben geklikt. We willen namelijk bij de 
    * BUTTON-tag kunnen, omdat we hier een attribuut hebben met de ID van
    * betreffend product.
    */
   let button = null;

   // We checken of de I-tag is aangeklikt
   if (event.target.nodeName === 'I')
      // Ja, dan vullen we de variabele met de parent element
      // oftewel de BUTTON-tag. Want hier vinden we de product ID
      button = event.target.parentElement;
   else
      // Nee. Dan is de BUTTON-tag geregistreerd als element
      // waarop we geklikt hebben. En deze hebben we nodig
      button = event.target;
   
   /**
    * We gaan nu uitzoeken onder welke INDEX (rij nummer in de array products) we
    * de ID kunnen vinden. Als er niets gevonden is in de array products wordt
    * de variabele product_index gevuld met -1. Als we wel een product hebben gevonden 
    * vinden we in deze variabele het rijnummer (index) terug.
    */
   let product_index = products.findIndex(product => product.id == parseInt(button.dataset.product_id));
   
   // We controleren nu of er ook een product is met de gegeven ID
   if (product_index >= 0) {
      // Ja
      // Dan gaan we nu kijken of dit product al in de winkelwagen zit
      let index = shoppingcart.findIndex(item => item.id == parseInt(button.dataset.product_id));
      // Controle of het product met gegeven ID in de winkelwagen zit
      if (index < 0) {
         // Nee, dan maken we een nieuw object aan met de data van het product
         let cart_item = {
               id:            products[product_index].id,
               title:         products[product_index].title,
               description:   products[product_index].description,
               price:         products[product_index].price,
               image:         products[product_index].image,
               amount:        1        // Standaard 1, want dit product zat nog niet in de winkelwagen
         };
         shoppingcart.push(cart_item); // Met push voegen we bovenstaand object toe aan de array.
      }
      else
         // Bestaat al in de winkelwagen
         shoppingcart[index].amount++;    // Dus verhogen we alleen het aantal
   }    

   // Nu gaan we de gehele shoppingcart array weer in de cookie opslaan
   // Maar aangezien cookies alleen tekst kunnen bevatten en dus geen array's en/of objecten
   // Moeten we de array omzetten naar een string met JSON.stringify
   setCookie(_SHOPPING_CART, JSON.stringify(shoppingcart), 30);

   // Er kan iets verandert zijn nu in de winkelwagen, dus voor de zekerheid
   // gaan we nogmaals de onderstaande functie aanroepen om zeker te zijn
   // dat de icoon in het menu ook up-to-date is (rode stip wel of niet)
   updateCartIcon();
}
