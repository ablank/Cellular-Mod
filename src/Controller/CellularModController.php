<?php 

namespace Drupal\cellular_mod\Controller;

use Drupal\Core\Controller\ControllerBase;

class CellularModController extends ControllerBase {

    public function lipsum() {
        return [
            '#type' => 'markup',
            '#markup' => t('Hello world from cellular!')
        ];
    }

}