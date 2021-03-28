
<div class="row">
    <div class="col-lg-12">
        <div class="box-element">

            <a class="btn btn-outline-dark" href="{% url 'store' %}">&#x2190; Continue Shopping</a>

            <br>
            <br>
            <table class="table">
                <tr>
                    <th><h5>Items: <strong>{{order.get_cart_items}}</strong></h5></th>
                    <th><h5>Total:<strong>{{order.get_cart_total}} TL</strong></h5></th>
                    <th>
                        <a style="float:right; margin:5px;" class="btn btn-success"
                           href="{% url 'checkout' %}">Checkout</a>
                    </th>
                </tr>

            </table>
            <hr>
        </div>

        <br>
        <div class="box-element">
            <div class="cart-row">
                <div style="flex:2"></div>
                <div style="flex:2"><strong>Item</strong></div>
                <div style="flex:1"><strong>Price</strong></div>
                <div style="flex:1"><strong>Quantity</strong></div>
                <div style="flex:1"><strong>Total</strong></div>
            </div>

           <!-- cart taki her bir item için foreach -->
            <div class="cart-row">
                <div style="flex:2"><img class="row-image" src="{{item.product.imageURL}}"></div>
                <div style="flex:2"><p>{{item.product.name}}</p></div>
                <div style="flex:1"><p>{{item.product.price|floatformat:2}} TL</p></div>
                <div style="flex:1">
                    <p class="quantity">{{item.quantity}}</p>
                    <div class="quantity">
                        <img data-product ="{{ item.product.id }}" data-action="add" class="chg-quantity update-cart" src="{% static  'images/arrow-up.png' %}">

                        <img data-product ="{{ item.product.id }}" data-action="remove" class="chg-quantity update-cart" src="{% static  'images/arrow-down.png' %}">
                    </div>
                </div>
                <div style="flex:1"><p>{{item.get_total}} TL</p></div>
            </div>
            {% endfor %}
        </div>
    </div>
</div>
