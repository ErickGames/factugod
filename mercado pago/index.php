<?php

include_once("../config/global_config_includes.php");

// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';
// Agrega credenciales
MercadoPago\SDK::setAccessToken($GLOBALS['acces_token']);
?>

<?php

$datos = new SAT();

$x=$datos->guardaPago($_GET['cliente'],$_GET['titulo'],$_GET['monto'],0,'');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = $_GET['titulo'] . " id $x";
$item->quantity = 1;
$item->unit_price = $_GET['monto'];
$preference->items = array($item);
$preference->save();
//$x = serialize($preference);
/*print_r($_GET);
echo "<br><br>";
print_r($preference->id);die;*/



?>

<html>
    <header>
            // SDK MercadoPago.js V2
        <script src="https://sdk.mercadopago.com/js/v2"></script>
        <script>
            // Agrega credenciales de SDK
            const mp = new MercadoPago('<?php echo $GLOBALS['public_key']; ?>', {
                locale: "es-AR",
            });

            // Inicializa el checkout
            mp.checkout({
                preference: {
                id: "<?php echo $preference->id; ?>",
                },
            });
            location.href="<?php echo $preference->init_point; ?>";
            
        </script>
    </header>
    <body>
        <a href="<?php echo $preference->init_point; ?>">Pagar con Mercado Pago</a>
    </body>
</html>