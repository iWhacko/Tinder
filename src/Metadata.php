<?php
/**
 * Short description for class
 *
 * Long description for class (if any)...
 *
 * @package    Tinder
 * @author     Ally Dewar <ally.dewar@adewra.com>
 * @copyright  2015 Adewra Ltd
 * @created      26/02/15 11:21
 */

namespace Adewra\Tinder;

class Metadata {

    private $status;
    private $notifications = array();
    private $groups = array();
    private $rating;
    private $travel;
    private $versions = array();
    private $globals = array();
    private $purchases = array();

    function __construct()
    {

    }

    public function loadFromResponse($response)
    {
        if(isset($authenticationResponse['status']))
            $this->setStatus($authenticationResponse['status']);

        if(isset($authenticationResponse['notifications']))
            $this->setNotifications($authenticationResponse['notifications']);

        if(isset($authenticationResponse['groups']))
            $this->setGroups($authenticationResponse['groups']);

        if(isset($authenticationResponse['rating']))
            $this->setRating($authenticationResponse['rating']);

        if(isset($authenticationResponse['travel']))
            $this->setTravel($authenticationResponse['travel']);

        if(isset($authenticationResponse['purchases']))
            $this->setPurchases($authenticationResponse['purchases']);

        if(isset($authenticationResponse['versions']))
            $this->setVersions($authenticationResponse['versions']);

        if(isset($authenticationResponse['globals']))
            $this->setGlobals($authenticationResponse['globals']);
    }

    public function getStatus()
    {
        return $this->status;
    }

    private function setStatus($status)
    {
        $this->status = $status;
    }

    public function getNotifications()
    {
        return $this->notifications;
    }

    private function setNotifications($notifications)
    {
        foreach($notifications as $notification)
        {
            $this->addNotification($notification);
        }
    }

    private function addNotification($notification)
    {
        array_push($this->notifications, $notification);
    }

    public function getGroups()
    {
        return $this->groups;
    }

    private function setGroups($groups)
    {
        foreach($groups as $group)
        {
            $groupObject = new Metadata\Group();
            $groupObject->loadFromResponse($group);
            $this->addGroup($group);
        }
    }

    private function addGroup(Group $group)
    {
        array_push($this->groups, $group);
    }

    public function getRating()
    {
        return $this->rating;
    }

    private function setRating($rating)
    {
        $rating = new Metadata\Rating();
        $rating->loadFromResponse($rating);
        $this->rating = $rating;
    }

    public function getTravel()
    {
        return $this->travel;
    }

    private function setTravel($travel)
    {
        $travel = new Metadata\Travel();
        $travel->loadFromResponse($travel);
        $this->travel = $travel;
    }

    public function getPurchases()
    {
        return $this->purchases;
    }

    private function setPurchases($purchases)
    {
        foreach($purchases as $purchase)
        {
            $this->addPurchase($purchase);
        }
    }

    private function addPurchase($purchase)
    {
        array_push($this->purchases, $purchase);
    }

    public function getVersions()
    {
        return $this->versions;
    }

    private function setVersions($versions)
    {
        $versions = new Metadata\Versions();
        $versions->loadFromResponse($versions);
        $this->versions = $versions;
    }

    public function getGlobals()
    {
        return $this->globals;
    }

    private function setGlobals($globals)
    {
        /*
         *  ["globals"]=>
              array(18) {
                ["friends"]=>
                bool(true)
                ["invite_type"]=>
                string(6) "client"
                ["recs_interval"]=>
                int(20000)
                ["updates_interval"]=>
                int(2000)
                ["recs_size"]=>
                int(40)
                ["matchmaker_default_message"]=>
                string(75) "I want you to meet someone. I introduced you on Tinder www.gotinder.com/app"
                ["share_default_text"]=>
                string(312) "<style>body{color:#fff;text-align:center;font-family:HelveticaNeue;text-shadow:0 1px 1px rgba(0,0,0,0.63);}h1{font-size:24px;line-height:24px;margin:0;}p{font-size:16px;margin:8px;}</style><h1>Get a Boost</h1><p><strong>Invite friends</strong> to show up <br/><strong>even higher</strong> in recommendations.</p>"
                ["boost_decay"]=>
                int(180)
                ["boost_up"]=>
                int(7)
                ["boost_down"]=>
                int(8)
                ["sparks"]=>
                bool(false)
                ["kontagent"]=>
                bool(false)
                ["sparks_enabled"]=>
                bool(false)
                ["kontagent_enabled"]=>
                bool(false)
                ["mqtt"]=>
                bool(false)
                ["tinder_sparks"]=>
                bool(true)
                ["moments_interval"]=>
                int(30000)
                ["plus"]=>
                bool(true)
              }

         */

        foreach($globals as $global)
        {
            $this->addGlobal($global);
        }
    }

    private function addGlobal($global)
    {
        array_push($this->globals, $global);
    }
}