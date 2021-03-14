<?php

namespace Inc\classes\admin\controller;

use Inc\classes\admin\controller\BaseController;
use Inc\classes\admin\API\ExportApi;

class TemplateController extends BaseController
{
    private function calcuate_date($date)
    {
        $next_date = strtotime($date);
        $today = strtotime(date("Y-m-d"));
        // number of days 
        $diff = abs(($next_date - $today)) / 60 / 60 / 24;
        return $diff;
    }

    public function product()
    {
        echo "<pre>";
        $next_payment = explode(" ", wcs_get_users_subscriptions(get_current_user_id())[72]->schedule_next_payment)[0];
        $minus_date = $this->calcuate_date($next_payment);
        var_dump($minus_date);
    }
    public function list_template()
    {

        $products = get_posts(array(
            'post_type' => 'product',
            'posts_per_page' => 100
        ));
        $all_data = array();
?>
        <table class="widefat fixed" cellspacing="0">
            <thead>
                <tr>
                    <th id="columnname" class="manage-column column-columnname" scope="col">id</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">_sku</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">total_sales</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">_manage_stock</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">_stock_status</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">_virtual</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">_sale_price</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">_price</th>

                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th id="columnname" class="manage-column column-columnname" scope="col">id</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">_sku</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">total_sales</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">_manage_stock</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">_stock_status</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">_virtual</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">_sale_price</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">_price</th>
                </tr>
            </tfoot>
            <?php
            foreach ($products as $product) {
                $meta = get_post_meta($product->ID, '', true);
                $data = array_merge((array)$product, (array)$meta);
                array_push($all_data, $data);
            ?>
                <!-- <p><?php echo $product->sku; ?></p> -->
                <tbody>
                <tbody>
                    <tr class="alternate">
                        <th class="check-column" scope="row">
                            <a href="?page=user_data_slug&user_data=<?php echo $product->id; ?>">
                                <?php echo $product->id; ?>
                            </a>
                        </th>
                        <td class="column-columnname"><?php echo $product->_sku; ?></td>
                        <td class="column-columnname"><?php echo $product->total_sales; ?></td>
                        <td class="column-columnname"><?php echo $product->manage_stock; ?></td>
                        <td class="column-columnname"><?php echo $product->stock_status; ?></td>
                        <td class="column-columnname"><?php echo $product->virtual; ?></td>
                        <td class="column-columnname"><?php echo ($product->sale_price ? $product->sale_price :  0); ?></td>
                        <td class="column-columnname"><?php echo $product->price; ?></td>
                    </tr>


                <?php
            }
                ?>
                </tbody>
        </table>
        <form method="POST">
            <input type="submit" value="export" name="download">
        </form>
<?php
        if (isset($_POST['download'])) {
            ExportApi::array2csv($all_data);
        }
    }
}
