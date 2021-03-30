function increment_quantity(cart_id) {
    var inputQuantityElement = $("#input-quantity-" + cart_id);
    var newQuantity = parseInt($(inputQuantityElement).val()) + 1;
    save_to_db(cart_id, newQuantity);
}

function decrement_quantity(cart_id) {
    var inputQuantityElement = $("#input-quantity-" + cart_id);
    if ($(inputQuantityElement).val() > 1) {
        var newQuantity = parseInt($(inputQuantityElement).val()) - 1;
        save_to_db(cart_id, newQuantity);
    }
}

function save_to_db(cart_id, new_quantity) {
    var inputQuantityElement = $("#input-quantity-" + cart_id);
    var unitPrice = $("#product-price-" + cart_id).text();
    unitPrice = unitPrice.replace("TL", "");
    var price = unitPrice * new_quantity;
    $.ajax({
        url: "cart/updateCartItemQuantity",
        data: "cart_id=" + cart_id + "&new_quantity=" + new_quantity,
        type: 'POST',
        success: function (response) {
            $(inputQuantityElement).val(new_quantity);
            $("#cart-price-" + cart_id).text(price + "TL");
            var totalQuantity = 0;
            $("input[id*='input-quantity-']").each(function () {
                var cart_quantity = $(this).val();
                totalQuantity = parseFloat(totalQuantity) + parseFloat(cart_quantity);
            });
            $("#total-quantity").text(totalQuantity);
            var totalItemPrice = 0;
            $("div[id*='cart-price-']").each(function () {
                var cart_price = $(this).text().replace("TL", "");
                totalItemPrice = parseFloat(totalItemPrice) + parseFloat(cart_price);
            });
            $("#total-price").text(totalItemPrice + " TL");


        }
    });
}

function increment_quantity2(row_id) {
    var rowid= $(this).data("rowid");
    var qty= $(this).data("qty");
    var inputQuantityElement = $("#input-quantity-" + row_id);
    var newQuantity = parseInt($(qty).val()) + 1;
    save_to_db(newQuantity);
}

function decrement_quantity2(row_id) {
    var inputQuantityElement = $("#input-quantity-" + row_id);
    var rowid= $(this).data("rowid");
    var qty= $(this).data("qty");
    if ($(qty).val() > 1) {
        var newQuantity = parseInt($(qty).val()) - 1;
        save_to_db( newQuantity);
    }
}

function save_to_db2(new_quantity) {
    var inputQuantityElement = $("#input-quantity-" + row_id);
    // var unitPrice = $("#product-price-" + row_id).text();
    // unitPrice = unitPrice.replace("TL", "");
    // var price = unitPrice * new_quantity;
    var rowid= $(this).data("rowid");
    $.ajax({
        url: "cart/updateCartContentItem",
       // data:{row_id: rowid, new_quantity:new_quantity},
        data: "row_id=" + rowid + "&new_quantity=" + new_quantity,
        type: 'POST',
        success: function (response) {
            $(inputQuantityElement).val(new_quantity);
            // $("#cart-price-" + row_id).text(price + "TL");
            // var totalQuantity = 0;
            // $("input[id*='input-quantity-']").each(function () {
            //     var cart_quantity = $(this).val();
            //     totalQuantity = parseFloat(totalQuantity) + parseFloat(cart_quantity);
            // });
            // $("#total-quantity").text(totalQuantity);
            // var totalItemPrice = 0;
            // $("div[id*='cart-price-']").each(function () {
            //     var cart_price = $(this).text().replace("TL", "");
            //     totalItemPrice = parseFloat(totalItemPrice) + parseFloat(cart_price);
            // });
            $("#total-price").text(totalItemPrice + " TL");


        }
    });
}