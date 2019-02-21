<div class="jumbotron">
    <h1 class="display-4"><?= $event->name?></h1>
    <p class="lead"><?= $event->description?></p>
    <p><?=$event->start_date?> to <?= $event->end_date?></p>
</div>

<?php
echo $this->Form->create(null);

$now = new DateTime();

foreach ($event->tracks as $track) {
    ?>
    <div class="col">
        <h3><?= $track->track_name;?></h3>
        <ul class="list-unstyled">
        <?php foreach ($track->talks as $talk): ?>
        <?php
         $allow = $talk->start_date > $now;
         ?>
            <li style="<?php if (!$allow) { echo "text-decoration: line-through;"; } ?>""><?php

                $talkLabel = $talk->start_date->format('D H:i') . ' - ' . $talk->talk_title;
                if (!empty($talk->speakers)) {
                    $talkLabel .= ' with ' . $talk->speakers[0]['speaker_name'];
                }

                if ($allow) {
                    echo $this->Form->control(
                        'reminders.' . $talk->id . '.id',
                        [
                            'type' => 'checkbox',
                            'label' => $talkLabel,
                            'class' => 'mr-3'
                        ]
                    );
                }
            ?></li>
        <?php endforeach;?>
        </ul>
    </div>
    <?php
}


echo $this->Form->control('phone_number', ['label' => 'Send me an SMS reminder', 'placeholder' => 'Your phone number']);
echo $this->Form->button('Remind me ', ['class' => 'btn btn-primary']);
echo $this->Form->end();
