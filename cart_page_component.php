<?php
function addtocart($pid,$product_name,$product_image,$old_price,$new_price){
    $product_image = "." . "/" ."photos". "/" .$product_image;
    echo " <form action=\"cart_page.php?action=remove&id=$pid\" method=\"post\" class=\"cart-items\">
 <div class=\"item-main cf\">
    <div class=\"item-block ib-info cf\">
        <img class=\"product-img\" src=\"$product_image.jpg\" />
        <div class=\"ib-info-meta\">
            <span class=\"title\">$product_name</span>
        </div>
    </div>
    <div class=\"item-block ib-qty\">
    <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
    <span class=\"price\" style=\" text-decoration: line-through;\"><span></span> ₹$old_price/plate</span>
        <span class=\"price\"><span></span> ₹$new_price/plate</span>
    </div>
    <div class=\"item-block ib-total-price\">
        <span class=\"tp-price\">₹$new_price</span>
        <span class=\"tp-remove\"><i class=\"i-cancel-circle\"></i></span>
    </div>
</div>
</form>
<hr>";
}
?>