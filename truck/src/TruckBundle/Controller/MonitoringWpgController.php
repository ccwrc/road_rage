<?php

namespace TruckBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

use TruckBundle\Entity\Monitoring;
// forms
use \DateTime;

/**
 * @Route("/monitoring")
 * @Security("has_role('ROLE_OPERATOR')")
 */
class MonitoringEndController extends MonitoringController {




}
