<?php
/**
 * Created by PhpStorm.
 * User: bretzelus
 * Calendar: 18-04-07
 * Time: 13:03
 */

namespace Model;


class Month
{


    public static $Names    = ['Janvier', 'F&eacute;vrier','Mars','Avril','Mai', 'Juin','Juillet','Ao&ucirc;t','Septembre','Octobre','Novembre','D&eacute;cembre'];
    public  static $WeekDays = ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'];

    /**
     * @var int Num&eacute;ro du mois.
     */
    private $_X_;

    /**
     * @var int Ann&eacutes;e exprim&eacute;e dans un entier ex.: 1990.
     */
    private $_Y_;

    /**
     * @var \DateTime Objet Datetime du calendrier du premier jour du mois.
     */
    private $_StartingDay;

    /**
     * @var \DateTime Objet Datetime du calendrier du premier Dimanche de la grille du calendrier
     */
    private $_StartingSunday;

    /**
     * @var int Num&eacutesro de la date du jour du premier Dimanche de la grille du calendrier
     */
    private $_SundayMonthDate;

    /**
     * @var int Num&eacutesro du jour de la semaine du 1-er du mois.
     */
    private $_WeekDayNum; ///< Numero du jour de la semaine du 1-er du mois : intval($this->_StartingSunday->format('w'));

    /**
     * @var int Nombre de jours de ce mois.
     */
    private $_NumOfDays;

    /**
     * @var int Nombre de semaines de ce mois.
     */
    private $_NumOfWeeks;

    /**
     * @var Ouais... Aujoutd'hui ! ;=)
     */
    private $_Thisday;
    /**
     * Month constructor.
     * @param int $aMonth Le mois compris entre 1 et 12
     * @param int $aYear  Annee
     * @throws \Exception
     */
    public function __construct(?int $aMonth = null, ?int $aYear = null)
    {
        if( $aMonth === null )
            $aMonth = intval(date('m'));
        if($aYear == null)
            $aYear = intval(date('Y'));

        if ($aMonth < 1 || $aMonth > 12)
            throw new \Exception("Le mois n'est pas valide");

        if ($aYear < 1970)
            throw new \Exception("L'annee n'est pas valide");

        $this->_X_ = $aMonth;
        $this->_Y_ = $aYear;
        $this->_StartingDay = new \DateTime("{$this->_Y_}-{$this->_X_}-01");
        $this->_StartingSunday = (clone $this->_StartingDay)->modify('last sunday');

        $this->_WeekDayNum = intval($this->_StartingDay->format("w"));
        if($this->_WeekDayNum == 0) // Dans le seul cas ou le premier du mois est exactemnet le Dimanche ...
            $this->_StartingSunday = $this->_StartingDay;

        $this->ComputeNumOfWeeks();
        $this->_SundayMonthDate = intval($this->_StartingSunday->format('d'));
        $this->_NumOfDays = $this->_EndDay()->format('d');
        $this->_Thisday = new \DateTime("now");
        
    }

    public function Today() : \DateTime {
        return $this->_Thisday;
    }
    /**
     * @return int Year Renvoie l'annee
     */
    public function Year(): int
    {
        return $this->_Y_;
    }

    /**
     * @return int Renvoie le numero du mois.
     */
    public function MonthNumber():int {
        return $this->_X_;
    }
    /**
     * @return \DateTime Renvoie l'objet DateTime du premier jour du mois.
     */
    public function StartingDay() : \DateTime {
        return $this->_StartingDay;
    }


    /**
     * @return \DateTime Renvoie l'objet DateTime de la date du Dimanche precedant le premier du mois
     */
    public function StartingSunDay() : \DateTime {
        return $this->_StartingSunday;
    }

    public function _EndDay():  \DateTime {
        return (clone $this->_StartingDay)->modify('last day of');
    }
    /**
     * @return string Retourne le mois en toute lettre.
     */
    public function toString(): string { return Month::$Names[$this->_X_-1].' '.$this->_Y_; }


    /**
     * Calcule qui va donner le nombre de semaines dans la grille du calendrier.
     * @return rien.
     */
    private function ComputeNumOfWeeks()
    {

        $StartDay = intval( $this->_StartingDay->format("w"));
        $NumOfDays= intval( (clone $this->_StartingDay)->modify("last day of")->format("d") );
        //$SundayNum= intval( (clone $this->_StartingDay)->modify("last sunday")->format("w") );
        $TDays = $NumOfDays + $StartDay;
        $NumDayInLastWeek =  6 - intval( (clone $this->_StartingDay)->modify("last day of")->format("w") );
        $this->_NumOfWeeks =  ($TDays + $NumDayInLastWeek)/7;
    }

    /**
     * @return int Nombre calcul&eacute; de semaines que contient ce mois.
     */
    public function NumOfWeeks() : int { return $this->_NumOfWeeks; }

    /**
     * @param \DateTime Renvoie vrai si $aDate est dans le meme mois.
     * @return bool
     */
    public function WithinMonth(\DateTime $aDate):bool {
        return $this->_StartingDay->format('Y-m')  === $aDate->format('Y-m');
    }


    /**
     * @return Month Renvoie le mois suivant
     * @throws \Exception
     */
    public function Next() : Month{
        $month = $this->_X_ + 1;
        $year = $this->_Y_;
        if($month > 12){
            $month = 1;
            ++$year;
        }
        return new Month($month, $year);
    }

    /**
     * @return Month Renvoie le mois precedant.
     * @throws \Exception
     */
    public function Prev() : Month{
        $month = $this->_X_ - 1;
        $year = $this->_Y_;
        if($month < 1){
            $month = 12;
            --$year;
        }
        return new Month($month, $year);
    }


}

?>


