<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;


class ExerciseModel extends Model
{
    protected $table = 'exercises';
    protected $primaryKey = 'id';

    // the table columns that we will allow users to change
    protected $allowedFields = ['exer_name', 'exer_equipment', 'exer_level'];


    protected $db;

    public function __construct(ConnectionInterface &$db)
    {
        $this->db = &$db;
    }
    function top5()
    {
        // "SELECT *  FROM exercises"
        $exercises = $this->db->table('exercises')
            ->where(['exer_id >' => 5])
            ->where(['exer_id <=' => 10])
            ->orderBy('exer_id', 'DESC')
            ->limit(2) // Limit the number of results to 5
            ->get()
            ->getResult();

        $top_exercises = array();
        $i = 0;
        foreach ($exercises as $object) {
            $top_exercises[] = (array) $object;
            $images = json_decode($top_exercises[$i]["exer_images"], true);
            $image1 = $images[0];
            $top_exercises[$i]["exer_images"] = $image1;
            $i ++;
        }
        // echo '<pre>';
        // print_r($top_exercises);
        // echo '</pre>';
        // exit;

        // Cache the fetched exercises
        $cache = \Config\Services::cache();
        $cache->save('top_exercises', $top_exercises, 3600); // Cache for 1 hour (3600 seconds)

        return $top_exercises;
    }


    function fetchExercises()
    {
        // "SELECT *  FROM exercises"
        $all_exercises = array();

        $exercises = $this->db->table('exercises')->get()->getResult();
        $i = 0;
        foreach ($exercises as $object) {
            $all_exercises[] = (array) $object;

            $images = json_decode($all_exercises[$i]["exer_images"], true);
            $image1 = $images[0];
            $all_exercises[$i]["exer_images"] = $image1;
            $i++;
        }

        // Cache the fetched exercises
        $cache = \Config\Services::cache();
        $cache->save('cached_exercises', $all_exercises, 3600); // Cache for 1 hour (3600 seconds)
        return $all_exercises;
    }
}
