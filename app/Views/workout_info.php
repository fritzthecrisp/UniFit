<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('css/workout.css') ?>">

<main class="container">
    <div class="row">
        <h1 class="title"><?= $workout['workout_name'] ?></h1>
        <div id="workoutDetails">
            <?php $workoutImg =  "workoutImg - " . $workout['workout_name']
            ?>
            <img class="workoutImg" src=<?= $imgURLs . $workout['workout_image'] . "?raw=true" ?> alt=<?= $workoutImg ?>>
        </div>
        <div class="workoutGuide-description">
            <h2 class="title"><?= "Your Guide to " . $workout['workout_name'] ?></h2>
            <p><?= " (created by: " . $workout['user_name'] . ")" ?></p>
            <h3 class="title">Description:</h3 class="title">
            <p><?= $workout['workout_description'] ?></p>
        </div>
    </div>
    <div>
        <div class="d-flex justify-content-end" id="workoutButtons"> <!-- Added classes here -->
            <!-- <button>SHARE</button> -->
            <form action="<?php echo base_url('workout/start/' . $workout['instance_id']); ?>" method="get">
                <button type="submit">Share</button>
            </form>
            <!-- ?php if ($isLoggedIn) : ? -->
            <form action="<?= site_url('instance/edit/' . $workout['instance_id']) ?>" method="get">
                <button type="submit">Create Workout</button>
            </form>
            <!-- ?php endif; ? -->

        </div>
        <div id="thisdiv">
            <table id="exerciseTable" class="table table-dark">
                <thead>
                    <tr>
                        <th>Exercise Name</th>
                        <th>Sets</th>
                        <th>Reps</th>
                        <th>Weights</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sets as $set) : ?>
                        <tr>
                            <td><?= $set['exer_name'] ?></td>
                            <td><?= $set['sets'] ?></td>
                            <td><?= $set['reps'] ?></td>
                            <td><?= $set['weight'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<script src="<?= base_url('js/workoutInfo.js') ?>"></script>

<?= $this->endSection() ?>