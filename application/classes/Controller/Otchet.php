<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Otchet extends Controller_Base {
    public $template = 'otchet/v_main';
    //Бухгалтерский отчет
    public function action_otchet()
    {
        $month = $this->request->query('month');
        $god = $this->request->query('god');
        $type = $this->request->query('type');
        
        $go_exel = $this->request->query('go_exel');
        $user = Model::factory('otchet')->otchet($month,$god,$type);
        if(isset($go_exel)) {
            Model::factory('otchet')->otchet_exel($user,$month,$god,$type);
        }
        else {
            $content = View::factory('otchet/v_otchet', array(
            'user' => $user,
            'month' => $month,
            'god' => $god,
            'type' => $type,
            ));
            $this->savelog(" создал бух. отчет за ",$month." ".$god." ".$type);
            $this->template->content = $content;
        }
        
        
    }
    //отчет в налоговую
    public function action_nalogotchet()
    {
        $month = $this->request->query('month');
        $god = $this->request->query('god');
        $type = $this->request->query('type');
        $urfiz = $this->request->query('urfiz');
        $users = Model::factory('otchet')->nalog_otchet($month,$god,$type,$urfiz);
        
        Model::factory('otchet')->nalog_otchet_exel($users,$month,$god,$type,$urfiz);
        
        
//        $content = View::factory('otchet/v_nalog_otchet', array(
//            'user' => $users,
//            'month' => $month,
//            'god' => $god,
//            'urfiz' => $urfiz,
//            'type' => $type,
//            ));
//        $this->savelog(" создал налоговый отчет за ",$month." ".$god." ".$type);
//        $this->template->content = $content;
    }
    public function action_aktsverki()
    {
        $user_name = $this->request->post('user_name_text');
        if ('' == $user_name) {$user_name = $this->request->post('user_name');}

        $month = $this->request->post('month');
        $day = $this->request->post('day');
        $year = $this->request->post('year');
        if(10 > $month && 2 > strlen($month)) {$month = '0'.$month;}
        if(10 > $day && 2 > strlen($day)) {$day = '0'.$day;}
        $from = $year.$month.$day;
        
        $formonth = $this->request->post('formonth');
        $forday = $this->request->post('forday');
        $foryear = $this->request->post('foryear');
        if(10 > $formonth && 2 > strlen($month)) {$formonth = '0'.$formonth;}
        if(10 > $forday && 2 > strlen($day)) {$forday = '0'.$forday;}
        $to = $foryear.$formonth.$forday;
        
        $saldo = Model::factory('akt')->get_saldo($user_name,$from);
        $akt = Model::factory('akt')->get_atk_sv($user_name,$from,$to);
        $user = Model::factory('users')->get_one_users($user_name);
        
        $content = View::factory('otchet/v_akt_sv',
                array('akt'=>$akt,
                    'saldo'=>$saldo,
                    'user'=>$user,
                    'day'=>$day,
                    'month'=>$month,
                    'year'=>$year,
                    'forday'=>$forday,
                    'formonth'=>$formonth,
                    'foryear'=>$foryear));
        $this->template->content = $content;
    }
}
