This issue might be with the theme which you are using

Please do make sure that your theme has `woocommerce_order_item_name` AND `woocommerce_order_item_quantity_html` filter in the below files


**`woocommerce_order_item_name` filer file list :**

```
1. your-theme/woocommerce/order/order-details-item.php
2. your-theme/woocommerce/checkout/form-pay.php
3. your-theme/woocommerce/emails/email-order-items.php
4. your-theme/woocommerce/emails/plain/email-order-items.php
```

**`woocommerce_order_item_quantity_html` filer file list :**

```
1. your-theme/woocommerce/order/order-details-item.php
2. your-theme/woocommerce/checkout/form-pay.php
```
