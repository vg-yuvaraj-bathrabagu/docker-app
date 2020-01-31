<?php
/**
 * Base class for all entities that are tied to an account, it provides the mapping to an account and any custom queries that may be required to reduce duplication
 *
 *
 */

namespace App\Entity\Traits;

use App\Entity\Account;
use Doctrine\ORM\Mapping as ORM;

trait AccountField
{

    /**
     * @var Account
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Account", fetch="EAGER")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     *
     */
    private $account;

    private function getAccount(): Account
    {
        return $this->account;
    }
    public function setAccount(Account $account){
        $this->account = $account;
    }
}