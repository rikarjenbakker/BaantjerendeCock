<?php
session_start();

$page_title = 'Winkelwagen';

@require_once('src/helpers/nav-helpers.php');
@require_once('src/helpers/auth-helpers.php');

$cart_items = json_decode($_COOKIE['wittekip_shoppingcart']);
$cart_total = 0.00;
foreach($cart_items as $item) {
   $cart_total += ($item->price * $item->amount);
}

@include_once('src/templates/bovenstukhtml.php');
?>

<table border="1" style="border-collapse: collapse; background-color: white;">
   <thead>
      <tr>
         <th style="padding: 5px; text-align: center; background-color: black; color: white;">Product ID</th>
         <th style="padding: 5px; text-align: center; width: 12px; height: 12px; background-color: black; color: white;">Image</th>
         <th style="padding: 5px; text-align: center; background-color: black; color: white;">Product</th>
         <th style="padding: 5px; text-align: center; background-color: black; color: white;">Price</th>
         <th style="padding: 5px; text-align: center; background-color: black; color: white;">Amount</th>
         <th style="padding: 5px; text-align: center; background-color: black; color: white;">Totaal</th>
      </tr>
   </thead>
      <tbody>
         <?php foreach($cart_items as $item): ?>
         <tr>
            <td style="padding: 5px; text-align: center;"><?= $item->id ?></td>
            <td style="padding: 5px; text-align: center;">
               <img style="width: 40px; height: 40px;" src="<?= $item->image ?>" alt="" />
            </td>
            <td style="padding: 5px; text-align: left;"><?= $item->title ?></td>
            <td style="padding: 5px; text-align: right;">&euro; <?= $item->price ?></td>
            <td style="padding: 5px; text-align: center;"><?= $item->amount ?></td>
            <td style="padding: 5px; text-align: right;">&euro; <?= sprintf("%4.2f",$item->price * $item->amount) ?></td>
         </tr>
         <?php endforeach; ?>
         <tr>
            <td colspan="5" style="padding: 5px; text-align: right; background-color: black; color: white;">Te betalen</td>
            <td style="padding: 5px; text-align: right; background-color: black; color: red; font-weight: bold;">
               &euro; <?= sprintf("%6.2f", $cart_total) ?>
            </td>
         </tr>
         <!-- Einde winkelwagen totaal -->
      </tbody>
</table>

<?php
@include_once('src/templates/onderstukhtml.php');