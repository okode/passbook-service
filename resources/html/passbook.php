<?php

require 'vendor/autoload.php';

use Passbook\Pass\Field;
use Passbook\Pass\Image;
use Passbook\PassFactory;
use Passbook\Pass\Barcode;
use Passbook\Pass\Structure;
use Passbook\Type\Generic;
use Passbook\Pass\Location;

$passbookId = date_timestamp_get(date_create());

$productType = "Seguro de Coche";
$promoText = "Eres un ELEGIDOR";
$officeName = "MAPFRE MADRID - Urb. CANILLEJAS";
$officeAddress = "ALCALA 599, MADRID (MADRID)";
$officePhone = "913717843";
$officeTimetable = "L-V 09:30-13:30 / 17:00-20:00";
$lat = 40.4465120;
$lng = -3.6127240;
$officeURL = "http://www.mapfre.es/wps/portal/redoficinasmapfre/oficinas/6219";

// Create a generic passbook
$pass = new Generic($passbookId, "Oficinas MAPFRE");
$pass->setBackgroundColor('rgb(186, 25, 0)');
$pass->setForegroundColor('rgb(255, 255, 255)');
$pass->setLabelColor('rgb(244, 194, 194)');
$pass->setLogoText($productType);

// Create pass structure
$structure = new Structure();

// Add primary field
$primary = new Field('about', $promoText);
$primary->setLabel('Información adicional');
$structure->addPrimaryField($primary);

// Add secondary field
$secondary = new Field('location', $officeName);
$secondary->setLabel('Oficina');
$structure->addSecondaryField($secondary);

// Add auxiliary field
$auxiliary = new Field('location', $officeAddress);
$auxiliary->setLabel('Dirección');
$structure->addAuxiliaryField($auxiliary);

// Add back field
$back = new Field('info', $promoText);
$back->setLabel('Información adicional');
$structure->addBackField($back);

// Add back field
$back = new Field('info', $officeName);
$back->setLabel('Oficina');
$structure->addBackField($back);
$back = new Field('info', $officeAddress);
$back->setLabel('Dirección oficina');
$structure->addBackField($back);
$back = new Field('info', $officePhone);
$back->setLabel('Teléfono');
$structure->addBackField($back);
$back = new Field('info', $officeTimetable);
$back->setLabel('Horario oficina');
$structure->addBackField($back);

// Add back field
$backLink = new Field('link', "<a href='".$officeURL."'>Accede aquí</a>");
$backLink->setLabel('Enlace');
$structure->addBackField($backLink);

$back = new Field('info', 'Infórmate en tu oficina');
$back->setLabel('');
$structure->addBackField($back);

// Add icon image
$icon = new Image('assets/images/icon.png', 'icon');
$pass->addImage($icon);

$icon = new Image('assets/images/thumbnail.png', 'thumbnail');
$icon->setIsRetina(true);
$pass->addImage($icon);

$image = new Image('assets/images/logomapfre.png', 'logo');
$image->setIsRetina(true);
$pass->addImage($image);

// Set pass structure
$pass->setStructure($structure);

// Add url
$barcode = new Barcode(Barcode::TYPE_QR, $officeURL);
$pass->setBarcode($barcode);

// Add location
if($lat != null && $lng != null) {
    $location = new Location($lat, $lng);
    $location->setRelevantText($promoText);
    $pass->addLocation($location);
}

// Create pass factory instance
$factory = new PassFactory('pass.com.okode.passbooktest', '83H5GV742F', 'MAPFRE', 'assets/cert/passbook_okode.p12', '0k0d3', 'assets/cert/AppleWDRCA.pem');
$factory->setOutputPath('/tmp/');
$passbook = $factory->package($pass);

// Send the right headers
header('Content-Type: application/vnd.apple.pkpass');
header('Content-Disposition: attachment; filename="'.$passbookId.'.pkpass"');
// Dump the passbook and end script
$passbook->fpassthru();
exit;
