<?php
/**
 * Base Controller providing access to commonly required
 */

namespace App\Controller;


use App\Entity\Account;
use App\Helper\Utils;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    use Utils;

    /**
     * @return mixed The numeric id for the id of the logged in user
     */
    public function getAccountId() {
        return $this->getAccountIdForLoggedInUser($this->getUser());
    }

    /**
     * @return mixed The name of the S3 folder for the account for the logged in user
     */
    public function getS3FolderNameForAccount(): string {
        return preg_replace('/[^0-9a-zA-Z]/', '',$this->getAccountNameForLoggedInUser($this->getUser()));
    }

    /**
     * @return mixed The username of the logged in user
     */
    public function getUserName() {
        return $this->getLoggedInUsername($this->getUser());
    }

    /**
     * @return mixed The userid of the logged in user
     */
    public function getUserId() {
        return $this->getUser()->getUsername();
    }

    /**
     * @return the Account instance
     */
    public function getAccount(): Account {
        return $this->getAccountForLoggedInUser($this->getUser());
    }




}