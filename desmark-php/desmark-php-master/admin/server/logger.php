<?php


class logger
{
    private $Dbconn;

    /**
     * logs constructor.
     * @param $Dbconn
     */
    public function __construct($Dbconn)
    {
        $this->Dbconn = $Dbconn;
    }
    /**
     * @param $user
     * @param $action
     * @param $date
     * @param $branch
     */
    function createlogs($user, $action, $date, $branch){
        $sql = "INSERT INTO `userlog` (`name`, `action`, `date`, `branch`) VALUES ('$user', '$action', '$date', '$branch')";
        $this->Dbconn->query($sql);

    }

}