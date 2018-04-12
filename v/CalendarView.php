<?php
/**
 * Created by PhpStorm.
 * User: bretzelus
 * Calendar: 18-04-07
 * Time: 18:27
 */
namespace App\View;

require_once "src/Calendar/Month.php";
require_once "src/Calendar/Events.php";


class CalendarView {

    private $_Month;

    /**
     * @var int Premier jour de la semaine : 0 : Dimanche, 1 : Lundi.
     */
    private $_FirstWeekDay;

    public function __construct(?\App\Calendar\Month $aMonth = null)
    {

        if($aMonth === null)
            $this->_Month = new \App\Calendar\Month();
        else
            $this->_Month = $aMonth;

    }

    /**
     * Affiche le calendrier du mois...
     */

    public function Draw(?App\Calendar\Events $aEvents = null)
    {
        $weeks = $this->_Month->NumOfWeeks();

        if($aEvents === null){
            $aEvents = new \App\Calendar\Events();
        }
        $Events = $aEvents->BetweenByDay($this->_Month->StartingDay(), $this->_Month->_EndDay());
        $TableClass = "calendar__table calendar__table". ($weeks > 5 ? 'X' : ''); ?>
        <div id="Calendar_Container">
            <table class="<?= $TableClass; ?>">
            <?php for($i = 0;$i < $weeks; $i++): ?>

            <tr >
                <?php
                    foreach(\App\Calendar\Month::$WeekDays as $K => $D):
                    $CurDay = (clone $this->_Month->StartingSunDay())->modify("+".($K + $i * 7)."  days");
                    $EventsForDay = $Events[$CurDay->format('Y-m-d')] ?? [];
                ?>

                <?php if($CurDay->format('d-m') === $this->_Month->Today()->format('d-m')): ?>
                    <td class="calendar_today">
                <?php else: ?>
                    <td class="<?= $this->_Month->WithinMonth($CurDay) ? '' : 'calendar__othermonth'; ?>">
                <?php endif; ?>
                
                <?php if($i===0): ?>
                        <div class="calendar__weekday__names"><?= $D; ?></div>
                    <?php endif; ?>
                    <div class="calendar__dayNum">
                        <?= $CurDay->format('d'); ?>
                    </div>
                    <?php foreach($EventsForDay as $ev): ?>
                        <?php
                            $display_str = $ev->Name();
                            $l=strlen($display_str);
                            if($l > 15)
                                $display_str=substr($ev->Name(),0,16).'...';
                        ?>

                        <div class="calendar_event">
                            <?= (new \DateTime($ev->Start()))->format('H:i'); ?> - <a href="Event Clicked"><?= $display_str; ?></a>
                        </div>
                    <?php endforeach; ?>
                </td>
                <?php endforeach; ?>
            </tr>
            <?php endfor;?>
        </table>
    </div>
    <?php
    }

    /**
     * Exc&eacute;cute une requ&ecirc;te pour le client distant.
     * @param string $aCommand Le texte du nom de la commande &agrave; faire ex&eacute;cuter par Le Calendirer.
     * @param array $aArgs La liste des arguments donn&eacute;s par le client distant
     * @return int code de status interne.
     * @throw \Exception
     */
    public static function Request(string $aCommand, array $aArgs): int
    {
        throw new \Exception("Pas encore impl&eacute;ment&eacute; !!");
    }


};



// POST Requests seulement !

//if(!isset( $_POST['Request']))
//    CalendarView::Request('', []);

?>