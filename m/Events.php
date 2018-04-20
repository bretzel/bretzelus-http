<?php
/**
 * Created by PhpStorm.
 * User: bretzelus
 * Date: 18-04-08
 * Time: 13:31
 */

namespace Model;

class Event {
    protected $id;
    protected $name;
    protected $description;
    protected $start;
    protected $end;

    public function __construct(array $Data)
    {
            $this->id = $Data['id'];
            $this->name = $Data['name'];
            $this->description = $Data['description'] ? $Data['description'] : '';
            $this->start = $Data['start'];
            $this->end = $Data['end'];
    }

    public function Id():string             {return $this->id;}
    public function Name():string           {return $this->name;}
    public function Description()           {return $this->description;}
    public function Start():string          {return $this->start;}
    public function End()  :string          {return $this->end;}
}

class Events
{
    /**
     * Recuperer les events pour l'inervale donne.
     * @param \DateTime $aStart
     * @param \DateTime $aEnd
     * @return array
     */
    public function Between(\DateTime $aStart, \DateTime $aEnd): array{

        $pdo = new \PDO('mysql:host=localhost;dbname=BCalendar','bretzelus','Lus5vr52', [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);

        $sql = "SELECT * FROM events WHERE start BETWEEN '{$aStart->format('Y-m-d 00:00:00')}' AND '{$aEnd->format('Y-m-d 23:59:59')}' ";
        $stmt = $pdo->query($sql);
        $All = $stmt->fetchAll();
        $Set = [];



        $c=0;
        foreach($All as $eve)  $Set[] = new Event($eve);

        return $Set;
    }

    /**
     * Recuperer les events pour l'inervale donn&eacute; index&eacute; par jour
     * @param \DateTime $aStart
     * @param \DateTime $aEnd
     * @return array
     */
    public function BetweenByDay(\DateTime $aStart, \DateTime $aEnd): array{

        $events = $this->Between($aStart,$aEnd);
        $days = [];
        foreach($events  as $ev){
            $day = explode(' ', $ev->Start())[0];
            //echo "<pre>"; print_r($ev->Start()); echo "</pre>";
            $days[$day][] = $ev;
        }

        //echo "<pre>"; print_r($days); echo "</pre>";
        return $days;
    }

    /**
     *  Vérifie
     * @param \DateTime $aStart
     * @param \DateTime $aEnd
     * @return bool
     */
    public function InBetween(\DateTime $aStart, \DateTime $aEnd) : bool
    {

    }
};



?>

