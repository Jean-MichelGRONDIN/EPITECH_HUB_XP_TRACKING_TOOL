<?php

class Xpscounter
{
    private $config;
    private $xps;
    private $nb_xps_won;
    private $nb_xps_lost;
    private $data;

    private $talk_participation_myNb;
    private $talk_participation_add;
    private $talk_participation_sub;
    private $talk_participation_limit;

    private $workshop_participation_myNb;
    private $workshop_participation_add;
    private $workshop_participation_sub;
    private $workshop_participation_limit;

    private $hackaton_participation_myNb;
    private $hackaton_participation_add;
    private $hackaton_participation_sub;
    private $hackaton_participation_limit;

    private $talk_organisation_myNb;
    private $talk_organisation_add;
    private $talk_organisation_sub;
    private $talk_organisation_limit;

    private $workshop_organisation_myNb;
    private $workshop_organisation_add;
    private $workshop_organisation_sub;
    private $workshop_organisation_limit;

    private $hackaton_organisation_myNb;
    private $hackaton_organisation_add;
    private $hackaton_organisation_sub;
    private $hackaton_organisation_limit;

    public $experimentation_myNb;
    public $experimentation_add;
    public $experimentation_limit;

    private $user_login;
    private $autologin_file_path;
    private $year;
    // private $user_auto_login;

    public function xpscounter($config_path)//, $autologin
    {
        $json_config = file_get_contents($config_path, true);
        $this->config = json_decode($json_config, true);
        $this->xps = 0;
        $this->data = [];
        $this->nb_xps_won = 0;
        $this->nb_xps_lost = 0;

        $this->talk_participation_myNb = 0;
        $this->talk_participation_add = $this->config['TALK_PARTICIPATION_ADD'];
        $this->talk_participation_sub = $this->config['TALK_PARTICIPATION_SUB'];
        $this->talk_participation_limit = $this->config['TALK_PARTICIPATION_LIMIT'];

        $this->workshop_participation_myNb = 0;
        $this->workshop_participation_add = $this->config['WORKSHOP_PARTICIPATION_ADD'];
        $this->workshop_participation_sub = $this->config['WORKSHOP_PARTICIPATION_SUB'];
        $this->workshop_participation_limit = $this->config['WORKSHOP_PARTICIPATION_LIMIT'];

        $this->hackaton_participation_myNb = 0;
        $this->hackaton_participation_add = $this->config['HACKATON_PARTICIPATION_ADD'];
        $this->hackaton_participation_sub = $this->config['HACKATON_PARTICIPATION_SUB'];
        $this->hackaton_participation_limit = $this->config['HACKATON_PARTICIPATION_LIMIT'];

        $this->talk_organisation_myNb = 0;
        $this->talk_organisation_add = $this->config['TALK_ORGANISATION_ADD'];
        $this->talk_organisation_sub = $this->config['TALK_ORGANISATION_SUB'];
        $this->talk_organisation_limit = $this->config['TALK_ORGANISATION_LIMIT'];

        $this->workshop_organisation_myNb = 0;
        $this->workshop_organisation_add = $this->config['WORKSHOP_ORGANISATION_ADD'];
        $this->workshop_organisation_sub = $this->config['WORKSHOP_ORGANISATION_SUB'];
        $this->workshop_organisation_limit = $this->config['WORKSHOP_ORGANISATION_LIMIT'];

        $this->hackaton_organisation_myNb = 0;
        $this->hackaton_organisation_add = $this->config['HACKATON_ORGANISATION_ADD'];
        $this->hackaton_organisation_sub = $this->config['HACKATON_ORGANISATION_SUB'];
        $this->hackaton_organisation_limit = $this->config['HACKATON_ORGANISATION_LIMIT'];

        $this->experimentation_myNb = 0;
        $this->experimentation_add = $this->config['EXPERIMENTATION_ADD'];
        $this->experimentation_limit = $this->config['EXPERIMENTATION_LIMIT'];

        $this->user_login = $this->config['EMAIL'];
        $this->autologin_file_path = $this->config['AUTOLOGIN_FILE_PATH'];
        $this->year = $this->config['YEAR'];
        // $this->user_auto_login = $autologin;
    }

    public function calcStats()
    {
        $this->xps = $this->nb_xps_won - $this->nb_xps_lost;
    }

    public function participationAddOrSub($activity_type, $presence_status)
    {
        $tmp_value = 0;

        if ($presence_status == 1) {
            if ($activity_type == "Talk" && $this->talk_participation_myNb < $this->talk_participation_limit) {
                $tmp_value = $this->talk_participation_add;
                $this->talk_participation_myNb += 1;
            } else if ($activity_type == "Workshop" && $this->workshop_participation_myNb < $this->workshop_participation_limit) {
                $tmp_value = $this->workshop_participation_add;
                $this->workshop_participation_myNb += 1;
            } else if ($activity_type == "Hackathon" && $this->hackaton_participation_myNb < $this->hackaton_participation_limit) {
                $tmp_value = $this->hackaton_participation_add;
                $this->hackaton_participation_myNb += 1;
            }
            $this->nb_xps_won += $tmp_value;
        } else {
            if ($activity_type == "Talk") {
                $tmp_value = $this->talk_participation_sub;
            } else if ($activity_type == "Workshop") {
                $tmp_value = $this->workshop_participation_sub;
            } else if ($activity_type == "Hackathon") {
                $tmp_value = $this->hackaton_participation_sub;
            }
            $this->nb_xps_lost += $tmp_value;
        }
    }

    public function organizationAddOrSub($activity_type, $presence_status)
    {
        $tmp_value = 0;

        if ($presence_status == 2) {
            if ($activity_type == "Talk" && $this->talk_organisation_myNb < $this->talk_organisation_limit) {
                $tmp_value = $this->talk_organisation_add;
                $this->talk_organisation_myNb += 1;
            } else if ($activity_type == "Workshop" && $this->workshop_organisation_myNb < $this->workshop_organisation_limit) {
                $tmp_value = $this->workshop_organisation_add;
                $this->workshop_organisation_myNb += 1;
            } else if ($activity_type == "Hackathon" && $this->hackaton_organisation_myNb < $this->hackaton_organisation_limit) {
                $tmp_value = $this->hackaton_organisation_add;
                $this->hackaton_organisation_myNb += 1;
            }
            $this->nb_xps_won += $tmp_value;
        } else {
            if ($activity_type == "Talk") {
                $tmp_value = $this->talk_organisation_sub;
            } else if ($activity_type == "Workshop") {
                $tmp_value = $this->workshop_organisation_sub;
            } else if ($activity_type == "Hackathon") {
                $tmp_value = $this->hackaton_organisation_sub;
            }
            $this->nb_xps_lost += $tmp_value;
        }
    }

    public function experimentationAddOrSub()
    {
        $this->nb_xps_won += $this->experimentation_add;
    }

    public function xpsAddOrSub($activity_type, $presence_status)
    {
        if ($presence_status == 1 || $presence_status == -1) {
            $this->participationAddOrSub($activity_type, $presence_status);
        }
        if ($presence_status == 2 || $presence_status == -2) {
            $this->organizationAddOrSub($activity_type, $presence_status);
        }
        if ($presence_status == 3) {
            $this->experimentationAddOrSub();
        }
    }

    public function getuserStatusParticipation($event, $presence_status)
    {
        if ($event['user_status'] == "present" && $presence_status == 0) {
            $presence_status = 1;
        }
        if ($event['user_status'] == "absent") {
            $presence_status = -1;
        }
        return ($presence_status);
    }

    public function getuserStatusOrganization($event, $presence_status)
    {
        $orga = $event['assistants'];
        foreach ($orga as $people) {
            if ($people['login'] == $this->user_login) {
                if ($people['manager_status'] == "present") {
                    $presence_status = 2;
                } else if ($people['manager_status'] == "absent") {
                    $presence_status = -2;
                }
            }
        }
        return ($presence_status);
    }

    // public function getUserStatusExperimentation($act, $presence_status, $eventType)
    // {
    //     if ($eventType != "Experience") {
    //         return ($presence_status);
    //     }
    //     $actCode = $act['codeacti'];
    //     $url = "https://intra.epitech.eu/". $this->user_auto_login ."/module/2019/B-INN-000/RUN-0-1/". $actCode ."/?format=json";
    //     $curl = curl_init();
    //     curl_setopt($curl, CURLOPT_URL, $url);
    //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($curl, CURLOPT_HEADER, false);
    //     $curl_ret = curl_exec($curl);
    //     curl_close($curl);
    //     $tmpData = json_decode($curl_ret, true);
    //     printf("Try to compare: [%d], title: [%s]\n", $tmpData['student_registered'], $act['title']);
    //     if ($tmpData['student_registered'] == 1) {
    //         printf("One experimentation detected ![%s]\n", $act['title']);
    //         $presence_status = 3;
    //     }
    //     return ($presence_status);
    // }

    public function setupAll()
    {
        $autolog = file_get_contents($this->autologin_file_path, true);
        $url = "https://intra.epitech.eu/". $autolog ."/module/". $this->year ."/B-INN-000/RUN-0-1/?format=json";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $curl_ret = curl_exec($curl);
        curl_close($curl);
        $this->data = json_decode($curl_ret, true);
    }

    public function getUserStatus($event, $presence_status, $eventType, $act)
    {
        // if ($event) {
        $presence_status = $this->getuserStatusParticipation($event, $presence_status);
        $presence_status = $this->getuserStatusOrganization($event, $presence_status);
        // }
        // $presence_status = $this->getUserStatusExperimentation($act, $presence_status, $eventType);
        return ($presence_status);
    }

    public function countMyXps()
    {
        $activities = $this->data['activites'];
        foreach ($activities as $act) {
            $act_type = $act['type_title'];
            $events = $act['events'];
            $presence_status = 0;
            // if (!$events) {
            //     $presence_status = $this->getUserStatus([], $presence_status, $act_type, $act);
            // } else {
            foreach ($events as $event) {
                $presence_status = $this->getUserStatus($event, $presence_status, $act_type, $act);
            }
            // }
            if ($presence_status != 0) {
                $this->xpsAddOrSub($act_type, $presence_status);
            }
        }
        $this->calcStats();
    }

    public function printAll()
    {
        $parti_talks_left = $this->talk_participation_limit - $this->talk_participation_myNb;
        $parti_workshops_left = $this->workshop_participation_limit - $this->workshop_participation_myNb;
        $parti_hackatons_left = $this->hackaton_participation_limit - $this->hackaton_participation_myNb;
        $orga_talks_left = $this->talk_organisation_limit - $this->talk_organisation_myNb;
        $orga_workshops_left = $this->workshop_organisation_limit - $this->workshop_organisation_myNb;
        $orga_hackatons_left = $this->hackaton_organisation_limit - $this->hackaton_organisation_myNb;
        printf("For the year %s with all Talks, Workshops, Hackatons:\n", $this->year);
        printf("You won %d xps\n", $this->nb_xps_won);
        printf("You lost %d xps\n\n", $this->nb_xps_lost);

        if ($parti_talks_left > 0)
            printf("You can still participate to %d Talks before reaching the limite\n", $parti_talks_left);
        if ($parti_workshops_left > 0)
            printf("You can still participate to %d Workshop before reaching the limite\n", $parti_workshops_left);
        if ($this->hackaton_participation_limit != 9999 && $parti_hackatons_left > 0)
            printf("You can still participate to %d Hackatons before reaching the limite\n", $parti_hackatons_left);

        if ($orga_talks_left > 0)
            printf("You can still organize %d Talks before reaching the limite\n", $orga_talks_left);
        if ($orga_workshops_left > 0)
            printf("You can still organize %d Workshop before reaching the limite\n", $orga_workshops_left);
        if ($this->hackaton_organisation_limit != 9999 && $orga_hackatons_left > 0)
            printf("You can still organize %d Hackatons before reaching the limite\n", $orga_hackatons_left);

        printf("\n\nYour number of xp points is: %d\n\n", $this->xps);
    }
}

?>