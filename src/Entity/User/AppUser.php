<?php

namespace App\Entity\User;

use App\Entity\Traits\AccountField;
use App\Helper\Accessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use MsgPhp\Domain\Event\DomainEventHandlerInterface;
use MsgPhp\Domain\Event\DomainEventHandlerTrait;
use MsgPhp\User\Entity\Credential\EmailPassword;
use MsgPhp\User\Entity\Features\EmailPasswordCredential;
use MsgPhp\User\Entity\Features\ResettablePassword;
use MsgPhp\User\Entity\Fields\RolesField;
use MsgPhp\User\Entity\User as BaseUser;
use MsgPhp\User\Password\PasswordHashing;
use MsgPhp\User\UserIdInterface;

/**
 * @ORM\Table(name="app_user")
 * @ORM\Entity(repositoryClass="App\Repository\AppUserRepository")
 */
class AppUser extends BaseUser implements DomainEventHandlerInterface, \Serializable
{
    use DomainEventHandlerTrait;
    use EmailPasswordCredential;
    use ResettablePassword;
    use RolesField;
    use Accessor;
    use AccountField;

    /** @ORM\Id() @ORM\Column(type="msgphp_user_id") */
    private $id;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="employeetemplateid", type="bigint", nullable=true)
     */
    private $employeetemplateid;

    /**
     * @var string
     *
     * @ORM\Column(name="salutation", type="string", length=25, nullable=true)
     */
    private $salutation;
    /**
     * @var string
     *
     * @ORM\Column(name="credential_nickname", type="string", length=25, nullable=true)
     */
    private $nickname;
    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=false)
     */
    protected $firstname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="middlename", type="string", length=255, nullable=true)
     */
    private $middlename;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=false)
     */
    protected $lastname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="initials", type="string", length=255, nullable=true)
     */
    private $initials;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", nullable=true)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="jobtitle", type="string", length=255, nullable=false)
     */
    private $jobtitle = '';

    /**
     * @var string
     *
     * @ORM\Column(name="blccode", type="string", length=255, nullable=true)
     */
    private $blccode;

    /**
     * @var string
     *
     * @ORM\Column(name="jobcategory", type="string", length=255, nullable=true)
     */
    private $jobcategory;

    /**
     * @var string
     *
     * @ORM\Column(name="department", type="string", length=255, nullable=true)
     */
    private $department;

    /**
     * @var string
     *
     * @ORM\Column(name="joblocation", type="string", length=255, nullable=true)
     */
    private $joblocation;

    /**
     * @var string
     *
     * @ORM\Column(name="employeetype", type="string", length=10, nullable=true)
     */
    private $employeetype;

    /**
     * @var string
     *
     * @ORM\Column(name="rateperhour", type="string", length=10, nullable=false)
     */
    private $rateperhour = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="personalemailaddress", type="string", length=255, nullable=true)
     */
    private $personalemailaddress;
    /**
     * @var string
     *
     * @ORM\Column(name="uuid", type="string", length=38, nullable=false)
     */
    private $uuid;
    /**
     * @var string
     *
     * @ORM\Column(name="snstopic", type="string", length=255, nullable=false)
     */
    private $snstopic = '';

    /**
     * @var string
     *
     * @ORM\Column(name="usertype", type="string", length=255, nullable=true)
     */
    private $usertype = 'Normal';
    /**
     * @var string
     *
     * @ORM\Column(name="employeecategory", type="string", length=255, nullable=true)
     */
    private $employeecategory;
    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true)
     */
    private $status;
    /**
     * @var string
     *
     * @ORM\Column(name="week_start", type="string", length=20, nullable=true)
     */
    private $week_start;
    /**
     * @var string
     *
     * @ORM\Column(name="hourly_wage", type="string", length=8, nullable=true)
     */
    private $hourlywage = 0;
    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;
    /**
     * @var string
     *
     * @ORM\Column(name="onvacation", type="string", length=255, nullable=true)
     */
    private $onvacation;
    /**
     * @var string
     *
     * @ORM\Column(name="mobilenumber", type="string", length=255, nullable=true)
     */
    private $mobilenumber;
    /**
     * @var string
     *
     * @ORM\Column(name="homephone", type="string", length=255, nullable=true)
     */
    private $homephone;
    /**
     * @var string
     *
     * @ORM\Column(name="officeline1", type="string", length=255, nullable=true)
     */
    private $officeline1;
    /**
     * @var string
     *
     * @ORM\Column(name="faxnumber", type="string", length=255, nullable=true)
     */
    private $faxnumber;
    /**
     * @var string
     *
     * @ORM\Column(name="address1", type="string", length=255, nullable=true)
     */
    private $address1;
    /**
     * @var string
     *
     * @ORM\Column(name="address2", type="string", length=255, nullable=true)
     */
    private $address2;
    /**
     * @var string
     *
     * @ORM\Column(name="stateorprovince", type="string", length=255, nullable=true)
     */
    private $stateorprovince;
    /**
     * @var string
     *
     * @ORM\Column(name="postalcode", type="string", length=255, nullable=true)
     */
    private $postalcode;
    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;
    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;
    /**
     * @var string
     *
     * @ORM\Column(name="companyname", type="string", length=255, nullable=true)
     */
    private $companyname;
    /**
     * @var string
     *
     * @ORM\Column(name="companyaddress", type="string", length=255, nullable=true)
     */
    private $companyaddress;
    /**
     * @var string
     *
     * @ORM\Column(name="ssn", type="string", length=255, nullable=true)
     */
    private $ssn;
    /**
     * @var string
     *
     * @ORM\Column(name="ein", type="string", length=255, nullable=true)
     */
    private $ein;
    /**
     * @var string
     *
     * @ORM\Column(name="tsgbadgenumber", type="string", length=255, nullable=true)
     */
    private $tsgbadgenumber;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="datetime", nullable=true)
     */
    private $birthdate;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hiredate", type="datetime", nullable=true)
     */
    private $hiredate;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="employeestartdate", type="datetime", nullable=true)
     */
    private $employeestartdate;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="employeeenddate", type="datetime", nullable=true)
     */
    private $employeeenddate;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="releasedate", type="datetime", nullable=true)
     */
    private $releasedate;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastreviewdate", type="datetime", nullable=true)
     */
    private $lastreviewdate;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="nextreviewdate", type="datetime", nullable=true)
     */
    private $nextreviewdate;
    /**
     * @var string
     *
     * @ORM\Column(name="supervisorname", type="string", length=255, nullable=true)
     */
    private $supervisorname;
    /**
     * @var string
     *
     * @ORM\Column(name="supervisoremail", type="string", length=255, nullable=true)
     */
    private $supervisoremail;
    /**
     * @var string
     *
     * @ORM\Column(name="supervisorofficeline", type="string", length=255, nullable=true)
     */
    private $supervisorofficeline;
    /**
     * @var string
     *
     * @ORM\Column(name="approver", type="string", length=255, nullable=true)
     */
    private $approver;
    /**
     * @var string
     *
     * @ORM\Column(name="approveremail", type="string", length=255, nullable=true)
     */
    private $approveremail;
    /**
     * @var string
     *
     * @ORM\Column(name="invoiceapprover", type="string", length=255, nullable=true)
     */
    private $invoiceapprover;
    /**
     * @var string
     *
     * @ORM\Column(name="invoiceapproveremail", type="string", length=255, nullable=true)
     */
    private $invoiceapproveremail;
    /**
     * @var string
     *
     * @ORM\Column(name="businessmeetingapprover", type="string", length=255, nullable=true)
     */
    private $businessmeetingapprover;
    /**
     * @var string
     *
     * @ORM\Column(name="businessmeetingapproveremail", type="string", length=255, nullable=true)
     */
    private $businessmeetingapproveremail;
    /**
     * @var string
     *
     * @ORM\Column(name="travelexpenseapprover", type="string", length=255, nullable=true)
     */
    private $travelexpenseapprover;
    /**
     * @var string
     *
     * @ORM\Column(name="travelexpenseapproveremail", type="string", length=255, nullable=true)
     */
    private $travelexpenseapproveremail;
    /**
     * @var string
     *
     * @ORM\Column(name="odcapprover", type="string", length=255, nullable=true)
     */
    private $odcapprover;
    /**
     * @var string
     *
     * @ORM\Column(name="odcapproveremail", type="string", length=255, nullable=true)
     */
    private $odcapproveremail;
    /**
     * @var string
     *
     * @ORM\Column(name="billsapprover", type="string", length=255, nullable=true)
     */
    private $billsapprover;
    /**
     * @var string
     *
     * @ORM\Column(name="billsapproveremail", type="string", length=255, nullable=true)
     */
    private $billsapproveremail;
    /**
     * @var string
     *
     * @ORM\Column(name="permissiontemplate", type="string", length=255, nullable=true)
     */
    private $permissiontemplate;
    /**
     * @var string
     *
     * @ORM\Column(name="canviewemployeeresources", type="string", nullable=true)
     */
    private $canviewemployeeresources = 'N';
    /**
     * @var string
     *
     * @ORM\Column(name="canviewpublicholidays", type="string", nullable=true)
     */
    private $canviewpublicholidays = 'N';
    /**
     * @var string
     *
     * @ORM\Column(name="canviewpayrolldates", type="string", nullable=true)
     */
    private $canviewpayrolldates = 'N';
    /**
     * @var string
     *
     * @ORM\Column(name="canviewtravelpolicy", type="string", nullable=true)
     */
    private $canviewtravelpolicy = 'N';
    /**
     * @var string
     *
     * @ORM\Column(name="canview401kinformation", type="string", nullable=true)
     */
    private $canview401kinformation = 'N';
    /**
     * @var string
     *
     * @ORM\Column(name="canviewreferenceinformation", type="string", nullable=true)
     */
    private $canviewreferenceinformation = 'N';
    /**
     * @var string
     *
     * @ORM\Column(name="payrollfrequency", type="string", nullable=true)
     */
    private $payrollfrequency;
    /**
     * @var string
     *
     * @ORM\Column(name="invoicecategory", type="string", nullable=true)
     */
    private $invoicecategory;
    /**
     * @var string
     *
     * @ORM\Column(name="maximumhoursperday", type="decimal", precision=10, scale=1, nullable=false)
     */
    private $maximumhoursperday = 8;
    /**
     * @var string
     *
     * @ORM\Column(name="maximumhoursperweek", type="decimal", precision=10, scale=1, nullable=false)
     */
    private $maximumhoursperweek = 40;
    /**
     * @var string
     *
     * @ORM\Column(name="vacationdaysallowed", type="string", nullable=true)
     */
    private $vacationdaysallowed = 'N';
    /**
     * @var string
     *
     * @ORM\Column(name="maximumvacationdays", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $maximumvacationdays = 0;
    /**
     * @var string
     *
     * @ORM\Column(name="personaldaysallowed", type="string", nullable=true)
     */
    private $personaldaysallowed = 'N';
    /**
     * @var string
     *
     * @ORM\Column(name="maximumpersonaldays", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $maximumpersonaldays = 0;
    /**
     * @var string
     *
     * @ORM\Column(name="paidholidaysallowed", type="string", nullable=true)
     */
    private $paidholidaysallowed = 'N';
    /**
     * @var string
     *
     * @ORM\Column(name="maximumpaidholidays", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $maximumpaidholidays = 0;
    /**
     * @var string
     *
     * @ORM\Column(name="sickdaysallowed", type="string", nullable=true)
     */
    private $sickdaysallowed = 'N';
    /**
     * @var string
     *
     * @ORM\Column(name="maximumsickdays", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $maximumsickdays = 0;
    /**
     * @var string
     *
     * @ORM\Column(name="saturdayworkallowed", type="string", nullable=true)
     */
    private $saturdayworkallowed = 'N';
    /**
     * @var string
     *
     * @ORM\Column(name="sundayworkallowed", type="string", nullable=true)
     */
    private $sundayworkallowed = 'N';
    /**
     * @var string
     *
     * @ORM\Column(name="publicholidayworkallowed", type="string", nullable=true)
     */
    private $publicholidayworkallowed = 'N';
    /**
     * @var string
     *
     * @ORM\Column(name="employeebenefitsbillable", type="string", nullable=true)
     */
    private $employeebenefitsbillable = 'N';
    /**
     * @var string
     *
     * @ORM\Column(name="maximumsocialsecurity", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $maximumsocialsecurity = 0;
    /**
     * @var string
     *
     * @ORM\Column(name="ec1_firstname", type="string", length=255, nullable=true)
     */
    private $ec1_firstname;
    /**
     * @var string
     *
     * @ORM\Column(name="ec1_lastname", type="string", length=255, nullable=true)
     */
    private $ec1_lastname;
    /**
     * @var string
     *
     * @ORM\Column(name="ec1_streetaddress", type="string", length=255, nullable=true)
     */
    private $ec1_streetaddress;
    /**
     * @var string
     *
     * @ORM\Column(name="ec1_city", type="string", length=255, nullable=true)
     */
    private $ec1_city;
    /**
     * @var string
     *
     * @ORM\Column(name="ec1_state", type="string", length=255, nullable=true)
     */
    private $ec1_state;
    /**
     * @var string
     *
     * @ORM\Column(name="ec1_zipcode", type="string", length=255, nullable=true)
     */
    private $ec1_zipcode;
    /**
     * @var string
     *
     * @ORM\Column(name="ec1_homephone", type="string", length=255, nullable=true)
     */
    private $ec1_homephone;
    /**
     * @var string
     *
     * @ORM\Column(name="ec1_workphone", type="string", length=255, nullable=true)
     */
    private $ec1_workphone;
    /**
     * @var string
     *
     * @ORM\Column(name="ec1_cellphone", type="string", length=255, nullable=true)
     */
    private $ec1_cellphone;
    /**
     * @var string
     *
     * @ORM\Column(name="ec1_relationship", type="string", length=255, nullable=true)
     */
    private $ec1_relationship;
    /**
     * @var string
     *
     * @ORM\Column(name="ec2_firstname", type="string", length=255, nullable=true)
     */
    private $ec2_firstname;
    /**
     * @var string
     *
     * @ORM\Column(name="ec2_lastname", type="string", length=255, nullable=true)
     */
    private $ec2_lastname;
    /**
     * @var string
     *
     * @ORM\Column(name="ec2_streetaddress", type="string", length=255, nullable=true)
     */
    private $ec2_streetaddress;
    /**
     * @var string
     *
     * @ORM\Column(name="ec2_city", type="string", length=255, nullable=true)
     */
    private $ec2_city;
    /**
     * @var string
     *
     * @ORM\Column(name="ec2_state", type="string", length=255, nullable=true)
     */
    private $ec2_state;
    /**
     * @var string
     *
     * @ORM\Column(name="ec2_zipcode", type="string", length=255, nullable=true)
     */
    private $ec2_zipcode;
    /**
     * @var string
     *
     * @ORM\Column(name="ec2_homephone", type="string", length=255, nullable=true)
     */
    private $ec2_homephone;
    /**
     * @var string
     *
     * @ORM\Column(name="ec2_workphone", type="string", length=255, nullable=true)
     */
    private $ec2_workphone;
    /**
     * @var string
     *
     * @ORM\Column(name="ec2_cellphone", type="string", length=255, nullable=true)
     */
    private $ec2_cellphone;
    /**
     * @var string
     *
     * @ORM\Column(name="ec2_relationship", type="string", length=255, nullable=true)
     */
    private $ec2_relationship;
    /**
     * @var string
     *
     * @ORM\Column(name="ec3_firstname", type="string", length=255, nullable=true)
     */
    private $ec3_firstname;
    /**
     * @var string
     *
     * @ORM\Column(name="ec3_lastname", type="string", length=255, nullable=true)
     */
    private $ec3_lastname;
    /**
     * @var string
     *
     * @ORM\Column(name="ec3_streetaddress", type="string", length=255, nullable=true)
     */
    private $ec3_streetaddress;
    /**
     * @var string
     *
     * @ORM\Column(name="ec3_city", type="string", length=255, nullable=true)
     */
    private $ec3_city;
    /**
     * @var string
     *
     * @ORM\Column(name="ec3_state", type="string", length=255, nullable=true)
     */
    private $ec3_state;
    /**
     * @var string
     *
     * @ORM\Column(name="ec3_zipcode", type="string", length=255, nullable=true)
     */
    private $ec3_zipcode;
    /**
     * @var string
     *
     * @ORM\Column(name="ec3_homephone", type="string", length=255, nullable=true)
     */
    private $ec3_homephone;
    /**
     * @var string
     *
     * @ORM\Column(name="ec3_workphone", type="string", length=255, nullable=true)
     */
    private $ec3_workphone;
    /**
     * @var string
     *
     * @ORM\Column(name="ec3_cellphone", type="string", length=255, nullable=true)
     */
    private $ec3_cellphone;
    /**
     * @var string
     *
     * @ORM\Column(name="ec3_relationship", type="string", length=255, nullable=true)
     */
    private $ec3_relationship;
    /**
     * @var string
     *
     * @ORM\Column(name="file_upload_location", type="string", nullable=false)
     */
    protected $fileuploadlocation;


    public function __construct(UserIdInterface $id, string $emailaddress, string $password)
    {
        $this->id = $id;
        $this->credential = new EmailPassword($emailaddress, $password);
        $this->roles = new ArrayCollection();
    }

    public function getId(): UserIdInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->credential->getEmail();
    }

    public function setEmail(string $emailaddress)
    {
        $this->credential->withEmail($emailaddress);
    }

    public function getPassword() {
        return $this->credential->getPassword();
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getNames(): string
    {
        return $this->firstname." ".$this->lastname;
    }

    /**
     * @return string
     */
    public function getEmailaddress(): string
    {
        return $this->emailaddress;
    }

    /**
     * @param string $emailaddress
     */
    public function setEmailaddress(string $emailaddress): void
    {
        $this->emailaddress = $emailaddress;
    }





    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->uuid,
            $this->getAccount(),
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->uuid,
            $this->account,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized, ['allowed_classes' => false]);
    }

    public function getPasswordHash() {
        $hash = new PasswordHashing($this->getCredential()->getPasswordAlgorithm());
        return $hash->hash($this->getPassword());
    }


    public function getPasswordHashFromPlainText($password) {
        $hash = new PasswordHashing($this->getCredential()->getPasswordAlgorithm());
        return $hash->hash($password);
    }

    public function isPasswordValid($plaintext) {
        $hash = new PasswordHashing($this->getCredential()->getPasswordAlgorithm());
        return $hash->isValid($this->getPassword(), $plaintext);

    }
    public function toArray() {
        return ['id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'emailaddress' => $this->getEmail(),
            'username' => $this->getNickname(),
            'uuid' => $this->uuid,
            'roles' => $this->getRolesAsArray(),
            'snstopic' => $this->snstopic,
            'initials' => $this->initials,
            'gender' => $this->gender,
            'jobtitle' => $this->jobtitle,
            'blccode' => $this->blccode,
            'jobcategory' => $this->jobcategory,
            'department' => $this->department,
            'joblocation' => $this->joblocation,
            'personalemailaddress' => $this->personalemailaddress,
            'usertype' => $this->usertype,
            'employeecategory' => $this->employeecategory,
            'status' => $this->status,
            'week_start' => $this->week_start,
            'hourlywage' => $this->hourlywage,
            'photo' => $this->photo,
            'onvacation' => $this->onvacation,
            'mobilenumber' => $this->mobilenumber,
            'homephone' => $this->homephone,
            'officeline1' => $this->officeline1,
            'faxnumber' => $this->faxnumber,
            'address1' => $this->address1,
            'address2' => $this->address2,
            'stateorprovince' => $this->stateorprovince,
            'postalcode' => $this->postalcode,
            'city' => $this->city,
            'country' => $this->country,
            'companyname' => $this->companyname,
            'companyaddress' => $this->companyaddress,
            'ssn' => $this->ssn,
            'ein' => $this->ein,
            'tsgbadgenumber' => $this->tsgbadgenumber,
            'employeetype' => $this->employeetype,
            'birthdate' => $this->birthdate,
            'hiredate' => $this->hiredate,
            'employeestartdate' => $this->employeestartdate,
            'employeeenddate' => $this->employeeenddate,
            'releasedate' => $this->releasedate,
            'lastreviewdate' => $this->lastreviewdate,
            'nextreviewdate' => $this->nextreviewdate,
            'supervisorname' => $this->supervisorname,
            'supervisoremail' => $this->supervisoremail,
            'supervisorofficeline' => $this->supervisorofficeline,
            'approver' => $this->approver,
            'approveremail' => $this->approveremail,
            'invoiceapprover' => $this->invoiceapprover,
            'invoiceapproveremail' => $this->invoiceapproveremail,
            'businessmeetingapprover' => $this->businessmeetingapprover,
            'businessmeetingapproveremail' => $this->businessmeetingapproveremail,
            'travelexpenseapprover' => $this->travelexpenseapprover,
            'travelexpenseapproveremail' => $this->travelexpenseapproveremail,
            'odcapprover' => $this->odcapprover,
            'odcapproveremail' => $this->odcapproveremail,
            'billsapprover' => $this->billsapprover,
            'billsapproveremail' => $this->billsapproveremail,
            'permissiontemplate' => $this->permissiontemplate,
            'canviewemployeeresources' => $this->canviewemployeeresources,
            'canviewpublicholidays' => $this->canviewpublicholidays,
            'canviewpayrolldates' => $this->canviewpayrolldates,
            'canviewtravelpolicy' => $this->canviewtravelpolicy,
            'canview401kinformation' => $this->canview401kinformation,
            'canviewreferenceinformation' => $this->canviewreferenceinformation,
            'payrollfrequency' => $this->payrollfrequency,
            'invoicecategory' => $this->invoicecategory,
            'maximumhoursperday' => $this->maximumhoursperday,
            'maximumhoursperweek' => $this->maximumhoursperweek,
            'vacationdaysallowed' => $this->vacationdaysallowed,
            'maximumvacationdays' => $this->maximumvacationdays,
            'personaldaysallowed' => $this->personaldaysallowed,
            'maximumpersonaldays' => $this->maximumpersonaldays,
            'paidholidaysallowed' => $this->paidholidaysallowed,
            'maximumpaidholidays' => $this->maximumpaidholidays,
            'sickdaysallowed' => $this->sickdaysallowed,
            'maximumsickdays' => $this->maximumsickdays,
            'saturdayworkallowed' => $this->saturdayworkallowed,
            'sundayworkallowed' => $this->sundayworkallowed,
            'publicholidayworkallowed' => $this->publicholidayworkallowed,
            'employeebenefitsbillable' => $this->employeebenefitsbillable,
            'maximumsocialsecurity' => $this->maximumsocialsecurity,
            'ec1_firstname' => $this->ec1_firstname,
            'ec1_lastname' => $this->ec1_lastname,
            'ec1_streetaddress' => $this->ec1_streetaddress,
            'ec1_city' => $this->ec1_city,
            'ec1_state' => $this->ec1_state,
            'ec1_zipcode' => $this->ec1_zipcode,
            'ec1_homephone' => $this->ec1_homephone,
            'ec1_workphone' => $this->ec1_workphone,
            'ec1_cellphone' => $this->ec1_cellphone,
            'ec1_relationship' => $this->ec1_relationship,
            'ec2_firstname' => $this->ec2_firstname,
            'ec2_lastname' => $this->ec2_lastname,
            'ec2_streetaddress' => $this->ec2_streetaddress,
            'ec2_city' => $this->ec2_city,
            'ec2_state' => $this->ec2_state,
            'ec2_zipcode' => $this->ec2_zipcode,
            'ec2_homephone' => $this->ec2_homephone,
            'ec2_workphone' => $this->ec2_workphone,
            'ec2_cellphone' => $this->ec2_cellphone,
            'ec2_relationship' => $this->ec2_relationship,
            'ec3_firstname' => $this->ec3_firstname,
            'ec3_lastname' => $this->ec3_lastname,
            'ec3_streetaddress' => $this->ec3_streetaddress,
            'ec3_city' => $this->ec3_city,
            'ec3_state' => $this->ec3_state,
            'ec3_zipcode' => $this->ec3_zipcode,
            'ec3_homephone' => $this->ec3_homephone,
            'ec3_workphone' => $this->ec3_workphone,
            'ec3_cellphone' => $this->ec3_cellphone,
            'ec3_relationship' => $this->ec3_relationship,
            'fileuploadlocation' => $this->fileuploadlocation
        ];
    }

    /**
     * Get the user roles as a string array to enable usage in the templates as a view
     *
     * @return array
     */
    public function getRolesAsArray() {
        $roles = $this->getRoles();
        $roles_array = [];
        foreach ($roles as $role) {
            $roles_array[$role->getRoleName()] = $role->getRoleName();
        }

        return $roles_array;
    }

    public function getAccountName() {
        $this->getAccount()->getName();
    }
    
    public function getUsername() {
        return $this->getId();
    }

    public function getUuid() {
        return $this->uuid;
    }

    public function getNickname() {
        return $this->nickname;
    }

    /**
     * @return int
     */
    public function getEmployeetemplateid(): int
    {
        return $this->employeetemplateid;
    }

    /**
     * @param int $employeetemplateid
     */
    public function setEmployeetemplateid(int $employeetemplateid): void
    {
        $this->employeetemplateid = $employeetemplateid;
    }

    /**
     * @return string
     */
    public function getSalutation(): string
    {
        return $this->salutation;
    }

    /**
     * @param string $salutation
     */
    public function setSalutation(string $salutation): void
    {
        $this->salutation = $salutation;
    }

    /**
     * @return string
     */
    public function getMiddlename(): string
    {
        return $this->middlename;
    }

    /**
     * @param string $middlename
     */
    public function setMiddlename(string $middlename): void
    {
        $this->middlename = $middlename;
    }

    /**
     * @return string
     */
    public function getInitials(): string
    {
        return $this->initials;
    }

    /**
     * @param string $initials
     */
    public function setInitials(string $initials): void
    {
        $this->initials = $initials;
    }

    /**
     * @return string
     */
    public function getGender(): string
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return string
     */
    public function getJobtitle(): string
    {
        return $this->jobtitle;
    }

    /**
     * @param string $jobtitle
     */
    public function setJobtitle(string $jobtitle): void
    {
        $this->jobtitle = $jobtitle;
    }

    /**
     * @return string
     */
    public function getBlccode(): string
    {
        return $this->blccode;
    }

    /**
     * @param string $blccode
     */
    public function setBlccode(string $blccode): void
    {
        $this->blccode = $blccode;
    }

    /**
     * @return string
     */
    public function getJobcategory(): string
    {
        return $this->jobcategory;
    }

    /**
     * @param string $jobcategory
     */
    public function setJobcategory(string $jobcategory): void
    {
        $this->jobcategory = $jobcategory;
    }

    /**
     * @return string
     */
    public function getDepartment(): string
    {
        return $this->department;
    }

    /**
     * @param string $department
     */
    public function setDepartment(string $department): void
    {
        $this->department = $department;
    }

    /**
     * @return string
     */
    public function getJoblocation(): string
    {
        return $this->joblocation;
    }

    /**
     * @param string $joblocation
     */
    public function setJoblocation(string $joblocation): void
    {
        $this->joblocation = $joblocation;
    }

    /**
     * @return string
     */
    public function getEmployeetype(): string
    {
        return $this->employeetype;
    }

    /**
     * @param string $employeetype
     */
    public function setEmployeetype(string $employeetype): void
    {
        $this->employeetype = $employeetype;
    }

    /**
     * @return string
     */
    public function getRateperhour(): string
    {
        return $this->rateperhour;
    }

    /**
     * @param string $rateperhour
     */
    public function setRateperhour(string $rateperhour): void
    {
        $this->rateperhour = $rateperhour;
    }

    /**
     * @return string
     */
    public function getPersonalemailaddress(): string
    {
        return $this->personalemailaddress;
    }

    /**
     * @param string $personalemailaddress
     */
    public function setPersonalemailaddress(string $personalemailaddress): void
    {
        $this->personalemailaddress = $personalemailaddress;
    }

    /**
     * @return string
     */
    public function getSnstopic(): string
    {
        return $this->snstopic;
    }

    /**
     * @param string $snstopic
     */
    public function setSnstopic(string $snstopic): void
    {
        $this->snstopic = $snstopic;
    }

    /**
     * @return string
     */
    public function getUsertype(): string
    {
        return $this->usertype;
    }

    /**
     * @param string $usertype
     */
    public function setUsertype(string $usertype): void
    {
        $this->usertype = $usertype;
    }

    /**
     * @return string
     */
    public function getEmployeecategory(): string
    {
        return $this->employeecategory;
    }

    /**
     * @param string $employeecategory
     */
    public function setEmployeecategory(string $employeecategory): void
    {
        $this->employeecategory = $employeecategory;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getWeekStart(): string
    {
        return $this->week_start;
    }

    /**
     * @param string $week_start
     */
    public function setWeekStart(string $week_start): void
    {
        $this->week_start = $week_start;
    }

    /**
     * @return string
     */
    public function getHourlywage(): string
    {
        return $this->hourlywage;
    }

    /**
     * @param string $hourlywage
     */
    public function setHourlywage(string $hourlywage): void
    {
        $this->hourlywage = $hourlywage;
    }

    /**
     * @return string
     */
    public function getPhoto(): string
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto(string $photo): void
    {
        $this->photo = $photo;
    }

    /**
     * @return string
     */
    public function getOnvacation(): string
    {
        return $this->onvacation;
    }

    /**
     * @param string $onvacation
     */
    public function setOnvacation(string $onvacation): void
    {
        $this->onvacation = $onvacation;
    }

    /**
     * @return string
     */
    public function getMobilenumber(): string
    {
        return $this->mobilenumber;
    }

    /**
     * @param string $mobilenumber
     */
    public function setMobilenumber(string $mobilenumber): void
    {
        $this->mobilenumber = $mobilenumber;
    }

    /**
     * @return string
     */
    public function getHomephone(): string
    {
        return $this->homephone;
    }

    /**
     * @param string $homephone
     */
    public function setHomephone(string $homephone): void
    {
        $this->homephone = $homephone;
    }

    /**
     * @return string
     */
    public function getOfficeline1(): string
    {
        return $this->officeline1;
    }

    /**
     * @param string $officeline1
     */
    public function setOfficeline1(string $officeline1): void
    {
        $this->officeline1 = $officeline1;
    }

    /**
     * @return string
     */
    public function getFaxnumber(): string
    {
        return $this->faxnumber;
    }

    /**
     * @param string $faxnumber
     */
    public function setFaxnumber(string $faxnumber): void
    {
        $this->faxnumber = $faxnumber;
    }

    /**
     * @return string
     */
    public function getAddress1(): string
    {
        return $this->address1;
    }

    /**
     * @param string $address1
     */
    public function setAddress1(string $address1): void
    {
        $this->address1 = $address1;
    }

    /**
     * @return string
     */
    public function getAddress2(): string
    {
        return $this->address2;
    }

    /**
     * @param string $address2
     */
    public function setAddress2(string $address2): void
    {
        $this->address2 = $address2;
    }

    /**
     * @return string
     */
    public function getStateorprovince(): string
    {
        return $this->stateorprovince;
    }

    /**
     * @param string $stateorprovince
     */
    public function setStateorprovince(string $stateorprovince): void
    {
        $this->stateorprovince = $stateorprovince;
    }

    /**
     * @return string
     */
    public function getPostalcode(): string
    {
        return $this->postalcode;
    }

    /**
     * @param string $postalcode
     */
    public function setPostalcode(string $postalcode): void
    {
        $this->postalcode = $postalcode;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getCompanyname(): string
    {
        return $this->companyname;
    }

    /**
     * @param string $companyname
     */
    public function setCompanyname(string $companyname): void
    {
        $this->companyname = $companyname;
    }

    /**
     * @return string
     */
    public function getCompanyaddress(): string
    {
        return $this->companyaddress;
    }

    /**
     * @param string $companyaddress
     */
    public function setCompanyaddress(string $companyaddress): void
    {
        $this->companyaddress = $companyaddress;
    }

    /**
     * @return string
     */
    public function getSsn(): string
    {
        return $this->ssn;
    }

    /**
     * @param string $ssn
     */
    public function setSsn(string $ssn): void
    {
        $this->ssn = $ssn;
    }

    /**
     * @return string
     */
    public function getEin(): string
    {
        return $this->ein;
    }

    /**
     * @param string $ein
     */
    public function setEin(string $ein): void
    {
        $this->ein = $ein;
    }

    /**
     * @return string
     */
    public function getTsgbadgenumber(): string
    {
        return $this->tsgbadgenumber;
    }

    /**
     * @param string $tsgbadgenumber
     */
    public function setTsgbadgenumber(string $tsgbadgenumber): void
    {
        $this->tsgbadgenumber = $tsgbadgenumber;
    }

    /**
     * @return \DateTime
     */
    public function getBirthdate(): \DateTime
    {
        return $this->birthdate;
    }

    /**
     * @param \DateTime $birthdate
     */
    public function setBirthdate(\DateTime $birthdate): void
    {
        $this->birthdate = $birthdate;
    }

    /**
     * @return \DateTime
     */
    public function getHiredate(): \DateTime
    {
        return $this->hiredate;
    }

    /**
     * @param \DateTime $hiredate
     */
    public function setHiredate(\DateTime $hiredate): void
    {
        $this->hiredate = $hiredate;
    }

    /**
     * @return \DateTime
     */
    public function getEmployeestartdate(): \DateTime
    {
        return $this->employeestartdate;
    }

    /**
     * @param \DateTime $employeestartdate
     */
    public function setEmployeestartdate(\DateTime $employeestartdate): void
    {
        $this->employeestartdate = $employeestartdate;
    }

    /**
     * @return \DateTime
     */
    public function getEmployeeenddate():? \DateTime
    {
        return $this->employeeenddate;
    }

    /**
     * @param \DateTime $employeeenddate
     */
    public function setEmployeeenddate(\DateTime $employeeenddate): void
    {
        $this->employeeenddate = $employeeenddate;
    }

    /**
     * @return \DateTime
     */
    public function getReleasedate(): \DateTime
    {
        return $this->releasedate;
    }

    /**
     * @param \DateTime $releasedate
     */
    public function setReleasedate(\DateTime $releasedate): void
    {
        $this->releasedate = $releasedate;
    }

    /**
     * @return \DateTime
     */
    public function getLastreviewdate(): \DateTime
    {
        return $this->lastreviewdate;
    }

    /**
     * @param \DateTime $lastreviewdate
     */
    public function setLastreviewdate(\DateTime $lastreviewdate): void
    {
        $this->lastreviewdate = $lastreviewdate;
    }

    /**
     * @return \DateTime
     */
    public function getNextreviewdate(): \DateTime
    {
        return $this->nextreviewdate;
    }

    /**
     * @param \DateTime $nextreviewdate
     */
    public function setNextreviewdate(\DateTime $nextreviewdate): void
    {
        $this->nextreviewdate = $nextreviewdate;
    }

    /**
     * @return string
     */
    public function getSupervisorname(): string
    {
        return $this->supervisorname;
    }

    /**
     * @param string $supervisorname
     */
    public function setSupervisorname(string $supervisorname): void
    {
        $this->supervisorname = $supervisorname;
    }

    /**
     * @return string
     */
    public function getSupervisoremail(): string
    {
        return $this->supervisoremail;
    }

    /**
     * @param string $supervisoremail
     */
    public function setSupervisoremail(string $supervisoremail): void
    {
        $this->supervisoremail = $supervisoremail;
    }

    /**
     * @return string
     */
    public function getSupervisorofficeline(): string
    {
        return $this->supervisorofficeline;
    }

    /**
     * @param string $supervisorofficeline
     */
    public function setSupervisorofficeline(string $supervisorofficeline): void
    {
        $this->supervisorofficeline = $supervisorofficeline;
    }

    /**
     * @return string
     */
    public function getApprover(): string
    {
        return $this->approver;
    }

    /**
     * @param string $approver
     */
    public function setApprover(string $approver): void
    {
        $this->approver = $approver;
    }

    /**
     * @return string
     */
    public function getApproveremail(): string
    {
        return $this->approveremail;
    }

    /**
     * @param string $approveremail
     */
    public function setApproveremail(string $approveremail): void
    {
        $this->approveremail = $approveremail;
    }

    /**
     * @return string
     */
    public function getInvoiceapprover(): string
    {
        return $this->invoiceapprover;
    }

    /**
     * @param string $invoiceapprover
     */
    public function setInvoiceapprover(string $invoiceapprover): void
    {
        $this->invoiceapprover = $invoiceapprover;
    }

    /**
     * @return string
     */
    public function getInvoiceapproveremail(): string
    {
        return $this->invoiceapproveremail;
    }

    /**
     * @param string $invoiceapproveremail
     */
    public function setInvoiceapproveremail(string $invoiceapproveremail): void
    {
        $this->invoiceapproveremail = $invoiceapproveremail;
    }

    /**
     * @return string
     */
    public function getBusinessmeetingapprover(): string
    {
        return $this->businessmeetingapprover;
    }

    /**
     * @param string $businessmeetingapprover
     */
    public function setBusinessmeetingapprover(string $businessmeetingapprover): void
    {
        $this->businessmeetingapprover = $businessmeetingapprover;
    }

    /**
     * @return string
     */
    public function getBusinessmeetingapproveremail(): string
    {
        return $this->businessmeetingapproveremail;
    }

    /**
     * @param string $businessmeetingapproveremail
     */
    public function setBusinessmeetingapproveremail(string $businessmeetingapproveremail): void
    {
        $this->businessmeetingapproveremail = $businessmeetingapproveremail;
    }

    /**
     * @return string
     */
    public function getTravelexpenseapprover(): string
    {
        return $this->travelexpenseapprover;
    }

    /**
     * @param string $travelexpenseapprover
     */
    public function setTravelexpenseapprover(string $travelexpenseapprover): void
    {
        $this->travelexpenseapprover = $travelexpenseapprover;
    }

    /**
     * @return string
     */
    public function getTravelexpenseapproveremail(): string
    {
        return $this->travelexpenseapproveremail;
    }

    /**
     * @param string $travelexpenseapproveremail
     */
    public function setTravelexpenseapproveremail(string $travelexpenseapproveremail): void
    {
        $this->travelexpenseapproveremail = $travelexpenseapproveremail;
    }

    /**
     * @return string
     */
    public function getOdcapprover(): string
    {
        return $this->odcapprover;
    }

    /**
     * @param string $odcapprover
     */
    public function setOdcapprover(string $odcapprover): void
    {
        $this->odcapprover = $odcapprover;
    }

    /**
     * @return string
     */
    public function getOdcapproveremail(): string
    {
        return $this->odcapproveremail;
    }

    /**
     * @param string $odcapproveremail
     */
    public function setOdcapproveremail(string $odcapproveremail): void
    {
        $this->odcapproveremail = $odcapproveremail;
    }

    /**
     * @return string
     */
    public function getBillsapprover(): string
    {
        return $this->billsapprover;
    }

    /**
     * @param string $billsapprover
     */
    public function setBillsapprover(string $billsapprover): void
    {
        $this->billsapprover = $billsapprover;
    }

    /**
     * @return string
     */
    public function getBillsapproveremail(): string
    {
        return $this->billsapproveremail;
    }

    /**
     * @param string $billsapproveremail
     */
    public function setBillsapproveremail(string $billsapproveremail): void
    {
        $this->billsapproveremail = $billsapproveremail;
    }

    /**
     * @return string
     */
    public function getPermissiontemplate(): string
    {
        return $this->permissiontemplate;
    }

    /**
     * @param string $permissiontemplate
     */
    public function setPermissiontemplate(string $permissiontemplate): void
    {
        $this->permissiontemplate = $permissiontemplate;
    }

    /**
     * @return string
     */
    public function getCanviewmployeeresources(): string
    {
        return $this->canviewmployeeresources;
    }

    /**
     * @param string $canviewmployeeresources
     */
    public function setCanviewmployeeresources(string $canviewmployeeresources): void
    {
        $this->canviewmployeeresources = $canviewmployeeresources;
    }

    /**
     * @return string
     */
    public function getCanviewpublicholidays(): string
    {
        return $this->canviewpublicholidays;
    }

    /**
     * @param string $canviewpublicholidays
     */
    public function setCanviewpublicholidays(string $canviewpublicholidays): void
    {
        $this->canviewpublicholidays = $canviewpublicholidays;
    }

    /**
     * @return string
     */
    public function getCanviewpayrolldates(): string
    {
        return $this->canviewpayrolldates;
    }

    /**
     * @param string $canviewpayrolldates
     */
    public function setCanviewpayrolldates(string $canviewpayrolldates): void
    {
        $this->canviewpayrolldates = $canviewpayrolldates;
    }

    /**
     * @return string
     */
    public function getCanviewtravelpolicy(): string
    {
        return $this->canviewtravelpolicy;
    }

    /**
     * @param string $canviewtravelpolicy
     */
    public function setCanviewtravelpolicy(string $canviewtravelpolicy): void
    {
        $this->canviewtravelpolicy = $canviewtravelpolicy;
    }

    /**
     * @return string
     */
    public function getCanview401kinformation(): string
    {
        return $this->canview401kinformation;
    }

    /**
     * @param string $canview401kinformation
     */
    public function setCanview401kinformation(string $canview401kinformation): void
    {
        $this->canview401kinformation = $canview401kinformation;
    }

    /**
     * @return string
     */
    public function getCanviewreferenceinformation(): string
    {
        return $this->canviewreferenceinformation;
    }

    /**
     * @param string $canviewreferenceinformation
     */
    public function setCanviewreferenceinformation(string $canviewreferenceinformation): void
    {
        $this->canviewreferenceinformation = $canviewreferenceinformation;
    }

    /**
     * @return string
     */
    public function getPayrollfrequency(): string
    {
        return $this->payrollfrequency;
    }

    /**
     * @param string $payrollfrequency
     */
    public function setPayrollfrequency(string $payrollfrequency): void
    {
        $this->payrollfrequency = $payrollfrequency;
    }

    /**
     * @return string
     */
    public function getInvoicecategory(): string
    {
        return $this->invoicecategory;
    }

    /**
     * @param string $invoicecategory
     */
    public function setInvoicecategory(string $invoicecategory): void
    {
        $this->invoicecategory = $invoicecategory;
    }

    /**
     * @return string
     */
    public function getMaximumhoursperday(): string
    {
        return $this->maximumhoursperday;
    }

    /**
     * @param string $maximumhoursperday
     */
    public function setMaximumhoursperday(string $maximumhoursperday): void
    {
        $this->maximumhoursperday = $maximumhoursperday;
    }

    /**
     * @return string
     */
    public function getMaximumhoursperweek(): string
    {
        return $this->maximumhoursperweek;
    }

    /**
     * @param string $maximumhoursperweek
     */
    public function setMaximumhoursperweek(string $maximumhoursperweek): void
    {
        $this->maximumhoursperweek = $maximumhoursperweek;
    }

    /**
     * @return string
     */
    public function getVacationdaysallowed(): string
    {
        return $this->vacationdaysallowed;
    }

    /**
     * @param string $vacationdaysallowed
     */
    public function setVacationdaysallowed(string $vacationdaysallowed): void
    {
        $this->vacationdaysallowed = $vacationdaysallowed;
    }

    /**
     * @return string
     */
    public function getMaximumvacationdays(): string
    {
        return $this->maximumvacationdays;
    }

    /**
     * @param string $maximumvacationdays
     */
    public function setMaximumvacationdays(string $maximumvacationdays): void
    {
        $this->maximumvacationdays = $maximumvacationdays;
    }

    /**
     * @return string
     */
    public function getPersonaldaysallowed(): string
    {
        return $this->personaldaysallowed;
    }

    /**
     * @param string $personaldaysallowed
     */
    public function setPersonaldaysallowed(string $personaldaysallowed): void
    {
        $this->personaldaysallowed = $personaldaysallowed;
    }

    /**
     * @return string
     */
    public function getMaximumpersonaldays(): string
    {
        return $this->maximumpersonaldays;
    }

    /**
     * @param string $maximumpersonaldays
     */
    public function setMaximumpersonaldays(string $maximumpersonaldays): void
    {
        $this->maximumpersonaldays = $maximumpersonaldays;
    }

    /**
     * @return string
     */
    public function getPaidholidaysallowed(): string
    {
        return $this->paidholidaysallowed;
    }

    /**
     * @param string $paidholidaysallowed
     */
    public function setPaidholidaysallowed(string $paidholidaysallowed): void
    {
        $this->paidholidaysallowed = $paidholidaysallowed;
    }

    /**
     * @return string
     */
    public function getMaximumpaidholidays(): string
    {
        return $this->maximumpaidholidays;
    }

    /**
     * @param string $maximumpaidholidays
     */
    public function setMaximumpaidholidays(string $maximumpaidholidays): void
    {
        $this->maximumpaidholidays = $maximumpaidholidays;
    }

    /**
     * @return string
     */
    public function getSickdaysallowed(): string
    {
        return $this->sickdaysallowed;
    }

    /**
     * @param string $sickdaysallowed
     */
    public function setSickdaysallowed(string $sickdaysallowed): void
    {
        $this->sickdaysallowed = $sickdaysallowed;
    }

    /**
     * @return string
     */
    public function getMaximumsickdays(): string
    {
        return $this->maximumsickdays;
    }

    /**
     * @param string $maximumsickdays
     */
    public function setMaximumsickdays(string $maximumsickdays): void
    {
        $this->maximumsickdays = $maximumsickdays;
    }

    /**
     * @return string
     */
    public function getSaturdayworkallowed(): string
    {
        return $this->saturdayworkallowed;
    }

    /**
     * @param string $saturdayworkallowed
     */
    public function setSaturdayworkallowed(string $saturdayworkallowed): void
    {
        $this->saturdayworkallowed = $saturdayworkallowed;
    }

    /**
     * @return string
     */
    public function getSundayworkallowed(): string
    {
        return $this->sundayworkallowed;
    }

    /**
     * @param string $sundayworkallowed
     */
    public function setSundayworkallowed(string $sundayworkallowed): void
    {
        $this->sundayworkallowed = $sundayworkallowed;
    }

    /**
     * @return string
     */
    public function getPublicholidayworkallowed(): string
    {
        return $this->publicholidayworkallowed;
    }

    /**
     * @param string $publicholidayworkallowed
     */
    public function setPublicholidayworkallowed(string $publicholidayworkallowed): void
    {
        $this->publicholidayworkallowed = $publicholidayworkallowed;
    }

    /**
     * @return string
     */
    public function getEmployeebenefitsbillable(): string
    {
        return $this->employeebenefitsbillable;
    }

    /**
     * @param string $employeebenefitsbillable
     */
    public function setEmployeebenefitsbillable(string $employeebenefitsbillable): void
    {
        $this->employeebenefitsbillable = $employeebenefitsbillable;
    }

    /**
     * @return string
     */
    public function getMaximumsocialsecurity(): string
    {
        return $this->maximumsocialsecurity;
    }

    /**
     * @param string $maximumsocialsecurity
     */
    public function setMaximumsocialsecurity(string $maximumsocialsecurity): void
    {
        $this->maximumsocialsecurity = $maximumsocialsecurity;
    }

    /**
     * @return string
     */
    public function getEc1Firstname(): string
    {
        return $this->ec1_firstname;
    }

    /**
     * @param string $ec1_firstname
     */
    public function setEc1Firstname(string $ec1_firstname): void
    {
        $this->ec1_firstname = $ec1_firstname;
    }

    /**
     * @return string
     */
    public function getEc1Lastname(): string
    {
        return $this->ec1_lastname;
    }

    /**
     * @param string $ec1_lastname
     */
    public function setEc1Lastname(string $ec1_lastname): void
    {
        $this->ec1_lastname = $ec1_lastname;
    }

    /**
     * @return string
     */
    public function getEc1Streetaddress(): string
    {
        return $this->ec1_streetaddress;
    }

    /**
     * @param string $ec1_streetaddress
     */
    public function setEc1Streetaddress(string $ec1_streetaddress): void
    {
        $this->ec1_streetaddress = $ec1_streetaddress;
    }

    /**
     * @return string
     */
    public function getEc1City(): string
    {
        return $this->ec1_city;
    }

    /**
     * @param string $ec1_city
     */
    public function setEc1City(string $ec1_city): void
    {
        $this->ec1_city = $ec1_city;
    }

    /**
     * @return string
     */
    public function getEc1State(): string
    {
        return $this->ec1_state;
    }

    /**
     * @param string $ec1_state
     */
    public function setEc1State(string $ec1_state): void
    {
        $this->ec1_state = $ec1_state;
    }

    /**
     * @return string
     */
    public function getEc1Zipcode(): string
    {
        return $this->ec1_zipcode;
    }

    /**
     * @param string $ec1_zipcode
     */
    public function setEc1Zipcode(string $ec1_zipcode): void
    {
        $this->ec1_zipcode = $ec1_zipcode;
    }

    /**
     * @return string
     */
    public function getEc1Homephone(): string
    {
        return $this->ec1_homephone;
    }

    /**
     * @param string $ec1_homephone
     */
    public function setEc1Homephone(string $ec1_homephone): void
    {
        $this->ec1_homephone = $ec1_homephone;
    }

    /**
     * @return string
     */
    public function getEc1Workphone(): string
    {
        return $this->ec1_workphone;
    }

    /**
     * @param string $ec1_workphone
     */
    public function setEc1Workphone(string $ec1_workphone): void
    {
        $this->ec1_workphone = $ec1_workphone;
    }

    /**
     * @return string
     */
    public function getEc1Cellphone(): string
    {
        return $this->ec1_cellphone;
    }

    /**
     * @param string $ec1_cellphone
     */
    public function setEc1Cellphone(string $ec1_cellphone): void
    {
        $this->ec1_cellphone = $ec1_cellphone;
    }

    /**
     * @return string
     */
    public function getEc1Relationship(): string
    {
        return $this->ec1_relationship;
    }

    /**
     * @param string $ec1_relationship
     */
    public function setEc1Relationship(string $ec1_relationship): void
    {
        $this->ec1_relationship = $ec1_relationship;
    }

    /**
     * @return string
     */
    public function getEc2Firstname(): string
    {
        return $this->ec2_firstname;
    }

    /**
     * @param string $ec2_firstname
     */
    public function setEc2Firstname(string $ec2_firstname): void
    {
        $this->ec2_firstname = $ec2_firstname;
    }

    /**
     * @return string
     */
    public function getEc2Lastname(): string
    {
        return $this->ec2_lastname;
    }

    /**
     * @param string $ec2_lastname
     */
    public function setEc2Lastname(string $ec2_lastname): void
    {
        $this->ec2_lastname = $ec2_lastname;
    }

    /**
     * @return string
     */
    public function getEc2Streetaddress(): string
    {
        return $this->ec2_streetaddress;
    }

    /**
     * @param string $ec2_streetaddress
     */
    public function setEc2Streetaddress(string $ec2_streetaddress): void
    {
        $this->ec2_streetaddress = $ec2_streetaddress;
    }

    /**
     * @return string
     */
    public function getEc2City(): string
    {
        return $this->ec2_city;
    }

    /**
     * @param string $ec2_city
     */
    public function setEc2City(string $ec2_city): void
    {
        $this->ec2_city = $ec2_city;
    }

    /**
     * @return string
     */
    public function getEc2State(): string
    {
        return $this->ec2_state;
    }

    /**
     * @param string $ec2_state
     */
    public function setEc2State(string $ec2_state): void
    {
        $this->ec2_state = $ec2_state;
    }

    /**
     * @return string
     */
    public function getEc2Zipcode(): string
    {
        return $this->ec2_zipcode;
    }

    /**
     * @param string $ec2_zipcode
     */
    public function setEc2Zipcode(string $ec2_zipcode): void
    {
        $this->ec2_zipcode = $ec2_zipcode;
    }

    /**
     * @return string
     */
    public function getEc2Homephone(): string
    {
        return $this->ec2_homephone;
    }

    /**
     * @param string $ec2_homephone
     */
    public function setEc2Homephone(string $ec2_homephone): void
    {
        $this->ec2_homephone = $ec2_homephone;
    }

    /**
     * @return string
     */
    public function getEc2Workphone(): string
    {
        return $this->ec2_workphone;
    }

    /**
     * @param string $ec2_workphone
     */
    public function setEc2Workphone(string $ec2_workphone): void
    {
        $this->ec2_workphone = $ec2_workphone;
    }

    /**
     * @return string
     */
    public function getEc2Cellphone(): string
    {
        return $this->ec2_cellphone;
    }

    /**
     * @param string $ec2_cellphone
     */
    public function setEc2Cellphone(string $ec2_cellphone): void
    {
        $this->ec2_cellphone = $ec2_cellphone;
    }

    /**
     * @return string
     */
    public function getEc2Relationship(): string
    {
        return $this->ec2_relationship;
    }

    /**
     * @param string $ec2_relationship
     */
    public function setEc2Relationship(string $ec2_relationship): void
    {
        $this->ec2_relationship = $ec2_relationship;
    }

    /**
     * @return string
     */
    public function getEc3Firstname(): string
    {
        return $this->ec3_firstname;
    }

    /**
     * @param string $ec3_firstname
     */
    public function setEc3Firstname(string $ec3_firstname): void
    {
        $this->ec3_firstname = $ec3_firstname;
    }

    /**
     * @return string
     */
    public function getEc3Lastname(): string
    {
        return $this->ec3_lastname;
    }

    /**
     * @param string $ec3_lastname
     */
    public function setEc3Lastname(string $ec3_lastname): void
    {
        $this->ec3_lastname = $ec3_lastname;
    }

    /**
     * @return string
     */
    public function getEc3Streetaddress(): string
    {
        return $this->ec3_streetaddress;
    }

    /**
     * @param string $ec3_streetaddress
     */
    public function setEc3Streetaddress(string $ec3_streetaddress): void
    {
        $this->ec3_streetaddress = $ec3_streetaddress;
    }

    /**
     * @return string
     */
    public function getEc3City(): string
    {
        return $this->ec3_city;
    }

    /**
     * @param string $ec3_city
     */
    public function setEc3City(string $ec3_city): void
    {
        $this->ec3_city = $ec3_city;
    }

    /**
     * @return string
     */
    public function getEc3State(): string
    {
        return $this->ec3_state;
    }

    /**
     * @param string $ec3_state
     */
    public function setEc3State(string $ec3_state): void
    {
        $this->ec3_state = $ec3_state;
    }

    /**
     * @return string
     */
    public function getEc3Zipcode(): string
    {
        return $this->ec3_zipcode;
    }

    /**
     * @param string $ec3_zipcode
     */
    public function setEc3Zipcode(string $ec3_zipcode): void
    {
        $this->ec3_zipcode = $ec3_zipcode;
    }

    /**
     * @return string
     */
    public function getEc3Homephone(): string
    {
        return $this->ec3_homephone;
    }

    /**
     * @param string $ec3_homephone
     */
    public function setEc3Homephone(string $ec3_homephone): void
    {
        $this->ec3_homephone = $ec3_homephone;
    }

    /**
     * @return string
     */
    public function getEc3Workphone(): string
    {
        return $this->ec3_workphone;
    }

    /**
     * @param string $ec3_workphone
     */
    public function setEc3Workphone(string $ec3_workphone): void
    {
        $this->ec3_workphone = $ec3_workphone;
    }

    /**
     * @return string
     */
    public function getEc3Cellphone(): string
    {
        return $this->ec3_cellphone;
    }

    /**
     * @param string $ec3_cellphone
     */
    public function setEc3Cellphone(string $ec3_cellphone): void
    {
        $this->ec3_cellphone = $ec3_cellphone;
    }

    /**
     * @return string
     */
    public function getEc3Relationship(): string
    {
        return $this->ec3_relationship;
    }

    /**
     * @param string $ec3_relationship
     */
    public function setEc3Relationship(string $ec3_relationship): void
    {
        $this->ec3_relationship = $ec3_relationship;
    }

    public function __toString() {
        return $this->getNames();
    }


}
