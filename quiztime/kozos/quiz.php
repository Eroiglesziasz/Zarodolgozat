<?php
include_once("adatbazis.php");
class quiz
{
    private $db;
    public function __construct()
    {
        $this->db = new Database();
    }

    public function get_tema()
    {

        $sql = "SELECT * FROM tema";
        $result = $this->db->RunSQL($sql);
        $data = $result->fetch_all(PDO::FETCH_ASSOC);

        return $data;
    }

    public function save_tema($nev, $kep_url)
    {
        $sql = "INSERT INTO tema VALUES ('null', ?, ?);";
        $result = $this->db->RunSQL($sql, $nev, $kep_url);

        $tema_id = $this->db->get_last_insert();

        return $tema_id;

    }

    public function save_kerdesek($tema_id, $kerdesek)
    {
        $sql = "INSERT INTO kerdesek VALUES ('null', ?,?);";
        $result = $this->db->RunSQL($sql, $tema_id, $kerdesek);

        $kerdesek_id = $this->db->get_last_insert();

        return $kerdesek_id;
    }

    public function save_valasztas($kerdes_id, $szoveg, $jovalasz)
    {
        $sql = "INSERT INTO valasztas VALUES ('null', ?,?,?);";
        $result = $this->db->RunSQL($sql, $kerdes_id, $szoveg, $jovalasz);

        $valasztas_id = $this->db->get_last_insert();

        return $valasztas_id;
    }


    public function save_quiz($quiz_data)
    {
        $tema_nev = $quiz_data["nev"];

        if (isset($_FILES["kep_url"])) {
            $filename = $_FILES["kep_url"]["name"];
            $tempname = $_FILES["kep_url"]["tmp_name"];

            $kep_url = "../kozos/images/" . $filename;

            if (!move_uploaded_file($tempname, $kep_url)) {
                $kep_url = "";
            } else {
                $kep_url = ltrim($kep_url, "../");
            }
        } else {
            $kep_url = "";
        }

        $tema_id = $this->save_tema($tema_nev, $kep_url);





        $questions = $quiz_data['question'];
        foreach ($questions as $question_data) {
            $question = $question_data['text'];
            $correct_answer = $question_data['correct'] ?? "";
            $question_id = $this->save_kerdesek($tema_id, $question);

            foreach ($question_data['answers'] as $key => $answer) {
                if ($correct_answer == $key) {
                    $jovalasz = 1;
                } else {
                    $jovalasz = 0;
                }

                $this->save_valasztas($question_id, $answer, $jovalasz);
            }
        }
    }

    public static function debug($message)
    {
        echo "<p>" . print_r($message, true) . "</p>";
    }
}

?>